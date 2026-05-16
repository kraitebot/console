@props(['list' => [], 'homePath' => '/'])
<div
    data-component-name="Breadcrumb"
    {{ $attributes->class(['flex items-center gap-2 text-zinc-500']) }}
>
    <a href="{{ $homePath }}" wire:navigate class="hidden cursor-pointer md:flex">
        @include('icons.Home09')
    </a>
    @foreach ($list as $item)
        @php
            $isLast = $loop->last;
            $cls = 'flex items-center gap-1 before:pe-2 before:content-["/"] last:font-bold';
            $cls .= $isLast ? ' flex' : ' hidden md:flex';
        @endphp
        @if (! empty($item['to']))
            <a href="{{ $item['to'] }}" wire:navigate class="{{ $cls }}">
                @if (! empty($item['icon']))
                    @includeIf('icons.' . $item['icon'])
                @endif
                <div class="truncate max-md:max-w-32">{{ $item['text'] ?? '' }}</div>
            </a>
        @else
            <div class="{{ $cls }}">
                @if (! empty($item['icon']))
                    @includeIf('icons.' . $item['icon'])
                @endif
                <div class="truncate max-md:max-w-32">{{ $item['text'] ?? '' }}</div>
            </div>
        @endif
    @endforeach
</div>
