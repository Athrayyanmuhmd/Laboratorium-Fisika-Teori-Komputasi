<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class JenisPengujian extends Model
{
    use HasFactory;

    protected $table = 'jenisPengujian';
    
    protected $fillable = [
        'namaPengujian',
        'hargaPerSampel',
        'deskripsi',
        'estimasiWaktu',
        'kategori',
        'isAvailable',
    ];

    protected $casts = [
        'id' => 'string',
        'hargaPerSampel' => 'decimal:2',
        'isAvailable' => 'boolean',
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
        return $this->hasMany(PengujianItem::class, 'jenisPengujianId');
    }

    // Relasi dengan Pengujian melalui PengujianItem
    public function pengujian()
    {
        return $this->belongsToMany(Pengujian::class, 'pengujianItem', 'jenisPengujianId', 'pengujianId')
                    ->withTimestamps();
    }

    public function getRouteKeyName()
    {
        return 'id';
    }
}
