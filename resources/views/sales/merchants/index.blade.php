<x-sales-layout>
    <div class="flex justify-between items-center bg-white p-6 rounded-xl shadow-md mb-8">
        <div>
            <h1 class="text-2xl font-bold text-blue-900">Riwayat Akuisisi Merchant</h1>
            <p class="text-gray-500 mt-1">Daftar semua merchant yang pernah Anda ajukan.</p>
        </div>
        <a href="{{ route('sales.merchants.create') }}" class="bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded-lg shadow-md">
            + Ajukan Merchant Baru
        </a>
    </div>

    <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Merchant</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal Pengajuan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase"></th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($merchants as $merchant)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $merchant->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $merchant->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @if($merchant->status == 'approved') bg-green-100 text-green-800 @endif
                                    @if($merchant->status == 'rejected') bg-red-100 text-red-800 @endif
                                    @if($merchant->status == 'pending') bg-yellow-100 text-yellow-800 @endif">
                                    {{ ucfirst($merchant->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('sales.merchants.show', $merchant->id) }}" class="text-indigo-600 hover:text-indigo-900 font-bold">Lihat Detail</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-gray-500 py-10">Anda belum pernah mengajukan merchant.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
             @if ($merchants->hasPages())
                <div class="p-4 border-t border-gray-200">
                    {{ $merchants->links() }}
                </div>
            @endif
        </div>
    </div>
</x-sales-layout>