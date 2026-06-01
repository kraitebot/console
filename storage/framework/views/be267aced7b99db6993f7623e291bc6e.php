<div
    data-component-name="Subheader"
    <?php echo e($attributes->class([
        'sticky top-[calc(var(--header-height,4rem)+2rem)] z-20 mx-2 mb-2 flex flex-wrap justify-between gap-4 rounded-xl bg-zinc-100/50 px-6 py-4 shadow-md/5 backdrop-blur-md dark:bg-zinc-900/75 dark:text-white',
    ])); ?>

>
    <?php echo e($slot); ?>

</div>
<?php /**PATH /Users/falcaob/Herd/console.kraite.test/resources/views/components/subheader.blade.php ENDPATH**/ ?>