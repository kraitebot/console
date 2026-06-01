<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'accounts' => [],
    'selectedAccountId' => null,
    'data' => null,
    'history' => [],
    'historyPage' => 1,
    'historyLastPage' => 1,
    'historyTotal' => 0,
    'onlyDrifts' => false,
    'expandedPairs' => [],
    'expandedHistory' => [],
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
    'accounts' => [],
    'selectedAccountId' => null,
    'data' => null,
    'history' => [],
    'historyPage' => 1,
    'historyLastPage' => 1,
    'historyTotal' => 0,
    'onlyDrifts' => false,
    'expandedPairs' => [],
    'expandedHistory' => [],
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $pairs = collect($data['pairs'] ?? []);
    $orphanOrders = collect($data['orphan_orders'] ?? []);
    $visiblePairs = $onlyDrifts
        ? $pairs->filter(fn ($pair) => ! in_array($pair['status'], ['synced', 'transient'], true))
        : $pairs;
    $dbPositionCount = $pairs->filter(fn ($pair) => filled($pair['db'] ?? null))->count();
    $exchangePositionCount = $pairs->filter(fn ($pair) => filled($pair['exchange'] ?? null))->count();
    $totalOrderCount = $pairs->sum(fn ($pair) => $pair['order_counts']['total'] ?? 0) + $orphanOrders->count();
    $driftCount = $pairs->filter(fn ($pair) => ! in_array($pair['status'], ['synced', 'transient'], true))->count() + $orphanOrders->count();
    $selectedAccount = collect($accounts)->firstWhere('id', $selectedAccountId);
    $statusColors = [
        'synced' => 'emerald',
        'drift' => 'amber',
        'db_only' => 'red',
        'exchange_only' => 'amber',
        'transient' => 'blue',
    ];
    $statusLabels = [
        'synced' => 'Synced',
        'drift' => 'Drift',
        'db_only' => 'DB only',
        'exchange_only' => 'Exchange only',
        'transient' => 'Transient',
    ];
    $formatPnl = fn ($value) => $value === null || $value === '' ? '-' : (((float) $value > 0 ? '+' : '').number_format((float) $value, 4, '.', ''));
    $pnlClass = fn ($value) => $value === null || $value === '' ? 'text-zinc-500' : ((float) $value > 0 ? 'text-emerald-400' : ((float) $value < 0 ? 'text-red-400' : 'text-zinc-400'));
?>

<div data-component-name="Users/PositionsPanel" class="space-y-6">
    <?php if (isset($component)) { $__componentOriginal53747ceb358d30c0105769f8471417f6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal53747ceb358d30c0105769f8471417f6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

        <?php if (isset($component)) { $__componentOriginal1d4357ee5fd8f0dcba6696de07062857 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1d4357ee5fd8f0dcba6696de07062857 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card.header','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card.header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

            <?php if (isset($component)) { $__componentOriginal64def30c24bacd2a907516c6e38a984d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal64def30c24bacd2a907516c6e38a984d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card.header-child','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card.header-child'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                <?php if (isset($component)) { $__componentOriginal6ea0bfee1a50e1de1096e35e7b344cad = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6ea0bfee1a50e1de1096e35e7b344cad = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card.title','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card.title'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                    <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'ProductLoading','color' => 'primary','size' => 'text-3xl']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'ProductLoading','color' => 'primary','size' => 'text-3xl']); ?>
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
                    <div>
                        <div>Positions</div>
                        <?php if (isset($component)) { $__componentOriginal4b3274c71e2431ef5ee1e1179f61765f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4b3274c71e2431ef5ee1e1179f61765f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card.subtitle','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card.subtitle'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>
Database and exchange reconciliation <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4b3274c71e2431ef5ee1e1179f61765f)): ?>
<?php $attributes = $__attributesOriginal4b3274c71e2431ef5ee1e1179f61765f; ?>
<?php unset($__attributesOriginal4b3274c71e2431ef5ee1e1179f61765f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4b3274c71e2431ef5ee1e1179f61765f)): ?>
<?php $component = $__componentOriginal4b3274c71e2431ef5ee1e1179f61765f; ?>
<?php unset($__componentOriginal4b3274c71e2431ef5ee1e1179f61765f); ?>
<?php endif; ?>
                    </div>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6ea0bfee1a50e1de1096e35e7b344cad)): ?>
