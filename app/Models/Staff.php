<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = [
        'laboratory_id',
        'name',
        'position',
        'email',
        'phone',
        'bio',
        'specialization',
        'education',
        'photo_path',
        'is_active',
        'is_featured',
        'sort_order'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'sort_order' => 'integer'
    ];

    public function laboratory()
    {
        return $this->belongsTo(Laboratory::class);
    }
}
