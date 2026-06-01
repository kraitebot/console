<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'id' => null,
    'name',
    'checked' => false,
    'label' => null,
    'description' => null,
    'color' => 'blue',
    'dimension' => 'default',
    'variant' => 'default',
    'rounded' => 'rounded-lg',
    'inline' => false,
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
    'id' => null,
    'name',
    'checked' => false,
    'label' => null,
    'description' => null,
    'color' => 'blue',
    'dimension' => 'default',
    'variant' => 'default',
    'rounded' => 'rounded-lg',
    'inline' => false,
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
    $id = $id ?? $name;
    $isSwitch = $variant === 'switch';

    $colorMap = [
        'primary' => 'checked:bg-primary-500 indeterminate:bg-primary-500',
        'blue' => 'checked:bg-blue-500 indeterminate:bg-blue-500',
        'emerald' => 'checked:bg-emerald-500 indeterminate:bg-emerald-500',
        'amber' => 'checked:bg-amber-500 indeterminate:bg-amber-500',
        'red' => 'checked:bg-red-500 indeterminate:bg-red-500',
        'zinc' => 'checked:bg-zinc-500 indeterminate:bg-zinc-500',
    ];
    $colorClass = $colorMap[$color] ?? $colorMap['blue'];

    $dimensionMap = [
        'sm' => ['box' => $isSwitch ? 'w-8 h-5' : 'w-5 h-5', 'label' => 'text-sm', 'me' => 'me-1'],
        'default' => ['box' => $isSwitch ? 'w-12 h-7' : 'w-7 h-7', 'label' => 'text-base', 'me' => 'me-1.5'],
        'lg' => ['box' => $isSwitch ? 'w-16 h-9' : 'w-9 h-9', 'label' => 'text-lg', 'me' => 'me-2'],
        'xl' => ['box' => $isSwitch ? 'w-[4.5rem] h-10' : 'w-10 h-10', 'label' => 'text-xl', 'me' => 'me-2.5'],
    ];
    $dim = $dimensionMap[$dimension] ?? $dimensionMap['default'];

    $checkIcon = "checked:bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbDpzcGFjZT0icHJlc2VydmUiIHZpZXdCb3g9IjAgMCAyNCAyNCI+PGcgZmlsbD0ibm9uZSIgZmlsbC1ydWxlPSJldmVub2RkIj48cGF0aCBkPSJNMCAwaDI0djI0SDB6Ii8+PHBhdGggZmlsbD0iI2ZmZiIgZD0iTTE3LjczOCA2LjM1MmExIDEgMCAxIDEgMS41MjQgMS4yOTZsLTguNSAxMGExIDEgMCAwIDEtMS40MjYuMWwtNC41LTRhMSAxIDAgMSAxIDEuMzI4LTEuNDk1bDMuNzM2IDMuMzIgNy44MzgtOS4yMnoiLz48L2c+PC9zdmc+')]";
    $switchOff = "bg-[url(\"data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbDpzcGFjZT0icHJlc2VydmUiIHZpZXdCb3g9IjAgMCA4IDgiPjxjaXJjbGUgY3g9IjQiIGN5PSI0IiByPSIzIiBvcGFjaXR5PSIuMjUiLz48L3N2Zz4=\")]";
    $switchOn = "checked:bg-[url(\"data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbDpzcGFjZT0icHJlc2VydmUiIHZpZXdCb3g9IjAgMCA4IDgiPjxjaXJjbGUgY3g9IjQiIGN5PSI0IiByPSIzIiBmaWxsPSIjZmZmIi8+PC9zdmc+\")]";

    $base = 'cursor-pointer appearance-none border disabled:!opacity-50 transition-all duration-300 ease-in-out !transition-[background-position,border-color,background-color] border-primary-500/35 hover:border-primary-500/60 disabled:border-zinc-300 dark:disabled:border-zinc-700 bg-center bg-no-repeat bg-transparent';

    $variantClass = $isSwitch
        ? 'rounded-full bg-left bg-origin-content checked:!bg-right ' . $switchOff . ' ' . $switchOn
        : $rounded . ' ' . $checkIcon;
?>
<div
    data-component-name="Checkbox"
    class="items-center py-1.5 <?php echo e($inline ? 'inline-flex me-4' : 'flex'); ?>"
>
    <input
        type="checkbox"
        id="<?php echo e($id); ?>"
        name="<?php echo e($name); ?>"
        value="1"
        <?php if($checked): ?> checked <?php endif; ?>
        <?php if($disabled): ?> disabled <?php endif; ?>
        class="<?php echo e($base); ?> <?php echo e($variantClass); ?> <?php echo e($colorClass); ?> <?php echo e($dim['box']); ?> <?php echo e($label || $description ? $dim['me'] : ''); ?>"
        <?php echo e($attributes->except(['class'])); ?>

    />
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($label || $description): ?>
        <div class="flex flex-col">
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($label): ?>
                <label for="<?php echo e($id); ?>" class="cursor-pointer <?php echo e($dim['label']); ?> <?php echo e($disabled ? '!pointer-events-none opacity-50' : ''); ?>">
                    <?php echo e($label); ?>

                </label>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($description): ?>
                <label for="<?php echo e($id); ?>" class="cursor-pointer text-sm text-zinc-500 <?php echo e($disabled ? '!pointer-events-none opacity-50' : ''); ?>">
                    <?php echo e($description); ?>

                </label>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</div>
<?php /**PATH /Users/falcaob/Herd/console.kraite.test/resources/views/components/form/checkbox.blade.php ENDPATH**/ ?>