<?php $attributes = $__attributesOriginal6ea0bfee1a50e1de1096e35e7b344cad; ?>
<?php unset($__attributesOriginal6ea0bfee1a50e1de1096e35e7b344cad); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6ea0bfee1a50e1de1096e35e7b344cad)): ?>
<?php $component = $__componentOriginal6ea0bfee1a50e1de1096e35e7b344cad; ?>
<?php unset($__componentOriginal6ea0bfee1a50e1de1096e35e7b344cad); ?>
<?php endif; ?>
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal64def30c24bacd2a907516c6e38a984d)): ?>
<?php $attributes = $__attributesOriginal64def30c24bacd2a907516c6e38a984d; ?>
<?php unset($__attributesOriginal64def30c24bacd2a907516c6e38a984d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal64def30c24bacd2a907516c6e38a984d)): ?>
<?php $component = $__componentOriginal64def30c24bacd2a907516c6e38a984d; ?>
<?php unset($__componentOriginal64def30c24bacd2a907516c6e38a984d); ?>
<?php endif; ?>
            <?php if (isset($component)) { $__componentOriginal64def30c24bacd2a907516c6e38a984d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal64def30c24bacd2a907516c6e38a984d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card.header-child','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card.header-child'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                <div class="flex items-center gap-3">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($accounts) > 1): ?>
                        <?php if (isset($component)) { $__componentOriginal8cee41e4af1fe2df52d1d5acd06eed36 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8cee41e4af1fe2df52d1d5acd06eed36 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form.select','data' => ['id' => 'position_account','name' => 'position_account','wire:change' => 'selectPositionAccount($event.target.value)','dimension' => 'lg']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form.select'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'position_account','name' => 'position_account','wire:change' => 'selectPositionAccount($event.target.value)','dimension' => 'lg']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <option value="<?php echo e($account['id']); ?>" <?php if((int) $selectedAccountId === (int) $account['id']): echo 'selected'; endif; ?>>
                                    <?php echo e($account['name']); ?> - <?php echo e($account['exchange']); ?>

                                </option>
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
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($selectedAccountId): ?>
                        <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['wire:click' => 'refreshPositions','wire:loading.attr' => 'disabled','wire:target' => 'refreshPositions','color' => 'primary','icon' => 'Refresh']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:click' => 'refreshPositions','wire:loading.attr' => 'disabled','wire:target' => 'refreshPositions','color' => 'primary','icon' => 'Refresh']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                            Refresh
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
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal64def30c24bacd2a907516c6e38a984d)): ?>
<?php $attributes = $__attributesOriginal64def30c24bacd2a907516c6e38a984d; ?>
<?php unset($__attributesOriginal64def30c24bacd2a907516c6e38a984d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal64def30c24bacd2a907516c6e38a984d)): ?>
<?php $component = $__componentOriginal64def30c24bacd2a907516c6e38a984d; ?>
<?php unset($__componentOriginal64def30c24bacd2a907516c6e38a984d); ?>
<?php endif; ?>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1d4357ee5fd8f0dcba6696de07062857)): ?>
<?php $attributes = $__attributesOriginal1d4357ee5fd8f0dcba6696de07062857; ?>
<?php unset($__attributesOriginal1d4357ee5fd8f0dcba6696de07062857); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1d4357ee5fd8f0dcba6696de07062857)): ?>
<?php $component = $__componentOriginal1d4357ee5fd8f0dcba6696de07062857; ?>
<?php unset($__componentOriginal1d4357ee5fd8f0dcba6696de07062857); ?>
<?php endif; ?>

        <?php if (isset($component)) { $__componentOriginalcc4d6dcf44f2ce2176eee5939e2828e6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcc4d6dcf44f2ce2176eee5939e2828e6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card.body','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card.body'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($accounts) === 0): ?>
                <?php if (isset($component)) { $__componentOriginal4f22a152e0729cd34293e65bd200d933 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4f22a152e0729cd34293e65bd200d933 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.empty','data' => ['title' => 'No accounts','description' => 'This user has no linked exchange accounts.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('empty'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'No accounts','description' => 'This user has no linked exchange accounts.']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4f22a152e0729cd34293e65bd200d933)): ?>
