<?php

namespace App\Http\Controllers;

use App\Models\Laboratory;
use App\Models\Equipment;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LaboratoryController extends Controller
{
    public function index()
    {
        // Halaman utama Laboratorium Fisika Komputasi
        return view('laboratories.index');
    }

    public function services()
    {
        return view('laboratories.services');
    }

    public function facilities()
    {
        return view('laboratories.facilities');
    }

    public function research()
    {
        return view('laboratories.research');
    }

    public function contact()
    {
        return view('laboratories.contact');
    }
}
