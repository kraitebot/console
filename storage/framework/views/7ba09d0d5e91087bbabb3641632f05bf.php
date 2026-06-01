<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'name',
    'type' => 'text',
    'placeholder' => '',
    'value' => null,
    'id' => null,
    'variant' => 'default',
    'dimension' => 'default',
    'rounded' => 'rounded-lg',
    'readonly' => false,
    'disabled' => false,
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
    'type' => 'text',
    'placeholder' => '',
    'value' => null,
    'id' => null,
    'variant' => 'default',
    'dimension' => 'default',
    'rounded' => 'rounded-lg',
    'readonly' => false,
    'disabled' => false,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<?php
    $variantMap = [
        'default' => 'bg-white dark:bg-zinc-900 dark:text-zinc-200 border placeholder-zinc-500',
        'solid' => 'bg-zinc-100 dark:bg-zinc-800 border focus:bg-transparent dark:focus:bg-transparent',
        'gray' => 'bg-zinc-100 dark:bg-zinc-700 dark:text-zinc-200 border dark:placeholder-zinc-500',
        'underline' => 'border-b-2 !border-x-transparent !border-t-transparent bg-transparent pe-0 dark:text-zinc-200 dark:placeholder-zinc-500 focus:border-x-transparent focus:border-t-transparent focus:ring-0',
    ];
    $stateClass = $variant === 'underline'
        ? 'border-b-primary-500/45 hover:border-b-primary-500/70 focus:border-b-primary-500 read-only:border-b-zinc-300 disabled:border-b-zinc-300 dark:read-only:border-b-zinc-700 dark:disabled:border-b-zinc-700'
        : 'border-primary-500/35 hover:border-primary-500/60 focus:border-primary-500 focus:ring-primary-500/20 read-only:border-zinc-300 read-only:bg-zinc-100 disabled:border-zinc-300 disabled:bg-zinc-100 dark:read-only:border-zinc-700 dark:read-only:bg-zinc-900 dark:disabled:border-zinc-700 dark:disabled:bg-zinc-900';
    $dimensionMap = [
        'sm' => 'px-4 py-2 text-sm',
        'default' => 'px-4 py-3 text-base',
        'lg' => 'px-4 py-4 text-lg',
    ];
    $variantClass = $variantMap[$variant] ?? $variantMap['default'];
    $dimensionClass = $dimensionMap[$dimension] ?? $dimensionMap['default'];
    $roundedClass = $variant === 'underline' ? '' : $rounded;
?>
<input
    data-component-name="Input"
    type="<?php echo e($type); ?>"
    name="<?php echo e($name); ?>"
    <?php if($id): ?> id="<?php echo e($id); ?>" <?php endif; ?>
    <?php if($value !== null): ?> value="<?php echo e($value); ?>" <?php endif; ?>
    <?php if($readonly): ?> readonly <?php endif; ?>
    <?php if($disabled): ?> disabled <?php endif; ?>
    placeholder="<?php echo e($placeholder); ?>"
    <?php echo e($attributes->class([
        'w-full peer block appearance-none outline-0 text-zinc-700 dark:text-zinc-200 disabled:pointer-events-none disabled:opacity-60 transition-colors duration-300 ease-in-out',
        $variantClass,
        $stateClass,
        $dimensionClass,
        $roundedClass,
    ])); ?>

/>
<?php /**PATH /Users/falcaob/Herd/console.kraite.test/resources/views/components/form/input.blade.php ENDPATH**/ ?>