<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LabVisit extends Model
{
    use HasFactory;

    protected $fillable = [
        'visit_code',
        'pic_name',
        'institution',
        'contact',
        'visit_type',
        'visit_date',
        'participant_count',
        'purpose_expectations',
        'status',
        'admin_notes',
        'approved_at',
        'approved_by'
    ];

    protected $casts = [
        'visit_date' => 'date',
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

    public function getVisitTypeLabel(): string
    {
        return match($this->visit_type) {
            'tur_fasilitas' => 'Tur Fasilitas 28 PC Workstation',
            'workshop_simulasi' => 'Workshop Simulasi dan Komputasi Fisika',
            'demo_software' => 'Demo Software Geofisika dan Visualisasi',
            'konsultasi_ahli' => 'Sesi Konsultasi dengan Tim Ahli',
            default => $this->visit_type
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