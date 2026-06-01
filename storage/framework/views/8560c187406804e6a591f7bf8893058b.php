<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'icon' => null,
    'iconColor' => null,
    'rightIcon' => null,
    'variant' => 'default',
    'color' => 'primary',
    'dimension' => 'default',
    'rounded' => 'rounded-lg',
    'isActive' => false,
    'isDisable' => false,
    'type' => 'button',
    'href' => null,
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
    'rightIcon' => null,
    'variant' => 'default',
    'color' => 'primary',
    'dimension' => 'default',
    'rounded' => 'rounded-lg',
    'isActive' => false,
    'isDisable' => false,
    'type' => 'button',
    'href' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<?php
    $variantMap = [
        'solid' => [
            'primary' => 'text-zinc-800 border-primary-500 bg-primary-500 hover:bg-primary-600 hover:border-primary-600',
            'zinc' => 'border-zinc-500 bg-zinc-500 text-zinc-200 hover:bg-zinc-600 hover:border-zinc-600',
            'blue' => 'border-blue-500 bg-blue-500 text-zinc-200 hover:bg-blue-600 hover:border-blue-600',
            'red' => 'border-red-500 bg-red-500 text-zinc-200 hover:bg-red-600 hover:border-red-600',
            'emerald' => 'border-emerald-500 bg-emerald-500 hover:bg-emerald-600 hover:border-emerald-600 dark:text-zinc-800',
            'amber' => 'border-amber-500 bg-amber-500 hover:bg-amber-600 hover:border-amber-600 dark:text-zinc-800',
        ],
        'outline' => [
            'primary' => 'border-primary-500/50 bg-transparent text-black hover:border-primary-500 dark:text-white',
            'zinc' => 'border-zinc-500/50 bg-transparent text-black hover:border-zinc-500 dark:text-white',
            'blue' => 'border-blue-500/50 bg-transparent text-black hover:border-blue-500 dark:text-white',
            'red' => 'border-red-500/50 bg-transparent text-black hover:border-red-500 dark:text-white',
            'emerald' => 'border-emerald-500/50 bg-transparent text-black hover:border-emerald-500 dark:text-white',
            'amber' => 'border-amber-500/50 bg-transparent text-black hover:border-amber-500 dark:text-white',
        ],
        'default' => [
            'primary' => 'border-transparent bg-transparent text-primary-500 hover:text-primary-400',
            'zinc' => 'border-transparent bg-transparent text-zinc-500 hover:text-zinc-400',
            'blue' => 'border-transparent bg-transparent text-blue-500 hover:text-blue-400',
            'red' => 'border-transparent bg-transparent text-red-500 hover:text-red-400',
            'emerald' => 'border-transparent bg-transparent text-emerald-500 hover:text-emerald-400',
            'amber' => 'border-transparent bg-transparent text-amber-500 hover:text-amber-400',
        ],
        'soft' => [
            'primary' => 'border-transparent bg-primary-500/25 text-primary-500 hover:bg-primary-600/50',
            'zinc' => 'border-transparent bg-zinc-500/25 text-zinc-500 hover:bg-zinc-600/50',
            'blue' => 'border-transparent bg-blue-500/25 text-blue-500 hover:bg-blue-600/50',
            'red' => 'border-transparent bg-red-500/25 text-red-500 hover:bg-red-600/50',
            'emerald' => 'border-transparent bg-emerald-500/25 text-emerald-500 hover:bg-emerald-600/50',
            'amber' => 'border-transparent bg-amber-500/25 text-amber-500 hover:bg-amber-600/50',
        ],
        'link' => [
            'primary' => 'border-transparent bg-transparent text-zinc-800 hover:text-primary-400 dark:text-zinc-200',
            'zinc' => 'border-transparent bg-transparent text-zinc-800 hover:text-zinc-400 dark:text-zinc-200',
            'blue' => 'border-transparent bg-transparent text-zinc-800 hover:text-blue-400 dark:text-zinc-200',
            'red' => 'border-transparent bg-transparent text-zinc-800 hover:text-red-400 dark:text-zinc-200',
            'emerald' => 'border-transparent bg-transparent text-zinc-800 hover:text-emerald-400 dark:text-zinc-200',
            'amber' => 'border-transparent bg-transparent text-zinc-800 hover:text-amber-400 dark:text-zinc-200',
        ],
    ];

    $dimensionMap = [
        'xs' => ['general' => 'py-0.5 text-xs ' . ($slot->isEmpty() ? 'px-0.5' : 'px-3'), 'icon' => 'text-[1.125rem]'],
        'sm' => ['general' => 'py-1 text-sm ' . ($slot->isEmpty() ? 'px-1' : 'px-4'), 'icon' => 'text-[1.25rem]'],
        'default' => ['general' => 'py-1.5 text-base ' . ($slot->isEmpty() ? 'px-1.5' : 'px-5'), 'icon' => 'text-[1.5rem]'],
        'lg' => ['general' => 'py-2 text-lg ' . ($slot->isEmpty() ? 'px-2' : 'px-6'), 'icon' => 'text-[1.75rem]'],
        'xl' => ['general' => 'py-2.5 text-xl ' . ($slot->isEmpty() ? 'px-2.5' : 'px-7'), 'icon' => 'text-[1.75rem]'],
    ];

    $btnVariant = $variantMap[$variant][$color] ?? $variantMap['default']['primary'];
    $btnDim = $dimensionMap[$dimension] ?? $dimensionMap['default'];
    $iconMargin = $slot->isEmpty() ? '' : 'ltr:mr-1.5 rtl:ml-1.5';
    $rightIconMargin = $slot->isEmpty() ? '' : 'ltr:ml-1.5 rtl:mr-1.5';
    $classes = trim('inline-flex items-center justify-center cursor-pointer border ' . $rounded . ' ' . $btnVariant . ' ' . $btnDim['general'] . ' transition-all duration-300 ease-in-out' . ($isDisable ? ' opacity-50 pointer-events-none' : ''));
?>

<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($href): ?>
    <a href="<?php echo e($href); ?>" <?php echo e($attributes->class([$classes])); ?>>
<?php else: ?>
    <button type="<?php echo e($type); ?>" <?php if($isActive): ?> data-active <?php endif; ?> <?php echo e($attributes->class([$classes])); ?>>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($icon): ?>
        <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => $icon,'class' => $btnDim['icon'] . ' ' . $iconMargin]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($icon),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($btnDim['icon'] . ' ' . $iconMargin)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
    <?php echo e($slot); ?>

    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($rightIcon): ?>
        <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => $rightIcon,'class' => $btnDim['icon'] . ' ' . $rightIconMargin]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($rightIcon),'class' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($btnDim['icon'] . ' ' . $rightIconMargin)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($href): ?>
    </a>
<?php else: ?>
    </button>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php /**PATH /Users/falcaob/Herd/console.kraite.test/resources/views/components/button.blade.php ENDPATH**/ ?>