<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Test;
use App\Models\Laboratory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class AdminTestController extends Controller
{
    public function index(Request $request): View
    {
        $query = Test::with(['laboratory']);
        
        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        // Filter by test type
        if ($request->filled('test_type')) {
            $query->where('test_type', $request->test_type);
        }
        
        // Filter by date range
        if ($request->filled('start_date')) {
            $query->whereDate('requested_date', '>=', $request->start_date);
        }
        
        if ($request->filled('end_date')) {
            $query->whereDate('requested_date', '<=', $request->end_date);
        }
        
        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('requester_name', 'like', "%{$search}%")
                  ->orWhere('institution', 'like', "%{$search}%")
                  ->orWhere('subject', 'like', "%{$search}%");
            });
        }
        
        $tests = $query->orderBy('created_at', 'desc')->paginate(15);
        
        $statuses = ['pending', 'approved', 'in_progress', 'completed', 'rejected'];
        $testTypes = ['consultation', 'analysis', 'research', 'thesis'];
        
        return view('admin.consultations.index', compact('tests', 'statuses', 'testTypes'));
    }

    public function show(Test $test): View
    {
        $test->load(['laboratory']);
        return view('admin.consultations.show', compact('test'));
    }

    public function edit(Test $test): View
    {
        $laboratories = Laboratory::all();
        $analysts = User::where('role', 'lab_admin')->orWhere('role', 'super_admin')->get();
        return view('admin.consultations.edit', compact('test', 'laboratories', 'analysts'));
    }

    public function update(Request $request, Test $test): RedirectResponse
    {
        $validated = $request->validate([
            'requested_date' => 'required|date|after_or_equal:today',
            'estimated_completion' => 'required|date|after:requested_date',
            'estimated_cost' => 'nullable|numeric|min:0',
            'analyst_id' => 'nullable|exists:users,id',
            'admin_notes' => 'nullable|string',
        ]);

        $test->update($validated);

        return redirect()->route('admin.consultations.show', $test)
            ->with('success', 'Permintaan konsultasi berhasil diperbarui.');
    }

    public function approve(Request $request, Test $test): RedirectResponse
    {
        $validated = $request->validate([
            'estimated_cost' => 'nullable|numeric|min:0',
            'estimated_duration' => 'nullable|integer|min:1',
            'admin_notes' => 'nullable|string'
        ]);

        $test->update([
            'status' => 'approved',
            'approved_at' => now(),
            'approved_by' => auth()->id(),
            'estimated_cost' => $validated['estimated_cost'] ?? null,
            'estimated_duration' => $validated['estimated_duration'] ?? null,
            'admin_notes' => $validated['admin_notes'] ?? null
        ]);

        return redirect()->route('admin.consultations.index')
            ->with('success', 'Permintaan konsultasi berhasil disetujui.');
    }

    public function reject(Request $request, Test $test): RedirectResponse
    {
        $validated = $request->validate([
            'rejection_reason' => 'required|string'
        ]);

        $test->update([
            'status' => 'rejected',
            'rejected_at' => now(),
            'rejected_by' => auth()->id(),
            'rejection_reason' => $validated['rejection_reason']
        ]);

        return redirect()->route('admin.consultations.index')
            ->with('success', 'Permintaan konsultasi berhasil ditolak.');
    }

    public function start(Request $request, Test $test): RedirectResponse
    {
        $validated = $request->validate([
            'actual_start_date' => 'required|date',
            'analyst_name' => 'required|string',
            'process_notes' => 'nullable|string'
        ]);

        $test->update([
            'status' => 'in_progress',
            'started_at' => $validated['actual_start_date'],
            'analyst_name' => $validated['analyst_name'],
            'process_notes' => $validated['process_notes']
        ]);

        return redirect()->route('admin.consultations.index')
            ->with('success', 'Proses konsultasi berhasil dimulai.');
    }

    public function complete(Request $request, Test $test): RedirectResponse
    {
        $validated = $request->validate([
            'results' => 'required|string',
            'final_cost' => 'nullable|numeric|min:0',
            'completion_notes' => 'nullable|string',
            'recommendations' => 'nullable|string'
        ]);

        $test->update([
            'status' => 'completed',
            'completed_at' => now(),
            'results' => $validated['results'],
            'final_cost' => $validated['final_cost'] ?? null,
            'completion_notes' => $validated['completion_notes'],
            'recommendations' => $validated['recommendations']
        ]);

        return redirect()->route('admin.consultations.index')
            ->with('success', 'Konsultasi berhasil diselesaikan.');
    }

    public function destroy(Test $test): RedirectResponse
    {
        $test->delete();

        return redirect()->route('admin.consultations.index')
            ->with('success', 'Data konsultasi berhasil dihapus.');
    }
}
