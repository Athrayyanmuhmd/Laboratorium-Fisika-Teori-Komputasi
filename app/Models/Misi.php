<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Misi extends Model
{
    use HasFactory;

    protected $table = 'misi';
    
    protected $fillable = [
        'pointMisi',
    ];

    protected $casts = [
        'id' => 'string',
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

    // Relasi dengan ProfilLaboratorium
    public function profilLaboratorium()
    {
        return $this->hasMany(ProfilLaboratorium::class, 'misiId');
    }

    public function getRouteKeyName()
    {
        return 'id';
    }
}
