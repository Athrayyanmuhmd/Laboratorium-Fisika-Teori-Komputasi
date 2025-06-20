<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Equipment;
use App\Models\Rental;
use App\Models\Visit;
use App\Models\Test;
use App\Models\MaintenanceRecord;
use App\Models\Computer;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(): View
    {
        // Equipment Statistics
        $totalEquipment = Equipment::count();
        $availableEquipment = Equipment::where('status', 'available')->count();
        $rentedEquipment = Equipment::where('status', 'rented')->count();
        $maintenanceEquipment = Equipment::where('status', 'maintenance')->count();
        $needsCalibration = Equipment::where('next_calibration', '<=', Carbon::now()->addDays(30))->count();

        // Rental Statistics
        $totalRentals = Rental::count();
        $pendingRentals = Rental::where('status', 'pending')->count();
        $activeRentals = Rental::where('status', 'approved')->count();
        $completedRentals = Rental::where('status', 'returned')->count();

        // Visit Statistics
        $totalVisits = Visit::count();
        $pendingVisits = Visit::where('status', 'pending')->count();
        $approvedVisits = Visit::where('status', 'approved')->count();
        $completedVisits = Visit::where('status', 'completed')->count();

        // Test Statistics
        $totalTests = Test::count();
        $pendingTests = Test::where('status', 'pending')->count();
        $inProgressTests = Test::where('status', 'in_progress')->count();
        $completedTests = Test::where('status', 'completed')->count();

        // Recent Activities
        $recentRentals = Rental::with(['equipment', 'equipment.laboratory'])
            ->latest()
            ->take(5)
            ->get();

        $recentVisits = Visit::with('laboratory')
            ->latest()
            ->take(5)
            ->get();

        $recentTests = Test::with('laboratory')
            ->latest()
            ->take(5)
            ->get();

        // Maintenance Alerts
        $upcomingMaintenance = MaintenanceRecord::with('equipment')
            ->where('status', 'scheduled')
            ->where('scheduled_date', '<=', Carbon::now()->addDays(7))
            ->latest()
            ->take(5)
            ->get();

        // Equipment by Category
        $equipmentByCategory = Equipment::selectRaw('category, count(*) as count')
            ->groupBy('category')
            ->get();

        // Monthly Statistics
        $monthlyRentals = Rental::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('month')
            ->get();

        // Computer Layout Data (from database)
        $computers = Computer::orderedByPosition()->get();
        
        // Group computers by rows for layout
        $computerGrid = [];
        for ($row = 1; $row <= 4; $row++) {
            $computerGrid[$row] = $computers->where('position_row', $row)->values();
        }

        // Lab statistics
        $labStats = [
            'total_computers' => Computer::count(),
            'available' => Computer::available()->count(),
            'in_use' => Computer::inUse()->count(),
            'maintenance' => Computer::maintenance()->count(),
            'offline' => Computer::offline()->count(),
            'utilization_rate' => Computer::count() > 0 ? 
                round((Computer::inUse()->count() / Computer::count()) * 100, 1) : 0
        ];

        return view('admin.dashboard', compact(
            'totalEquipment',
            'availableEquipment',
            'rentedEquipment',
            'maintenanceEquipment',
            'needsCalibration',
            'totalRentals',
            'pendingRentals',
            'activeRentals',
            'completedRentals',
            'totalVisits',
            'pendingVisits',
            'approvedVisits',
            'completedVisits',
            'totalTests',
            'pendingTests',
            'inProgressTests',
            'completedTests',
            'recentRentals',
            'recentVisits',
            'recentTests',
            'upcomingMaintenance',
            'equipmentByCategory',
            'monthlyRentals',
            'computers',
            'computerGrid',
            'labStats'
        ));
    }
}
