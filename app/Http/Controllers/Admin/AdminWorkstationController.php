<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WorkstationRental;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class AdminWorkstationController extends Controller
{
    public function index(Request $request): View
    {
        $query = WorkstationRental::with('approvedBy');
        
        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        // Filter by workstation type
        if ($request->filled('type')) {
            $query->where('workstation_type', $request->type);
        }
        
        // Filter by date range
        if ($request->filled('start_date')) {
            $query->whereDate('start_date', '>=', $request->start_date);
        }
        
        if ($request->filled('end_date')) {
            $query->whereDate('end_date', '<=', $request->end_date);
        }
        
        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('institution', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('request_code', 'like', "%{$search}%");
            });
        }
        
        $rentals = $query->orderBy('created_at', 'desc')->paginate(15);
        
        // Statistics
        $stats = [
            'total' => WorkstationRental::count(),
            'pending' => WorkstationRental::where('status', 'pending')->count(),
            'approved' => WorkstationRental::where('status', 'approved')->count(),
            'completed' => WorkstationRental::where('status', 'completed')->count(),
            'rejected' => WorkstationRental::where('status', 'rejected')->count(),
        ];
        
        $statuses = ['pending', 'approved', 'rejected', 'completed'];
        $types = ['pc_high_performance', 'software_geofisika', 'tools_fotografi', 'environment_programming'];
        
        return view('admin.workstation.index', compact('rentals', 'stats', 'statuses', 'types'));
    }

    public function show(WorkstationRental $workstation): View
    {
        $workstation->load('approvedBy');
        return view('admin.workstation.show', compact('workstation'));
    }

    public function approve(Request $request, WorkstationRental $workstation): RedirectResponse
    {
        $request->validate([
            'admin_notes' => 'nullable|string|max:1000'
        ]);

        $workstation->update([
            'status' => 'approved',
            'admin_notes' => $request->admin_notes,
            'approved_at' => now(),
            'approved_by' => Auth::id()
        ]);

        return redirect()->back()->with('success', 'Permintaan penyewaan workstation telah disetujui.');
    }

    public function reject(Request $request, WorkstationRental $workstation): RedirectResponse
    {
        $request->validate([
            'admin_notes' => 'required|string|max:1000'
        ]);

        $workstation->update([
            'status' => 'rejected',
            'admin_notes' => $request->admin_notes,
            'approved_by' => Auth::id()
        ]);

        return redirect()->back()->with('success', 'Permintaan penyewaan workstation telah ditolak.');
    }

    public function complete(Request $request, WorkstationRental $workstation): RedirectResponse
    {
        $request->validate([
            'admin_notes' => 'nullable|string|max:1000'
        ]);

        $workstation->update([
            'status' => 'completed',
            'admin_notes' => $request->admin_notes
        ]);

        return redirect()->back()->with('success', 'Penyewaan workstation telah diselesaikan.');
    }
} 