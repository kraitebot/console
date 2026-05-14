@props(['for' => null])
<label
    @if ($for) for="{{ $for }}" @endif
    data-component-name="Label"
    {{ $attributes->class(['mb-2 inline-block w-full cursor-pointer text-sm']) }}
>
    {{ $slot }}
</label>
