<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 11px;
            line-height: 1.4;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #10b981;
            padding-bottom: 20px;
        }
        
        .header h1 {
            color: #10b981;
            font-size: 20px;
            margin: 0 0 10px 0;
            font-weight: bold;
        }
        
        .header .subtitle {
            color: #666;
            font-size: 12px;
            margin: 5px 0;
        }
        
        .export-info {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 25px;
            border-left: 4px solid #10b981;
        }
        
        .export-info h3 {
            margin: 0 0 10px 0;
            color: #10b981;
            font-size: 14px;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 15px;
        }
        
        .info-item {
            display: flex;
            justify-content: space-between;
        }
        
        .info-label {
            font-weight: bold;
            color: #555;
        }
        
        .summary-stats {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
            margin-bottom: 25px;
        }
        
        .stat-card {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            border: 1px solid #e9ecef;
        }
        
        .stat-number {
            font-size: 24px;
            font-weight: bold;
            color: #10b981;
            margin-bottom: 5px;
        }
        
        .stat-label {
            color: #666;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        }
        
        .data-table th {
            background: #10b981;
            color: white;
            padding: 12px 8px;
            text-align: left;
            font-weight: bold;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .data-table td {
            padding: 10px 8px;
            border-bottom: 1px solid #e9ecef;
            vertical-align: top;
        }
        
        .data-table tr:nth-child(even) {
            background: #f8f9fa;
        }
        
        .data-table tr:hover {
            background: #e8f5e8;
        }
        
        .status-badge {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }
        
        .status-processing {
            background: #dbeafe;
            color: #1e40af;
        }
        
        .status-completed {
            background: #d1fae5;
            color: #065f46;
        }
        
        .status-cancelled {
            background: #fee2e2;
            color: #991b1b;
        }
        
        .footer {
            margin-top: 30px;
            text-align: center;
            color: #666;
            font-size: 10px;
            border-top: 1px solid #e9ecef;
            padding-top: 15px;
        }
        
        .page-break {
            page-break-before: always;
        }
        
        @media print {
            body { margin: 0; }
            .no-print { display: none; }
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ $title }}</h1>
        <div class="subtitle">Laboratorium Fisika Komputasi</div>
        <div class="subtitle">Universitas Negeri Semarang</div>
    </div>

    <div class="export-info">
        <h3>Informasi Export</h3>
        <div class="info-grid">
            <div class="info-item">
                <span class="info-label">Tanggal Export:</span>
                <span>{{ $date }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Waktu Export:</span>
                <span>{{ $time }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Total Data:</span>
                <span>{{ $kunjungan->count() }} kunjungan</span>
            </div>
            <div class="info-item">
                <span class="info-label">Total Pengunjung:</span>
                <span>{{ $kunjungan->sum('jumlahPengunjung') }} orang</span>
            </div>
        </div>
    </div>

    <div class="summary-stats">
        <div class="stat-card">
            <div class="stat-number">{{ $kunjungan->where('status', 'PENDING')->count() }}</div>
            <div class="stat-label">Pending</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $kunjungan->where('status', 'PROCESSING')->count() }}</div>
            <div class="stat-label">Processing</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $kunjungan->where('status', 'COMPLETED')->count() }}</div>
            <div class="stat-label">Completed</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $kunjungan->where('status', 'CANCELLED')->count() }}</div>
            <div class="stat-label">Cancelled</div>
        </div>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 20%;">Nama Pengunjung</th>
                <th style="width: 20%;">Instansi Asal</th>
                <th style="width: 10%;">Tgl Kunjungan</th>
                <th style="width: 8%;">Jml Pengunjung</th>
                <th style="width: 25%;">Tujuan Kunjungan</th>
                <th style="width: 12%;">Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($kunjungan as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        <strong>{{ $item->namaPengunjung }}</strong>
                    </td>
                    <td>{{ $item->instansiAsal }}</td>
                    <td>{{ $item->tanggalKunjungan ? $item->tanggalKunjungan->format('d/m/Y') : 'Belum ditentukan' }}</td>
                    <td style="text-align: center;">
                        <strong>{{ $item->jumlahPengunjung }}</strong> orang
                    </td>
                    <td>{{ Str::limit($item->tujuanKunjungan, 60) }}</td>
                    <td>
                        @switch($item->status)
                            @case('PENDING')
                                <span class="status-badge status-pending">Pending</span>
                                @break
                            @case('PROCESSING')
                                <span class="status-badge status-processing">Processing</span>
                                @break
                            @case('COMPLETED')
                                <span class="status-badge status-completed">Completed</span>
                                @break
                            @case('CANCELLED')
                                <span class="status-badge status-cancelled">Cancelled</span>
                                @break
                            @default
                                <span class="status-badge">{{ $item->status }}</span>
                        @endswitch
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align: center; color: #666; padding: 30px;">
                        <em>Tidak ada data kunjungan</em>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Dokumen ini dibuat secara otomatis oleh Sistem Manajemen Laboratorium Fisika Komputasi</p>
        <p>© {{ date('Y') }} Universitas Negeri Semarang - Laboratorium Fisika Komputasi</p>
    </div>
</body>
</html> 