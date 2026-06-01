<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'src' => null,
    'name' => 'Anonymous',
    'size' => 'w-12',
    'color' => 'primary',
    'variant' => 'soft',
    'rounded' => 'rounded-full',
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
    'src' => null,
    'name' => 'Anonymous',
    'size' => 'w-12',
    'color' => 'primary',
    'variant' => 'soft',
    'rounded' => 'rounded-full',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>
<?php
    $variantClass = match ($variant.':'.$color) {
        'solid:primary' => 'bg-primary-500 border-transparent text-zinc-800',
        'solid:secondary' => 'bg-secondary-500 border-transparent text-zinc-800 dark:text-zinc-200',
        'solid:zinc' => 'bg-zinc-500 border-transparent text-zinc-800 dark:text-zinc-200',
        'solid:red' => 'bg-red-500 border-transparent text-zinc-800 dark:text-zinc-200',
        'solid:amber' => 'bg-amber-500 border-transparent text-zinc-800 dark:text-zinc-200',
        'solid:lime' => 'bg-lime-500 border-transparent text-zinc-800 dark:text-zinc-200',
        'solid:emerald' => 'bg-emerald-500 border-transparent text-zinc-800 dark:text-zinc-200',
        'solid:sky' => 'bg-sky-500 border-transparent text-zinc-800 dark:text-zinc-200',
        'solid:blue' => 'bg-blue-500 border-transparent text-zinc-800 dark:text-zinc-200',
        'solid:violet' => 'bg-violet-500 border-transparent text-zinc-800 dark:text-zinc-200',
        'outline:primary' => 'border-primary-500 bg-primary-500/25 text-primary-500',
        'outline:secondary' => 'border-secondary-500 bg-secondary-500/25 text-secondary-500',
        'outline:zinc' => 'border-zinc-500 bg-zinc-500/25 text-zinc-500',
        'outline:red' => 'border-red-500 bg-red-500/25 text-red-500',
        'outline:amber' => 'border-amber-500 bg-amber-500/25 text-amber-500',
        'outline:lime' => 'border-lime-500 bg-lime-500/25 text-lime-500',
        'outline:emerald' => 'border-emerald-500 bg-emerald-500/25 text-emerald-500',
        'outline:sky' => 'border-sky-500 bg-sky-500/25 text-sky-500',
        'outline:blue' => 'border-blue-500 bg-blue-500/25 text-blue-500',
        'outline:violet' => 'border-violet-500 bg-violet-500/25 text-violet-500',
        'default:primary' => 'border-transparent text-primary-500',
        'default:secondary' => 'border-transparent text-secondary-500',
        'default:zinc' => 'border-transparent text-zinc-500',
        'default:red' => 'border-transparent text-red-500',
        'default:amber' => 'border-transparent text-amber-500',
        'default:lime' => 'border-transparent text-lime-500',
        'default:emerald' => 'border-transparent text-emerald-500',
        'default:sky' => 'border-transparent text-sky-500',
        'default:blue' => 'border-transparent text-blue-500',
        'default:violet' => 'border-transparent text-violet-500',
        'soft:primary' => 'border-transparent bg-primary-500/25 text-primary-500',
        'soft:secondary' => 'border-transparent bg-secondary-500/25 text-secondary-500',
        'soft:zinc' => 'border-transparent bg-zinc-500/25 text-zinc-500',
        'soft:red' => 'border-transparent bg-red-500/25 text-red-500',
        'soft:amber' => 'border-transparent bg-amber-500/25 text-amber-500',
        'soft:lime' => 'border-transparent bg-lime-500/25 text-lime-500',
        'soft:emerald' => 'border-transparent bg-emerald-500/25 text-emerald-500',
        'soft:sky' => 'border-transparent bg-sky-500/25 text-sky-500',
        'soft:blue' => 'border-transparent bg-blue-500/25 text-blue-500',
        'soft:violet' => 'border-transparent bg-violet-500/25 text-violet-500',
        default => 'border-transparent bg-primary-500/25 text-primary-500',
    };

    $sizeClass = match ($size) {
        'w-6' => 'w-6 text-xs',
        'w-8' => 'w-8 text-sm',
        'w-10' => 'w-10 text-base',
        'w-12' => 'w-12 text-lg',
        'w-14' => 'w-14 text-xl',
        'w-16' => 'w-16 text-2xl',
        'w-20' => 'w-20 text-3xl',
        'w-24' => 'w-24 text-4xl',
        default => $size,
    };

    $initial = \Illuminate\Support\Str::of($name)->trim()->substr(0, 1)->upper()->value() ?: 'A';
?>
<?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($src): ?>
    <img
        data-component-name="Avatar"
        src="<?php echo e($src); ?>"
        alt="<?php echo e($name); ?>"
        <?php echo e($attributes->class(['aspect-square object-cover border', $sizeClass, $rounded, $variantClass])); ?>

    />
<?php else: ?>
    <div
        data-component-name="Avatar"
        <?php echo e($attributes->class(['aspect-square flex items-center justify-center font-bold border', $sizeClass, $rounded, $variantClass])); ?>

    >
        <?php echo e($initial); ?>

    </div>
<?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
<?php /**PATH /Users/falcaob/Herd/console.kraite.test/resources/views/components/avatar.blade.php ENDPATH**/ ?>