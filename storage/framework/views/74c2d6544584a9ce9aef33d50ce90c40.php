<div data-component-name="Header/HeaderLeft" <?php echo e($attributes->class(['flex items-center gap-4 ltr:mr-auto rtl:ml-auto'])); ?>>
    <button
        type="button"
        aria-label="Toggle Aside Menu"
        @click="$store.aside.toggle()"
        class="flex h-12 w-12 items-center justify-center md:hidden"
    >
        <span class="inline-flex text-2xl leading-none" x-show="$store.aside.status">
            <?php echo $__env->make('icons.SidebarLeft01', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </span>
        <span class="inline-flex text-2xl leading-none" x-show="!$store.aside.status">
            <?php echo $__env->make('icons.SidebarLeft', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </span>
    </button>
    <?php echo e($slot); ?>

</div>
<?php /**PATH /Users/falcaob/Herd/console.kraite.test/resources/views/components/header/left.blade.php ENDPATH**/ ?>