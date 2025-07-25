<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    /**
     * Menampilkan halaman E-Katalog produk.
     */
    public function index()
    {
        $products = Product::latest()->paginate(12); // Ambil 12 produk per halaman

        return view('sales.catalog.index', compact('products'));
    }
}