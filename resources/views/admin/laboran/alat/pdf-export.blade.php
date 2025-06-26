<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Data Alat Laboratorium</title>
    <style>
        @page {
            margin: 15mm;
            size: A4 landscape;
        }
        
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 11px;
            line-height: 1.4;
            color: #333;
            margin: 0;
            padding: 0;
        }
        
        /* Header Corporate Design */
        .document-header {
            border-bottom: 3px solid #1e40af;
            padding-bottom: 15px;
            margin-bottom: 25px;
            position: relative;
        }
        
        .header-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        
        .logo-section {
            width: 80px;
            height: 80px;
            border: 2px dashed #cbd5e1;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #64748b;
            font-size: 10px;
            text-align: center;
            border-radius: 8px;
        }
        
        .header-info {
            text-align: right;
            color: #64748b;
            font-size: 10px;
        }
        
        .document-title {
            text-align: center;
            margin: 15px 0;
        }
        
        .document-title h1 {
            font-size: 20px;
            font-weight: bold;
            color: #1e40af;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .document-title h2 {
            font-size: 14px;
            color: #64748b;
            margin: 5px 0 0 0;
            font-weight: normal;
        }
        
        .document-title h3 {
            font-size: 12px;
            color: #94a3b8;
            margin: 3px 0 0 0;
            font-weight: normal;
        }
        
        /* Statistics Section */
        .statistics-section {
            background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 25px;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
        }
        
        .stat-card {
            text-align: center;
            padding: 10px;
            background: white;
            border-radius: 6px;
            border: 1px solid #e2e8f0;
        }
        
        .stat-number {
            font-size: 18px;
            font-weight: bold;
            color: #1e40af;
            margin-bottom: 3px;
        }
        
        .stat-label {
            font-size: 9px;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .stat-berfungsi .stat-number { color: #059669; }
        .stat-rusak .stat-number { color: #dc2626; }
        .stat-nilai .stat-number { color: #7c3aed; }
        
        /* Table Styling */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 10px;
        }
        
        .data-table th {
            background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
            color: white;
            padding: 8px 6px;
            text-align: left;
            font-weight: bold;
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            border: 1px solid #1e40af;
        }
        
        .data-table td {
            padding: 6px;
            border: 1px solid #e2e8f0;
            vertical-align: top;
        }
        
        .data-table tbody tr:nth-child(even) {
            background-color: #f8fafc;
        }
        
        .data-table tbody tr:hover {
            background-color: #f1f5f9;
        }
        
        /* Status Styling */
        .status-badge {
            padding: 2px 6px;
            border-radius: 12px;
            font-size: 8px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }
        
        .status-berfungsi {
            background-color: #dcfce7;
            color: #166534;
            border: 1px solid #bbf7d0;
        }
        
        .status-rusak {
            background-color: #fee2e2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }
        
        /* Footer */
        .document-footer {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 1px solid #e2e8f0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 9px;
            color: #64748b;
        }
        
        .signature-section {
            text-align: right;
        }
        
        .signature-box {
            border: 1px solid #cbd5e1;
            width: 150px;
            height: 60px;
            margin: 10px 0;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #94a3b8;
            font-size: 8px;
        }
        
        /* Utility Classes */
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .font-bold { font-weight: bold; }
        .text-sm { font-size: 9px; }
        .mb-2 { margin-bottom: 8px; }
        
        /* Page Break */
        .page-break {
            page-break-before: always;
        }
    </style>
</head>
<body>
    <!-- Document Header -->
    <div class="document-header">
        <div class="header-top">
            <div class="logo-section">
                LOGO<br>FISIKA
            </div>
            <div class="header-info">
                <div><strong>Dokumen No:</strong> LAB/ALT/{{ date('Y/m') }}/{{ str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT) }}</div>
                <div><strong>Tanggal:</strong> {{ $tanggalExport }}</div>
                <div><strong>Periode:</strong> {{ $bulanTahun }}</div>
            </div>
        </div>
        
        <div class="document-title">
            <h1>Laporan Inventaris Alat Laboratorium</h1>
            <h2>Laboratorium Fisika Komputasi</h2>
            <h3>Fakultas Matematika dan Ilmu Pengetahuan Alam</h3>
        </div>
    </div>

    <!-- Statistics Section -->
    <div class="statistics-section">
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number">{{ $totalAlat }}</div>
                <div class="stat-label">Total Peralatan</div>
            </div>
            <div class="stat-card stat-berfungsi">
                <div class="stat-number">{{ $alatBerfungsi }}</div>
                <div class="stat-label">Alat Berfungsi</div>
            </div>
            <div class="stat-card stat-rusak">
                <div class="stat-number">{{ $alatRusak }}</div>
                <div class="stat-label">Alat Rusak</div>
            </div>
            <div class="stat-card stat-nilai">
                <div class="stat-number">Rp {{ number_format($totalNilai, 0, ',', '.') }}</div>
                <div class="stat-label">Total Nilai Aset</div>
            </div>
        </div>
    </div>

    <!-- Data Table -->
    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 4%;">No</th>
                <th style="width: 18%;">Nama Alat</th>
                <th style="width: 35%;">Deskripsi</th>
                <th style="width: 8%;">Stok</th>
                <th style="width: 15%;">Harga Satuan</th>
                <th style="width: 10%;">Status</th>
                <th style="width: 10%;">Tgl. Input</th>
            </tr>
        </thead>
        <tbody>
            @foreach($alat as $index => $item)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td class="font-bold">{{ $item->nama }}</td>
                <td>{{ Str::limit($item->deskripsi, 120) }}</td>
                <td class="text-center">{{ $item->stok }} unit</td>
                <td class="text-right">
                    @if($item->harga)
                        Rp {{ number_format($item->harga, 0, ',', '.') }}
                    @else
                        <span style="color: #94a3b8; font-style: italic;">Belum ditetapkan</span>
                    @endif
                </td>
                <td class="text-center">
                    <span class="status-badge {{ $item->isBroken ? 'status-rusak' : 'status-berfungsi' }}">
                        {{ $item->isBroken ? 'Rusak' : 'Berfungsi' }}
                    </span>
                </td>
                <td class="text-center text-sm">{{ $item->created_at->format('d/m/Y') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Document Footer -->
    <div class="document-footer">
        <div>
            <div class="mb-2"><strong>Catatan:</strong></div>
            <div>• Dokumen ini dibuat secara otomatis oleh Sistem Manajemen Laboratorium</div>
            <div>• Data valid per tanggal {{ $tanggalExport }}</div>
            <div>• Untuk informasi lebih lanjut hubungi administrator laboratorium</div>
        </div>
        
        <div class="signature-section">
            <div class="mb-2"><strong>Mengetahui,</strong></div>
            <div class="signature-box">
                Tanda Tangan & Stempel
            </div>
            <div class="font-bold">Kepala Laboratorium</div>
            <div>Laboratorium Fisika Komputasi</div>
        </div>
    </div>
</body>
</html> 