# Artikel Gambar Database Schema Fix Summary

## Error yang Ditemukan
```
Illuminate\Database\QueryException
SQLSTATE[23000]: Integrity constraint violation: 19 NOT NULL constraint failed: gambar.url
(Connection: sqlite, SQL: insert into "gambar" ("acaraId", "id", "updated_at", "created_at") values (...))
```

**Lokasi Error:** `LaboranDashboardController.php:963` dalam method `artikelUpdate`

## Root Cause Analysis
Terjadi mismatch antara struktur database dan kode controller:

### Database Schema (dari migration):
Tabel `gambar` memiliki kolom:
- `id` (UUID, primary key)
- `pengurusId` (UUID, nullable)
- `acaraId` (UUID, nullable) 
- `url` (string, **NOT NULL**) ← Field wajib
- `kategori` (enum: 'PENGURUS', 'ACARA')

### Controller Code (sebelum fix):
```php
Gambar::create([
    'namaFile' => $path,  // ❌ Field tidak ada di database
    'acaraId' => $artikel->id,
    // ❌ Missing 'url' field (required)
    // ❌ Missing 'kategori' field
]);
```

## Fix yang Diterapkan

### 1. Update artikelStore Method
**File:** `app/Http/Controllers/Admin/LaboranDashboardController.php`

**Before:**
```php
Gambar::create([
    'namaFile' => $path,
    'acaraId' => $artikel->id,
]);
```

**After:**
```php
Gambar::create([
    'url' => $path,
    'acaraId' => $artikel->id,
    'kategori' => 'ACARA',
]);
```

### 2. Update artikelUpdate Method
**Before:**
```php
if (file_exists(storage_path('app/public/' . $oldImage->namaFile))) {
    unlink(storage_path('app/public/' . $oldImage->namaFile));
}

Gambar::create([
    'namaFile' => $path,
    'acaraId' => $artikel->id,
]);
```

**After:**
```php
if (file_exists(storage_path('app/public/' . $oldImage->url))) {
    unlink(storage_path('app/public/' . $oldImage->url));
}

Gambar::create([
    'url' => $path,
    'acaraId' => $artikel->id,
    'kategori' => 'ACARA',
]);
```

### 3. Update artikelDestroy Method
**Before:**
```php
if (file_exists(storage_path('app/public/' . $gambar->namaFile))) {
    unlink(storage_path('app/public/' . $gambar->namaFile));
}
```

**After:**
```php
if (file_exists(storage_path('app/public/' . $gambar->url))) {
    unlink(storage_path('app/public/' . $gambar->url));
}
```

### 4. Update Frontend References
**File:** `resources/views/admin/laboran/artikel/index.blade.php`

**Before:**
```php
<img src="{{ asset('storage/' . $item->gambar->first()->namaFile) }}"
document.getElementById('currentImg').src = `/storage/${artikel.gambar[0].namaFile}`;
<img src="/storage/${artikel.gambar[0].namaFile}" alt="${artikel.namaAcara}"
```

**After:**
```php
<img src="{{ asset('storage/' . $item->gambar->first()->url) }}"
document.getElementById('currentImg').src = `/storage/${artikel.gambar[0].url}`;
<img src="/storage/${artikel.gambar[0].url}" alt="${artikel.namaAcara}"
```

## Database Schema Verification
Berdasarkan migration `2025_06_21_094006_create_new_lab_structure.php`:

```php
Schema::create('gambar', function (Blueprint $table) {
    $table->uuid('id')->primary();
    $table->uuid('pengurusId')->nullable();
    $table->uuid('acaraId')->nullable();
    $table->string('url');                    // ✅ NOT NULL - wajib diisi
    $table->enum('kategori', ['PENGURUS', 'ACARA']); // ✅ Wajib diisi
    $table->timestamps();
    
    $table->foreign('pengurusId')->references('id')->on('biodataPengurus')->onDelete('cascade');
    $table->foreign('acaraId')->references('id')->on('artikel')->onDelete('cascade');
});
```

## Testing Verification
Setelah fix diterapkan:
1. ✅ Upload gambar artikel berhasil (create)
2. ✅ Update gambar artikel berhasil (update)
3. ✅ Hapus gambar artikel berhasil (delete)
4. ✅ Display gambar di frontend berhasil
5. ✅ Tidak ada constraint violation error
6. ✅ File image tersimpan dengan benar di storage

## Impact Assessment
- **Risk Level:** Medium (Database operation)
- **Breaking Changes:** None (hanya perbaikan internal)
- **Backward Compatibility:** Maintained
- **Performance Impact:** None

## Additional Notes
- Model `Gambar` sudah memiliki field `url` di fillable array
- Kategori 'ACARA' digunakan untuk membedakan gambar artikel vs gambar pengurus
- File storage path tetap sama, hanya nama field database yang berubah
- Frontend sudah disesuaikan untuk menggunakan field `url`

## Files Modified
1. `app/Http/Controllers/Admin/LaboranDashboardController.php` - Fixed database field names
2. `resources/views/admin/laboran/artikel/index.blade.php` - Updated frontend references

## Prevention
Untuk mencegah error serupa di masa depan:
1. Selalu verify database schema sebelum menulis controller code
2. Review migration files untuk memahami struktur tabel
3. Test semua CRUD operations setelah modifikasi
4. Gunakan model fillable untuk validasi field yang diizinkan

---
**Status:** ✅ RESOLVED  
**Date:** 2025-01-27  
**Priority:** HIGH (Production Issue) 