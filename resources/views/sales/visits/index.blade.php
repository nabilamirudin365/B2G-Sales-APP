<x-sales-layout>
    <div class="flex justify-between items-center bg-white p-6 rounded-xl shadow-md mb-8">
        <div>
            <h1 class="text-2xl font-bold text-blue-900">Riwayat Laporan Kunjungan</h1>
            <p class="text-gray-500 mt-1">Semua laporan yang pernah Anda buat.</p>
        </div>
        <a href="{{ route('sales.visits.create') }}" class="bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded-lg shadow-md">
            + Buat Laporan Baru
        </a>
    </div>

    <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Partner Dikunjungi</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Laporan</th>
                            <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($visits as $visit)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">{{ $visit->partner_name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $visit->created_at->format('d M Y, H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('sales.visits.show', $visit->id) }}" class="text-indigo-600 hover:text-indigo-900 font-bold">Detail</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center text-gray-500 py-10">
                                Anda belum memiliki laporan kunjungan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($visits->hasPages())
                <div class="p-4 border-t border-gray-200">
                    {{ $visits->links() }}
                </div>
            @endif
        </div>
    </div>
</x-sales-layout>