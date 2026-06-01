<?php
    $menu = config('menu');
    $tabs = [
        'dashboard' => ['id' => 'dashboard', 'title' => 'Dashboards', 'icon' => 'Home09'],
        'apps' => ['id' => 'apps', 'title' => 'CRUDs', 'icon' => 'GridView'],
        'documentation' => ['id' => 'documentation', 'title' => 'Documentation', 'icon' => 'BookBookmark02'],
        'examples' => ['id' => 'examples', 'title' => 'Examples', 'icon' => 'Star'],
    ];
?>

<?php if (isset($component)) { $__componentOriginal91c821ac63991f310c0b8692f4f16f0a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal91c821ac63991f310c0b8692f4f16f0a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.aside','data' => ['id' => 'aside-permanent']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('aside'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'aside-permanent']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

    <?php echo $__env->make('partials.aside-header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <?php if (isset($component)) { $__componentOriginal64a1a496e639e1b47bf4119380e3e833 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal64a1a496e639e1b47bf4119380e3e833 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.aside.body','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('aside.body'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

        <?php if (isset($component)) { $__componentOriginalf1ebc67783829b63e4cf2939db0793e6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf1ebc67783829b63e4cf2939db0793e6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.aside.quick-container','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('aside.quick-container'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $tabs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tab): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                <?php if (isset($component)) { $__componentOriginal89b0f71f2012fb3ea40e837093116188 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal89b0f71f2012fb3ea40e837093116188 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.aside.quick-nav','data' => ['icon' => $tab['icon'],'tabId' => $tab['id']]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('aside.quick-nav'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tab['icon']),'tab-id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tab['id'])]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                    <?php echo e($tab['title']); ?>

                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal89b0f71f2012fb3ea40e837093116188)): ?>
