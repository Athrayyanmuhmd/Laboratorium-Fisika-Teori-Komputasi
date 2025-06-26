<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Pengujian extends Model
{
    use HasFactory;

    protected $table = 'pengujian';
    
    protected $fillable = [
        'namaPenguji',
        'noHpPenguji',
        'deskripsi',
        'totalHarga',
        'tanggalPengujian',
        'status',
        'hasil_pengujian',
        'file_hasil',
        'tanggal_selesai',
        'catatan_tambahan',
        'petugas_pengujian',
        'progress_persentase',
    ];

    protected $casts = [
        'id' => 'string',
        'totalHarga' => 'decimal:2',
        'tanggalPengujian' => 'date',
        'tanggal_selesai' => 'date',
        'progress_persentase' => 'decimal:2',
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

    // Relasi dengan PengujianItem
    public function pengujianItems()
    {
        return $this->hasMany(PengujianItem::class, 'pengujianId');
    }

    // Relasi dengan JenisPengujian melalui PengujianItem
    public function jenisPengujian()
    {
        return $this->belongsToMany(JenisPengujian::class, 'pengujianItem', 'pengujianId', 'jenisPengujianId')
                    ->withTimestamps();
    }

    // Relasi dengan Jadwal
    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'pengujianId');
    }

    public function getStatusBadgeAttribute()
    {
        $badges = [
            'PENDING' => 'bg-yellow-100 text-yellow-800',
            'PROCESSING' => 'bg-blue-100 text-blue-800',
            'COMPLETED' => 'bg-green-100 text-green-800',
            'CANCELLED' => 'bg-red-100 text-red-800',
        ];

        return $badges[$this->status] ?? 'bg-gray-100 text-gray-800';
    }

    // Relasi dengan PengujianFile
    public function files()
    {
        return $this->hasMany(PengujianFile::class, 'pengujian_id');
    }

    // Get progress percentage with color
    public function getProgressColorAttribute()
    {
        $progress = $this->progress_persentase;
        if ($progress <= 25) return 'bg-red-500';
        if ($progress <= 50) return 'bg-yellow-500';
        if ($progress <= 75) return 'bg-blue-500';
        return 'bg-green-500';
    }

    // Check if overdue
    public function getIsOverdueAttribute()
    {
        return $this->tanggalPengujian < now() && $this->status !== 'COMPLETED';
    }

    // Get estimated completion date
    public function getEstimatedCompletionAttribute()
    {
        if ($this->progress_persentase > 0) {
            $daysElapsed = $this->tanggalPengujian->diffInDays(now());
            $estimatedTotalDays = ($daysElapsed / $this->progress_persentase) * 100;
            return $this->tanggalPengujian->addDays($estimatedTotalDays);
        }
        return null;
    }

    public function getRouteKeyName()
    {
        return 'id';
    }
}
