<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Merchant;
use Illuminate\Http\Request;

class MerchantApprovalController extends Controller
{
    /**
     * Menampilkan daftar semua merchant yang menunggu persetujuan.
     */
    // app/Http/Controllers/Admin/MerchantApprovalController.php

public function index(Request $request)
{
    // Ambil status dari query URL, defaultnya 'pending' jika tidak ada
    $status = $request->query('status', 'pending');

    // Query dasar untuk mengambil data merchant
    $query = Merchant::with('user')->latest();

    // Terapkan filter berdasarkan status jika statusnya valid
    if (in_array($status, ['pending', 'approved', 'rejected'])) {
        $query->where('status', $status);
    }

    // Ambil data dengan paginasi
    $merchants = $query->paginate(10)->withQueryString();

    // Kirim data ke view
    return view('admin.merchants.approvals', compact('merchants', 'status'));
}

    /**
     * Mengupdate status merchant (approved/rejected).
     */
    public function update(Request $request, Merchant $merchant)
{
    // Validasi input status dan catatan
    $request->validate([
        'status' => 'required|in:approved,rejected',
        'approval_notes' => 'nullable|string|max:1000', // Catatan bersifat opsional
    ]);

    // Update status dan tambahkan catatan persetujuan/penolakan
    $merchant->status = $request->status;
    $merchant->approval_notes = $request->approval_notes;
    $merchant->save();

    return redirect()->route('admin.merchants.approvals.index')
                     ->with('success', 'Status merchant berhasil diperbarui.');
}

    public function show(Merchant $merchant)
{
    // Ambil path foto dan decode dari JSON
    $photoPaths = json_decode($merchant->photo_paths, true);

    return view('admin.merchants.show', compact('merchant', 'photoPaths'));
}
}