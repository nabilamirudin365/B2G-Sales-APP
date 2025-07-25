<x-sales-layout>
    <div class="bg-white p-6 rounded-xl shadow-md mb-8">
        <h1 class="text-2xl font-bold text-blue-900">Formulir Akuisisi Merchant Baru</h1>
        <p class="text-gray-500 mt-1">Isi data calon merchant selengkap mungkin.</p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-md">
        <form method="POST" action="{{ route('sales.merchants.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="space-y-6">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Toko / Merchant</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700">Alamat Lengkap</label>
                    <textarea name="address" id="address" rows="3" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('address') }}</textarea>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="owner_name" class="block text-sm font-medium text-gray-700">Nama Pemilik</label>
                        <input type="text" name="owner_name" id="owner_name" value="{{ old('owner_name') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div>
                        <label for="owner_phone" class="block text-sm font-medium text-gray-700">No. Telepon Pemilik</label>
                        <input type="text" name="owner_phone" id="owner_phone" value="{{ old('owner_phone') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="photo_front" class="block text-sm font-medium text-gray-700">Foto Tampak Depan Toko (Wajib)</label>
                        <input type="file" name="photo_front" id="photo_front" required class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>
                    <div>
                        <label for="photo_inside" class="block text-sm font-medium text-gray-700">Foto Bagian Dalam Toko (Wajib)</label>
                        <input type="file" name="photo_inside" id="photo_inside" required class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>
                </div>

                <div>
                    <label for="estimated_sales" class="block text-sm font-medium text-gray-700">Estimasi Potensi Penjualan per Bulan (Rp)</label>
                    <input type="number" name="estimated_sales" id="estimated_sales" value="{{ old('estimated_sales') }}" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                </div>
                <div>
                    <label for="notes" class="block text-sm font-medium text-gray-700">Catatan Tambahan</label>
                    <textarea name="notes" id="notes" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">{{ old('notes') }}</textarea>
                </div>
            </div>

            <div class="mt-8 pt-5 border-t border-gray-200 flex justify-end gap-3">
                <a href="{{ route('sales.dashboard') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">Batal</a>
                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-700 hover:bg-blue-800">Ajukan Akuisisi</button>
            </div>
        </form>
    </div>
</x-sales-layout>