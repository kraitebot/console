<div
    {{ $attributes->class(['mb-4 grid gap-2']) }}
    :class="$store.aside.status ? 'grid-cols-2' : 'grid-cols-1'"
>
    {{ $slot }}
</div>
