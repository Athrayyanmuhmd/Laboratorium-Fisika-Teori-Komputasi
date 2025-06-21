<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LabVisit;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class AdminLabVisitController extends Controller
{
    public function index(Request $request): View
    {
        $query = LabVisit::with('approvedBy');
        
        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        // Filter by visit type
        if ($request->filled('type')) {
            $query->where('visit_type', $request->type);
        }
        
        // Filter by date range
        if ($request->filled('start_date')) {
            $query->whereDate('visit_date', '>=', $request->start_date);
        }
        
        if ($request->filled('end_date')) {
            $query->whereDate('visit_date', '<=', $request->end_date);
        }
        
        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('pic_name', 'like', "%{$search}%")
                  ->orWhere('institution', 'like', "%{$search}%")
                  ->orWhere('contact', 'like', "%{$search}%")
                  ->orWhere('visit_code', 'like', "%{$search}%");
            });
        }
        
        $visits = $query->orderBy('created_at', 'desc')->paginate(15);
        
        // Statistics
        $stats = [
            'total' => LabVisit::count(),
            'pending' => LabVisit::where('status', 'pending')->count(),
            'approved' => LabVisit::where('status', 'approved')->count(),
            'completed' => LabVisit::where('status', 'completed')->count(),
            'rejected' => LabVisit::where('status', 'rejected')->count(),
        ];
        
        $statuses = ['pending', 'approved', 'rejected', 'completed'];
        $types = ['tur_fasilitas', 'workshop_simulasi', 'demo_software', 'konsultasi_ahli'];
        
        return view('admin.lab-visits.index', compact('visits', 'stats', 'statuses', 'types'));
    }

    public function show(LabVisit $labVisit): View
    {
        $labVisit->load('approvedBy');
        return view('admin.lab-visits.show', compact('labVisit'));
    }

    public function approve(Request $request, LabVisit $labVisit): RedirectResponse
    {
        $request->validate([
            'admin_notes' => 'nullable|string|max:1000'
        ]);

        $labVisit->update([
            'status' => 'approved',
            'admin_notes' => $request->admin_notes,
            'approved_at' => now(),
            'approved_by' => Auth::id()
        ]);

        return redirect()->back()->with('success', 'Permintaan kunjungan laboratorium telah disetujui.');
    }

    public function reject(Request $request, LabVisit $labVisit): RedirectResponse
    {
        $request->validate([
            'admin_notes' => 'required|string|max:1000'
        ]);

        $labVisit->update([
            'status' => 'rejected',
            'admin_notes' => $request->admin_notes,
            'approved_by' => Auth::id()
        ]);

        return redirect()->back()->with('success', 'Permintaan kunjungan laboratorium telah ditolak.');
    }

    public function complete(Request $request, LabVisit $labVisit): RedirectResponse
    {
        $request->validate([
            'admin_notes' => 'nullable|string|max:1000'
        ]);

        $labVisit->update([
            'status' => 'completed',
            'admin_notes' => $request->admin_notes
        ]);

        return redirect()->back()->with('success', 'Kunjungan laboratorium telah diselesaikan.');
    }
} 