<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PengujianItem extends Model
{
    use HasFactory;

    protected $table = 'pengujianItem';
    
    protected $fillable = [
        'jenisPengujianId',
        'pengujianId',
    ];

    protected $casts = [
        'id' => 'string',
        'jenisPengujianId' => 'string',
        'pengujianId' => 'string',
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

    // Relasi dengan JenisPengujian
    public function jenisPengujian()
    {
        return $this->belongsTo(JenisPengujian::class, 'jenisPengujianId');
    }

    // Relasi dengan Pengujian
    public function pengujian()
    {
        return $this->belongsTo(Pengujian::class, 'pengujianId');
    }

    public function getRouteKeyName()
    {
        return 'id';
    }
}
