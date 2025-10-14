<x-warehouse-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-xl shadow-md mb-8">
                <h1 class="text-2xl font-bold text-gray-800">Manajemen Pesanan Masuk</h1>
                <p class="text-gray-500 mt-1">Kelola dan filter semua pesanan dari tim sales.</p>
            </div>

            <!-- Panel Filter -->
            <div class="bg-white p-6 rounded-xl shadow-lg mb-8">
                <form method="GET" action="{{ route('warehouse.orders.index') }}" class="flex flex-col md:flex-row md:items-end gap-4">
                    <!-- Filter Nama Sales -->
                    <div>
                        <label for="user_id" class="block text-sm font-medium text-gray-700">Filter Berdasarkan Sales</label>
                        <select name="user_id" id="user_id" class="mt-1 block w-full md:w-56 rounded-md border-gray-300 shadow-sm">
                            <option value="">Semua Sales</option>
                            @foreach ($salesTeam as $sales)
                                <option value="{{ $sales->id }}" @selected($selectedUserId == $sales->id)>
                                    {{ $sales->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Filter Bulan -->
                    <div>
                        <label for="month" class="block text-sm font-medium text-gray-700">Bulan</label>
                        <select name="month" id="month" class="mt-1 block w-full md:w-48 rounded-md border-gray-300 shadow-sm">
                            @foreach (range(1, 12) as $month)
                                <option value="{{ $month }}" @selected($selectedMonth == $month)>
                                    {{ Carbon\Carbon::create()->month($month)->format('F') }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Filter Tahun -->
                    <div>
                        <label for="year" class="block text-sm font-medium text-gray-700">Tahun</label>
                        <select name="year" id="year" class="mt-1 block w-full md:w-40 rounded-md border-gray-300 shadow-sm">
                            @foreach (range(date('Y'), date('Y') - 5) as $year)
                                <option value="{{ $year }}" @selected($selectedYear == $year)>{{ $year }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Tombol Aksi Filter -->
                    <div class="flex items-center gap-2">
                        <button type="submit" class="w-full md:w-auto bg-teal-700 text-white font-bold py-2 px-6 rounded-lg hover:bg-teal-800">
                            Terapkan
                        </button>
                        <a href="{{ route('warehouse.orders.index') }}" class="py-2 px-4 text-sm text-gray-600 hover:text-gray-900">Reset</a>
                    </div>
                </form>
            </div>

            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="overflow-x-auto">
                    <!-- ... Kode tabel Anda yang sudah ada ... -->
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nomor Pesanan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Sales</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Toko Tujuan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($orders as $order)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $order->order_number }}</td>
                                <td class="px-6 py-4 text-sm text-gray-500">{{ $order->user->name }}</td>
                                <td class="px-6 py-4 text-sm font-semibold text-gray-700">{{ $order->merchant->name ?? 'N/A' }}</td>
                                <td class="px-6 py-4 text-sm font-bold text-gray-800">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        {{ $order->status == 'completed' ? 'bg-green-100 text-green-800' : '' }}
                                        {{ $order->status == 'shipped' ? 'bg-blue-100 text-blue-800' : '' }}
                                        {{ $order->status == 'processing' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                        {{ $order->status == 'pending' ? 'bg-gray-100 text-gray-800' : '' }}
                                        {{ $order->status == 'cancelled' ? 'bg-red-100 text-red-800' : '' }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right text-sm font-medium">
                                    <a href="{{ route('warehouse.orders.show', $order) }}" class="text-indigo-600 hover:text-indigo-900 font-bold">Kelola Status</a>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="6" class="text-center py-10 text-gray-500">Tidak ada pesanan untuk filter ini.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if ($orders->hasPages())
                    <div class="p-4 border-t">{{ $orders->links() }}</div>
                @endif
            </div>
        </div>
    </div>
</x-warehouse-layout>