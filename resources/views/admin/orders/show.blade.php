<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Detail Pesanan #{{ $order->order_number }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 bg-gray-50 border-b flex justify-between items-center">
                    <div class="text-sm">
                        <p class="text-gray-600">Pesanan oleh: <span class="font-semibold">{{ $order->user->name }}</span></p>
                        <p class="text-gray-600">Tanggal: <span class="font-semibold">{{ $order->created_at->format('d F Y') }}</span></p>
                    </div>
                    <form action="{{ route('admin.orders.update', $order) }}" method="POST" class="flex items-center gap-3">
                        @csrf
                        @method('PATCH')
                        <label for="status" class="font-semibold">Ubah Status:</label>
                        <select name="status" id="status" class="rounded-md border-gray-300 shadow-sm">
                            <option value="pending" @selected($order->status == 'pending')>Pending</option>
                            <option value="processing" @selected($order->status == 'processing')>Processing</option>
                            <option value="shipped" @selected($order->status == 'shipped')>Shipped</option>
                            <option value="completed" @selected($order->status == 'completed')>Completed</option>
                            <option value="cancelled" @selected($order->status == 'cancelled')>Cancelled</option>
                        </select>
                        <button type="submit" class="bg-teal-700 text-white font-bold py-2 px-4 rounded-lg">Update</button>
                    </form>
                </div>

                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Rincian Produk</h3>
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Produk</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Harga</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kuantitas</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($order->items as $item)
                            <tr>
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $item->product->name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $item->quantity }}</td>
                                <td class="px-6 py-4 text-sm text-right">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-gray-50">
                            <tr>
                                <td colspan="3" class="px-6 py-3 text-right text-sm font-bold text-gray-800 uppercase">Total</td>
                                <td class="px-6 py-3 text-right text-sm font-bold text-gray-900">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
            <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50">
    &larr; Kembali ke Riwayat Pesanan
</a>
        </div>
    </div>
</x-app-layout>