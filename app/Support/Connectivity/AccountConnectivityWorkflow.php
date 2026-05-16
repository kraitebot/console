<?php

declare(strict_types=1);

namespace App\Support\Connectivity;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

final class AccountConnectivityWorkflow
{
    private const PENDING = 'StepDispatcher\\States\\Pending';

    private const COMPLETED = 'StepDispatcher\\States\\Completed';

    private const FAILED = 'StepDispatcher\\States\\Failed';

    private const STOPPED = 'StepDispatcher\\States\\Stopped';

    private const PARENT_CLASS = 'Kraite\\Core\\Jobs\\Lifecycles\\Account\\TestExchangeConnectivityStep';

    private const CHILD_CLASS = 'Kraite\\Core\\Jobs\\Atomic\\Account\\TestServerConnectivityStep';

    private const NOTIFY_CLASS = 'Kraite\\Core\\Jobs\\Atomic\\Account\\SendServerNotWhitelistedNotificationStep';

    /**
     * @return array<string, mixed>
     */
    public function start(int $accountId): array
    {
        $blockUuid = (string) Str::uuid();
        $now = now();
        $group = $this->nextDispatchGroup();

        DB::table('steps')->insert([
            'block_uuid' => $blockUuid,
            'type' => 'default',
            'group' => $group,
            'state' => self::PENDING,
            'class' => self::PARENT_CLASS,
            'index' => 1,
            'relatable_type' => 'Kraite\\Core\\Models\\Account',
            'relatable_id' => $accountId,
            'workflow_id' => (string) Str::uuid(),
            'queue' => 'cronjobs',
            'arguments' => json_encode(['accountId' => $accountId], JSON_THROW_ON_ERROR),
            'retries' => 0,
            'was_throttled' => 0,
            'is_throttled' => 0,
            'duration' => 0,
            'was_notified' => 0,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        return $this->status($blockUuid);
    }

    /**
     * @return array<string, mixed>
     */
    public function status(string $blockUuid): array
    {
        $parent = DB::table('steps')
            ->where('block_uuid', $blockUuid)
            ->where('class', self::PARENT_CLASS)
            ->first();

        if (! $parent) {
            return [
                'block_uuid' => $blockUuid,
                'is_complete' => true,
                'servers' => [],
            ];
        }

        $servers = $this->servers();
        $children = $parent->child_block_uuid
            ? DB::table('steps')->where('block_uuid', $parent->child_block_uuid)->where('class', self::CHILD_CLASS)->get()->keyBy(fn (object $step): int => (int) (json_decode((string) $step->arguments, true)['serverId'] ?? 0))
            : collect();

        $rows = $servers->map(function (object $server) use ($children): array {
            $step = $children->get((int) $server->id);

            if (! $step) {
                return $this->serverPayload($server, 'testing');
            }

            return $this->serverPayload($server, $this->statusForState((string) $step->state), $step);
        })->values();

        $isComplete = $rows->isEmpty()
            || ($children->count() >= $servers->count()
                && $children->every(fn (object $step): bool => in_array((string) $step->state, [self::COMPLETED, self::FAILED, self::STOPPED], true)));

        return [
            'block_uuid' => $blockUuid,
            'is_complete' => $isComplete,
            'servers' => $rows->all(),
        ];
    }

    public function queueNotification(int $accountId, int $serverId): void
    {
        $now = now();
        $group = $this->nextDispatchGroup();

        DB::table('steps')->insert([
            'block_uuid' => (string) Str::uuid(),
            'type' => 'default',
            'group' => $group,
            'state' => self::PENDING,
            'class' => self::NOTIFY_CLASS,
            'index' => 1,
            'relatable_type' => 'Kraite\\Core\\Models\\Account',
            'relatable_id' => $accountId,
            'workflow_id' => (string) Str::uuid(),
            'queue' => 'cronjobs',
            'arguments' => json_encode(['accountId' => $accountId, 'serverId' => $serverId], JSON_THROW_ON_ERROR),
            'retries' => 0,
            'was_throttled' => 0,
            'is_throttled' => 0,
            'duration' => 0,
            'was_notified' => 0,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }

    private function servers()
    {
        return DB::table('servers')
            ->where('is_apiable', true)
            ->where('needs_whitelisting', true)
            ->whereNotNull('ip_address')
            ->whereNotIn('type', ['database', 'admin', 'indicators'])
            ->whereNotIn('hostname', ['artemis'])
            ->orderBy('hostname')
            ->get();
    }

    private function nextDispatchGroup(): ?string
    {
        $row = DB::table('steps_dispatcher')
            ->whereNotNull('group')
            ->where('can_dispatch', true)
            ->orderBy('last_selected_at')
            ->first();

        if (! $row) {
            return null;
        }

        DB::table('steps_dispatcher')
            ->where('id', $row->id)
            ->update([
                'last_selected_at' => now(),
                'updated_at' => now(),
            ]);

        return (string) $row->group;
    }

    private function statusForState(string $state): string
    {
        return match ($state) {
            self::COMPLETED => 'connected',
            self::FAILED, self::STOPPED => 'not_connected',
            default => 'testing',
        };
    }

    /**
     * @return array<string, mixed>
     */
    private function serverPayload(object $server, string $status, ?object $step = null): array
    {
        return [
            'id' => (int) $server->id,
            'hostname' => (string) $server->hostname,
            'ip_address' => (string) $server->ip_address,
            'queue' => (string) ($server->own_queue_name ?: 'default'),
            'status' => $status,
            'step_id' => $step?->id,
            'error_message' => $step?->error_message,
            'can_notify_user' => $status === 'not_connected',
        ];
    }
}
