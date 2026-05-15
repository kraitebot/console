@props([
    'isColumnBorder' => true,
    'sort' => null,
])
<th
    data-component-name="Table/Th"
    {{ $attributes->class([
        'bg-zinc-900/10 dark:bg-zinc-900/90 p-4',
        'first:group-first/Tr:ltr:rounded-tl-lg last:group-first/Tr:ltr:rounded-tr-lg',
        'first:group-last/Tr:ltr:rounded-bl-lg last:group-last/Tr:ltr:rounded-br-lg',
        'first:group-first/Tr:rtl:rounded-tr-lg last:group-first/Tr:rtl:rounded-tl-lg',
        'first:group-last/Tr:rtl:rounded-br-lg last:group-last/Tr:rtl:rounded-bl-lg',
        'shadow-[inset_0_0_0_0.5px_rgba(0,0,0,0.1)] dark:shadow-[inset_0_0_0_0.5px_rgba(255,255,255,0.05)]' => $isColumnBorder,
    ]) }}
>
    {{ $slot }}
</th>
