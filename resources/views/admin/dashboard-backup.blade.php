@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="space-y-8 animate-fade-in">
    <!-- Header Section with Greeting -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">
                Selamat datang, {{ Auth::user()->name }}! 👋
            </h1>
            <p class="text-gray-600">Laboratorium Fisika Teori dan Komputasi - Dashboard Monitoring</p>
        </div>
        <div class="flex items-center space-x-4">
            <div class="bg-white rounded-xl p-4 shadow-sm">
                <div class="text-sm text-gray-500">Waktu Real-time</div>
                <div class="text-lg font-semibold text-gray-900" id="current-time"></div>
            </div>
        </div>
    </div>

    <!-- Lab Computer Layout Visualization -->
    <div class="bg-white rounded-2xl shadow-lg p-8 card-hover border border-gray-100">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Layout Laboratorium Komputer</h2>
                <p class="text-gray-600">Monitoring real-time 28 unit komputer simulasi fisika</p>
            </div>
            <div class="flex items-center space-x-4">
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-4 py-2 rounded-lg">
                    <div class="text-sm">Utilisasi</div>
                    <div class="text-xl font-bold">{{ $labStats['utilization_rate'] }}%</div>
                </div>
                <button onclick="refreshComputerStatus()" class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-4 py-2 rounded-lg transition-all">
                    <i class="fas fa-sync-alt mr-2"></i>Refresh
                </button>
            </div>
        </div>

        <!-- Computer Grid Layout -->
        <div class="relative">
            <!-- Entrance Arrow -->
            <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 text-center">
                <div class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-medium">
                    <i class="fas fa-arrow-down mr-1"></i>Pintu Masuk
                </div>
            </div>

            <!-- Computer Grid -->
            <div class="grid grid-cols-7 gap-4 p-6 bg-gray-50 rounded-xl border-2 border-dashed border-gray-200">
                @foreach($computers as $computer)
                    <div class="computer-unit relative group cursor-pointer" 
                         data-computer-id="{{ $computer['id'] }}"
                         data-status="{{ $computer['status'] }}"
                         onclick="showComputerDetails({{ json_encode($computer) }})">
                        
                        <!-- Computer Icon -->
                        <div class="computer-icon w-16 h-12 rounded-lg flex items-center justify-center text-white font-semibold text-sm transition-all duration-300 transform group-hover:scale-110
                            @if($computer['status'] === 'available') bg-gradient-to-br from-green-400 to-green-500 shadow-green-200
                            @elseif($computer['status'] === 'in_use') bg-gradient-to-br from-blue-400 to-blue-500 shadow-blue-200
                            @elseif($computer['status'] === 'maintenance') bg-gradient-to-br from-orange-400 to-orange-500 shadow-orange-200
                            @else bg-gradient-to-br from-red-400 to-red-500 shadow-red-200
                            @endif shadow-lg">
                            
                            @if($computer['status'] === 'available')
                                <i class="fas fa-desktop"></i>
                            @elseif($computer['status'] === 'in_use')
                                <i class="fas fa-user-cog"></i>
                            @elseif($computer['status'] === 'maintenance')
                                <i class="fas fa-tools"></i>
                            @else
                                <i class="fas fa-times"></i>
                            @endif
                        </div>
                        
                        <!-- Computer ID -->
                        <div class="text-xs text-center mt-1 font-medium text-gray-700">
                            PC-{{ $computer['id'] }}
                        </div>
                        
                        <!-- Status Indicator -->
                        <div class="absolute -top-1 -right-1 w-4 h-4 rounded-full border-2 border-white
                            @if($computer['status'] === 'available') bg-green-400
                            @elseif($computer['status'] === 'in_use') bg-blue-400 animate-pulse
                            @elseif($computer['status'] === 'maintenance') bg-orange-400
                            @else bg-red-400
                            @endif"></div>

                        <!-- Hover Tooltip -->
                        <div class="absolute bottom-full left-1/2 transform -translate-x-1/2 mb-2 hidden group-hover:block z-10">
                            <div class="bg-gray-900 text-white text-xs rounded-lg px-3 py-2 whitespace-nowrap">
                                <div class="font-semibold">{{ $computer['name'] }}</div>
                                <div class="capitalize">{{ ucfirst(str_replace('_', ' ', $computer['status'])) }}</div>
                                @if($computer['user'])
                                    <div class="text-gray-300">{{ $computer['user'] }}</div>
                                @endif
                                <div class="text-gray-300">Terakhir: {{ $computer['last_used'] }}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Legend -->
            <div class="flex justify-center mt-6">
                <div class="flex items-center space-x-6 bg-white rounded-xl p-4 shadow-sm">
                    <div class="flex items-center space-x-2">
                        <div class="w-4 h-4 bg-gradient-to-br from-green-400 to-green-500 rounded"></div>
                        <span class="text-sm text-gray-700">Tersedia ({{ $labStats['available'] }})</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="w-4 h-4 bg-gradient-to-br from-blue-400 to-blue-500 rounded"></div>
                        <span class="text-sm text-gray-700">Sedang Digunakan ({{ $labStats['in_use'] }})</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="w-4 h-4 bg-gradient-to-br from-orange-400 to-orange-500 rounded"></div>
                        <span class="text-sm text-gray-700">Maintenance ({{ $labStats['maintenance'] }})</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="w-4 h-4 bg-gradient-to-br from-red-400 to-red-500 rounded"></div>
                        <span class="text-sm text-gray-700">Offline ({{ $labStats['offline'] }})</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Equipment -->
        <div class="stat-card blue rounded-2xl p-6 text-white card-hover relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-white bg-opacity-10 rounded-full -translate-y-16 translate-x-16"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100 text-sm font-medium mb-1">Total Peralatan</p>
                        <p class="text-4xl font-bold mb-2">{{ $totalEquipment }}</p>
                        <div class="flex items-center text-blue-200 text-xs">
                            <i class="fas fa-arrow-up mr-1"></i>
                            <span>+12% dari bulan lalu</span>
                        </div>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-2xl p-4">
                        <i class="fas fa-microscope text-3xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Available Equipment -->
        <div class="stat-card green rounded-2xl p-6 text-white card-hover relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-white bg-opacity-10 rounded-full -translate-y-16 translate-x-16"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-100 text-sm font-medium mb-1">Alat Tersedia</p>
                        <p class="text-4xl font-bold mb-2">{{ $availableEquipment }}</p>
                        <div class="flex items-center text-green-200 text-xs">
                            <i class="fas fa-check mr-1"></i>
                            <span>Siap digunakan</span>
                        </div>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-2xl p-4">
                        <i class="fas fa-check-circle text-3xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests -->
        <div class="stat-card orange rounded-2xl p-6 text-white card-hover relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-white bg-opacity-10 rounded-full -translate-y-16 translate-x-16"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-orange-100 text-sm font-medium mb-1">Permintaan Pending</p>
                        <p class="text-4xl font-bold mb-2">{{ $pendingRentals + $pendingVisits + $pendingTests }}</p>
                        <div class="flex items-center text-orange-200 text-xs">
                            <i class="fas fa-clock mr-1"></i>
                            <span>Menunggu persetujuan</span>
                        </div>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-2xl p-4">
                        <i class="fas fa-hourglass-half text-3xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Lab Utilization -->
        <div class="stat-card purple rounded-2xl p-6 text-white card-hover relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-white bg-opacity-10 rounded-full -translate-y-16 translate-x-16"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-purple-100 text-sm font-medium mb-1">Utilisasi Lab</p>
                        <p class="text-4xl font-bold mb-2">{{ $labStats['utilization_rate'] }}%</p>
                        <div class="flex items-center text-purple-200 text-xs">
                            <i class="fas fa-chart-line mr-1"></i>
                            <span>{{ $labStats['in_use'] }}/{{ $labStats['total_computers'] }} PC aktif</span>
                        </div>
                    </div>
                    <div class="bg-white bg-opacity-20 rounded-2xl p-4">
                        <i class="fas fa-desktop text-3xl"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Service Statistics with Enhanced Design -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Rental Statistics -->
        <div class="bg-white rounded-2xl shadow-lg p-8 card-hover border border-gray-100">
            <div class="flex items-center mb-6">
                <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl p-3 mr-4">
                    <i class="fas fa-calculator text-white text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-900">Simulasi & Komputasi</h3>
                    <p class="text-gray-500 text-sm">Penggunaan perangkat simulasi</p>
                </div>
            </div>
            <div class="space-y-4">
                <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                    <span class="text-gray-700 font-medium">Total Permintaan</span>
                    <span class="text-2xl font-bold text-gray-900">{{ $totalRentals }}</span>
                </div>
                <div class="grid grid-cols-3 gap-3">
                    <div class="text-center p-3 bg-yellow-50 rounded-lg">
                        <div class="text-lg font-bold text-yellow-600">{{ $pendingRentals }}</div>
                        <div class="text-xs text-yellow-700">Pending</div>
                    </div>
                    <div class="text-center p-3 bg-green-50 rounded-lg">
                        <div class="text-lg font-bold text-green-600">{{ $activeRentals }}</div>
                        <div class="text-xs text-green-700">Aktif</div>
                    </div>
                    <div class="text-center p-3 bg-blue-50 rounded-lg">
                        <div class="text-lg font-bold text-blue-600">{{ $completedRentals }}</div>
                        <div class="text-xs text-blue-700">Selesai</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Visit Statistics -->
        <div class="bg-white rounded-2xl shadow-lg p-8 card-hover border border-gray-100">
            <div class="flex items-center mb-6">
                <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl p-3 mr-4">
                    <i class="fas fa-door-open text-white text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-900">Akses Laboratorium</h3>
                    <p class="text-gray-500 text-sm">Kunjungan ke laboratorium</p>
                </div>
            </div>
            <div class="space-y-4">
                <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                    <span class="text-gray-700 font-medium">Total Kunjungan</span>
                    <span class="text-2xl font-bold text-gray-900">{{ $totalVisits }}</span>
                </div>
                <div class="grid grid-cols-3 gap-3">
                    <div class="text-center p-3 bg-yellow-50 rounded-lg">
                        <div class="text-lg font-bold text-yellow-600">{{ $pendingVisits }}</div>
                        <div class="text-xs text-yellow-700">Pending</div>
                    </div>
                    <div class="text-center p-3 bg-green-50 rounded-lg">
                        <div class="text-lg font-bold text-green-600">{{ $approvedVisits }}</div>
                        <div class="text-xs text-green-700">Disetujui</div>
                    </div>
                    <div class="text-center p-3 bg-blue-50 rounded-lg">
                        <div class="text-lg font-bold text-blue-600">{{ $completedVisits }}</div>
                        <div class="text-xs text-blue-700">Selesai</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Test Statistics -->
        <div class="bg-white rounded-2xl shadow-lg p-8 card-hover border border-gray-100">
            <div class="flex items-center mb-6">
                <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl p-3 mr-4">
                    <i class="fas fa-user-graduate text-white text-xl"></i>
                </div>
                <div>
                    <h3 class="text-xl font-bold text-gray-900">Konsultasi</h3>
                    <p class="text-gray-500 text-sm">Bimbingan dan konsultasi</p>
                </div>
            </div>
            <div class="space-y-4">
                <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                    <span class="text-gray-700 font-medium">Total Konsultasi</span>
                    <span class="text-2xl font-bold text-gray-900">{{ $totalTests }}</span>
                </div>
                <div class="grid grid-cols-3 gap-3">
                    <div class="text-center p-3 bg-yellow-50 rounded-lg">
                        <div class="text-lg font-bold text-yellow-600">{{ $pendingTests }}</div>
                        <div class="text-xs text-yellow-700">Pending</div>
                    </div>
                    <div class="text-center p-3 bg-orange-50 rounded-lg">
                        <div class="text-lg font-bold text-orange-600">{{ $inProgressTests }}</div>
                        <div class="text-xs text-orange-700">Proses</div>
                    </div>
                    <div class="text-center p-3 bg-blue-50 rounded-lg">
                        <div class="text-lg font-bold text-blue-600">{{ $completedTests }}</div>
                        <div class="text-xs text-blue-700">Selesai</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Charts -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Equipment Chart -->
        <div class="bg-white rounded-2xl shadow-lg p-8 card-hover border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-xl font-bold text-gray-900">Distribusi Peralatan</h3>
                    <p class="text-gray-500 text-sm">Berdasarkan kategori</p>
                </div>
                <div class="bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-xl p-2">
                    <i class="fas fa-chart-pie text-white"></i>
                </div>
            </div>
            <div class="h-64">
                <canvas id="equipmentChart"></canvas>
            </div>
        </div>

        <!-- Monthly Activity Chart -->
        <div class="bg-white rounded-2xl shadow-lg p-8 card-hover border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="text-xl font-bold text-gray-900">Tren Aktivitas</h3>
                    <p class="text-gray-500 text-sm">Permintaan bulanan 2024</p>
                </div>
                <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl p-2">
                    <i class="fas fa-chart-line text-white"></i>
                </div>
            </div>
            <div class="h-64">
                <canvas id="monthlyChart"></canvas>
            </div>
        </div>
    </div>

    <!-- Enhanced Recent Activities -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Recent Rentals -->
        <div class="bg-white rounded-2xl shadow-lg p-8 card-hover border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center">
                    <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl p-2 mr-3">
                        <i class="fas fa-laptop text-white"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900">Simulasi Terbaru</h3>
                        <p class="text-gray-500 text-sm">Aktivitas permintaan terbaru</p>
                    </div>
                </div>
                <a href="{{ route('admin.simulations.index') }}" class="bg-blue-50 hover:bg-blue-100 text-blue-600 px-4 py-2 rounded-lg text-sm font-medium transition-all">
                    Lihat Semua →
                </a>
            </div>
            <div class="space-y-4">
                @forelse($recentRentals->take(4) as $rental)
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-all">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-400 to-blue-500 rounded-lg flex items-center justify-center text-white font-semibold text-sm mr-3">
                                {{ substr($rental->requester_name, 0, 1) }}
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">{{ $rental->requester_name }}</p>
                                <p class="text-sm text-gray-600">{{ $rental->equipment->name ?? 'PC Simulasi' }}</p>
                                <p class="text-xs text-gray-500">{{ $rental->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <div>
                            @if($rental->status === 'pending')
                                <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-medium">Pending</span>
                            @elseif($rental->status === 'approved')
                                <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-medium">Disetujui</span>
                            @else
                                <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-medium">Selesai</span>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <i class="fas fa-laptop text-gray-300 text-4xl mb-3"></i>
                        <p class="text-gray-500">Belum ada permintaan simulasi</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Recent Visits -->
        <div class="bg-white rounded-2xl shadow-lg p-8 card-hover border border-gray-100">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center">
                    <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl p-2 mr-3">
                        <i class="fas fa-users text-white"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-gray-900">Kunjungan Terbaru</h3>
                        <p class="text-gray-500 text-sm">Akses laboratorium terbaru</p>
                    </div>
                </div>
                <a href="{{ route('admin.lab-access.index') }}" class="bg-green-50 hover:bg-green-100 text-green-600 px-4 py-2 rounded-lg text-sm font-medium transition-all">
                    Lihat Semua →
                </a>
            </div>
            <div class="space-y-4">
                @forelse($recentVisits->take(4) as $visit)
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition-all">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-gradient-to-br from-green-400 to-green-500 rounded-lg flex items-center justify-center text-white font-semibold text-sm mr-3">
                                {{ substr($visit->visitor_name, 0, 1) }}
                            </div>
                            <div>
                                <p class="font-semibold text-gray-900">{{ $visit->visitor_name }}</p>
                                <p class="text-sm text-gray-600">{{ Str::limit($visit->purpose, 30) }}</p>
                                <p class="text-xs text-gray-500">{{ $visit->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <div>
                            @if($visit->status === 'pending')
                                <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-medium">Pending</span>
                            @elseif($visit->status === 'approved')
                                <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-medium">Disetujui</span>
                            @else
                                <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-medium">Selesai</span>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <i class="fas fa-users text-gray-300 text-4xl mb-3"></i>
                        <p class="text-gray-500">Belum ada permintaan kunjungan</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Maintenance Alerts with Enhanced Design -->
    @if($upcomingMaintenance->count() > 0)
    <div class="bg-gradient-to-br from-orange-50 to-red-50 rounded-2xl shadow-lg p-8 card-hover border border-orange-200">
        <div class="flex items-center mb-6">
            <div class="bg-gradient-to-br from-orange-500 to-red-500 rounded-xl p-3 mr-4">
                <i class="fas fa-exclamation-triangle text-white text-xl"></i>
            </div>
            <div>
                <h3 class="text-xl font-bold text-gray-900">Peringatan Pemeliharaan</h3>
                <p class="text-gray-600">Peralatan yang memerlukan perhatian segera</p>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($upcomingMaintenance as $maintenance)
                <div class="bg-white border border-orange-200 rounded-xl p-6 shadow-sm hover:shadow-md transition-all">
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="font-bold text-gray-900">{{ $maintenance->equipment->name }}</h4>
                        <span class="px-2 py-1 bg-orange-100 text-orange-700 rounded-lg text-xs font-medium">{{ $maintenance->type }}</span>
                    </div>
                    <p class="text-sm text-gray-600 mb-4">{{ $maintenance->description }}</p>
                    <div class="flex items-center text-orange-600 text-sm">
                        <i class="fas fa-calendar mr-2"></i>
                        <span class="font-medium">{{ $maintenance->scheduled_date->format('d M Y') }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @endif
</div>

<!-- Computer Details Modal -->
<div id="computerModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 transform transition-all">
        <div class="p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-bold text-gray-900" id="modalTitle">Detail Komputer</h3>
                <button onclick="closeComputerModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fas fa-times text-xl"></i>
                </button>
            </div>
            <div id="modalContent">
                <!-- Content will be populated by JavaScript -->
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Real-time clock
    function updateTime() {
        const now = new Date();
        document.getElementById('current-time').textContent = now.toLocaleTimeString('id-ID');
    }
    setInterval(updateTime, 1000);
    updateTime();

    // Computer details modal
    function showComputerDetails(computer) {
        const modal = document.getElementById('computerModal');
        const modalTitle = document.getElementById('modalTitle');
        const modalContent = document.getElementById('modalContent');
        
        modalTitle.textContent = computer.name;
        
        const statusColors = {
            'available': 'green',
            'in_use': 'blue',
            'maintenance': 'orange',
            'offline': 'red'
        };
        
        const statusLabels = {
            'available': 'Tersedia',
            'in_use': 'Sedang Digunakan',
            'maintenance': 'Maintenance',
            'offline': 'Offline'
        };
        
        const color = statusColors[computer.status];
        const label = statusLabels[computer.status];
        
        modalContent.innerHTML = `
            <div class="space-y-4">
                <div class="flex items-center justify-center">
                    <div class="w-24 h-24 bg-gradient-to-br from-${color}-400 to-${color}-500 rounded-2xl flex items-center justify-center text-white text-3xl">
                        <i class="fas fa-desktop"></i>
                    </div>
                </div>
                
                <div class="text-center">
                    <div class="text-2xl font-bold text-gray-900 mb-2">${computer.name}</div>
                    <span class="px-4 py-2 bg-${color}-100 text-${color}-800 rounded-full text-sm font-medium">${label}</span>
                </div>
                
                <div class="space-y-3">
                    <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                        <span class="text-gray-600">Posisi</span>
                        <span class="font-semibold">Baris ${computer.position.row}, Kolom ${computer.position.col}</span>
                    </div>
                    
                    <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                        <span class="text-gray-600">Terakhir Digunakan</span>
                        <span class="font-semibold">${computer.last_used}</span>
                    </div>
                    
                    ${computer.user ? `
                    <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                        <span class="text-gray-600">Pengguna</span>
                        <span class="font-semibold">${computer.user}</span>
                    </div>
                    ` : ''}
                    
                    <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                        <span class="text-gray-600">Jam Operasi Hari Ini</span>
                        <span class="font-semibold">${computer.usage_hours} jam</span>
                    </div>
                </div>
                
                <div class="flex space-x-3 mt-6">
                    <button class="flex-1 bg-gradient-to-r from-blue-500 to-blue-600 text-white py-2 px-4 rounded-lg font-medium hover:from-blue-600 hover:to-blue-700 transition-all">
                        <i class="fas fa-cog mr-2"></i>Kelola
                    </button>
                    <button class="flex-1 bg-gray-100 text-gray-700 py-2 px-4 rounded-lg font-medium hover:bg-gray-200 transition-all">
                        <i class="fas fa-chart-line mr-2"></i>Statistik
                    </button>
                </div>
            </div>
        `;
        
        modal.classList.remove('hidden');
    }

    function closeComputerModal() {
        document.getElementById('computerModal').classList.add('hidden');
    }

    function refreshComputerStatus() {
        // Add subtle animation to show refresh
        const computers = document.querySelectorAll('.computer-unit');
        computers.forEach(comp => {
            comp.style.transform = 'scale(0.95)';
            setTimeout(() => {
                comp.style.transform = 'scale(1)';
            }, 150);
        });
        
        // Show toast notification
        showToast('Status komputer diperbarui!', 'success');
        
        // In real implementation, this would make AJAX call to refresh data
        setTimeout(() => {
            location.reload();
        }, 1000);
    }

    function showToast(message, type = 'info') {
        const toast = document.createElement('div');
        const bgColor = type === 'success' ? 'bg-green-500' : type === 'error' ? 'bg-red-500' : 'bg-blue-500';
        
        toast.className = `fixed top-20 right-4 ${bgColor} text-white px-6 py-3 rounded-lg shadow-lg z-50 transform translate-x-full transition-transform duration-300`;
        toast.innerHTML = `
            <div class="flex items-center">
                <i class="fas fa-${type === 'success' ? 'check' : type === 'error' ? 'times' : 'info'} mr-2"></i>
                <span>${message}</span>
            </div>
        `;
        
        document.body.appendChild(toast);
        
        setTimeout(() => {
            toast.style.transform = 'translateX(0)';
        }, 100);
        
        setTimeout(() => {
            toast.style.transform = 'translateX(100%)';
            setTimeout(() => {
                document.body.removeChild(toast);
            }, 300);
        }, 3000);
    }

    // Enhanced Charts
    // Equipment Distribution Chart
    const equipmentCtx = document.getElementById('equipmentChart').getContext('2d');
    const equipmentData = @json($equipmentByCategory);
    
    new Chart(equipmentCtx, {
        type: 'doughnut',
        data: {
            labels: equipmentData.map(item => item.category || 'Lainnya'),
            datasets: [{
                data: equipmentData.map(item => item.count),
                backgroundColor: [
                    '#3B82F6',
                    '#10B981',
                    '#F59E0B',
                    '#EF4444',
                    '#8B5CF6',
                    '#F97316'
                ],
                borderWidth: 0,
                borderRadius: 8,
                hoverBorderRadius: 12
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
                        font: {
                            family: 'Inter',
                            size: 12
                        }
                    }
                }
            },
            elements: {
                arc: {
                    borderRadius: 8
                }
            }
        }
    });

    // Monthly Activity Chart
    const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
    const monthlyData = @json($monthlyRentals);
    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];
    
    const chartData = Array.from({length: 12}, (_, i) => {
        const monthData = monthlyData.find(item => item.month === i + 1);
        return monthData ? monthData.count : 0;
    });

    new Chart(monthlyCtx, {
        type: 'line',
        data: {
            labels: months,
            datasets: [{
                label: 'Permintaan Simulasi',
                data: chartData,
                borderColor: '#3B82F6',
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#3B82F6',
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
                        color: 'rgba(0, 0, 0, 0.1)',
                        borderDash: [3, 3]
                    },
                    ticks: {
                        font: {
                            family: 'Inter'
                        }
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: {
                            family: 'Inter'
                        }
                    }
                }
            },
            elements: {
                point: {
                    hoverBackgroundColor: '#1D4ED8'
                }
            }
        }
    });

    // Add animation on page load
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.card-hover');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            setTimeout(() => {
                card.style.transition = 'all 0.6s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });
    });
</script>

<style>
    .animate-fade-in {
        animation: fadeIn 0.8s ease-in-out;
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .computer-unit {
        transition: all 0.3s ease;
    }
    
    .computer-unit:hover {
        transform: translateY(-2px);
    }
    
    .computer-icon {
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }
</style>
@endpush
@endsection 