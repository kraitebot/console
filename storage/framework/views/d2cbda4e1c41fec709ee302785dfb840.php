<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'account',
    'form' => [],
    'expanded' => false,
    'connectivity' => null,
    'quoteOptions' => [],
    'leverageOptions' => [],
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'account',
    'form' => [],
    'expanded' => false,
    'connectivity' => null,
    'quoteOptions' => [],
    'leverageOptions' => [],
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $accountId = (int) $account['id'];
    $activeColor = $account['is_active'] ? 'emerald' : 'zinc';
    $tradeColor = $account['can_trade'] ? 'primary' : 'amber';
    $formatPercent = static function (mixed $value): string {
        if ($value === null || $value === '') {
            return '-';
        }

        $number = (float) $value;
        $percent = abs($number) <= 1.0 ? $number * 100 : $number;

        return number_format($percent, 2, '.', '').'%';
    };
    $hasAbsoluteMargin = $account['margin'] !== null && $account['margin'] !== '';
    $balanceBasisLabel = ($account['balance_for_trading_basis'] ?? 'total') === 'available'
        ? 'Available Balance'
        : 'Total Balance';
    $formatAmount = static fn (mixed $value): string => $value === null || $value === ''
        ? '-'
        : number_format((float) $value, 2, '.', '');
?>

<div
    data-component-name="Users/AccountsRow"
    x-data="{ expanded: <?php echo \Illuminate\Support\Js::from($expanded)->toHtml() ?>, accountTab: 'details' }"
    x-effect="expanded = <?php echo \Illuminate\Support\Js::from($expanded)->toHtml() ?>"
    class="overflow-hidden rounded-xl border border-zinc-500/15 bg-zinc-50/70 transition-colors duration-300 hover:border-primary-500/35 hover:bg-primary-500/5 dark:bg-zinc-950/60"
>
    <button
        type="button"
        wire:click="toggleAccount(<?php echo e($accountId); ?>)"
        @click="expanded = ! expanded"
        class="flex w-full cursor-pointer items-center gap-4 bg-primary-500 px-4 py-4 text-left text-zinc-900 transition-colors duration-300 hover:bg-primary-600"
        :aria-expanded="expanded ? 'true' : 'false'"
    >
        <div class="flex size-11 shrink-0 items-center justify-center rounded-lg bg-zinc-900/10 text-zinc-900">
            <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'UserAccount','size' => 'text-2xl']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'UserAccount','size' => 'text-2xl']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
        </div>

        <div class="min-w-0 flex-1">
            <div class="flex flex-wrap items-center gap-2">
                <div class="truncate text-lg font-semibold text-zinc-900"><?php echo e($account['name']); ?></div>
                <span class="inline-flex rounded-lg border border-zinc-900/10 bg-zinc-900/10 px-2 py-0.5 text-sm font-semibold text-zinc-900">
                    <?php echo e($account['is_active'] ? 'Active' : 'Inactive'); ?>

                </span>
                <span class="inline-flex rounded-lg border border-zinc-900/10 bg-zinc-900/10 px-2 py-0.5 text-sm font-semibold text-zinc-900">
                    <?php echo e($account['can_trade'] ? 'Can trade' : 'Trading paused'); ?>

                </span>
            </div>
            <div class="mt-1 flex flex-wrap items-center gap-x-4 gap-y-1 text-base text-zinc-900/70">
                <span><?php echo e($account['exchange_name'] ?? 'Exchange unknown'); ?></span>
                <span><?php echo e($account['portfolio_quote'] ?? '-'); ?> portfolio</span>
                <span><?php echo e($account['open_positions_count']); ?> open <?php echo e(str('position')->plural($account['open_positions_count'])); ?></span>
            </div>
        </div>

        <div class="hidden grid-cols-3 gap-3 text-right lg:grid">
            <div>
                <div class="text-sm text-zinc-900/70"><?php echo e($hasAbsoluteMargin ? 'Margin' : 'Margin %'); ?></div>
                <div class="text-base font-semibold text-zinc-900">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($hasAbsoluteMargin): ?>
                        <?php echo e($account['margin']); ?> <?php echo e($account['trading_quote'] ?? $account['portfolio_quote'] ?? ''); ?>

                    <?php else: ?>
                        L <?php echo e($formatPercent($account['margin_percentage_long'])); ?> / S <?php echo e($formatPercent($account['margin_percentage_short'])); ?>

                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
            <div>
                <div class="text-sm text-zinc-900/70">Long</div>
                <div class="text-base font-semibold text-zinc-900"><?php echo e($account['position_leverage_long']); ?>x</div>
            </div>
            <div>
                <div class="text-sm text-zinc-900/70">Short</div>
                <div class="text-base font-semibold text-zinc-900"><?php echo e($account['position_leverage_short']); ?>x</div>
            </div>
        </div>

        <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'ArrowDown01','size' => 'text-2xl','class' => 'text-zinc-900 transition-transform duration-300','xBind:class' => 'expanded ? \'rotate-180\' : \'\'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'ArrowDown01','size' => 'text-2xl','class' => 'text-zinc-900 transition-transform duration-300','x-bind:class' => 'expanded ? \'rotate-180\' : \'\'']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
    </button>

    <div x-show="expanded" x-collapse.duration.250ms x-cloak>
        <div class="border-t border-zinc-500/15 bg-white/70 px-4 py-5 dark:bg-zinc-950">
            <div class="mb-5 flex flex-wrap items-center gap-2 border-b border-zinc-500/15 pb-4" role="tablist" aria-label="Account sections">
                <button
                    type="button"
                    @click="accountTab = 'details'"
                    class="users-account-subtab"
                    role="tab"
                    :aria-selected="accountTab === 'details'"
                    :data-active="accountTab === 'details' ? 'true' : 'false'"
                >
                    Details
                </button>
                <button
                    type="button"
                    @click="accountTab = 'connectivity'"
                    class="users-account-subtab"
                    role="tab"
                    :aria-selected="accountTab === 'connectivity'"
                    :data-active="accountTab === 'connectivity' ? 'true' : 'false'"
                >
                    Server connectivity
                </button>
            </div>

            <div x-show="accountTab === 'details'" x-transition.opacity.duration.200ms>
            <div class="mb-5 grid grid-cols-1 gap-3 md:grid-cols-2 xl:grid-cols-4">
                <?php if (isset($component)) { $__componentOriginal538b22ec6a8b6b0560b31e22fb03a7b8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal538b22ec6a8b6b0560b31e22fb03a7b8 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.data-display.item','data' => ['label' => 'Exchange','value' => $account['exchange_name'] ?? null]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('data-display.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Exchange','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($account['exchange_name'] ?? null)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal538b22ec6a8b6b0560b31e22fb03a7b8)): ?>
