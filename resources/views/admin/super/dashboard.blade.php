@extends('layouts.super-admin')

@section('title', 'Super Admin Dashboard')
@section('page-title', 'Dashboard Overview')
@section('breadcrumb', 'Super Admin / Dashboard')

@push('styles')
<style>
    /* Modern Card Styles */
    .modern-stat-card {
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(226, 232, 240, 0.8);
    }
    
    .modern-stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #3b82f6, #8b5cf6, #10b981);
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }
    
    .modern-stat-card:hover::before {
        transform: scaleX(1);
    }
    
    .modern-stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        border-color: rgba(59, 130, 246, 0.3);
    }
    
    .chart-container {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(15px);
        border: 1px solid rgba(226, 232, 240, 0.6);
    }
    
    .activity-item {
        background: rgba(255, 255, 255, 0.6);
        border-left: 3px solid transparent;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }
    
    .activity-item:hover {
        background: rgba(255, 255, 255, 0.9);
        border-left-color: #3b82f6;
        transform: translateX(4px);
    }
    
    .metric-badge {
        display: inline-flex;
        align-items: center;
        padding: 0.375rem 0.875rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
        backdrop-filter: blur(10px);
    }
    
    .metric-badge.success {
        background: rgba(16, 185, 129, 0.1);
        color: #047857;
        border: 1px solid rgba(16, 185, 129, 0.2);
    }
    
    .metric-badge.warning {
        background: rgba(245, 158, 11, 0.1);
        color: #d97706;
        border: 1px solid rgba(245, 158, 11, 0.2);
    }
    
    .metric-badge.primary {
        background: rgba(59, 130, 246, 0.1);
        color: #1d4ed8;
        border: 1px solid rgba(59, 130, 246, 0.2);
    }
    
    .progress-bar {
        background: rgba(226, 232, 240, 0.6);
        overflow: hidden;
        border-radius: 9999px;
        height: 0.5rem;
    }
    
    .progress-fill {
        height: 100%;
        border-radius: 9999px;
        transition: width 0.3s ease;
    }
    
    .icon-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 3rem;
        height: 3rem;
        border-radius: 1rem;
        background: linear-gradient(135deg, var(--tw-gradient-from), var(--tw-gradient-to));
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }
    
    .real-time-badge {
        background: linear-gradient(135deg, #10b981, #34d399);
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 9999px;
        font-size: 0.75rem;
        font-weight: 600;
        animation: pulse-soft 2s ease-in-out infinite;
    }
    
    .welcome-card {
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(139, 92, 246, 0.1));
        border: 2px solid rgba(59, 130, 246, 0.2);
        backdrop-filter: blur(20px);
    }
</style>
@endpush

