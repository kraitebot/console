<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
    <meta name="view-transition" content="same-origin" />
    <title><?php echo $__env->yieldContent('title', 'Kraite Console'); ?></title>
    <?php echo $__env->make('partials.favicon', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <script>
        (function () {
            const mode = localStorage.getItem('theme') || 'system';
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            const isDark = mode === 'dark' || (mode === 'system' && prefersDark);
            document.documentElement.classList.toggle('dark', isDark);
            document.documentElement.style.colorScheme = isDark ? 'dark' : 'light';
        })();
    </script>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::styles(); ?>

</head>
<body x-data class="font-sans antialiased">
    <div class="flex h-full items-center justify-center bg-zinc-100 dark:bg-zinc-950">
        <?php echo $__env->yieldContent('content'); ?>
    </div>
    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

</body>
</html>
<?php /**PATH /Users/falcaob/Herd/console.kraite.test/resources/views/layouts/guest.blade.php ENDPATH**/ ?>