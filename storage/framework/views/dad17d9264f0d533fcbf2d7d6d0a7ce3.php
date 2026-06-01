<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'name',
    'value' => null,
    'id' => null,
    'placeholder' => null,
    'variant' => 'default',
    'dimension' => 'default',
    'rounded' => 'rounded-lg',
    'disabled' => false,
    'readonly' => false,
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
    'name',
    'value' => null,
    'id' => null,
    'placeholder' => null,
    'variant' => 'default',
    'dimension' => 'default',
    'rounded' => 'rounded-lg',
    'disabled' => false,
    'readonly' => false,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<?php
    $variantClass = match ($variant) {
        'solid' => 'bg-zinc-100 dark:bg-zinc-800 border focus:bg-transparent dark:focus:bg-transparent',
        'gray' => 'bg-zinc-100 dark:bg-zinc-700 dark:text-zinc-200 border dark:placeholder-zinc-500',
        'underline' => 'border-b-2 !border-x-transparent !border-t-transparent bg-transparent pe-0 dark:text-zinc-200 dark:placeholder-zinc-500 focus:border-x-transparent focus:border-t-transparent focus:ring-0',
        default => 'bg-white dark:bg-zinc-900 dark:text-zinc-200 border placeholder-zinc-500',
    };
    $isDisabled = $disabled || $readonly;
    $stateClass = $variant === 'underline'
        ? 'border-b-primary-500/45 hover:border-b-primary-500/70 focus:border-b-primary-500 disabled:border-b-zinc-300 dark:disabled:border-b-zinc-700'
        : 'border-primary-500/35 hover:border-primary-500/60 focus:border-primary-500 focus:ring-primary-500/20 disabled:border-zinc-300 disabled:bg-zinc-100 dark:disabled:border-zinc-700 dark:disabled:bg-zinc-900';
    $dimensionClass = match ($dimension) {
        'sm' => 'px-4 py-2 text-sm',
        'lg' => 'px-4 py-4 text-lg',
        default => 'px-4 py-3 text-base',
    };
    $roundedClass = $variant === 'underline' ? '' : $rounded;
?>
<div class="relative">
    <select
        data-component-name="select"
        name="<?php echo e($name); ?>"
        <?php if($id): ?> id="<?php echo e($id); ?>" <?php endif; ?>
        <?php if($isDisabled): ?> disabled <?php endif; ?>
        <?php echo e($attributes->class([
            'w-full appearance-none outline-0 pe-11 text-zinc-700 dark:text-zinc-200 disabled:pointer-events-none disabled:opacity-60 transition-colors duration-300 ease-in-out',
            $variantClass,
            $stateClass,
            $dimensionClass,
            $roundedClass,
        ])); ?>

    >
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($placeholder): ?>
            <option value="" <?php echo e($value === null || $value === '' ? 'selected' : ''); ?> hidden><?php echo e($placeholder); ?></option>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <?php echo e($slot); ?>

    </select>
    <span class="pointer-events-none absolute inset-y-0 end-4 flex items-center text-zinc-500">
        <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'ArrowDown01']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'ArrowDown01']); ?>
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
    </span>
</div>
<?php /**PATH /Users/falcaob/Herd/console.kraite.test/resources/views/components/form/select.blade.php ENDPATH**/ ?>