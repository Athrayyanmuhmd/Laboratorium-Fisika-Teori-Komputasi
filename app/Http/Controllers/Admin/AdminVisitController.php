<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Visit;
use App\Models\Laboratory;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class AdminVisitController extends Controller
{
    public function index(Request $request): View
    {
        $query = Visit::with(['laboratory']);
        
        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
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
                $q->where('visitor_name', 'like', "%{$search}%")
                  ->orWhere('institution', 'like', "%{$search}%")
                  ->orWhere('purpose', 'like', "%{$search}%");
            });
        }
        
        $visits = $query->orderBy('created_at', 'desc')->paginate(15);
        
        $statuses = ['pending', 'approved', 'rejected', 'completed'];
        
        return view('admin.lab-access.index', compact('visits', 'statuses'));
    }

    public function show(Visit $visit): View
    {
        $visit->load(['laboratory']);
        return view('admin.lab-access.show', compact('visit'));
    }

    public function edit(Visit $visit): View
    {
        $laboratories = Laboratory::all();
        return view('admin.lab-access.edit', compact('visit', 'laboratories'));
    }

    public function update(Request $request, Visit $visit): RedirectResponse
    {
        $validated = $request->validate([
            'visit_date' => 'required|date|after_or_equal:today',
            'visit_time' => 'required|string',
            'duration' => 'required|integer|min:1|max:480',
            'admin_notes' => 'nullable|string',
        ]);

        $visit->update($validated);

        return redirect()->route('admin.lab-access.show', $visit)
            ->with('success', 'Permintaan kunjungan berhasil diperbarui.');
    }

    public function approve(Request $request, Visit $visit): RedirectResponse
    {
        $validated = $request->validate([
            'admin_notes' => 'nullable|string'
        ]);

        $visit->update([
            'status' => 'approved',
            'approved_at' => now(),
            'approved_by' => auth()->id(),
            'admin_notes' => $validated['admin_notes'] ?? null
        ]);

        return redirect()->route('admin.lab-access.index')
            ->with('success', 'Permintaan akses laboratorium berhasil disetujui.');
    }

    public function reject(Request $request, Visit $visit): RedirectResponse
    {
        $validated = $request->validate([
            'rejection_reason' => 'required|string'
        ]);

        $visit->update([
            'status' => 'rejected',
            'rejected_at' => now(),
            'rejected_by' => auth()->id(),
            'rejection_reason' => $validated['rejection_reason']
        ]);

        return redirect()->route('admin.lab-access.index')
            ->with('success', 'Permintaan akses laboratorium berhasil ditolak.');
    }

    public function complete(Request $request, Visit $visit): RedirectResponse
    {
        $validated = $request->validate([
            'actual_participants' => 'required|integer|min:1',
            'actual_start_time' => 'required|date',
            'actual_end_time' => 'required|date|after:actual_start_time',
            'visit_notes' => 'nullable|string',
            'visitor_feedback' => 'nullable|string'
        ]);

        $visit->update([
            'status' => 'completed',
            'completed_at' => now(),
            'actual_participants' => $validated['actual_participants'],
            'actual_start_time' => $validated['actual_start_time'],
            'actual_end_time' => $validated['actual_end_time'],
            'visit_notes' => $validated['visit_notes'],
            'visitor_feedback' => $validated['visitor_feedback']
        ]);

        return redirect()->route('admin.lab-access.index')
            ->with('success', 'Kunjungan laboratorium berhasil diselesaikan.');
    }

    public function destroy(Visit $visit): RedirectResponse
    {
        $visit->delete();

        return redirect()->route('admin.lab-access.index')
            ->with('success', 'Data kunjungan berhasil dihapus.');
    }
}
