@props([
    'message' => null,
    'type' => 'success',
])

@if ($message)
    <div
        data-component-name="FlashToast"
        x-data
        x-init="$nextTick(() => $store.toast.push(@js($message), @js($type)))"
        class="hidden"
    ></div>
@endif
