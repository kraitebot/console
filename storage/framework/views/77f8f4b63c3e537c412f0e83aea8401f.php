<div
    data-component-name="Dropdown/DropdownToggle"
    @click="open = !open"
    :aria-expanded="open"
    <?php echo e($attributes->class(['inline-flex cursor-pointer items-center'])); ?>

>
    <?php echo e($slot); ?>

</div>
<?php /**PATH /Users/falcaob/Herd/console.kraite.test/resources/views/components/dropdown/toggle.blade.php ENDPATH**/ ?>