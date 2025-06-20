<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Equipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'laboratory_id',
        'code',
        'name',
        'description',
        'specifications',
        'brand',
        'model',
        'purchase_year',
        'purchase_price',
        'quantity',
        'available_quantity',
        'condition',
        'status',
        'category',
        'last_calibration',
        'next_calibration',
        'rental_price_per_day',
        'images',
        'notes'
    ];

    protected $casts = [
        'specifications' => 'array',
        'images' => 'array',
        'purchase_price' => 'decimal:2',
        'rental_price_per_day' => 'decimal:2',
        'last_calibration' => 'date',
        'next_calibration' => 'date'
    ];

    public function laboratory(): BelongsTo
    {
        return $this->belongsTo(Laboratory::class);
    }

    public function rentals(): HasMany
    {
        return $this->hasMany(Rental::class);
    }

    public function maintenanceRecords(): HasMany
    {
        return $this->hasMany(MaintenanceRecord::class);
    }

    public function scopeAvailable($query)
    {
        return $query->where('status', 'available')->where('available_quantity', '>', 0);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeByCondition($query, $condition)
    {
        return $query->where('condition', $condition);
    }

    public function isAvailable(): bool
    {
        return $this->status === 'available' && $this->available_quantity > 0;
    }

    public function needsCalibration(): bool
    {
        return $this->next_calibration && $this->next_calibration <= now();
    }
}
