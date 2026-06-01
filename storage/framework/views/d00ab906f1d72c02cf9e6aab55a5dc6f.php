<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['name', 'size' => null, 'color' => null]));

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

foreach (array_filter((['name', 'size' => null, 'color' => null]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<?php
    $colorClass = match ($color) {
        'primary' => 'text-primary-500',
        'zinc' => 'text-zinc-500',
        'blue' => 'text-blue-500',
        'red' => 'text-red-500',
        'amber' => 'text-amber-500',
        'emerald' => 'text-emerald-500',
        'rose' => 'text-rose-500',
        'sky' => 'text-sky-500',
        'violet' => 'text-violet-500',
        'lime' => 'text-lime-500',
        default => null,
    };
?>
<span <?php echo e($attributes->class(['inline-flex shrink-0 items-center justify-center leading-none', $size, $colorClass])); ?>>
    <?php if ($__env->exists('icons.' . $name)) echo $__env->make('icons.' . $name, array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</span>
<?php /**PATH /Users/falcaob/Herd/console.kraite.test/resources/views/components/icon.blade.php ENDPATH**/ ?>