<?php $attributes = $__attributesOriginal538b22ec6a8b6b0560b31e22fb03a7b8; ?>
<?php unset($__attributesOriginal538b22ec6a8b6b0560b31e22fb03a7b8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal538b22ec6a8b6b0560b31e22fb03a7b8)): ?>
<?php $component = $__componentOriginal538b22ec6a8b6b0560b31e22fb03a7b8; ?>
<?php unset($__componentOriginal538b22ec6a8b6b0560b31e22fb03a7b8); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginal538b22ec6a8b6b0560b31e22fb03a7b8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal538b22ec6a8b6b0560b31e22fb03a7b8 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.data-display.item','data' => ['label' => 'Configuration','value' => $account['trade_configuration_canonical'] ?? null]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('data-display.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Configuration','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($account['trade_configuration_canonical'] ?? null)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal538b22ec6a8b6b0560b31e22fb03a7b8)): ?>
<?php $attributes = $__attributesOriginal538b22ec6a8b6b0560b31e22fb03a7b8; ?>
<?php unset($__attributesOriginal538b22ec6a8b6b0560b31e22fb03a7b8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal538b22ec6a8b6b0560b31e22fb03a7b8)): ?>
<?php $component = $__componentOriginal538b22ec6a8b6b0560b31e22fb03a7b8; ?>
<?php unset($__componentOriginal538b22ec6a8b6b0560b31e22fb03a7b8); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginal538b22ec6a8b6b0560b31e22fb03a7b8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal538b22ec6a8b6b0560b31e22fb03a7b8 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.data-display.item','data' => ['label' => 'Hedge Mode','value' => $account['on_hedge_mode'] ? 'Enabled' : 'Disabled']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('data-display.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Hedge Mode','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($account['on_hedge_mode'] ? 'Enabled' : 'Disabled')]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal538b22ec6a8b6b0560b31e22fb03a7b8)): ?>
<?php $attributes = $__attributesOriginal538b22ec6a8b6b0560b31e22fb03a7b8; ?>
<?php unset($__attributesOriginal538b22ec6a8b6b0560b31e22fb03a7b8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal538b22ec6a8b6b0560b31e22fb03a7b8)): ?>
<?php $component = $__componentOriginal538b22ec6a8b6b0560b31e22fb03a7b8; ?>
<?php unset($__componentOriginal538b22ec6a8b6b0560b31e22fb03a7b8); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginal538b22ec6a8b6b0560b31e22fb03a7b8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal538b22ec6a8b6b0560b31e22fb03a7b8 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.data-display.item','data' => ['label' => 'Open Positions','value' => $account['open_positions_count']]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('data-display.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Open Positions','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($account['open_positions_count'])]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal538b22ec6a8b6b0560b31e22fb03a7b8)): ?>
<?php $attributes = $__attributesOriginal538b22ec6a8b6b0560b31e22fb03a7b8; ?>
<?php unset($__attributesOriginal538b22ec6a8b6b0560b31e22fb03a7b8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal538b22ec6a8b6b0560b31e22fb03a7b8)): ?>
<?php $component = $__componentOriginal538b22ec6a8b6b0560b31e22fb03a7b8; ?>
<?php unset($__componentOriginal538b22ec6a8b6b0560b31e22fb03a7b8); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginal538b22ec6a8b6b0560b31e22fb03a7b8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal538b22ec6a8b6b0560b31e22fb03a7b8 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.data-display.item','data' => ['label' => 'Total Wallet Balance','value' => $formatAmount($account['total_wallet_balance'] ?? null)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('data-display.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Total Wallet Balance','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($formatAmount($account['total_wallet_balance'] ?? null))]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal538b22ec6a8b6b0560b31e22fb03a7b8)): ?>
<?php $attributes = $__attributesOriginal538b22ec6a8b6b0560b31e22fb03a7b8; ?>
<?php unset($__attributesOriginal538b22ec6a8b6b0560b31e22fb03a7b8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal538b22ec6a8b6b0560b31e22fb03a7b8)): ?>
<?php $component = $__componentOriginal538b22ec6a8b6b0560b31e22fb03a7b8; ?>
<?php unset($__componentOriginal538b22ec6a8b6b0560b31e22fb03a7b8); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginal538b22ec6a8b6b0560b31e22fb03a7b8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal538b22ec6a8b6b0560b31e22fb03a7b8 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.data-display.item','data' => ['label' => 'Available Balance','value' => $formatAmount($account['available_balance'] ?? null)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('data-display.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Available Balance','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($formatAmount($account['available_balance'] ?? null))]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal538b22ec6a8b6b0560b31e22fb03a7b8)): ?>
<?php $attributes = $__attributesOriginal538b22ec6a8b6b0560b31e22fb03a7b8; ?>
<?php unset($__attributesOriginal538b22ec6a8b6b0560b31e22fb03a7b8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal538b22ec6a8b6b0560b31e22fb03a7b8)): ?>
<?php $component = $__componentOriginal538b22ec6a8b6b0560b31e22fb03a7b8; ?>
<?php unset($__componentOriginal538b22ec6a8b6b0560b31e22fb03a7b8); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginal538b22ec6a8b6b0560b31e22fb03a7b8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal538b22ec6a8b6b0560b31e22fb03a7b8 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.data-display.item','data' => ['label' => 'Trade Using','value' => $balanceBasisLabel]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('data-display.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Trade Using','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($balanceBasisLabel)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal538b22ec6a8b6b0560b31e22fb03a7b8)): ?>
<?php $attributes = $__attributesOriginal538b22ec6a8b6b0560b31e22fb03a7b8; ?>
<?php unset($__attributesOriginal538b22ec6a8b6b0560b31e22fb03a7b8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal538b22ec6a8b6b0560b31e22fb03a7b8)): ?>
<?php $component = $__componentOriginal538b22ec6a8b6b0560b31e22fb03a7b8; ?>
<?php unset($__componentOriginal538b22ec6a8b6b0560b31e22fb03a7b8); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginal538b22ec6a8b6b0560b31e22fb03a7b8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal538b22ec6a8b6b0560b31e22fb03a7b8 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.data-display.item','data' => ['label' => 'Balance Used','value' => ($account['balance_source'] ?? 'Unavailable').': '.$formatAmount($account['balance_for_trading'] ?? null)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('data-display.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Balance Used','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(($account['balance_source'] ?? 'Unavailable').': '.$formatAmount($account['balance_for_trading'] ?? null))]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal538b22ec6a8b6b0560b31e22fb03a7b8)): ?>
<?php $attributes = $__attributesOriginal538b22ec6a8b6b0560b31e22fb03a7b8; ?>
<?php unset($__attributesOriginal538b22ec6a8b6b0560b31e22fb03a7b8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal538b22ec6a8b6b0560b31e22fb03a7b8)): ?>
<?php $component = $__componentOriginal538b22ec6a8b6b0560b31e22fb03a7b8; ?>
<?php unset($__componentOriginal538b22ec6a8b6b0560b31e22fb03a7b8); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginal538b22ec6a8b6b0560b31e22fb03a7b8 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal538b22ec6a8b6b0560b31e22fb03a7b8 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.data-display.item','data' => ['label' => 'Absolute Margin Cap','value' => $formatAmount($account['max_margin_amount'] ?? null)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('data-display.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Absolute Margin Cap','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($formatAmount($account['max_margin_amount'] ?? null))]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal538b22ec6a8b6b0560b31e22fb03a7b8)): ?>
<?php $attributes = $__attributesOriginal538b22ec6a8b6b0560b31e22fb03a7b8; ?>
<?php unset($__attributesOriginal538b22ec6a8b6b0560b31e22fb03a7b8); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal538b22ec6a8b6b0560b31e22fb03a7b8)): ?>
<?php $component = $__componentOriginal538b22ec6a8b6b0560b31e22fb03a7b8; ?>
<?php unset($__componentOriginal538b22ec6a8b6b0560b31e22fb03a7b8); ?>
<?php endif; ?>
            </div>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($account['disabled_reason']): ?>
                <div class="mb-5 rounded-lg border border-amber-500/25 bg-amber-500/10 px-4 py-3 text-base text-amber-500">
                    <?php echo e($account['disabled_reason']); ?>

                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <div class="mb-5 flex items-center gap-4" aria-hidden="true">
                <div class="h-px flex-1 bg-gradient-to-r from-transparent via-primary-500/35 to-zinc-500/10"></div>
                <div class="flex items-center gap-2 rounded-full border border-primary-500/20 bg-primary-500/10 px-3 py-1 text-xs font-semibold uppercase tracking-wide text-primary-500">
                    <span class="size-1.5 rounded-full bg-primary-500"></span>
                    Editable settings
                </div>
                <div class="h-px flex-1 bg-gradient-to-l from-transparent via-primary-500/35 to-zinc-500/10"></div>
            </div>

            <form wire:submit="saveAccount(<?php echo e($accountId); ?>)" class="grid grid-cols-12 gap-4">
                <div class="col-span-12 lg:col-span-6">
                    <?php if (isset($component)) { $__componentOriginal306f477fe089d4f950325a3d0a498c1c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal306f477fe089d4f950325a3d0a498c1c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.label','data' => ['for' => 'account-'.e($accountId).'-name','class' => '!text-base']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'account-'.e($accountId).'-name','class' => '!text-base']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>
Name <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal306f477fe089d4f950325a3d0a498c1c)): ?>
<?php $attributes = $__attributesOriginal306f477fe089d4f950325a3d0a498c1c; ?>
<?php unset($__attributesOriginal306f477fe089d4f950325a3d0a498c1c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal306f477fe089d4f950325a3d0a498c1c)): ?>
<?php $component = $__componentOriginal306f477fe089d4f950325a3d0a498c1c; ?>
<?php unset($__componentOriginal306f477fe089d4f950325a3d0a498c1c); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginal5c2a97ab476b69c1189ee85d1a95204b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.input','data' => ['id' => 'account-'.e($accountId).'-name','name' => 'accountForms.'.e($accountId).'.name','wire:model' => 'accountForms.'.e($accountId).'.name','dimension' => 'lg']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'account-'.e($accountId).'-name','name' => 'accountForms.'.e($accountId).'.name','wire:model' => 'accountForms.'.e($accountId).'.name','dimension' => 'lg']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b)): ?>
<?php $attributes = $__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b; ?>
<?php unset($__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5c2a97ab476b69c1189ee85d1a95204b)): ?>
<?php $component = $__componentOriginal5c2a97ab476b69c1189ee85d1a95204b; ?>
<?php unset($__componentOriginal5c2a97ab476b69c1189ee85d1a95204b); ?>
<?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ["accountForms.{$accountId}.name"];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 text-sm text-red-500/70"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <div class="col-span-12 md:col-span-6 lg:col-span-3">
                    <?php if (isset($component)) { $__componentOriginal306f477fe089d4f950325a3d0a498c1c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal306f477fe089d4f950325a3d0a498c1c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.label','data' => ['for' => 'account-'.e($accountId).'-portfolio','class' => '!text-base']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'account-'.e($accountId).'-portfolio','class' => '!text-base']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>
Portfolio Quote <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal306f477fe089d4f950325a3d0a498c1c)): ?>
<?php $attributes = $__attributesOriginal306f477fe089d4f950325a3d0a498c1c; ?>
<?php unset($__attributesOriginal306f477fe089d4f950325a3d0a498c1c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal306f477fe089d4f950325a3d0a498c1c)): ?>
<?php $component = $__componentOriginal306f477fe089d4f950325a3d0a498c1c; ?>
<?php unset($__componentOriginal306f477fe089d4f950325a3d0a498c1c); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginal8cee41e4af1fe2df52d1d5acd06eed36 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8cee41e4af1fe2df52d1d5acd06eed36 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.select','data' => ['id' => 'account-'.e($accountId).'-portfolio','name' => 'accountForms.'.e($accountId).'.portfolio_quote','wire:model' => 'accountForms.'.e($accountId).'.portfolio_quote','dimension' => 'lg']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'account-'.e($accountId).'-portfolio','name' => 'accountForms.'.e($accountId).'.portfolio_quote','wire:model' => 'accountForms.'.e($accountId).'.portfolio_quote','dimension' => 'lg']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                        <option value="">No quote</option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $quoteOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quote): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <option value="<?php echo e($quote); ?>"><?php echo e($quote); ?></option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8cee41e4af1fe2df52d1d5acd06eed36)): ?>
<?php $attributes = $__attributesOriginal8cee41e4af1fe2df52d1d5acd06eed36; ?>
<?php unset($__attributesOriginal8cee41e4af1fe2df52d1d5acd06eed36); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8cee41e4af1fe2df52d1d5acd06eed36)): ?>
<?php $component = $__componentOriginal8cee41e4af1fe2df52d1d5acd06eed36; ?>
<?php unset($__componentOriginal8cee41e4af1fe2df52d1d5acd06eed36); ?>
<?php endif; ?>
                    <p class="mt-2 text-sm leading-5 text-zinc-500">Quote currency used to value and report the account portfolio.</p>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ["accountForms.{$accountId}.portfolio_quote"];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 text-sm text-red-500/70"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <div class="col-span-12 md:col-span-6 lg:col-span-3">
                    <?php if (isset($component)) { $__componentOriginal306f477fe089d4f950325a3d0a498c1c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal306f477fe089d4f950325a3d0a498c1c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.label','data' => ['for' => 'account-'.e($accountId).'-trading','class' => '!text-base']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'account-'.e($accountId).'-trading','class' => '!text-base']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>
Trading Quote <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal306f477fe089d4f950325a3d0a498c1c)): ?>
<?php $attributes = $__attributesOriginal306f477fe089d4f950325a3d0a498c1c; ?>
<?php unset($__attributesOriginal306f477fe089d4f950325a3d0a498c1c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal306f477fe089d4f950325a3d0a498c1c)): ?>
<?php $component = $__componentOriginal306f477fe089d4f950325a3d0a498c1c; ?>
<?php unset($__componentOriginal306f477fe089d4f950325a3d0a498c1c); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginal8cee41e4af1fe2df52d1d5acd06eed36 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8cee41e4af1fe2df52d1d5acd06eed36 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.select','data' => ['id' => 'account-'.e($accountId).'-trading','name' => 'accountForms.'.e($accountId).'.trading_quote','wire:model' => 'accountForms.'.e($accountId).'.trading_quote','dimension' => 'lg']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'account-'.e($accountId).'-trading','name' => 'accountForms.'.e($accountId).'.trading_quote','wire:model' => 'accountForms.'.e($accountId).'.trading_quote','dimension' => 'lg']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                        <option value="">No quote</option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $quoteOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quote): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <option value="<?php echo e($quote); ?>"><?php echo e($quote); ?></option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8cee41e4af1fe2df52d1d5acd06eed36)): ?>
<?php $attributes = $__attributesOriginal8cee41e4af1fe2df52d1d5acd06eed36; ?>
<?php unset($__attributesOriginal8cee41e4af1fe2df52d1d5acd06eed36); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8cee41e4af1fe2df52d1d5acd06eed36)): ?>
<?php $component = $__componentOriginal8cee41e4af1fe2df52d1d5acd06eed36; ?>
<?php unset($__componentOriginal8cee41e4af1fe2df52d1d5acd06eed36); ?>
<?php endif; ?>
                    <p class="mt-2 text-sm leading-5 text-zinc-500">Quote currency Kraite uses when selecting tradable market pairs.</p>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ["accountForms.{$accountId}.trading_quote"];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 text-sm text-red-500/70"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <div class="col-span-12 md:col-span-6 lg:col-span-3">
                    <?php if (isset($component)) { $__componentOriginal306f477fe089d4f950325a3d0a498c1c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal306f477fe089d4f950325a3d0a498c1c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.label','data' => ['for' => 'account-'.e($accountId).'-balance-basis','class' => '!text-base']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'account-'.e($accountId).'-balance-basis','class' => '!text-base']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>
Trade Using <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal306f477fe089d4f950325a3d0a498c1c)): ?>
<?php $attributes = $__attributesOriginal306f477fe089d4f950325a3d0a498c1c; ?>
<?php unset($__attributesOriginal306f477fe089d4f950325a3d0a498c1c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal306f477fe089d4f950325a3d0a498c1c)): ?>
<?php $component = $__componentOriginal306f477fe089d4f950325a3d0a498c1c; ?>
<?php unset($__componentOriginal306f477fe089d4f950325a3d0a498c1c); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginal8cee41e4af1fe2df52d1d5acd06eed36 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8cee41e4af1fe2df52d1d5acd06eed36 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.select','data' => ['id' => 'account-'.e($accountId).'-balance-basis','name' => 'accountForms.'.e($accountId).'.balance_for_trading_basis','wire:model' => 'accountForms.'.e($accountId).'.balance_for_trading_basis','dimension' => 'lg']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'account-'.e($accountId).'-balance-basis','name' => 'accountForms.'.e($accountId).'.balance_for_trading_basis','wire:model' => 'accountForms.'.e($accountId).'.balance_for_trading_basis','dimension' => 'lg']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                        <option value="total">Total Balance</option>
                        <option value="available">Available Balance</option>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8cee41e4af1fe2df52d1d5acd06eed36)): ?>
