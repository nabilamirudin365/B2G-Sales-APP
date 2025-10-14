<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Pengguna') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                 <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-xl font-bold text-gray-800">Edit Akun Pengguna</h1>
                    <p class="mt-1 text-sm text-gray-600">Perbarui detail untuk akun <span class="font-semibold">{{ $user->name }}</span>.</p>
                </div>

                <div class="p-6">
                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-5" role="alert">
                            <strong class="font-bold">Oops!</strong>
                            <ul class="mt-2 list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.users.update', $user->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                                <input id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500" type="text" name="name" value="{{ old('name', $user->name) }}" required autofocus />
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Alamat Email</label>
                                <input id="email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500" type="email" name="email" value="{{ old('email', $user->email) }}" required />
                            </div>
                            <div>
                                <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                                <select name="role" id="role" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500">
                                    <option value="tim_merchant" @selected(old('role', $user->role) == 'tim_merchant')>Tim Merchant</option>
                                    <option value="tim_b2g" @selected(old('role', $user->role) == 'tim_b2g')>Tim B2G</option>
                                    <option value="tim_gudang" @selected(old('role', $user->role) == 'tim_gudang')>Tim Gudang</option>
                                    <option value="admin" @selected(old('role', $user->role) == 'admin')>Admin</option>
                                </select>
                            </div>
                            <div></div> <div>
                                <label for="password" class="block text-sm font-medium text-gray-700">Password Baru</label>
                                <input id="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-teal-500 focus:ring-teal-500" type="password" name="password" />
                                <p class="mt-1 text-xs text-gray-500">Kosongkan jika tidak ingin mengubah password.</p>
                            </div>
                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password Baru</label>
                                <input id="password_confirmation" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" type="password" name="password_confirmation" />
                            </div>
                        </div>

                        <div class="mt-6 pt-6 border-t border-gray-200 flex items-center justify-end gap-4">
                            <a href="{{ route('admin.users.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Batal</a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-teal-700 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-teal-800 focus:bg-teal-800 active:bg-teal-900 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Update Pengguna
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>