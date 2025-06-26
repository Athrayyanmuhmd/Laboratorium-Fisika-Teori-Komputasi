<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $title }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Arial', sans-serif; font-size: 12px; line-height: 1.4; color: #333; }
        .header { background: linear-gradient(135deg, #3b82f6, #1e40af); color: white; padding: 20px; text-align: center; margin-bottom: 20px; }
        .header h1 { font-size: 24px; font-weight: bold; margin-bottom: 5px; }
        .export-info { background: #f8fafc; border: 1px solid #e5e7eb; padding: 15px; margin-bottom: 20px; display: flex; justify-content: space-between; }
        .stats-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 15px; margin-bottom: 20px; }
        .stat-box { background: white; border: 1px solid #e5e7eb; padding: 12px; text-align: center; }
        .stat-number { font-size: 20px; font-weight: bold; color: #3b82f6; margin-bottom: 5px; }
        table { width: 100%; border-collapse: collapse; }
        thead th { padding: 12px 8px; background: #f9fafb; font-weight: 600; border-bottom: 2px solid #e5e7eb; font-size: 11px; }
        tbody td { padding: 10px 8px; font-size: 10px; border-bottom: 1px solid #f3f4f6; }
        .status-badge { padding: 3px 8px; border-radius: 12px; font-size: 9px; font-weight: 500; }
        .status-aktif { background: #dcfce7; color: #166534; }
        .status-nonaktif { background: #fef2f2; color: #991b1b; }
        .website-ya { background: #dbeafe; color: #1e40af; }
        .website-tidak { background: #f3f4f6; color: #6b7280; }
        .footer { margin-top: 30px; padding: 15px; text-align: center; font-size: 10px; color: #6b7280; border-top: 1px solid #e5e7eb; }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ $title }}</h1>
        <p>Laboratorium Fisika Komputasi - Universitas Syiah Kuala</p>
    </div>

    <div class="export-info">
        <div><strong>Total Data:</strong> {{ $stats['total'] }} staff</div>
        <div>Diekspor pada: {{ $date }} pukul {{ $time }}</div>
    </div>

    <div class="stats-grid">
        <div class="stat-box">
            <div class="stat-number">{{ $stats['total'] }}</div>
            <div>Total Staff</div>
        </div>
        <div class="stat-box">
            <div class="stat-number">{{ $stats['aktif'] }}</div>
            <div>Staff Aktif</div>
        </div>
        <div class="stat-box">
            <div class="stat-number">{{ $stats['website'] }}</div>
            <div>Tampil Website</div>
        </div>
        <div class="stat-box">
            <div class="stat-number">{{ $stats['dengan_foto'] }}</div>
            <div>Dengan Foto</div>
        </div>
    </div>

    @if($pengurus->count() > 0)
        <table>
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="20%">Nama</th>
                    <th width="15%">Jabatan</th>
                    <th width="15%">Email</th>
                    <th width="10%">Telepon</th>
                    <th width="15%">Spesialisasi</th>
                    <th width="8%">Status</th>
                    <th width="7%">Website</th>
                    <th width="8%">Bergabung</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pengurus as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        <strong>{{ $item->nama }}</strong>
                        @if($item->education)
                            <br><small>{{ $item->education }}</small>
                        @endif
                    </td>
                    <td>{{ $item->jabatan }}</td>
                    <td>{{ $item->email ?? '-' }}</td>
                    <td>{{ $item->phone ?? '-' }}</td>
                    <td>{{ $item->specialization ?? '-' }}</td>
                    <td>
                        <span class="status-badge {{ $item->is_active ? 'status-aktif' : 'status-nonaktif' }}">
                            {{ $item->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </td>
                    <td>
                        <span class="status-badge {{ $item->show_on_website ? 'website-ya' : 'website-tidak' }}">
                            {{ $item->show_on_website ? 'Ya' : 'Tidak' }}
                        </span>
                    </td>
                    <td>{{ $item->join_date ? $item->join_date->format('d/m/Y') : '-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div style="text-align: center; padding: 40px;">
            <h3>Tidak ada data pengurus</h3>
            <p>Belum ada data pengurus yang tersedia untuk diekspor.</p>
        </div>
    @endif

    <div class="footer">
        <p><strong>Laboratorium Fisika Komputasi</strong></p>
        <p>Fakultas MIPA - Universitas Syiah Kuala</p>
        <p>Dokumen dibuat otomatis pada {{ $date }} {{ $time }}</p>
    </div>
</body>
</html> 