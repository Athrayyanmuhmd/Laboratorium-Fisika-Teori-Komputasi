<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WorkstationRental extends Model
{
    use HasFactory;

    protected $fillable = [
        'request_code',
        'name',
        'institution',
        'email',
        'workstation_type',
        'start_date',
        'end_date',
        'research_purpose',
        'status',
        'admin_notes',
        'approved_at',
        'approved_by'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'approved_at' => 'datetime'
    ];

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function getWorkstationTypeLabel(): string
    {
        return match($this->workstation_type) {
            'pc_high_performance' => 'PC High-Performance untuk Simulasi Fisika',
            'software_geofisika' => 'Software Geofisika dan Komputasi Terintegrasi',
            'tools_fotografi' => 'Tools Fotografi Digital dan Web Design',
            'environment_programming' => 'Environment Programming Terintegrasi',
            default => $this->workstation_type
        };
    }

    public function getStatusLabel(): string
    {
        return match($this->status) {
            'pending' => 'Menunggu Persetujuan',
            'approved' => 'Disetujui',
            'rejected' => 'Ditolak',
            'completed' => 'Selesai',
            default => $this->status
        };
    }
} 