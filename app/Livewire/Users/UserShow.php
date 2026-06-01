<?php

declare(strict_types=1);

namespace App\Livewire\Users;

use App\Livewire\Concerns\LoadsTabsLazily;
use App\Models\User;
use App\Support\Connectivity\AccountConnectivityWorkflow;
use App\Support\Positions\UserPositionsReconciler;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.admin')]
final class UserShow extends Component
{
    use LoadsTabsLazily;
    use WithFileUploads;

    /**
     * api_systems only distinguishes exchanges from non-exchanges today.
     * Account creation is narrower: show only exchanges Kraite currently supports for new managed accounts.
     *
     * @var array<int, string>
     */
    private const ACCOUNT_CREATION_EXCHANGES = ['binance', 'bitget'];

    public User $user;

    public string $name = '';

    public string $email = '';

    public string $avatar = '';

    public mixed $avatarImage = null;

    public bool $removeAvatar = false;

    public string $status = 'pending';

    public bool $is_admin = false;

    #[Url(as: 'tab', except: 'details')]
    public string $tab = 'details';

    /** @var array<int, string> */
    public array $tabs = ['details', 'accounts', 'positions', 'billing'];

    /** @var array<string, int> */
    public array $tabCounts = [];

    /** @var array<int, array<string, mixed>> */
    public array $accounts = [];

    /** @var array<int, array<string, mixed>> */
    public array $accountForms = [];

    /** @var array<int, array<int, string>> */
    public array $accountQuoteOptions = [];

    /** @var array<int, int> */
    public array $leverageOptions = [10, 15, 20];

    public bool $isCreatingAccount = false;

    /** @var array<string, mixed> */
    public array $newAccountForm = [];

    /** @var array<int, array{id: int, name: string, canonical: string}> */
    public array $accountApiSystemOptions = [];

    /** @var array<int, array{id: int, canonical: string}> */
    public array $tradeConfigurationOptions = [];

    /** @var array<int, string> */
    public array $newAccountQuoteOptions = [];

    /** @var array<int, bool> */
    public array $expandedAccounts = [];

    /** @var array<int, array<string, mixed>> */
    public array $accountConnectivity = [];

    /** @var array<int, array<string, mixed>> */
    public array $positionAccounts = [];

    public ?int $selectedPositionAccountId = null;

    /** @var array<string, mixed>|null */
    public ?array $positionData = null;

    /** @var array<int, array<string, mixed>> */
    public array $positionHistory = [];

    public int $positionHistoryPage = 1;

    public int $positionHistoryLastPage = 1;

    public int $positionHistoryPerPage = 25;

    public int $positionHistoryTotal = 0;

    public bool $onlyPositionDrifts = false;

    /** @var array<string, bool> */
    public array $expandedPositionPairs = [];

    /** @var array<int, bool> */
    public array $expandedPositionHistory = [];

    public ?string $flashToastMessage = null;

    public function mount(User $user): void
    {
        $this->user = $user;
        $this->markTabLoaded('details');
        $this->fillFromUser();
        $this->loadTabCounts();
        $this->loadSelectedTab();

        if (session()->has('flash')) {
            $this->flashToastMessage = session('flash');
        }
    }

    public function selectTab(string $tab): void
    {
        if (in_array($tab, $this->tabs, true)) {
            $this->tab = $tab;
            $this->loadSelectedTab();
        }
    }

    public function toggleAccount(int $accountId): void
    {
        $this->expandedAccounts[$accountId] = ! ($this->expandedAccounts[$accountId] ?? false);
    }

    public function startAccountConnectivity(int $accountId): void
    {
        if (! $this->userOwnsAccount($accountId)) {
            return;
        }

        $this->accountConnectivity[$accountId] = app(AccountConnectivityWorkflow::class)->start($accountId);

        $this->dispatch('notify', message: 'Server connectivity test started.', type: 'success');
    }

    public function pollAccountConnectivity(int $accountId): void
    {
        $blockUuid = $this->accountConnectivity[$accountId]['block_uuid'] ?? null;

        if (! $blockUuid || ($this->accountConnectivity[$accountId]['is_complete'] ?? false)) {
            return;
        }

        $previousComplete = (bool) ($this->accountConnectivity[$accountId]['is_complete'] ?? false);
        $this->accountConnectivity[$accountId] = app(AccountConnectivityWorkflow::class)->status((string) $blockUuid);

        if (! $previousComplete && ($this->accountConnectivity[$accountId]['is_complete'] ?? false)) {
            $this->dispatch('notify', message: 'Test connectivity finished.', type: 'success');
        }
    }

    public function sendConnectivityNotification(int $accountId, int $serverId): void
    {
        if (! $this->userOwnsAccount($accountId)) {
            return;
        }

        app(AccountConnectivityWorkflow::class)->queueNotification($accountId, $serverId);

        $this->dispatch('notify', message: 'Notification sent to user.', type: 'success');
    }

