<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Laboratory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'vision',
        'mission',
        'facilities',
        'location',
        'phone',
        'email',
        'operating_hours',
        'head_of_lab',
        'status',
        'image',
        'staff'
    ];

    protected $casts = [
        'facilities' => 'array',
        'operating_hours' => 'array',
        'staff' => 'array'
    ];

    public function equipment(): HasMany
    {
        return $this->hasMany(Equipment::class);
    }

    public function rentals(): HasMany
    {
        return $this->hasMany(Rental::class);
    }

    public function visits(): HasMany
    {
        return $this->hasMany(Visit::class);
    }

    public function tests(): HasMany
    {
        return $this->hasMany(Test::class);
    }

    public function galleries(): HasMany
    {
        return $this->hasMany(Gallery::class);
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function availableEquipment(): HasMany
    {
        return $this->hasMany(Equipment::class)->where('status', 'available');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
