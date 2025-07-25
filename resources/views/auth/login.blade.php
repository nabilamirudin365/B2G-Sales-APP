<x-guest-layout>
    <div class="min-h-screen flex flex-col justify-center items-center bg-gradient-to-b from-teal-100 to-white px-4">
        <div class="w-full max-w-md bg-white p-8 rounded-2xl shadow-lg">
            <div class="text-center mb-6">
                <img src="{{ asset('images/LOGOTS2.jpeg') }}" alt="Logo TISERA" class="h-24 mx-auto mb-6 rounded-md">
                <h1 class="text-3xl font-bold text-gray-800">Login</h1>
            </div>

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="email" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" type="email" name="email" required autofocus />
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="password" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" type="password" name="password" required autocomplete="current-password" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between">
                    <label class="flex items-center text-sm text-gray-600">
                        <input type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                        <span class="ml-2">Ingat saya</span>
                    </label>
                </div>

                <div>
                    <button type="submit"
                        class="w-full bg-teal-700 hover:bg-teal-800 text-white font-semibold py-2 px-4 rounded-lg transition duration-300">
                        Login
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