    public function selectPositionAccount(int $accountId): void
    {
        if ($this->selectedPositionAccountId === $accountId) {
            $this->refreshPositions();

            return;
        }

        $this->selectedPositionAccountId = $accountId;
        $this->positionHistoryPage = 1;
        $this->expandedPositionPairs = [];
        $this->expandedPositionHistory = [];
        $this->refreshPositions();
    }

    public function refreshPositions(): void
    {
        if (! $this->selectedPositionAccountId) {
            $this->positionData = null;
            $this->positionHistory = [];

            return;
        }

        $reconciler = app(UserPositionsReconciler::class);
        $this->positionData = $reconciler->accountData($this->user, $this->selectedPositionAccountId);
        $this->loadPositionHistory();
    }

    public function loadPositionHistory(?int $page = null): void
    {
        if (! $this->selectedPositionAccountId) {
            return;
        }

        if ($page !== null) {
            $this->positionHistoryPage = max(1, $page);
        }

        $history = app(UserPositionsReconciler::class)->history(
            user: $this->user,
            accountId: $this->selectedPositionAccountId,
            page: $this->positionHistoryPage,
            perPage: $this->positionHistoryPerPage,
        );

        $this->positionHistory = $history['positions'];
        $this->positionHistoryPage = $history['page'];
        $this->positionHistoryLastPage = $history['last_page'];
        $this->positionHistoryPerPage = $history['per_page'];
        $this->positionHistoryTotal = $history['total'];
    }

    public function togglePositionPair(string $key): void
    {
        $this->expandedPositionPairs[$key] = ! ($this->expandedPositionPairs[$key] ?? false);
    }

    public function togglePositionHistory(int $positionId): void
    {
        $this->expandedPositionHistory[$positionId] = ! ($this->expandedPositionHistory[$positionId] ?? false);
    }

