@props(['label', 'value', 'danger' => false])

<div class="border-l border-zinc-800 px-5 py-4 first:border-l-0">
    <div class="text-xs font-semibold uppercase tracking-wide text-zinc-500">{{ $label }}</div>
    <div class="mt-1 font-mono text-2xl font-bold {{ $danger ? 'text-amber-400' : 'text-zinc-100' }}">{{ $value }}</div>
</div>
