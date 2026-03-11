<div class="p-4 bg-gray-50 rounded-lg">
    <table class="w-full text-sm border">
        <thead class="bg-gray-100">
            <tr>
                <th class="p-2 text-left">Spare Part</th>
                <th class="p-2 text-left">Price</th>
                <th class="p-2 text-left">Qty</th>
                <th class="p-2 text-left">Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($details as $item)
                <tr class="border-t">
                    <td class="p-2">{{ $item->sparePart->name }}</td>
                    <td class="p-2">
                        Rp {{ number_format($item->price,0,',','.') }}
                    </td>
                    <td class="p-2">{{ $item->qty }}</td>
                    <td class="p-2">
                        Rp {{ number_format($item->price * $item->qty,0,',','.') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