<?php $attributes = $__attributesOriginal8cee41e4af1fe2df52d1d5acd06eed36; ?>
<?php unset($__attributesOriginal8cee41e4af1fe2df52d1d5acd06eed36); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8cee41e4af1fe2df52d1d5acd06eed36)): ?>
<?php $component = $__componentOriginal8cee41e4af1fe2df52d1d5acd06eed36; ?>
<?php unset($__componentOriginal8cee41e4af1fe2df52d1d5acd06eed36); ?>
<?php endif; ?>
                    <p class="mt-2 text-sm leading-5 text-zinc-500">Balance source used by Kraite when sizing new position margin.</p>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ["accountForms.{$accountId}.balance_for_trading_basis"];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 text-sm text-red-500/70"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <div class="col-span-12 md:col-span-6 lg:col-span-3">
                    <?php if (isset($component)) { $__componentOriginal306f477fe089d4f950325a3d0a498c1c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal306f477fe089d4f950325a3d0a498c1c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.label','data' => ['for' => 'account-'.e($accountId).'-margin','class' => '!text-base']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'account-'.e($accountId).'-margin','class' => '!text-base']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>
Margin <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal306f477fe089d4f950325a3d0a498c1c)): ?>
<?php $attributes = $__attributesOriginal306f477fe089d4f950325a3d0a498c1c; ?>
<?php unset($__attributesOriginal306f477fe089d4f950325a3d0a498c1c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal306f477fe089d4f950325a3d0a498c1c)): ?>
<?php $component = $__componentOriginal306f477fe089d4f950325a3d0a498c1c; ?>
<?php unset($__componentOriginal306f477fe089d4f950325a3d0a498c1c); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginal5c2a97ab476b69c1189ee85d1a95204b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.input','data' => ['id' => 'account-'.e($accountId).'-margin','type' => 'number','name' => 'accountForms.'.e($accountId).'.margin','wire:model' => 'accountForms.'.e($accountId).'.margin','wire:blur' => 'clearAccountMarginPercentages('.e($accountId).')','dimension' => 'lg']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'account-'.e($accountId).'-margin','type' => 'number','name' => 'accountForms.'.e($accountId).'.margin','wire:model' => 'accountForms.'.e($accountId).'.margin','wire:blur' => 'clearAccountMarginPercentages('.e($accountId).')','dimension' => 'lg']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b)): ?>
<?php $attributes = $__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b; ?>
<?php unset($__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5c2a97ab476b69c1189ee85d1a95204b)): ?>
<?php $component = $__componentOriginal5c2a97ab476b69c1189ee85d1a95204b; ?>
<?php unset($__componentOriginal5c2a97ab476b69c1189ee85d1a95204b); ?>
<?php endif; ?>
                    <p class="mt-2 text-sm leading-5 text-zinc-500">
                        Optional absolute margin. Max 5% of total wallet balance<?php echo e(isset($account['max_margin_amount']) && $account['max_margin_amount'] !== null ? ': '.$formatAmount($account['max_margin_amount']) : ' when balance is available'); ?>.
                    </p>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ["accountForms.{$accountId}.margin"];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 text-sm text-red-500/70"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <div class="col-span-12 md:col-span-6 lg:col-span-3">
                    <?php if (isset($component)) { $__componentOriginal306f477fe089d4f950325a3d0a498c1c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal306f477fe089d4f950325a3d0a498c1c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.label','data' => ['for' => 'account-'.e($accountId).'-mode','class' => '!text-base']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'account-'.e($accountId).'-mode','class' => '!text-base']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>
Margin Mode <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal306f477fe089d4f950325a3d0a498c1c)): ?>
<?php $attributes = $__attributesOriginal306f477fe089d4f950325a3d0a498c1c; ?>
<?php unset($__attributesOriginal306f477fe089d4f950325a3d0a498c1c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal306f477fe089d4f950325a3d0a498c1c)): ?>
<?php $component = $__componentOriginal306f477fe089d4f950325a3d0a498c1c; ?>
<?php unset($__componentOriginal306f477fe089d4f950325a3d0a498c1c); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginal8cee41e4af1fe2df52d1d5acd06eed36 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8cee41e4af1fe2df52d1d5acd06eed36 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.select','data' => ['id' => 'account-'.e($accountId).'-mode','name' => 'accountForms.'.e($accountId).'.margin_mode','wire:model' => 'accountForms.'.e($accountId).'.margin_mode','dimension' => 'lg']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'account-'.e($accountId).'-mode','name' => 'accountForms.'.e($accountId).'.margin_mode','wire:model' => 'accountForms.'.e($accountId).'.margin_mode','dimension' => 'lg']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                        <option value="crossed">Crossed</option>
                        <option value="isolated">Isolated</option>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8cee41e4af1fe2df52d1d5acd06eed36)): ?>