@section('content')
<div class="space-y-8 animate-fade-in">
    <!-- Welcome Section -->
    <div class="welcome-card rounded-2xl p-8 shadow-colored">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between space-y-4 lg:space-y-0">
            <div>
                <div class="flex flex-wrap items-center gap-3 mb-4">
                    <div class="gradient-primary text-white px-4 py-2 rounded-xl text-sm font-bold flex items-center shadow-colored">
                        <i class="fas fa-crown mr-2"></i>
                        Super Administrator
                    </div>
                    <div class="bg-success-100 border border-success-200 text-success-700 px-3 py-2 rounded-xl text-xs font-medium">
                        <i class="fas fa-shield-check mr-1"></i>
                        Full System Access
                    </div>
                    <div class="real-time-badge">
                        <i class="fas fa-circle mr-1 text-xs"></i>
                        Online
                    </div>
                </div>
                <h1 class="text-3xl font-bold font-display text-gray-800 mb-2">
                    Welcome back, <span class="text-primary-600">{{ Auth::user()->name }}</span>
                </h1>
                <p class="text-gray-600 flex items-center">
                    <i class="fas fa-clock mr-2 text-primary-500"></i>
                    System operational • Last activity: {{ Auth::user()->updated_at->diffForHumans() }}
                </p>
            </div>
            <div class="flex items-center space-x-6">
                <div class="text-center">
                    <div class="text-sm text-gray-500 font-medium">Current Time</div>
                    <div class="text-2xl font-bold font-display text-gray-800" id="current-time"></div>
                    <div class="text-xs text-gray-500" id="current-date"></div>
                </div>
                <div class="w-20 h-20 rounded-2xl gradient-primary flex items-center justify-center shadow-colored animate-bounce-gentle">
                    <i class="fas fa-crown text-white text-3xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Users -->
        <div class="modern-stat-card rounded-xl p-6 shadow-soft">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Total Users</p>
                    <p class="text-3xl font-bold font-display text-gray-800 mt-2">{{ number_format($totalUsers) }}</p>
                    <div class="mt-3">
                        <span class="metric-badge success">
                            <i class="fas fa-user-shield mr-1"></i>
                            {{ $totalAdmins }} Admins
                        </span>
                    </div>
                </div>
                <div class="icon-wrapper" style="--tw-gradient-from: #3b82f6; --tw-gradient-to: #8b5cf6;">
                    <i class="fas fa-users text-white text-xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <div class="progress-bar">
                    <div class="progress-fill bg-gradient-to-r from-primary-500 to-purple-500" style="width: {{ ($totalAdmins / $totalUsers) * 100 }}%"></div>
                </div>
                <div class="flex justify-between text-xs text-gray-500 mt-1">
                    <span>Admin Ratio</span>
                    <span>{{ round(($totalAdmins / $totalUsers) * 100) }}%</span>
                </div>
            </div>
        </div>

        <!-- System Requests -->
        <div class="modern-stat-card rounded-xl p-6 shadow-soft">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Total Requests</p>
                    <p class="text-3xl font-bold font-display text-gray-800 mt-2">{{ number_format($totalSimulations + $totalVisits + $totalConsultations) }}</p>
                    <div class="mt-3">
                        <span class="metric-badge warning">
                            <i class="fas fa-clock mr-1"></i>
                            {{ $pendingSimulations + $pendingVisits + $pendingConsultations }} Pending
                        </span>
                    </div>
                </div>
                <div class="icon-wrapper" style="--tw-gradient-from: #8b5cf6; --tw-gradient-to: #c084fc;">
                    <i class="fas fa-clipboard-list text-white text-xl"></i>
                </div>
            </div>
            <div class="mt-4 space-y-2">
                <div class="flex justify-between text-xs">
                    <span class="text-gray-600">Simulations</span>
                    <span class="font-medium text-gray-800">{{ $totalSimulations }}</span>
                </div>
                <div class="flex justify-between text-xs">
                    <span class="text-gray-600">Lab Access</span>
                    <span class="font-medium text-gray-800">{{ $totalVisits }}</span>
                </div>
                <div class="flex justify-between text-xs">
                    <span class="text-gray-600">Consultations</span>
                    <span class="font-medium text-gray-800">{{ $totalConsultations }}</span>
                </div>
            </div>
        </div>

        <!-- Equipment Status -->
        <div class="modern-stat-card rounded-xl p-6 shadow-soft">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Equipment</p>
                    <p class="text-3xl font-bold font-display text-gray-800 mt-2">{{ number_format($totalEquipment) }}</p>
                    <div class="mt-3">
                        <span class="metric-badge success">
                            <i class="fas fa-check-circle mr-1"></i>
                            {{ $workingEquipment }} Active
                        </span>
                        @if($maintenanceEquipment > 0)
                            <span class="metric-badge warning ml-2">
                                <i class="fas fa-tools mr-1"></i>
                                {{ $maintenanceEquipment }} Maintenance
                            </span>
                        @endif
                    </div>
                </div>
                <div class="icon-wrapper" style="--tw-gradient-from: #10b981; --tw-gradient-to: #34d399;">
                    <i class="fas fa-desktop text-white text-xl"></i>
                </div>
            </div>
            <div class="mt-4">
                <div class="progress-bar">
                    <div class="progress-fill bg-gradient-to-r from-success-500 to-success-400" style="width: {{ ($workingEquipment / $totalEquipment) * 100 }}%"></div>
                </div>
                <div class="flex justify-between text-xs text-gray-500 mt-1">
                    <span>Operational</span>
                    <span>{{ round(($workingEquipment / $totalEquipment) * 100) }}%</span>
                </div>
            </div>
        </div>

        <!-- Computer Workstations -->
        <div class="modern-stat-card rounded-xl p-6 shadow-soft">
            <div class="flex items-start justify-between">
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-500 uppercase tracking-wide">Computers</p>
                    <p class="text-3xl font-bold font-display text-gray-800 mt-2">{{ number_format($totalComputers) }}</p>
                    <div class="mt-3">
                        <span class="metric-badge primary">
                            <i class="fas fa-circle mr-1"></i>
                            {{ $availableComputers }} Available
                        </span>
                    </div>
                </div>
                <div class="icon-wrapper" style="--tw-gradient-from: #f59e0b; --tw-gradient-to: #fbbf24;">
                    <i class="fas fa-computer text-white text-xl"></i>
                </div>
            </div>
            <div class="mt-4 grid grid-cols-3 gap-2 text-xs">
                <div class="text-center">
                    <div class="font-bold text-gray-800">{{ $availableComputers }}</div>
                    <div class="text-gray-500">Available</div>
                </div>
                <div class="text-center">
                    <div class="font-bold text-gray-800">{{ $usedComputers }}</div>
                    <div class="text-gray-500">In Use</div>
                </div>
                <div class="text-center">
                    <div class="font-bold text-gray-800">{{ $maintenanceComputers }}</div>
                    <div class="text-gray-500">Maintenance</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Analytics Charts -->
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">
        <!-- User Registration Trends -->
        <div class="glass-white rounded-xl p-6 shadow-large">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-xl font-bold font-display text-gray-800">User Registration Trends</h3>
                    <p class="text-sm text-gray-500 mt-1">Monthly user growth analysis</p>
                </div>
                <div class="real-time-badge">
                    <i class="fas fa-chart-line mr-1"></i>
                    Live Data
                </div>
            </div>
            <div class="chart-container rounded-xl p-4 shadow-soft">
                <canvas id="userChart" width="400" height="200"></canvas>
            </div>
        </div>

        <!-- Request Distribution -->
        <div class="glass-white rounded-xl p-6 shadow-large">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-xl font-bold font-display text-gray-800">Request Distribution</h3>
                    <p class="text-sm text-gray-500 mt-1">Service usage breakdown</p>
                </div>
                <div class="real-time-badge">
                    <i class="fas fa-pie-chart mr-1"></i>
                    Analytics
                </div>
            </div>
            <div class="chart-container rounded-xl p-4 shadow-soft">
                <canvas id="requestChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>

    <!-- System Status & Activities -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Recent Activities -->
        <div class="lg:col-span-2">
            <div class="glass-white rounded-xl p-6 shadow-large">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-xl font-bold font-display text-gray-800">Recent Activities</h3>
                        <p class="text-sm text-gray-500 mt-1">Latest system events and user actions</p>
                    </div>
                    <button class="btn-modern bg-primary-50 text-primary-700 px-4 py-2 rounded-lg text-sm font-medium hover:bg-primary-100 shadow-soft">
                        <i class="fas fa-external-link-alt mr-2"></i>
                        View All
                    </button>
                </div>
                
                <div class="space-y-3">
                    @foreach($recentUsers->take(5) as $user)
                    <div class="activity-item rounded-lg p-4">
                        <div class="flex items-center space-x-4">
                            <div class="w-10 h-10 rounded-xl gradient-primary flex items-center justify-center shadow-soft">
                                <span class="text-white text-sm font-bold">{{ substr($user->name, 0, 1) }}</span>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h4 class="font-semibold text-gray-800">{{ $user->name }}</h4>
                                        <p class="text-sm text-gray-500">New user registration</p>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-sm font-medium text-gray-700">{{ $user->created_at->format('H:i') }}</div>
                                        <div class="text-xs text-gray-500">{{ $user->created_at->format('M d') }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="metric-badge primary">{{ ucfirst($user->role) }}</span>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    
                    @if($recentUsers->count() == 0)
                    <div class="text-center py-8">
                        <i class="fas fa-inbox text-4xl text-gray-300 mb-4"></i>
                        <p class="text-gray-500">No recent activities</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- System Health -->
        <div class="glass-white rounded-xl p-6 shadow-large">
            <div class="mb-6">
                <h3 class="text-xl font-bold font-display text-gray-800 mb-2">System Health</h3>
                <p class="text-sm text-gray-500">Real-time monitoring dashboard</p>
            </div>
            
            <!-- System Status -->
            <div class="space-y-4">
                <div class="bg-gray-50 rounded-xl p-4">
                    <div class="flex items-center justify-between mb-3">
                        <span class="text-sm font-medium text-gray-700">System Status</span>
                        <div class="w-3 h-3 bg-success-500 rounded-full status-dot"></div>
                    </div>
                    <div class="text-xs text-success-600 font-medium">All systems operational</div>
                </div>

                <!-- Active Sessions -->
                <div class="bg-gray-50 rounded-xl p-4">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm font-medium text-gray-700">Active Sessions</span>
                        <span class="text-xs text-warning-600 font-medium">{{ $totalUsers }} users</span>
                    </div>
                    <div class="grid grid-cols-2 gap-2 text-xs">
                        <div class="text-center">
                            <div class="font-bold text-gray-800">{{ $totalAdmins }}</div>
                            <div class="text-gray-500">Admins</div>
                        </div>
                        <div class="text-center">
                            <div class="font-bold text-gray-800">{{ $totalStaff }}</div>
                            <div class="text-gray-500">Staff</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="mt-6 pt-6 border-t border-gray-200">
                <h4 class="text-sm font-semibold text-gray-700 mb-3">Quick Actions</h4>
                <div class="space-y-2">
                    <button class="w-full text-left bg-primary-50 hover:bg-primary-100 text-primary-700 p-3 rounded-lg text-sm font-medium transition-colors">
                        <i class="fas fa-plus-circle mr-2"></i>
                        Add New User
                    </button>
                    <button class="w-full text-left bg-success-50 hover:bg-success-100 text-success-700 p-3 rounded-lg text-sm font-medium transition-colors">
                        <i class="fas fa-download mr-2"></i>
                        Export Reports
                    </button>
                    <button class="w-full text-left bg-warning-50 hover:bg-warning-100 text-warning-700 p-3 rounded-lg text-sm font-medium transition-colors">
                        <i class="fas fa-cog mr-2"></i>
                        System Settings
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Update time display
    function updateTime() {
        const now = new Date();
        const timeElement = document.getElementById('current-time');
        const dateElement = document.getElementById('current-date');
        
        if (timeElement) {
            timeElement.textContent = now.toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });
        }
        
        if (dateElement) {
            dateElement.textContent = now.toLocaleDateString('id-ID', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });
        }
    }
    
    updateTime();
    setInterval(updateTime, 1000);

    // User Registration Chart
    const userCtx = document.getElementById('userChart').getContext('2d');
    const userChart = new Chart(userCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'New Users',
                data: [@for($i = 1; $i <= 12; $i++) {{ $monthlyUsers[$i] ?? 0 }}{{ $i < 12 ? ',' : '' }} @endfor],
                borderColor: '#3b82f6',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#3b82f6',
                pointBorderColor: '#ffffff',
                pointBorderWidth: 2,
                pointRadius: 6,
                pointHoverRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(226, 232, 240, 0.5)'
                    },
                    ticks: {
                        color: '#64748b'
                    }
                },
                x: {
                    grid: {
                        color: 'rgba(226, 232, 240, 0.5)'
                    },
                    ticks: {
                        color: '#64748b'
                    }
                }
            }
        }
    });

    // Request Distribution Chart
    const requestCtx = document.getElementById('requestChart').getContext('2d');
    const requestChart = new Chart(requestCtx, {
        type: 'doughnut',
        data: {
            labels: ['Simulations', 'Lab Access', 'Consultations'],
            datasets: [{
                data: [{{ $totalSimulations }}, {{ $totalVisits }}, {{ $totalConsultations }}],
                backgroundColor: [
                    '#3b82f6',
                    '#8b5cf6', 
                    '#10b981'
                ],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 20,
                        usePointStyle: true,
                        color: '#64748b'
                    }
                }
            }
        }
    });
});
</script>
@endpush 