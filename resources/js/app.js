import collapse from '@alpinejs/collapse';

const pushToast = (payload = {}) => {
    const detail = Array.isArray(payload) ? (payload[0] ?? {}) : payload;

    if (detail?.message && window.Alpine?.store('toast')) {
        window.Alpine.store('toast').push(detail.message, detail.type);
    }
};

const consumePendingToast = () => {
    const raw = window.sessionStorage.getItem('pending_toast');

    if (!raw) {
        return;
    }

    window.sessionStorage.removeItem('pending_toast');
    pushToast(JSON.parse(raw));
};

document.addEventListener('alpine:init', () => {
    window.Alpine.plugin(collapse);

    window.Alpine.store('aside', {
        status: JSON.parse(localStorage.getItem('aside_status') ?? 'true'),
        activeTab: localStorage.getItem('bolt_activeTab') ?? 'dashboard',
        toggle() {
            this.status = !this.status;
            localStorage.setItem('aside_status', JSON.stringify(this.status));
        },
        setActiveTab(id) {
            this.activeTab = id;
            localStorage.setItem('bolt_activeTab', id);
        },
    });

    window.Alpine.store('navigation', {
        path: window.location.pathname,
    });

    window.Alpine.store('pageTransition', {
        leaving: false,
        duration: 180,
        go(url) {
            if (!url) {
                return;
            }

            const target = new URL(url, window.location.origin);

            if (target.origin !== window.location.origin) {
                window.location.href = target.href;

                return;
            }

            if (`${target.pathname}${target.search}` === `${window.location.pathname}${window.location.search}`) {
                return;
            }

            this.leaving = true;

            window.setTimeout(() => {
                window.Livewire.navigate(target.href);
            }, this.duration);
        },
        navigate(event, url) {
            if (!url || event.defaultPrevented || event.button !== 0 || event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) {
                return;
            }

            const target = new URL(url, window.location.origin);

            if (target.origin !== window.location.origin) {
                return;
            }

            event.preventDefault();
            this.go(target.href);
        },
        enter() {
            window.requestAnimationFrame(() => {
                this.leaving = false;
            });
        },
    });

    window.Alpine.store('theme', {
        mode: localStorage.getItem('theme') || 'system',
        init() {
            this.apply();
            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => this.apply());
        },
        apply() {
            const isDark = this.mode === 'dark' || (this.mode === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches);
            document.documentElement.classList.toggle('dark', isDark);
        },
        cycle() {
            const next = { light: 'dark', dark: 'system', system: 'light' };
            this.mode = next[this.mode] ?? 'light';
            localStorage.setItem('theme', this.mode);
            this.apply();
        },
    });

    window.Alpine.store('toast', {
        items: [],
        nextId: 1,
        push(message, type = 'success') {
            const id = this.nextId++;
            const normalizedType = ['alert', 'error', 'success'].includes(type) ? type : 'alert';
            const titles = {
                success: 'Saved',
                alert: 'Alert',
                error: 'Error',
            };

            this.items.push({
                id,
                type: normalizedType,
                title: titles[normalizedType],
                message,
            });

            window.setTimeout(() => this.dismiss(id), 3000);
        },
        dismiss(id) {
            this.items = this.items.filter((toast) => toast.id !== id);
        },
    });
});

document.addEventListener('livewire:navigated', () => {
    if (window.Alpine?.store('navigation')) {
        window.Alpine.store('navigation').path = window.location.pathname;
    }

    if (window.Alpine?.store('pageTransition')) {
            window.Alpine.store('pageTransition').enter();
    }

    consumePendingToast();
});

document.addEventListener('page-transition:navigate', (event) => {
    if (event.detail?.toast?.message) {
        window.sessionStorage.setItem('pending_toast', JSON.stringify(event.detail.toast));
    }

    if (window.Alpine?.store('pageTransition')) {
        window.Alpine.store('pageTransition').go(event.detail?.url);
    }
});

document.addEventListener('toast', (event) => {
    pushToast(event.detail);
});

document.addEventListener('livewire:init', () => {
    window.Livewire.on('notify', pushToast);
});

const livewireSearchTimers = new WeakMap();

document.addEventListener('input', (event) => {
    const input = event.target.closest('[data-livewire-search]');

    if (!input) {
        return;
    }

    window.clearTimeout(livewireSearchTimers.get(input));

    livewireSearchTimers.set(input, window.setTimeout(() => {
        let componentRoot = input.parentElement;

        while (componentRoot && !componentRoot.hasAttribute('wire:id')) {
            componentRoot = componentRoot.parentElement;
        }

        const componentName = input.dataset.livewireComponent;
        const componentId = componentRoot?.getAttribute('wire:id')
            || window.Livewire?.all?.().find((component) => component.name === componentName)?.id;
        const method = input.dataset.livewireSearch;

        if (!componentId || !method || !window.Livewire?.find(componentId)) {
            return;
        }

        window.Livewire.find(componentId).call(method, input.value);
    }, 300));
});
