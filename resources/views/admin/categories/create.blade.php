<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Kategori Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 rounded-lg shadow-xl">
                <form action="{{ route('admin.categories.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nama Kategori</label>
                        <input type="text" name="name" id="name" class="shadow-sm appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-teal-500" value="{{ old('name') }}" required>
                        @error('name') <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p> @enderror
                    </div>
                    <div class="flex items-center justify-end">
                        <a href="{{ route('admin.categories.index') }}" class="text-gray-600 hover:text-gray-800 mr-4">Batal</a>
                        <button type="submit" class="bg-teal-700 hover:bg-teal-800 text-white font-bold py-2 px-4 rounded">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>