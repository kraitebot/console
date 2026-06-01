<main
    data-component-name="PageTransition"
    <?php echo e($attributes->class([
        'flex flex-1 flex-col transition-all duration-200 ease-out',
    ])); ?>

    :class="$store.pageTransition.leaving ? 'translate-y-1 opacity-0' : 'translate-y-0 opacity-100'"
>
    <?php echo e($slot); ?>

</main>
<?php /**PATH /Users/falcaob/Herd/console.kraite.test/resources/views/components/page-transition.blade.php ENDPATH**/ ?>