<?php $attributes = $__attributesOriginal4f22a152e0729cd34293e65bd200d933; ?>
<?php unset($__attributesOriginal4f22a152e0729cd34293e65bd200d933); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4f22a152e0729cd34293e65bd200d933)): ?>
<?php $component = $__componentOriginal4f22a152e0729cd34293e65bd200d933; ?>
<?php unset($__componentOriginal4f22a152e0729cd34293e65bd200d933); ?>
<?php endif; ?>
            <?php elseif(! $data): ?>
                <div class="flex items-center justify-center py-16">
                    <span class="size-6 animate-spin rounded-full border-2 border-primary-500/20 border-t-primary-500"></span>
                </div>
            <?php else: ?>
                <div class="space-y-6">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($data['api_error'] ?? null): ?>
                        <div class="rounded-lg border border-amber-500/20 bg-amber-500/10 px-4 py-3 text-sm text-amber-300">
                            <?php echo e($data['api_error']); ?>

                        </div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <div class="overflow-hidden rounded-lg border border-zinc-800 bg-zinc-950">
                        <div class="flex flex-col gap-4 p-5 lg:flex-row lg:items-center">
                            <div class="flex flex-1 items-center gap-4">
                                <div class="flex size-12 items-center justify-center overflow-hidden rounded-lg bg-zinc-900">
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($selectedAccount['exchange_logo'] ?? null): ?>
                                        <img src="<?php echo e($selectedAccount['exchange_logo']); ?>" alt="<?php echo e($selectedAccount['exchange']); ?>" class="size-full object-contain">
                                    <?php else: ?>
                                        <span class="text-lg font-bold text-zinc-500"><?php echo e(str($selectedAccount['name'] ?? '?')->substr(0, 1)->upper()); ?></span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </div>
                                <div>
                                    <div class="flex flex-wrap items-center gap-2">
                                        <h3 class="text-lg font-semibold text-zinc-100"><?php echo e($selectedAccount['name'] ?? 'Account'); ?></h3>
                                        <?php if (isset($component)) { $__componentOriginal2ddbc40e602c342e508ac696e52f8719 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2ddbc40e602c342e508ac696e52f8719 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.badge','data' => ['color' => ($selectedAccount['can_trade'] ?? false) ? 'emerald' : 'red']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(($selectedAccount['can_trade'] ?? false) ? 'emerald' : 'red')]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                                            <?php echo e(($selectedAccount['can_trade'] ?? false) ? 'Active' : 'Inactive'); ?>

                                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2ddbc40e602c342e508ac696e52f8719)): ?>
<?php $attributes = $__attributesOriginal2ddbc40e602c342e508ac696e52f8719; ?>
<?php unset($__attributesOriginal2ddbc40e602c342e508ac696e52f8719); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2ddbc40e602c342e508ac696e52f8719)): ?>
<?php $component = $__componentOriginal2ddbc40e602c342e508ac696e52f8719; ?>
<?php unset($__componentOriginal2ddbc40e602c342e508ac696e52f8719); ?>
<?php endif; ?>
                                        <?php if (isset($component)) { $__componentOriginal2ddbc40e602c342e508ac696e52f8719 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2ddbc40e602c342e508ac696e52f8719 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.badge','data' => ['color' => $driftCount === 0 ? 'emerald' : 'amber']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($driftCount === 0 ? 'emerald' : 'amber')]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                                            <?php echo e($driftCount === 0 ? 'In sync' : $driftCount.' drift'); ?>

                                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2ddbc40e602c342e508ac696e52f8719)): ?>
<?php $attributes = $__attributesOriginal2ddbc40e602c342e508ac696e52f8719; ?>
<?php unset($__attributesOriginal2ddbc40e602c342e508ac696e52f8719); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2ddbc40e602c342e508ac696e52f8719)): ?>
<?php $component = $__componentOriginal2ddbc40e602c342e508ac696e52f8719; ?>
<?php unset($__componentOriginal2ddbc40e602c342e508ac696e52f8719); ?>
<?php endif; ?>
                                    </div>
                                    <div class="mt-1 font-mono text-sm text-zinc-500"><?php echo e($selectedAccount['exchange'] ?? 'Unknown exchange'); ?></div>
                                </div>
                            </div>

                            <div class="grid grid-cols-4 overflow-hidden rounded-lg border border-zinc-800">
                                <?php if (isset($component)) { $__componentOriginal9bacf4b2d448a370fd9180b64e73940a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9bacf4b2d448a370fd9180b64e73940a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.users.positions.stat','data' => ['label' => 'DB Pos','value' => $dbPositionCount]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('users.positions.stat'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'DB Pos','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($dbPositionCount)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9bacf4b2d448a370fd9180b64e73940a)): ?>
