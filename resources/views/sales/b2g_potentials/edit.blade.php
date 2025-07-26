<x-sales-layout>
    <div class="bg-white p-6 rounded-xl shadow-md mb-8">
        <h1 class="text-2xl font-bold text-blue-900">Edit Potensi Pengadaan</h1>
        <p class="text-gray-500 mt-1">{{ $b2gPotential->project_name }}</p>
    </div>

    <div class="bg-white rounded-xl shadow-md">
        <form id="updateForm" method="POST" action="{{ route('sales.b2g_potentials.update', $b2gPotential) }}">
            @csrf
            @method('PUT')
            
            <div class="p-6">
                <div class="space-y-6">
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">Ubah Status Proyek</label>
                        <select name="status" id="status" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @foreach ($statuses as $status)
                                <option value="{{ $status }}" @selected(old('status', $b2gPotential->status) == $status)>
                                    {{ ucwords(str_replace('-', ' ', $status)) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="project_name" class="block text-sm font-medium text-gray-700">Nama Proyek</label>
                        <input type="text" name="project_name" id="project_name" value="{{ old('project_name', $b2gPotential->project_name) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>
                    <div>
                        <label for="skpd_name" class="block text-sm font-medium text-gray-700">Nama Instansi (SKPD)</label>
                        <input type="text" name="skpd_name" id="skpd_name" value="{{ old('skpd_name', $b2gPotential->skpd_name) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="estimated_value" class="block text-sm font-medium text-gray-700">Perkiraan Nilai Proyek (Rp)</label>
                            <input type="number" name="estimated_value" id="estimated_value" value="{{ old('estimated_value', $b2gPotential->estimated_value) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        <div>
                            <label for="source_of_info" class="block text-sm font-medium text-gray-700">Sumber Informasi</label>
                            <input type="text" name="source_of_info" id="source_of_info" value="{{ old('source_of_info', $b2gPotential->source_of_info) }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                    </div>
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi / Catatan Tambahan</label>
                        <textarea name="description" id="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('description', $b2gPotential->description) }}</textarea>
                    </div>

                </div>
            </div>
        </form> 

        <div class="pt-5 p-6 bg-gray-50 border-t border-gray-200 flex justify-between items-center">
            <form method="POST" action="{{ route('sales.b2g_potentials.destroy', $b2gPotential) }}" onsubmit="return confirm('Anda yakin ingin menghapus data ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600 hover:text-red-800 text-sm font-medium">Hapus Potensi</button>
            </form>
            
            <div class="flex gap-3">
                <a href="{{ route('sales.b2g_potentials.index') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">Batal</a>
                <button type="submit" form="updateForm" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-700 hover:bg-blue-800">
                    Update Potensi
                </button>
            </div>
        </div>
    </div>
</x-sales-layout>