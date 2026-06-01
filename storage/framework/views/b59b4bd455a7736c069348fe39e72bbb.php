<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'placement' => 'bottom-start',
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
    'placement' => 'bottom-start',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<?php
    $placementClass = match ($placement) {
        'bottom-end' => 'top-full right-0 mt-1',
        'bottom-start' => 'top-full left-0 mt-1',
        'top-end' => 'bottom-full right-0 mb-1',
        'top-start' => 'bottom-full left-0 mb-1',
        default => 'top-full left-0 mt-1',
    };
?>
<ul
    data-component-name="Dropdown/DropdownMenu"
    role="presentation"
    x-show="open"
    x-cloak
    x-transition.opacity.duration.150ms
    <?php echo e($attributes->class([
        'absolute z-[9999] flex min-w-60 flex-col gap-2 border px-2 py-2',
        'border-zinc-300/25 bg-white shadow-lg',
        'dark:border-zinc-800/50 dark:bg-zinc-900',
        'rounded-lg',
        $placementClass,
    ])); ?>

>
    <?php echo e($slot); ?>

</ul>
<?php /**PATH /Users/falcaob/Herd/console.kraite.test/resources/views/components/dropdown/menu.blade.php ENDPATH**/ ?>