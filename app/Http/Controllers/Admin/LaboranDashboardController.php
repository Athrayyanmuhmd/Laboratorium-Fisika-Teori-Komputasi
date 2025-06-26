<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Alat, Peminjaman, Pengujian, Kunjungan, JenisPengujian, Artikel, BiodataPengurus, MaintenanceLog, PengujianFile, Notification, Gambar};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class LaboranDashboardController extends Controller
{
    public function index()
    {
        // Dashboard statistics
        $stats = [
            'alat' => [
                'total' => Alat::count(),
                'tersedia' => Alat::where('isBroken', false)->sum('stok'),
                'rusak' => Alat::where('isBroken', true)->count(),
                'perlu_kalibrasi' => Alat::where('status_kalibrasi', 'EXPIRED')->count(),
                'kalibrasi_segera' => Alat::where('tanggal_kalibrasi_berikutnya', '<=', now()->addDays(30))->count(),
            ],
            'peminjaman' => [
                'pending' => Peminjaman::where('status', 'PENDING')->count(),
                'processing' => Peminjaman::where('status', 'PROCESSING')->count(),
                'completed' => Peminjaman::where('status', 'COMPLETED')->count(),
                'total' => Peminjaman::count(),
            ],
            'pengujian' => [
                'pending' => Pengujian::where('status', 'PENDING')->count(),
                'processing' => Pengujian::where('status', 'PROCESSING')->count(),
                'completed' => Pengujian::where('status', 'COMPLETED')->count(),
                'total' => Pengujian::count(),
            ],
            'kunjungan' => [
                'pending' => Kunjungan::where('status', 'PENDING')->count(),
                'processing' => Kunjungan::where('status', 'PROCESSING')->count(),
                'completed' => Kunjungan::where('status', 'COMPLETED')->count(),
                'total' => Kunjungan::count(),
            ],
            'maintenance' => [
                'dijadwalkan' => MaintenanceLog::where('status', 'DIJADWALKAN')->count(),
                'sedang_proses' => MaintenanceLog::where('status', 'SEDANG_PROSES')->count(),
                'total_bulan_ini' => MaintenanceLog::whereMonth('tanggal_maintenance', now()->month)->count(),
            ],
            'notifications' => [
                'unread' => Notification::where('is_read', false)->count(),
                'total' => Notification::count(),
            ],
        ];

        // Recent activities
        $recentPeminjaman = Peminjaman::with('alat')->latest()->take(5)->get();
        $recentPengujian = Pengujian::with('jenisPengujian')->latest()->take(5)->get();
        $recentKunjungan = Kunjungan::latest()->take(5)->get();

        return view('admin.laboran.dashboard', compact('stats', 'recentPeminjaman', 'recentPengujian', 'recentKunjungan'));
    }

    // Manajemen Alat
    public function alat()
    {
        $search = request('search');
        $status = request('status');

        $alat = Alat::when($search, function($query, $search) {
                return $query->where('nama', 'like', "%{$search}%")
                           ->orWhere('deskripsi', 'like', "%{$search}%");
            })
            ->when($status !== null, function($query) use ($status) {
                return $query->where('isBroken', $status === 'rusak');
            })
            ->paginate(10);

        return view('admin.laboran.alat.index', compact('alat'));
    }

    public function alatStore(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'stok' => 'required|integer|min:0',
            'harga' => 'nullable|numeric|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();
        
        // Handle image upload
        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('alat', $imageName, 'public');
            $data['gambar'] = $imagePath;
        }

        Alat::create($data);

        return redirect()->route('admin.laboran.alat.index')->with('success', 'Alat berhasil ditambahkan');
    }

    public function alatUpdate(Request $request, Alat $alat)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'stok' => 'required|integer|min:0',
            'harga' => 'nullable|numeric|min:0',
            'isBroken' => 'boolean',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();
        
        // Handle image upload
        if ($request->hasFile('gambar')) {
            // Delete old image if exists
            if ($alat->gambar && \Storage::disk('public')->exists($alat->gambar)) {
                \Storage::disk('public')->delete($alat->gambar);
            }
            
            $image = $request->file('gambar');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('alat', $imageName, 'public');
            $data['gambar'] = $imagePath;
        }

        $alat->update($data);

        return redirect()->route('admin.laboran.alat.index')->with('success', 'Alat berhasil diperbarui');
    }

    public function alatDestroy(Alat $alat)
    {
        $alat->delete();
        return redirect()->route('admin.laboran.alat.index')->with('success', 'Alat berhasil dihapus');
    }

    public function alatExport(Request $request, $format)
    {
        $search = $request->get('search');
        $status = $request->get('status');

        $alat = Alat::when($search, function($query, $search) {
                return $query->where('nama', 'like', "%{$search}%")
                           ->orWhere('deskripsi', 'like', "%{$search}%");
            })
            ->when($status !== null, function($query) use ($status) {
                return $query->where('isBroken', $status === 'rusak');
            })
            ->get();

        if ($format === 'csv') {
            return $this->exportAlatToCsv($alat);
        } elseif ($format === 'pdf') {
            return $this->exportAlatToPdf($alat);
        }

        return redirect()->back()->with('error', 'Format export tidak didukung');
    }

    private function exportAlatToCsv($alat)
    {
        $filename = 'data_alat_' . date('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($alat) {
            $file = fopen('php://output', 'w');
            
            // Add BOM for UTF-8
            fwrite($file, "\xEF\xBB\xBF");
            
            // Header
            fputcsv($file, [
                'No',
                'Nama Alat',
                'Deskripsi',
                'Stok',
                'Harga',
                'Status',
                'Tanggal Dibuat',
                'Terakhir Update'
            ]);

            // Data
            foreach ($alat as $index => $item) {
                fputcsv($file, [
                    $index + 1,
                    $item->nama,
                    $item->deskripsi,
                    $item->stok,
                    $item->harga ? 'Rp ' . number_format($item->harga, 0, ',', '.') : 'Belum ditetapkan',
                    $item->isBroken ? 'Rusak' : 'Berfungsi',
                    $item->created_at->format('d/m/Y H:i'),
                    $item->updated_at->format('d/m/Y H:i')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function exportAlatToPdf($alat)
    {
        $filename = 'laporan_alat_' . date('Y-m-d_H-i-s') . '.pdf';
        
        // Prepare data for PDF
        $data = [
            'alat' => $alat,
            'totalAlat' => $alat->count(),
            'alatBerfungsi' => $alat->where('isBroken', false)->count(),
            'alatRusak' => $alat->where('isBroken', true)->count(),
            'totalStok' => $alat->sum('stok'),
            'totalNilai' => $alat->sum('harga'),
            'tanggalExport' => now()->format('d F Y, H:i') . ' WIB',
            'bulanTahun' => now()->format('F Y'),
        ];

        // Create PDF using blade template
        $pdf = Pdf::loadView('admin.laboran.alat.pdf-export', $data)
                  ->setPaper('a4', 'landscape')
                  ->setOptions([
                      'isHtml5ParserEnabled' => true,
                      'isPhpEnabled' => true,
                      'defaultFont' => 'sans-serif',
                      'margin_top' => 10,
                      'margin_right' => 10,
                      'margin_bottom' => 10,
                      'margin_left' => 10,
                  ]);

        return $pdf->download($filename);
    }

    // Manajemen Peminjaman
    public function peminjaman()
    {
        $search = request('search');
        $status = request('status');
        $date_from = request('date_from');
        $date_to = request('date_to');

        $peminjaman = Peminjaman::with(['peminjamanItems.alat'])
            ->when($search, function($query, $search) {
                return $query->where('namaPeminjam', 'like', "%{$search}%")
                           ->orWhere('noHp', 'like', "%{$search}%")
                           ->orWhere('tujuanPeminjaman', 'like', "%{$search}%");
            })
            ->when($status, function($query, $status) {
                return $query->where('status', $status);
            })
            ->when($date_from, function($query, $date_from) {
                return $query->where('tanggal_pinjam', '>=', $date_from);
            })
            ->when($date_to, function($query, $date_to) {
                return $query->where('tanggal_pinjam', '<=', $date_to);
            })
            ->latest()
            ->paginate(12);

        // Add accessor for alat count
        $peminjaman->getCollection()->transform(function ($item) {
            $item->alat_count = $item->peminjamanItems->count();
            $item->alat_names = $item->peminjamanItems->map(function ($peminjamanItem) {
                return $peminjamanItem->alat ? $peminjamanItem->alat->nama : 'Alat tidak ditemukan';
            })->filter()->implode(', ');
            return $item;
        });

        return view('admin.laboran.peminjaman.index', compact('peminjaman'));
    }

    public function peminjamanShow(Peminjaman $peminjaman)
    {
        $peminjaman->load(['peminjamanItems.alat']);
        return view('admin.laboran.peminjaman.show', compact('peminjaman'));
    }

    public function peminjamanUpdateStatus(Request $request, Peminjaman $peminjaman)
    {
        $request->validate([
            'status' => 'required|in:PENDING,PROCESSING,COMPLETED,CANCELLED',
        ]);

        $oldStatus = $peminjaman->status;
        $peminjaman->update(['status' => $request->status]);

        // Create notification for status change
        Notification::create([
            'title' => 'Status Peminjaman Diperbarui',
            'message' => "Peminjaman oleh {$peminjaman->namaPeminjam} telah diubah dari {$oldStatus} menjadi {$request->status}",
            'type' => 'SUCCESS',
            'category' => 'PEMINJAMAN',
            'related_id' => $peminjaman->id,
            'related_type' => 'App\Models\Peminjaman',
        ]);

        return redirect()->back()->with('success', 'Status peminjaman berhasil diperbarui');
    }

    public function peminjamanDestroy(Peminjaman $peminjaman)
    {
        try {
            // Delete related items first
            $peminjaman->peminjamanItems()->delete();
        $peminjaman->delete();
            
            return redirect()->route('admin.laboran.peminjaman.index')
                ->with('success', 'Data peminjaman berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus data peminjaman: ' . $e->getMessage());
        }
    }

    public function peminjamanExport(Request $request, $format)
    {
        $search = $request->get('search');
        $status = $request->get('status');
        $date_from = $request->get('date_from');
        $date_to = $request->get('date_to');

        $peminjaman = Peminjaman::with(['peminjamanItems.alat'])
            ->when($search, function($query, $search) {
                return $query->where('namaPeminjam', 'like', "%{$search}%")
                           ->orWhere('noHp', 'like', "%{$search}%")
                           ->orWhere('tujuanPeminjaman', 'like', "%{$search}%");
            })
            ->when($status, function($query, $status) {
                return $query->where('status', $status);
            })
            ->when($date_from, function($query, $date_from) {
                return $query->where('tanggal_pinjam', '>=', $date_from);
            })
            ->when($date_to, function($query, $date_to) {
                return $query->where('tanggal_pinjam', '<=', $date_to);
            })
            ->latest()
            ->get();

        if ($format === 'csv') {
            return $this->exportPeminjamanToCsv($peminjaman);
        } elseif ($format === 'pdf') {
            return $this->exportPeminjamanToPdf($peminjaman);
        }

        return redirect()->back()->with('error', 'Format export tidak didukung');
    }

    private function exportPeminjamanToCsv($peminjaman)
    {
        $filename = 'data_peminjaman_' . date('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($peminjaman) {
            $file = fopen('php://output', 'w');
            
            // Add BOM for UTF-8
            fwrite($file, "\xEF\xBB\xBF");
            
            // Header
            fputcsv($file, [
                'No',
                'Nama Peminjam',
                'No HP',
                'Tujuan Peminjaman',
                'Tanggal Pinjam',
                'Tanggal Pengembalian',
                'Status',
                'Jumlah Alat',
                'Nama Alat',
                'Tanggal Dibuat'
            ]);

            // Data
            foreach ($peminjaman as $index => $item) {
                $alatNames = $item->peminjamanItems->map(function($peminjamanItem) {
                    return $peminjamanItem->alat ? $peminjamanItem->alat->nama : 'Alat tidak ditemukan';
                })->filter()->join(', ');
                $jumlahAlat = $item->peminjamanItems->count();
                
                fputcsv($file, [
                    $index + 1,
                    $item->namaPeminjam,
                    $item->noHp,
                    $item->tujuanPeminjaman,
                    $item->tanggal_pinjam->format('d/m/Y'),
                    $item->tanggal_pengembalian->format('d/m/Y'),
                    $item->status,
                    $jumlahAlat,
                    $alatNames ?: 'Tidak ada alat',
                    $item->created_at->format('d/m/Y H:i')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function exportPeminjamanToPdf($peminjaman)
    {
        $data = [
            'peminjaman' => $peminjaman,
            'title' => 'Laporan Data Peminjaman',
            'date' => now()->format('d F Y'),
            'time' => now()->format('H:i:s')
        ];

        $pdf = Pdf::loadView('admin.laboran.peminjaman.pdf-export', $data);
        $pdf->setPaper('A4', 'landscape');
        
        $filename = 'laporan_peminjaman_' . date('Y-m-d_H-i-s') . '.pdf';
        
        return $pdf->download($filename);
    }

    // Manajemen Pengujian
    public function pengujian()
    {
        $search = request('search');
        $status = request('status');

        $pengujian = Pengujian::with(['pengujianItems.jenisPengujian'])
            ->when($search, function($query, $search) {
                return $query->where('namaPenguji', 'like', "%{$search}%")
                           ->orWhere('noHpPenguji', 'like', "%{$search}%");
            })
            ->when($status, function($query, $status) {
                return $query->where('status', $status);
            })
            ->latest()
            ->paginate(12);

        // Add accessor for item count
        $pengujian->getCollection()->transform(function ($item) {
            $item->item_count = $item->pengujianItems->count();
            $item->jenis_names = $item->pengujianItems->map(function ($pengujianItem) {
                return $pengujianItem->jenisPengujian ? $pengujianItem->jenisPengujian->namaPengujian : 'Jenis tidak ditemukan';
            })->filter()->implode(', ');
            return $item;
        });

        return view('admin.laboran.pengujian.index', compact('pengujian'));
    }

    public function pengujianShow(Pengujian $pengujian)
    {
        $pengujian->load(['pengujianItems.jenisPengujian']);
        return view('admin.laboran.pengujian.show', compact('pengujian'));
    }

    public function pengujianUpdateStatus(Request $request, Pengujian $pengujian)
    {
        $request->validate([
            'status' => 'required|in:PENDING,PROCESSING,COMPLETED,CANCELLED',
        ]);

        $oldStatus = $pengujian->status;
        $pengujian->update(['status' => $request->status]);

        // Create notification for status change
        Notification::create([
            'title' => 'Status Pengujian Diperbarui',
            'message' => "Pengujian oleh {$pengujian->namaPenguji} telah diubah dari {$oldStatus} menjadi {$request->status}",
            'type' => 'SUCCESS',
            'category' => 'PENGUJIAN',
            'related_id' => $pengujian->id,
            'related_type' => 'App\Models\Pengujian',
        ]);

        return redirect()->back()->with('success', 'Status pengujian berhasil diperbarui');
    }

    public function pengujianDestroy(Pengujian $pengujian)
    {
        $pengujian->delete();
        return redirect()->route('admin.laboran.pengujian.index')->with('success', 'Data pengujian berhasil dihapus');
    }

    // Manajemen Kunjungan
    public function kunjungan()
    {
        $search = request('search');
        $status = request('status');

        $kunjungan = Kunjungan::when($search, function($query, $search) {
                return $query->where('namaPengunjung', 'like', "%{$search}%")
                           ->orWhere('instansiAsal', 'like', "%{$search}%")
                           ->orWhere('tujuanKunjungan', 'like', "%{$search}%");
            })
            ->when($status, function($query, $status) {
                return $query->where('status', $status);
            })
            ->latest()
            ->paginate(12);

        return view('admin.laboran.kunjungan.index', compact('kunjungan'));
    }

    public function kunjunganShow(Kunjungan $kunjungan)
    {
        return view('admin.laboran.kunjungan.show', compact('kunjungan'));
    }

    public function kunjunganUpdateStatus(Request $request, Kunjungan $kunjungan)
    {
        $request->validate([
            'status' => 'required|in:PENDING,PROCESSING,COMPLETED,CANCELLED',
        ]);

        $oldStatus = $kunjungan->status;
        $kunjungan->update(['status' => $request->status]);

        // Create notification for status change
        Notification::create([
            'title' => 'Status Kunjungan Diperbarui',
            'message' => "Kunjungan oleh {$kunjungan->namaPengunjung} dari {$kunjungan->instansiAsal} telah diubah dari {$oldStatus} menjadi {$request->status}",
            'type' => 'SUCCESS',
            'category' => 'KUNJUNGAN',
            'related_id' => $kunjungan->id,
            'related_type' => 'App\Models\Kunjungan',
        ]);

        return redirect()->back()->with('success', 'Status kunjungan berhasil diperbarui');
    }

    public function kunjunganDestroy(Kunjungan $kunjungan)
    {
        $kunjungan->delete();
        return redirect()->route('admin.laboran.kunjungan.index')->with('success', 'Data kunjungan berhasil dihapus');
    }

    public function kunjunganExport(Request $request, $format)
    {
        $search = $request->get('search');
        $status = $request->get('status');

        $kunjungan = Kunjungan::when($search, function($query, $search) {
                return $query->where('namaPengunjung', 'like', "%{$search}%")
                           ->orWhere('instansiAsal', 'like', "%{$search}%")
                           ->orWhere('tujuanKunjungan', 'like', "%{$search}%");
            })
            ->when($status, function($query, $status) {
                return $query->where('status', $status);
            })
            ->latest()
            ->get();

        if ($format === 'csv') {
            return $this->exportKunjunganToCsv($kunjungan);
        } elseif ($format === 'pdf') {
            return $this->exportKunjunganToPdf($kunjungan);
        }

        return redirect()->back()->with('error', 'Format export tidak didukung');
    }

    private function exportKunjunganToCsv($kunjungan)
    {
        $filename = 'kunjungan_' . date('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($kunjungan) {
            $file = fopen('php://output', 'w');
            
            // Add BOM for UTF-8
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            // Header
            fputcsv($file, [
                'Nama Pengunjung',
                'Instansi Asal',
                'Tanggal Kunjungan',
                'Jumlah Pengunjung',
                'Tujuan Kunjungan',
                'Status',
                'Dibuat Pada'
            ]);

            // Data
            foreach ($kunjungan as $item) {
                fputcsv($file, [
                    $item->namaPengunjung,
                    $item->instansiAsal,
                    $item->tanggalKunjungan ? $item->tanggalKunjungan->format('d/m/Y') : 'Belum ditentukan',
                    $item->jumlahPengunjung,
                    $item->tujuanKunjungan,
                    $item->status,
                    $item->created_at->format('d/m/Y H:i')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function exportKunjunganToPdf($kunjungan)
    {
        $data = [
            'kunjungan' => $kunjungan,
            'title' => 'Laporan Data Kunjungan Laboratorium',
            'date' => now()->format('d F Y'),
            'time' => now()->format('H:i:s')
        ];

        $pdf = Pdf::loadView('admin.laboran.kunjungan.pdf-export', $data);
        $pdf->setPaper('A4', 'portrait');
        
        $filename = 'laporan_kunjungan_' . date('Y-m-d_H-i-s') . '.pdf';
        
        return $pdf->download($filename);
    }

    // Manajemen Jenis Pengujian
    public function jenisPengujian()
    {
        $search = request('search');
        $status = request('status');
        $sort = request('sort', 'created_at');
        $order = request('order', 'desc');

        $jenisPengujian = JenisPengujian::when($search, function($query, $search) {
                return $query->where('namaPengujian', 'like', "%{$search}%");
            })
            ->when($status !== null, function($query) use ($status) {
                return $query->where('isAvailable', $status === 'available');
            })
            ->orderBy($sort, $order)
            ->paginate(12);

        return view('admin.laboran.jenis-pengujian.index', compact('jenisPengujian'));
    }

    public function jenisPengujianStore(Request $request)
    {
        $request->validate([
            'namaPengujian' => 'required|string|max:255|unique:jenisPengujian,namaPengujian',
            'hargaPerSampel' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
            'estimasiWaktu' => 'nullable|string|max:100',
            'kategori' => 'nullable|string|max:100',
            'isAvailable' => 'boolean',
        ]);

        $data = $request->all();
        $data['isAvailable'] = $request->has('isAvailable');

        JenisPengujian::create($data);

        // Create notification
        Notification::create([
            'title' => 'Jenis Pengujian Baru Ditambahkan',
            'message' => "Layanan pengujian '{$request->namaPengujian}' dengan tarif Rp " . number_format($request->hargaPerSampel, 0, ',', '.') . " telah ditambahkan ke sistem",
            'type' => 'SUCCESS',
            'category' => 'PENGUJIAN',
            'related_id' => null,
            'related_type' => 'App\Models\JenisPengujian',
        ]);

        return redirect()->route('admin.laboran.jenis-pengujian.index')->with('success', 'Jenis pengujian berhasil ditambahkan');
    }

    public function jenisPengujianUpdate(Request $request, JenisPengujian $jenisPengujian)
    {
        $request->validate([
            'namaPengujian' => 'required|string|max:255|unique:jenisPengujian,namaPengujian,' . $jenisPengujian->id,
            'hargaPerSampel' => 'required|numeric|min:0',
            'deskripsi' => 'nullable|string',
            'estimasiWaktu' => 'nullable|string|max:100',
            'kategori' => 'nullable|string|max:100',
            'isAvailable' => 'boolean',
        ]);

        $oldPrice = $jenisPengujian->hargaPerSampel;
        $newPrice = $request->hargaPerSampel;

        $data = $request->all();
        $data['isAvailable'] = $request->has('isAvailable');

        $jenisPengujian->update($data);

        // Create notification for price change
        if ($oldPrice != $newPrice) {
            Notification::create([
                'title' => 'Tarif Pengujian Diperbarui',
                'message' => "Tarif layanan '{$jenisPengujian->namaPengujian}' telah diubah dari Rp " . number_format($oldPrice, 0, ',', '.') . " menjadi Rp " . number_format($newPrice, 0, ',', '.'),
                'type' => 'INFO',
                'category' => 'PENGUJIAN',
                'related_id' => $jenisPengujian->id,
                'related_type' => 'App\Models\JenisPengujian',
            ]);
        }

        return redirect()->route('admin.laboran.jenis-pengujian.index')->with('success', 'Jenis pengujian berhasil diperbarui');
    }

    public function jenisPengujianToggleAvailability(Request $request, JenisPengujian $jenisPengujian)
    {
        $request->validate([
            'isAvailable' => 'required|boolean',
        ]);

        $jenisPengujian->update(['isAvailable' => $request->isAvailable]);

        $status = $request->isAvailable ? 'diaktifkan' : 'dinonaktifkan';
        
        // Create notification
        Notification::create([
            'title' => 'Status Layanan Pengujian Diubah',
            'message' => "Layanan '{$jenisPengujian->namaPengujian}' telah {$status}",
            'type' => 'INFO',
            'category' => 'PENGUJIAN',
            'related_id' => $jenisPengujian->id,
            'related_type' => 'App\Models\JenisPengujian',
        ]);

        return redirect()->back()->with('success', "Layanan berhasil {$status}");
    }

    public function jenisPengujianExport(Request $request, $format)
    {
        $search = $request->get('search');
        $status = $request->get('status');

        $jenisPengujian = JenisPengujian::when($search, function($query, $search) {
                return $query->where('namaPengujian', 'like', "%{$search}%");
            })
            ->when($status !== null, function($query) use ($status) {
                return $query->where('isAvailable', $status === 'available');
            })
            ->latest()
            ->get();

        if ($format === 'csv') {
            return $this->exportJenisPengujianToCsv($jenisPengujian);
        } elseif ($format === 'pdf') {
            return $this->exportJenisPengujianToPdf($jenisPengujian);
        }

        return redirect()->back()->with('error', 'Format export tidak didukung');
    }

    private function exportJenisPengujianToCsv($jenisPengujian)
    {
        $filename = 'tarif_pengujian_' . date('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($jenisPengujian) {
            $file = fopen('php://output', 'w');
            
            // Add BOM for UTF-8
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            // Header
            fputcsv($file, [
                'No',
                'Nama Pengujian',
                'Harga per Sampel (Rp)',
                'Deskripsi',
                'Estimasi Waktu',
                'Kategori',
                'Status',
                'Dibuat Pada',
                'Terakhir Update'
            ]);

            // Data
            foreach ($jenisPengujian as $index => $item) {
                fputcsv($file, [
                    $index + 1,
                    $item->namaPengujian,
                    number_format($item->hargaPerSampel, 0, ',', '.'),
                    $item->deskripsi ?? '-',
                    $item->estimasiWaktu ?? '-',
                    $item->kategori ?? '-',
                    $item->isAvailable ? 'Tersedia' : 'Tidak Tersedia',
                    $item->created_at->format('d/m/Y H:i'),
                    $item->updated_at->format('d/m/Y H:i')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function exportJenisPengujianToPdf($jenisPengujian)
    {
        $data = [
            'jenisPengujian' => $jenisPengujian,
            'title' => 'Daftar Tarif Pengujian Laboratorium',
            'date' => now()->format('d F Y'),
            'time' => now()->format('H:i:s'),
            'stats' => [
                'total' => $jenisPengujian->count(),
                'available' => $jenisPengujian->where('isAvailable', true)->count(),
                'average_price' => $jenisPengujian->avg('hargaPerSampel'),
                'max_price' => $jenisPengujian->max('hargaPerSampel'),
            ]
        ];

        $pdf = Pdf::loadView('admin.laboran.jenis-pengujian.pdf-export', $data);
        $pdf->setPaper('A4', 'portrait');
        
        $filename = 'tarif_pengujian_' . date('Y-m-d_H-i-s') . '.pdf';
        
        return $pdf->download($filename);
    }

    public function jenisPengujianDestroy(JenisPengujian $jenisPengujian)
    {
        // Check if this service is being used in any pengujian
        $usageCount = $jenisPengujian->pengujianItems()->count();
        
        if ($usageCount > 0) {
            return redirect()->back()->with('error', "Tidak dapat menghapus layanan ini karena sedang digunakan dalam {$usageCount} pengujian.");
        }

        $serviceName = $jenisPengujian->namaPengujian;
        $jenisPengujian->delete();

        // Create notification
        Notification::create([
            'title' => 'Jenis Pengujian Dihapus',
            'message' => "Layanan pengujian '{$serviceName}' telah dihapus dari sistem",
            'type' => 'WARNING',
            'category' => 'PENGUJIAN',
            'related_id' => null,
            'related_type' => 'App\Models\JenisPengujian',
        ]);

        return redirect()->route('admin.laboran.jenis-pengujian.index')->with('success', 'Jenis pengujian berhasil dihapus');
    }

    // Manajemen Konten
    public function artikel()
    {
        $search = request('search');
        $status = request('status');
        $sort = request('sort', 'created_at');
        $order = request('order', 'desc');

        $artikel = Artikel::with('gambar')
            ->when($search, function($query, $search) {
                return $query->where('namaAcara', 'like', "%{$search}%")
                           ->orWhere('deskripsi', 'like', "%{$search}%")
                           ->orWhere('penulis', 'like', "%{$search}%");
            })
            ->when($status, function($query, $status) {
                if ($status === 'with_image') {
                    return $query->whereHas('gambar');
                } elseif ($status === 'without_image') {
                    return $query->whereDoesntHave('gambar');
                }
                return $query;
            })
            ->orderBy($sort, $order)
            ->paginate(12);

        return view('admin.laboran.artikel.index', compact('artikel'));
    }

    public function artikelStore(Request $request)
    {
        $request->validate([
            'namaAcara' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'penulis' => 'nullable|string|max:255',
            'tanggalAcara' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kategori' => 'nullable|string|max:100',
            'tags' => 'nullable|string|max:500',
            'status' => 'nullable|in:draft,published,archived',
        ]);

        $data = $request->except('gambar');
        $data['status'] = $request->status ?? 'published';

        $artikel = Artikel::create($data);

        // Handle image upload
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('artikel', $filename, 'public');
            
            Gambar::create([
                'url' => $path,
                'acaraId' => $artikel->id,
                'kategori' => 'ACARA',
            ]);
        }

        // Create notification
        Notification::create([
            'title' => 'Artikel Baru Ditambahkan',
            'message' => "Artikel '{$artikel->namaAcara}' telah ditambahkan ke sistem",
            'type' => 'SUCCESS',
            'category' => 'SYSTEM',
            'related_id' => $artikel->id,
            'related_type' => 'App\Models\Artikel',
        ]);

        return redirect()->route('admin.laboran.artikel.index')->with('success', 'Artikel berhasil ditambahkan');
    }

    public function artikelUpdate(Request $request, Artikel $artikel)
    {
        $request->validate([
            'namaAcara' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'penulis' => 'nullable|string|max:255',
            'tanggalAcara' => 'required|date',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'kategori' => 'nullable|string|max:100',
            'tags' => 'nullable|string|max:500',
            'status' => 'nullable|in:draft,published,archived',
        ]);

        $data = $request->except('gambar');
        $artikel->update($data);

        // Handle image upload
        if ($request->hasFile('gambar')) {
            // Delete old image
            if ($artikel->gambar->isNotEmpty()) {
                $oldImage = $artikel->gambar->first();
                if (file_exists(storage_path('app/public/' . $oldImage->url))) {
                    unlink(storage_path('app/public/' . $oldImage->url));
                }
                $oldImage->delete();
            }

            // Upload new image
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('artikel', $filename, 'public');
            
            Gambar::create([
                'url' => $path,
                'acaraId' => $artikel->id,
                'kategori' => 'ACARA',
            ]);
        }

        // Create notification
        Notification::create([
            'title' => 'Artikel Diperbarui',
            'message' => "Artikel '{$artikel->namaAcara}' telah diperbarui",
            'type' => 'INFO',
            'category' => 'SYSTEM',
            'related_id' => $artikel->id,
            'related_type' => 'App\Models\Artikel',
        ]);

        return redirect()->route('admin.laboran.artikel.index')->with('success', 'Artikel berhasil diperbarui');
    }

    public function artikelDestroy(Artikel $artikel)
    {
        $artikelName = $artikel->namaAcara;

        // Delete associated images
        foreach ($artikel->gambar as $gambar) {
            if (file_exists(storage_path('app/public/' . $gambar->url))) {
                unlink(storage_path('app/public/' . $gambar->url));
            }
            $gambar->delete();
        }

        $artikel->delete();

        // Create notification
        Notification::create([
            'title' => 'Artikel Dihapus',
            'message' => "Artikel '{$artikelName}' telah dihapus dari sistem",
            'type' => 'WARNING',
            'category' => 'SYSTEM',
            'related_id' => null,
            'related_type' => 'App\Models\Artikel',
        ]);

        return redirect()->route('admin.laboran.artikel.index')->with('success', 'Artikel berhasil dihapus');
    }

    public function artikelExport(Request $request, $format)
    {
        $search = $request->get('search');
        $status = $request->get('status');

        $artikel = Artikel::with('gambar')
            ->when($search, function($query, $search) {
                return $query->where('namaAcara', 'like', "%{$search}%")
                           ->orWhere('deskripsi', 'like', "%{$search}%")
                           ->orWhere('penulis', 'like', "%{$search}%");
            })
            ->when($status, function($query, $status) {
                if ($status === 'with_image') {
                    return $query->whereHas('gambar');
                } elseif ($status === 'without_image') {
                    return $query->whereDoesntHave('gambar');
                }
                return $query;
            })
            ->latest()
            ->get();

        if ($format === 'csv') {
            return $this->exportArtikelToCsv($artikel);
        } elseif ($format === 'pdf') {
            return $this->exportArtikelToPdf($artikel);
        }

        return redirect()->back()->with('error', 'Format export tidak didukung');
    }

    private function exportArtikelToCsv($artikel)
    {
        $filename = 'artikel_berita_' . date('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($artikel) {
            $file = fopen('php://output', 'w');
            
            // Add BOM for UTF-8
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
            
            // Header
            fputcsv($file, [
                'No',
                'Judul Artikel',
                'Penulis',
                'Tanggal Acara',
                'Kategori',
                'Status',
                'Ada Gambar',
                'Dibuat Pada',
                'Terakhir Update'
            ]);

            // Data
            foreach ($artikel as $index => $item) {
                fputcsv($file, [
                    $index + 1,
                    $item->namaAcara,
                    $item->penulis ?? '-',
                    $item->tanggalAcara ? $item->tanggalAcara->format('d/m/Y') : '-',
                    $item->kategori ?? '-',
                    $item->status ?? 'published',
                    $item->gambar->isNotEmpty() ? 'Ya' : 'Tidak',
                    $item->created_at->format('d/m/Y H:i'),
                    $item->updated_at->format('d/m/Y H:i')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function exportArtikelToPdf($artikel)
    {
        $data = [
            'artikel' => $artikel,
            'title' => 'Daftar Artikel & Berita Laboratorium',
            'date' => now()->format('d F Y'),
            'time' => now()->format('H:i:s'),
            'stats' => [
                'total' => $artikel->count(),
                'with_image' => $artikel->filter(function($item) { return $item->gambar->isNotEmpty(); })->count(),
                'this_month' => $artikel->filter(function($item) { return $item->created_at->isCurrentMonth(); })->count(),
                'this_week' => $artikel->filter(function($item) { return $item->created_at->isCurrentWeek(); })->count(),
            ]
        ];

        $pdf = Pdf::loadView('admin.laboran.artikel.pdf-export', $data);
        $pdf->setPaper('A4', 'portrait');
        
        $filename = 'artikel_berita_' . date('Y-m-d_H-i-s') . '.pdf';
        
        return $pdf->download($filename);
    }

    // Manajemen Pengurus
    public function pengurus()
    {
        $search = request('search');
        $status = request('status');
        $jabatan = request('jabatan');

        $pengurus = BiodataPengurus::with('gambar')
            ->when($search, function($query, $search) {
                return $query->where('nama', 'like', "%{$search}%")
                           ->orWhere('jabatan', 'like', "%{$search}%")
                           ->orWhere('email', 'like', "%{$search}%")
                           ->orWhere('specialization', 'like', "%{$search}%");
            })
            ->when($status !== null, function($query) use ($status) {
                if ($status === 'active') {
                    return $query->where('is_active', true);
                } elseif ($status === 'inactive') {
                    return $query->where('is_active', false);
                } elseif ($status === 'website') {
                    return $query->where('show_on_website', true);
                }
                return $query;
            })
            ->when($jabatan, function($query, $jabatan) {
                return $query->where('jabatan', 'like', "%{$jabatan}%");
            })
            ->orderBy('display_order')
            ->orderBy('nama')
            ->paginate(12);

        return view('admin.laboran.pengurus.index', compact('pengurus'));
    }

    public function pengurusStore(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'bio' => 'nullable|string',
            'specialization' => 'nullable|string|max:255',
            'education' => 'nullable|string|max:255',
            'expertise' => 'nullable|string',
            'research_interests' => 'nullable|string',
            'employment_type' => 'nullable|in:full_time,part_time,contract,volunteer',
            'linkedin_url' => 'nullable|url',
            'google_scholar_url' => 'nullable|url',
            'website_url' => 'nullable|url',
            'join_date' => 'nullable|date',
            'achievements' => 'nullable|string',
            'publications' => 'nullable|string',
            'is_active' => 'boolean',
            'show_on_website' => 'boolean',
            'display_order' => 'nullable|integer',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');
        $data['show_on_website'] = $request->has('show_on_website');

        $pengurus = BiodataPengurus::create($data);

        // Handle image upload
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('pengurus', $filename, 'public');
            
            Gambar::create([
                'url' => $path,
                'pengurusId' => $pengurus->id,
                'kategori' => 'PENGURUS',
            ]);
        }

        // Create notification
        Notification::create([
            'title' => 'Staff Baru Ditambahkan',
            'message' => "Staff '{$pengurus->nama}' dengan jabatan '{$pengurus->jabatan}' telah ditambahkan",
            'type' => 'SUCCESS',
            'category' => 'SYSTEM',
            'related_id' => $pengurus->id,
            'related_type' => 'App\Models\BiodataPengurus',
        ]);

        return redirect()->route('admin.laboran.pengurus.index')->with('success', 'Data pengurus berhasil ditambahkan');
    }

    public function pengurusUpdate(Request $request, BiodataPengurus $pengurus)
    {
        // Debug logging
        \Log::info('pengurusUpdate called', [
            'pengurus_id' => $pengurus->id,
            'request_data' => $request->all(),
            'method' => $request->method(),
            'has_files' => $request->hasFile('gambar')
        ]);
        
        $request->validate([
            'nama' => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'bio' => 'nullable|string',
            'specialization' => 'nullable|string|max:255',
            'education' => 'nullable|string|max:255',
            'expertise' => 'nullable|string',
            'research_interests' => 'nullable|string',
            'employment_type' => 'nullable|in:full_time,part_time,contract,volunteer',
            'linkedin_url' => 'nullable|url',
            'google_scholar_url' => 'nullable|url',
            'website_url' => 'nullable|url',
            'join_date' => 'nullable|date',
            'achievements' => 'nullable|string',
            'publications' => 'nullable|string',
            'is_active' => 'boolean',
            'show_on_website' => 'boolean',
            'display_order' => 'nullable|integer',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();
        $data['is_active'] = $request->has('is_active');
        $data['show_on_website'] = $request->has('show_on_website');

        // Handle image upload
        if ($request->hasFile('gambar')) {
            // Delete old image if exists
            $oldImage = $pengurus->gambar->first();
            if ($oldImage) {
                if (file_exists(storage_path('app/public/' . $oldImage->url))) {
                    unlink(storage_path('app/public/' . $oldImage->url));
                }
                $oldImage->delete();
            }

            // Upload new image
            $file = $request->file('gambar');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('pengurus', $filename, 'public');
            
            Gambar::create([
                'url' => $path,
                'pengurusId' => $pengurus->id,
                'kategori' => 'PENGURUS',
            ]);
        }

        $pengurus->update($data);

        // Create notification
        Notification::create([
            'title' => 'Data Staff Diperbarui',
            'message' => "Data staff '{$pengurus->nama}' telah diperbarui",
            'type' => 'INFO',
            'category' => 'SYSTEM',
            'related_id' => $pengurus->id,
            'related_type' => 'App\Models\BiodataPengurus',
        ]);

        return redirect()->route('admin.laboran.pengurus.index')->with('success', 'Data pengurus berhasil diperbarui');
    }

    public function pengurusDestroy(BiodataPengurus $pengurus)
    {
        $pengurusName = $pengurus->nama;

        // Delete associated images
        foreach ($pengurus->gambar as $gambar) {
            if (file_exists(storage_path('app/public/' . $gambar->url))) {
                unlink(storage_path('app/public/' . $gambar->url));
            }
            $gambar->delete();
        }

        $pengurus->delete();

        // Create notification
        Notification::create([
            'title' => 'Staff Dihapus',
            'message' => "Staff '{$pengurusName}' telah dihapus dari sistem",
            'type' => 'WARNING',
            'category' => 'SYSTEM',
            'related_id' => null,
            'related_type' => 'App\Models\BiodataPengurus',
        ]);

        return redirect()->route('admin.laboran.pengurus.index')->with('success', 'Data pengurus berhasil dihapus');
    }

    public function pengurusExport(Request $request, $format)
    {
        $search = $request->get('search');
        $status = $request->get('status');
        $jabatan = $request->get('jabatan');

        $pengurus = BiodataPengurus::with('gambar')
            ->when($search, function($query, $search) {
                return $query->where('nama', 'like', "%{$search}%")
                           ->orWhere('jabatan', 'like', "%{$search}%")
                           ->orWhere('email', 'like', "%{$search}%")
                           ->orWhere('specialization', 'like', "%{$search}%");
            })
            ->when($status !== null, function($query) use ($status) {
                if ($status === 'active') {
                    return $query->where('is_active', true);
                } elseif ($status === 'inactive') {
                    return $query->where('is_active', false);
                } elseif ($status === 'website') {
                    return $query->where('show_on_website', true);
                }
                return $query;
            })
            ->when($jabatan, function($query, $jabatan) {
                return $query->where('jabatan', 'like', "%{$jabatan}%");
            })
            ->orderBy('display_order')
            ->orderBy('nama')
            ->get();

        if ($format === 'csv') {
            return $this->exportPengurusToCsv($pengurus);
        } elseif ($format === 'pdf') {
            return $this->exportPengurusToPdf($pengurus);
        }

        return redirect()->back()->with('error', 'Format export tidak didukung');
    }

    private function exportPengurusToCsv($pengurus)
    {
        $filename = 'data_pengurus_' . date('Y-m-d_H-i-s') . '.csv';
        
        $headers = [
            'Content-Type' => 'text/csv; charset=UTF-8',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($pengurus) {
            $file = fopen('php://output', 'w');
            
            // Add BOM for UTF-8
            fwrite($file, "\xEF\xBB\xBF");
            
            // Header
            fputcsv($file, [
                'No',
                'Nama',
                'Jabatan',
                'Email',
                'Telepon',
                'Spesialisasi',
                'Pendidikan',
                'Status',
                'Tampil di Website',
                'Bergabung',
                'Terakhir Update'
            ]);

            // Data
            foreach ($pengurus as $index => $item) {
                fputcsv($file, [
                    $index + 1,
                    $item->nama,
                    $item->jabatan,
                    $item->email ?? '-',
                    $item->phone ?? '-',
                    $item->specialization ?? '-',
                    $item->education ?? '-',
                    $item->is_active ? 'Aktif' : 'Tidak Aktif',
                    $item->show_on_website ? 'Ya' : 'Tidak',
                    $item->join_date ? $item->join_date->format('d/m/Y') : '-',
                    $item->updated_at->format('d/m/Y H:i')
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    private function exportPengurusToPdf($pengurus)
    {
        $data = [
            'pengurus' => $pengurus,
            'title' => 'Daftar Staff dan Pengurus Laboratorium',
            'date' => now()->format('d F Y'),
            'time' => now()->format('H:i:s'),
            'stats' => [
                'total' => $pengurus->count(),
                'aktif' => $pengurus->where('is_active', true)->count(),
                'website' => $pengurus->where('show_on_website', true)->count(),
                'dengan_foto' => $pengurus->filter(function($item) { return $item->gambar->isNotEmpty(); })->count(),
            ]
        ];

        $pdf = Pdf::loadView('admin.laboran.pengurus.pdf-export', $data);
        $pdf->setPaper('A4', 'portrait');
        
        $filename = 'data_pengurus_' . date('Y-m-d_H-i-s') . '.pdf';
        
        return $pdf->download($filename);
    }

    public function pengurusToggleStatus(Request $request, BiodataPengurus $pengurus)
    {
        $field = $request->get('field', 'is_active');
        $status = $request->get('status');
        
        // Validate field
        if (!in_array($field, ['is_active', 'show_on_website'])) {
            return response()->json(['success' => false, 'message' => 'Field tidak valid']);
        }
        
        // Validate status
        if (!is_bool($status) && !in_array($status, ['true', 'false', true, false, 0, 1])) {
            return response()->json(['success' => false, 'message' => 'Status tidak valid']);
        }
        
        // Convert to boolean
        $status = filter_var($status, FILTER_VALIDATE_BOOLEAN);
        
        try {
            $pengurus->update([$field => $status]);
            
            $message = $field === 'is_active' 
                ? ($status ? 'Staff berhasil diaktifkan' : 'Staff berhasil dinonaktifkan')
                : ($status ? 'Staff berhasil ditampilkan di website' : 'Staff berhasil disembunyikan dari website');
            
            // Create notification
            Notification::create([
                'title' => 'Status Staff Diubah',
                'message' => "Status '{$pengurus->nama}' telah diubah: " . $message,
                'type' => 'INFO',
                'category' => 'SYSTEM',
                'related_id' => $pengurus->id,
                'related_type' => 'App\Models\BiodataPengurus',
            ]);
                
            return response()->json(['success' => true, 'message' => $message]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan saat memperbarui status']);
        }
    }
}
