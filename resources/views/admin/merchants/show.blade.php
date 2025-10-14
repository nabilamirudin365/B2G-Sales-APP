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
                    @if($merchant->status != 'pending')
                    <div class="p-4 rounded-lg mb-6 border
                        @if($merchant->status == 'approved') bg-green-50 border-green-300 @endif
                        @if($merchant->status == 'rejected') bg-red-50 border-red-300 @endif">
                        <h3 class="font-bold text-lg 
                            @if($merchant->status == 'approved') text-green-800 @endif
                            @if($merchant->status == 'rejected') text-red-800 @endif">
                            Status: {{ ucfirst($merchant->status) }}
                        </h3>
                        @if($merchant->approval_notes)
                            <p class="mt-2 text-sm text-gray-700"><strong>Catatan Anda:</strong> {{ $merchant->approval_notes }}</p>
                        @endif
                    </div>
                    @endif
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

                @if ($merchant->status == 'pending')
                <div 
                    x-data="{ 
                        showModal: false, 
                        action: '', 
                        status: '', 
                        merchantName: '{{ $merchant->name }}' 
                    }"
                    class="p-6 bg-gray-50 flex justify-between items-center"
                >
                    <a href="{{ route('admin.merchants.approvals.index') }}" class="text-sm text-gray-600 hover:text-gray-900">&larr; Kembali ke Daftar</a>
                    
                    <div class="flex items-center gap-3">
                        <button @click="showModal = true; status = 'rejected'; action = '{{ route('admin.merchants.approvals.update', $merchant->id) }}'" type="button" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg shadow-md">Tolak</button>
                        <button @click="showModal = true; status = 'approved'; action = '{{ route('admin.merchants.approvals.update', $merchant->id) }}'" type="button" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg shadow-md">Setujui</button>
                    </div>

                    <div x-show="showModal" @keydown.escape.window="showModal = false" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" style="display: none;">
                        <div @click.away="showModal = false" class="bg-white rounded-lg shadow-xl p-6 w-full max-w-md">
                            <h3 class="text-lg font-bold" x-text="status === 'approved' ? 'Konfirmasi Persetujuan' : 'Konfirmasi Penolakan'"></h3>
                            <p class="mt-2 text-sm text-gray-600">Anda akan mengubah status untuk merchant <strong x-text="merchantName"></strong>.</p>
                            
                            <form :action="action" method="POST" class="mt-4">
                                @csrf
                                @method('PATCH')
                                <input type="hidden" name="status" :value="status">
                                
                                <div>
                                    <label for="approval_notes" class="block text-sm font-medium text-gray-700" x-text="status === 'rejected' ? 'Alasan Penolakan (Wajib)' : 'Catatan Tambahan (Opsional)'"></label>
                                    <textarea name="approval_notes" id="approval_notes" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"
                                        :placeholder="status === 'rejected' ? 'Contoh: Foto tidak jelas, data tidak valid.' : 'Contoh: Semua data valid, siap diaktifkan.'"></textarea>
                                </div>
                
                                <div class="mt-6 flex justify-end gap-3">
                                    <button type="button" @click="showModal = false" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50">Batal</button>
                                    <button type="submit" class="text-white font-medium py-2 px-4 rounded-md shadow-sm" :class="status === 'approved' ? 'bg-green-600 hover:bg-green-700' : 'bg-red-600 hover:bg-red-700'">Konfirmasi</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @else
                <div class="p-6 bg-gray-50 flex justify-end items-center">
                     <a href="{{ route('admin.merchants.approvals.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Kembali ke Daftar</a>
                </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>