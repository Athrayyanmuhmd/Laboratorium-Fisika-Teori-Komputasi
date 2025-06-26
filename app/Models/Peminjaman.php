<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';
    
    protected $fillable = [
        'namaPeminjam',
        'noHp',
        'tujuanPeminjaman',
        'tanggal_pinjam',
        'tanggal_pengembalian',
        'status',
    ];

    protected $casts = [
        'id' => 'string',
        'tanggal_pinjam' => 'date',
        'tanggal_pengembalian' => 'date',
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

    // Relasi dengan PeminjamanItem
    public function peminjamanItems()
    {
        return $this->hasMany(PeminjamanItem::class, 'peminjamanId');
    }

    // Relasi dengan Alat melalui PeminjamanItem
    public function alat()
    {
        return $this->belongsToMany(Alat::class, 'peminjamanItem', 'peminjamanId', 'alat_id')
                    ->withPivot('jumlah')
                    ->withTimestamps();
    }

    public function getStatusBadgeAttribute()
    {
        $badges = [
            'PENDING' => 'bg-yellow-100 text-yellow-800',
            'PROCESSING' => 'bg-blue-100 text-blue-800',
            'COMPLETED' => 'bg-green-100 text-green-800',
            'CANCELLED' => 'bg-red-100 text-red-800',
        ];

        return $badges[$this->status] ?? 'bg-gray-100 text-gray-800';
    }

    public function getRouteKeyName()
    {
        return 'id';
    }
}
