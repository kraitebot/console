<aside
    data-component-name="Aside"
    <?php echo e($attributes->class([
        'peer',
        'fixed top-0 bottom-0 z-[100]',
        'flex flex-col',
        'bg-zinc-100 py-2',
        'dark:bg-zinc-900 dark:text-white',
        'transition-all duration-300 ease-in-out',
        'max-md:w-[20rem] max-md:shadow-2xl',
    ])); ?>

    :class="$store.aside.status
        ? 'md:w-[20rem] max-md:ltr:left-0 max-md:rtl:right-0'
        : 'md:w-[5.25em] max-md:ltr:-left-[20rem] max-md:rtl:-right-[20rem]'"
>
    <?php echo e($slot); ?>

</aside>
<?php /**PATH /Users/falcaob/Herd/console.kraite.test/resources/views/components/aside.blade.php ENDPATH**/ ?>