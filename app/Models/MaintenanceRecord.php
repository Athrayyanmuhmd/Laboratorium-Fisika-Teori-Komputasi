<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MaintenanceRecord extends Model
{
    use HasFactory;

    protected $fillable = [
        'equipment_id',
        'type',
        'scheduled_date',
        'completed_date',
        'description',
        'cost',
        'technician_name',
        'vendor',
        'status',
        'notes',
        'checklist',
        'next_maintenance_date',
        'documents',
        'result'
    ];

    protected $casts = [
        'scheduled_date' => 'date',
        'completed_date' => 'date',
        'next_maintenance_date' => 'date',
        'cost' => 'decimal:2',
        'checklist' => 'array',
        'documents' => 'array'
    ];

    public function equipment(): BelongsTo
    {
        return $this->belongsTo(Equipment::class);
    }

    public function scopeScheduled($query)
    {
        return $query->where('status', 'scheduled');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeByType($query, $type)
    {
        return $query->where('type', $type);
    }
}
