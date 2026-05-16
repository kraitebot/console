<nav
    data-component-name="Nav"
    x-data="{
        indicator: { visible: false, top: 0, left: 0, width: 0, height: 0 },
        updateIndicator() {
            this.$nextTick(() => {
                const active = this.$el.querySelector('[data-nav-link][aria-current=page]');

                if (!active) {
                    this.indicator.visible = false;

                    return;
                }

                const nav = this.$el.getBoundingClientRect();
                const rect = active.getBoundingClientRect();

                this.indicator = {
                    visible: true,
                    top: rect.top - nav.top,
                    left: rect.left - nav.left,
                    width: rect.width,
                    height: rect.height,
                };
            });
        },
    }"
    x-init="
        updateIndicator();
        $watch('$store.navigation.path', () => updateIndicator());
        $watch('$store.aside.activeTab', () => updateIndicator());
        $watch('$store.aside.status', () => setTimeout(() => updateIndicator(), 320));
        window.addEventListener('resize', () => updateIndicator());
        document.addEventListener('livewire:navigated', () => updateIndicator());
    "
    {{ $attributes->class('relative') }}
>
    <div
        data-component-name="Nav/ActiveIndicator"
        aria-hidden="true"
        class="pointer-events-none absolute z-0 rounded-xl bg-primary-500/12 opacity-0 transition-all duration-300 ease-out dark:bg-primary-500/15"
        :class="indicator.visible ? 'opacity-100' : 'opacity-0'"
        :style="`transform: translate3d(${indicator.left}px, ${indicator.top}px, 0); width: ${indicator.width}px; height: ${indicator.height}px;`"
    ></div>
    <ul class="relative z-10">{{ $slot }}</ul>
</nav>
