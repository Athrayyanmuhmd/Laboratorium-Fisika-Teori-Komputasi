<?php

namespace App\Http\Controllers;

use App\Models\Laboratory;
use App\Models\Equipment;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $laboratories = Laboratory::active()
            ->with(['galleries' => function ($query) {
                $query->featured()->active();
            }])
            ->get();

        $featuredEquipment = Equipment::whereHas('laboratory', function ($query) {
                $query->where('status', 'active');
            })
            ->available()
            ->limit(8)
            ->get();

        $featuredGalleries = Gallery::featured()
            ->active()
            ->with('laboratory')
            ->limit(12)
            ->get();

        return view('home.index', compact('laboratories', 'featuredEquipment', 'featuredGalleries'));
    }

    public function about(): View
    {
        return view('home.about');
    }

    public function contact(): View
    {
        return view('home.contact');
    }

    public function departments(): View
    {
        return view('home.departments');
    }
}
