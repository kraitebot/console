<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'icon' => null,
    'iconColor' => null,
    'text',
    'to',
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
    'icon' => null,
    'iconColor' => null,
    'text',
    'to',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<?php
    $currentPath = '/' . trim(request()->path(), '/');
    $toPath = parse_url($to, PHP_URL_PATH) ?: '/';
    $matchTo = rtrim($toPath, '/');
    $matchTo = $matchTo === '' ? '/' : $matchTo;
    $hereInitial = $to !== '/' && str_starts_with($currentPath, $matchTo);
    $base = 'mb-2 p-3 flex items-center cursor-pointer overflow-hidden rounded-xl hover:opacity-100 border grow transition-all duration-300 ease-in-out';
    $hereClass = 'text-zinc-950 dark:text-zinc-100 border-transparent';
    $inactiveClass = 'border-transparent text-zinc-500 hover:text-zinc-950 dark:hover:text-zinc-100';
    $iconColorClass = match ($iconColor) {
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
        default => '',
    };
?>
<li
    data-component-name="Nav/NavCollapse"
    x-data="{ open: <?php echo e($hereInitial ? 'true' : 'false'); ?>, touched: false }"
    x-effect="if (! touched) open = $store.navigation.path.startsWith(<?php echo \Illuminate\Support\Js::from($matchTo)->toHtml() ?>) && <?php echo \Illuminate\Support\Js::from($matchTo)->toHtml() ?> !== '/'"
    class="relative list-none group"
>
    <div
        role="presentation"
        @click="open = !open; touched = true"
        class="<?php echo e($base); ?>"
        :class="open ? <?php echo \Illuminate\Support\Js::from($hereClass)->toHtml() ?> : <?php echo \Illuminate\Support\Js::from($inactiveClass)->toHtml() ?>"
    >
        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($icon): ?>
            <span
                data-component-name="Nav/NavIcon"
                class="w-6 flex-none text-2xl inline-flex shrink-0 items-center justify-center leading-none <?php echo e($iconColorClass); ?>"
                :class="$store.aside.status ? 'me-3' : ''"
            >
                <?php if ($__env->exists('icons.' . $icon)) echo $__env->make('icons.' . $icon, array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </span>
        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <div
            data-component-name="Nav/NavItemContent"
            class="flex w-full items-center justify-between truncate"
            :class="!$store.aside.status ? 'hidden' : ''"
        >
            <div data-component-name="Nav/NavItemText" class="truncate overflow-hidden whitespace-nowrap"><?php echo e($text); ?></div>
            <div>
                <span
                    class="text-2xl inline-flex leading-none transition-all duration-300 ease-in-out"
                    :class="open ? 'rotate-180' : ''"
                >
                    <?php echo $__env->make('icons.ArrowDown01', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </span>
            </div>
        </div>
    </div>
    <template x-if="$store.aside.status">
        <div class="absolute start-[0.125rem] -top-[100vh] bottom-[calc(100%-1.5rem)] hidden w-[0.8125rem] border-s border-b border-zinc-300 ltr:rounded-bl-[10px] rtl:rounded-br-[10px] dark:border-zinc-700 [.group_.group_&]:block"></div>
    </template>
    <ul
        x-show="open"
        x-collapse
        class="overflow-hidden list-none"
        :class="$store.aside.status ? 'ms-4' : ''"
    >
        <?php echo e($slot); ?>

    </ul>
</li>
<?php /**PATH /Users/falcaob/Herd/console.kraite.test/resources/views/components/nav/collapse.blade.php ENDPATH**/ ?>