<?php $attributes = $__attributesOriginal9bacf4b2d448a370fd9180b64e73940a; ?>
<?php unset($__attributesOriginal9bacf4b2d448a370fd9180b64e73940a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9bacf4b2d448a370fd9180b64e73940a)): ?>
<?php $component = $__componentOriginal9bacf4b2d448a370fd9180b64e73940a; ?>
<?php unset($__componentOriginal9bacf4b2d448a370fd9180b64e73940a); ?>
<?php endif; ?>
                                <?php if (isset($component)) { $__componentOriginal9bacf4b2d448a370fd9180b64e73940a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9bacf4b2d448a370fd9180b64e73940a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.users.positions.stat','data' => ['label' => 'Ex Pos','value' => $exchangePositionCount]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('users.positions.stat'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Ex Pos','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($exchangePositionCount)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9bacf4b2d448a370fd9180b64e73940a)): ?>
<?php $attributes = $__attributesOriginal9bacf4b2d448a370fd9180b64e73940a; ?>
<?php unset($__attributesOriginal9bacf4b2d448a370fd9180b64e73940a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9bacf4b2d448a370fd9180b64e73940a)): ?>
<?php $component = $__componentOriginal9bacf4b2d448a370fd9180b64e73940a; ?>
<?php unset($__componentOriginal9bacf4b2d448a370fd9180b64e73940a); ?>
<?php endif; ?>
                                <?php if (isset($component)) { $__componentOriginal9bacf4b2d448a370fd9180b64e73940a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9bacf4b2d448a370fd9180b64e73940a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.users.positions.stat','data' => ['label' => 'Orders','value' => $totalOrderCount]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('users.positions.stat'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Orders','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($totalOrderCount)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9bacf4b2d448a370fd9180b64e73940a)): ?>
<?php $attributes = $__attributesOriginal9bacf4b2d448a370fd9180b64e73940a; ?>
<?php unset($__attributesOriginal9bacf4b2d448a370fd9180b64e73940a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9bacf4b2d448a370fd9180b64e73940a)): ?>
<?php $component = $__componentOriginal9bacf4b2d448a370fd9180b64e73940a; ?>
<?php unset($__componentOriginal9bacf4b2d448a370fd9180b64e73940a); ?>
<?php endif; ?>
                                <?php if (isset($component)) { $__componentOriginal9bacf4b2d448a370fd9180b64e73940a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9bacf4b2d448a370fd9180b64e73940a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.users.positions.stat','data' => ['label' => 'Drift','value' => $driftCount,'danger' => $driftCount > 0]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('users.positions.stat'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['label' => 'Drift','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($driftCount),'danger' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($driftCount > 0)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9bacf4b2d448a370fd9180b64e73940a)): ?>
