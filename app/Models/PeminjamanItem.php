<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PeminjamanItem extends Model
{
    use HasFactory;

    protected $table = 'peminjamanItem';
    
    protected $fillable = [
        'peminjamanId',
        'alat_id',
        'jumlah',
    ];

    protected $casts = [
        'id' => 'string',
        'peminjamanId' => 'string',
        'alat_id' => 'string',
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

    // Relasi dengan Peminjaman
    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'peminjamanId');
    }

    // Relasi dengan Alat
    public function alat()
    {
        return $this->belongsTo(Alat::class, 'alat_id');
    }

    public function getRouteKeyName()
    {
        return 'id';
    }
}
