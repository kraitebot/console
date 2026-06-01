<div
    data-component-name="Dropdown"
    x-data="{ open: false }"
    @keydown.escape.window="open = false"
    @click.outside="open = false"
    <?php echo e($attributes->class(['relative inline-flex'])); ?>

>
    <?php echo e($slot); ?>

</div>
<?php /**PATH /Users/falcaob/Herd/console.kraite.test/resources/views/components/dropdown.blade.php ENDPATH**/ ?>