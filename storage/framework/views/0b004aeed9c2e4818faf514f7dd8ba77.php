<?php $__env->startSection('header'); ?>
    <?php if (isset($component)) { $__componentOriginalfd1f218809a441e923395fcbf03e4272 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfd1f218809a441e923395fcbf03e4272 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.header','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

        <?php if (isset($component)) { $__componentOriginal0e91b47b359663f7e458327573580bbc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0e91b47b359663f7e458327573580bbc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.header.left','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('header.left'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

            <?php echo $__env->yieldContent('header-left'); ?>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0e91b47b359663f7e458327573580bbc)): ?>
<?php $attributes = $__attributesOriginal0e91b47b359663f7e458327573580bbc; ?>
<?php unset($__attributesOriginal0e91b47b359663f7e458327573580bbc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0e91b47b359663f7e458327573580bbc)): ?>
<?php $component = $__componentOriginal0e91b47b359663f7e458327573580bbc; ?>
<?php unset($__componentOriginal0e91b47b359663f7e458327573580bbc); ?>
<?php endif; ?>
        <?php if (isset($component)) { $__componentOriginal9da95044627aed2233160ed1dcb1a7e0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9da95044627aed2233160ed1dcb1a7e0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.header.right','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('header.right'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

            <button
                type="button"
                aria-label="Theme"
                class="text-zinc-500 hover:text-zinc-950 dark:hover:text-zinc-100"
                @click="$store.theme.cycle()"
            >
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = ['light' => 'Sun03', 'dark' => 'Moon02', 'system' => 'Computer']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mode => $icon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                    <span class="inline-flex text-2xl leading-none" x-show="$store.theme.mode === '<?php echo e($mode); ?>'">
                        <?php echo $__env->make('icons.' . $icon, array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    </span>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
            </button>
            <button type="button" aria-label="Language" class="text-zinc-500 hover:text-zinc-950 dark:hover:text-zinc-100">
                <span class="inline-flex text-2xl leading-none"><?php echo $__env->make('icons.LanguageSquare', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></span>
            </button>
            <button type="button" aria-label="Notifications" class="text-zinc-500 hover:text-zinc-950 dark:hover:text-zinc-100">
                <span class="inline-flex text-2xl leading-none"><?php echo $__env->make('icons.Notification03', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></span>
            </button>
            <form method="POST" action="<?php echo e(route('logout')); ?>" class="inline">
                <?php echo csrf_field(); ?>
                <button type="submit" aria-label="Logout" class="text-zinc-500 hover:text-red-500">
                    <span class="inline-flex text-2xl leading-none"><?php echo $__env->make('icons.Login03', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></span>
                </button>
            </form>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9da95044627aed2233160ed1dcb1a7e0)): ?>
<?php $attributes = $__attributesOriginal9da95044627aed2233160ed1dcb1a7e0; ?>
<?php unset($__attributesOriginal9da95044627aed2233160ed1dcb1a7e0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9da95044627aed2233160ed1dcb1a7e0)): ?>
<?php $component = $__componentOriginal9da95044627aed2233160ed1dcb1a7e0; ?>
<?php unset($__componentOriginal9da95044627aed2233160ed1dcb1a7e0); ?>
<?php endif; ?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfd1f218809a441e923395fcbf03e4272)): ?>
<?php $attributes = $__attributesOriginalfd1f218809a441e923395fcbf03e4272; ?>
<?php unset($__attributesOriginalfd1f218809a441e923395fcbf03e4272); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfd1f218809a441e923395fcbf03e4272)): ?>
<?php $component = $__componentOriginalfd1f218809a441e923395fcbf03e4272; ?>
<?php unset($__componentOriginalfd1f218809a441e923395fcbf03e4272); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo e($slot ?? ''); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/falcaob/Herd/console.kraite.test/resources/views/layouts/admin.blade.php ENDPATH**/ ?>