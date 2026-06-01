<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['icon' => null, 'tabId']));

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

foreach (array_filter((['icon' => null, 'tabId']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<div
    data-component-name="Aside/AsideQuickNav"
    @click="$store.aside.setActiveTab('<?php echo e($tabId); ?>')"
    class="flex cursor-pointer flex-col items-center justify-between gap-2 overflow-hidden rounded-xl transition-colors duration-300 ease-in-out"
    :class="[
        $store.aside.activeTab === '<?php echo e($tabId); ?>'
            ? 'bg-primary-500 hover:bg-primary-500/50 text-zinc-900'
            : 'bg-white text-zinc-600 hover:bg-zinc-100/25 dark:bg-zinc-950 dark:hover:bg-zinc-950/50',
        $store.aside.status ? 'p-4' : 'p-2.5'
    ]"
>
    <div>
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($icon): ?>
            <span class="inline-flex leading-none" :class="$store.aside.status ? 'text-2xl' : 'text-xl'">
                <?php if ($__env->exists('icons.' . $icon)) echo $__env->make('icons.' . $icon, array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </span>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    </div>
    <div x-show="$store.aside.status"><?php echo e($slot); ?></div>
</div>
<?php /**PATH /Users/falcaob/Herd/console.kraite.test/resources/views/components/aside/quick-nav.blade.php ENDPATH**/ ?>