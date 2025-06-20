<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rental extends Model
{
    use HasFactory;

    protected $fillable = [
        'rental_code',
        'equipment_id',
        'renter_name',
        'renter_email',
        'renter_phone',
        'renter_institution',
        'renter_id_number',
        'purpose',
        'quantity',
        'start_date',
        'end_date',
        'total_cost',
        'status',
        'admin_notes',
        'actual_return_date',
        'return_condition',
        'return_notes',
        'penalty_fee',
        'approved_at',
        'returned_at',
        'approved_by',
        'returned_by'
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'actual_return_date' => 'date',
        'total_cost' => 'decimal:2',
        'penalty_fee' => 'decimal:2',
        'approved_at' => 'datetime',
        'returned_at' => 'datetime'
    ];

    public function equipment(): BelongsTo
    {
        return $this->belongsTo(Equipment::class);
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function returnedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'returned_by');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeOverdue($query)
    {
        return $query->where('status', 'ongoing')->where('end_date', '<', now());
    }

    public function isOverdue(): bool
    {
        return $this->status === 'ongoing' && $this->end_date < now();
    }
}
