# Laboratorium Fisika Komputasi - Struktur Modular

## 📁 Struktur Direktori

```
resources/views/laboratories/
├── README.md                    # Dokumentasi ini
├── index.blade.php             # File utama (monolitik - untuk backup)
├── index-modular.blade.php     # File utama modular (recommended)
├── partials/                   # Komponen yang dapat digunakan kembali
│   ├── head.blade.php          # HTML head, meta tags, CSS, fonts
│   ├── styles.blade.php        # Semua CSS styling
│   ├── scripts.blade.php       # JavaScript functions
│   └── footer.blade.php        # Footer dan closing tags
└── sections/                   # Section-section halaman
    ├── navbar.blade.php        # Navigation bar
    ├── hero.blade.php          # Hero/beranda section
    ├── visi-misi.blade.php     # Visi dan misi
    ├── staff.blade.php         # Staff dan tenaga ahli
    ├── gallery.blade.php       # Galeri laboratorium
    ├── services.blade.php      # Layanan laboratorium
    ├── facilities.blade.php    # Fasilitas
    ├── forms.blade.php         # Formulir online
    └── contact.blade.php       # Kontak dan informasi
```

## 🚀 Cara Penggunaan

### File Utama Modular
Gunakan `index-modular.blade.php` sebagai file utama yang menginclude semua komponen:

```blade
@include('laboratories.partials.head')
@include('laboratories.sections.navbar')
@include('laboratories.sections.hero')
@include('laboratories.sections.visi-misi')
@include('laboratories.sections.staff')
@include('laboratories.sections.gallery')
@include('laboratories.sections.services')
@include('laboratories.sections.facilities')
@include('laboratories.sections.forms')
@include('laboratories.sections.contact')
@include('laboratories.partials.footer')
@include('laboratories.partials.scripts')
```

### Mengedit Komponen Tertentu
Untuk mengubah bagian tertentu, edit file yang sesuai:

- **Navigation**: `sections/navbar.blade.php`
- **Hero Section**: `sections/hero.blade.php`
- **Styles**: `partials/styles.blade.php`
- **JavaScript**: `partials/scripts.blade.php`

## 📋 Komponen yang Tersedia

### Partials (Komponen Reusable)
1. **head.blade.php** - Meta tags, fonts, CSS imports
2. **styles.blade.php** - Semua CSS styling (glassmorphism, animations, etc.)
3. **scripts.blade.php** - JavaScript functions (dark mode, smooth scroll, forms)
4. **footer.blade.php** - Footer dengan informasi kontak dan links

### Sections (Bagian Halaman)
1. **navbar.blade.php** - Navigation dengan glassmorphism effect
2. **hero.blade.php** - Hero section dengan background dan CTA buttons
3. **visi-misi.blade.php** - Visi dan misi laboratorium
4. **staff.blade.php** - Tim staff dan tenaga ahli
5. **gallery.blade.php** - Galeri foto laboratorium
6. **services.blade.php** - Layanan yang ditawarkan
7. **facilities.blade.php** - Fasilitas laboratorium
8. **forms.blade.php** - Formulir online (penyewaan, kunjungan, pengujian)
9. **contact.blade.php** - Informasi kontak dan peta

## 🔧 Maintenance Tips

### 1. Mengubah Styling
Edit file `partials/styles.blade.php` untuk mengubah:
- Warna tema
- Animasi
- Layout responsif
- Efek glassmorphism

### 2. Menambah Section Baru
1. Buat file baru di `sections/nama-section.blade.php`
2. Tambahkan `@include('laboratories.sections.nama-section')` di `index-modular.blade.php`

### 3. Mengupdate JavaScript
Edit `partials/scripts.blade.php` untuk:
- Menambah fungsi baru
- Mengubah behavior form
- Update animasi

### 4. Mengubah Layout
Edit file individual di folder `sections/` untuk mengubah struktur HTML tertentu.

## 📱 Fitur yang Sudah Tersedia

### Navigation
- ✅ Glassmorphism navbar
- ✅ Mobile responsive menu
- ✅ Dark mode toggle
- ✅ Smooth scrolling

### Sections
- ✅ Hero dengan background image
- ✅ Visi & Misi cards
- ✅ Staff grid layout
- ✅ Services dengan statistics
- ✅ Interactive forms
- ✅ Contact dengan maps

### Interactivity
- ✅ Form submission dengan validasi
- ✅ Notification system
- ✅ Hover effects
- ✅ Responsive design

## 🎨 Customization

### Mengubah Warna Tema
Di `partials/styles.blade.php`, ubah variabel warna:
```css
/* Dari slate (#1e293b) ke warna lain */
background: rgba(30, 41, 59, 0.75) /* Ganti nilai RGB */
```

### Menambah CSS Baru
Tambahkan di akhir file `partials/styles.blade.php`:
```css
.custom-class {
    /* Custom styling */
}
```

### Menambah JavaScript
Tambahkan di `partials/scripts.blade.php`:
```javascript
function customFunction() {
    // Custom logic
}
```

## 🚦 Migration dari File Lama

Untuk berpindah dari `index.blade.php` ke struktur modular:

1. Backup file lama: `cp index.blade.php index-backup.blade.php`
2. Rename file modular: `mv index-modular.blade.php index.blade.php`
3. Test semua functionality
4. Sesuaikan routing jika diperlukan

## ⚠️ Notes

- File `index.blade.php` lama disimpan sebagai backup
- Gunakan `index-modular.blade.php` untuk development
- Semua CSS sudah dioptimasi untuk performance
- JavaScript sudah include error handling
- Responsive design tested pada berbagai device

## 🤝 Contributing

Untuk menambah fitur baru:
1. Buat komponen di folder yang sesuai (`partials/` atau `sections/`)
2. Include di file utama
3. Update dokumentasi ini
4. Test responsiveness dan functionality

---

**Happy Coding! 🚀** 