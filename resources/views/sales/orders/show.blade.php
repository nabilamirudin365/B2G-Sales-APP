<x-sales-layout>
    <div class="bg-white p-6 rounded-xl shadow-md mb-8">
        <h1 class="text-2xl font-bold text-blue-900">Detail Pesanan #{{ $order->order_number }}</h1>
        <p class="text-gray-500 mt-1">Dibuat pada {{ $order->created_at->format('d F Y, H:i') }}</p>
    </div>

    <div class="bg-white rounded-xl shadow-md">
        <div class="p-6 border-b border-gray-200">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <h3 class="text-xs font-medium text-gray-500 uppercase">Nomor Pesanan</h3>
                    <p class="text-base text-gray-800 font-semibold">{{ $order->order_number }}</p>
                </div>
                <div>
                    <h3 class="text-xs font-medium text-gray-500 uppercase">Total Pembayaran</h3>
                    <p class="text-base text-gray-800 font-semibold">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                </div>
                <div>
                    <h3 class="text-xs font-medium text-gray-500 uppercase">Status Pesanan</h3>
                    <span class="px-2 inline-flex text-sm leading-5 font-semibold rounded-full
                        {{ $order->status == 'completed' ? 'bg-green-100 text-green-800' : '' }}
                        {{ $order->status == 'shipped' ? 'bg-blue-100 text-blue-800' : '' }}
                        {{ $order->status == 'processing' ? 'bg-yellow-100 text-yellow-800' : '' }}
                        {{ $order->status == 'pending' ? 'bg-gray-100 text-gray-800' : '' }}">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>
            </div>
        </div>

        <div class="p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Rincian Produk</h3>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Produk</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Harga Satuan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kuantitas</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($order->items as $item)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $item->product->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $item->quantity }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 text-right">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="p-6 bg-gray-50 text-right border-t border-gray-200">
            <a href="{{ route('sales.orders.index') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">
                &larr; Kembali ke Riwayat
            </a>
        </div>
    </div>
</x-sales-layout>