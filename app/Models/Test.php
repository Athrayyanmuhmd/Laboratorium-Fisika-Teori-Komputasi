<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Test extends Model
{
    use HasFactory;

    protected $fillable = [
        'test_code',
        'laboratory_id',
        'client_name',
        'client_email',
        'client_phone',
        'client_institution',
        'sample_name',
        'sample_description',
        'test_parameters',
        'test_method',
        'test_type',
        'sample_quantity',
        'sample_unit',
        'received_date',
        'target_completion_date',
        'actual_completion_date',
        'estimated_cost',
        'final_cost',
        'status',
        'special_requirements',
        'admin_notes',
        'test_results',
        'test_documents',
        'analyst_notes',
        'approved_at',
        'started_at',
        'completed_at',
        'approved_by',
        'analyst_id'
    ];

    protected $casts = [
        'test_parameters' => 'array',
        'test_results' => 'array',
        'test_documents' => 'array',
        'received_date' => 'date',
        'target_completion_date' => 'date',
        'actual_completion_date' => 'date',
        'estimated_cost' => 'decimal:2',
        'final_cost' => 'decimal:2',
        'approved_at' => 'datetime',
        'started_at' => 'datetime',
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

    public function analyst(): BelongsTo
    {
        return $this->belongsTo(User::class, 'analyst_id');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeInProgress($query)
    {
        return $query->where('status', 'in_progress');
    }
}
