<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BiodataPengurus extends Model
{
    use HasFactory;

    protected $table = 'biodataPengurus';
    
    protected $fillable = [
        'nama',
        'jabatan',
        'email',
        'phone',
        'bio',
        'specialization',
        'education',
        'expertise',
        'research_interests',
        'is_active',
        'show_on_website',
        'display_order',
        'employment_type',
        'linkedin_url',
        'google_scholar_url',
        'website_url',
        'join_date',
        'achievements',
        'publications',
    ];

    protected $casts = [
        'id' => 'string',
        'is_active' => 'boolean',
        'show_on_website' => 'boolean',
        'join_date' => 'date',
        'display_order' => 'integer',
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
            
            // Set default join_date if not provided
            if (empty($model->join_date)) {
                $model->join_date = now();
            }
            
            // Auto-set display order
            if ($model->display_order === 0) {
                $model->display_order = static::max('display_order') + 1;
            }
        });
    }

    // Relasi dengan Gambar
    public function gambar()
    {
        return $this->hasMany(Gambar::class, 'pengurusId');
    }

    // Scope untuk staff aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope untuk staff yang ditampilkan di website
    public function scopeShowOnWebsite($query)
    {
        return $query->where('show_on_website', true);
    }

    // Scope untuk ordering
    public function scopeOrdered($query)
    {
        return $query->orderBy('display_order')->orderBy('nama');
    }

    // Accessor untuk foto utama
    public function getFotoUtamaAttribute()
    {
        return $this->gambar->first();
    }

    // Accessor untuk status employment dalam bahasa Indonesia
    public function getEmploymentTypeTextAttribute()
    {
        $types = [
            'full_time' => 'Penuh Waktu',
            'part_time' => 'Paruh Waktu', 
            'contract' => 'Kontrak',
            'volunteer' => 'Sukarelawan'
        ];
        
        return $types[$this->employment_type] ?? 'Full Time';
    }

    // Accessor untuk masa kerja
    public function getMasaKerjaAttribute()
    {
        if (!$this->join_date) {
            return '-';
        }
        
        $years = $this->join_date->diffInYears(now());
        $months = $this->join_date->diffInMonths(now()) % 12;
        
        if ($years > 0) {
            return $years . ' tahun' . ($months > 0 ? ' ' . $months . ' bulan' : '');
        }
        
        return $months . ' bulan';
    }

    // Method untuk mendapatkan inisial nama
    public function getInitialsAttribute()
    {
        $words = explode(' ', $this->nama);
        $initials = '';
        
        foreach ($words as $word) {
            if (strlen($word) > 0 && !in_array(strtolower($word), ['dr.', 'm.si', 'm.sc', 's.si', 's.kom', 'prof.'])) {
                $initials .= strtoupper(substr($word, 0, 1));
            }
            if (strlen($initials) >= 2) break;
        }
        
        return $initials ?: strtoupper(substr($this->nama, 0, 2));
    }

    // Method untuk format nama singkat
    public function getNamaSingkatAttribute()
    {
        $parts = explode(',', $this->nama);
        return trim($parts[0]);
    }

    public function getRouteKeyName()
    {
        return 'id';
    }
}
