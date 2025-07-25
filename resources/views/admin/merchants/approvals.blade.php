<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Riwayat Akuisisi Merchant') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-xl font-semibold text-gray-800">Daftar Pengajuan Merchant</h3>
                        </div>
                        </div>
                </div>

                <div class="px-6 border-b border-gray-200">
                    <nav class="-mb-px flex space-x-6" aria-label="Tabs">
                        <a href="{{ route('admin.merchants.approvals.index', ['status' => 'pending']) }}"
                           class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm {{ $status == 'pending' ? 'border-teal-500 text-teal-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                            Menunggu Persetujuan
                        </a>
                        <a href="{{ route('admin.merchants.approvals.index', ['status' => 'approved']) }}"
                           class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm {{ $status == 'approved' ? 'border-teal-500 text-teal-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                            Disetujui
                        </a>
                        <a href="{{ route('admin.merchants.approvals.index', ['status' => 'rejected']) }}"
                           class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm {{ $status == 'rejected' ? 'border-teal-500 text-teal-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                            Ditolak
                        </a>
                    </nav>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Merchant</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Diajukan Oleh</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($merchants as $merchant)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $merchant->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $merchant->address }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $merchant->user->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $merchant->created_at->format('d M Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        @if($merchant->status == 'approved') bg-green-100 text-green-800 @endif
                                        @if($merchant->status == 'rejected') bg-red-100 text-red-800 @endif
                                        @if($merchant->status == 'pending') bg-yellow-100 text-yellow-800 @endif">
                                        {{ ucfirst($merchant->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('admin.merchants.approvals.show', $merchant->id) }}" class="inline-flex items-center px-3 py-1.5 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-gray-500 py-10">
                                    Tidak ada data untuk status ini.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($merchants->hasPages())
                    <div class="p-4 bg-white border-t border-gray-200">
                        {{ $merchants->links() }}
                    </div>
                @endif
            </div>
        <div class="flex justify-between items-center mb-6">
                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                    &larr; Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>
</x-app-layout>

