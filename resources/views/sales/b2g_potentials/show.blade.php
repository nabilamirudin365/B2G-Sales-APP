<x-sales-layout>
    <div class="bg-white p-6 rounded-xl shadow-md mb-8">
        <h1 class="text-2xl font-bold text-blue-900">{{ $b2gPotential->project_name }}</h1>
        <p class="text-gray-500 mt-1">Detail Potensi Proyek di <span class="font-semibold">{{ $b2gPotential->skpd_name }}</span></p>
    </div>

    <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="space-y-5">
                    <div>
                        <h3 class="text-xs font-medium text-gray-500 uppercase">Nama Instansi (SKPD)</h3>
                        <p class="text-lg text-gray-800">{{ $b2gPotential->skpd_name }}</p>
                    </div>
                    <div>
                        <h3 class="text-xs font-medium text-gray-500 uppercase">Perkiraan Nilai Proyek</h3>
                        <p class="text-lg text-gray-800 font-semibold">Rp {{ number_format($b2gPotential->estimated_value, 0, ',', '.') }}</p>
                    </div>
                    <div>
                        <h3 class="text-xs font-medium text-gray-500 uppercase">Sumber Informasi</h3>
                        <p class="text-lg text-gray-800">{{ $b2gPotential->source_of_info }}</p>
                    </div>
                </div>
                <div class="space-y-5">
                     <div>
                        <h3 class="text-xs font-medium text-gray-500 uppercase">Status Saat Ini</h3>
                        <p class="text-lg text-gray-800 font-semibold capitalize">{{ str_replace('-', ' ', $b2gPotential->status) }}</p>
                    </div>
                    <div>
                        <h3 class="text-xs font-medium text-gray-500 uppercase">Deskripsi / Catatan</h3>
                        <p class="text-base text-gray-700 whitespace-pre-wrap">{{ $b2gPotential->description ?: 'Tidak ada catatan tambahan.' }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="p-6 bg-gray-50 flex justify-between items-center mt-4 rounded-xl">
            <a href="{{ route('sales.b2g_potentials.index') }}" class="text-sm text-gray-600 hover:text-gray-900">&larr; Kembali ke Papan Kanban</a>
            <a href="{{ route('sales.b2g_potentials.edit', $b2gPotential) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-lg shadow-md">
                Edit / Ubah Status
            </a>
        </div>
    </div>
</x-sales-layout>