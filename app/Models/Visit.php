<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Visit extends Model
{
    use HasFactory;

    protected $fillable = [
        'visit_code',
        'laboratory_id',
        'visitor_name',
        'visitor_email',
        'visitor_phone',
        'institution',
        'group_leader',
        'participant_count',
        'visit_type',
        'purpose',
        'preferred_date',
        'preferred_start_time',
        'preferred_end_time',
        'scheduled_date',
        'scheduled_start_time',
        'scheduled_end_time',
        'status',
        'requirements',
        'admin_notes',
        'visit_notes',
        'documents',
        'approved_at',
        'completed_at',
        'approved_by'
    ];

    protected $casts = [
        'preferred_date' => 'date',
        'scheduled_date' => 'date',
        'preferred_start_time' => 'datetime:H:i',
        'preferred_end_time' => 'datetime:H:i',
        'scheduled_start_time' => 'datetime:H:i',
        'scheduled_end_time' => 'datetime:H:i',
        'documents' => 'array',
        'approved_at' => 'datetime',
        'completed_at' => 'datetime'
    ];

    public function laboratory(): BelongsTo
    {
        return $this->belongsTo(Laboratory::class);
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeUpcoming($query)
    {
        return $query->where('status', 'approved')->where('scheduled_date', '>=', now());
    }
}
