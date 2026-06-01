<td
    data-component-name="Table/Td"
    <?php echo e($attributes->class([
        'first:ltr:rounded-l-lg last:ltr:rounded-r-lg',
        'first:rtl:rounded-r-lg last:rtl:rounded-l-lg',
        'group-even/Tr:bg-zinc-500/5 group-hover/Tr:bg-primary-500/8',
        'dark:group-even/Tr:bg-zinc-900/50 dark:group-hover/Tr:bg-primary-500/10',
        'p-4 transition-colors duration-300',
    ])); ?>

>
    <?php echo e($slot); ?>

</td>
<?php /**PATH /Users/falcaob/Herd/console.kraite.test/resources/views/components/table/td.blade.php ENDPATH**/ ?>