<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'accounts' => [],
    'forms' => [],
    'expanded' => [],
    'connectivity' => [],
    'quoteOptions' => [],
    'leverageOptions' => [],
    'isCreating' => false,
    'newForm' => [],
    'apiSystemOptions' => [],
    'tradeConfigurationOptions' => [],
    'newQuoteOptions' => [],
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'accounts' => [],
    'forms' => [],
    'expanded' => [],
    'connectivity' => [],
    'quoteOptions' => [],
    'leverageOptions' => [],
    'isCreating' => false,
    'newForm' => [],
    'apiSystemOptions' => [],
    'tradeConfigurationOptions' => [],
    'newQuoteOptions' => [],
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div data-component-name="Users/AccountsPanel">
    <?php if (isset($component)) { $__componentOriginal53747ceb358d30c0105769f8471417f6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal53747ceb358d30c0105769f8471417f6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

        <?php if (isset($component)) { $__componentOriginal1d4357ee5fd8f0dcba6696de07062857 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1d4357ee5fd8f0dcba6696de07062857 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card.header','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card.header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

            <?php if (isset($component)) { $__componentOriginal64def30c24bacd2a907516c6e38a984d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal64def30c24bacd2a907516c6e38a984d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card.header-child','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card.header-child'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                <?php if (isset($component)) { $__componentOriginal6ea0bfee1a50e1de1096e35e7b344cad = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6ea0bfee1a50e1de1096e35e7b344cad = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card.title','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card.title'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                    <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'UserAccount','color' => 'primary','size' => 'text-3xl']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'UserAccount','color' => 'primary','size' => 'text-3xl']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
                    <div>
                        <div>Accounts</div>
                        <?php if (isset($component)) { $__componentOriginal4b3274c71e2431ef5ee1e1179f61765f = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4b3274c71e2431ef5ee1e1179f61765f = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card.subtitle','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card.subtitle'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>
<?php echo e(count($accounts)); ?> linked <?php echo e(str('account')->plural(count($accounts))); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4b3274c71e2431ef5ee1e1179f61765f)): ?>
<?php $attributes = $__attributesOriginal4b3274c71e2431ef5ee1e1179f61765f; ?>
<?php unset($__attributesOriginal4b3274c71e2431ef5ee1e1179f61765f); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4b3274c71e2431ef5ee1e1179f61765f)): ?>
<?php $component = $__componentOriginal4b3274c71e2431ef5ee1e1179f61765f; ?>
<?php unset($__componentOriginal4b3274c71e2431ef5ee1e1179f61765f); ?>
<?php endif; ?>
                    </div>
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6ea0bfee1a50e1de1096e35e7b344cad)): ?>
<?php $attributes = $__attributesOriginal6ea0bfee1a50e1de1096e35e7b344cad; ?>
<?php unset($__attributesOriginal6ea0bfee1a50e1de1096e35e7b344cad); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6ea0bfee1a50e1de1096e35e7b344cad)): ?>
<?php $component = $__componentOriginal6ea0bfee1a50e1de1096e35e7b344cad; ?>
<?php unset($__componentOriginal6ea0bfee1a50e1de1096e35e7b344cad); ?>
<?php endif; ?>
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal64def30c24bacd2a907516c6e38a984d)): ?>
<?php $attributes = $__attributesOriginal64def30c24bacd2a907516c6e38a984d; ?>
<?php unset($__attributesOriginal64def30c24bacd2a907516c6e38a984d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal64def30c24bacd2a907516c6e38a984d)): ?>
<?php $component = $__componentOriginal64def30c24bacd2a907516c6e38a984d; ?>
<?php unset($__componentOriginal64def30c24bacd2a907516c6e38a984d); ?>
<?php endif; ?>
            <?php if (isset($component)) { $__componentOriginal64def30c24bacd2a907516c6e38a984d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal64def30c24bacd2a907516c6e38a984d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card.header-child','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card.header-child'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                <?php if (isset($component)) { $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.button','data' => ['type' => 'button','variant' => 'solid','color' => 'primary','icon' => 'PlusSignCircle','dimension' => 'lg','wire:click' => 'showCreateAccountForm','wire:loading.attr' => 'disabled','wire:target' => 'showCreateAccountForm']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'button','variant' => 'solid','color' => 'primary','icon' => 'PlusSignCircle','dimension' => 'lg','wire:click' => 'showCreateAccountForm','wire:loading.attr' => 'disabled','wire:target' => 'showCreateAccountForm']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

                    Create account
                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $attributes = $__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__attributesOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561)): ?>
