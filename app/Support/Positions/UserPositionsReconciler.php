<?php

declare(strict_types=1);

namespace App\Support\Positions;

use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

final class UserPositionsReconciler
{
    private const COMPARATOR_ORDER_STATUSES = ['NEW', 'PARTIALLY_FILLED', 'FILLED'];

    private const OPEN_POSITION_STATUSES = ['new', 'opening', 'active', 'syncing', 'waping', 'closing', 'cancelling'];

    private const PAIR_STATUS_SYNCED = 'synced';

    private const PAIR_STATUS_DB_ONLY = 'db_only';

    private const PAIR_STATUS_TRANSIENT = 'transient';

    /**
     * @return array<int, array<string, mixed>>
     */
    public function accountsForUser(User $user): array
    {
        return DB::table('accounts')
            ->leftJoin('api_systems', 'api_systems.id', '=', 'accounts.api_system_id')
            ->where('accounts.user_id', $user->id)
            ->whereNull('accounts.deleted_at')
            ->orderByDesc('accounts.is_active')
            ->orderBy('accounts.name')
            ->select([
                'accounts.id',
                'accounts.name',
                'accounts.can_trade',
                'api_systems.name as exchange',
                'api_systems.canonical as exchange_canonical',
            ])
            ->get()
            ->map(fn (object $account): array => [
                'id' => (int) $account->id,
                'name' => (string) $account->name,
                'exchange' => $account->exchange ?: 'Unknown',
                'exchange_canonical' => $account->exchange_canonical,
                'exchange_logo' => $this->exchangeLogoUrl($account->exchange_canonical),
                'user' => $user->name,
                'can_trade' => (bool) $account->can_trade,
            ])
            ->all();
    }

