<x-admin-layout>
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Laporan Potensi SKPD</h1>
    </div>

    @if (session('success'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
            <p>{{ session('success') }}</p>
        </div>
    @endif

    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nama Proyek</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Diajukan Oleh</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Estimasi Nilai</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($potentials as $potential)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-900">{{ $potential->project_name }}</div>
                                <div class="text-sm text-gray-500">{{ $potential->skpd_name }}</div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-800">{{ $potential->user->name }}</td>
                            <td class="px-6 py-4 text-sm font-semibold text-gray-800">Rp {{ number_format($potential->estimated_value, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $potential->status == 'menang' ? 'bg-green-100 text-green-800' : '' }}
                                    {{ $potential->status == 'kalah' ? 'bg-red-100 text-red-800' : '' }}
                                    {{ in_array($potential->status, ['pendekatan-awal', 'proposal-diajukan', 'negosiasi-tender']) ? 'bg-yellow-100 text-yellow-800' : '' }}
                                    {{ $potential->status == 'potensi-baru' ? 'bg-gray-100 text-gray-800' : '' }}">
                                    {{ ucwords(str_replace('-', ' ', $potential->status)) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('admin.b2g_potentials.show', $potential->id) }}" class="text-indigo-600 hover:text-indigo-900 font-bold">Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center py-10 text-gray-500">Belum ada data potensi SKPD.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
         @if ($potentials->hasPages())
            <div class="p-4 bg-white border-t border-gray-200">
                {{ $potentials->links() }}
            </div>
        @endif
    </div>
</x-admin-layout>