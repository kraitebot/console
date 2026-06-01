<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['rows' => [], 'compact' => false]));

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

foreach (array_filter((['rows' => [], 'compact' => false]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $formatPnl = fn ($value) => $value === null || $value === '' ? '-' : (((float) $value > 0 ? '+' : '').number_format((float) $value, 4, '.', ''));
    $pnlClass = fn ($value) => $value === null || $value === '' ? 'text-zinc-500' : ((float) $value > 0 ? 'text-emerald-400' : ((float) $value < 0 ? 'text-red-400' : 'text-zinc-400'));
?>

<div class="<?php echo e($compact ? 'rounded-lg border border-zinc-800' : 'border-t border-zinc-800'); ?> overflow-x-auto">
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(count($rows) > 0): ?>
        <table class="w-full min-w-[820px] font-mono <?php echo e($compact ? 'text-xs' : 'text-sm'); ?>">
            <thead class="bg-zinc-900 text-xs uppercase tracking-wide text-zinc-500">
                <tr>
                    <th class="px-4 py-2 text-left">Order Type</th>
                    <th class="px-3 py-2 text-left">Side</th>
                    <th class="px-3 py-2 text-right">Price</th>
                    <th class="px-3 py-2 text-right">Size</th>
                    <th class="px-3 py-2 text-right">Avg Entry</th>
                    <th class="px-3 py-2 text-right">TP Price</th>
                    <th class="px-3 py-2 text-right">PnL @ Fill</th>
                    <th class="px-4 py-2 text-right">Profit @ TP</th>
                </tr>
            </thead>
            <tbody>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <tr class="border-t border-zinc-800">
                        <td class="px-4 py-2 text-zinc-400"><?php echo e($row['type']); ?></td>
                        <td class="px-3 py-2"><?php if (isset($component)) { $__componentOriginal2ddbc40e602c342e508ac696e52f8719 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2ddbc40e602c342e508ac696e52f8719 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.badge','data' => ['color' => $row['side'] === 'BUY' ? 'emerald' : 'red']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['color' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($row['side'] === 'BUY' ? 'emerald' : 'red')]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>
<?php echo e($row['side']); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2ddbc40e602c342e508ac696e52f8719)): ?>
<?php $attributes = $__attributesOriginal2ddbc40e602c342e508ac696e52f8719; ?>
<?php unset($__attributesOriginal2ddbc40e602c342e508ac696e52f8719); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2ddbc40e602c342e508ac696e52f8719)): ?>
<?php $component = $__componentOriginal2ddbc40e602c342e508ac696e52f8719; ?>
<?php unset($__componentOriginal2ddbc40e602c342e508ac696e52f8719); ?>
<?php endif; ?></td>
                        <td class="px-3 py-2 text-right text-zinc-300"><?php echo e($row['price']); ?></td>
                        <td class="px-3 py-2 text-right text-zinc-300"><?php echo e($row['size']); ?></td>
                        <td class="px-3 py-2 text-right text-zinc-500"><?php echo e($row['avg_entry'] ?? '-'); ?></td>
                        <td class="px-3 py-2 text-right text-zinc-500"><?php echo e($row['tp_price'] ?? '-'); ?></td>
                        <td class="px-3 py-2 text-right <?php echo e($pnlClass($row['pnl_at_fill'])); ?>"><?php echo e($formatPnl($row['pnl_at_fill'])); ?></td>
                        <td class="px-4 py-2 text-right <?php echo e($pnlClass($row['profit_at_tp'])); ?>"><?php echo e($formatPnl($row['profit_at_tp'])); ?></td>
                    </tr>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="px-4 py-4 font-mono text-sm italic text-zinc-600">No projections available.</div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>
<?php /**PATH /Users/falcaob/Herd/console.kraite.test/resources/views/components/users/positions/projections.blade.php ENDPATH**/ ?>