<?php $attributes = $__attributesOriginal89b0f71f2012fb3ea40e837093116188; ?>
<?php unset($__attributesOriginal89b0f71f2012fb3ea40e837093116188); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal89b0f71f2012fb3ea40e837093116188)): ?>
<?php $component = $__componentOriginal89b0f71f2012fb3ea40e837093116188; ?>
<?php unset($__componentOriginal89b0f71f2012fb3ea40e837093116188); ?>
<?php endif; ?>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf1ebc67783829b63e4cf2939db0793e6)): ?>
<?php $attributes = $__attributesOriginalf1ebc67783829b63e4cf2939db0793e6; ?>
<?php unset($__attributesOriginalf1ebc67783829b63e4cf2939db0793e6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf1ebc67783829b63e4cf2939db0793e6)): ?>
<?php $component = $__componentOriginalf1ebc67783829b63e4cf2939db0793e6; ?>
<?php unset($__componentOriginalf1ebc67783829b63e4cf2939db0793e6); ?>
<?php endif; ?>

        <?php if (isset($component)) { $__componentOriginalff09156f73c896030ee75284e9b2c466 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalff09156f73c896030ee75284e9b2c466 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.nav','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('nav'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

            
            <template x-if="$store.aside.activeTab === 'dashboard'">
                <div>
                    <?php if (isset($component)) { $__componentOriginal7eedbc2c2d08ff99d0d16b06273c362e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7eedbc2c2d08ff99d0d16b06273c362e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.nav.title','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('nav.title'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>
Dashboards <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7eedbc2c2d08ff99d0d16b06273c362e)): ?>
<?php $attributes = $__attributesOriginal7eedbc2c2d08ff99d0d16b06273c362e; ?>
<?php unset($__attributesOriginal7eedbc2c2d08ff99d0d16b06273c362e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7eedbc2c2d08ff99d0d16b06273c362e)): ?>
<?php $component = $__componentOriginal7eedbc2c2d08ff99d0d16b06273c362e; ?>
<?php unset($__componentOriginal7eedbc2c2d08ff99d0d16b06273c362e); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginala58bd2e851e761deb76949215ccc8274 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala58bd2e851e761deb76949215ccc8274 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.nav.item','data' => ['icon' => 'Home09','text' => 'Dashboard','to' => route('dashboard')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('nav.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['icon' => 'Home09','text' => 'Dashboard','to' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('dashboard'))]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala58bd2e851e761deb76949215ccc8274)): ?>
<?php $attributes = $__attributesOriginala58bd2e851e761deb76949215ccc8274; ?>
<?php unset($__attributesOriginala58bd2e851e761deb76949215ccc8274); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala58bd2e851e761deb76949215ccc8274)): ?>
<?php $component = $__componentOriginala58bd2e851e761deb76949215ccc8274; ?>
<?php unset($__componentOriginala58bd2e851e761deb76949215ccc8274); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginala58bd2e851e761deb76949215ccc8274 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala58bd2e851e761deb76949215ccc8274 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.nav.item','data' => ['icon' => $menu['apps']['sales']['icon'],'text' => $menu['apps']['sales']['text'],'to' => $menu['apps']['sales']['to']]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('nav.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($menu['apps']['sales']['icon']),'text' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($menu['apps']['sales']['text']),'to' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($menu['apps']['sales']['to'])]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala58bd2e851e761deb76949215ccc8274)): ?>
<?php $attributes = $__attributesOriginala58bd2e851e761deb76949215ccc8274; ?>
<?php unset($__attributesOriginala58bd2e851e761deb76949215ccc8274); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala58bd2e851e761deb76949215ccc8274)): ?>
<?php $component = $__componentOriginala58bd2e851e761deb76949215ccc8274; ?>
<?php unset($__componentOriginala58bd2e851e761deb76949215ccc8274); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginala58bd2e851e761deb76949215ccc8274 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala58bd2e851e761deb76949215ccc8274 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.nav.item','data' => ['icon' => $menu['apps']['customer']['icon'],'text' => $menu['apps']['customer']['text'],'to' => $menu['apps']['customer']['to']]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('nav.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($menu['apps']['customer']['icon']),'text' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($menu['apps']['customer']['text']),'to' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($menu['apps']['customer']['to'])]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala58bd2e851e761deb76949215ccc8274)): ?>
<?php $attributes = $__attributesOriginala58bd2e851e761deb76949215ccc8274; ?>
<?php unset($__attributesOriginala58bd2e851e761deb76949215ccc8274); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala58bd2e851e761deb76949215ccc8274)): ?>
<?php $component = $__componentOriginala58bd2e851e761deb76949215ccc8274; ?>
<?php unset($__componentOriginala58bd2e851e761deb76949215ccc8274); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginala58bd2e851e761deb76949215ccc8274 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala58bd2e851e761deb76949215ccc8274 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.nav.item','data' => ['icon' => $menu['apps']['products']['icon'],'text' => $menu['apps']['products']['text'],'to' => $menu['apps']['products']['to']]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('nav.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($menu['apps']['products']['icon']),'text' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($menu['apps']['products']['text']),'to' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($menu['apps']['products']['to'])]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                        <?php if (isset($component)) { $__componentOriginald893e7e8bc87cf8d0787b9d5ccf65502 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald893e7e8bc87cf8d0787b9d5ccf65502 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.nav.button','data' => ['icon' => 'PlusSignCircle','title' => 'New']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('nav.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['icon' => 'PlusSignCircle','title' => 'New']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald893e7e8bc87cf8d0787b9d5ccf65502)): ?>
<?php $attributes = $__attributesOriginald893e7e8bc87cf8d0787b9d5ccf65502; ?>
<?php unset($__attributesOriginald893e7e8bc87cf8d0787b9d5ccf65502); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald893e7e8bc87cf8d0787b9d5ccf65502)): ?>
<?php $component = $__componentOriginald893e7e8bc87cf8d0787b9d5ccf65502; ?>
<?php unset($__componentOriginald893e7e8bc87cf8d0787b9d5ccf65502); ?>
<?php endif; ?>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala58bd2e851e761deb76949215ccc8274)): ?>
<?php $attributes = $__attributesOriginala58bd2e851e761deb76949215ccc8274; ?>
<?php unset($__attributesOriginala58bd2e851e761deb76949215ccc8274); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala58bd2e851e761deb76949215ccc8274)): ?>
<?php $component = $__componentOriginala58bd2e851e761deb76949215ccc8274; ?>
<?php unset($__componentOriginala58bd2e851e761deb76949215ccc8274); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginala58bd2e851e761deb76949215ccc8274 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala58bd2e851e761deb76949215ccc8274 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.nav.item','data' => ['icon' => $menu['apps']['projects']['icon'],'text' => $menu['apps']['projects']['text'],'to' => $menu['apps']['projects']['to']]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('nav.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($menu['apps']['projects']['icon']),'text' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($menu['apps']['projects']['text']),'to' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($menu['apps']['projects']['to'])]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala58bd2e851e761deb76949215ccc8274)): ?>
<?php $attributes = $__attributesOriginala58bd2e851e761deb76949215ccc8274; ?>
<?php unset($__attributesOriginala58bd2e851e761deb76949215ccc8274); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala58bd2e851e761deb76949215ccc8274)): ?>
<?php $component = $__componentOriginala58bd2e851e761deb76949215ccc8274; ?>
<?php unset($__componentOriginala58bd2e851e761deb76949215ccc8274); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginala58bd2e851e761deb76949215ccc8274 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala58bd2e851e761deb76949215ccc8274 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.nav.item','data' => ['icon' => $menu['apps']['invoices']['icon'],'text' => $menu['apps']['invoices']['text'],'to' => $menu['apps']['invoices']['to']]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('nav.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($menu['apps']['invoices']['icon']),'text' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($menu['apps']['invoices']['text']),'to' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($menu['apps']['invoices']['to'])]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala58bd2e851e761deb76949215ccc8274)): ?>
<?php $attributes = $__attributesOriginala58bd2e851e761deb76949215ccc8274; ?>
<?php unset($__attributesOriginala58bd2e851e761deb76949215ccc8274); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala58bd2e851e761deb76949215ccc8274)): ?>
<?php $component = $__componentOriginala58bd2e851e761deb76949215ccc8274; ?>
<?php unset($__componentOriginala58bd2e851e761deb76949215ccc8274); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginala58bd2e851e761deb76949215ccc8274 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala58bd2e851e761deb76949215ccc8274 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.nav.item','data' => ['icon' => $menu['apps']['mail']['icon'],'text' => $menu['apps']['mail']['text'],'to' => $menu['apps']['mail']['to']]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('nav.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($menu['apps']['mail']['icon']),'text' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($menu['apps']['mail']['text']),'to' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($menu['apps']['mail']['to'])]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                        <?php if (isset($component)) { $__componentOriginal2ddbc40e602c342e508ac696e52f8719 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2ddbc40e602c342e508ac696e52f8719 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.badge','data' => ['variant' => 'soft','color' => 'emerald']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'soft','color' => 'emerald']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>
8 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2ddbc40e602c342e508ac696e52f8719)): ?>
<?php $attributes = $__attributesOriginal2ddbc40e602c342e508ac696e52f8719; ?>
<?php unset($__attributesOriginal2ddbc40e602c342e508ac696e52f8719); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2ddbc40e602c342e508ac696e52f8719)): ?>
<?php $component = $__componentOriginal2ddbc40e602c342e508ac696e52f8719; ?>
<?php unset($__componentOriginal2ddbc40e602c342e508ac696e52f8719); ?>
<?php endif; ?>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala58bd2e851e761deb76949215ccc8274)): ?>
<?php $attributes = $__attributesOriginala58bd2e851e761deb76949215ccc8274; ?>
<?php unset($__attributesOriginala58bd2e851e761deb76949215ccc8274); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala58bd2e851e761deb76949215ccc8274)): ?>
<?php $component = $__componentOriginala58bd2e851e761deb76949215ccc8274; ?>
<?php unset($__componentOriginala58bd2e851e761deb76949215ccc8274); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginala58bd2e851e761deb76949215ccc8274 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala58bd2e851e761deb76949215ccc8274 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.nav.item','data' => ['icon' => $menu['apps']['chat']['icon'],'text' => $menu['apps']['chat']['text'],'to' => $menu['apps']['chat']['to']]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('nav.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($menu['apps']['chat']['icon']),'text' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($menu['apps']['chat']['text']),'to' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($menu['apps']['chat']['to'])]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                        <?php if (isset($component)) { $__componentOriginal2ddbc40e602c342e508ac696e52f8719 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2ddbc40e602c342e508ac696e52f8719 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.badge','data' => ['variant' => 'soft','color' => 'zinc']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['variant' => 'soft','color' => 'zinc']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>
Soon <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2ddbc40e602c342e508ac696e52f8719)): ?>
<?php $attributes = $__attributesOriginal2ddbc40e602c342e508ac696e52f8719; ?>
<?php unset($__attributesOriginal2ddbc40e602c342e508ac696e52f8719); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2ddbc40e602c342e508ac696e52f8719)): ?>
<?php $component = $__componentOriginal2ddbc40e602c342e508ac696e52f8719; ?>
<?php unset($__componentOriginal2ddbc40e602c342e508ac696e52f8719); ?>
<?php endif; ?>
                     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala58bd2e851e761deb76949215ccc8274)): ?>
