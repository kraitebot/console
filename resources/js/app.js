import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';
import '@hotwired/turbo';

Alpine.plugin(collapse);

Alpine.store('aside', {
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

Alpine.store('navigation', {
    path: window.location.pathname,
});

Alpine.store('theme', {
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

window.Alpine = Alpine;
Alpine.start();

document.addEventListener('turbo:load', () => {
    Alpine.store('navigation').path = window.location.pathname;
});