<?php $attributes = $__attributesOriginal8cee41e4af1fe2df52d1d5acd06eed36; ?>
<?php unset($__attributesOriginal8cee41e4af1fe2df52d1d5acd06eed36); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8cee41e4af1fe2df52d1d5acd06eed36)): ?>
<?php $component = $__componentOriginal8cee41e4af1fe2df52d1d5acd06eed36; ?>
<?php unset($__componentOriginal8cee41e4af1fe2df52d1d5acd06eed36); ?>
<?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ["accountForms.{$accountId}.margin_mode"];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 text-sm text-red-500/70"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <div class="col-span-12 md:col-span-6 lg:col-span-3">
                    <?php if (isset($component)) { $__componentOriginal306f477fe089d4f950325a3d0a498c1c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal306f477fe089d4f950325a3d0a498c1c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.label','data' => ['for' => 'account-'.e($accountId).'-long','class' => '!text-base']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'account-'.e($accountId).'-long','class' => '!text-base']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>
Long Leverage <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal306f477fe089d4f950325a3d0a498c1c)): ?>
<?php $attributes = $__attributesOriginal306f477fe089d4f950325a3d0a498c1c; ?>
<?php unset($__attributesOriginal306f477fe089d4f950325a3d0a498c1c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal306f477fe089d4f950325a3d0a498c1c)): ?>
<?php $component = $__componentOriginal306f477fe089d4f950325a3d0a498c1c; ?>
<?php unset($__componentOriginal306f477fe089d4f950325a3d0a498c1c); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginal8cee41e4af1fe2df52d1d5acd06eed36 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8cee41e4af1fe2df52d1d5acd06eed36 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.select','data' => ['id' => 'account-'.e($accountId).'-long','name' => 'accountForms.'.e($accountId).'.position_leverage_long','wire:model' => 'accountForms.'.e($accountId).'.position_leverage_long','dimension' => 'lg']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'account-'.e($accountId).'-long','name' => 'accountForms.'.e($accountId).'.position_leverage_long','wire:model' => 'accountForms.'.e($accountId).'.position_leverage_long','dimension' => 'lg']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $leverageOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $leverage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <option value="<?php echo e($leverage); ?>"><?php echo e($leverage); ?>x</option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8cee41e4af1fe2df52d1d5acd06eed36)): ?>
<?php $attributes = $__attributesOriginal8cee41e4af1fe2df52d1d5acd06eed36; ?>
<?php unset($__attributesOriginal8cee41e4af1fe2df52d1d5acd06eed36); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8cee41e4af1fe2df52d1d5acd06eed36)): ?>
<?php $component = $__componentOriginal8cee41e4af1fe2df52d1d5acd06eed36; ?>
<?php unset($__componentOriginal8cee41e4af1fe2df52d1d5acd06eed36); ?>
<?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ["accountForms.{$accountId}.position_leverage_long"];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 text-sm text-red-500/70"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <div class="col-span-12 md:col-span-6 lg:col-span-3">
                    <?php if (isset($component)) { $__componentOriginal306f477fe089d4f950325a3d0a498c1c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal306f477fe089d4f950325a3d0a498c1c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.label','data' => ['for' => 'account-'.e($accountId).'-short','class' => '!text-base']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'account-'.e($accountId).'-short','class' => '!text-base']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>
Short Leverage <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal306f477fe089d4f950325a3d0a498c1c)): ?>
<?php $attributes = $__attributesOriginal306f477fe089d4f950325a3d0a498c1c; ?>
<?php unset($__attributesOriginal306f477fe089d4f950325a3d0a498c1c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal306f477fe089d4f950325a3d0a498c1c)): ?>
<?php $component = $__componentOriginal306f477fe089d4f950325a3d0a498c1c; ?>
<?php unset($__componentOriginal306f477fe089d4f950325a3d0a498c1c); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginal8cee41e4af1fe2df52d1d5acd06eed36 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8cee41e4af1fe2df52d1d5acd06eed36 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.select','data' => ['id' => 'account-'.e($accountId).'-short','name' => 'accountForms.'.e($accountId).'.position_leverage_short','wire:model' => 'accountForms.'.e($accountId).'.position_leverage_short','dimension' => 'lg']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'account-'.e($accountId).'-short','name' => 'accountForms.'.e($accountId).'.position_leverage_short','wire:model' => 'accountForms.'.e($accountId).'.position_leverage_short','dimension' => 'lg']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $leverageOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $leverage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <option value="<?php echo e($leverage); ?>"><?php echo e($leverage); ?>x</option>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8cee41e4af1fe2df52d1d5acd06eed36)): ?>
<?php $attributes = $__attributesOriginal8cee41e4af1fe2df52d1d5acd06eed36; ?>
<?php unset($__attributesOriginal8cee41e4af1fe2df52d1d5acd06eed36); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8cee41e4af1fe2df52d1d5acd06eed36)): ?>
<?php $component = $__componentOriginal8cee41e4af1fe2df52d1d5acd06eed36; ?>
<?php unset($__componentOriginal8cee41e4af1fe2df52d1d5acd06eed36); ?>
<?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ["accountForms.{$accountId}.position_leverage_short"];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 text-sm text-red-500/70"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <div class="col-span-12 md:col-span-6 lg:col-span-3">
                    <?php if (isset($component)) { $__componentOriginal306f477fe089d4f950325a3d0a498c1c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal306f477fe089d4f950325a3d0a498c1c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.label','data' => ['for' => 'account-'.e($accountId).'-long-margin','class' => '!text-base']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'account-'.e($accountId).'-long-margin','class' => '!text-base']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>
Long Margin % <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal306f477fe089d4f950325a3d0a498c1c)): ?>
<?php $attributes = $__attributesOriginal306f477fe089d4f950325a3d0a498c1c; ?>
<?php unset($__attributesOriginal306f477fe089d4f950325a3d0a498c1c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal306f477fe089d4f950325a3d0a498c1c)): ?>
<?php $component = $__componentOriginal306f477fe089d4f950325a3d0a498c1c; ?>
<?php unset($__componentOriginal306f477fe089d4f950325a3d0a498c1c); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginal5c2a97ab476b69c1189ee85d1a95204b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.input','data' => ['id' => 'account-'.e($accountId).'-long-margin','name' => 'accountForms.'.e($accountId).'.margin_percentage_long','wire:model' => 'accountForms.'.e($accountId).'.margin_percentage_long','wire:blur' => 'clearAccountAbsoluteMargin('.e($accountId).')','dimension' => 'lg','inputmode' => 'decimal','placeholder' => '5.00']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'account-'.e($accountId).'-long-margin','name' => 'accountForms.'.e($accountId).'.margin_percentage_long','wire:model' => 'accountForms.'.e($accountId).'.margin_percentage_long','wire:blur' => 'clearAccountAbsoluteMargin('.e($accountId).')','dimension' => 'lg','inputmode' => 'decimal','placeholder' => '5.00']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b)): ?>
<?php $attributes = $__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b; ?>
<?php unset($__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5c2a97ab476b69c1189ee85d1a95204b)): ?>
<?php $component = $__componentOriginal5c2a97ab476b69c1189ee85d1a95204b; ?>
<?php unset($__componentOriginal5c2a97ab476b69c1189ee85d1a95204b); ?>
<?php endif; ?>
                    <p class="mt-2 text-sm leading-5 text-zinc-500">Required when absolute margin is empty. Allowed range: 1.00% to 5.00%.</p>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ["accountForms.{$accountId}.margin_percentage_long"];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 text-sm text-red-500/70"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <div class="col-span-12 md:col-span-6 lg:col-span-3">
                    <?php if (isset($component)) { $__componentOriginal306f477fe089d4f950325a3d0a498c1c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal306f477fe089d4f950325a3d0a498c1c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.label','data' => ['for' => 'account-'.e($accountId).'-short-margin','class' => '!text-base']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'account-'.e($accountId).'-short-margin','class' => '!text-base']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>
Short Margin % <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal306f477fe089d4f950325a3d0a498c1c)): ?>
<?php $attributes = $__attributesOriginal306f477fe089d4f950325a3d0a498c1c; ?>
<?php unset($__attributesOriginal306f477fe089d4f950325a3d0a498c1c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal306f477fe089d4f950325a3d0a498c1c)): ?>
<?php $component = $__componentOriginal306f477fe089d4f950325a3d0a498c1c; ?>
<?php unset($__componentOriginal306f477fe089d4f950325a3d0a498c1c); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginal5c2a97ab476b69c1189ee85d1a95204b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.input','data' => ['id' => 'account-'.e($accountId).'-short-margin','name' => 'accountForms.'.e($accountId).'.margin_percentage_short','wire:model' => 'accountForms.'.e($accountId).'.margin_percentage_short','wire:blur' => 'clearAccountAbsoluteMargin('.e($accountId).')','dimension' => 'lg','inputmode' => 'decimal','placeholder' => '5.00']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'account-'.e($accountId).'-short-margin','name' => 'accountForms.'.e($accountId).'.margin_percentage_short','wire:model' => 'accountForms.'.e($accountId).'.margin_percentage_short','wire:blur' => 'clearAccountAbsoluteMargin('.e($accountId).')','dimension' => 'lg','inputmode' => 'decimal','placeholder' => '5.00']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b)): ?>
<?php $attributes = $__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b; ?>
<?php unset($__attributesOriginal5c2a97ab476b69c1189ee85d1a95204b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5c2a97ab476b69c1189ee85d1a95204b)): ?>
<?php $component = $__componentOriginal5c2a97ab476b69c1189ee85d1a95204b; ?>
<?php unset($__componentOriginal5c2a97ab476b69c1189ee85d1a95204b); ?>
<?php endif; ?>
                    <p class="mt-2 text-sm leading-5 text-zinc-500">Required when absolute margin is empty. Allowed range: 1.00% to 5.00%.</p>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__errorArgs = ["accountForms.{$accountId}.margin_percentage_short"];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-2 text-sm text-red-500/70"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <div class="col-span-12 grid gap-3 md:grid-cols-2 xl:grid-cols-4">
                    <div>
                        <?php if (isset($component)) { $__componentOriginal43da204543437953b216481011f1ac88 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal43da204543437953b216481011f1ac88 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.checkbox','data' => ['id' => 'account-'.e($accountId).'-active','name' => 'accountForms.'.e($accountId).'.is_active','wire:model' => 'accountForms.'.e($accountId).'.is_active','label' => 'Active account','color' => 'primary']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.checkbox'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'account-'.e($accountId).'-active','name' => 'accountForms.'.e($accountId).'.is_active','wire:model' => 'accountForms.'.e($accountId).'.is_active','label' => 'Active account','color' => 'primary']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal43da204543437953b216481011f1ac88)): ?>