<?php $attributes = $__attributesOriginal9bacf4b2d448a370fd9180b64e73940a; ?>
<?php unset($__attributesOriginal9bacf4b2d448a370fd9180b64e73940a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9bacf4b2d448a370fd9180b64e73940a)): ?>
<?php $component = $__componentOriginal9bacf4b2d448a370fd9180b64e73940a; ?>
<?php unset($__componentOriginal9bacf4b2d448a370fd9180b64e73940a); ?>
<?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <div>
                            <h3 class="text-base font-semibold text-zinc-100">Open positions</h3>
                            <p class="font-mono text-sm text-zinc-500"><?php echo e($visiblePairs->count()); ?> / <?php echo e($pairs->count()); ?></p>
                        </div>
                        <span class="flex-1"></span>
                        <label class="flex cursor-pointer items-center gap-2 text-sm text-zinc-400">
                            <input type="checkbox" wire:model.live="onlyPositionDrifts" class="size-4 rounded border-zinc-700 bg-zinc-900 text-primary-500 focus:ring-primary-500">
                            Only drifts
                        </label>
                    </div>

                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($pairs->isEmpty()): ?>
                        <div class="rounded-lg border border-zinc-800 bg-zinc-950 px-5 py-4 text-zinc-500">No open positions.</div>
                    <?php elseif($visiblePairs->isEmpty()): ?>
                        <div class="rounded-lg border border-zinc-800 bg-zinc-950 px-5 py-4 text-zinc-500">All positions are in sync.</div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                    <div class="space-y-2">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $visiblePairs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pair): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                            <?php
                                $pairKey = $pair['symbol'].'|'.$pair['direction'];
                                $isOpen = $expandedPairs[$pairKey] ?? false;
                                $status = $pair['status'];
                            ?>
                            <div class="overflow-hidden rounded-lg border border-zinc-800 bg-zinc-950">
                                <button type="button" wire:click="togglePositionPair('<?php echo e($pairKey); ?>')" class="flex w-full items-center gap-3 px-4 py-3 text-left transition-colors hover:bg-primary-500/5">
                                    <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'ArrowRight01','class' => ''.e($isOpen ? 'rotate-90' : '').' text-zinc-500 transition-transform']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'ArrowRight01','class' => ''.e($isOpen ? 'rotate-90' : '').' text-zinc-500 transition-transform']); ?>
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
                                    <div class="flex size-7 items-center justify-center overflow-hidden rounded-full bg-zinc-900">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($pair['token_image']): ?>
                                            <img src="<?php echo e($pair['token_image']); ?>" alt="<?php echo e($pair['token']); ?>" class="size-full object-cover">
                                        <?php else: ?>
                                            <span class="text-xs font-bold text-zinc-500"><?php echo e(str($pair['token'] ?? $pair['symbol'])->substr(0, 3)->upper()); ?></span>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    </div>
                                    <span class="font-mono text-base font-semibold text-zinc-100"><?php echo e($pair['symbol']); ?></span>
                                    <?php if (isset($component)) { $__componentOriginal2ddbc40e602c342e508ac696e52f8719 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2ddbc40e602c342e508ac696e52f8719 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.badge','data' => ['color' => $pair['direction'] === 'LONG' ? 'emerald' : 'red']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($pair['direction'] === 'LONG' ? 'emerald' : 'red')]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>
<?php echo e($pair['direction']); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2ddbc40e602c342e508ac696e52f8719)): ?>
<?php $attributes = $__attributesOriginal2ddbc40e602c342e508ac696e52f8719; ?>
<?php unset($__attributesOriginal2ddbc40e602c342e508ac696e52f8719); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2ddbc40e602c342e508ac696e52f8719)): ?>
<?php $component = $__componentOriginal2ddbc40e602c342e508ac696e52f8719; ?>
<?php unset($__componentOriginal2ddbc40e602c342e508ac696e52f8719); ?>
<?php endif; ?>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($pair['db']['opened_seconds_ago'] ?? null): ?>
                                        <span class="hidden font-mono text-sm text-zinc-500 sm:inline"><?php echo e(floor($pair['db']['opened_seconds_ago'] / 60)); ?>m ago</span>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                    <span class="flex-1"></span>
                                    <span class="hidden font-mono text-sm text-zinc-500 sm:inline"><?php echo e($pair['order_counts']['total']); ?> orders</span>
                                    <?php if (isset($component)) { $__componentOriginal2ddbc40e602c342e508ac696e52f8719 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2ddbc40e602c342e508ac696e52f8719 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.badge','data' => ['color' => $statusColors[$status] ?? 'zinc']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($statusColors[$status] ?? 'zinc')]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>
<?php echo e($statusLabels[$status] ?? ucfirst($status)); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2ddbc40e602c342e508ac696e52f8719)): ?>
<?php $attributes = $__attributesOriginal2ddbc40e602c342e508ac696e52f8719; ?>
<?php unset($__attributesOriginal2ddbc40e602c342e508ac696e52f8719); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2ddbc40e602c342e508ac696e52f8719)): ?>
<?php $component = $__componentOriginal2ddbc40e602c342e508ac696e52f8719; ?>
<?php unset($__componentOriginal2ddbc40e602c342e508ac696e52f8719); ?>
<?php endif; ?>
                                </button>

                                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isOpen): ?>
                                    <div class="border-t border-zinc-800">
                                        <div class="grid grid-cols-1 md:grid-cols-2">
                                            <?php if (isset($component)) { $__componentOriginal4680bad44b436e646f4cf014459da442 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4680bad44b436e646f4cf014459da442 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.users.positions.side','data' => ['title' => 'Database','position' => $pair['db']]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('users.positions.side'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Database','position' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($pair['db'])]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4680bad44b436e646f4cf014459da442)): ?>
