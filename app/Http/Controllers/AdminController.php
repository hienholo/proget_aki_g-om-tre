<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function dashbord_1(): View
    {
        return view('admin.Ajouter_client');
    }

    public function dashbord_2(): View
    {
        return view('admin.Liste_client');
    }
    public function dashbord_3(): View
    {
        return view('admin.modifier_client');
    }
    public function dashbord_4(): View
    {
        return view('admin.Ajout_document');
    }
    public function dashbord_5(): View
    {
        return view('admin.Eatat_document');
    }
}