<?php $attributes = $__attributesOriginal43da204543437953b216481011f1ac88; ?>
<?php unset($__attributesOriginal43da204543437953b216481011f1ac88); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal43da204543437953b216481011f1ac88)): ?>
<?php $component = $__componentOriginal43da204543437953b216481011f1ac88; ?>
<?php unset($__componentOriginal43da204543437953b216481011f1ac88); ?>
<?php endif; ?>
                        <p class="mt-2 text-sm leading-5 text-zinc-500">Makes this account available for Kraite operations.</p>
                    </div>
                    <div>
                        <?php if (isset($component)) { $__componentOriginal43da204543437953b216481011f1ac88 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal43da204543437953b216481011f1ac88 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.checkbox','data' => ['id' => 'account-'.e($accountId).'-trade','name' => 'accountForms.'.e($accountId).'.can_trade','wire:model' => 'accountForms.'.e($accountId).'.can_trade','label' => 'Can trade','color' => 'primary']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.checkbox'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'account-'.e($accountId).'-trade','name' => 'accountForms.'.e($accountId).'.can_trade','wire:model' => 'accountForms.'.e($accountId).'.can_trade','label' => 'Can trade','color' => 'primary']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal43da204543437953b216481011f1ac88)): ?>
<?php $attributes = $__attributesOriginal43da204543437953b216481011f1ac88; ?>
<?php unset($__attributesOriginal43da204543437953b216481011f1ac88); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal43da204543437953b216481011f1ac88)): ?>
<?php $component = $__componentOriginal43da204543437953b216481011f1ac88; ?>
<?php unset($__componentOriginal43da204543437953b216481011f1ac88); ?>
<?php endif; ?>
                        <p class="mt-2 text-sm leading-5 text-zinc-500">Allows Kraite to dispatch new positions for this account.</p>
                    </div>
                    <div>
                        <?php if (isset($component)) { $__componentOriginal43da204543437953b216481011f1ac88 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal43da204543437953b216481011f1ac88 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.checkbox','data' => ['id' => 'account-'.e($accountId).'-positions','name' => 'accountForms.'.e($accountId).'.allow_other_positions','wire:model' => 'accountForms.'.e($accountId).'.allow_other_positions','label' => 'Allow other positions','color' => 'primary']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.checkbox'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'account-'.e($accountId).'-positions','name' => 'accountForms.'.e($accountId).'.allow_other_positions','wire:model' => 'accountForms.'.e($accountId).'.allow_other_positions','label' => 'Allow other positions','color' => 'primary']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal43da204543437953b216481011f1ac88)): ?>
