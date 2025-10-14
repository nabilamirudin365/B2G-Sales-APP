<x-sales-layout>
    <div class="bg-white p-6 rounded-xl shadow-md mb-8">
        <h1 class="text-2xl font-bold text-blue-900">Keranjang Pesanan</h1>
        
        @if(session('order_for_merchant'))
            <div class="mt-2 p-3 bg-blue-50 text-blue-800 rounded-lg text-sm">
                Membuat pesanan untuk: <strong>{{ session('order_for_merchant')['name'] }}</strong>
            </div>
        @endif

        <p class="text-gray-500 mt-1">Periksa kembali pesanan Anda sebelum melanjutkan ke proses checkout.</p>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div class="bg-white rounded-xl shadow-md">
        <div class="p-6">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Produk</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Harga</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Kuantitas</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Subtotal</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @php $total = 0; $cart = session('cart', []); @endphp
                        @forelse ($cart as $id => $details)
                            @php $total += $details['price'] * $details['quantity'] @endphp
                            <tr>
                                <td class="px-6 py-4"><div class="flex items-center"><div class="flex-shrink-0 h-12 w-12"><img class="h-12 w-12 rounded-md object-cover" src="{{ $details['image_path'] ? asset('storage/' . $details['image_path']) : 'https://via.placeholder.com/150' }}" alt=""></div><div class="ml-4"><div class="text-sm font-medium text-gray-900">{{ $details['name'] }}</div></div></div></td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">Rp {{ number_format($details['price'], 0, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                    <form action="{{ route('sales.cart.update', $id) }}" method="POST">@csrf @method('PATCH')<input type="number" name="quantity" value="{{ $details['quantity'] }}" class="w-20 text-center border-gray-300 rounded-md" min="1" onchange="this.form.submit()"></form>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-gray-900">Rp {{ number_format($details['price'] * $details['quantity'], 0, ',', '.') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <form action="{{ route('sales.cart.remove', $id) }}" method="POST">@csrf @method('DELETE')<button type="submit" class="text-red-600 hover:text-red-900">Hapus</button></form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center py-16 text-gray-500"><p>Keranjang Anda masih kosong.</p><a href="{{ route('sales.catalog.index') }}" class="text-blue-600 hover:underline mt-2 inline-block">Mulai belanja</a></td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if(count($cart) > 0)
            <div class="p-6 bg-gray-50 border-t border-gray-200 flex justify-between items-center">
                <div>
                    <span class="text-lg font-bold text-gray-800">Total Pesanan:</span>
                    <span class="text-xl font-bold text-blue-800 ml-2">Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>
                <div class="flex items-center gap-4">
                    <a href="{{ route('sales.catalog.index') }}" class="text-gray-600 hover:text-gray-800">Lanjut Belanja</a>
                    <form action="{{ route('sales.checkout.store') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-6 rounded-lg">
                            Buat Pesanan &rarr;
                        </button>
                    </form>
                </div>
            </div>
        @endif
    </div>
</x-sales-layout>