<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 11px;
            line-height: 1.4;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #4f46e5;
            padding-bottom: 20px;
        }

        .header h1 {
            color: #4f46e5;
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .header .subtitle {
            color: #6b7280;
            font-size: 12px;
            margin-bottom: 10px;
        }

        .header .meta {
            color: #9ca3af;
            font-size: 10px;
            font-style: italic;
        }

        .stats-section {
            margin-bottom: 25px;
            background: #f8fafc;
            padding: 15px;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
        }

        .stats-grid {
            display: table;
            width: 100%;
        }

        .stat-item {
            display: table-cell;
            text-align: center;
            vertical-align: top;
            width: 25%;
            padding: 5px;
        }

        .stat-number {
            font-size: 18px;
            font-weight: bold;
            color: #4f46e5;
        }

        .stat-label {
            font-size: 10px;
            color: #6b7280;
            text-transform: uppercase;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
        }

        th {
            background: linear-gradient(135deg, #4f46e5, #7c3aed);
            color: white;
            padding: 12px 8px;
            text-align: left;
            font-weight: bold;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        td {
            padding: 10px 8px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 10px;
            vertical-align: top;
        }

        tr:nth-child(even) {
            background-color: #f9fafb;
        }

        tr:hover {
            background-color: #f3f4f6;
        }

        .status-badge {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .status-pending {
            background-color: #fef3c7;
            color: #92400e;
        }

        .status-processing {
            background-color: #dbeafe;
            color: #1e40af;
        }

        .status-completed {
            background-color: #d1fae5;
            color: #065f46;
        }

        .status-cancelled {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .no-data {
            text-align: center;
            padding: 40px;
            color: #9ca3af;
            font-style: italic;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 9px;
            color: #9ca3af;
            border-top: 1px solid #e5e7eb;
            padding-top: 15px;
        }

        .page-break {
            page-break-after: always;
        }

        @media print {
            body {
                -webkit-print-color-adjust: exact;
                color-adjust: exact;
            }
        }

        .text-truncate {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            max-width: 150px;
        }
    </style>
</head>
<body>
    <!-- Header Section -->
    <div class="header">
        <h1>{{ $title }}</h1>
        <div class="subtitle">Laboratorium Fisika Komputasi</div>
        <div class="meta">
            Digenerate pada: {{ $date }} pukul {{ $time }} WIB
        </div>
    </div>

    <!-- Statistics Section -->
    <div class="stats-section">
        <h3 style="margin-bottom: 15px; color: #374151; text-align: center;">Ringkasan Data Peminjaman</h3>
        <div class="stats-grid">
            <div class="stat-item">
                <div class="stat-number">{{ $peminjaman->where('status', 'PENDING')->count() }}</div>
                <div class="stat-label">Pending</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">{{ $peminjaman->where('status', 'PROCESSING')->count() }}</div>
                <div class="stat-label">Diproses</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">{{ $peminjaman->where('status', 'COMPLETED')->count() }}</div>
                <div class="stat-label">Selesai</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">{{ $peminjaman->where('status', 'CANCELLED')->count() }}</div>
                <div class="stat-label">Dibatalkan</div>
            </div>
        </div>
    </div>

    <!-- Main Table -->
    @if($peminjaman->count() > 0)
        <table>
            <thead>
                <tr>
                    <th style="width: 3%;">No</th>
                    <th style="width: 15%;">Nama Peminjam</th>
                    <th style="width: 10%;">No HP</th>
                    <th style="width: 20%;">Tujuan Peminjaman</th>
                    <th style="width: 8%;">Tgl Pinjam</th>
                    <th style="width: 8%;">Tgl Kembali</th>
                    <th style="width: 8%;">Status</th>
                    <th style="width: 5%;">Jml Alat</th>
                    <th style="width: 18%;">Nama Alat</th>
                    <th style="width: 5%;">Dibuat</th>
                </tr>
            </thead>
            <tbody>
                @foreach($peminjaman as $index => $item)
                    <tr>
                        <td style="text-align: center;">{{ $index + 1 }}</td>
                        <td>
                            <strong>{{ $item->namaPeminjam }}</strong>
                        </td>
                        <td>{{ $item->noHp }}</td>
                        <td>
                            <div class="text-truncate" title="{{ $item->tujuanPeminjaman }}">
                                {{ Str::limit($item->tujuanPeminjaman, 40) }}
                            </div>
                        </td>
                        <td style="text-align: center;">{{ $item->tanggal_pinjam->format('d/m/Y') }}</td>
                        <td style="text-align: center;">{{ $item->tanggal_pengembalian->format('d/m/Y') }}</td>
                        <td style="text-align: center;">
                            <span class="status-badge 
                                @switch($item->status)
                                    @case('PENDING') status-pending @break
                                    @case('PROCESSING') status-processing @break
                                    @case('COMPLETED') status-completed @break
                                    @case('CANCELLED') status-cancelled @break
                                @endswitch
                            ">
                                {{ $item->status }}
                            </span>
                        </td>
                        <td style="text-align: center;">
                            <strong>{{ $item->alat->count() }}</strong>
                        </td>
                        <td>
                            @if($item->alat->count() > 0)
                                <div class="text-truncate" title="{{ $item->alat->pluck('nama')->join(', ') }}">
                                    {{ $item->alat->pluck('nama')->take(2)->join(', ') }}
                                    @if($item->alat->count() > 2)
                                        <small>(+{{ $item->alat->count() - 2 }} lainnya)</small>
                                    @endif
                                </div>
                            @else
                                <em style="color: #9ca3af;">Tidak ada alat</em>
                            @endif
                        </td>
                        <td style="text-align: center; font-size: 9px;">
                            {{ $item->created_at->format('d/m/y') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="no-data">
            <strong>Tidak ada data peminjaman untuk ditampilkan.</strong>
        </div>
    @endif

    <!-- Footer -->
    <div class="footer">
        <p>
            <strong>Total Data:</strong> {{ $peminjaman->count() }} peminjaman | 
            <strong>Dokumen:</strong> {{ $title }} | 
            <strong>Sistem:</strong> Laboratorium Fisika Komputasi
        </p>
        <p style="margin-top: 5px;">
            Dokumen ini digenerate secara otomatis oleh sistem pada {{ $date }} {{ $time }} WIB
        </p>
    </div>
</body>
</html> 