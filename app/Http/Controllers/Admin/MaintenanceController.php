<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{MaintenanceLog, Alat, Notification};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MaintenanceController extends Controller
{
    public function index()
    {
        $search = request('search');
        $status = request('status');
        $jenis = request('jenis');

        $maintenanceLogs = MaintenanceLog::with('alat')
            ->when($search, function($query, $search) {
                return $query->whereHas('alat', function($q) use ($search) {
                    $q->where('nama', 'like', "%{$search}%")
                      ->orWhere('kode_alat', 'like', "%{$search}%");
                })->orWhere('teknisi', 'like', "%{$search}%");
            })
            ->when($status, function($query, $status) {
                return $query->where('status', $status);
            })
            ->when($jenis, function($query, $jenis) {
                return $query->where('jenis_maintenance', $jenis);
            })
            ->latest('tanggal_maintenance')
            ->paginate(10);

        // Statistics
        $stats = [
            'total' => MaintenanceLog::count(),
            'dijadwalkan' => MaintenanceLog::where('status', 'DIJADWALKAN')->count(),
            'sedang_proses' => MaintenanceLog::where('status', 'SEDANG_PROSES')->count(),
            'selesai' => MaintenanceLog::where('status', 'SELESAI')->count(),
            'ditunda' => MaintenanceLog::where('status', 'DITUNDA')->count(),
        ];

        // Alat yang perlu kalibrasi
        $alatPerluKalibrasi = Alat::where('status_kalibrasi', 'EXPIRED')
            ->orWhere(function($query) {
                $query->where('tanggal_kalibrasi_berikutnya', '<=', now()->addDays(30))
                      ->where('status_kalibrasi', '!=', 'EXPIRED');
            })
            ->get();

        return view('admin.laboran.maintenance.index', compact('maintenanceLogs', 'stats', 'alatPerluKalibrasi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'alat_id' => 'required|exists:alat,id',
            'jenis_maintenance' => 'required|in:PREVENTIF,KOREKTIF,KALIBRASI,PEMBERSIHAN',
            'tanggal_maintenance' => 'required|date',
            'deskripsi_kegiatan' => 'required|string',
            'biaya' => 'nullable|numeric|min:0',
            'teknisi' => 'nullable|string|max:255',
            'catatan' => 'nullable|string',
        ]);

        DB::transaction(function() use ($request) {
            $maintenance = MaintenanceLog::create($request->all());

            // Create notification
            Notification::create([
                'title' => 'Maintenance Dijadwalkan',
                'message' => "Maintenance {$request->jenis_maintenance} untuk alat {$maintenance->alat->nama} telah dijadwalkan pada {$maintenance->tanggal_maintenance->format('d M Y')}",
                'type' => 'INFO',
                'category' => 'MAINTENANCE',
                'related_id' => $maintenance->id,
                'related_type' => MaintenanceLog::class,
            ]);
        });

        return redirect()->route('admin.laboran.maintenance.index')->with('success', 'Jadwal maintenance berhasil ditambahkan');
    }

    public function updateStatus(Request $request, MaintenanceLog $maintenance)
    {
        $request->validate([
            'status' => 'required|in:DIJADWALKAN,SEDANG_PROSES,SELESAI,DITUNDA',
            'catatan' => 'nullable|string',
        ]);

        DB::transaction(function() use ($request, $maintenance) {
            $oldStatus = $maintenance->status;
            
            $maintenance->update([
                'status' => $request->status,
                'catatan' => $request->catatan ?? $maintenance->catatan,
            ]);

            // Update alat status if maintenance completed
            if ($request->status === 'SELESAI' && $maintenance->jenis_maintenance === 'KALIBRASI') {
                $maintenance->alat->update([
                    'status_kalibrasi' => 'VALID',
                    'tanggal_kalibrasi_terakhir' => now(),
                    'tanggal_kalibrasi_berikutnya' => now()->addYear(), // Default 1 year
                ]);
            }

            // Create notification for status change
            $statusMessages = [
                'SEDANG_PROSES' => 'Maintenance sedang dalam proses',
                'SELESAI' => 'Maintenance telah selesai',
                'DITUNDA' => 'Maintenance ditunda',
            ];

            if (isset($statusMessages[$request->status])) {
                Notification::create([
                    'title' => 'Status Maintenance Diperbarui',
                    'message' => "{$statusMessages[$request->status]} untuk alat {$maintenance->alat->nama}",
                    'type' => $request->status === 'SELESAI' ? 'SUCCESS' : 'INFO',
                    'category' => 'MAINTENANCE',
                    'related_id' => $maintenance->id,
                    'related_type' => MaintenanceLog::class,
                ]);
            }
        });

        return redirect()->back()->with('success', 'Status maintenance berhasil diperbarui');
    }

    public function show(MaintenanceLog $maintenance)
    {
        $maintenance->load('alat');
        return view('admin.laboran.maintenance.show', compact('maintenance'));
    }

    public function destroy(MaintenanceLog $maintenance)
    {
        $maintenance->delete();
        return redirect()->route('admin.laboran.maintenance.index')->with('success', 'Data maintenance berhasil dihapus');
    }

    // API untuk mendapatkan alat tersedia
    public function getAlatTersedia()
    {
        $alat = Alat::select('id', 'nama', 'kode_alat', 'status_kalibrasi')
                   ->get()
                   ->map(function($item) {
                       return [
                           'id' => $item->id,
                           'text' => $item->kode_alat ? "{$item->kode_alat} - {$item->nama}" : $item->nama,
                           'status_kalibrasi' => $item->status_kalibrasi,
                       ];
                   });

        return response()->json($alat);
    }

    // Generate laporan maintenance
    public function report(Request $request)
    {
        $startDate = $request->get('start_date', now()->startOfMonth());
        $endDate = $request->get('end_date', now()->endOfMonth());

        $maintenanceLogs = MaintenanceLog::with('alat')
            ->whereBetween('tanggal_maintenance', [$startDate, $endDate])
            ->orderBy('tanggal_maintenance', 'desc')
            ->get();

        $summary = [
            'total_maintenance' => $maintenanceLogs->count(),
            'total_biaya' => $maintenanceLogs->sum('biaya'),
            'by_jenis' => $maintenanceLogs->groupBy('jenis_maintenance')->map->count(),
            'by_status' => $maintenanceLogs->groupBy('status')->map->count(),
        ];

        return view('admin.laboran.maintenance.report', compact('maintenanceLogs', 'summary', 'startDate', 'endDate'));
    }
} 