    /**
     * @return array<string, mixed>
     */
    public function accountData(User $user, int $accountId): array
    {
        $account = $this->accountQuery($user, $accountId)->firstOrFail();
        $positions = $this->openPositions($accountId);
        $ordersByPosition = $this->ordersForPositions($positions->pluck('id')->all(), true);

        $pairs = $positions
            ->map(fn (object $position): array => $this->buildDbOnlyPair($position, $ordersByPosition[(int) $position->id] ?? collect(), (string) $account->margin_mode))
            ->sortBy(fn (array $pair): int => $pair['db']['opened_seconds_ago'] ?? PHP_INT_MAX)
            ->values()
            ->all();

        return [
            'account' => [
                'id' => (int) $account->id,
                'name' => (string) $account->name,
                'exchange' => $account->exchange ?: 'Unknown',
                'exchange_logo' => $this->exchangeLogoUrl($account->exchange_canonical),
                'can_trade' => (bool) $account->can_trade,
            ],
            'pairs' => $pairs,
            'orphan_orders' => [],
            'api_error' => 'Live exchange reconciliation is not available in this console yet; showing database lifecycle state.',
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function history(User $user, int $accountId, int $page = 1, int $perPage = 25): array
    {
        $this->accountQuery($user, $accountId)->firstOrFail();

        /** @var LengthAwarePaginator $paginator */
        $paginator = DB::table('positions')
            ->leftJoin('exchange_symbols', 'exchange_symbols.id', '=', 'positions.exchange_symbol_id')
            ->where('positions.account_id', $accountId)
            ->orderByDesc('positions.created_at')
            ->select([
                'positions.*',
                'exchange_symbols.mark_price',
                'exchange_symbols.token as exchange_token',
                'exchange_symbols.quote as exchange_quote',
            ])
            ->paginate($perPage, ['*'], 'page', $page);

        $items = collect($paginator->items());
        $ordersByPosition = $this->ordersForPositions($items->pluck('id')->all(), false);

        return [
            'positions' => $items
                ->map(function (object $position) use ($ordersByPosition): array {
                    $orders = $ordersByPosition[(int) $position->id] ?? collect();
                    [$pnl, $pnlKind] = $this->computePnl($position);

                    return [
                        'id' => (int) $position->id,
                        'symbol' => $this->positionSymbol($position),
                        'direction' => (string) $position->direction,
                        'status' => (string) $position->status,
                        'quantity' => $this->trimNumber($position->quantity),
                        'opening_price' => $this->trimNumber($position->opening_price),
                        'closing_price' => $this->trimNumber($position->closing_price),
                        'mark_price' => $this->trimNumber($position->mark_price),
                        'leverage' => (string) $position->leverage,
                        'margin' => $this->trimNumber($position->margin),
                        'pnl' => $pnl,
                        'pnl_kind' => $pnlKind,
                        'created_at' => $position->created_at ? date('Y-m-d H:i:s', strtotime((string) $position->created_at)) : null,
                        'closed_at' => $position->closed_at ? date('Y-m-d H:i:s', strtotime((string) $position->closed_at)) : null,
                        'order_count' => $orders->count(),
                        'orders' => $orders->map(fn (object $order): array => $this->dbOrderData($order))->values()->all(),
                        'pnl_projections' => $this->computePnlProjections($position, $orders),
                    ];
                })
                ->all(),
            'page' => $paginator->currentPage(),
            'last_page' => $paginator->lastPage(),
            'per_page' => $paginator->perPage(),
            'total' => $paginator->total(),
        ];
    }

    private function accountQuery(User $user, int $accountId)
    {
        return DB::table('accounts')
            ->leftJoin('api_systems', 'api_systems.id', '=', 'accounts.api_system_id')
            ->where('accounts.user_id', $user->id)
            ->where('accounts.id', $accountId)
            ->whereNull('accounts.deleted_at')
            ->select([
                'accounts.id',
                'accounts.name',
                'accounts.can_trade',
                'accounts.margin_mode',
                'api_systems.name as exchange',
                'api_systems.canonical as exchange_canonical',
            ]);
    }

    private function openPositions(int $accountId): Collection
    {
        return DB::table('positions')
            ->leftJoin('exchange_symbols', 'exchange_symbols.id', '=', 'positions.exchange_symbol_id')
            ->leftJoin('symbols', 'symbols.id', '=', 'exchange_symbols.symbol_id')
            ->where('positions.account_id', $accountId)
            ->whereIn('positions.status', self::OPEN_POSITION_STATUSES)
            ->select('positions.*')
            ->selectRaw('TIMESTAMPDIFF(SECOND, COALESCE(positions.opened_at, positions.created_at), NOW()) as opened_seconds_ago')
            ->addSelect([
                'exchange_symbols.mark_price',
                'exchange_symbols.token as exchange_token',
                'exchange_symbols.quote as exchange_quote',
                'symbols.token as token',
                'symbols.image_url as token_image',
            ])
            ->get();
    }

    /**
     * @param  array<int, int|string>  $positionIds
     * @return array<int, Collection<int, object>>
     */
    private function ordersForPositions(array $positionIds, bool $comparatorOnly): array
    {
        if ($positionIds === []) {
            return [];
        }

        $query = DB::table('orders')
            ->whereIn('position_id', $positionIds)
            ->orderBy('id');

        if ($comparatorOnly) {
            $query->whereIn('status', self::COMPARATOR_ORDER_STATUSES);
        }

        return $query->get()->groupBy('position_id')->all();
    }

    private function buildDbOnlyPair(object $position, Collection $orders, string $accountMarginMode): array
    {
        $db = $this->dbPositionData($position, $accountMarginMode);
        $isActive = ($db['status'] ?? null) === 'active';
        $orderPairs = $orders
            ->map(fn (object $order): array => [
                'status' => self::PAIR_STATUS_SYNCED,
                'db' => $this->dbOrderData($order),
                'exchange' => null,
                'drift_fields' => [],
            ])
            ->values()
            ->all();

        return [
            'symbol' => $this->positionSymbol($position),
            'token' => $position->token ?? $position->exchange_token ?? null,
            'token_image' => $position->token_image ?? null,
            'direction' => (string) $position->direction,
            'status' => $isActive ? self::PAIR_STATUS_DB_ONLY : self::PAIR_STATUS_TRANSIENT,
            'db' => $db,
            'exchange' => null,
            'position_drift_fields' => [],
            'orders' => $orderPairs,
            'order_counts' => $this->countStatuses($orderPairs),
            'pnl_projections' => $this->computePnlProjections($position, $orders),
        ];
    }

    private function dbPositionData(object $position, string $accountMarginMode): array
    {
        return [
            'id' => (int) $position->id,
            'status' => strtolower((string) $position->status),
            'quantity' => $this->trimNumber($position->quantity),
            'entry_price' => $this->trimNumber($position->opening_price),
            'leverage' => (string) $position->leverage,
            'margin' => $this->trimNumber($position->margin),
            'margin_mode' => strtoupper($accountMarginMode),
            'opened_seconds_ago' => $position->opened_seconds_ago !== null ? (int) $position->opened_seconds_ago : null,
            'unrealized_pnl' => null,
        ];
    }

    private function dbOrderData(object $order): array
    {
        return [
            'id' => (int) $order->id,
            'client_order_id' => $order->client_order_id,
            'exchange_order_id' => $order->exchange_order_id,
            'status' => strtoupper((string) $order->status),
            'side' => strtoupper((string) $order->side),
            'type' => strtoupper((string) $order->type),
            'price' => $this->trimNumber($order->price),
            'quantity' => $this->trimNumber($order->quantity),
        ];
    }

    /**
     * @param  array<int, array<string, mixed>>  $orders
     * @return array<string, int>
     */
    private function countStatuses(array $orders): array
    {
        return [
            'total' => count($orders),
            'synced' => collect($orders)->where('status', self::PAIR_STATUS_SYNCED)->count(),
            'drift' => collect($orders)->where('status', 'drift')->count(),
            'db_only' => collect($orders)->where('status', 'db_only')->count(),
            'exchange_only' => collect($orders)->where('status', 'exchange_only')->count(),
        ];
    }

    /**
     * @return array{0: string|null, 1: string|null}
     */
    private function computePnl(object $position): array
    {
        $isClosed = in_array(strtolower((string) $position->status), ['closed', 'cancelled', 'failed'], true);

        if ($isClosed && $position->pnl !== null) {
            return [$this->trimNumber($position->pnl), 'realized'];
        }

        if ($position->opening_price === null || $position->quantity === null) {
            return [null, null];
        }

        if ($isClosed && $position->closing_price !== null) {
            $diff = strtoupper((string) $position->direction) === 'LONG'
                ? (float) $position->closing_price - (float) $position->opening_price
                : (float) $position->opening_price - (float) $position->closing_price;

            return [$this->trimNumber($diff * (float) $position->quantity), 'realized'];
        }

        if ($position->mark_price === null) {
            return [null, null];
        }

        $diff = strtoupper((string) $position->direction) === 'LONG'
            ? (float) $position->mark_price - (float) $position->opening_price
            : (float) $position->opening_price - (float) $position->mark_price;

        return [$this->trimNumber($diff * (float) $position->quantity), 'unrealized'];
    }

    /**
     * @return array<int, array<string, string|null>>
     */
    private function computePnlProjections(object $position, Collection $orders): array
    {
        $direction = strtoupper((string) $position->direction);
        $isLong = $direction === 'LONG';
        $entrySide = $isLong ? 'BUY' : 'SELL';
        $qty = 0.0;
        $weightedCost = 0.0;
        $profitPct = $position->profit_percentage !== null ? (float) $position->profit_percentage / 100 : null;

        return $orders
            ->reject(fn (object $order): bool => in_array(strtoupper((string) $order->status), ['CANCELLED', 'EXPIRED'], true))
            ->filter(fn (object $order): bool => strtoupper((string) $order->side) === $entrySide || str_contains(strtoupper((string) $order->type), 'STOP'))
            ->map(function (object $order) use (&$qty, &$weightedCost, $isLong, $profitPct): array {
                $orderQty = (float) ($order->quantity ?? 0);
                $price = (float) ($order->price ?? 0);

                if (! str_contains(strtoupper((string) $order->type), 'STOP') && $orderQty > 0 && $price > 0) {
                    $qty += $orderQty;
                    $weightedCost += $orderQty * $price;
                }

                $avgEntry = $qty > 0 ? $weightedCost / $qty : null;
                $tpPrice = $avgEntry !== null && $profitPct !== null
                    ? ($isLong ? $avgEntry * (1 + $profitPct) : $avgEntry * (1 - $profitPct))
                    : null;
                $pnlAtFill = $avgEntry !== null && $qty > 0 && $price > 0
                    ? ($isLong ? ($price - $avgEntry) * $qty : ($avgEntry - $price) * $qty)
                    : null;
                $profitAtTp = $avgEntry !== null && $tpPrice !== null && $qty > 0
                    ? ($isLong ? ($tpPrice - $avgEntry) * $qty : ($avgEntry - $tpPrice) * $qty)
                    : null;

                return [
                    'type' => strtoupper((string) $order->type),
                    'side' => strtoupper((string) $order->side),
                    'price' => $this->trimNumber($order->price),
                    'size' => $this->trimNumber($qty),
                    'avg_entry' => $avgEntry === null ? null : $this->trimNumber($avgEntry),
                    'tp_price' => $tpPrice === null ? null : $this->trimNumber($tpPrice),
                    'pnl_at_fill' => $pnlAtFill === null ? null : $this->trimNumber($pnlAtFill),
                    'profit_at_tp' => $profitAtTp === null ? null : $this->trimNumber($profitAtTp),
                ];
            })
            ->values()
            ->all();
    }

    private function positionSymbol(object $position): string
    {
        if ($position->parsed_trading_pair) {
            return (string) $position->parsed_trading_pair;
        }

        if ($position->exchange_token && $position->exchange_quote) {
            return $position->exchange_token.$position->exchange_quote;
        }

        return 'Unknown';
    }

    private function exchangeLogoUrl(?string $canonical): ?string
    {
        if (! $canonical) {
            return null;
        }

        $path = public_path("logos/exchanges/{$canonical}.png");

        return file_exists($path) ? "/logos/exchanges/{$canonical}.png" : null;
    }

    private function trimNumber(mixed $value): string
    {
        if ($value === null || $value === '') {
            return '';
        }

        $number = is_float($value) ? number_format($value, 8, '.', '') : (string) $value;

        if (str_contains($number, '.')) {
            $number = rtrim(rtrim($number, '0'), '.');
        }

        return $number === '' || $number === '-' ? '0' : $number;
    }
}
