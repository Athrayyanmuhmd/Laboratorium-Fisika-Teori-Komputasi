<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilLaboratorium extends Model
{
    use HasFactory;

    protected $table = 'profilLaboratorium';
    
    protected $fillable = [
        'namaLaboratorium',
        'tentangLaboratorium',
        'visi',
        'misiId',
    ];

    protected $casts = [
        'misiId' => 'string',
    ];

    // Relasi dengan Misi
    public function misi()
    {
        return $this->belongsTo(Misi::class, 'misiId');
    }
}
