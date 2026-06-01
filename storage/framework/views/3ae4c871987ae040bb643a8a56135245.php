<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'name',
    'id' => null,
    'accept' => null,
    'dimension' => 'default',
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
    'id' => null,
    'accept' => null,
    'dimension' => 'default',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<?php
    $dimensionClass = match ($dimension) {
        'sm' => 'px-4 py-2 text-sm',
        'lg' => 'px-4 py-4 text-lg',
        default => 'px-4 py-3 text-base',
    };
?>

<input
    data-component-name="FileInput"
    type="file"
    name="<?php echo e($name); ?>"
    <?php if($id): ?> id="<?php echo e($id); ?>" <?php endif; ?>
    <?php if($accept): ?> accept="<?php echo e($accept); ?>" <?php endif; ?>
    <?php echo e($attributes->class([
        'block w-full cursor-pointer rounded-lg border border-primary-500/35 bg-white text-zinc-700 outline-0 transition-colors duration-300 ease-in-out file:me-4 file:cursor-pointer file:rounded-md file:border-0 file:bg-primary-500 file:px-4 file:py-2 file:text-zinc-900 hover:border-primary-500/60 focus:border-primary-500 focus:ring-primary-500/20 dark:bg-zinc-900 dark:text-zinc-200',
        $dimensionClass,
    ])); ?>

/>
<?php /**PATH /Users/falcaob/Herd/console.kraite.test/resources/views/components/form/file.blade.php ENDPATH**/ ?>