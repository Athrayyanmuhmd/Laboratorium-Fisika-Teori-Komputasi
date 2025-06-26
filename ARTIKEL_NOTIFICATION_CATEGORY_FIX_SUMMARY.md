# Artikel Notification Category Fix Summary

## Error yang Ditemukan
```
Illuminate\Database\QueryException
SQLSTATE[23000]: Integrity constraint violation: 19 CHECK constraint failed: category
(Connection: sqlite, SQL: insert into "notifications" ("title", "message", "type", "category", "related_id", "related_type", "id", "updated_at", "created_at") values (...))
```

**Lokasi Error:** `LaboranDashboardController.php:920` dalam method `artikelStore`

## Root Cause Analysis
Terjadi constraint violation pada enum `category` di tabel `notifications`:

### Database Schema (dari migration):
Tabel `notifications` memiliki enum constraint untuk `category`:
```php
$table->enum('category', ['PEMINJAMAN', 'PENGUJIAN', 'KUNJUNGAN', 'MAINTENANCE', 'SYSTEM']);
```

### Controller Code (sebelum fix):
```php
Notification::create([
    'title' => 'Artikel Baru Ditambahkan',
    'message' => "Artikel '{$artikel->namaAcara}' telah ditambahkan ke sistem",
    'type' => 'SUCCESS',
    'category' => 'CONTENT',  // ❌ 'CONTENT' tidak ada dalam enum
    'related_id' => $artikel->id,
    'related_type' => 'App\Models\Artikel',
]);
```

## Valid Category Values
Berdasarkan migration `2025_06_22_120000_add_missing_fields_enhancement.php`:

1. **PEMINJAMAN** - Untuk notifikasi terkait peminjaman alat
2. **PENGUJIAN** - Untuk notifikasi terkait layanan pengujian
3. **KUNJUNGAN** - Untuk notifikasi terkait kunjungan lab
4. **MAINTENANCE** - Untuk notifikasi terkait maintenance alat
5. **SYSTEM** - Untuk notifikasi terkait sistem/admin

## Fix yang Diterapkan

### 1. artikelStore Method
**File:** `app/Http/Controllers/Admin/LaboranDashboardController.php`

**Before:**
```php
'category' => 'CONTENT',
```

**After:**
```php
'category' => 'SYSTEM',
```

### 2. artikelUpdate Method
**Before:**
```php
'category' => 'CONTENT',
```

**After:**
```php
'category' => 'SYSTEM',
```

### 3. artikelDestroy Method
**Before:**
```php
'category' => 'CONTENT',
```

**After:**
```php
'category' => 'SYSTEM',
```

## Justification for Using 'SYSTEM'
Artikel/berita management termasuk dalam kategori `SYSTEM` karena:
- Merupakan content management system
- Terkait dengan administrasi sistem laboratorium
- Tidak termasuk dalam 4 kategori operasional lainnya (peminjaman, pengujian, kunjungan, maintenance)

## Category Icons (dari Model)
Berdasarkan `app/Models/Notification.php`:

```php
public function getCategoryIconAttribute()
{
    $icons = [
        'PEMINJAMAN' => 'fas fa-handshake',
        'PENGUJIAN' => 'fas fa-flask',
        'KUNJUNGAN' => 'fas fa-users',
        'MAINTENANCE' => 'fas fa-tools',
        'SYSTEM' => 'fas fa-cog',  // ✅ Icon untuk artikel/system
    ];

    return $icons[$this->category] ?? 'fas fa-bell';
}
```

## Testing Verification
Setelah fix diterapkan:
1. ✅ Create artikel berhasil tanpa constraint error
2. ✅ Update artikel berhasil tanpa constraint error
3. ✅ Delete artikel berhasil tanpa constraint error
4. ✅ Notification terbuat dengan category 'SYSTEM'
5. ✅ Upload gambar artikel berfungsi normal
6. ✅ Semua CRUD operations artikel stabil

## Impact Assessment
- **Risk Level:** Low
- **Breaking Changes:** None
- **Backward Compatibility:** Maintained
- **Performance Impact:** None

## Additional Notes
- Kategori 'SYSTEM' sesuai untuk notifikasi content management
- Notification model sudah memiliki icon mapping untuk 'SYSTEM'
- Semua notification categories di aplikasi sudah menggunakan enum yang valid
- Database constraint violation sudah teratasi

## Files Modified
1. `app/Http/Controllers/Admin/LaboranDashboardController.php` - Fixed notification categories

## Verification of All Categories
Berdasarkan grep search, semua notification categories di aplikasi menggunakan enum yang valid:
- ✅ PEMINJAMAN (peminjaman operations)
- ✅ PENGUJIAN (testing services)
- ✅ KUNJUNGAN (lab visits)
- ✅ MAINTENANCE (equipment maintenance)
- ✅ SYSTEM (artikel, system admin)

## Prevention
Untuk mencegah error serupa di masa depan:
1. Selalu refer ke migration file untuk enum values
2. Create constants untuk notification categories
3. Add validation/testing untuk notification creation
4. Review database constraints sebelum deploy

---
**Status:** ✅ RESOLVED  
**Date:** 2025-01-27  
**Priority:** HIGH (Production Issue) 