@props(['orders' => [], 'compact' => false])

@if (count($orders) > 0)
    <div class="{{ $compact ? 'mb-4 rounded-lg border border-zinc-800' : 'border-t border-zinc-800' }} overflow-x-auto">
        <table class="w-full min-w-[760px] font-mono {{ $compact ? 'text-xs' : 'text-sm' }}">
            <thead class="bg-zinc-900 text-xs uppercase tracking-wide text-zinc-500">
                <tr>
                    <th class="px-4 py-2 text-left">Status</th>
                    <th class="px-3 py-2 text-left">Type / Side</th>
                    <th class="px-3 py-2 text-right">DB</th>
                    <th class="px-4 py-2 text-right">Exchange</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    @php
                        $db = $order['db'] ?? null;
                        $exchange = $order['exchange'] ?? null;
                    @endphp
                    <tr class="border-t border-zinc-800">
                        <td class="px-4 py-2"><x-badge color="emerald">{{ ucfirst($order['status']) }}</x-badge></td>
                        <td class="px-3 py-2 text-zinc-300">
                            {{ $db['type'] ?? $exchange['type'] ?? '-' }}
                            <x-badge :color="($db['side'] ?? $exchange['side'] ?? '') === 'BUY' ? 'emerald' : 'red'">{{ $db['side'] ?? $exchange['side'] ?? '-' }}</x-badge>
                        </td>
                        <td class="px-3 py-2 text-right text-zinc-300">
                            @if ($db)
                                <div class="text-zinc-500">#{{ $db['id'] }}</div>
                                <div>{{ $db['quantity'] }} @ {{ $db['price'] }}</div>
                                <div class="text-xs text-zinc-500">{{ $db['status'] }}</div>
                            @else
                                <span class="text-zinc-600">-</span>
                            @endif
                        </td>
                        <td class="px-4 py-2 text-right text-zinc-300">
                            @if ($exchange)
                                <div>{{ $exchange['quantity'] }} @ {{ $exchange['price'] }}</div>
                                <div class="text-xs text-zinc-500">{{ $exchange['status'] }}</div>
                            @else
                                <span class="text-zinc-600">-</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endif
