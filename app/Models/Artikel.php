<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Artikel extends Model
{
    use HasFactory;

    protected $table = 'artikel';
    
    protected $fillable = [
        'namaAcara',
        'deskripsi',
        'penulis',
        'tanggalAcara',
        'kategori',
        'tags',
        'status',
    ];

    protected $casts = [
        'id' => 'string',
        'tanggalAcara' => 'date',
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

    // Relasi dengan Gambar
    public function gambar()
    {
        return $this->hasMany(Gambar::class, 'acaraId');
    }

    public function getRouteKeyName()
    {
        return 'id';
    }
}
