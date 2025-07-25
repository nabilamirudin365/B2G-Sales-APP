<x-guest-layout>
    <div class="min-h-screen flex flex-col justify-center items-center bg-gradient-to-br from-teal-100 to-white px-4">
        <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-lg">
            <div class="text-center mb-6">
                <img src="{{ asset('images/LOGOTS2.jpeg') }}" alt="Logo TISERA" class="h-24 mx-auto mb-6 rounded-md">
                <h1 class="text-3xl font-bold text-gray-800">Daftar</h1>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                    <input id="name" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500"
                        type="text" name="name" required autofocus />
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="email" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500"
                        type="email" name="email" required />
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="password" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500"
                        type="password" name="password" required autocomplete="new-password" />
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Password</label>
                    <input id="password_confirmation" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-teal-500 focus:border-teal-500"
                        type="password" name="password_confirmation" required />
                </div>

                <div>
                    <button type="submit"
                        class="w-full bg-teal-700 hover:bg-teal-800 text-white font-semibold py-2 px-4 rounded-lg transition duration-300">
                        Daftar
                    </button>
                </div>
            </form>

            <div class="text-center mt-6 text-sm text-gray-600">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-teal-700 hover:underline">Login di sini</a>
            </div>
        </div>
    </div>
</x-guest-layout>
