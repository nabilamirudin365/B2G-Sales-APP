<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\B2gPotential;
use Illuminate\Http\Request;

class B2gPotentialController extends Controller
{
    public function index()
    {
        $potentials = B2gPotential::with('user') // Ambil juga data user yang terkait
                                  ->latest()
                                  ->paginate(15);

        return view('admin.b2g_potentials.index', compact('potentials'));
    }

    public function show(B2gPotential $b2gPotential)
    {
        return view('admin.b2g_potentials.show', compact('b2gPotential'));
    }

    public function destroy(B2gPotential $b2gPotential)
    {
        $b2gPotential->delete();

        return redirect()->route('admin.b2g_potentials.index')
                         ->with('success', 'Data Potensi SKPD berhasil dihapus.');
    }
}