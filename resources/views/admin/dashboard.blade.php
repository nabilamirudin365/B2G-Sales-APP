<x-admin-layout>
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Dashboard Admin</h1>
        <p class="text-gray-500 mt-1">Selamat datang kembali, {{ Auth::user()->name }}!</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-xl shadow-lg transition-transform hover:scale-105">
            <div class="flex items-start justify-between">
                <div>
                    <h2 class="text-sm font-medium text-gray-500">Total Pengguna Aktif</h2>
                    <div class="text-3xl font-bold text-teal-700 mt-2">{{ $totalUsers }}</div>
                </div>
                <div class="bg-teal-100 text-teal-600 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.653-.122-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.653.122-1.283.356-1.857m0 0a3.002 3.002 0 013.435 2.143M3 11a3 3 0 116 0 3 3 0 01-6 0zm12 0a3 3 0 116 0 3 3 0 01-6 0z" /></svg>
                </div>
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-lg transition-transform hover:scale-105">
            <div class="flex items-start justify-between">
                <div>
                    <h2 class="text-sm font-medium text-gray-500">Total Pesanan Masuk</h2>
                    <div class="text-3xl font-bold text-green-700 mt-2">{{ $totalOrders }}</div>
                </div>
                <div class="bg-green-100 text-green-600 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                </div>
            </div>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-lg transition-transform hover:scale-105">
            <div class="flex items-start justify-between">
                <div>
                    <h2 class="text-sm font-medium text-gray-500">Total Merchant Disetujui</h2>
                    <div class="text-3xl font-bold text-blue-700 mt-2">{{ $totalMerchants }}</div>
                </div>
                <div class="bg-blue-100 text-blue-600 p-3 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Pengguna Baru</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="text-gray-600">
                        <tr><th class="py-2 text-left">Nama</th><th class="py-2 text-left">Role</th><th class="py-2 text-left">Tanggal</th></tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($recentUsers as $user)
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 font-medium">{{ $user->name }}</td>
                                <td class="py-3 capitalize">{{ str_replace('_', ' ', $user->role) }}</td>
                                <td class="py-3 text-gray-500">{{ $user->created_at->format('d M Y') }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="text-center py-4">Tidak ada pengguna baru.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-lg p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Pesanan Terbaru</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead class="text-gray-600">
                        <tr><th class="py-2 text-left">No. Pesanan</th><th class="py-2 text-left">Sales</th><th class="py-2 text-left">Total</th></tr>
                    </thead>
                     <tbody class="divide-y divide-gray-200">
                        @forelse ($recentOrders as $order)
                            <tr class="hover:bg-gray-50">
                                <td class="py-3 font-medium text-indigo-600 hover:underline"><a href="{{ route('admin.orders.show', $order) }}">{{ $order->order_number }}</a></td>
                                <td class="py-3">{{ $order->user->name }}</td>
                                <td class="py-3 text-gray-800 font-semibold">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="3" class="text-center py-4">Tidak ada pesanan baru.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin-layout>