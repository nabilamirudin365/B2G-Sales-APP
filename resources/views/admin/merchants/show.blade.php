<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Detail Pengajuan Merchant') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h1 class="text-xl font-bold text-gray-800">Detail Pengajuan: {{ $merchant->name }}</h1>
                    <p class="mt-1 text-sm text-gray-600">Diajukan oleh: <span class="font-semibold">{{ $merchant->user->name }}</span> pada {{ $merchant->created_at->format('d F Y') }}</p>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <div class="lg:col-span-2 space-y-5">
                            <div>
                                <h3 class="text-xs font-medium text-gray-500 uppercase">Nama Pemilik & Kontak</h3>
                                <p class="text-base text-gray-800">{{ $merchant->owner_name }} ({{ $merchant->owner_phone }})</p>
                            </div>
                            <div>
                                <h3 class="text-xs font-medium text-gray-500 uppercase">Alamat Lengkap</h3>
                                <p class="text-base text-gray-800">{{ $merchant->address }}</p>
                            </div>
                            <div>
                                <h3 class="text-xs font-medium text-gray-500 uppercase">Estimasi Penjualan / Bulan</h3>
                                <p class="text-base text-gray-800">Rp {{ number_format($merchant->estimated_sales, 0, ',', '.') }}</p>
                            </div>
                            <div>
                                <h3 class="text-xs font-medium text-gray-500 uppercase">Catatan dari Sales</h3>
                                <p class="text-base text-gray-700 whitespace-pre-wrap">{{ $merchant->notes ?: '-' }}</p>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <h3 class="text-xs font-medium text-gray-500 uppercase mb-2">Foto Tampak Depan</h3>
                                @if(isset($photoPaths['front_view']))
                                    <img src="{{ asset('storage/' . $photoPaths['front_view']) }}" alt="Foto tampak depan" class="rounded-lg shadow-md w-full">
                                @else
                                    <p class="text-sm text-gray-500">Tidak ada foto.</p>
                                @endif
                            </div>
                            <div>
                                <h3 class="text-xs font-medium text-gray-500 uppercase mb-2">Foto Bagian Dalam</h3>
                                 @if(isset($photoPaths['inside_view']))
                                    <img src="{{ asset('storage/' . $photoPaths['inside_view']) }}" alt="Foto bagian dalam" class="rounded-lg shadow-md w-full">
                                @else
                                    <p class="text-sm text-gray-500">Tidak ada foto.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-6 bg-gray-50 flex justify-between items-center">
                    <a href="{{ route('admin.merchants.approvals.index') }}" class="text-sm text-gray-600 hover:text-gray-900">&larr; Kembali ke Daftar</a>
                    <div class="flex items-center gap-3">
                         <form method="POST" action="{{ route('admin.merchants.approvals.update', $merchant->id) }}">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="rejected">
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg shadow-md">Tolak</button>
                        </form>
                         <form method="POST" action="{{ route('admin.merchants.approvals.update', $merchant->id) }}">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="approved">
                            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg shadow-md">Setujui</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>