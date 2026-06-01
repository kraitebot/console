<section
    data-component-name="Wrapper"
    <?php echo e($attributes->class([
        'flex flex-auto flex-col',
        'border-s-[1rem] border-e-[1rem] border-zinc-100 bg-white md:border-s-0 dark:border-zinc-900 dark:bg-zinc-950',
        'transition-all duration-300 ease-in-out',
    ])); ?>

    :class="$store.aside.status
        ? 'md:peer-[&]:ltr:pl-[20rem] md:peer-[&]:rtl:pr-[20rem]'
        : 'md:peer-[&]:ltr:pl-[5.25em] md:peer-[&]:rtl:pr-[5.25em]'"
>
    <div class="sticky top-0 z-[99] h-full max-h-4 min-h-4 bg-zinc-100 before:absolute before:start-0 before:top-[calc(1rem+1px)] before:h-4 before:w-4 before:rotate-180 before:content-[url('/corner.svg')] after:absolute after:end-px after:top-4 after:h-4 after:w-4 after:-rotate-90 after:content-[url('/corner.svg')] dark:bg-zinc-900 dark:before:content-[url('/dark-corner.svg')] dark:after:content-[url('/dark-corner.svg')]"></div>
    <?php echo e($slot); ?>

    <div class="sticky bottom-0 z-[99] h-full max-h-4 min-h-4 bg-zinc-100 before:absolute before:start-px before:-top-4 before:h-4 before:w-4 before:rotate-90 before:content-[url('/corner.svg')] after:absolute after:end-0 after:-top-[calc(1rem+1px)] after:h-4 after:w-4 after:content-[url('/corner.svg')] dark:bg-zinc-900 dark:before:content-[url('/dark-corner.svg')] dark:after:content-[url('/dark-corner.svg')]"></div>
</section>
<?php /**PATH /Users/falcaob/Herd/console.kraite.test/resources/views/components/wrapper.blade.php ENDPATH**/ ?>