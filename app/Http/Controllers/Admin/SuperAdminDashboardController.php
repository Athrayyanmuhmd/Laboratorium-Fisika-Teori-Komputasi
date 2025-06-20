<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Laboratory;
use App\Models\Equipment;
use App\Models\Computer;
use App\Models\Rental;
use App\Models\Visit;
use App\Models\Test;
use App\Models\Staff;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class SuperAdminDashboardController extends Controller
{
    public function index(): View
    {
        // System Statistics
        $totalUsers = User::count();
        $totalAdmins = User::whereIn('role', ['super_admin', 'lab_admin'])->count();
        $totalStaff = User::where('role', 'staff')->count();
        $totalRegularUsers = User::where('role', 'user')->count();
        
        // Laboratory Statistics
        $totalLaboratories = Laboratory::count();
        $activeLaboratories = Laboratory::where('status', 'active')->count();
        
        // Equipment Statistics
        $totalEquipment = Equipment::count();
        $workingEquipment = Equipment::where('status', 'tersedia')->count();
        $maintenanceEquipment = Equipment::where('status', 'maintenance')->count();
        
        // Computer Statistics
        $totalComputers = Computer::count();
        $availableComputers = Computer::where('status', 'available')->count();
        $usedComputers = Computer::where('status', 'in_use')->count();
        $maintenanceComputers = Computer::where('status', 'maintenance')->count();
        
        // Request Statistics
        $totalSimulations = Rental::count();
        $pendingSimulations = Rental::where('status', 'pending')->count();
        $approvedSimulations = Rental::where('status', 'approved')->count();
        
        $totalVisits = Visit::count();
        $pendingVisits = Visit::where('status', 'pending')->count();
        $approvedVisits = Visit::where('status', 'approved')->count();
        
        $totalConsultations = Test::count();
        $pendingConsultations = Test::where('status', 'pending')->count();
        $approvedConsultations = Test::where('status', 'approved')->count();
        
        // Recent Activities
        $recentUsers = User::latest()->take(5)->get();
        $recentSimulations = Rental::with('laboratory')->latest()->take(5)->get();
        $recentVisits = Visit::with('laboratory')->latest()->take(5)->get();
        $recentConsultations = Test::with('laboratory')->latest()->take(5)->get();
        
        // Monthly Statistics for Charts
        $monthlyUsers = User::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('COUNT(*) as count')
        )
        ->whereYear('created_at', date('Y'))
        ->groupBy(DB::raw('MONTH(created_at)'))
        ->pluck('count', 'month')
        ->toArray();
        
        $monthlyRequests = [
            'simulations' => Rental::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as count')
            )
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->pluck('count', 'month')
            ->toArray(),
            
            'visits' => Visit::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as count')
            )
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->pluck('count', 'month')
            ->toArray(),
            
            'consultations' => Test::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as count')
            )
            ->whereYear('created_at', date('Y'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->pluck('count', 'month')
            ->toArray(),
        ];
        
        return view('admin.super.dashboard', compact(
            'totalUsers', 'totalAdmins', 'totalStaff', 'totalRegularUsers',
            'totalLaboratories', 'activeLaboratories',
            'totalEquipment', 'workingEquipment', 'maintenanceEquipment',
            'totalComputers', 'availableComputers', 'usedComputers', 'maintenanceComputers',
            'totalSimulations', 'pendingSimulations', 'approvedSimulations',
            'totalVisits', 'pendingVisits', 'approvedVisits',
            'totalConsultations', 'pendingConsultations', 'approvedConsultations',
            'recentUsers', 'recentSimulations', 'recentVisits', 'recentConsultations',
            'monthlyUsers', 'monthlyRequests'
        ));
    }
} 