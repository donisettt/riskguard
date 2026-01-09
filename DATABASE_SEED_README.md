# 📊 Database Seed Guide - SIGMA Project

## 📋 Deskripsi

File `database_seed.sql` berisi data lengkap untuk mengisi database SIGMA dengan konten yang realistis dan sesuai dengan kebutuhan project.

## 📦 Isi Data

### 1. **Education Content (10 Konten)**

- Memahami Bahaya Kecanduan Judi Online
- Strategi Pencegahan Kecanduan Judi Online
- Mengenali Pola Pikir Penjudi Online
- Dampak Ekonomi Judi Online pada Mahasiswa
- Peran Keluarga dalam Mencegah Judi Online
- Teknologi RNG dan Kecurangan dalam Judi Online
- Hukum dan Konsekuensi Judi Online di Indonesia
- Rehabilitasi dan Pemulihan dari Kecanduan Judi
- Media Sosial dan Promosi Judi Online
- Membangun Ketahanan Mental Menghadapi Godaan Judi

### 2. **RNG Games (10 Game Populer)**

Game-game yang sering digunakan untuk judi online:

- **Gates of Olympus** - Slot viral dengan multiplier 500x
- **Starlight Princess** - Slot princess dengan pay anywhere
- **Sweet Bonanza** - Cluster pays dengan visual adiktif
- **Spaceman** - Game crash yang sangat populer
- **Aviator** - Crash game dengan grafis sederhana
- **Crazy Time** - Live game show interaktif
- **Mega Wheel** - Roda keberuntungan
- **Mahjong Ways** - Slot tema mahjong
- **Fruit Party** - Slot cluster pays buah-buahan
- **Mines** - Original crypto casino game

### 3. **Assessment Groups (18 Grup)**

#### **Berdasarkan Angkatan & Jurusan:**

**Angkatan 2022:** (4 grup)

- Teknik Industri 2022
- Teknik Informatika 2022
- Desain Komunikasi Visual 2022
- Manajemen Ritel 2022

**Angkatan 2023:** (4 grup)

- Teknik Industri 2023
- Teknik Informatika 2023
- Desain Komunikasi Visual 2023
- Manajemen Ritel 2023

**Angkatan 2024:** (4 grup)

- Teknik Industri 2024
- Teknik Informatika 2024
- Desain Komunikasi Visual 2024
- Manajemen Ritel 2024

**Angkatan 2025:** (4 grup)

- Teknik Industri 2025
- Teknik Informatika 2025
- Desain Komunikasi Visual 2025
- Manajemen Ritel 2025

**Dosen & Staf:** (2 grup)

- Dosen & Tenaga Pendidik
- Staf Administrasi & Kemahasiswaan

### 4. **Bank Soal (40 Soal Sample)**

- 10 soal untuk Teknik Industri 2022
- 10 soal untuk Teknik Informatika 2022
- 10 soal untuk DKV 2022
- 10 soal untuk Manajemen Ritel 2022

**Catatan:** Anda perlu menambahkan lebih banyak soal untuk grup lainnya (15-30 soal per grup direkomendasikan)

## 🚀 Cara Menggunakan

### **Metode 1: Via phpMyAdmin**