    /**
     * @return array<string, mixed>
     */
    protected function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($this->user->id)],
            'avatarImage' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,gif', 'max:2048'],
            'status' => ['required', Rule::in(['pending', 'confirmed', 'active', 'suspended'])],
            'is_admin' => ['boolean'],
        ];
    }

    public function save(): void
    {
        $this->name = trim($this->name);
        $this->email = mb_strtolower(trim($this->email));

        $data = $this->validate();
        $data['avatar'] = $this->resolvedAvatarPath();
        unset($data['avatarImage']);

        $this->user->update($data);
        $this->user->refresh();
        $this->fillFromUser();

        $this->dispatch(
            'page-transition:navigate',
            url: route('users.index'),
            toast: [
                'message' => "User {$this->user->name} updated.",
                'type' => 'success',
            ],
        );
    }

    public function removeAvatar(): void
    {
        $this->avatar = '';
        $this->avatarImage = null;
        $this->removeAvatar = true;
    }

    public function clearAccountMarginPercentages(int $accountId): void
    {
        if (! $this->hasDecimalValue($this->accountForms[$accountId]['margin'] ?? null)) {
            return;
        }

        $this->accountForms[$accountId]['margin_percentage_long'] = '';
        $this->accountForms[$accountId]['margin_percentage_short'] = '';
    }

    public function clearAccountAbsoluteMargin(int $accountId): void
    {
        $hasLongMarginPercent = $this->hasDecimalValue($this->accountForms[$accountId]['margin_percentage_long'] ?? null);
        $hasShortMarginPercent = $this->hasDecimalValue($this->accountForms[$accountId]['margin_percentage_short'] ?? null);

        if (! $hasLongMarginPercent && ! $hasShortMarginPercent) {
            return;
        }

        $this->accountForms[$accountId]['margin'] = '';
    }

    public function showCreateAccountForm(): void
    {
        $this->loadAccountCreationOptions();
        $this->isCreatingAccount = true;
    }

    public function cancelCreateAccount(): void
    {
        $this->isCreatingAccount = false;
        $this->newAccountForm = [];
        $this->resetValidation([
            'newAccountForm.name',
            'newAccountForm.api_system_id',
            'newAccountForm.trade_configuration_id',
            'newAccountForm.portfolio_quote',
            'newAccountForm.trading_quote',
            'newAccountForm.balance_for_trading_basis',
            'newAccountForm.margin',
            'newAccountForm.margin_percentage_long',
            'newAccountForm.margin_percentage_short',
        ]);
    }

    public function refreshNewAccountQuoteOptions(): void
    {
        $apiSystemId = (int) ($this->newAccountForm['api_system_id'] ?? 0);
        $this->newAccountQuoteOptions = $this->quoteOptionsForApiSystem($apiSystemId);
        $apiSystem = collect($this->accountApiSystemOptions)->firstWhere('id', $apiSystemId);
        $canonical = (string) ($apiSystem['canonical'] ?? '');

        foreach (['portfolio_quote', 'trading_quote'] as $field) {
            if (! in_array($this->newAccountForm[$field] ?? null, $this->newAccountQuoteOptions, true)) {
                $this->newAccountForm[$field] = $this->newAccountQuoteOptions[0] ?? 'USDT';
            }
        }

        if (! in_array($canonical, ['kucoin', 'bitget'], true)) {
            $this->newAccountForm['api_passphrase'] = '';
        }

        if (! in_array($canonical, ['binance', 'bybit', 'kucoin', 'bitget', 'kraken'], true)) {
            $this->newAccountForm['api_key'] = '';
            $this->newAccountForm['api_secret'] = '';
        }
    }

    public function clearNewAccountMarginPercentages(): void
    {
        if (! $this->hasDecimalValue($this->newAccountForm['margin'] ?? null)) {
            return;
        }

        $this->newAccountForm['margin_percentage_long'] = '';
        $this->newAccountForm['margin_percentage_short'] = '';
    }

    public function clearNewAccountAbsoluteMargin(): void
    {
        $hasLongMarginPercent = $this->hasDecimalValue($this->newAccountForm['margin_percentage_long'] ?? null);
        $hasShortMarginPercent = $this->hasDecimalValue($this->newAccountForm['margin_percentage_short'] ?? null);

        if (! $hasLongMarginPercent && ! $hasShortMarginPercent) {
            return;
        }

        $this->newAccountForm['margin'] = '';
    }

    public function saveNewAccount(): void
    {
        $this->loadAccountCreationOptions();

        $this->newAccountForm['name'] = trim((string) ($this->newAccountForm['name'] ?? ''));
        $this->newAccountForm['portfolio_quote'] = trim((string) ($this->newAccountForm['portfolio_quote'] ?? ''));
        $this->newAccountForm['trading_quote'] = trim((string) ($this->newAccountForm['trading_quote'] ?? ''));

        $validator = Validator::make(['newAccountForm' => $this->newAccountForm], [
            'newAccountForm.name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('accounts', 'name')->where(fn ($query) => $query->where('user_id', $this->user->id)),
            ],
            'newAccountForm.api_system_id' => ['required', 'integer', Rule::in(collect($this->accountApiSystemOptions)->pluck('id')->all())],
            'newAccountForm.trade_configuration_id' => ['required', 'integer', Rule::in(collect($this->tradeConfigurationOptions)->pluck('id')->all())],
            'newAccountForm.portfolio_quote' => ['required', 'string', 'max:20', Rule::in($this->newAccountQuoteOptions)],
            'newAccountForm.trading_quote' => ['required', 'string', 'max:20', Rule::in($this->newAccountQuoteOptions)],
            'newAccountForm.balance_for_trading_basis' => ['required', Rule::in(['total', 'available'])],
            'newAccountForm.margin' => ['nullable', 'numeric', 'min:0', 'regex:/^\d{1,12}(\.\d{1,8})?$/'],
            'newAccountForm.can_trade' => ['boolean'],
            'newAccountForm.is_active' => ['boolean'],
            'newAccountForm.margin_mode' => ['required', Rule::in(['crossed', 'isolated'])],
            'newAccountForm.position_leverage_long' => ['required', 'integer', Rule::in($this->leverageOptions)],
            'newAccountForm.position_leverage_short' => ['required', 'integer', Rule::in($this->leverageOptions)],
            'newAccountForm.margin_percentage_long' => ['nullable', 'numeric', 'min:1', 'max:5', 'regex:/^\d(\.\d{1,2})?$/'],
            'newAccountForm.margin_percentage_short' => ['nullable', 'numeric', 'min:1', 'max:5', 'regex:/^\d(\.\d{1,2})?$/'],
            'newAccountForm.allow_other_positions' => ['boolean'],
            'newAccountForm.allow_other_orders' => ['boolean'],
            'newAccountForm.api_key' => ['nullable', 'string', 'max:4096'],
            'newAccountForm.api_secret' => ['nullable', 'string', 'max:4096'],
            'newAccountForm.api_passphrase' => ['nullable', 'string', 'max:4096'],
        ], [
            'newAccountForm.name.unique' => 'This user already has an account with this name.',
            'newAccountForm.margin.regex' => 'Margin accepts up to 12 whole digits and 8 decimal places.',
            'newAccountForm.margin_percentage_long.regex' => 'Long margin percentage accepts up to 2 decimal places.',
            'newAccountForm.margin_percentage_short.regex' => 'Short margin percentage accepts up to 2 decimal places.',
        ]);

        $validator->after(function ($validator): void {
            $form = $this->newAccountForm;
            $hasMargin = $this->hasDecimalValue($form['margin'] ?? null);
            $hasLongMarginPercent = $this->hasDecimalValue($form['margin_percentage_long'] ?? null);
            $hasShortMarginPercent = $this->hasDecimalValue($form['margin_percentage_short'] ?? null);

            if ($hasMargin && ($hasLongMarginPercent || $hasShortMarginPercent)) {
                $validator->errors()->add('newAccountForm.margin', 'Use either absolute margin or margin percentages, not both.');
                $validator->errors()->add('newAccountForm.margin_percentage_long', 'Clear margin percentages when absolute margin is set.');
                $validator->errors()->add('newAccountForm.margin_percentage_short', 'Clear margin percentages when absolute margin is set.');
            }

            if (! $hasMargin && (! $hasLongMarginPercent || ! $hasShortMarginPercent)) {
                $validator->errors()->add('newAccountForm.margin_percentage_long', 'Long and short margin percentages are required when absolute margin is empty.');
                $validator->errors()->add('newAccountForm.margin_percentage_short', 'Long and short margin percentages are required when absolute margin is empty.');
            }
        });

        $validator->validate();

        $form = $this->newAccountForm;
        $apiSystem = collect($this->accountApiSystemOptions)->firstWhere('id', (int) $form['api_system_id']);
        $hasMargin = $this->hasDecimalValue($form['margin'] ?? null);
        $now = now();

        $values = [
            'uuid' => (string) Str::uuid(),
            'name' => trim((string) $form['name']),
            'user_id' => $this->user->id,
            'api_system_id' => (int) $form['api_system_id'],
            'trade_configuration_id' => (int) $form['trade_configuration_id'],
            'portfolio_quote' => $form['portfolio_quote'],
            'trading_quote' => $form['trading_quote'],
            'balance_for_trading_basis' => $form['balance_for_trading_basis'] ?? 'total',
            'margin' => $hasMargin ? $form['margin'] : null,
            'can_trade' => (bool) ($form['can_trade'] ?? false),
            'is_active' => (bool) ($form['is_active'] ?? true),
            'profit_percentage' => '0.010',
            'total_limit_orders_filled_to_notify' => 0,
            'stop_market_initial_percentage' => '2.50',
            'total_positions_short' => 0,
            'total_positions_long' => 0,
            'position_leverage_short' => (int) $form['position_leverage_short'],
            'position_leverage_long' => (int) $form['position_leverage_long'],
            'margin_percentage_short' => $hasMargin ? null : $this->percentInputToRatio($form['margin_percentage_short']),
            'margin_percentage_long' => $hasMargin ? null : $this->percentInputToRatio($form['margin_percentage_long']),
            'margin_mode' => $form['margin_mode'],
            'on_hedge_mode' => false,
            'allow_other_positions' => (bool) ($form['allow_other_positions'] ?? false),
            'allow_other_orders' => (bool) ($form['allow_other_orders'] ?? false),
            'created_at' => $now,
            'updated_at' => $now,
        ];

        $this->applyExchangeCredentialValues(
            values: $values,
            canonical: (string) ($apiSystem['canonical'] ?? ''),
            apiKey: $form['api_key'] ?? null,
            apiSecret: $form['api_secret'] ?? null,
            apiPassphrase: $form['api_passphrase'] ?? null,
        );

        $accountId = (int) DB::table('accounts')->insertGetId($values);

        $this->isCreatingAccount = false;
        $this->newAccountForm = [];
        $this->loadAccounts(force: true);
        $this->loadTabCounts();
        $this->expandedAccounts[$accountId] = true;

        $this->dispatch('notify', message: 'Account created.', type: 'success');
    }

    public function saveAccount(int $accountId): void
    {
        $form = $this->accountForms[$accountId] ?? null;

        if (! $form) {
            return;
        }

        $this->accountForms[$accountId]['name'] = trim((string) ($form['name'] ?? ''));
        $this->accountForms[$accountId]['portfolio_quote'] = trim((string) ($form['portfolio_quote'] ?? ''));
        $this->accountForms[$accountId]['trading_quote'] = trim((string) ($form['trading_quote'] ?? ''));
        $form = $this->accountForms[$accountId];

        $validator = Validator::make(['accountForms' => $this->accountForms], [
            "accountForms.{$accountId}.name" => ['required', 'string', 'max:255'],
            "accountForms.{$accountId}.portfolio_quote" => ['required', 'string', 'max:20', Rule::in($this->accountQuoteOptions[$accountId] ?? [])],
            "accountForms.{$accountId}.trading_quote" => ['required', 'string', 'max:20', Rule::in($this->accountQuoteOptions[$accountId] ?? [])],
            "accountForms.{$accountId}.balance_for_trading_basis" => ['required', Rule::in(['total', 'available'])],
            "accountForms.{$accountId}.margin" => ['nullable', 'numeric', 'min:0', 'regex:/^\d{1,12}(\.\d{1,8})?$/'],
            "accountForms.{$accountId}.can_trade" => ['boolean'],
            "accountForms.{$accountId}.is_active" => ['boolean'],
            "accountForms.{$accountId}.margin_mode" => ['required', Rule::in(['crossed', 'isolated'])],
            "accountForms.{$accountId}.position_leverage_long" => ['required', 'integer', Rule::in($this->leverageOptions)],
            "accountForms.{$accountId}.position_leverage_short" => ['required', 'integer', Rule::in($this->leverageOptions)],
            "accountForms.{$accountId}.margin_percentage_long" => ['nullable', 'numeric', 'min:1', 'max:5', 'regex:/^\d(\.\d{1,2})?$/'],
            "accountForms.{$accountId}.margin_percentage_short" => ['nullable', 'numeric', 'min:1', 'max:5', 'regex:/^\d(\.\d{1,2})?$/'],
            "accountForms.{$accountId}.allow_other_positions" => ['boolean'],
            "accountForms.{$accountId}.allow_other_orders" => ['boolean'],
        ], [
            "accountForms.{$accountId}.margin.regex" => 'Margin accepts up to 12 whole digits and 8 decimal places.',
            "accountForms.{$accountId}.margin_percentage_long.regex" => 'Long margin percentage accepts up to 2 decimal places.',
            "accountForms.{$accountId}.margin_percentage_short.regex" => 'Short margin percentage accepts up to 2 decimal places.',
        ]);

        $validator->after(function ($validator) use ($accountId, $form): void {
            $hasMargin = $this->hasDecimalValue($form['margin'] ?? null);
            $hasLongMarginPercent = $this->hasDecimalValue($form['margin_percentage_long'] ?? null);
            $hasShortMarginPercent = $this->hasDecimalValue($form['margin_percentage_short'] ?? null);

            if ($hasMargin && ($hasLongMarginPercent || $hasShortMarginPercent)) {
                $validator->errors()->add("accountForms.{$accountId}.margin", 'Use either absolute margin or margin percentages, not both.');
                $validator->errors()->add("accountForms.{$accountId}.margin_percentage_long", 'Clear margin percentages when absolute margin is set.');
                $validator->errors()->add("accountForms.{$accountId}.margin_percentage_short", 'Clear margin percentages when absolute margin is set.');
            }

            if (! $hasMargin && (! $hasLongMarginPercent || ! $hasShortMarginPercent)) {
                $validator->errors()->add("accountForms.{$accountId}.margin_percentage_long", 'Long and short margin percentages are required when absolute margin is empty.');
                $validator->errors()->add("accountForms.{$accountId}.margin_percentage_short", 'Long and short margin percentages are required when absolute margin is empty.');
            }

            $maxMargin = $this->accountMaxAbsoluteMargin($accountId);

            if ($hasMargin && $maxMargin !== null && (float) $form['margin'] > $maxMargin) {
                $validator->errors()->add(
                    "accountForms.{$accountId}.margin",
                    'Absolute margin cannot exceed 5% of the latest total balance (max '.number_format($maxMargin, 2, '.', '').').',
                );
            }
        });

        $validator->validate();

        $form = $this->accountForms[$accountId];
        $hasMargin = $this->hasDecimalValue($form['margin'] ?? null);
        $updates = [
            'name' => trim((string) $form['name']),
            'portfolio_quote' => $form['portfolio_quote'],
            'trading_quote' => $form['trading_quote'],
            'balance_for_trading_basis' => $form['balance_for_trading_basis'] ?? 'total',
            'margin' => $hasMargin ? $form['margin'] : null,
            'can_trade' => (bool) $form['can_trade'],
            'is_active' => (bool) $form['is_active'],
            'margin_mode' => $form['margin_mode'],
            'position_leverage_long' => (int) $form['position_leverage_long'],
            'position_leverage_short' => (int) $form['position_leverage_short'],
            'allow_other_positions' => (bool) $form['allow_other_positions'],
            'allow_other_orders' => (bool) $form['allow_other_orders'],
            'updated_at' => now(),
        ];

        if (! $hasMargin) {
            $updates['margin_percentage_long'] = $this->percentInputToRatio($form['margin_percentage_long']);
            $updates['margin_percentage_short'] = $this->percentInputToRatio($form['margin_percentage_short']);
        }

        DB::table('accounts')
            ->where('id', $accountId)
            ->where('user_id', $this->user->id)
            ->update($updates);

        $this->loadAccounts(force: true);
        $this->loadTabCounts();
        $this->expandedAccounts[$accountId] = true;

        $this->dispatch('notify', message: 'Account updated.', type: 'success');
    }

    public function getTitleProperty(): string
    {
        return $this->user->name.' - Users - Kraite Console';
    }

    public function render(): View
    {
        return view('livewire.users.show')->title($this->getTitleProperty());
    }

    private function fillFromUser(): void
    {
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->avatar = $this->user->avatar ?? '';
        $this->removeAvatar = false;
        $this->status = $this->user->status ?? 'pending';
        $this->is_admin = (bool) $this->user->is_admin;
    }

    private function loadTabCounts(): void
    {
        $accountIds = DB::table('accounts')
            ->where('user_id', $this->user->id)
            ->pluck('id');

        $this->tabCounts = [
            'accounts' => $accountIds->count(),
            'positions' => $accountIds->isEmpty()
                ? 0
                : DB::table('positions')->whereIn('account_id', $accountIds)->count(),
            'billing' => DB::table('payments')->where('user_id', $this->user->id)->count()
                + DB::table('wallet_transactions')->where('user_id', $this->user->id)->count(),
        ];
    }

    private function loadSelectedTab(): void
    {
        if ($this->tab === 'accounts') {
            $this->loadAccounts();
        }

        if ($this->tab === 'positions') {
            $this->loadPositions();
        }
    }

    private function loadPositions(bool $force = false): void
    {
        if ($this->isTabLoaded('positions') && ! $force) {
            return;
        }

        $this->positionAccounts = app(UserPositionsReconciler::class)->accountsForUser($this->user);
        $this->selectedPositionAccountId ??= $this->positionAccounts[0]['id'] ?? null;

        if ($this->selectedPositionAccountId) {
            $this->refreshPositions();
        }

        $this->markTabLoaded('positions');
    }

    private function loadAccountCreationOptions(): void
    {
        if ($this->accountApiSystemOptions === []) {
            $this->accountApiSystemOptions = DB::table('api_systems')
                ->where('is_exchange', true)
                ->whereIn('canonical', self::ACCOUNT_CREATION_EXCHANGES)
                ->orderByRaw("CASE canonical WHEN 'binance' THEN 0 WHEN 'bitget' THEN 1 ELSE 2 END")
                ->orderBy('name')
                ->get(['id', 'name', 'canonical'])
                ->map(fn (object $apiSystem): array => [
                    'id' => (int) $apiSystem->id,
                    'name' => (string) $apiSystem->name,
                    'canonical' => (string) $apiSystem->canonical,
                ])
                ->all();
        }

        if ($this->tradeConfigurationOptions === []) {
            $this->tradeConfigurationOptions = DB::table('trade_configuration')
                ->orderByDesc('is_default')
                ->orderBy('canonical')
                ->get(['id', 'canonical'])
                ->map(fn (object $configuration): array => [
                    'id' => (int) $configuration->id,
                    'canonical' => (string) $configuration->canonical,
                ])
                ->all();
        }

        if ($this->newAccountForm === []) {
            $defaultApiSystemId = $this->accountApiSystemOptions[0]['id'] ?? null;
            $defaultTradeConfigurationId = $this->tradeConfigurationOptions[0]['id'] ?? null;
            $this->newAccountQuoteOptions = $this->quoteOptionsForApiSystem((int) $defaultApiSystemId);

            $this->newAccountForm = [
                'name' => '',
                'api_system_id' => $defaultApiSystemId,
                'trade_configuration_id' => $defaultTradeConfigurationId,
                'portfolio_quote' => $this->newAccountQuoteOptions[0] ?? 'USDT',
                'trading_quote' => $this->newAccountQuoteOptions[0] ?? 'USDT',
                'balance_for_trading_basis' => 'total',
                'margin' => '',
                'can_trade' => false,
                'is_active' => true,
                'margin_mode' => 'crossed',
                'position_leverage_long' => 20,
                'position_leverage_short' => 15,
                'margin_percentage_long' => '5.00',
                'margin_percentage_short' => '5.00',
                'allow_other_positions' => false,
                'allow_other_orders' => false,
                'api_key' => '',
                'api_secret' => '',
                'api_passphrase' => '',
            ];
        }

        if ($this->newAccountQuoteOptions === []) {
            $this->newAccountQuoteOptions = $this->quoteOptionsForApiSystem((int) ($this->newAccountForm['api_system_id'] ?? 0));
        }
    }

    /**
     * @return array<int, string>
     */
    private function quoteOptionsForApiSystem(int $apiSystemId): array
    {
        $quotes = DB::table('exchange_symbols')
            ->when($apiSystemId > 0, fn ($query) => $query->where('api_system_id', $apiSystemId))
            ->whereNotNull('quote')
            ->distinct()
            ->orderByRaw("CASE quote WHEN 'USDT' THEN 0 WHEN 'USDC' THEN 1 WHEN 'BTC' THEN 2 ELSE 3 END")
            ->orderBy('quote')
            ->pluck('quote')
            ->values()
            ->all();

        return $quotes === [] ? ['USDT', 'USDC', 'BTC'] : $quotes;
    }

    /**
     * @param  array<string, mixed>  $values
     */
    private function applyExchangeCredentialValues(array &$values, string $canonical, mixed $apiKey, mixed $apiSecret, mixed $apiPassphrase): void
    {
        $apiKey = trim((string) $apiKey) ?: null;
        $apiSecret = trim((string) $apiSecret) ?: null;
        $apiPassphrase = trim((string) $apiPassphrase) ?: null;

        $apiKey = $apiKey === null ? null : Crypt::encryptString($apiKey);
        $apiSecret = $apiSecret === null ? null : Crypt::encryptString($apiSecret);
        $apiPassphrase = $apiPassphrase === null ? null : Crypt::encryptString($apiPassphrase);

        match ($canonical) {
            'binance' => [
                $values['binance_api_key'] = $apiKey,
                $values['binance_api_secret'] = $apiSecret,
            ],
            'bybit' => [
                $values['bybit_api_key'] = $apiKey,
                $values['bybit_api_secret'] = $apiSecret,
            ],
            'kucoin' => [
                $values['kucoin_api_key'] = $apiKey,
                $values['kucoin_api_secret'] = $apiSecret,
                $values['kucoin_passphrase'] = $apiPassphrase,
            ],
            'bitget' => [
                $values['bitget_api_key'] = $apiKey,
                $values['bitget_api_secret'] = $apiSecret,
                $values['bitget_passphrase'] = $apiPassphrase,
            ],
            'kraken' => [
                $values['kraken_api_key'] = $apiKey,
                $values['kraken_private_key'] = $apiSecret,
            ],
            default => null,
        };
    }

    private function loadAccounts(bool $force = false): void
    {
        if ($this->isTabLoaded('accounts') && ! $force) {
            return;
        }

        $accounts = DB::table('accounts')
            ->leftJoin('api_systems', 'api_systems.id', '=', 'accounts.api_system_id')
            ->leftJoin('trade_configuration', 'trade_configuration.id', '=', 'accounts.trade_configuration_id')
            ->where('accounts.user_id', $this->user->id)
            ->orderByDesc('accounts.is_active')
            ->orderBy('accounts.name')
            ->select([
                'accounts.id',
                'accounts.uuid',
                'accounts.name',
                'accounts.api_system_id',
                'accounts.trade_configuration_id',
                'accounts.portfolio_quote',
                'accounts.trading_quote',
                'accounts.balance_for_trading_basis',
                'accounts.margin',
                'accounts.can_trade',
                'accounts.is_active',
                'accounts.disabled_reason',
                'accounts.disabled_at',
                'accounts.profit_percentage',
                'accounts.total_positions_short',
                'accounts.total_positions_long',
                'accounts.position_leverage_short',
                'accounts.margin_percentage_short',
                'accounts.position_leverage_long',
                'accounts.margin_percentage_long',
                'accounts.margin_mode',
                'accounts.on_hedge_mode',
                'accounts.allow_other_positions',
                'accounts.allow_other_orders',
                'accounts.created_at',
                'accounts.updated_at',
                'api_systems.name as exchange_name',
                'api_systems.canonical as exchange_canonical',
                'trade_configuration.canonical as trade_configuration_canonical',
            ])
            ->get()
            ->map(function (object $account): array {
                $data = (array) $account;
                $data['open_positions_count'] = DB::table('positions')
                    ->where('account_id', $account->id)
                    ->where(function ($query): void {
                        $query->where('is_open', true)
                            ->orWhereNotIn('status', ['CLOSED', 'CANCELLED', 'closed', 'cancelled']);
                    })
                    ->count();
                $balance = $this->accountBalanceContext($data);

                $data['total_wallet_balance'] = $balance['total_wallet_balance'];
                $data['available_balance'] = $balance['available_balance'];
                $data['balance_for_trading'] = $balance['balance_for_trading'];
                $data['balance_source'] = $balance['balance_source'];
                $data['margin_limit_balance'] = $balance['margin_limit_balance'];
                $data['max_margin_amount'] = $balance['max_margin_amount'];

                return $data;
            })
            ->values()
            ->all();

        $this->accounts = $accounts;
        $this->accountForms = [];
        $this->accountQuoteOptions = [];

        foreach ($accounts as $index => $account) {
            $accountId = (int) $account['id'];
            $quoteOptions = DB::table('exchange_symbols')
                ->where('api_system_id', $account['api_system_id'])
                ->whereNotNull('quote')
                ->distinct()
                ->orderByRaw("CASE quote WHEN 'USDT' THEN 0 WHEN 'USDC' THEN 1 WHEN 'BTC' THEN 2 ELSE 3 END")
                ->orderBy('quote')
                ->pluck('quote')
                ->values()
                ->all();

            foreach (['portfolio_quote', 'trading_quote'] as $field) {
                if ($account[$field] && ! in_array($account[$field], $quoteOptions, true)) {
                    $quoteOptions[] = $account[$field];
                }
            }

            $this->accountQuoteOptions[$accountId] = $quoteOptions;
            $this->accountForms[$accountId] = [
                'name' => $account['name'],
                'portfolio_quote' => $account['portfolio_quote'],
                'trading_quote' => $account['trading_quote'],
                'balance_for_trading_basis' => $account['balance_for_trading_basis'] ?: 'total',
                'margin' => $account['margin'],
                'can_trade' => (bool) $account['can_trade'],
                'is_active' => (bool) $account['is_active'],
                'margin_mode' => $account['margin_mode'],
                'position_leverage_long' => $account['position_leverage_long'],
                'position_leverage_short' => $account['position_leverage_short'],
                'margin_percentage_long' => $this->hasDecimalValue($account['margin']) ? '' : $this->ratioToPercentInput($account['margin_percentage_long']),
                'margin_percentage_short' => $this->hasDecimalValue($account['margin']) ? '' : $this->ratioToPercentInput($account['margin_percentage_short']),
                'allow_other_positions' => (bool) $account['allow_other_positions'],
                'allow_other_orders' => (bool) $account['allow_other_orders'],
            ];

            if (! array_key_exists($accountId, $this->expandedAccounts)) {
                $this->expandedAccounts[$accountId] = false;
            }
        }

        $this->markTabLoaded('accounts');
    }

    private function ratioToPercentInput(mixed $value): string
    {
        if ($value === null || $value === '') {
            return '0.00';
        }

        $number = (float) $value;
        $percent = abs($number) <= 1.0 ? $number * 100 : $number;

        return number_format($percent, 2, '.', '');
    }

    private function percentInputToRatio(mixed $value): string
    {
        return number_format(((float) $value) / 100, 4, '.', '');
    }

    /**
     * @param  array<string, mixed>  $account
     * @return array<string, float|string|null>
     */
    private function accountBalanceContext(array $account): array
    {
        $snapshot = DB::table('api_snapshots')
            ->where('responsable_type', 'Kraite\\Core\\Models\\Account')
            ->where('responsable_id', $account['id'])
            ->where('canonical', 'account-balance')
            ->latest('id')
            ->first();

        $payload = $snapshot ? json_decode((string) $snapshot->api_response, true) : null;
        $totalWalletBalance = $this->nullableFloat($payload['total-wallet-balance'] ?? null);
        $availableBalance = $this->nullableFloat($payload['available-balance'] ?? null);

        if ($totalWalletBalance === null) {
            $history = DB::table('account_balance_history')
                ->where('account_id', $account['id'])
                ->latest('id')
                ->first();

            $totalWalletBalance = $this->nullableFloat($history?->total_wallet_balance ?? null);
        }

        $usesAvailableBalance = ($account['balance_for_trading_basis'] ?? 'total') === 'available';
        $balanceForTrading = $usesAvailableBalance ? $availableBalance : $totalWalletBalance;
        $balanceSource = $usesAvailableBalance ? 'Available balance' : 'Total wallet balance';

        if ($balanceForTrading === null) {
            $balanceForTrading = $this->nullableFloat($account['margin'] ?? null);
            $balanceSource = $balanceForTrading === null ? 'Unavailable' : 'Margin fallback';
        }

        return [
            'total_wallet_balance' => $totalWalletBalance,
            'available_balance' => $availableBalance,
            'balance_for_trading' => $balanceForTrading,
            'balance_source' => $balanceSource,
            'margin_limit_balance' => $totalWalletBalance,
            'max_margin_amount' => $totalWalletBalance === null ? null : $totalWalletBalance * 0.05,
        ];
    }

    private function accountMaxAbsoluteMargin(int $accountId): ?float
    {
        $account = collect($this->accounts)->firstWhere('id', $accountId);

        return $account ? $this->nullableFloat($account['max_margin_amount'] ?? null) : null;
    }

    private function userOwnsAccount(int $accountId): bool
    {
        return DB::table('accounts')
            ->where('id', $accountId)
            ->where('user_id', $this->user->id)
            ->exists();
    }

    private function hasDecimalValue(mixed $value): bool
    {
        return $value !== null && trim((string) $value) !== '';
    }

    private function nullableFloat(mixed $value): ?float
    {
        if ($value === null || $value === '') {
            return null;
        }

        return (float) $value;
    }

    private function resolvedAvatarPath(): ?string
    {
        if ($this->avatarImage) {
            $this->deleteStoredAvatar($this->user->avatar);
            $path = $this->avatarImage->store('avatars/users', 'public');

            return Storage::disk('public')->url($path);
        }

        if ($this->removeAvatar) {
            $this->deleteStoredAvatar($this->user->avatar);

            return null;
        }

        return trim($this->avatar) ?: null;
    }

    private function deleteStoredAvatar(?string $avatar): void
    {
        if (! $avatar || ! str_starts_with($avatar, '/storage/avatars/users/')) {
            return;
        }

        Storage::disk('public')->delete(str_replace('/storage/', '', $avatar));
    }
}