<?php $attributes = $__attributesOriginal43da204543437953b216481011f1ac88; ?>
<?php unset($__attributesOriginal43da204543437953b216481011f1ac88); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal43da204543437953b216481011f1ac88)): ?>
<?php $component = $__componentOriginal43da204543437953b216481011f1ac88; ?>
<?php unset($__componentOriginal43da204543437953b216481011f1ac88); ?>
<?php endif; ?>
                        <p class="mt-2 text-sm leading-5 text-zinc-500">Keeps manual exchange positions instead of closing unknown ones.</p>
                    </div>
                    <div>
                        <?php if (isset($component)) { $__componentOriginal43da204543437953b216481011f1ac88 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal43da204543437953b216481011f1ac88 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.checkbox','data' => ['id' => 'account-'.e($accountId).'-orders','name' => 'accountForms.'.e($accountId).'.allow_other_orders','wire:model' => 'accountForms.'.e($accountId).'.allow_other_orders','label' => 'Allow other orders','color' => 'primary']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.checkbox'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'account-'.e($accountId).'-orders','name' => 'accountForms.'.e($accountId).'.allow_other_orders','wire:model' => 'accountForms.'.e($accountId).'.allow_other_orders','label' => 'Allow other orders','color' => 'primary']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal43da204543437953b216481011f1ac88)): ?>
