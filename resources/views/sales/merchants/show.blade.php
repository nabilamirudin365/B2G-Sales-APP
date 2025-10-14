<x-sales-layout>
    <div class="bg-white p-6 rounded-xl shadow-md mb-8">
        <h1 class="text-2xl font-bold text-blue-900">Detail Pengajuan Merchant</h1>
        <p class="text-gray-500 mt-1">{{ $merchant->name }}</p>
    </div>

    <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
        <div class="p-6">
            <div class="p-4 rounded-lg mb-6 border
                @if($merchant->status == 'approved') bg-green-50 border-green-300 @endif
                @if($merchant->status == 'rejected') bg-red-50 border-red-300 @endif
                @if($merchant->status == 'pending') bg-yellow-50 border-yellow-300 @endif">
                <h3 class="font-bold text-lg 
                    @if($merchant->status == 'approved') text-green-800 @endif
                    @if($merchant->status == 'rejected') text-red-800 @endif
                    @if($merchant->status == 'pending') text-yellow-800 @endif">
                    Status: {{ ucfirst($merchant->status) }}
                </h3>
                @if($merchant->approval_notes)
                    <p class="mt-2 text-sm text-gray-700"><strong>Catatan dari Admin:</strong> {{ $merchant->approval_notes }}</p>
                @endif
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 border-t pt-6">
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
                        <h3 class="text-xs font-medium text-gray-500 uppercase">Catatan Tambahan</h3>
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
        <div class="p-6 bg-gray-50 text-right">
            <a href="{{ route('sales.merchants.index') }}" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">
                &larr; Kembali ke Riwayat
            </a>
        </div>
    </div>
</x-sales-layout>