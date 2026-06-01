<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'variant' => 'default',
    'color' => 'primary',
    'rounded' => 'rounded-lg',
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
    'variant' => 'default',
    'color' => 'primary',
    'rounded' => 'rounded-lg',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<?php
    $map = [
        'solid' => [
            'primary' => 'bg-primary-500 border-transparent text-zinc-800',
            'zinc' => 'bg-zinc-500 border-transparent text-zinc-800 dark:text-zinc-200',
            'emerald' => 'bg-emerald-500 border-transparent text-zinc-800 dark:text-zinc-200',
            'blue' => 'bg-blue-500 border-transparent text-zinc-800 dark:text-zinc-200',
            'amber' => 'bg-amber-500 border-transparent text-zinc-800 dark:text-zinc-200',
            'red' => 'bg-red-500 border-transparent text-zinc-800 dark:text-zinc-200',
        ],
        'outline' => [
            'primary' => 'border-primary-500 bg-primary-500/10 text-primary-500',
            'zinc' => 'border-zinc-500 bg-zinc-500/10 text-zinc-500',
            'emerald' => 'border-emerald-500 bg-emerald-500/10 text-emerald-500',
            'blue' => 'border-blue-500 bg-blue-500/10 text-blue-500',
            'amber' => 'border-amber-500 bg-amber-500/10 text-amber-500',
            'red' => 'border-red-500 bg-red-500/10 text-red-500',
        ],
        'default' => [
            'primary' => 'text-primary-500 border-transparent',
            'zinc' => 'text-zinc-500 border-transparent',
            'emerald' => 'text-emerald-500 border-transparent',
            'blue' => 'text-blue-500 border-transparent',
            'amber' => 'text-amber-500 border-transparent',
            'red' => 'text-red-500 border-transparent',
        ],
        'soft' => [
            'primary' => 'text-primary-500 bg-primary-500/10 border-transparent',
            'zinc' => 'text-zinc-500 bg-zinc-500/10 border-transparent',
            'emerald' => 'text-emerald-500 bg-emerald-500/10 border-transparent',
            'blue' => 'text-blue-500 bg-blue-500/10 border-transparent',
            'amber' => 'text-amber-500 bg-amber-500/10 border-transparent',
            'red' => 'text-red-500 bg-red-500/10 border-transparent',
        ],
    ];
    $vc = $map[$variant][$color] ?? $map['default']['primary'];
?>
<span <?php echo e($attributes->class(['inline-flex items-center gap-x-1.5 px-2 border', $rounded, $vc])); ?>>
    <?php echo e($slot); ?>

</span>
<?php /**PATH /Users/falcaob/Herd/console.kraite.test/resources/views/components/badge.blade.php ENDPATH**/ ?>