1. Buka phpMyAdmin (http://localhost/phpmyadmin)
2. Pilih database SIGMA Anda
3. Klik tab "Import"
4. Pilih file `database_seed.sql`
5. Klik "Go"

### **Metode 2: Via MySQL Command Line**

```bash
mysql -u root -p sigma_db < database_seed.sql
```

_(Ganti `sigma_db` dengan nama database Anda)_

### **Metode 3: Via Terminal di XAMPP**

```bash
cd C:\xampp\htdocs\sigma
C:\xampp\mysql\bin\mysql -u root -p sigma_db < database_seed.sql
```

## ⚠️ Penting!

### **Setelah Import:**

1. **Cek ID Assessment Groups:**

```sql
SELECT id, title FROM assessment_groups;
```

2. **Update group_id pada Questions:**
   Jika ID grup tidak sesuai (1-18), Anda perlu update manual:

```sql
-- Contoh jika ID dimulai dari 5 bukan 1:
UPDATE questions SET group_id = 5 WHERE group_id = 1;
UPDATE questions SET group_id = 6 WHERE group_id = 2;
-- Dan seterusnya...
```

3. **Tambahkan Lebih Banyak Soal:**
   Untuk assessment yang akurat, tambahkan 15-30 soal per grup:

```sql
INSERT INTO questions (group_id, question_text, option_a, option_b, option_c, option_d, correct_answer, point, created_at)
VALUES
(5, 'Pertanyaan untuk TI 2023?', 'Opsi A', 'Opsi B', 'Opsi C', 'Opsi D', 'A', 10, NOW());
```

## 📊 Verifikasi Data

Jalankan query berikut untuk memverifikasi:

```sql
-- Cek jumlah education content
SELECT COUNT(*) as total_education FROM education_content;
-- Expected: 10

-- Cek jumlah RNG games
SELECT COUNT(*) as total_games FROM rng_games;
-- Expected: 10

-- Cek jumlah assessment groups
SELECT COUNT(*) as total_groups FROM assessment_groups;
-- Expected: 18

-- Cek jumlah soal per grup
SELECT ag.title, COUNT(q.id) as total_soal
FROM assessment_groups ag
LEFT JOIN questions q ON ag.id = q.group_id
GROUP BY ag.id;

-- Cek total soal
SELECT COUNT(*) as total_questions FROM questions;
-- Expected: minimal 40 (bisa lebih jika sudah ditambah)
```

## 🎯 Rekomendasi

### **Untuk Hasil Assessment Optimal:**

1. **Tambahkan Lebih Banyak Soal**

   - Minimal 20 soal per grup assessment
   - Variasikan tipe pertanyaan
   - Sesuaikan dengan karakteristik jurusan

2. **Variasi Jenis Soal:**

   - **Knowledge**: Pemahaman tentang judi online
   - **Attitude**: Sikap terhadap judi online
   - **Behavior**: Perilaku terkait judi online
   - **Situational**: Respon terhadap situasi tertentu

3. **Bobot Point:**

   - Soal basic: 5-10 point
   - Soal moderate: 10-15 point
   - Soal critical: 15-20 point

4. **Update Regular:**
   - Tambah game RNG baru yang sedang viral
   - Update konten edukasi sesuai tren terbaru
   - Refresh soal assessment berkala

## 🔧 Troubleshooting

### **Problem: Foreign Key Constraint**

```sql
SET FOREIGN_KEY_CHECKS = 0;
-- Jalankan query import
SET FOREIGN_KEY_CHECKS = 1;
```

### **Problem: Duplicate Entry**

```sql
-- Hapus data lama dulu
TRUNCATE TABLE questions;
TRUNCATE TABLE assessment_groups;
TRUNCATE TABLE rng_games;
TRUNCATE TABLE education_content;
-- Lalu import ulang
```

### **Problem: Created_by User Not Found**

Pastikan user dengan ID 1 (admin) sudah ada di tabel users:

```sql
SELECT id, name, role FROM users WHERE id = 1;
```

## 📝 Contoh Menambah Soal untuk Grup Lain

```sql
-- Template untuk menambah soal grup 5-18
INSERT INTO questions (group_id, question_text, option_a, option_b, option_c, option_d, correct_answer, point, created_at)
VALUES
-- Grup 5: Teknik Industri 2023
(5, 'Seberapa sering Anda mengakses situs judi online?', 'Tidak pernah', 'Jarang', 'Sering', 'Sangat sering', 'A', 10, NOW()),
(5, 'Apakah judi online mempengaruhi nilai akademik Anda?', 'Tidak', 'Sedikit', 'Cukup', 'Sangat', 'A', 10, NOW()),
-- Tambahkan 8-28 soal lagi...

-- Grup 6: Teknik Informatika 2023
(6, 'Apakah Anda memahami teknologi blockchain dalam judi crypto?', 'Ya, sangat', 'Cukup', 'Kurang', 'Tidak', 'A', 10, NOW()),
-- Tambahkan soal lainnya...

-- Dan seterusnya untuk grup 7-18
```

## 📞 Support

Jika ada pertanyaan atau kendala:

1. Cek struktur tabel di phpMyAdmin
2. Pastikan semua foreign key sudah benar
3. Verifikasi data dengan query SELECT
4. Backup database sebelum import ulang

---

**Good luck with your SIGMA project! 🎓🚀**
