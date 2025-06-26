<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Alat extends Model
{
    use HasFactory;

    protected $table = 'alat';
    
    protected $fillable = [
        'nama',
        'deskripsi',
        'stok',
        'isBroken',
        'harga',
        'gambar',
        'tanggal_kalibrasi_terakhir',
        'tanggal_kalibrasi_berikutnya',
        'status_kalibrasi',
        'riwayat_maintenance',
        'lokasi_penyimpanan',
        'kode_alat',
    ];

    protected $casts = [
        'id' => 'string',
        'isBroken' => 'boolean',
        'harga' => 'decimal:2',
        'tanggal_kalibrasi_terakhir' => 'date',
        'tanggal_kalibrasi_berikutnya' => 'date',
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

    // Relasi dengan PeminjamanItem
    public function peminjamanItems()
    {
        return $this->hasMany(PeminjamanItem::class, 'alat_id');
    }

    // Relasi dengan Peminjaman melalui PeminjamanItem
    public function peminjaman()
    {
        return $this->belongsToMany(Peminjaman::class, 'peminjamanItem', 'alat_id', 'peminjamanId')
                    ->withPivot('jumlah')
                    ->withTimestamps();
    }

    // Relasi dengan MaintenanceLog
    public function maintenanceLogs()
    {
        return $this->hasMany(MaintenanceLog::class, 'alat_id');
    }

    // Status kalibrasi badge
    public function getStatusKalibasiBadgeAttribute()
    {
        $badges = [
            'VALID' => 'bg-green-100 text-green-800',
            'EXPIRED' => 'bg-red-100 text-red-800',
            'PENDING' => 'bg-yellow-100 text-yellow-800',
        ];

        return $badges[$this->status_kalibrasi] ?? 'bg-gray-100 text-gray-800';
    }

    // Check if calibration is due soon (within 30 days)
    public function getIsCalibrationDueSoonAttribute()
    {
        if (!$this->tanggal_kalibrasi_berikutnya) return false;
        
        return $this->tanggal_kalibrasi_berikutnya->diffInDays(now()) <= 30;
    }

    // Get status ketersediaan
    public function getStatusKetersediaanAttribute()
    {
        if ($this->isBroken) return 'Rusak';
        if ($this->stok <= 0) return 'Habis';
        if ($this->status_kalibrasi === 'EXPIRED') return 'Perlu Kalibrasi';
        return 'Tersedia';
    }

    public function getRouteKeyName()
    {
        return 'id';
    }
}
