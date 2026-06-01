<?php if (isset($component)) { $__componentOriginalb10a0bd81788dfb8f917174b85d5bdbe = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb10a0bd81788dfb8f917174b85d5bdbe = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.aside.footer','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('aside.footer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

    <?php
        $user = auth()->user();
        $name = $user?->name ?? 'Kraite User';
        $role = $user?->is_admin ? 'Admin' : 'User';
        $initial = mb_strtoupper(mb_substr($name, 0, 1));
    ?>
    <div
        data-component-name="User"
        class="relative"
    >
        <div
            class="mb-2 min-w-[4.5rem] overflow-hidden rounded-xl bg-white dark:bg-zinc-950 transition-all duration-300 ease-in-out"
            :class="!$store.aside.status && 'ltr:translate-x-[-0.625rem] rtl:translate-x-[0.625rem]'"
        >
            <div class="flex cursor-pointer gap-4 p-3 text-zinc-500 hover:text-zinc-950 dark:hover:text-zinc-100 transition-all duration-300 ease-in-out">
                <div class="bg-primary-500/25 text-primary-700 dark:text-primary-400 flex aspect-square h-12 w-12 items-center justify-center rounded-lg font-semibold">
                    <?php echo e($initial); ?>

                </div>
                <div class="flex basis-full flex-wrap items-center truncate" x-show="$store.aside.status">
                    <div class="flex basis-full items-center gap-2 truncate">
                        <span class="truncate font-semibold text-zinc-950 dark:text-zinc-100"><?php echo e($name); ?></span>
                    </div>
                    <div class="basis-full truncate text-xs first-letter:uppercase"><?php echo e($role); ?></div>
                </div>
            </div>
        </div>
        <span
            class="absolute end-0 top-0 -me-1 -mt-1 flex h-3 w-3"
            :class="!$store.aside.status && 'ltr:translate-x-[0.625rem] rtl:translate-x-[-0.625rem]'"
        >
            <span class="absolute inline-flex h-full w-full animate-ping rounded-full bg-blue-400 opacity-75"></span>
            <span class="relative inline-flex h-3 w-3 rounded-full bg-blue-500"></span>
        </span>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb10a0bd81788dfb8f917174b85d5bdbe)): ?>
<?php $attributes = $__attributesOriginalb10a0bd81788dfb8f917174b85d5bdbe; ?>
<?php unset($__attributesOriginalb10a0bd81788dfb8f917174b85d5bdbe); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb10a0bd81788dfb8f917174b85d5bdbe)): ?>
<?php $component = $__componentOriginalb10a0bd81788dfb8f917174b85d5bdbe; ?>
<?php unset($__componentOriginalb10a0bd81788dfb8f917174b85d5bdbe); ?>
<?php endif; ?>
<?php /**PATH /Users/falcaob/Herd/console.kraite.test/resources/views/partials/aside-footer.blade.php ENDPATH**/ ?>