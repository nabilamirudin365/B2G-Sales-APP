<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Visit;
use Illuminate\Support\Facades\Storage;

class VisitController extends Controller
{
    /**
     * Menampilkan form untuk membuat laporan visit baru.
     */
    public function index()
    {
        $visits = Visit::where('user_id', Auth::id())
                       ->latest() // Urutkan dari yang terbaru
                       ->paginate(10); // Batasi 10 item per halaman

        return view('sales.visits.index', compact('visits'));
    }

    public function show(Visit $visit)
{
    // Pastikan user hanya bisa melihat laporannya sendiri
    if ($visit->user_id !== Auth::id()) {
        abort(403); // Tampilkan error 'Forbidden' jika mencoba akses laporan orang lain
    }

    return view('sales.visits.show', compact('visit'));
}


public function edit(Visit $visit)
{
    // Pastikan user hanya bisa mengedit laporannya sendiri
    if ($visit->user_id !== Auth::id()) {
        abort(403);
    }

    return view('sales.visits.edit', compact('visit'));
}

public function update(Request $request, Visit $visit)
{
    // Pastikan user hanya bisa mengupdate laporannya sendiri
    if ($visit->user_id !== Auth::id()) {
        abort(403);
    }

    // Validasi input
    $request->validate([
        'partner_name' => 'required|string|max:255',
        'notes' => 'required|string',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // Update data teks
    $visit->partner_name = $request->partner_name;
    $visit->notes = $request->notes;

    // Proses dan update foto jika ada yang baru diupload
    if ($request->hasFile('photo')) {
        // Hapus foto lama jika ada, untuk menghemat space
        if ($visit->photo_path) {
            Storage::disk('public')->delete($visit->photo_path);
        }
        $visit->photo_path = $request->file('photo')->store('visit-photos', 'public');
    }

    $visit->save();

    return redirect()->route('sales.visits.show', $visit->id)
                     ->with('success', 'Laporan kunjungan berhasil diperbarui.');
}

    public function create()
    {
        return view('sales.visits.create');
    }

    /**
     * Menyimpan laporan visit baru ke database.
     */
    public function store(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'partner_name' => 'required|string|max:255',
            'notes' => 'required|string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Opsional, maks 2MB
        ]);

        $photoPath = null;

        // 2. Proses upload foto jika ada
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('visit-photos', 'public');
        }

        // 3. Simpan data ke database
        Visit::create([
            'user_id' => Auth::id(),
            'partner_name' => $request->partner_name,
            'notes' => $request->notes,
            'photo_path' => $photoPath,
        ]);

        // 4. Redirect kembali ke dasbor dengan pesan sukses
        return redirect()->route('sales.dashboard')
                         ->with('success', 'Laporan kunjungan berhasil disimpan.');
    }

    public function destroy(Visit $visit)
{
    // Pastikan user hanya bisa menghapus laporannya sendiri
    if ($visit->user_id !== Auth::id()) {
        abort(403);
    }

    // Hapus foto dari storage jika ada
    if ($visit->photo_path) {
        Storage::disk('public')->delete($visit->photo_path);
    }

    $visit->delete();

    return redirect()->route('sales.visits.index')
                     ->with('success', 'Laporan kunjungan berhasil dihapus.');
}

}