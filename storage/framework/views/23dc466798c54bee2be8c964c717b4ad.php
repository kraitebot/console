<?php if (isset($component)) { $__componentOriginal3ac2567dcce4f1acff0861ae964fa651 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3ac2567dcce4f1acff0861ae964fa651 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.aside.head','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('aside.head'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

    <a
        href="<?php echo e(route('dashboard')); ?>"
        wire:navigate
        aria-label="Kraite"
        class="flex items-center gap-2 overflow-hidden transition-all duration-300 ease-in-out"
        :class="$store.aside.status
            ? 'max-w-[12rem] opacity-100 ltr:translate-x-0 rtl:translate-x-0'
            : 'max-w-0 opacity-0 ltr:-translate-x-4 rtl:translate-x-4 pointer-events-none'"
    >
        <img src="/brand/snake-green.svg" alt="Kraite" class="h-9 w-9 shrink-0" />
        <span class="text-xl font-bold tracking-tight whitespace-nowrap">Kraite</span>
    </a>
    <button
        type="button"
        aria-label="Toggle Aside Menu"
        @click="$store.aside.toggle()"
        class="flex h-12 w-12 shrink-0 cursor-pointer items-center justify-center text-zinc-500 transition-transform duration-300 ease-in-out"
    >
        <span class="relative inline-flex h-6 w-6 items-center justify-center text-2xl leading-none">
            <span
                class="absolute inset-0 inline-flex items-center justify-center transition-opacity duration-300 ease-in-out"
                :class="$store.aside.status ? 'opacity-100' : 'opacity-0'"
            >
                <?php echo $__env->make('icons.SidebarLeft01', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </span>
            <span
                class="absolute inset-0 inline-flex items-center justify-center transition-opacity duration-300 ease-in-out"
                :class="!$store.aside.status ? 'opacity-100' : 'opacity-0'"
            >
                <?php echo $__env->make('icons.SidebarLeft', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </span>
        </span>
    </button>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3ac2567dcce4f1acff0861ae964fa651)): ?>
<?php $attributes = $__attributesOriginal3ac2567dcce4f1acff0861ae964fa651; ?>
<?php unset($__attributesOriginal3ac2567dcce4f1acff0861ae964fa651); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3ac2567dcce4f1acff0861ae964fa651)): ?>
<?php $component = $__componentOriginal3ac2567dcce4f1acff0861ae964fa651; ?>
<?php unset($__componentOriginal3ac2567dcce4f1acff0861ae964fa651); ?>
<?php endif; ?>
<?php /**PATH /Users/falcaob/Herd/console.kraite.test/resources/views/partials/aside-header.blade.php ENDPATH**/ ?>