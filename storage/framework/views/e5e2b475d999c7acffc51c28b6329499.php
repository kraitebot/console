<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'count' => 0,
    'active' => false,
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
    'count' => 0,
    'active' => false,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<span
    data-component-name="Tabs/CountBadge"
    <?php echo e($attributes->class([
        'ms-2 inline-flex min-w-6 items-center justify-center rounded-lg border px-1.5 py-0.5 text-xs font-semibold leading-none transition-colors duration-300',
        $active
            ? 'border-primary-500 bg-primary-500 text-zinc-950'
            : 'border-zinc-500/20 bg-zinc-500/10 text-zinc-500 dark:border-zinc-500/30',
    ])); ?>

>
    <?php echo e($count); ?>

</span>
<?php /**PATH /Users/falcaob/Herd/console.kraite.test/resources/views/components/tabs/count-badge.blade.php ENDPATH**/ ?>