<?php $attributes = $__attributesOriginala58bd2e851e761deb76949215ccc8274; ?>
<?php unset($__attributesOriginala58bd2e851e761deb76949215ccc8274); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala58bd2e851e761deb76949215ccc8274)): ?>
<?php $component = $__componentOriginala58bd2e851e761deb76949215ccc8274; ?>
<?php unset($__componentOriginala58bd2e851e761deb76949215ccc8274); ?>
<?php endif; ?>
                </div>
            </template>

            
            <template x-if="$store.aside.activeTab === 'apps'">
                <div>
                    <?php if (isset($component)) { $__componentOriginal7eedbc2c2d08ff99d0d16b06273c362e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7eedbc2c2d08ff99d0d16b06273c362e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.nav.title','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('nav.title'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>
Entities <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7eedbc2c2d08ff99d0d16b06273c362e)): ?>
<?php $attributes = $__attributesOriginal7eedbc2c2d08ff99d0d16b06273c362e; ?>
<?php unset($__attributesOriginal7eedbc2c2d08ff99d0d16b06273c362e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7eedbc2c2d08ff99d0d16b06273c362e)): ?>
<?php $component = $__componentOriginal7eedbc2c2d08ff99d0d16b06273c362e; ?>
<?php unset($__componentOriginal7eedbc2c2d08ff99d0d16b06273c362e); ?>
<?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $menu['entities']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $entity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginala58bd2e851e761deb76949215ccc8274 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala58bd2e851e761deb76949215ccc8274 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.nav.item','data' => ['icon' => $entity['icon'],'text' => $entity['text'],'to' => $entity['to']]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('nav.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($entity['icon']),'text' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($entity['text']),'to' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($entity['to'])]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala58bd2e851e761deb76949215ccc8274)): ?>
<?php $attributes = $__attributesOriginala58bd2e851e761deb76949215ccc8274; ?>
<?php unset($__attributesOriginala58bd2e851e761deb76949215ccc8274); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala58bd2e851e761deb76949215ccc8274)): ?>
<?php $component = $__componentOriginala58bd2e851e761deb76949215ccc8274; ?>
<?php unset($__componentOriginala58bd2e851e761deb76949215ccc8274); ?>
<?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>
            </template>

            
            <template x-if="$store.aside.activeTab === 'dashboard'">
                <div>
                    <?php if (isset($component)) { $__componentOriginal7eedbc2c2d08ff99d0d16b06273c362e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7eedbc2c2d08ff99d0d16b06273c362e = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.nav.title','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('nav.title'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>
Pages Examples <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7eedbc2c2d08ff99d0d16b06273c362e)): ?>
<?php $attributes = $__attributesOriginal7eedbc2c2d08ff99d0d16b06273c362e; ?>
<?php unset($__attributesOriginal7eedbc2c2d08ff99d0d16b06273c362e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7eedbc2c2d08ff99d0d16b06273c362e)): ?>
<?php $component = $__componentOriginal7eedbc2c2d08ff99d0d16b06273c362e; ?>
<?php unset($__componentOriginal7eedbc2c2d08ff99d0d16b06273c362e); ?>
<?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = ['list', 'grid', 'edit']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <?php $node = $menu['pagesExamples'][$key]; ?>
                        <?php if (isset($component)) { $__componentOriginala5b55efa8c39eb64bb720644e6dc63bf = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala5b55efa8c39eb64bb720644e6dc63bf = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.nav.collapse','data' => ['icon' => $node['icon'],'text' => $node['text'],'to' => $node['to']]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('nav.collapse'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($node['icon']),'text' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($node['text']),'to' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($node['to'])]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $node['subPages']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                                <?php if (isset($component)) { $__componentOriginala58bd2e851e761deb76949215ccc8274 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala58bd2e851e761deb76949215ccc8274 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.nav.item','data' => ['icon' => $sub['icon'],'text' => $sub['text'],'to' => $sub['to']]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('nav.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($sub['icon']),'text' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($sub['text']),'to' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($sub['to'])]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala58bd2e851e761deb76949215ccc8274)): ?>
<?php $attributes = $__attributesOriginala58bd2e851e761deb76949215ccc8274; ?>
<?php unset($__attributesOriginala58bd2e851e761deb76949215ccc8274); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala58bd2e851e761deb76949215ccc8274)): ?>
<?php $component = $__componentOriginala58bd2e851e761deb76949215ccc8274; ?>
<?php unset($__componentOriginala58bd2e851e761deb76949215ccc8274); ?>
<?php endif; ?>
                            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala5b55efa8c39eb64bb720644e6dc63bf)): ?>
