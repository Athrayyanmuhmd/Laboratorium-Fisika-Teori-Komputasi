<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Computer;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AdminComputerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $computers = Computer::orderedByPosition()->get();
        
        // Group computers by rows for layout
        $computerGrid = [];
        for ($row = 1; $row <= 4; $row++) {
            $computerGrid[$row] = $computers->where('position_row', $row)->values();
        }

        $stats = [
            'total' => Computer::count(),
            'available' => Computer::available()->count(),
            'in_use' => Computer::inUse()->count(),
            'maintenance' => Computer::maintenance()->count(),
            'offline' => Computer::offline()->count()
        ];

        return view('admin.computers.index', compact('computerGrid', 'stats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        // Find available positions
        $usedPositions = Computer::all()->pluck('position_row', 'position_col')->toArray();
        $availablePositions = [];
        
        for ($row = 1; $row <= 4; $row++) {
            for ($col = 1; $col <= 7; $col++) {
                if (!isset($usedPositions[$col]) || $usedPositions[$col] != $row) {
                    $availablePositions[] = ['row' => $row, 'col' => $col];
                }
            }
        }

        return view('admin.computers.create', compact('availablePositions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:computers',
            'code' => 'required|string|max:255|unique:computers',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'specs' => 'required|string',
            'status' => 'required|in:available,in_use,maintenance,offline',
            'position_row' => 'required|integer|min:1|max:4',
            'position_col' => 'required|integer|min:1|max:7',
            'current_user' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        // Check if position is already taken
        $existingComputer = Computer::where('position_row', $validated['position_row'])
                                  ->where('position_col', $validated['position_col'])
                                  ->first();

        if ($existingComputer) {
            return back()->withErrors(['position' => 'Posisi ini sudah digunakan oleh komputer lain.'])
                        ->withInput();
        }

        Computer::create($validated);

        return redirect()->route('admin.computers.index')
                        ->with('success', 'Komputer berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Computer $computer): View
    {
        return view('admin.computers.show', compact('computer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Computer $computer): View
    {
        return view('admin.computers.edit', compact('computer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Computer $computer): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:computers,name,' . $computer->id,
            'code' => 'required|string|max:255|unique:computers,code,' . $computer->id,
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'specs' => 'required|string',
            'status' => 'required|in:available,in_use,maintenance,offline',
            'position_row' => 'required|integer|min:1|max:4',
            'position_col' => 'required|integer|min:1|max:7',
            'current_user' => 'nullable|string|max:255',
            'notes' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        // Check if new position is already taken by another computer
        if ($computer->position_row != $validated['position_row'] || 
            $computer->position_col != $validated['position_col']) {
            
            $existingComputer = Computer::where('position_row', $validated['position_row'])
                                      ->where('position_col', $validated['position_col'])
                                      ->where('id', '!=', $computer->id)
                                      ->first();

            if ($existingComputer) {
                return back()->withErrors(['position' => 'Posisi ini sudah digunakan oleh komputer lain.'])
                            ->withInput();
            }
        }

        $computer->update($validated);

        return redirect()->route('admin.computers.index')
                        ->with('success', 'Komputer berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Computer $computer): RedirectResponse
    {
        $computer->delete();

        return redirect()->route('admin.computers.index')
                        ->with('success', 'Komputer berhasil dihapus.');
    }

    /**
     * Update computer status via AJAX
     */
    public function updateStatus(Request $request, Computer $computer): JsonResponse
    {
        $validated = $request->validate([
            'status' => 'required|in:available,in_use,maintenance,offline',
            'current_user' => 'nullable|string|max:255',
            'notes' => 'nullable|string'
        ]);

        $updateData = ['status' => $validated['status']];

        // Handle status-specific logic
        switch ($validated['status']) {
            case 'available':
                $updateData['current_user'] = null;
                $updateData['usage_hours'] = 0;
                break;
                
            case 'in_use':
                $updateData['current_user'] = $validated['current_user'] ?? 'Unknown User';
                $updateData['last_used'] = now();
                $updateData['usage_hours'] = 0;
                break;
                
            case 'maintenance':
                $updateData['current_user'] = null;
                $updateData['usage_hours'] = 0;
                $updateData['notes'] = $validated['notes'] ?? 'Maintenance';
                break;
                
            case 'offline':
                $updateData['current_user'] = null;
                $updateData['usage_hours'] = 0;
                $updateData['is_active'] = false;
                break;
        }

        $computer->update($updateData);

        return response()->json([
            'success' => true,
            'message' => 'Status komputer berhasil diperbarui.',
            'computer' => $computer->fresh(),
            'stats' => [
                'total' => Computer::count(),
                'available' => Computer::available()->count(),
                'in_use' => Computer::inUse()->count(),
                'maintenance' => Computer::maintenance()->count(),
                'offline' => Computer::offline()->count()
            ]
        ]);
    }

    /**
     * Get computer data for AJAX requests
     */
    public function getComputer(Computer $computer): JsonResponse
    {
        return response()->json([
            'success' => true,
            'computer' => $computer
        ]);
    }

    /**
     * Quick update for basic computer info
     */
    public function quickUpdate(Request $request, Computer $computer): JsonResponse
    {
        $validated = $request->validate([
            'current_user' => 'nullable|string|max:255',
            'usage_hours' => 'nullable|integer|min:0|max:24',
            'notes' => 'nullable|string'
        ]);

        $computer->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Informasi komputer berhasil diperbarui.',
            'computer' => $computer->fresh()
        ]);
    }

    /**
     * Get statistics for dashboard
     */
    public function getStats(): JsonResponse
    {
        $stats = [
            'total' => Computer::count(),
            'available' => Computer::available()->count(),
            'in_use' => Computer::inUse()->count(),
            'maintenance' => Computer::maintenance()->count(),
            'offline' => Computer::offline()->count(),
            'usage_percentage' => Computer::count() > 0 ? 
                round((Computer::inUse()->count() / Computer::count()) * 100, 1) : 0
        ];

        return response()->json($stats);
    }
}
