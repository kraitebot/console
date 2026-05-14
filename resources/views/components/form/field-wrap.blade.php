@props(['firstIcon' => null, 'lastIcon' => null, 'firstSuffix' => null, 'lastSuffix' => null])
@php
    $hasFirst = $firstIcon || $firstSuffix;
    $hasLast = $lastIcon || $lastSuffix;
@endphp
<div
    data-component-name="FieldWrap"
    x-data="{}"
    x-init="$nextTick(() => {
        const input = $el.querySelector('input, textarea, select');
        if (!input) return;
        const f = $refs.first;
        const l = $refs.last;
        if (f) input.style.paddingLeft = (f.offsetWidth + 16) + 'px';
        if (l) input.style.paddingRight = (l.offsetWidth + 16) + 'px';
    })"
    {{ $attributes->class(['relative w-full']) }}
>
    @if ($hasFirst)
        <div x-ref="first" class="absolute top-[2px] bottom-[2px] start-2 z-10 flex items-center justify-center rounded-sm px-1">
            @if ($firstIcon)
                <x-icon :name="$firstIcon" class="text-zinc-500" />
            @else
                {!! $firstSuffix !!}
            @endif
        </div>
    @endif
    {{ $slot }}
    @if ($hasLast)
        <div x-ref="last" class="absolute top-[2px] bottom-[2px] end-2 z-10 flex items-center justify-center rounded-sm px-1">
            @if ($lastIcon)
                <x-icon :name="$lastIcon" class="text-zinc-500" />
            @else
                {!! $lastSuffix !!}
            @endif
        </div>
    @endif
</div>
