<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Kunjungan extends Model
{
    use HasFactory;

    protected $table = 'kunjungan';
    
    protected $fillable = [
        'namaPengunjung',
        'instansiAsal',
        'tujuan',
        'tujuanKunjungan',
        'jumlahPengunjung',
        'tanggal_kunjungan',
        'waktu_mulai',
        'waktu_selesai',
        'jenis_kunjungan',
        'catatan_kunjungan',
        'petugas_pemandu',
        'status',
    ];

    protected $casts = [
        'id' => 'string',
        'tanggal_kunjungan' => 'date',
        'waktu_mulai' => 'datetime',
        'waktu_selesai' => 'datetime',
    ];

    public $incrementing = false;
    protected $keyType = 'string';

    // Add accessor for camelCase compatibility
    public function getTanggalKunjunganAttribute($value)
    {
        return $this->attributes['tanggal_kunjungan'] ? $this->asDate($this->attributes['tanggal_kunjungan']) : null;
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    // Relasi dengan Jadwal
    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'kunjunganId');
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

    public function getRouteKeyName()
    {
        return 'id';
    }
}
