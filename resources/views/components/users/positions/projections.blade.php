@props(['rows' => [], 'compact' => false])

@php
    $formatPnl = fn ($value) => $value === null || $value === '' ? '-' : (((float) $value > 0 ? '+' : '').number_format((float) $value, 4, '.', ''));
    $pnlClass = fn ($value) => $value === null || $value === '' ? 'text-zinc-500' : ((float) $value > 0 ? 'text-emerald-400' : ((float) $value < 0 ? 'text-red-400' : 'text-zinc-400'));
@endphp

<div class="{{ $compact ? 'rounded-lg border border-zinc-800' : 'border-t border-zinc-800' }} overflow-x-auto">
    @if (count($rows) > 0)
        <table class="w-full min-w-[820px] font-mono {{ $compact ? 'text-xs' : 'text-sm' }}">
            <thead class="bg-zinc-900 text-xs uppercase tracking-wide text-zinc-500">
                <tr>
                    <th class="px-4 py-2 text-left">Order Type</th>
                    <th class="px-3 py-2 text-left">Side</th>
                    <th class="px-3 py-2 text-right">Price</th>
                    <th class="px-3 py-2 text-right">Size</th>
                    <th class="px-3 py-2 text-right">Avg Entry</th>
                    <th class="px-3 py-2 text-right">TP Price</th>
                    <th class="px-3 py-2 text-right">PnL @ Fill</th>
                    <th class="px-4 py-2 text-right">Profit @ TP</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rows as $row)
                    <tr class="border-t border-zinc-800">
                        <td class="px-4 py-2 text-zinc-400">{{ $row['type'] }}</td>
                        <td class="px-3 py-2"><x-badge :color="$row['side'] === 'BUY' ? 'emerald' : 'red'">{{ $row['side'] }}</x-badge></td>
                        <td class="px-3 py-2 text-right text-zinc-300">{{ $row['price'] }}</td>
                        <td class="px-3 py-2 text-right text-zinc-300">{{ $row['size'] }}</td>
                        <td class="px-3 py-2 text-right text-zinc-500">{{ $row['avg_entry'] ?? '-' }}</td>
                        <td class="px-3 py-2 text-right text-zinc-500">{{ $row['tp_price'] ?? '-' }}</td>
                        <td class="px-3 py-2 text-right {{ $pnlClass($row['pnl_at_fill']) }}">{{ $formatPnl($row['pnl_at_fill']) }}</td>
                        <td class="px-4 py-2 text-right {{ $pnlClass($row['profit_at_tp']) }}">{{ $formatPnl($row['profit_at_tp']) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="px-4 py-4 font-mono text-sm italic text-zinc-600">No projections available.</div>
    @endif
</div>