<?php $attributes = $__attributesOriginal43da204543437953b216481011f1ac88; ?>
<?php unset($__attributesOriginal43da204543437953b216481011f1ac88); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal43da204543437953b216481011f1ac88)): ?>
<?php $component = $__componentOriginal43da204543437953b216481011f1ac88; ?>
<?php unset($__componentOriginal43da204543437953b216481011f1ac88); ?>
<?php endif; ?>
                        <p class="mt-2 text-sm leading-5 text-zinc-500">Keeps manual exchange orders instead of cancelling unknown ones.</p>
                    </div>
                </div>

                <div class="col-span-12 flex items-center justify-end gap-3 border-t border-zinc-500/15 pt-4">
                    <div
                        wire:loading.flex
                        wire:target="saveAccount(<?php echo e($accountId); ?>)"
                        class="items-center gap-2 text-base text-zinc-500"
                    >
                        <span class="size-4 animate-spin rounded-full border-2 border-primary-500/20 border-t-primary-500"></span>
                        Saving
                    </div>
                    <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['type' => 'submit','variant' => 'solid','color' => 'primary','icon' => 'FloppyDisk','dimension' => 'lg']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'submit','variant' => 'solid','color' => 'primary','icon' => 'FloppyDisk','dimension' => 'lg']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                        Save Account
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $attributes = $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $component = $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
                </div>
            </form>
            </div>

            <div x-show="accountTab === 'connectivity'" x-transition.opacity.duration.200ms x-cloak>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($connectivity && ! ($connectivity['is_complete'] ?? false)): ?>
                    <div wire:poll.1s="pollAccountConnectivity(<?php echo e($accountId); ?>)" class="hidden"></div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <div class="flex flex-col gap-3 rounded-xl border border-zinc-500/15 bg-zinc-950/[0.02] p-4 dark:bg-white/[0.02] md:flex-row md:items-center md:justify-between">
                    <div class="flex min-w-0 items-start gap-3">
                        <div class="flex size-10 shrink-0 items-center justify-center rounded-lg border border-primary-500/25 bg-primary-500/10 text-primary-500">
                            <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'Computer','size' => 'text-2xl']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'Computer','size' => 'text-2xl']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
                        </div>
                        <div class="min-w-0">
                            <div class="text-lg font-semibold text-zinc-900 dark:text-zinc-100">Server connectivity</div>
                            <p class="mt-1 text-sm leading-5 text-zinc-500">
                                Test exchange API access from each API execution server using this account credentials.
                            </p>
                        </div>
                    </div>

                    <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['type' => 'button','variant' => 'solid','color' => 'primary','icon' => 'Loading03','dimension' => 'lg','wire:click' => 'startAccountConnectivity('.e($accountId).')','wire:loading.attr' => 'disabled','wire:target' => 'startAccountConnectivity('.e($accountId).')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'button','variant' => 'solid','color' => 'primary','icon' => 'Loading03','dimension' => 'lg','wire:click' => 'startAccountConnectivity('.e($accountId).')','wire:loading.attr' => 'disabled','wire:target' => 'startAccountConnectivity('.e($accountId).')']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                        <span wire:loading.remove wire:target="startAccountConnectivity(<?php echo e($accountId); ?>)">Test servers connectivity</span>
                        <span wire:loading wire:target="startAccountConnectivity(<?php echo e($accountId); ?>)">Starting...</span>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $attributes = $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $component = $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
                </div>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($connectivity): ?>
                    <div class="mt-3 overflow-hidden rounded-xl border border-zinc-500/15">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = ($connectivity['servers'] ?? []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $server): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <?php
                                $status = $server['status'] ?? 'testing';
                                $statusClasses = match ($status) {
                                    'connected' => 'border-primary-500/25 bg-primary-500/10 text-primary-500',
                                    'not_connected' => 'border-red-500/25 bg-red-500/10 text-red-500',
                                    default => 'border-amber-500/25 bg-amber-500/10 text-amber-500',
                                };
                                $statusLabel = match ($status) {
                                    'connected' => 'Connected',
                                    'not_connected' => 'Not connected',
                                    default => 'Testing',
                                };
                            ?>

                            <div class="flex flex-col gap-3 border-b border-zinc-500/10 bg-white/60 px-4 py-3 last:border-b-0 dark:bg-zinc-950/60 md:flex-row md:items-center md:justify-between">
                                <div class="flex min-w-0 items-center gap-3">
                                    <div class="flex size-9 shrink-0 items-center justify-center rounded-lg border border-zinc-500/15 bg-zinc-500/10 text-zinc-500">
                                        <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'Computer','size' => 'text-xl']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'Computer','size' => 'text-xl']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
                                    </div>
                                    <div class="min-w-0">
                                        <div class="truncate text-base font-semibold text-zinc-900 dark:text-zinc-100"><?php echo e($server['hostname']); ?></div>
                                        <div class="mt-0.5 flex flex-wrap items-center gap-x-3 gap-y-1 text-sm text-zinc-500">
                                            <span><?php echo e($server['ip_address']); ?></span>
                                            <span>Queue <?php echo e($server['queue']); ?></span>
                                        </div>
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(! empty($server['error_message'])): ?>
                                            <div class="mt-1 text-sm text-red-500/80"><?php echo e($server['error_message']); ?></div>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>
                                </div>

                                <div class="flex shrink-0 items-center gap-2">
                                    <span class="inline-flex items-center gap-2 rounded-lg border px-3 py-1 text-sm font-semibold <?php echo e($statusClasses); ?>">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($status === 'testing'): ?>
                                            <span class="size-3 animate-spin rounded-full border-2 border-current/25 border-t-current"></span>
                                        <?php else: ?>
                                            <span class="size-2 rounded-full bg-current"></span>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        <?php echo e($statusLabel); ?>

                                    </span>

                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($server['can_notify_user'] ?? false): ?>
                                        <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['type' => 'button','variant' => 'outline','color' => 'primary','icon' => 'Notification03','dimension' => 'sm','wire:click' => 'sendConnectivityNotification('.e($accountId).', '.e((int) $server['id']).')','wire:loading.attr' => 'disabled','wire:target' => 'sendConnectivityNotification('.e($accountId).', '.e((int) $server['id']).')']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'button','variant' => 'outline','color' => 'primary','icon' => 'Notification03','dimension' => 'sm','wire:click' => 'sendConnectivityNotification('.e($accountId).', '.e((int) $server['id']).')','wire:loading.attr' => 'disabled','wire:target' => 'sendConnectivityNotification('.e($accountId).', '.e((int) $server['id']).')']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                                            Send User notification
                                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $attributes = $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $component = $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                            </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                            <div class="px-4 py-5 text-center text-sm text-zinc-500">No API execution servers configured.</div>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /Users/falcaob/Herd/console.kraite.test/resources/views/components/users/accounts/row.blade.php ENDPATH**/ ?>