<?php $attributes = $__attributesOriginal4680bad44b436e646f4cf014459da442; ?>
<?php unset($__attributesOriginal4680bad44b436e646f4cf014459da442); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4680bad44b436e646f4cf014459da442)): ?>
<?php $component = $__componentOriginal4680bad44b436e646f4cf014459da442; ?>
<?php unset($__componentOriginal4680bad44b436e646f4cf014459da442); ?>
<?php endif; ?>
                                            <?php if (isset($component)) { $__componentOriginal4680bad44b436e646f4cf014459da442 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4680bad44b436e646f4cf014459da442 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.users.positions.side','data' => ['title' => 'Exchange','position' => $pair['exchange'],'exchange' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('users.positions.side'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Exchange','position' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($pair['exchange']),'exchange' => true]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4680bad44b436e646f4cf014459da442)): ?>
<?php $attributes = $__attributesOriginal4680bad44b436e646f4cf014459da442; ?>
<?php unset($__attributesOriginal4680bad44b436e646f4cf014459da442); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4680bad44b436e646f4cf014459da442)): ?>
<?php $component = $__componentOriginal4680bad44b436e646f4cf014459da442; ?>
<?php unset($__componentOriginal4680bad44b436e646f4cf014459da442); ?>
<?php endif; ?>
                                        </div>

                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($pair['orders']) > 0): ?>
                                            <?php if (isset($component)) { $__componentOriginale89e2f4fcd7b47b2d4847f01d6b56664 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale89e2f4fcd7b47b2d4847f01d6b56664 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.users.positions.orders','data' => ['orders' => $pair['orders']]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('users.positions.orders'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['orders' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($pair['orders'])]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale89e2f4fcd7b47b2d4847f01d6b56664)): ?>
<?php $attributes = $__attributesOriginale89e2f4fcd7b47b2d4847f01d6b56664; ?>
<?php unset($__attributesOriginale89e2f4fcd7b47b2d4847f01d6b56664); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale89e2f4fcd7b47b2d4847f01d6b56664)): ?>
<?php $component = $__componentOriginale89e2f4fcd7b47b2d4847f01d6b56664; ?>
<?php unset($__componentOriginale89e2f4fcd7b47b2d4847f01d6b56664); ?>
<?php endif; ?>
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                                        <?php if (isset($component)) { $__componentOriginal182b116dff2cfabfd172c3e29af7003d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal182b116dff2cfabfd172c3e29af7003d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.users.positions.projections','data' => ['rows' => $pair['pnl_projections']]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('users.positions.projections'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['rows' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($pair['pnl_projections'])]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal182b116dff2cfabfd172c3e29af7003d)): ?>
<?php $attributes = $__attributesOriginal182b116dff2cfabfd172c3e29af7003d; ?>
<?php unset($__attributesOriginal182b116dff2cfabfd172c3e29af7003d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal182b116dff2cfabfd172c3e29af7003d)): ?>
<?php $component = $__componentOriginal182b116dff2cfabfd172c3e29af7003d; ?>
<?php unset($__componentOriginal182b116dff2cfabfd172c3e29af7003d); ?>
<?php endif; ?>
                                    </div>
                                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                            </div>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    </div>

                    <div class="space-y-3 pt-4">
                        <div class="flex items-center gap-2">
                            <h3 class="text-base font-semibold text-zinc-100">All positions</h3>
                            <span class="font-mono text-sm text-zinc-500"><?php echo e($historyTotal); ?></span>
                        </div>

                        <div class="overflow-hidden rounded-lg border border-zinc-800 bg-zinc-950">
                            <div class="overflow-x-auto">
                                <table class="w-full min-w-[980px] font-mono text-sm">
                                    <thead class="bg-primary-500 text-zinc-950">
                                        <tr>
                                            <th class="w-10 px-4 py-3"></th>
                                            <th class="px-3 py-3 text-left">Symbol</th>
                                            <th class="px-3 py-3 text-left">Dir</th>
                                            <th class="px-3 py-3 text-left">Status</th>
                                            <th class="px-3 py-3 text-right">Qty</th>
                                            <th class="px-3 py-3 text-right">Entry</th>
                                            <th class="px-3 py-3 text-right">Exit</th>
                                            <th class="px-3 py-3 text-right">Lev</th>
                                            <th class="px-3 py-3 text-right">PnL</th>
                                            <th class="px-3 py-3 text-right">Orders</th>
                                            <th class="px-4 py-3 text-left">Opened</th>
                                        </tr>
                                    </thead>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__empty_1 = true; $__currentLoopData = $history; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $position): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                        <?php $historyOpen = $expandedHistory[$position['id']] ?? false; ?>
                                        <tbody>
                                            <tr wire:click="togglePositionHistory(<?php echo e($position['id']); ?>)" class="cursor-pointer border-t border-zinc-900 transition-colors hover:bg-primary-500/5">
                                                <td class="px-4 py-3"><?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'ArrowRight01','class' => ''.e($historyOpen ? 'rotate-90' : '').' text-zinc-500 transition-transform']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'ArrowRight01','class' => ''.e($historyOpen ? 'rotate-90' : '').' text-zinc-500 transition-transform']); ?>
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
<?php endif; ?></td>
                                                <td class="px-3 py-3 font-semibold text-zinc-100"><?php echo e($position['symbol']); ?></td>
                                                <td class="px-3 py-3"><?php if (isset($component)) { $__componentOriginal2ddbc40e602c342e508ac696e52f8719 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2ddbc40e602c342e508ac696e52f8719 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.badge','data' => ['color' => $position['direction'] === 'LONG' ? 'emerald' : 'red']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($position['direction'] === 'LONG' ? 'emerald' : 'red')]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>
<?php echo e($position['direction']); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2ddbc40e602c342e508ac696e52f8719)): ?>
<?php $attributes = $__attributesOriginal2ddbc40e602c342e508ac696e52f8719; ?>
<?php unset($__attributesOriginal2ddbc40e602c342e508ac696e52f8719); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2ddbc40e602c342e508ac696e52f8719)): ?>
<?php $component = $__componentOriginal2ddbc40e602c342e508ac696e52f8719; ?>
<?php unset($__componentOriginal2ddbc40e602c342e508ac696e52f8719); ?>
<?php endif; ?></td>
                                                <td class="px-3 py-3 text-zinc-400"><?php echo e($position['status']); ?></td>
                                                <td class="px-3 py-3 text-right text-zinc-300"><?php echo e($position['quantity'] ?: '-'); ?></td>
                                                <td class="px-3 py-3 text-right text-zinc-300"><?php echo e($position['opening_price'] ?: '-'); ?></td>
                                                <td class="px-3 py-3 text-right text-zinc-500"><?php echo e($position['closing_price'] ?: '-'); ?></td>
                                                <td class="px-3 py-3 text-right text-zinc-500"><?php echo e($position['leverage']); ?>x</td>
                                                <td class="px-3 py-3 text-right <?php echo e($pnlClass($position['pnl'])); ?>"><?php echo e($formatPnl($position['pnl'])); ?></td>
                                                <td class="px-3 py-3 text-right text-zinc-500"><?php echo e($position['order_count']); ?></td>
                                                <td class="px-4 py-3 text-zinc-500"><?php echo e($position['created_at'] ?: '-'); ?></td>
                                            </tr>
                                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($historyOpen): ?>
                                                <tr class="border-t border-zinc-900 bg-zinc-900/40">
                                                    <td></td>
                                                    <td colspan="10" class="px-3 py-4">
                                                        <?php if (isset($component)) { $__componentOriginale89e2f4fcd7b47b2d4847f01d6b56664 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale89e2f4fcd7b47b2d4847f01d6b56664 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.users.positions.orders','data' => ['orders' => collect($position['orders'])->map(fn ($order) => ['status' => 'synced', 'db' => $order, 'exchange' => null, 'drift_fields' => []])->all(),'compact' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('users.positions.orders'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['orders' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(collect($position['orders'])->map(fn ($order) => ['status' => 'synced', 'db' => $order, 'exchange' => null, 'drift_fields' => []])->all()),'compact' => true]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale89e2f4fcd7b47b2d4847f01d6b56664)): ?>
<?php $attributes = $__attributesOriginale89e2f4fcd7b47b2d4847f01d6b56664; ?>
<?php unset($__attributesOriginale89e2f4fcd7b47b2d4847f01d6b56664); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale89e2f4fcd7b47b2d4847f01d6b56664)): ?>
<?php $component = $__componentOriginale89e2f4fcd7b47b2d4847f01d6b56664; ?>
<?php unset($__componentOriginale89e2f4fcd7b47b2d4847f01d6b56664); ?>
<?php endif; ?>
                                                        <?php if (isset($component)) { $__componentOriginal182b116dff2cfabfd172c3e29af7003d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal182b116dff2cfabfd172c3e29af7003d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.users.positions.projections','data' => ['rows' => $position['pnl_projections'],'compact' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('users.positions.projections'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['rows' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($position['pnl_projections']),'compact' => true]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal182b116dff2cfabfd172c3e29af7003d)): ?>
<?php $attributes = $__attributesOriginal182b116dff2cfabfd172c3e29af7003d; ?>
<?php unset($__attributesOriginal182b116dff2cfabfd172c3e29af7003d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal182b116dff2cfabfd172c3e29af7003d)): ?>
<?php $component = $__componentOriginal182b116dff2cfabfd172c3e29af7003d; ?>
<?php unset($__componentOriginal182b116dff2cfabfd172c3e29af7003d); ?>
<?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                        </tbody>
                                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                                        <tbody>
                                            <tr>
                                                <td colspan="11" class="px-4 py-6 text-center text-zinc-500">No positions recorded for this account.</td>
                                            </tr>
                                        </tbody>
                                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                                </table>
                            </div>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($historyLastPage > 1): ?>
                                <div class="flex items-center justify-end gap-2 border-t border-zinc-800 px-4 py-3">
                                    <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['wire:click' => 'loadPositionHistory('.e(max(1, $historyPage - 1)).')','variant' => 'ghost','color' => 'zinc','disabled' => $historyPage <= 1]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:click' => 'loadPositionHistory('.e(max(1, $historyPage - 1)).')','variant' => 'ghost','color' => 'zinc','disabled' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($historyPage <= 1)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>
