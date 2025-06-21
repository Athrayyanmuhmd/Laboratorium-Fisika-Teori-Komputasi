<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnalysisRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class AdminAnalysisController extends Controller
{
    public function index(Request $request): View
    {
        $query = AnalysisRequest::with(['approvedBy', 'analyst']);
        
        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        // Filter by analysis type
        if ($request->filled('type')) {
            $query->where('analysis_type', $request->type);
        }
        
        // Filter by date range
        if ($request->filled('start_date')) {
            $query->whereDate('target_deadline', '>=', $request->start_date);
        }
        
        if ($request->filled('end_date')) {
            $query->whereDate('target_deadline', '<=', $request->end_date);
        }
        
        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('researcher_name', 'like', "%{$search}%")
                  ->orWhere('affiliation', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('request_code', 'like', "%{$search}%");
            });
        }
        
        $requests = $query->orderBy('created_at', 'desc')->paginate(15);
        
        // Statistics
        $stats = [
            'total' => AnalysisRequest::count(),
            'pending' => AnalysisRequest::where('status', 'pending')->count(),
            'approved' => AnalysisRequest::where('status', 'approved')->count(),
            'in_progress' => AnalysisRequest::where('status', 'in_progress')->count(),
            'completed' => AnalysisRequest::where('status', 'completed')->count(),
            'rejected' => AnalysisRequest::where('status', 'rejected')->count(),
        ];
        
        $statuses = ['pending', 'approved', 'rejected', 'in_progress', 'completed'];
        $types = ['simulasi_numerik', 'analisis_data_geofisika', 'visualisasi_data', 'laporan_komprehensif'];
        
        return view('admin.analysis.index', compact('requests', 'stats', 'statuses', 'types'));
    }

    public function show(AnalysisRequest $analysis): View
    {
        $analysis->load(['approvedBy', 'analyst']);
        return view('admin.analysis.show', compact('analysis'));
    }

    public function approve(Request $request, AnalysisRequest $analysis): RedirectResponse
    {
        $request->validate([
            'admin_notes' => 'nullable|string|max:1000',
            'analyst_id' => 'nullable|exists:users,id'
        ]);

        $analysis->update([
            'status' => 'approved',
            'admin_notes' => $request->admin_notes,
            'analyst_id' => $request->analyst_id,
            'approved_at' => now(),
            'approved_by' => Auth::id()
        ]);

        return redirect()->back()->with('success', 'Permintaan analisis telah disetujui.');
    }

    public function reject(Request $request, AnalysisRequest $analysis): RedirectResponse
    {
        $request->validate([
            'admin_notes' => 'required|string|max:1000'
        ]);

        $analysis->update([
            'status' => 'rejected',
            'admin_notes' => $request->admin_notes,
            'approved_by' => Auth::id()
        ]);

        return redirect()->back()->with('success', 'Permintaan analisis telah ditolak.');
    }

    public function startProgress(Request $request, AnalysisRequest $analysis): RedirectResponse
    {
        $request->validate([
            'admin_notes' => 'nullable|string|max:1000'
        ]);

        $analysis->update([
            'status' => 'in_progress',
            'admin_notes' => $request->admin_notes
        ]);

        return redirect()->back()->with('success', 'Analisis telah dimulai.');
    }

    public function complete(Request $request, AnalysisRequest $analysis): RedirectResponse
    {
        $request->validate([
            'results' => 'required|string',
            'admin_notes' => 'nullable|string|max:1000'
        ]);

        $analysis->update([
            'status' => 'completed',
            'results' => $request->results,
            'admin_notes' => $request->admin_notes,
            'completed_at' => now()
        ]);

        return redirect()->back()->with('success', 'Analisis telah diselesaikan.');
    }
} 