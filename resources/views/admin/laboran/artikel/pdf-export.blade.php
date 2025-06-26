<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            margin: 0;
            padding: 20px;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 3px solid #3b82f6;
        }
        
        .header h1 {
            color: #1e40af;
            font-size: 24px;
            margin: 0 0 10px 0;
            font-weight: bold;
        }
        
        .header .subtitle {
            color: #6b7280;
            font-size: 14px;
            margin: 5px 0;
        }
        
        .meta-info {
            background: #f8fafc;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 25px;
            border-left: 4px solid #3b82f6;
        }
        
        .meta-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }
        
        .meta-row:last-child {
            margin-bottom: 0;
        }
        
        .meta-label {
            font-weight: bold;
            color: #374151;
            width: 140px;
        }
        
        .meta-value {
            color: #6b7280;
            flex: 1;
        }
        
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 15px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: #f1f5f9;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            border: 1px solid #e2e8f0;
        }
        
        .stat-number {
            font-size: 20px;
            font-weight: bold;
            color: #1e40af;
            margin-bottom: 5px;
        }
        
        .stat-label {
            font-size: 11px;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .content-section {
            margin-bottom: 25px;
        }
        
        .section-title {
            font-size: 16px;
            font-weight: bold;
            color: #1e40af;
            margin-bottom: 15px;
            padding-bottom: 5px;
            border-bottom: 2px solid #e2e8f0;
        }
        
        .artikel-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 11px;
        }
        
        .artikel-table th {
            background: #3b82f6;
            color: white;
            padding: 12px 8px;
            text-align: left;
            font-weight: bold;
            border: 1px solid #2563eb;
        }
        
        .artikel-table td {
            padding: 10px 8px;
            border: 1px solid #e2e8f0;
            vertical-align: top;
        }
        
        .artikel-table tr:nth-child(even) {
            background: #f8fafc;
        }
        
        .artikel-table tr:hover {
            background: #f1f5f9;
        }
        
        .status-badge {
            padding: 3px 8px;
            border-radius: 12px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
        }
        
        .status-published {
            background: #dcfce7;
            color: #166534;
        }
        
        .status-draft {
            background: #fef3c7;
            color: #92400e;
        }
        
        .status-archived {
            background: #fee2e2;
            color: #991b1b;
        }
        
        .image-indicator {
            display: inline-block;
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 10px;
            font-weight: bold;
        }
        
        .has-image {
            background: #dcfce7;
            color: #166534;
        }
        
        .no-image {
            background: #f3f4f6;
            color: #6b7280;
        }
        
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 10px;
            color: #9ca3af;
            border-top: 1px solid #e5e7eb;
            padding-top: 15px;
        }
        
        .page-break {
            page-break-before: always;
        }
        
        @page {
            margin: 2cm;
            @bottom-right {
                content: "Halaman " counter(page);
                font-size: 10px;
                color: #6b7280;
            }
        }
        
        .description-cell {
            max-width: 200px;
            word-wrap: break-word;
            line-height: 1.3;
        }
        
        .title-cell {
            max-width: 150px;
            font-weight: bold;
            color: #1e40af;
        }
        
        .author-cell {
            font-style: italic;
            color: #6b7280;
        }
        
        .date-cell {
            white-space: nowrap;
            font-size: 10px;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <h1>{{ $title }}</h1>
        <div class="subtitle">Laboratorium Fisika Komputasi</div>
        <div class="subtitle">Universitas Syiah Kuala</div>
    </div>

    <!-- Meta Information -->
    <div class="meta-info">
        <div class="meta-row">
            <span class="meta-label">Tanggal Export:</span>
            <span class="meta-value">{{ $date }}</span>
        </div>
        <div class="meta-row">
            <span class="meta-label">Waktu Export:</span>
            <span class="meta-value">{{ $time }}</span>
        </div>
        <div class="meta-row">
            <span class="meta-label">Total Data:</span>
            <span class="meta-value">{{ $stats['total'] }} artikel</span>
        </div>
        <div class="meta-row">
            <span class="meta-label">Status:</span>
            <span class="meta-value">Data Aktif Per {{ $date }}</span>
        </div>
    </div>

    <!-- Statistics Overview -->
    <div class="content-section">
        <div class="section-title">📊 Ringkasan Statistik</div>
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-number">{{ $stats['total'] }}</div>
                <div class="stat-label">Total Artikel</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $stats['with_image'] }}</div>
                <div class="stat-label">Dengan Gambar</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $stats['this_month'] }}</div>
                <div class="stat-label">Bulan Ini</div>
            </div>
            <div class="stat-card">
                <div class="stat-number">{{ $stats['this_week'] }}</div>
                <div class="stat-label">Minggu Ini</div>
            </div>
        </div>
    </div>

    <!-- Articles Data -->
    <div class="content-section">
        <div class="section-title">📝 Daftar Artikel & Berita</div>
        
        @if($artikel->count() > 0)
            <table class="artikel-table">
                <thead>
                    <tr>
                        <th style="width: 5%;">No</th>
                        <th style="width: 25%;">Judul Artikel</th>
                        <th style="width: 15%;">Penulis</th>
                        <th style="width: 12%;">Tgl Acara</th>
                        <th style="width: 12%;">Kategori</th>
                        <th style="width: 8%;">Status</th>
                        <th style="width: 8%;">Gambar</th>
                        <th style="width: 15%;">Dibuat</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($artikel as $index => $item)
                        <tr>
                            <td style="text-align: center;">{{ $index + 1 }}</td>
                            <td class="title-cell">{{ $item->namaAcara }}</td>
                            <td class="author-cell">{{ $item->penulis ?? '-' }}</td>
                            <td class="date-cell">
                                {{ $item->tanggalAcara ? $item->tanggalAcara->format('d/m/Y') : '-' }}
                            </td>
                            <td>{{ $item->kategori ?? '-' }}</td>
                            <td>
                                <span class="status-badge status-{{ $item->status ?? 'published' }}">
                                    {{ ucfirst($item->status ?? 'published') }}
                                </span>
                            </td>
                            <td style="text-align: center;">
                                @if($item->gambar->isNotEmpty())
                                    <span class="image-indicator has-image">✓</span>
                                @else
                                    <span class="image-indicator no-image">✗</span>
                                @endif
                            </td>
                            <td class="date-cell">{{ $item->created_at->format('d/m/Y H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div style="text-align: center; padding: 40px; color: #6b7280;">
                <div style="font-size: 48px; margin-bottom: 15px;">📝</div>
                <div style="font-size: 16px; font-weight: bold; margin-bottom: 8px;">Tidak Ada Data</div>
                <div style="font-size: 12px;">Belum ada artikel yang tersedia untuk ditampilkan</div>
            </div>
        @endif
    </div>

    <!-- Additional Information -->
    @if($artikel->count() > 0)
        <div class="content-section">
            <div class="section-title">ℹ️ Informasi Tambahan</div>
            <div style="background: #f8fafc; padding: 15px; border-radius: 8px; border-left: 4px solid #10b981;">
                <div style="margin-bottom: 10px;"><strong>Distribusi Status:</strong></div>
                <ul style="margin: 0; padding-left: 20px;">
                    <li>Published: {{ $artikel->where('status', 'published')->count() }} artikel</li>
                    <li>Draft: {{ $artikel->where('status', 'draft')->count() }} artikel</li>
                    <li>Archived: {{ $artikel->where('status', 'archived')->count() }} artikel</li>
                </ul>
                
                <div style="margin-top: 15px; margin-bottom: 10px;"><strong>Artikel dengan Media:</strong></div>
                <ul style="margin: 0; padding-left: 20px;">
                    <li>Dengan Gambar: {{ $artikel->filter(function($item) { return $item->gambar->isNotEmpty(); })->count() }} artikel</li>
                    <li>Tanpa Gambar: {{ $artikel->filter(function($item) { return $item->gambar->isEmpty(); })->count() }} artikel</li>
                </ul>
            </div>
        </div>
    @endif

    <!-- Footer -->
    <div class="footer">
        <div>Dokumen ini dibuat secara otomatis oleh Sistem Manajemen Laboratorium Fisika Komputasi</div>
        <div>Universitas Syiah Kuala - {{ $date }} {{ $time }}</div>
        <div style="margin-top: 5px; font-style: italic;">
            "Advancing Computational Physics Research Through Excellence"
        </div>
    </div>
</body>
</html> 