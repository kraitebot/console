<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'icon' => null,
    'iconColor' => null,
    'text' => 'Text',
    'to' => null,
    'isActiveOverwrite' => false,
    'isChildrenNavButtonOverwrite' => false,
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
    'text' => 'Text',
    'to' => null,
    'isActiveOverwrite' => false,
    'isChildrenNavButtonOverwrite' => false,
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
    $toPath = $to ? (parse_url($to, PHP_URL_PATH) ?: '/') : null;
    $matchTo = $toPath ? rtrim($toPath, '/') : null;
    $matchTo = $matchTo === '' ? '/' : $matchTo;
    $hereInitial = $isActiveOverwrite || ($to && (
        $currentPath === $matchTo
        || ($matchTo !== '/' && str_starts_with($currentPath, $matchTo . '/'))
    ));
    $base = 'mb-2 p-3 flex items-center cursor-pointer overflow-hidden rounded-xl hover:opacity-100 border text-zinc-500 hover:text-primary-500 grow transition-all duration-300 ease-in-out focus:outline-none';
    $activeCls = 'border-primary-500/35 text-primary-500';
    $inactiveCls = 'border-transparent';
    $initialState = $hereInitial ? $activeCls : $inactiveCls;
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
    data-component-name="Nav/NavItem"
    class="relative flex list-none items-center whitespace-nowrap"
    :class="$store.aside.status ? '[.group_&]:ps-4' : ''"
>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($to): ?>
        <a
            href="<?php echo e($to); ?>"
            data-nav-link
            @click="if (!($event.defaultPrevented || $event.button !== 0 || $event.metaKey || $event.ctrlKey || $event.shiftKey || $event.altKey)) $store.navigation.path = <?php echo \Illuminate\Support\Js::from($matchTo)->toHtml() ?>; $store.pageTransition.navigate($event, <?php echo \Illuminate\Support\Js::from($to)->toHtml() ?>)"
            class="<?php echo e($base); ?> <?php echo e($initialState); ?>"
            :class="<?php echo \Illuminate\Support\Js::from($isActiveOverwrite)->toHtml() ?> || $store.navigation.path === <?php echo \Illuminate\Support\Js::from($matchTo)->toHtml() ?> || (<?php echo \Illuminate\Support\Js::from($matchTo)->toHtml() ?> !== '/' && $store.navigation.path.startsWith(<?php echo \Illuminate\Support\Js::from($matchTo)->toHtml() ?> + '/')) ? <?php echo \Illuminate\Support\Js::from($activeCls)->toHtml() ?> : <?php echo \Illuminate\Support\Js::from($inactiveCls)->toHtml() ?>"
            :aria-current="<?php echo \Illuminate\Support\Js::from($isActiveOverwrite)->toHtml() ?> || $store.navigation.path === <?php echo \Illuminate\Support\Js::from($matchTo)->toHtml() ?> || (<?php echo \Illuminate\Support\Js::from($matchTo)->toHtml() ?> !== '/' && $store.navigation.path.startsWith(<?php echo \Illuminate\Support\Js::from($matchTo)->toHtml() ?> + '/')) ? 'page' : null"
        >
    <?php else: ?>
        <button
            type="button"
            class="<?php echo e($base); ?> <?php echo e($initialState); ?>"
            :class="<?php echo \Illuminate\Support\Js::from($isActiveOverwrite)->toHtml() ?> ? <?php echo \Illuminate\Support\Js::from($activeCls)->toHtml() ?> : <?php echo \Illuminate\Support\Js::from($inactiveCls)->toHtml() ?>"
        >
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        <template x-if="$store.aside.status">
            <div class="absolute start-[0.125rem] -top-[100vh] bottom-[calc(50%+0.25rem)] hidden w-[0.8125rem] border-s border-b border-zinc-300 ltr:rounded-bl-[10px] rtl:rounded-br-[10px] dark:border-zinc-700 [.group_&]:block"></div>
        </template>
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
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(isset($slot)): ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(! $isChildrenNavButtonOverwrite && ! $slot->isEmpty()): ?>
                    <div><?php echo e($slot); ?></div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($to): ?>
        </a>
    <?php else: ?>
        </button>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($isChildrenNavButtonOverwrite): ?>
        <div class="mb-2 flex items-center gap-3 px-3" x-show="$store.aside.status"><?php echo e($slot); ?></div>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
</li>
<?php /**PATH /Users/falcaob/Herd/console.kraite.test/resources/views/components/nav/item.blade.php ENDPATH**/ ?>