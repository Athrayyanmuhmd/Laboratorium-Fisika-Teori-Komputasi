# 🔑 Demo Accounts - Laboratorium Fisika FMIPA

## 🎯 Dua Aktor Utama Sistem

Sistem ini dirancang dengan fokus pada **dua aktor utama** yang mencerminkan penggunaan nyata di lingkungan laboratorium fisika universitas.

---

## 👨‍💼 **AKTOR 1: Admin Laboratorium**

### **Profil**
- **Nama**: Dr. Budi Santoso, M.Si.
- **Posisi**: Kepala Laboratorium Fisika Komputasi
- **Institusi**: Universitas Syiah Kuala - FMIPA

### **Kredensial Login**
```
Email    : admin@fisika.unsyiah.ac.id
Password : admin2024
```

### **Hak Akses & Tanggung Jawab**
- ✅ **Equipment Management**: Kelola inventaris peralatan lab
- ✅ **Lab Access Control**: Setujui/tolak permintaan akses laboratorium
- ✅ **Consultation Oversight**: Koordinasi konsultasi penelitian
- ✅ **System Administration**: Kontrol penuh sistem
- ✅ **Statistics & Reports**: Monitor penggunaan dan statistik
- ✅ **Maintenance Management**: Kelola jadwal kalibrasi dan maintenance

### **Typical Use Cases**
1. **Morning Routine**: Cek notifikasi pending requests
2. **Equipment Check**: Review status peralatan dan maintenance alerts
3. **Request Processing**: Approve/reject lab access dan consultation requests
4. **Resource Planning**: Monitor usage statistics untuk planning kapasitas
5. **Coordination**: Komunikasi dengan dosen dan peneliti

---

## 👩‍🎓 **AKTOR 2: Dosen/Peneliti**

### **Profil**
- **Nama**: Prof. Dr. Siti Aminah, M.Si.
- **Posisi**: Dosen Senior Fisika Teori
- **Institusi**: Universitas Syiah Kuala - FMIPA

### **Kredensial Login**
```
Email    : dosen@fisika.unsyiah.ac.id
Password : dosen2024
```

### **Hak Akses & Aktivitas**
- ✅ **Lab Access Requests**: Ajukan permintaan akses laboratorium
- ✅ **Equipment Booking**: Request penggunaan peralatan simulasi
- ✅ **Research Consultation**: Konsultasi metodologi dan analisis
- ✅ **Progress Tracking**: Monitor status permintaan dan kegiatan
- ✅ **Resource Discovery**: Browse fasilitas dan peralatan available
- ✅ **Academic Collaboration**: Koordinasi dengan admin lab

### **Typical Use Cases**
1. **Research Planning**: Request akses lab untuk proyek penelitian
2. **Student Supervision**: Book fasilitas untuk bimbingan mahasiswa
3. **Collaboration**: Konsultasi dengan admin untuk technical support
4. **Resource Utilization**: Gunakan PC simulasi untuk komputasi fisika
5. **Progress Monitoring**: Track status berbagai permintaan

---

## 🏛️ **Konteks Institusional**

### **Laboratorium Fisika Teori dan Komputasi**
- **Lokasi**: Gedung FMIPA Lantai 2
- **Fasilitas**: 28 PC untuk simulasi dan komputasi
- **Software**: MATLAB, Python, Mathematica, OriginPro
- **Jam Operasional**: Senin-Jumat 08:00-17:00, Sabtu 08:00-12:00

### **Alur Kerja Tipikal**
1. **Dosen** mengajukan permintaan akses/konsultasi
2. **Admin** mereview dan approve/reject request
3. **Dosen** menggunakan fasilitas sesuai jadwal
4. **Admin** monitoring dan dokumentasi aktivitas

---

## 🚀 **Quick Start Guide**

### **1. Login ke Sistem**
- Akses: http://127.0.0.1:8000/login
- Gunakan salah satu kredensial di atas
- Sistem akan redirect sesuai role

### **2. Sebagai Admin Laboratorium**
```
1. Dashboard → Overview statistik
2. Equipment → Kelola inventaris
3. Lab Access → Review permintaan kunjungan
4. Consultations → Koordinasi konsultasi
5. Notifications → Monitor pending requests
```

### **3. Sebagai Dosen/Peneliti**
```
1. Request Lab Access → Ajukan kunjungan
2. Equipment Booking → Reserve peralatan
3. Consultation → Minta bantuan teknis
4. Track Status → Monitor progress
5. History → Lihat aktivitas masa lalu
```

---

## 🔐 **Security Features**

- **Role-based Access Control**: Hak akses berdasarkan peran
- **Session Management**: Auto-logout untuk keamanan
- **CSRF Protection**: Perlindungan dari serangan
- **Password Hashing**: Enkripsi password dengan bcrypt
- **Audit Trail**: Log aktivitas pengguna