<?php $attributes = $__attributesOriginala5b55efa8c39eb64bb720644e6dc63bf; ?>
<?php unset($__attributesOriginala5b55efa8c39eb64bb720644e6dc63bf); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala5b55efa8c39eb64bb720644e6dc63bf)): ?>
<?php $component = $__componentOriginala5b55efa8c39eb64bb720644e6dc63bf; ?>
<?php unset($__componentOriginala5b55efa8c39eb64bb720644e6dc63bf); ?>
<?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = ['login', 'signup', 'notFound', 'underConstruction']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <?php $node = $menu['pagesExamples'][$key]; ?>
                        <?php if (isset($component)) { $__componentOriginala58bd2e851e761deb76949215ccc8274 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala58bd2e851e761deb76949215ccc8274 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.nav.item','data' => ['icon' => $node['icon'],'text' => $node['text'],'to' => $node['to']]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('nav.item'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($node['icon']),'text' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($node['text']),'to' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($node['to'])]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala58bd2e851e761deb76949215ccc8274)): ?>
<?php $attributes = $__attributesOriginala58bd2e851e761deb76949215ccc8274; ?>
<?php unset($__attributesOriginala58bd2e851e761deb76949215ccc8274); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala58bd2e851e761deb76949215ccc8274)): ?>
<?php $component = $__componentOriginala58bd2e851e761deb76949215ccc8274; ?>
<?php unset($__componentOriginala58bd2e851e761deb76949215ccc8274); ?>
<?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>
            </template>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalff09156f73c896030ee75284e9b2c466)): ?>
