<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\B2gPotential;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class B2gController extends Controller
{
    public function index()
    {
        // Definisikan urutan kolom/status
        $statuses = ['potensi-baru', 'pendekatan-awal', 'proposal-diajukan', 'negosiasi-tender', 'menang', 'kalah'];

        // Ambil semua data milik user, lalu kelompokkan berdasarkan statusnya
        $potentialsByStatus = B2gPotential::where('user_id', Auth::id())
                                          ->get()
                                          ->groupBy('status');

        return view('sales.b2g_potentials.index', compact('potentialsByStatus', 'statuses'));
    }

    public function create()
    {
        return view('sales.b2g_potentials.create');
    }

     public function store(Request $request)
    {
        // 1. Validasi input
        $request->validate([
            'project_name' => 'required|string|max:255',
            'skpd_name' => 'required|string|max:255',
            'estimated_value' => 'required|numeric|min:0',
            'source_of_info' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // 2. Simpan data ke database
        B2gPotential::create([
            'user_id' => Auth::id(),
            'project_name' => $request->project_name,
            'skpd_name' => $request->skpd_name,
            'estimated_value' => $request->estimated_value,
            'source_of_info' => $request->source_of_info,
            'description' => $request->description,
            'status' => 'potensi-baru', // Status awal saat dibuat
        ]);

        // 3. Redirect ke halaman Kanban dengan pesan sukses
        return redirect()->route('sales.b2g_potentials.index')
                         ->with('success', 'Potensi pengadaan baru berhasil ditambahkan.');
    }

    public function show(B2gPotential $b2gPotential)
    {
        // Pastikan user hanya bisa melihat laporannya sendiri
        abort_if($b2gPotential->user_id !== Auth::id(), 403);
        return view('sales.b2g_potentials.show', compact('b2gPotential'));
    }

    public function edit(B2gPotential $b2gPotential)
    {
        abort_if($b2gPotential->user_id !== Auth::id(), 403);
        
        // Definisikan status yang bisa dipilih
        $statuses = ['potensi-baru', 'pendekatan-awal', 'proposal-diajukan', 'negosiasi-tender', 'menang', 'kalah'];
        
        return view('sales.b2g_potentials.edit', compact('b2gPotential', 'statuses'));
    }

    public function update(Request $request, B2gPotential $b2gPotential)
    {
        abort_if($b2gPotential->user_id !== Auth::id(), 403);

        $request->validate([
            'project_name' => 'required|string|max:255',
            'skpd_name' => 'required|string|max:255',
            'estimated_value' => 'required|numeric|min:0',
            'source_of_info' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:potensi-baru,pendekatan-awal,proposal-diajukan,negosiasi-tender,menang,kalah',
        ]);

        $b2gPotential->update($request->all());

        return redirect()->route('sales.b2g_potentials.index')
                         ->with('success', 'Potensi pengadaan berhasil diperbarui.');
    }

    public function destroy(B2gPotential $b2gPotential)
    {
        abort_if($b2gPotential->user_id !== Auth::id(), 403);
        
        $b2gPotential->delete();
        
        return redirect()->route('sales.b2g_potentials.index')
                         ->with('success', 'Potensi pengadaan berhasil dihapus.');
    }
}