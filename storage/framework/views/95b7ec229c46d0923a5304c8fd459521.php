<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'isColumnBorder' => true,
    'sort' => null,
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
    'isColumnBorder' => true,
    'sort' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<th
    data-component-name="Table/Th"
    <?php echo e($attributes->class([
        'bg-zinc-900/10 dark:bg-zinc-900/90 p-4',
        'first:group-first/Tr:ltr:rounded-tl-lg last:group-first/Tr:ltr:rounded-tr-lg',
        'first:group-last/Tr:ltr:rounded-bl-lg last:group-last/Tr:ltr:rounded-br-lg',
        'first:group-first/Tr:rtl:rounded-tr-lg last:group-first/Tr:rtl:rounded-tl-lg',
        'first:group-last/Tr:rtl:rounded-br-lg last:group-last/Tr:rtl:rounded-bl-lg',
        'shadow-[inset_0_0_0_0.5px_rgba(0,0,0,0.1)] dark:shadow-[inset_0_0_0_0.5px_rgba(255,255,255,0.05)]' => $isColumnBorder,
    ])); ?>

>
    <?php echo e($slot); ?>

</th>
<?php /**PATH /Users/falcaob/Herd/console.kraite.test/resources/views/components/table/th.blade.php ENDPATH**/ ?>