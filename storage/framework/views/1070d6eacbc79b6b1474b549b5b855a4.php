<div
    <?php echo e($attributes->class(['mb-4 grid gap-2'])); ?>

    :class="$store.aside.status ? 'grid-cols-2' : 'grid-cols-1'"
>
    <?php echo e($slot); ?>

</div>
<?php /**PATH /Users/falcaob/Herd/console.kraite.test/resources/views/components/aside/quick-container.blade.php ENDPATH**/ ?>