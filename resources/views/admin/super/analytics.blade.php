@extends('layouts.super-admin')

@section('title', 'System Analytics')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-purple-50">
    <div class="p-6 space-y-6">
        <!-- Page Header -->
        <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg border border-white/20 p-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                        📊 System Analytics
                    </h1>
                    <p class="text-gray-600 mt-2">Advanced analytics and insights for system performance</p>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="bg-gradient-to-r from-blue-500 to-purple-500 text-white px-4 py-2 rounded-lg">
                        <span class="text-sm font-medium">Last Updated: {{ now()->format('H:i:s') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Overview Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Request Distribution -->
            <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg border border-white/20 p-6 hover:shadow-xl transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Total Requests</h3>
                        <p class="text-3xl font-bold text-blue-600">{{ array_sum($requestDistribution) }}</p>
                    </div>
                    <div class="bg-blue-100 p-3 rounded-full">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Pending Requests -->
            <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg border border-white/20 p-6 hover:shadow-xl transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Pending</h3>
                        <p class="text-3xl font-bold text-amber-600">{{ $statusDistribution['pending'] }}</p>
                    </div>
                    <div class="bg-amber-100 p-3 rounded-full">
                        <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Approved Requests -->
            <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg border border-white/20 p-6 hover:shadow-xl transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Approved</h3>
                        <p class="text-3xl font-bold text-green-600">{{ $statusDistribution['approved'] }}</p>
                    </div>
                    <div class="bg-green-100 p-3 rounded-full">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Completed Requests -->
            <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg border border-white/20 p-6 hover:shadow-xl transition-all duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Completed</h3>
                        <p class="text-3xl font-bold text-purple-600">{{ $statusDistribution['completed'] }}</p>
                    </div>
                    <div class="bg-purple-100 p-3 rounded-full">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Request Type Distribution Chart -->
            <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg border border-white/20 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-semibold text-gray-800">Request Type Distribution</h3>
                    <div class="text-sm text-gray-500">Total: {{ array_sum($requestDistribution) }}</div>
                </div>
                <div class="relative h-64">
                    <canvas id="requestTypeChart"></canvas>
                </div>
            </div>

            <!-- Status Distribution Chart -->
            <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg border border-white/20 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-semibold text-gray-800">Request Status Distribution</h3>
                    <div class="text-sm text-gray-500">All Requests</div>
                </div>
                <div class="relative h-64">
                    <canvas id="statusChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Monthly Performance Chart -->
        <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg border border-white/20 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-semibold text-gray-800">Monthly Performance Trends</h3>
                <div class="text-sm text-gray-500">Last 12 Months</div>
            </div>
            <div class="relative h-80">
                <canvas id="monthlyChart"></canvas>
            </div>
        </div>

        <!-- Equipment & Computer Utilization -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Equipment Utilization -->
            <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg border border-white/20 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-semibold text-gray-800">Equipment Status</h3>
                    <div class="text-sm text-gray-500">Current Status</div>
                </div>
                <div class="space-y-4">
                    @foreach($equipmentUtilization as $status => $count)
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            @if($status === 'tersedia')
                                <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                                <span class="text-gray-700">Available</span>
                            @elseif($status === 'maintenance')
                                <div class="w-3 h-3 bg-amber-500 rounded-full"></div>
                                <span class="text-gray-700">Maintenance</span>
                            @else
                                <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                                <span class="text-gray-700">{{ ucfirst($status) }}</span>
                            @endif
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="text-gray-900 font-semibold">{{ $count }}</span>
                            <div class="bg-gray-200 w-20 h-2 rounded-full">
                                <div class="h-2 rounded-full {{ $status === 'tersedia' ? 'bg-green-500' : ($status === 'maintenance' ? 'bg-amber-500' : 'bg-red-500') }}" 
                                     style="width: {{ array_sum($equipmentUtilization) > 0 ? ($count / array_sum($equipmentUtilization)) * 100 : 0 }}%"></div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Computer Utilization -->
            <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg border border-white/20 p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-semibold text-gray-800">Computer Status</h3>
                    <div class="text-sm text-gray-500">Current Status</div>
                </div>
                <div class="space-y-4">
                    @foreach($computerUtilization as $status => $count)
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            @if($status === 'available')
                                <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                                <span class="text-gray-700">Available</span>
                            @elseif($status === 'in_use')
                                <div class="w-3 h-3 bg-blue-500 rounded-full"></div>
                                <span class="text-gray-700">In Use</span>
                            @elseif($status === 'maintenance')
                                <div class="w-3 h-3 bg-amber-500 rounded-full"></div>
                                <span class="text-gray-700">Maintenance</span>
                            @else
                                <div class="w-3 h-3 bg-red-500 rounded-full"></div>
                                <span class="text-gray-700">{{ ucfirst($status) }}</span>
                            @endif
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="text-gray-900 font-semibold">{{ $count }}</span>
                            <div class="bg-gray-200 w-20 h-2 rounded-full">
                                <div class="h-2 rounded-full {{ $status === 'available' ? 'bg-green-500' : ($status === 'in_use' ? 'bg-blue-500' : ($status === 'maintenance' ? 'bg-amber-500' : 'bg-red-500')) }}" 
                                     style="width: {{ array_sum($computerUtilization) > 0 ? ($count / array_sum($computerUtilization)) * 100 : 0 }}%"></div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Top Laboratories -->
        <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg border border-white/20 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-semibold text-gray-800">Top Laboratories by Usage</h3>
                <div class="text-sm text-gray-500">Most Active Labs</div>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="text-left py-3 px-4 font-medium text-gray-700">Laboratory</th>
                            <th class="text-center py-3 px-4 font-medium text-gray-700">Simulations</th>
                            <th class="text-center py-3 px-4 font-medium text-gray-700">Visits</th>
                            <th class="text-center py-3 px-4 font-medium text-gray-700">Consultations</th>
                            <th class="text-center py-3 px-4 font-medium text-gray-700">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($topLaboratories as $lab)
                        <tr class="border-b border-gray-100 hover:bg-gray-50">
                            <td class="py-3 px-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-500 rounded-lg flex items-center justify-center text-white text-xs font-bold">
                                        {{ substr($lab->name, 0, 1) }}
                                    </div>
                                    <span class="font-medium text-gray-900">{{ $lab->name }}</span>
                                </div>
                            </td>
                            <td class="text-center py-3 px-4">
                                <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs font-medium">
                                    {{ $lab->rentals_count }}
                                </span>
                            </td>
                            <td class="text-center py-3 px-4">
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs font-medium">
                                    {{ $lab->visits_count }}
                                </span>
                            </td>
                            <td class="text-center py-3 px-4">
                                <span class="bg-purple-100 text-purple-800 px-2 py-1 rounded-full text-xs font-medium">
                                    {{ $lab->tests_count }}
                                </span>
                            </td>
                            <td class="text-center py-3 px-4">
                                <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded-full text-xs font-bold">
                                    {{ $lab->rentals_count + $lab->visits_count + $lab->tests_count }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// Request Type Distribution Chart
const requestTypeCtx = document.getElementById('requestTypeChart').getContext('2d');
new Chart(requestTypeCtx, {
    type: 'doughnut',
    data: {
        labels: ['Simulations', 'Lab Access', 'Consultations'],
        datasets: [{
            data: [{{ $requestDistribution['simulations'] }}, {{ $requestDistribution['visits'] }}, {{ $requestDistribution['consultations'] }}],
            backgroundColor: [
                '#3B82F6',
                '#10B981',
                '#8B5CF6'
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
                    usePointStyle: true
                }
            }
        }
    }
});

// Status Distribution Chart
const statusCtx = document.getElementById('statusChart').getContext('2d');
new Chart(statusCtx, {
    type: 'pie',
    data: {
        labels: ['Pending', 'Approved', 'Completed', 'Rejected'],
        datasets: [{
            data: [{{ $statusDistribution['pending'] }}, {{ $statusDistribution['approved'] }}, {{ $statusDistribution['completed'] }}, {{ $statusDistribution['rejected'] }}],
            backgroundColor: [
                '#F59E0B',
                '#10B981',
                '#8B5CF6',
                '#EF4444'
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
                    usePointStyle: true
                }
            }
        }
    }
});

// Monthly Performance Chart
const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
new Chart(monthlyCtx, {
    type: 'line',
    data: {
        labels: {!! json_encode(array_column($monthlyPerformance, 'month')) !!},
        datasets: [{
            label: 'New Users',
            data: {!! json_encode(array_column($monthlyPerformance, 'users')) !!},
            borderColor: '#3B82F6',
            backgroundColor: 'rgba(59, 130, 246, 0.1)',
            tension: 0.4,
            fill: true
        }, {
            label: 'Total Requests',
            data: {!! json_encode(array_column($monthlyPerformance, 'requests')) !!},
            borderColor: '#10B981',
            backgroundColor: 'rgba(16, 185, 129, 0.1)',
            tension: 0.4,
            fill: true
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        interaction: {
            intersect: false,
            mode: 'index'
        },
        plugins: {
            legend: {
                position: 'top',
                labels: {
                    usePointStyle: true,
                    padding: 20
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                grid: {
                    color: 'rgba(0, 0, 0, 0.1)'
                }
            },
            x: {
                grid: {
                    color: 'rgba(0, 0, 0, 0.1)'
                }
            }
        }
    }
});
</script>
@endpush
@endsection
 