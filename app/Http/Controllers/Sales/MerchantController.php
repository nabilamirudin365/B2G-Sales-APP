<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\Merchant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MerchantController extends Controller
{

    public function index()
{
    $merchants = Merchant::where('user_id', Auth::id())
                         ->latest()
                         ->paginate(10);

    return view('sales.merchants.index', compact('merchants'));
}

public function show(Merchant $merchant)
{
    // Pastikan user hanya bisa melihat pengajuannya sendiri
    if ($merchant->user_id !== Auth::id()) {
        abort(403);
    }

    $photoPaths = json_decode($merchant->photo_paths, true);

    return view('sales.merchants.show', compact('merchant', 'photoPaths'));
}

    /**
     * Menampilkan form untuk mengajukan akuisisi merchant baru.
     */
    public function create()
    {
        return view('sales.merchants.create');
    }

    /**
     * Menyimpan data pengajuan akuisisi merchant baru.
     */
    public function store(Request $request)
    {
        // 1. Validasi semua input dari form
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'owner_name' => 'required|string|max:255',
            'owner_phone' => 'required|string|max:20',
            'photo_front' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'photo_inside' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'estimated_sales' => 'required|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        // 2. Proses upload kedua foto
        $photoPaths = [];
        if ($request->hasFile('photo_front')) {
            $photoPaths['front_view'] = $request->file('photo_front')->store('merchant-photos', 'public');
        }
        if ($request->hasFile('photo_inside')) {
            $photoPaths['inside_view'] = $request->file('photo_inside')->store('merchant-photos', 'public');
        }

        // 3. Simpan data ke database
        Merchant::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->owner_phone, // Menggunakan nomor pemilik sebagai nomor utama merchant
            'owner_name' => $request->owner_name,
            'owner_phone' => $request->owner_phone,
            'estimated_sales' => $request->estimated_sales,
            'notes' => $request->notes,
            'photo_paths' => json_encode($photoPaths), // Simpan path foto sebagai JSON
            'status' => 'pending', // Status awal selalu 'pending'
        ]);

        // 4. Redirect kembali ke dasbor dengan pesan sukses
        return redirect()->route('sales.dashboard')
                         ->with('success', 'Pengajuan akuisisi merchant berhasil dikirim dan menunggu persetujuan.');
    }
}