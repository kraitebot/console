@props(['firstIcon' => null, 'lastIcon' => null, 'firstSuffix' => null, 'lastSuffix' => null])
<div {{ $attributes->class(['flex items-center gap-2 rounded-xl border border-zinc-500/25 bg-white px-3 py-2 transition-all duration-300 ease-in-out hover:border-zinc-500/50 dark:bg-zinc-900']) }}>
    @if ($firstIcon)
        <x-icon :name="$firstIcon" class="text-zinc-500" />
    @elseif ($firstSuffix)
        <span class="text-zinc-500">{!! $firstSuffix !!}</span>
    @endif
    <div class="grow">{{ $slot }}</div>
    @if ($lastIcon)
        <x-icon :name="$lastIcon" class="text-zinc-500" />
    @elseif ($lastSuffix)
        <span class="text-zinc-500">{!! $lastSuffix !!}</span>
    @endif
</div>
