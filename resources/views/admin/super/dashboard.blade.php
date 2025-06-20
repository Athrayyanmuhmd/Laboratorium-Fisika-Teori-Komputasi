@extends('layouts.super-admin')

@section('title', 'Super Admin Dashboard')
@section('page-title', 'Command Center Analytics')
@section('breadcrumb', 'Super Admin / Analytics Dashboard')

@push('styles')
<style>
    /* Additional custom styles for dashboard */
    .stat-card {
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, #3b82f6, #8b5cf6, #10b981);
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }
    
    .stat-card:hover::before {
        transform: scaleX(1);
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    }
    
    .cyber-border {
        border: 1px solid;
        border-image: linear-gradient(45deg, #3b82f6, #8b5cf6, #10b981, #3b82f6) 1;
        animation: borderFlow 3s linear infinite;
    }
    
    @keyframes borderFlow {
        0% { border-image-source: linear-gradient(45deg, #3b82f6, #8b5cf6, #10b981, #3b82f6); }
        25% { border-image-source: linear-gradient(45deg, #8b5cf6, #10b981, #3b82f6, #8b5cf6); }
        50% { border-image-source: linear-gradient(45deg, #10b981, #3b82f6, #8b5cf6, #10b981); }
        75% { border-image-source: linear-gradient(45deg, #3b82f6, #8b5cf6, #10b981, #3b82f6); }
        100% { border-image-source: linear-gradient(45deg, #8b5cf6, #10b981, #3b82f6, #8b5cf6); }
    }
    
    .chart-container {
        background: rgba(30, 41, 59, 0.4);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(59, 130, 246, 0.2);
    }
    
    .activity-item {
        background: rgba(30, 41, 59, 0.3);
        border-left: 3px solid transparent;
        transition: all 0.3s ease;
    }
    
    .activity-item:hover {
        background: rgba(30, 41, 59, 0.6);
        border-left-color: #3b82f6;
    }
    
    .pulse-dot {
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.5; }
    }
</style>
@endpush

@section('content')
<div class="space-y-6 animate-fade-in">
    <!-- Welcome Section -->
    <div class="glass-card rounded-2xl p-6 cyber-border">
        <div class="flex items-center justify-between">
            <div>
                <div class="flex items-center space-x-3 mb-3">
                    <div class="bg-gradient-to-r from-purple-500 to-pink-500 text-white px-4 py-2 rounded-full text-sm font-bold flex items-center">
                        <i class="fas fa-crown mr-2"></i>
                        SUPER ADMINISTRATOR
                    </div>
                    <div class="bg-green-500/20 border border-green-400/30 text-green-300 px-3 py-1 rounded-full text-xs font-medium">
                        <i class="fas fa-shield-check mr-1"></i>
                        Full System Access
                    </div>
                </div>
                <h1 class="text-2xl font-bold text-white mb-2">
                    Welcome back, <span class="gradient-text">{{ Auth::user()->name }}</span>
                </h1>
                <p class="text-gray-400 terminal-text">
                    System operational • Last login: {{ Auth::user()->updated_at->diffForHumans() }}
                </p>
            </div>
            <div class="hidden lg:flex items-center space-x-4">
                <div class="text-right">
                    <div class="text-sm text-gray-400">Current Time</div>
                    <div class="text-lg font-mono text-neon-400" id="current-time"></div>
                </div>
                <div class="w-16 h-16 rounded-2xl bg-gradient-to-r from-electric-500 to-purple-500 flex items-center justify-center">
                    <i class="fas fa-crown text-white text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- System Overview Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Users -->
        <div class="stat-card glass-card rounded-xl p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-400 uppercase tracking-wide">Total Users</p>
                    <p class="text-3xl font-bold text-white mt-2">{{ $totalUsers }}</p>
                    <div class="flex items-center mt-2 text-xs">
                        <span class="text-neon-400">↗ +{{ $totalUsers - $totalRegularUsers }} admins</span>
                    </div>
                </div>
                <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-electric-500 to-electric-600 flex items-center justify-center">
                    <i class="fas fa-users text-white"></i>
                </div>
            </div>
        </div>

        <!-- System Requests -->
        <div class="stat-card glass-card rounded-xl p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-400 uppercase tracking-wide">Total Requests</p>
                    <p class="text-3xl font-bold text-white mt-2">{{ $totalSimulations + $totalVisits + $totalConsultations }}</p>
                    <div class="flex items-center mt-2 text-xs">
                        <span class="text-yellow-400">⏳ {{ $pendingSimulations + $pendingVisits + $pendingConsultations }} pending</span>
                    </div>
                </div>
                <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-purple-500 to-purple-600 flex items-center justify-center">
                    <i class="fas fa-clipboard-list text-white"></i>
                </div>
            </div>
        </div>

        <!-- Equipment Status -->
        <div class="stat-card glass-card rounded-xl p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-400 uppercase tracking-wide">Equipment</p>
                    <p class="text-3xl font-bold text-white mt-2">{{ $totalEquipment }}</p>
                    <div class="flex items-center mt-2 text-xs">
                        <span class="text-neon-400">✓ {{ $workingEquipment }} active</span>
                        @if($maintenanceEquipment > 0)
                            <span class="text-red-400 ml-2">⚠ {{ $maintenanceEquipment }} maintenance</span>
                        @endif
                    </div>
                </div>
                <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-neon-500 to-neon-600 flex items-center justify-center">
                    <i class="fas fa-desktop text-white"></i>
                </div>
            </div>
        </div>

        <!-- Laboratories -->
        <div class="stat-card glass-card rounded-xl p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-400 uppercase tracking-wide">Laboratories</p>
                    <p class="text-3xl font-bold text-white mt-2">{{ $totalLaboratories }}</p>
                    <div class="flex items-center mt-2 text-xs">
                        <span class="text-neon-400">✓ {{ $activeLaboratories }} active</span>
                    </div>
                </div>
                <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-electric-500 to-purple-500 flex items-center justify-center">
                    <i class="fas fa-flask text-white"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts and Analytics -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- User Registration Chart -->
        <div class="glass-card rounded-xl p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-white">User Registration Trends</h3>
                <div class="flex items-center space-x-2">
                    <div class="w-3 h-3 bg-electric-500 rounded-full pulse-dot"></div>
                    <span class="text-xs text-gray-400 terminal-text">LIVE DATA</span>
                </div>
            </div>
            <div class="chart-container rounded-xl p-4">
                <canvas id="userChart" width="400" height="200"></canvas>
            </div>
        </div>

        <!-- Request Types Chart -->
        <div class="glass-card rounded-xl p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-lg font-semibold text-white">Request Distribution</h3>
                <div class="flex items-center space-x-2">
                    <div class="w-3 h-3 bg-purple-500 rounded-full pulse-dot"></div>
                    <span class="text-xs text-gray-400 terminal-text">REAL TIME</span>
                </div>
            </div>
            <div class="chart-container rounded-xl p-4">
                <canvas id="requestChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>

    <!-- Detailed Analytics and Recent Activities -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Request Status Breakdown -->
        <div class="glass-card rounded-xl p-6">
            <h3 class="text-lg font-semibold text-white mb-6">Request Status</h3>
            <div class="space-y-4">
                <!-- Simulations -->
                <div class="bg-dark-800 rounded-lg p-4">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm text-gray-300">Simulations</span>
                        <span class="text-sm font-mono text-electric-400">{{ $totalSimulations }}</span>
                    </div>
                    <div class="w-full bg-dark-700 rounded-full h-2">
                        <div class="bg-gradient-to-r from-electric-500 to-electric-600 h-2 rounded-full" 
                             style="width: {{ $totalSimulations > 0 ? ($approvedSimulations / $totalSimulations * 100) : 0 }}%"></div>
                    </div>
                    <div class="flex justify-between text-xs text-gray-400 mt-1">
                        <span>{{ $pendingSimulations }} pending</span>
                        <span>{{ $approvedSimulations }} approved</span>
                    </div>
                </div>

                <!-- Lab Access -->
                <div class="bg-dark-800 rounded-lg p-4">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm text-gray-300">Lab Access</span>
                        <span class="text-sm font-mono text-purple-400">{{ $totalVisits }}</span>
                    </div>
                    <div class="w-full bg-dark-700 rounded-full h-2">
                        <div class="bg-gradient-to-r from-purple-500 to-purple-600 h-2 rounded-full" 
                             style="width: {{ $totalVisits > 0 ? ($approvedVisits / $totalVisits * 100) : 0 }}%"></div>
                    </div>
                    <div class="flex justify-between text-xs text-gray-400 mt-1">
                        <span>{{ $pendingVisits }} pending</span>
                        <span>{{ $approvedVisits }} approved</span>
                    </div>
                </div>

                <!-- Consultations -->
                <div class="bg-dark-800 rounded-lg p-4">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm text-gray-300">Consultations</span>
                        <span class="text-sm font-mono text-neon-400">{{ $totalConsultations }}</span>
                    </div>
                    <div class="w-full bg-dark-700 rounded-full h-2">
                        <div class="bg-gradient-to-r from-neon-500 to-neon-600 h-2 rounded-full" 
                             style="width: {{ $totalConsultations > 0 ? ($approvedConsultations / $totalConsultations * 100) : 0 }}%"></div>
                    </div>
                    <div class="flex justify-between text-xs text-gray-400 mt-1">
                        <span>{{ $pendingConsultations }} pending</span>
                        <span>{{ $approvedConsultations }} approved</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Users -->
        <div class="glass-card rounded-xl p-6">
            <h3 class="text-lg font-semibold text-white mb-6">Recent Users</h3>
            <div class="space-y-3 max-h-96 overflow-y-auto">
                @forelse($recentUsers as $user)
                <div class="activity-item rounded-lg p-3">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 rounded-lg bg-gradient-to-r from-electric-500 to-purple-500 flex items-center justify-center text-white text-xs font-bold">
                            {{ substr($user->name, 0, 1) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-medium text-white truncate">{{ $user->name }}</p>
                            <p class="text-xs text-gray-400">{{ ucfirst(str_replace('_', ' ', $user->role)) }}</p>
                        </div>
                        <div class="text-xs text-gray-500">
                            {{ $user->created_at->diffForHumans() }}
                        </div>
                    </div>
                </div>
                @empty
                <div class="text-center text-gray-400 py-8">
                    <i class="fas fa-users text-3xl mb-3"></i>
                    <p>No recent users</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Recent Activities -->
        <div class="glass-card rounded-xl p-6">
            <h3 class="text-lg font-semibold text-white mb-6">Recent Activities</h3>
            <div class="space-y-3 max-h-96 overflow-y-auto">
                <!-- Recent Simulations -->
                @foreach($recentSimulations->take(3) as $simulation)
                <div class="activity-item rounded-lg p-3">
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 rounded-lg bg-electric-500 flex items-center justify-center">
                            <i class="fas fa-calculator text-white text-xs"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm text-white">New simulation request</p>
                            <p class="text-xs text-gray-400 truncate">{{ $simulation->purpose ?? 'Purpose not specified' }}</p>
                            <p class="text-xs text-gray-500">{{ $simulation->created_at->diffForHumans() }}</p>
                        </div>
                        <span class="px-2 py-1 rounded text-xs {{ $simulation->status === 'pending' ? 'bg-yellow-500/20 text-yellow-400' : 'bg-green-500/20 text-green-400' }}">
                            {{ $simulation->status }}
                        </span>
                    </div>
                </div>
                @endforeach

                <!-- Recent Visits -->
                @foreach($recentVisits->take(2) as $visit)
                <div class="activity-item rounded-lg p-3">
                    <div class="flex items-start space-x-3">
                        <div class="w-8 h-8 rounded-lg bg-purple-500 flex items-center justify-center">
                            <i class="fas fa-door-open text-white text-xs"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm text-white">Lab access request</p>
                            <p class="text-xs text-gray-400 truncate">{{ $visit->visitor_name }}</p>
                            <p class="text-xs text-gray-500">{{ $visit->created_at->diffForHumans() }}</p>
                        </div>
                        <span class="px-2 py-1 rounded text-xs {{ $visit->status === 'pending' ? 'bg-yellow-500/20 text-yellow-400' : 'bg-green-500/20 text-green-400' }}">
                            {{ $visit->status }}
                        </span>
                    </div>
                </div>
                @endforeach

                @if($recentSimulations->count() === 0 && $recentVisits->count() === 0)
                <div class="text-center text-gray-400 py-8">
                    <i class="fas fa-activity text-3xl mb-3"></i>
                    <p>No recent activities</p>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="glass-card rounded-xl p-6">
        <h3 class="text-lg font-semibold text-white mb-6">Quick Actions</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="{{ route('super-admin.users.index') }}" 
               class="group bg-gradient-to-r from-electric-500 to-electric-600 rounded-xl p-4 text-center hover:from-electric-600 hover:to-electric-700 transition-all duration-300 transform hover:scale-105">
                <i class="fas fa-users-cog text-white text-2xl mb-2 group-hover:animate-pulse"></i>
                <p class="text-white font-medium">Manage Users</p>
            </a>
            
            <a href="{{ route('super-admin.staff.index') }}" 
               class="group bg-gradient-to-r from-purple-500 to-purple-600 rounded-xl p-4 text-center hover:from-purple-600 hover:to-purple-700 transition-all duration-300 transform hover:scale-105">
                <i class="fas fa-user-tie text-white text-2xl mb-2 group-hover:animate-pulse"></i>
                <p class="text-white font-medium">Manage Staff</p>
            </a>
            
            <a href="{{ route('super-admin.gallery.index') }}" 
               class="group bg-gradient-to-r from-neon-500 to-neon-600 rounded-xl p-4 text-center hover:from-neon-600 hover:to-neon-700 transition-all duration-300 transform hover:scale-105">
                <i class="fas fa-images text-white text-2xl mb-2 group-hover:animate-pulse"></i>
                <p class="text-white font-medium">Gallery</p>
            </a>
            
            <a href="{{ route('admin.dashboard') }}" 
               class="group bg-gradient-to-r from-gray-600 to-gray-700 rounded-xl p-4 text-center hover:from-gray-700 hover:to-gray-800 transition-all duration-300 transform hover:scale-105">
                <i class="fas fa-external-link-alt text-white text-2xl mb-2 group-hover:animate-pulse"></i>
                <p class="text-white font-medium">Admin Panel</p>
            </a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Real-time clock
    function updateTime() {
        const now = new Date();
        const timeString = now.toLocaleTimeString('en-US', { 
            hour12: false,
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit'
        });
        const timeElement = document.getElementById('current-time');
        if (timeElement) {
            timeElement.textContent = timeString;
        }
    }
    
    updateTime();
    setInterval(updateTime, 1000);
    
    // Charts
    const ctxUser = document.getElementById('userChart').getContext('2d');
    const ctxRequest = document.getElementById('requestChart').getContext('2d');
    
    // User Registration Chart
    new Chart(ctxUser, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'New Users',
                data: [
                    @for($i = 1; $i <= 12; $i++)
                        {{ $monthlyUsers[$i] ?? 0 }}{{ $i < 12 ? ',' : '' }}
                    @endfor
                ],
                borderColor: '#3b82f6',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                borderWidth: 2,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    labels: {
                        color: '#e5e7eb'
                    }
                }
            },
            scales: {
                y: {
                    ticks: {
                        color: '#9ca3af'
                    },
                    grid: {
                        color: 'rgba(59, 130, 246, 0.1)'
                    }
                },
                x: {
                    ticks: {
                        color: '#9ca3af'
                    },
                    grid: {
                        color: 'rgba(59, 130, 246, 0.1)'
                    }
                }
            }
        }
    });
    
    // Request Distribution Chart
    new Chart(ctxRequest, {
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
                borderColor: [
                    '#2563eb',
                    '#7c3aed',
                    '#059669'
                ],
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        color: '#e5e7eb',
                        padding: 20,
                        usePointStyle: true
                    }
                }
            }
        }
    });
});
</script>
@endpush 