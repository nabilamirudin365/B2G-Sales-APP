<x-sales-layout>
    <div class="bg-white p-6 rounded-xl shadow-md mb-8">
        <h1 class="text-2xl font-bold text-blue-900">Formulir Potensi Pengadaan Baru</h1>
        <p class="text-gray-500 mt-1">Isi detail awal mengenai potensi proyek.</p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-md">
        <form method="POST" action="{{ route('sales.b2g_potentials.store') }}">
            @csrf
            <div class="space-y-6">
                <div>
                    <label for="project_name" class="block text-sm font-medium text-gray-700">Nama Proyek</label>
                    <input type="text" name="project_name" id="project_name" value="{{ old('project_name') }}" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                           placeholder="Contoh: Pengadaan Buku BOS Afirmasi 2026">
                </div>
                <div>
                    <label for="skpd_name" class="block text-sm font-medium text-gray-700">Nama Instansi (SKPD)</label>
                    <input type="text" name="skpd_name" id="skpd_name" value="{{ old('skpd_name') }}" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                           placeholder="Contoh: Dinas Pendidikan Kota X">
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="estimated_value" class="block text-sm font-medium text-gray-700">Perkiraan Nilai Proyek (Rp)</label>
                        <input type="number" name="estimated_value" id="estimated_value" value="{{ old('estimated_value') }}" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="source_of_info" class="block text-sm font-medium text-gray-700">Sumber Informasi</label>
                        <input type="text" name="source_of_info" id="source_of_info" value="{{ old('source_of_info') }}" required
                               class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                               placeholder="Contoh: Website LPSE, Info internal">
                    </div>
                </div>
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi / Catatan Tambahan</label>
                    <textarea name="description" id="description" rows="4"
                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('description') }}</textarea>
                </div>
            </div>

            <div class="mt-8 pt-5 border-t border-gray-200 flex justify-end gap-3">
                <a href="{{ route('sales.b2g_potentials.index') }}"
                   class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">
                    Batal
                </a>
                <button type="submit"
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-700 hover:bg-blue-800">
                    Simpan Potensi
                </button>
            </div>
        </form>
    </div>
</x-sales-layout>