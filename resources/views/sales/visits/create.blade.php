<x-sales-layout>
    <div class="bg-white p-6 rounded-xl shadow-md mb-8">
        <h1 class="text-2xl font-bold text-blue-900">Buat Laporan Kunjungan Baru</h1>
        <p class="text-gray-500 mt-1">Catat semua aktivitas kunjungan Anda di sini.</p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-md">
        <form method="POST" action="{{ route('sales.visits.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="space-y-6">
                <div>
                    <label for="partner_name" class="block text-sm font-medium text-gray-700">
                        Nama Partner / Instansi yang Dikunjungi
                    </label>
                    <input type="text" name="partner_name" id="partner_name" value="{{ old('partner_name') }}" required
                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                </div>

                <div>
                    <label for="notes" class="block text-sm font-medium text-gray-700">
                        Catatan / Hasil Kunjungan
                    </label>
                    <textarea name="notes" id="notes" rows="5" required
                              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('notes') }}</textarea>
                </div>

                <div>
                    <label for="photo" class="block text-sm font-medium text-gray-700">
                        Foto Bukti Kunjungan (Opsional)
                    </label>
                    <input type="file" name="photo" id="photo"
                           class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                </div>
            </div>

            <div class="mt-8 pt-5 border-t border-gray-200 flex justify-end gap-3">
                <a href="{{ route('sales.dashboard') }}"
                   class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">
                    Batal
                </a>
                <button type="submit"
                        class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-700 hover:bg-blue-800">
                    Simpan Laporan
                </button>
            </div>
        </form>
    </div>
</x-sales-layout>