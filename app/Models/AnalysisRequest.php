<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AnalysisRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'request_code',
        'researcher_name',
        'affiliation',
        'email',
        'analysis_type',
        'data_description',
        'analysis_parameters',
        'target_deadline',
        'status',
        'admin_notes',
        'results',
        'approved_at',
        'completed_at',
        'approved_by',
        'analyst_id'
    ];

    protected $casts = [
        'target_deadline' => 'date',
        'approved_at' => 'datetime',
        'completed_at' => 'datetime'
    ];

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function analyst(): BelongsTo
    {
        return $this->belongsTo(User::class, 'analyst_id');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeInProgress($query)
    {
        return $query->where('status', 'in_progress');
    }

    public function getAnalysisTypeLabel(): string
    {
        return match($this->analysis_type) {
            'simulasi_numerik' => 'Simulasi Numerik dan Pemodelan Fisika',
            'analisis_data_geofisika' => 'Analisis Data Geofisika dan Komputasi',
            'visualisasi_data' => 'Visualisasi Data dan Rendering Grafis',
            'laporan_komprehensif' => 'Laporan Analisis Komprehensif',
            default => $this->analysis_type
        };
    }

    public function getStatusLabel(): string
    {
        return match($this->status) {
            'pending' => 'Menunggu Persetujuan',
            'approved' => 'Disetujui',
            'rejected' => 'Ditolak',
            'in_progress' => 'Sedang Diproses',
            'completed' => 'Selesai',
            default => $this->status
        };
    }
} 