Previous <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $attributes = $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $component = $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
                                    <span class="font-mono text-sm text-zinc-500">Page <?php echo e($historyPage); ?> of <?php echo e($historyLastPage); ?></span>
                                    <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['wire:click' => 'loadPositionHistory('.e(min($historyLastPage, $historyPage + 1)).')','variant' => 'ghost','color' => 'zinc','disabled' => $historyPage >= $historyLastPage]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:click' => 'loadPositionHistory('.e(min($historyLastPage, $historyPage + 1)).')','variant' => 'ghost','color' => 'zinc','disabled' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($historyPage >= $historyLastPage)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>
Next <?php echo $__env->renderComponent(); ?>
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
                            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalcc4d6dcf44f2ce2176eee5939e2828e6)): ?>
<?php $attributes = $__attributesOriginalcc4d6dcf44f2ce2176eee5939e2828e6; ?>
<?php unset($__attributesOriginalcc4d6dcf44f2ce2176eee5939e2828e6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalcc4d6dcf44f2ce2176eee5939e2828e6)): ?>
<?php $component = $__componentOriginalcc4d6dcf44f2ce2176eee5939e2828e6; ?>
<?php unset($__componentOriginalcc4d6dcf44f2ce2176eee5939e2828e6); ?>
<?php endif; ?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal53747ceb358d30c0105769f8471417f6)): ?>
<?php $attributes = $__attributesOriginal53747ceb358d30c0105769f8471417f6; ?>
<?php unset($__attributesOriginal53747ceb358d30c0105769f8471417f6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal53747ceb358d30c0105769f8471417f6)): ?>
<?php $component = $__componentOriginal53747ceb358d30c0105769f8471417f6; ?>
<?php unset($__componentOriginal53747ceb358d30c0105769f8471417f6); ?>
<?php endif; ?>
</div>
<?php /**PATH /Users/falcaob/Herd/console.kraite.test/resources/views/components/users/positions/panel.blade.php ENDPATH**/ ?>