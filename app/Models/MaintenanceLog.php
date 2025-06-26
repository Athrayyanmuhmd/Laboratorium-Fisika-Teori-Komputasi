<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class MaintenanceLog extends Model
{
    use HasFactory;

    protected $table = 'maintenance_log';
    
    protected $fillable = [
        'alat_id',
        'jenis_maintenance',
        'tanggal_maintenance',
        'deskripsi_kegiatan',
        'biaya',
        'teknisi',
        'status',
        'catatan',
    ];

    protected $casts = [
        'id' => 'string',
        'tanggal_maintenance' => 'date',
        'biaya' => 'decimal:2',
    ];

    public $incrementing = false;
    protected $keyType = 'string';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    // Relasi dengan Alat
    public function alat()
    {
        return $this->belongsTo(Alat::class, 'alat_id');
    }

    // Status badge untuk UI
    public function getStatusBadgeAttribute()
    {
        $badges = [
            'DIJADWALKAN' => 'bg-yellow-100 text-yellow-800',
            'SEDANG_PROSES' => 'bg-blue-100 text-blue-800',
            'SELESAI' => 'bg-green-100 text-green-800',
            'DITUNDA' => 'bg-red-100 text-red-800',
        ];

        return $badges[$this->status] ?? 'bg-gray-100 text-gray-800';
    }

    // Jenis maintenance badge
    public function getJenisBadgeAttribute()
    {
        $badges = [
            'PREVENTIF' => 'bg-green-100 text-green-800',
            'KOREKTIF' => 'bg-red-100 text-red-800',
            'KALIBRASI' => 'bg-blue-100 text-blue-800',
            'PEMBERSIHAN' => 'bg-purple-100 text-purple-800',
        ];

        return $badges[$this->jenis_maintenance] ?? 'bg-gray-100 text-gray-800';
    }

    public function getRouteKeyName()
    {
        return 'id';
    }
} 