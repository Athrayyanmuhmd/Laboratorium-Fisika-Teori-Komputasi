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

    public function analytics(): View
    {
        // Advanced Analytics Data
        
        // User Growth Analytics
        $userGrowth = User::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('COUNT(*) as count')
        )
        ->where('created_at', '>=', now()->subDays(30))
        ->groupBy(DB::raw('DATE(created_at)'))
        ->orderBy('date')
        ->get();

        // Request Type Distribution
        $requestDistribution = [
            'simulations' => Rental::count(),
            'visits' => Visit::count(),
            'consultations' => Test::count()
        ];

        // Status Distribution
        $statusDistribution = [
            'pending' => Rental::where('status', 'pending')->count() + 
                        Visit::where('status', 'pending')->count() + 
                        Test::where('status', 'pending')->count(),
            'approved' => Rental::where('status', 'approved')->count() + 
                         Visit::where('status', 'approved')->count() + 
                         Test::where('status', 'approved')->count(),
            'completed' => Rental::where('status', 'completed')->count() + 
                          Visit::where('status', 'completed')->count() + 
                          Test::where('status', 'completed')->count(),
            'rejected' => Rental::where('status', 'rejected')->count() + 
                         Visit::where('status', 'rejected')->count() + 
                         Test::where('status', 'rejected')->count()
        ];

        // Monthly Performance
        $monthlyPerformance = [];
        for ($i = 11; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $monthlyPerformance[] = [
                'month' => $date->format('M Y'),
                'users' => User::whereYear('created_at', $date->year)
                              ->whereMonth('created_at', $date->month)
                              ->count(),
                'requests' => Rental::whereYear('created_at', $date->year)
                                   ->whereMonth('created_at', $date->month)
                                   ->count() +
                             Visit::whereYear('created_at', $date->year)
                                  ->whereMonth('created_at', $date->month)
                                  ->count() +
                             Test::whereYear('created_at', $date->year)
                                 ->whereMonth('created_at', $date->month)
                                 ->count()
            ];
        }

        // Top Laboratories by Usage
        $topLaboratories = Laboratory::withCount(['rentals', 'visits', 'tests'])
            ->orderByDesc('rentals_count')
            ->orderByDesc('visits_count')
            ->orderByDesc('tests_count')
            ->take(5)
            ->get();

        // Equipment Utilization
        $equipmentUtilization = Equipment::select('status', DB::raw('COUNT(*) as count'))
            ->groupBy('status')
            ->get()
            ->pluck('count', 'status')
            ->toArray();

        // Computer Utilization
        $computerUtilization = Computer::select('status', DB::raw('COUNT(*) as count'))
            ->groupBy('status')
            ->get()
            ->pluck('count', 'status')
            ->toArray();

        return view('admin.super.analytics', compact(
            'userGrowth',
            'requestDistribution',
            'statusDistribution',
            'monthlyPerformance',
            'topLaboratories',
            'equipmentUtilization',
            'computerUtilization'
        ));
    }

    public function reports(): View
    {
        // Generate various reports
        
        // User Registration Report
        $userRegistrationReport = User::select(
            DB::raw('DATE(created_at) as date'),
            DB::raw('role'),
            DB::raw('COUNT(*) as count')
        )
        ->where('created_at', '>=', now()->subDays(30))
        ->groupBy('date', 'role')
        ->orderBy('date', 'desc')
        ->get()
        ->groupBy('date');

        // Request Summary Report
        $requestSummaryReport = [
            'today' => [
                'simulations' => Rental::whereDate('created_at', today())->count(),
                'visits' => Visit::whereDate('created_at', today())->count(),
                'consultations' => Test::whereDate('created_at', today())->count()
            ],
            'week' => [
                'simulations' => Rental::where('created_at', '>=', now()->subWeek())->count(),
                'visits' => Visit::where('created_at', '>=', now()->subWeek())->count(),
                'consultations' => Test::where('created_at', '>=', now()->subWeek())->count()
            ],
            'month' => [
                'simulations' => Rental::where('created_at', '>=', now()->subMonth())->count(),
                'visits' => Visit::where('created_at', '>=', now()->subMonth())->count(),
                'consultations' => Test::where('created_at', '>=', now()->subMonth())->count()
            ]
        ];

        // Laboratory Performance Report
        $laboratoryPerformanceReport = Laboratory::with(['rentals', 'visits', 'tests'])
            ->get()
            ->map(function ($lab) {
                return [
                    'id' => $lab->id,
                    'name' => $lab->name,
                    'total_requests' => $lab->rentals->count() + $lab->visits->count() + $lab->tests->count(),
                    'simulations' => $lab->rentals->count(),
                    'visits' => $lab->visits->count(),
                    'consultations' => $lab->tests->count(),
                    'status' => $lab->status
                ];
            })
            ->sortByDesc('total_requests');

        // System Health Report
        $systemHealthReport = [
            'database_size' => DB::select("SELECT ROUND(SUM(data_length + index_length) / 1024 / 1024, 1) AS 'size_mb' FROM information_schema.tables WHERE table_schema = ?", [config('database.connections.mysql.database')])[0]->size_mb ?? 0,
            'total_records' => User::count() + Laboratory::count() + Equipment::count() + Computer::count() + Rental::count() + Visit::count() + Test::count(),
            'active_users' => User::where('created_at', '>=', now()->subDays(30))->count(),
            'storage_usage' => $this->getStorageUsage(),
            'system_uptime' => $this->getSystemUptime()
        ];

        return view('admin.super.reports', compact(
            'userRegistrationReport',
            'requestSummaryReport',
            'laboratoryPerformanceReport',
            'systemHealthReport'
        ));
    }

    public function systemLogs(): View
    {
        // Get recent system activities
        $recentActivities = collect();

        // User activities
        $userActivities = User::latest()->take(20)->get()->map(function ($user) {
            return [
                'type' => 'user_registration',
                'message' => "New user registered: {$user->name} ({$user->role})",
                'timestamp' => $user->created_at,
                'severity' => 'info',
                'details' => [
                    'user_id' => $user->id,
                    'email' => $user->email,
                    'role' => $user->role
                ]
            ];
        });

        // Request activities
        $requestActivities = collect();
        
        $recentRentals = Rental::with('laboratory')->latest()->take(10)->get()->map(function ($rental) {
            return [
                'type' => 'simulation_request',
                'message' => "New simulation request for {$rental->laboratory->name}",
                'timestamp' => $rental->created_at,
                'severity' => $rental->status === 'approved' ? 'success' : ($rental->status === 'rejected' ? 'error' : 'warning'),
                'details' => [
                    'request_id' => $rental->id,
                    'laboratory' => $rental->laboratory->name,
                    'status' => $rental->status
                ]
            ];
        });

        $recentVisits = Visit::with('laboratory')->latest()->take(10)->get()->map(function ($visit) {
            return [
                'type' => 'lab_access_request',
                'message' => "New lab access request for {$visit->laboratory->name}",
                'timestamp' => $visit->created_at,
                'severity' => $visit->status === 'approved' ? 'success' : ($visit->status === 'rejected' ? 'error' : 'warning'),
                'details' => [
                    'request_id' => $visit->id,
                    'laboratory' => $visit->laboratory->name,
                    'status' => $visit->status
                ]
            ];
        });

        $recentConsultations = Test::with('laboratory')->latest()->take(10)->get()->map(function ($test) {
            return [
                'type' => 'consultation_request',
                'message' => "New consultation request for {$test->laboratory->name}",
                'timestamp' => $test->created_at,
                'severity' => $test->status === 'approved' ? 'success' : ($test->status === 'rejected' ? 'error' : 'warning'),
                'details' => [
                    'request_id' => $test->id,
                    'laboratory' => $test->laboratory->name,
                    'status' => $test->status
                ]
            ];
        });

        // Combine all activities
        $recentActivities = $recentActivities
            ->concat($userActivities)
            ->concat($recentRentals)
            ->concat($recentVisits)
            ->concat($recentConsultations)
            ->sortByDesc('timestamp')
            ->take(50);

        // System metrics
        $systemMetrics = [
            'php_version' => PHP_VERSION,
            'laravel_version' => app()->version(),
            'memory_usage' => round(memory_get_usage() / 1024 / 1024, 2) . ' MB',
            'peak_memory' => round(memory_get_peak_usage() / 1024 / 1024, 2) . ' MB',
            'server_time' => now()->format('Y-m-d H:i:s'),
            'timezone' => config('app.timezone'),
            'environment' => config('app.env')
        ];

        return view('admin.super.system-logs', compact(
            'recentActivities',
            'systemMetrics'
        ));
    }

    private function getStorageUsage(): string
    {
        $storagePath = storage_path();
        if (is_dir($storagePath)) {
            $size = $this->getFolderSize($storagePath);
            return round($size / 1024 / 1024, 2) . ' MB';
        }
        return 'Unknown';
    }

    private function getFolderSize(string $dir): int
    {
        $size = 0;
        if (is_dir($dir)) {
            $files = scandir($dir);
            foreach ($files as $file) {
                if ($file !== '.' && $file !== '..') {
                    $path = $dir . DIRECTORY_SEPARATOR . $file;
                    if (is_file($path)) {
                        $size += filesize($path);
                    } elseif (is_dir($path)) {
                        $size += $this->getFolderSize($path);
                    }
                }
            }
        }
        return $size;
    }

    private function getSystemUptime(): string
    {
        // Simple uptime calculation based on Laravel app start
        $startTime = filectime(base_path('vendor/autoload.php'));
        $uptime = time() - $startTime;
        
        $days = floor($uptime / 86400);
        $hours = floor(($uptime % 86400) / 3600);
        $minutes = floor(($uptime % 3600) / 60);
        
        return "{$days}d {$hours}h {$minutes}m";
    }
}