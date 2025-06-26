<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Notification extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'message',
        'type',
        'category',
        'related_id',
        'related_type',
        'is_read',
        'read_at',
    ];

    protected $casts = [
        'id' => 'string',
        'is_read' => 'boolean',
        'read_at' => 'datetime',
    ];

    public $incrementing = false;
    protected $keyType = 'string';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    // Relasi polymorphic dengan record terkait
    public function related()
    {
        return $this->morphTo('related', 'related_type', 'related_id');
    }

    // Mark as read
    public function markAsRead()
    {
        $this->update([
            'is_read' => true,
            'read_at' => now(),
        ]);
    }

    // Type badge untuk UI
    public function getTypeBadgeAttribute()
    {
        $badges = [
            'INFO' => 'bg-blue-100 text-blue-800',
            'SUCCESS' => 'bg-green-100 text-green-800',
            'WARNING' => 'bg-yellow-100 text-yellow-800',
            'ERROR' => 'bg-red-100 text-red-800',
        ];

        return $badges[$this->type] ?? 'bg-gray-100 text-gray-800';
    }

    // Type icon
    public function getTypeIconAttribute()
    {
        $icons = [
            'INFO' => 'fas fa-info-circle text-blue-500',
            'SUCCESS' => 'fas fa-check-circle text-green-500',
            'WARNING' => 'fas fa-exclamation-triangle text-yellow-500',
            'ERROR' => 'fas fa-times-circle text-red-500',
        ];

        return $icons[$this->type] ?? 'fas fa-bell text-gray-500';
    }

    // Category icon
    public function getCategoryIconAttribute()
    {
        $icons = [
            'PEMINJAMAN' => 'fas fa-handshake',
            'PENGUJIAN' => 'fas fa-flask',
            'KUNJUNGAN' => 'fas fa-users',
            'MAINTENANCE' => 'fas fa-tools',
            'SYSTEM' => 'fas fa-cog',
        ];

        return $icons[$this->category] ?? 'fas fa-bell';
    }

    // Scope untuk notifikasi yang belum dibaca
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    // Scope untuk notifikasi berdasarkan kategori
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function getRouteKeyName()
    {
        return 'id';
    }
} 