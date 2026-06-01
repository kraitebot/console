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
<body x-data x-init="$store.theme.init()" class="font-sans antialiased">

    <div data-component-name="AsidePersist" class="peer contents">
        <?php app("livewire")->forceAssetInjection(); ?><div x-persist="<?php echo e('app-aside'); ?>">
            <?php echo $__env->make('partials.aside-default', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
    </div>

    <?php if (isset($component)) { $__componentOriginal2b499da6bda785a33d26ee2a64c589e0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2b499da6bda785a33d26ee2a64c589e0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.wrapper','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('wrapper'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

        <?php echo $__env->yieldContent('header'); ?>

        <?php if (isset($component)) { $__componentOriginala8e647976072bfab29447549cd39c7b6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala8e647976072bfab29447549cd39c7b6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.page-transition','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('page-transition'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

            <?php if (! empty(trim($__env->yieldContent('subheader')))): ?>
                <?php echo $__env->yieldContent('subheader'); ?>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            <?php echo $__env->yieldContent('content'); ?>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala8e647976072bfab29447549cd39c7b6)): ?>
<?php $attributes = $__attributesOriginala8e647976072bfab29447549cd39c7b6; ?>
<?php unset($__attributesOriginala8e647976072bfab29447549cd39c7b6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala8e647976072bfab29447549cd39c7b6)): ?>
<?php $component = $__componentOriginala8e647976072bfab29447549cd39c7b6; ?>
<?php unset($__componentOriginala8e647976072bfab29447549cd39c7b6); ?>
<?php endif; ?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2b499da6bda785a33d26ee2a64c589e0)): ?>
<?php $attributes = $__attributesOriginal2b499da6bda785a33d26ee2a64c589e0; ?>
<?php unset($__attributesOriginal2b499da6bda785a33d26ee2a64c589e0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2b499da6bda785a33d26ee2a64c589e0)): ?>
<?php $component = $__componentOriginal2b499da6bda785a33d26ee2a64c589e0; ?>
<?php unset($__componentOriginal2b499da6bda785a33d26ee2a64c589e0); ?>
<?php endif; ?>

    <?php if (isset($component)) { $__componentOriginalbcd757c7bb20b76cf9bcd607adaf8c39 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbcd757c7bb20b76cf9bcd607adaf8c39 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.toast-container','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('toast-container'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalbcd757c7bb20b76cf9bcd607adaf8c39)): ?>
<?php $attributes = $__attributesOriginalbcd757c7bb20b76cf9bcd607adaf8c39; ?>
<?php unset($__attributesOriginalbcd757c7bb20b76cf9bcd607adaf8c39); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalbcd757c7bb20b76cf9bcd607adaf8c39)): ?>
<?php $component = $__componentOriginalbcd757c7bb20b76cf9bcd607adaf8c39; ?>
<?php unset($__componentOriginalbcd757c7bb20b76cf9bcd607adaf8c39); ?>
<?php endif; ?>

    <?php echo \Livewire\Mechanisms\FrontendAssets\FrontendAssets::scripts(); ?>

</body>
</html>
<?php /**PATH /Users/falcaob/Herd/console.kraite.test/resources/views/layouts/app.blade.php ENDPATH**/ ?>