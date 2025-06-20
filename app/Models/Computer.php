<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Computer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'brand',
        'model',
        'specs',
        'status',
        'current_user',
        'last_used',
        'usage_hours',
        'position_row',
        'position_col',
        'notes',
        'is_active'
    ];

    protected $casts = [
        'last_used' => 'datetime:H:i',
        'is_active' => 'boolean',
        'usage_hours' => 'integer',
        'position_row' => 'integer',
        'position_col' => 'integer'
    ];

    /**
     * Get the position attribute as an array
     */
    protected function position(): Attribute
    {
        return Attribute::make(
            get: fn () => [
                'row' => $this->position_row,
                'col' => $this->position_col
            ]
        );
    }

    /**
     * Scope for available computers
     */
    public function scopeAvailable($query)
    {
        return $query->where('status', 'available')->where('is_active', true);
    }

    /**
     * Scope for computers in use
     */
    public function scopeInUse($query)
    {
        return $query->where('status', 'in_use');
    }

    /**
     * Scope for computers in maintenance
     */
    public function scopeMaintenance($query)
    {
        return $query->where('status', 'maintenance');
    }

    /**
     * Scope for offline computers
     */
    public function scopeOffline($query)
    {
        return $query->where('status', 'offline');
    }

    /**
     * Scope for active computers
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Get computers ordered by position
     */
    public function scopeOrderedByPosition($query)
    {
        return $query->orderBy('position_row')->orderBy('position_col');
    }

    /**
     * Check if computer is available for use
     */
    public function isAvailable(): bool
    {
        return $this->status === 'available' && $this->is_active;
    }

    /**
     * Check if computer is currently in use
     */
    public function isInUse(): bool
    {
        return $this->status === 'in_use';
    }

    /**
     * Check if computer needs maintenance
     */
    public function needsMaintenance(): bool
    {
        return $this->status === 'maintenance';
    }

    /**
     * Check if computer is offline
     */
    public function isOffline(): bool
    {
        return $this->status === 'offline' || !$this->is_active;
    }

    /**
     * Start using the computer
     */
    public function startUsing(string $user): bool
    {
        if (!$this->isAvailable()) {
            return false;
        }

        return $this->update([
            'status' => 'in_use',
            'current_user' => $user,
            'last_used' => now(),
            'usage_hours' => 0
        ]);
    }

    /**
     * Stop using the computer
     */
    public function stopUsing(): bool
    {
        if (!$this->isInUse()) {
            return false;
        }

        return $this->update([
            'status' => 'available',
            'current_user' => null,
            'usage_hours' => 0
        ]);
    }

    /**
     * Set computer to maintenance
     */
    public function setMaintenance(string $notes = null): bool
    {
        return $this->update([
            'status' => 'maintenance',
            'current_user' => null,
            'usage_hours' => 0,
            'notes' => $notes
        ]);
    }

    /**
     * Set computer back online
     */
    public function setOnline(): bool
    {
        return $this->update([
            'status' => 'available',
            'current_user' => null,
            'usage_hours' => 0,
            'notes' => null
        ]);
    }

    /**
     * Get status color for UI
     */
    public function getStatusColor(): string
    {
        return match($this->status) {
            'available' => 'green',
            'in_use' => 'blue',
            'maintenance' => 'orange',
            'offline' => 'red',
            default => 'gray'
        };
    }

    /**
     * Get status label
     */
    public function getStatusLabel(): string
    {
        return match($this->status) {
            'available' => 'Tersedia',
            'in_use' => 'Sedang Digunakan',
            'maintenance' => 'Maintenance',
            'offline' => 'Offline',
            default => 'Unknown'
        };
    }
}
