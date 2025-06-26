<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 10px;
            line-height: 1.4;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 3px solid #4F46E5;
        }
        
        .header h1 {
            color: #4F46E5;
            font-size: 18px;
            font-weight: bold;
            margin: 0 0 5px 0;
        }
        
        .header .subtitle {
            color: #6B7280;
            font-size: 12px;
            margin: 0;
        }
        
        .header .meta {
            color: #9CA3AF;
            font-size: 9px;
            margin-top: 10px;
        }
        
        .stats-grid {
            display: table;
            width: 100%;
            margin-bottom: 25px;
        }
        
        .stats-row {
            display: table-row;
        }
        
        .stat-card {
            display: table-cell;
            width: 25%;
            padding: 15px;
            margin: 0 5px;
            background: #F8FAFC;
            border: 1px solid #E2E8F0;
            border-radius: 8px;
            text-align: center;
        }
        
        .stat-value {
            font-size: 16px;
            font-weight: bold;
            color: #1F2937;
            margin-bottom: 3px;
        }
        
        .stat-label {
            font-size: 9px;
            color: #6B7280;
            text-transform: uppercase;
        }
        
        .table-container {
            margin-top: 20px;
        }
        
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            font-size: 9px;
        }
        
        .data-table th {
            background: #4F46E5;
            color: white;
            padding: 8px 6px;
            text-align: left;
            font-weight: bold;
            border: 1px solid #4338CA;
        }
        
        .data-table td {
            padding: 6px;
            border: 1px solid #E2E8F0;
            vertical-align: top;
        }
        
        .data-table tr:nth-child(even) {
            background: #F8FAFC;
        }
        
        .data-table tr:hover {
            background: #EEF2FF;
        }
        
        .status-badge {
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 8px;
            font-weight: bold;
            text-align: center;
        }
        
        .status-available {
            background: #DCFCE7;
            color: #166534;
        }
        
        .status-unavailable {
            background: #FEE2E2;
            color: #991B1B;
        }
        
        .price-cell {
            text-align: right;
            font-weight: bold;
            color: #059669;
        }
        
        .footer {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 1px solid #E2E8F0;
            text-align: center;
            color: #6B7280;
            font-size: 8px;
        }
        
        .page-break {
            page-break-after: always;
        }
        
        .text-truncate {
            max-width: 150px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        
        .description-cell {
            max-width: 120px;
            word-wrap: break-word;
            font-size: 8px;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <h1>{{ $title }}</h1>
        <p class="subtitle">Laboratorium Fisika Komputasi - Universitas Negeri Padang</p>
        <div class="meta">
            Dicetak pada: {{ $date }} pukul {{ $time }} WIB
        </div>
    </div>

    <!-- Statistics Overview -->
    <div class="stats-grid">
        <div class="stats-row">
            <div class="stat-card">
                <div class="stat-value">{{ $stats['total'] }}</div>
                <div class="stat-label">Total Layanan</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">{{ $stats['available'] }}</div>
                <div class="stat-label">Tersedia</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">Rp {{ number_format($stats['average_price'] ?? 0, 0, ',', '.') }}</div>
                <div class="stat-label">Rata-rata Tarif</div>
            </div>
            <div class="stat-card">
                <div class="stat-value">Rp {{ number_format($stats['max_price'] ?? 0, 0, ',', '.') }}</div>
                <div class="stat-label">Tarif Tertinggi</div>
            </div>
        </div>
    </div>

    <!-- Data Table -->
    <div class="table-container">
        <table class="data-table">
            <thead>
                <tr>
                    <th style="width: 3%;">No</th>
                    <th style="width: 20%;">Nama Pengujian</th>
                    <th style="width: 12%;">Tarif (Rp)</th>
                    <th style="width: 25%;">Deskripsi</th>
                    <th style="width: 10%;">Estimasi Waktu</th>
                    <th style="width: 10%;">Kategori</th>
                    <th style="width: 8%;">Status</th>
                    <th style="width: 12%;">Dibuat</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jenisPengujian as $index => $item)
                    <tr>
                        <td style="text-align: center;">{{ $index + 1 }}</td>
                        <td>
                            <strong>{{ $item->namaPengujian }}</strong>
                        </td>
                        <td class="price-cell">{{ number_format($item->hargaPerSampel, 0, ',', '.') }}</td>
                        <td class="description-cell">
                            {{ $item->deskripsi ? Str::limit($item->deskripsi, 100) : '-' }}
                        </td>
                        <td style="text-align: center;">{{ $item->estimasiWaktu ?? '-' }}</td>
                        <td style="text-align: center;">{{ $item->kategori ?? '-' }}</td>
                        <td style="text-align: center;">
                            @if($item->isAvailable)
                                <span class="status-badge status-available">Tersedia</span>
                            @else
                                <span class="status-badge status-unavailable">Tidak Tersedia</span>
                            @endif
                        </td>
                        <td style="text-align: center;">{{ $item->created_at->format('d/m/Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>
            <strong>Laboratorium Fisika Komputasi</strong><br>
            Fakultas Matematika dan Ilmu Pengetahuan Alam<br>
            Universitas Negeri Padang<br>
            <em>Dokumen ini dibuat secara otomatis oleh sistem manajemen laboratorium</em>
        </p>
    </div>
</body>
</html> 