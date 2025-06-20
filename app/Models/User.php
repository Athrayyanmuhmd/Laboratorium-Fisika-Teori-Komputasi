<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'laboratory_id',
        'phone',
        'position',
        'bio',
        'avatar',
        'is_active'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean'
        ];
    }

    public function laboratory(): BelongsTo
    {
        return $this->belongsTo(Laboratory::class);
    }

    public function approvedRentals(): HasMany
    {
        return $this->hasMany(Rental::class, 'approved_by');
    }

    public function returnedRentals(): HasMany
    {
        return $this->hasMany(Rental::class, 'returned_by');
    }

    public function approvedVisits(): HasMany
    {
        return $this->hasMany(Visit::class, 'approved_by');
    }

    public function approvedTests(): HasMany
    {
        return $this->hasMany(Test::class, 'approved_by');
    }

    public function analyzedTests(): HasMany
    {
        return $this->hasMany(Test::class, 'analyst_id');
    }

    public function isAdmin(): bool
    {
        return in_array($this->role, ['super_admin', 'lab_admin', 'dosen']);
    }

    public function isSuperAdmin(): bool
    {
        return $this->role === 'super_admin';
    }

    public function isLabAdmin(): bool
    {
        return $this->role === 'lab_admin';
    }

    public function canManageLab($laboratoryId = null): bool
    {
        if ($this->isSuperAdmin()) {
            return true;
        }

        if ($this->isLabAdmin() && $laboratoryId) {
            return $this->laboratory_id == $laboratoryId;
        }

        return false;
    }
}
