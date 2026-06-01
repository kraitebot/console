<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['label', 'value', 'danger' => false]));

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

foreach (array_filter((['label', 'value', 'danger' => false]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div class="border-l border-zinc-800 px-5 py-4 first:border-l-0">
    <div class="text-xs font-semibold uppercase tracking-wide text-zinc-500"><?php echo e($label); ?></div>
    <div class="mt-1 font-mono text-2xl font-bold <?php echo e($danger ? 'text-amber-400' : 'text-zinc-100'); ?>"><?php echo e($value); ?></div>
</div>
<?php /**PATH /Users/falcaob/Herd/console.kraite.test/resources/views/components/users/positions/stat.blade.php ENDPATH**/ ?>