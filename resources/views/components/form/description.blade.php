@props(['id' => null])
<div
    @if ($id) id="{{ $id }}" @endif
    data-component-name="Description"
    {{ $attributes->class(['text-sm text-zinc-500']) }}
>
    {{ $slot }}
</div>
