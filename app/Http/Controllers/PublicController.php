<?php

namespace App\Http\Controllers;

use App\Models\{Alat, Peminjaman, PeminjamanItem, Pengujian, PengujianItem, Kunjungan, JenisPengujian, Artikel, BiodataPengurus, ProfilLaboratorium};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PublicController extends Controller
{
    public function index()
    {
        try {
            // Data untuk landing page - gunakan fallback jika tabel belum ada
            $profilLab = ProfilLaboratorium::with('misi')->first() ?? null;
            $pengurus = BiodataPengurus::with('gambar')
                              ->where('is_active', true)
                              ->where('show_on_website', true)
                              ->ordered()
                              ->get() ?? collect();
            $artikel = Artikel::with('gambar')->latest()->take(6)->get() ?? collect();
            $jenisPengujian = JenisPengujian::where('isAvailable', true)->get() ?? collect();
            $alat = Alat::where('isBroken', false)->where('stok', '>', 0)->get() ?? collect();
        } catch (\Exception $e) {
            // Fallback data jika tabel belum ada
            $profilLab = null;
            $pengurus = collect();
            $artikel = collect();
            $jenisPengujian = collect();
            $alat = collect();
        }

        return view('laboratories.index-modular', compact('profilLab', 'pengurus', 'artikel', 'jenisPengujian', 'alat'));
    }

    // Form Peminjaman Alat
    public function submitPeminjaman(Request $request)
    {
        $request->validate([
            'namaPeminjam' => 'required|string|max:255',
            'noHp' => 'required|string|max:20',
            'tujuanPeminjaman' => 'nullable|string',
            'tanggal_pinjam' => 'required|date',
            'tanggal_pengembalian' => 'required|date|after:tanggal_pinjam',
            'alat' => 'required|array',
            'alat.*.id' => 'required|exists:alat,id',
            'alat.*.jumlah' => 'required|integer|min:1',
        ]);

        DB::transaction(function() use ($request) {
            // Buat peminjaman
            $peminjaman = Peminjaman::create([
                'namaPeminjam' => $request->namaPeminjam,
                'noHp' => $request->noHp,
                'tujuanPeminjaman' => $request->tujuanPeminjaman,
                'tanggal_pinjam' => $request->tanggal_pinjam,
                'tanggal_pengembalian' => $request->tanggal_pengembalian,
                'status' => 'PENDING',
            ]);

            // Buat items peminjaman
            foreach ($request->alat as $alatData) {
                PeminjamanItem::create([
                    'peminjamanId' => $peminjaman->id,
                    'alat_id' => $alatData['id'],
                    'jumlah' => $alatData['jumlah'],
                ]);
            }
        });

        return redirect()->back()->with('success', 'Permohonan peminjaman berhasil dikirim. Kami akan menghubungi Anda segera.');
    }

    // Form Pengujian
    public function submitPengujian(Request $request)
    {
        $request->validate([
            'namaPenguji' => 'required|string|max:255',
            'noHpPenguji' => 'required|string|max:20',
            'deskripsi' => 'required|string',
            'tanggalPengujian' => 'required|date',
            'jenisPengujian' => 'required|array',
            'jenisPengujian.*' => 'exists:jenisPengujian,id',
        ]);

        DB::transaction(function() use ($request) {
            // Hitung total harga
            $totalHarga = JenisPengujian::whereIn('id', $request->jenisPengujian)->sum('hargaPerSampel');

            // Buat pengujian
            $pengujian = Pengujian::create([
                'namaPenguji' => $request->namaPenguji,
                'noHpPenguji' => $request->noHpPenguji,
                'deskripsi' => $request->deskripsi,
                'totalHarga' => $totalHarga,
                'tanggalPengujian' => $request->tanggalPengujian,
                'status' => 'PENDING',
            ]);

            // Buat items pengujian
            foreach ($request->jenisPengujian as $jenisPengujianId) {
                PengujianItem::create([
                    'pengujianId' => $pengujian->id,
                    'jenisPengujianId' => $jenisPengujianId,
                ]);
            }
        });

        return redirect()->back()->with('success', 'Permohonan pengujian berhasil dikirim. Kami akan menghubungi Anda segera.');
    }

    // Form Kunjungan
    public function submitKunjungan(Request $request)
    {
        $request->validate([
            'namaPengunjung' => 'required|string|max:255',
            'instansiAsal' => 'nullable|string|max:255',
            'tujuan' => 'nullable|string',
            'tujuanKunjungan' => 'nullable|string',
            'jumlahPengunjung' => 'required|integer|min:1',
            'tanggal_kunjungan' => 'nullable|date',
        ]);

        Kunjungan::create([
            'namaPengunjung' => $request->namaPengunjung,
            'instansiAsal' => $request->instansiAsal,
            'tujuan' => $request->tujuan,
            'tujuanKunjungan' => $request->tujuanKunjungan ?? $request->tujuan,
            'jumlahPengunjung' => $request->jumlahPengunjung,
            'tanggal_kunjungan' => $request->tanggal_kunjungan,
            'status' => 'PENDING',
        ]);

        return redirect()->back()->with('success', 'Permohonan kunjungan berhasil dikirim. Kami akan menghubungi Anda segera.');
    }

    // API untuk mendapatkan alat tersedia
    public function getAlatTersedia()
    {
        $alat = Alat::where('isBroken', false)
                   ->where('stok', '>', 0)
                   ->select('id', 'nama', 'stok', 'harga')
                   ->get();

        return response()->json($alat);
    }

    // API untuk mendapatkan jenis pengujian
    public function getJenisPengujian()
    {
        $jenisPengujian = JenisPengujian::where('isAvailable', true)
                                      ->select('id', 'namaPengujian', 'hargaPerSampel')
                                      ->get();

        return response()->json($jenisPengujian);
    }
}