---

## 📱 **UI/UX Highlights**

- **Responsive Design**: Mobile-friendly interface
- **Real-time Notifications**: Instant update untuk pending items
- **Modal Workflows**: Smooth approval/rejection process
- **Search & Filter**: Advanced filtering di semua module
- **Visual Status**: Color-coded status indicators

---

## 📞 **Support & Contact**

Untuk pertanyaan terkait sistem atau akses demo:

**Lab Contact**:
- **Phone**: 0651-7551234
- **Email**: fisika.komputasi@unsyiah.ac.id

**System Admin**:
- **Dr. Budi Santoso**: admin@fisika.unsyiah.ac.id

**Faculty Support**:
- **Prof. Dr. Siti Aminah**: dosen@fisika.unsyiah.ac.id

---

## ⚡ **System Status**

- **Status**: ✅ Fully Operational
- **Last Updated**: June 2024
- **Version**: 2.1
- **Uptime**: 99.9%
- **Response Time**: < 200ms average

---

**© 2024 Laboratorium Fisika Teori dan Komputasi - Universitas Syiah Kuala** 

# Demo Accounts - Sistem Laboratorium Fisika Komputasi

## Akun Admin Dashboard

### Admin Laboran
- **Email**: admin@fisika.com
- **Password**: admin123
- **Role**: lab_admin (Laboran)
- **Akses**: Dashboard Laboran dengan kontrol penuh terhadap semua fitur

### Super Admin
- **Email**: superadmin@fisika.com
- **Password**: superadmin123
- **Role**: super_admin
- **Akses**: Akses penuh sistem termasuk user management

## Cara Login

1. Kunjungi: `http://localhost:8000/login`
2. Masukkan email dan password sesuai akun di atas
3. Setelah login, akan diarahkan ke dashboard sesuai role

## Fitur yang Tersedia

### Dashboard Laboran (admin@fisika.com)
- **Manajemen Alat**: Kelola inventaris peralatan lab
- **Peminjaman Alat**: Proses dan monitor peminjaman
- **Layanan Pengujian**: Kelola permintaan pengujian sampel
- **Kunjungan Lab**: Koordinasi kunjungan dan tour
- **Jenis Pengujian**: Konfigurasi layanan pengujian
- **Artikel & Berita**: Kelola konten website
- **Data Pengurus**: Profil staff dan pengurus

### Akses URL Langsung
- Landing Page: `http://localhost:8000/`
- Login: `http://localhost:8000/login`
- Dashboard Laboran: `http://localhost:8000/admin` (setelah login)

## Data Sampel yang Tersedia

### Alat Laboratorium
- Mikroskop Digital (5 unit)
- Komputer Workstation (10 unit)
- Sensor Suhu Digital (20 unit)
- Oscilloscope (3 unit)
- Function Generator (2 unit)

### Jenis Pengujian
- Analisis Spektroskopi (Rp 150,000)
- Pengujian Konduktivitas Termal (Rp 200,000)
- Analisis Struktur Kristal (Rp 300,000)
- Pengujian Sifat Magnetik (Rp 250,000)
- Simulasi Monte Carlo (Rp 500,000)
- Analisis Data Eksperimental (Rp 100,000)

### Staff/Pengurus
- Dr. Ahmad Susanto, M.Si (Kepala Laboratorium)
- Dr. Siti Nurhaliza, M.Sc (Koordinator Penelitian)
- Budi Prasetyo, S.Si (Teknisi Senior)
- Rina Kusumawati, S.Kom (Administrator Sistem)

## Form Publik (Tanpa Login)

Pengunjung dapat mengisi form di landing page:
1. **Form Peminjaman Alat**
2. **Form Pengujian Sampel**
3. **Form Kunjungan Lab**

Semua form akan masuk ke dashboard admin untuk dikelola.

## Status Workflow

Semua request menggunakan workflow:
- **PENDING**: Menunggu persetujuan
- **PROCESSING**: Sedang diproses
- **COMPLETED**: Selesai
- **CANCELLED**: Dibatalkan

## Database

Sistem menggunakan SQLite untuk development dengan struktur yang sesuai ERD yang telah didefinisikan.

## Troubleshooting

Jika mengalami masalah:
1. Pastikan server berjalan: `php artisan serve`
2. Periksa database: `php artisan migrate:status`
3. Reset data: `php artisan migrate:fresh --seed`

## Catatan Penting

- Sistem sudah terintegrasi dengan struktur database baru
- Semua fitur utama sudah berfungsi
- Landing page sudah terhubung dengan database
- Dashboard admin sudah operasional 