<x-sales-layout>
    <div class="bg-white p-6 rounded-xl shadow-md mb-8">
        <h1 class="text-2xl font-bold text-blue-900">Detail Laporan Kunjungan</h1>
        <p class="text-gray-500 mt-1">Laporan untuk kunjungan ke: <span class="font-semibold">{{ $visit->partner_name }}</span></p>
    </div>

    <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
        <div class="p-6 bg-white border-b border-gray-200">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="md:col-span-2 space-y-4">
                    <div>
                        <h3 class="text-xs font-medium text-gray-500 uppercase">Partner Dikunjungi</h3>
                        <p class="text-lg text-gray-800">{{ $visit->partner_name }}</p>
                    </div>
                    <div>
                        <h3 class="text-xs font-medium text-gray-500 uppercase">Tanggal Laporan</h3>
                        <p class="text-lg text-gray-800">{{ $visit->created_at->format('d F Y, H:i') }}</p>
                    </div>
                    <div>
                        <h3 class="text-xs font-medium text-gray-500 uppercase">Catatan / Hasil Kunjungan</h3>
                        <p class="text-base text-gray-700 whitespace-pre-wrap">{{ $visit->notes }}</p>
                    </div>
                </div>

                <div>
                    <h3 class="text-xs font-medium text-gray-500 uppercase mb-2">Foto Bukti</h3>
                    @if ($visit->photo_path)
                        <img src="{{ asset('storage/' . $visit->photo_path) }}" alt="Foto bukti kunjungan" class="rounded-lg shadow-lg w-full">
                    @else
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center">
                            <p class="text-sm text-gray-500">Tidak ada foto dilampirkan.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="p-6 bg-gray-50 flex justify-end gap-3">
            <a href="{{ route('sales.visits.index') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">
                Kembali ke Daftar
            </a>
            <a href="{{ route('sales.visits.edit', $visit->id) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-lg shadow-md">
                Edit Laporan
            </a>
            <form method="POST" action="{{ route('sales.visits.destroy', $visit->id) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus laporan ini secara permanen?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg shadow-md">
                Hapus
            </button>
            </form>
        </div>
    </div>
</x-sales-layout>