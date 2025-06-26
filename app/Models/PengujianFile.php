<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PengujianFile extends Model
{
    use HasFactory;

    protected $table = 'pengujian_files';
    
    protected $fillable = [
        'pengujian_id',
        'nama_file',
        'path_file',
        'tipe_file',
        'ukuran_file',
        'kategori',
        'deskripsi',
    ];

    protected $casts = [
        'id' => 'string',
        'ukuran_file' => 'integer',
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

    // Relasi dengan Pengujian
    public function pengujian()
    {
        return $this->belongsTo(Pengujian::class, 'pengujian_id');
    }

    // Format ukuran file
    public function getFormattedSizeAttribute()
    {
        $bytes = $this->ukuran_file;
        $units = ['B', 'KB', 'MB', 'GB'];
        
        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }
        
        return round($bytes, 2) . ' ' . $units[$i];
    }

    // Kategori badge
    public function getKategoriBadgeAttribute()
    {
        $badges = [
            'HASIL_ANALISIS' => 'bg-blue-100 text-blue-800',
            'LAPORAN' => 'bg-green-100 text-green-800',
            'DATA_RAW' => 'bg-yellow-100 text-yellow-800',
            'DOKUMENTASI' => 'bg-purple-100 text-purple-800',
        ];

        return $badges[$this->kategori] ?? 'bg-gray-100 text-gray-800';
    }

    // Get file icon based on type
    public function getFileIconAttribute()
    {
        $icons = [
            'pdf' => 'fas fa-file-pdf text-red-500',
            'doc' => 'fas fa-file-word text-blue-500',
            'docx' => 'fas fa-file-word text-blue-500',
            'xls' => 'fas fa-file-excel text-green-500',
            'xlsx' => 'fas fa-file-excel text-green-500',
            'jpg' => 'fas fa-file-image text-yellow-500',
            'jpeg' => 'fas fa-file-image text-yellow-500',
            'png' => 'fas fa-file-image text-yellow-500',
            'zip' => 'fas fa-file-archive text-purple-500',
            'rar' => 'fas fa-file-archive text-purple-500',
        ];

        $extension = strtolower(pathinfo($this->nama_file, PATHINFO_EXTENSION));
        return $icons[$extension] ?? 'fas fa-file text-gray-500';
    }

    public function getRouteKeyName()
    {
        return 'id';
    }
} 