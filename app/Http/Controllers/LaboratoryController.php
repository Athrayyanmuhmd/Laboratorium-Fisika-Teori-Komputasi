<?php

namespace App\Http\Controllers;

use App\Models\Laboratory;
use App\Models\Equipment;
use App\Models\Gallery;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class LaboratoryController extends Controller
{
    public function index()
    {
        // Get featured staff for display on landing page
        $featuredStaff = Staff::where('is_featured', true)
                            ->where('is_active', true)
                            ->orderBy('sort_order')
                            ->take(5)
                            ->get();

        // Get featured gallery items for display on landing page
        $featuredGallery = Gallery::where('is_featured', true)
                                ->where('is_active', true)
                                ->orderBy('sort_order')
                                ->take(6)
                                ->get();

        return view('laboratories.index', compact('featuredStaff', 'featuredGallery'));
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