<?php $attributes = $__attributesOriginalff09156f73c896030ee75284e9b2c466; ?>
<?php unset($__attributesOriginalff09156f73c896030ee75284e9b2c466); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalff09156f73c896030ee75284e9b2c466)): ?>
<?php $component = $__componentOriginalff09156f73c896030ee75284e9b2c466; ?>
<?php unset($__componentOriginalff09156f73c896030ee75284e9b2c466); ?>
<?php endif; ?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal64a1a496e639e1b47bf4119380e3e833)): ?>
<?php $attributes = $__attributesOriginal64a1a496e639e1b47bf4119380e3e833; ?>
<?php unset($__attributesOriginal64a1a496e639e1b47bf4119380e3e833); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal64a1a496e639e1b47bf4119380e3e833)): ?>
<?php $component = $__componentOriginal64a1a496e639e1b47bf4119380e3e833; ?>
<?php unset($__componentOriginal64a1a496e639e1b47bf4119380e3e833); ?>
<?php endif; ?>

    <?php echo $__env->make('partials.aside-footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal91c821ac63991f310c0b8692f4f16f0a)): ?>
<?php $attributes = $__attributesOriginal91c821ac63991f310c0b8692f4f16f0a; ?>
<?php unset($__attributesOriginal91c821ac63991f310c0b8692f4f16f0a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal91c821ac63991f310c0b8692f4f16f0a)): ?>
<?php $component = $__componentOriginal91c821ac63991f310c0b8692f4f16f0a; ?>
<?php unset($__componentOriginal91c821ac63991f310c0b8692f4f16f0a); ?>
<?php endif; ?>
<?php /**PATH /Users/falcaob/Herd/console.kraite.test/resources/views/partials/aside-default.blade.php ENDPATH**/ ?>