# SIGMA - Sistem Analisis Risiko Perilaku Judi Online

## Informasi Mahasiswa

- **Nama:** Doni Setiawan Wahyono
- **NIM:** 23552011146
- **Program Studi:** Teknik Informatika
- **Mata Kuliah:** Pemrograman Web 1 (UAS)

## Deskripsi Project

SIGMA adalah sistem berbasis web untuk menganalisis dan memantau risiko perilaku kecanduan judi online. Sistem ini menyediakan assessment risiko, analisis data, dan laporan komprehensif untuk membantu identifikasi dan monitoring responden.

## Fitur Utama

### 1. Manajemen User
- Registrasi dan autentikasi user
- Role-based access (Admin dan User)
- Profil user

### 2. Assessment Risiko
- Kuesioner assessment dengan 10 pertanyaan
- Sistem skoring otomatis (0-40 poin)
- Kategorisasi risiko: Rendah, Sedang, Tinggi, Bahaya
- History assessment per user
- Grup assessment untuk organisasi data

### 3. Modul Edukasi
- Manajemen konten edukasi
- Upload gambar dan video
- Akses edukasi untuk user

### 4. Simulator Judi
- Simulasi Random Number Generator (RNG)
- Tracking history simulasi
- Statistik win/loss rate

### 5. Laporan & Analisis
- **Laporan Analisis Risiko:** Ringkasan eksekutif, distribusi kategori, tren risiko
- **Laporan Assessment Responden:** Data detail per responden
- Filter berdasarkan tanggal, kategori risiko, dan user
- Export ke PDF menggunakan DomPDF
- Export ke Excel menggunakan SheetJS

### 6. Dashboard
- Statistik real-time
- Grafik distribusi risiko
- Total assessment dan user

## Teknologi yang Digunakan

### Backend
- PHP 7.4+ (Native, MVC Pattern)
- MySQL/MariaDB
- PDO untuk database connection
- Composer untuk dependency management
- DomPDF untuk PDF generation

### Frontend
- HTML5, CSS3, JavaScript
- Bootstrap 5.3.0
- Font Awesome 6.4.0
- Chart.js untuk visualisasi data
- SheetJS (xlsx) untuk export Excel

### Environment
- XAMPP (Apache, MySQL, PHP)
- Composer

## Struktur Project

```
sigma/
├── app/
│   ├── api/controllers/      # API endpoints
│   ├── controllers/          # Controller layer (MVC)
│   ├── core/                 # Middleware & utilities
│   ├── models/               # Model layer (MVC)
│   └── views/                # View layer (MVC)
├── config/                   # Database configuration
├── public/                   # Assets (CSS, JS, uploads)
├── vendor/                   # Composer dependencies
├── index.php                 # Router utama
└── composer.json             # Dependency management
```

## Instalasi

### Prerequisite
- XAMPP atau web server dengan PHP 7.4+
- MySQL/MariaDB
- Composer

### Langkah Instalasi

1. Clone atau copy project ke folder htdocs
```bash
cd C:\xampp\htdocs
```

2. Import database
- Buat database baru dengan nama `sigma_db`
- Import file SQL (jika ada) atau buat tabel sesuai struktur

3. Konfigurasi database
Edit file `config/Database.php`:
```php
private $host = "localhost";
private $db_name = "sigma_db";
private $username = "root";
private $password = "";
```

4. Install dependencies
```bash
composer install
```

5. Jalankan aplikasi
- Start Apache dan MySQL di XAMPP
- Akses via browser: `http://localhost/sigma`

## Default Login

**Admin:**
- Username/Email: admin@sigma.com
- Password: admin123

**User:**
- Registrasi melalui halaman register

## Kategori Risiko

- **Rendah (0-10 poin):** Kondisi normal, awareness
- **Sedang (11-20 poin):** Monitoring rutin dan edukasi preventif
- **Tinggi (21-30 poin):** Perlu monitoring intensif
- **Bahaya (31-40 poin):** Memerlukan konseling psikologis segera

## Fitur Keamanan

- Password hashing menggunakan `password_hash()`
- Session-based authentication
- Middleware untuk role-based access control
- Prepared statements untuk mencegah SQL injection
- Input validation dan sanitization

## Browser Support

- Chrome (Recommended)
- Firefox
- Edge
- Safari

## Lisensi

Project ini dibuat untuk keperluan akademik (UAS Pemrograman Web 1).

---

Dikembangkan oleh Doni Setiawan Wahyono - 2026
