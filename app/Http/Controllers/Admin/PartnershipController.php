<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class PartnershipController extends Controller
{
    public function index()
    {
        return view('admin.partnerships.index');
    }

    // kamu bisa tambahkan create/store/edit/delete nanti
}
