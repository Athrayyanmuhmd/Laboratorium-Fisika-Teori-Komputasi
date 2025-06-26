<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Gambar extends Model
{
    use HasFactory;

    protected $table = 'gambar';
    
    protected $fillable = [
        'pengurusId',
        'acaraId',
        'url',
        'kategori',
    ];

    protected $casts = [
        'id' => 'string',
        'pengurusId' => 'string',
        'acaraId' => 'string',
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

    // Relasi dengan BiodataPengurus
    public function biodataPengurus()
    {
        return $this->belongsTo(BiodataPengurus::class, 'pengurusId');
    }

    // Relasi dengan Artikel
    public function artikel()
    {
        return $this->belongsTo(Artikel::class, 'acaraId');
    }

    public function getRouteKeyName()
    {
        return 'id';
    }
}
