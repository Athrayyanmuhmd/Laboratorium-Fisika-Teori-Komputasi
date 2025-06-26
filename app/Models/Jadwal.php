<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwal';
    
    protected $fillable = [
        'pengujianId',
        'kunjunganId',
        'tanggalMulai',
        'tanggalSelesai',
    ];

    protected $casts = [
        'id' => 'string',
        'pengujianId' => 'string',
        'kunjunganId' => 'string',
        'tanggalMulai' => 'datetime',
        'tanggalSelesai' => 'datetime',
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

    // Relasi dengan Pengujian
    public function pengujian()
    {
        return $this->belongsTo(Pengujian::class, 'pengujianId');
    }

    // Relasi dengan Kunjungan
    public function kunjungan()
    {
        return $this->belongsTo(Kunjungan::class, 'kunjunganId');
    }

    public function getRouteKeyName()
    {
        return 'id';
    }
}