<?php $component = $__componentOriginald0f1fd2689e4bb7060122a5b91fe8561; ?>
<?php unset($__componentOriginald0f1fd2689e4bb7060122a5b91fe8561); ?>
<?php endif; ?>
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal64def30c24bacd2a907516c6e38a984d)): ?>
<?php $attributes = $__attributesOriginal64def30c24bacd2a907516c6e38a984d; ?>
<?php unset($__attributesOriginal64def30c24bacd2a907516c6e38a984d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal64def30c24bacd2a907516c6e38a984d)): ?>
<?php $component = $__componentOriginal64def30c24bacd2a907516c6e38a984d; ?>
<?php unset($__componentOriginal64def30c24bacd2a907516c6e38a984d); ?>
<?php endif; ?>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1d4357ee5fd8f0dcba6696de07062857)): ?>
<?php $attributes = $__attributesOriginal1d4357ee5fd8f0dcba6696de07062857; ?>
<?php unset($__attributesOriginal1d4357ee5fd8f0dcba6696de07062857); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1d4357ee5fd8f0dcba6696de07062857)): ?>
<?php $component = $__componentOriginal1d4357ee5fd8f0dcba6696de07062857; ?>
<?php unset($__componentOriginal1d4357ee5fd8f0dcba6696de07062857); ?>
<?php endif; ?>

        <?php if (isset($component)) { $__componentOriginalcc4d6dcf44f2ce2176eee5939e2828e6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalcc4d6dcf44f2ce2176eee5939e2828e6 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.card.body','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('card.body'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

            <?php if (isset($component)) { $__componentOriginal0a3cc9353a06bd4f538e7f2dc20849d0 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0a3cc9353a06bd4f538e7f2dc20849d0 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.users.accounts.create-form','data' => ['isOpen' => $isCreating,'form' => $newForm,'apiSystemOptions' => $apiSystemOptions,'tradeConfigurationOptions' => $tradeConfigurationOptions,'quoteOptions' => $newQuoteOptions,'leverageOptions' => $leverageOptions]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('users.accounts.create-form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['is-open' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($isCreating),'form' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($newForm),'api-system-options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($apiSystemOptions),'trade-configuration-options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($tradeConfigurationOptions),'quote-options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($newQuoteOptions),'leverage-options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($leverageOptions)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0a3cc9353a06bd4f538e7f2dc20849d0)): ?>
<?php $attributes = $__attributesOriginal0a3cc9353a06bd4f538e7f2dc20849d0; ?>
<?php unset($__attributesOriginal0a3cc9353a06bd4f538e7f2dc20849d0); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0a3cc9353a06bd4f538e7f2dc20849d0)): ?>
<?php $component = $__componentOriginal0a3cc9353a06bd4f538e7f2dc20849d0; ?>
<?php unset($__componentOriginal0a3cc9353a06bd4f538e7f2dc20849d0); ?>
<?php endif; ?>

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if(empty($accounts)): ?>
                <div class="rounded-xl border border-dashed border-primary-500/25 bg-primary-500/5 px-5 py-6 text-center">
                    <div class="mx-auto flex size-12 items-center justify-center rounded-lg border border-primary-500/25 bg-primary-500/10 text-primary-500">
                        <?php if (isset($component)) { $__componentOriginalce262628e3a8d44dc38fd1f3965181bc = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon','data' => ['name' => 'UserAccount','size' => 'text-2xl']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('icon'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'UserAccount','size' => 'text-2xl']); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $attributes = $__attributesOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__attributesOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc)): ?>
<?php $component = $__componentOriginalce262628e3a8d44dc38fd1f3965181bc; ?>
<?php unset($__componentOriginalce262628e3a8d44dc38fd1f3965181bc); ?>
<?php endif; ?>
                    </div>
                    <div class="mt-3 text-lg font-semibold text-zinc-900 dark:text-zinc-100">No linked accounts</div>
                    <p class="mt-1 text-base text-zinc-500">Create the first exchange account for this user.</p>
                </div>
            <?php else: ?>
                <div class="flex flex-col gap-3">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::openLoop(); ?><?php endif; ?><?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::startLoopIteration(); ?><?php endif; ?>
                        <?php if (isset($component)) { $__componentOriginal2a3aae865b986e487e4d5402ecd94df2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2a3aae865b986e487e4d5402ecd94df2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.users.accounts.row','data' => ['account' => $account,'form' => $forms[$account['id']] ?? [],'expanded' => $expanded[$account['id']] ?? false,'connectivity' => $connectivity[$account['id']] ?? null,'quoteOptions' => $quoteOptions[$account['id']] ?? [],'leverageOptions' => $leverageOptions]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('users.accounts.row'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['account' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($account),'form' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($forms[$account['id']] ?? []),'expanded' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($expanded[$account['id']] ?? false),'connectivity' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($connectivity[$account['id']] ?? null),'quote-options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($quoteOptions[$account['id']] ?? []),'leverage-options' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($leverageOptions)]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2a3aae865b986e487e4d5402ecd94df2)): ?>
<?php $attributes = $__attributesOriginal2a3aae865b986e487e4d5402ecd94df2; ?>
<?php unset($__attributesOriginal2a3aae865b986e487e4d5402ecd94df2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2a3aae865b986e487e4d5402ecd94df2)): ?>
<?php $component = $__componentOriginal2a3aae865b986e487e4d5402ecd94df2; ?>
<?php unset($__componentOriginal2a3aae865b986e487e4d5402ecd94df2); ?>
<?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::endLoop(); ?><?php endif; ?><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::closeLoop(); ?><?php endif; ?>
                </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalcc4d6dcf44f2ce2176eee5939e2828e6)): ?>
<?php $attributes = $__attributesOriginalcc4d6dcf44f2ce2176eee5939e2828e6; ?>
<?php unset($__attributesOriginalcc4d6dcf44f2ce2176eee5939e2828e6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalcc4d6dcf44f2ce2176eee5939e2828e6)): ?>
<?php $component = $__componentOriginalcc4d6dcf44f2ce2176eee5939e2828e6; ?>
<?php unset($__componentOriginalcc4d6dcf44f2ce2176eee5939e2828e6); ?>
<?php endif; ?>
     <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal53747ceb358d30c0105769f8471417f6)): ?>
<?php $attributes = $__attributesOriginal53747ceb358d30c0105769f8471417f6; ?>
<?php unset($__attributesOriginal53747ceb358d30c0105769f8471417f6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal53747ceb358d30c0105769f8471417f6)): ?>
<?php $component = $__componentOriginal53747ceb358d30c0105769f8471417f6; ?>
<?php unset($__componentOriginal53747ceb358d30c0105769f8471417f6); ?>
<?php endif; ?>
</div>
<?php /**PATH /Users/falcaob/Herd/console.kraite.test/resources/views/components/users/accounts/panel.blade.php ENDPATH**/ ?>