@props(['title', 'position' => null, 'exchange' => false])

<div class="border-t border-zinc-800 p-5 first:border-t-0 md:border-t-0 md:border-l md:first:border-l-0">
    <div class="mb-3 text-xs font-semibold uppercase tracking-wide text-zinc-500">{{ $title }}</div>
    @if ($position)
        <div class="grid grid-cols-2 gap-4 sm:grid-cols-3">
            @foreach (['quantity' => 'Qty', 'entry_price' => 'Entry', 'leverage' => 'Lev', 'margin' => 'Margin', 'margin_mode' => 'Mode'] as $field => $label)
                <div>
                    <div class="mb-1 text-xs uppercase tracking-wide text-zinc-600">{{ $label }}</div>
                    <div class="font-mono text-base text-zinc-100">
                        {{ ($position[$field] ?? '') !== '' && ($position[$field] ?? null) !== null ? $position[$field] : '-' }}{{ $field === 'leverage' && ($position[$field] ?? null) ? 'x' : '' }}
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="font-mono text-sm italic text-zinc-600">{{ $exchange ? 'Not on exchange' : 'Not in database' }}</div>
    @endif
</div>
