@props(['field'])
{{ $slot }}
@error($field)
    <div data-component-name="Validation" class="mt-2 text-xs text-red-500/70">
        <p>{{ $message }}</p>
    </div>
@enderror
