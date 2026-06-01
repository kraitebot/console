<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'target' => 'selectTab',
    'title' => 'Loading',
    'message' => 'Fetching data...',
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
    'target' => 'selectTab',
    'title' => 'Loading',
    'message' => 'Fetching data...',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div data-component-name="LazyTabContent" class="relative">
    <div
        wire:loading.flex
        wire:target="<?php echo e($target); ?>"
        class="min-h-72 items-center justify-center rounded-xl border border-primary-500/15 bg-primary-500/5 p-8"
    >
        <div class="flex flex-col items-center gap-4 text-center">
            <div class="relative size-12">
                <div class="absolute inset-0 rounded-full border-2 border-primary-500/20"></div>
                <div class="absolute inset-0 animate-spin rounded-full border-2 border-transparent border-t-primary-500"></div>
            </div>
            <div>
                <div class="text-lg font-semibold text-zinc-950 dark:text-zinc-100"><?php echo e($title); ?></div>
                <div class="mt-1 text-base text-zinc-500"><?php echo e($message); ?></div>
            </div>
        </div>
    </div>

    <div wire:loading.remove wire:target="<?php echo e($target); ?>">
        <?php echo e($slot); ?>

    </div>
</div>
<?php /**PATH /Users/falcaob/Herd/console.kraite.test/resources/views/components/lazy-tab-content.blade.php ENDPATH**/ ?>