<td
    data-component-name="Table/Td"
    {{ $attributes->class([
        'first:ltr:rounded-l-lg last:ltr:rounded-r-lg',
        'first:rtl:rounded-r-lg last:rtl:rounded-l-lg',
        'group-even/Tr:bg-zinc-500/5 group-hover/Tr:bg-zinc-500/10',
        'dark:group-even/Tr:bg-zinc-900/50 dark:group-hover/Tr:bg-zinc-900/90',
        'p-4 transition-colors duration-300',
    ]) }}
>
    {{ $slot }}
</td>
