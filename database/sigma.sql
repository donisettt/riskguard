-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 09 Jan 2026 pada 11.38
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sigma`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `assessments`
--

CREATE TABLE `assessments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `group_id` int(11) DEFAULT NULL,
  `total_score` decimal(10,2) DEFAULT NULL,
  `risk_level` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `assessments`
--

INSERT INTO `assessments` (`id`, `user_id`, `group_id`, `total_score`, `risk_level`, `created_at`) VALUES
(1, 13, 2, 70.00, 'Bahaya', '2026-01-09 09:47:02');

-- --------------------------------------------------------

--
-- Struktur dari tabel `assessment_answers`
--

CREATE TABLE `assessment_answers` (
  `id` int(11) NOT NULL,
  `assessment_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer_value` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `assessment_answers`
--

INSERT INTO `assessment_answers` (`id`, `assessment_id`, `question_id`, `answer_value`) VALUES
(1, 1, 11, 1),
(2, 1, 12, 0),
(3, 1, 13, 0),
(4, 1, 14, 2),
(5, 1, 15, 1),
(6, 1, 16, 0),
(7, 1, 17, 1),
(8, 1, 18, 0),
(9, 1, 19, 1),
(10, 1, 20, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `assessment_groups`
--

CREATE TABLE `assessment_groups` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `assessment_groups`
--

INSERT INTO `assessment_groups` (`id`, `title`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Assessment Risiko Judi Online - Teknik Industri 2022 - 2025', 'Assessment khusus untuk mahasiswa Teknik Industri angkatan 2022 - 2025. Mengukur tingkat risiko kecanduan judi online dengan fokus pada aspek manajemen keuangan dan pengambilan keputusan.', '2026-01-09 09:41:17', '2026-01-09 09:41:57'),
(2, 'Assessment Risiko Judi Online - Teknik Informatika 2022 - 2025', 'Assessment untuk mahasiswa Teknik Informatika angkatan 2022 - 2025 dengan fokus khusus pada pemahaman teknologi RNG dan keamanan digital dalam konteks judi online', '2026-01-09 09:41:17', '2026-01-09 09:42:18'),
(3, 'Assessment Risiko Judi Online - DKV 2022 - 2025', 'Assessment untuk mahasiswa Desain Komunikasi Visual angkatan 2022 - 2025 dengan fokus pada dampak visual marketing dan media sosial dalam promosi judi online.', '2026-01-09 09:41:17', '2026-01-09 09:42:37'),
(4, 'Assessment Risiko Judi Online - Manajemen Ritel 2022 - 2025', 'Assessment untuk mahasiswa Manajemen Ritel angkatan 2022 - 2025 dengan penekanan pada literasi keuangan dan manajemen risiko investasi vs judi.', '2026-01-09 09:41:17', '2026-01-09 09:42:58'),
(18, 'Assessment Risiko Judi Online - Staf Administrasi & Kemahasiswaan', 'Self-assessment khusus untuk staf administrasi dan kemahasiswaan dalam menilai risiko pribadi kecanduan judi online, manajemen keuangan, dan kesejahteraan psikologis. Target: Staf Administrasi & Kemahasiswaan', '2026-01-09 09:41:17', '2026-01-09 09:41:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `education_content`
--

CREATE TABLE `education_content` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `banner` varchar(255) DEFAULT 'default.jpg',
  `content` text NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `education_content`
--

INSERT INTO `education_content` (`id`, `title`, `banner`, `content`, `created_by`, `created_at`) VALUES
(1, 'Memahami Bahaya Kecanduan Judi Online', 'https://images.unsplash.com/photo-1511632765486-a01980e01a18?w=600&h=400&fit=crop', '<h2>Pengenalan Judi Online</h2><p>Judi online telah menjadi masalah serius di kalangan mahasiswa dan masyarakat umum. Dengan kemudahan akses melalui smartphone, judi online dapat diakses kapan saja dan dimana saja.</p><h3>Dampak Negatif Judi Online:</h3><ul><li>Kerugian finansial yang signifikan</li><li>Gangguan kesehatan mental seperti depresi dan kecemasan</li><li>Menurunnya prestasi akademik</li><li>Kerusakan hubungan sosial dan keluarga</li><li>Risiko terlibat dalam aktivitas ilegal</li></ul><h3>Tanda-tanda Kecanduan:</h3><p>Seseorang yang kecanduan judi online akan menunjukkan tanda-tanda seperti sering bermain dalam waktu lama, sulit berhenti, berbohong tentang aktivitas judi, dan mengabaikan tanggung jawab.</p>', 1, '2026-01-09 09:41:17'),
(2, 'Strategi Pencegahan Kecanduan Judi Online', 'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=600&h=400&fit=crop', '<h2>Langkah Preventif untuk Mahasiswa</h2><p>Pencegahan adalah kunci utama dalam mengatasi masalah judi online di kampus.</p><h3>Tips Pencegahan:</h3><ol><li><strong>Edukasi Dini</strong> - Pahami risiko dan bahaya judi online sejak awal</li><li><strong>Kelola Keuangan dengan Bijak</strong> - Buat anggaran dan patuhi batas pengeluaran</li><li><strong>Isi Waktu Luang dengan Produktif</strong> - Ikuti organisasi kampus atau hobi positif</li><li><strong>Bangun Lingkungan Positif</strong> - Bergaul dengan teman-teman yang mendukung</li><li><strong>Gunakan Filter Aplikasi</strong> - Pasang aplikasi pemblokir situs judi</li></ol><h3>Peran Kampus:</h3><p>Kampus dapat melakukan sosialisasi rutin, menyediakan konseling, dan membuat kebijakan tegas terkait judi online.</p>', 1, '2026-01-09 09:41:17'),
(3, 'Mengenali Pola Pikir Penjudi Online', 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=600&h=400&fit=crop', '<h2>Psikologi di Balik Judi Online</h2><p>Memahami pola pikir penjudi adalah langkah penting dalam pencegahan dan rehabilitasi.</p><h3>Cognitive Distortions (Distorsi Kognitif):</h3><ul><li><strong>Gamblers Fallacy</strong> - Keyakinan bahwa kekalahan beruntun akan diikuti kemenangan</li><li><strong>Illusion of Control</strong> - Merasa bisa mengontrol hasil permainan yang sebenarnya random</li><li><strong>Near Miss Effect</strong> - Hampir menang membuat terus bermain</li><li><strong>Chasing Losses</strong> - Berusaha mengembalikan uang yang hilang dengan terus berjudi</li></ul><h3>Faktor Pemicu:</h3><p>Stress, tekanan akademik, masalah keuangan, dan lingkungan sosial dapat menjadi pemicu seseorang mulai berjudi online.</p><h3>Cara Mengubah Pola Pikir:</h3><p>Terapi kognitif-behavioral (CBT) dan konseling dapat membantu mengubah pola pikir yang salah tentang judi.</p>', 1, '2026-01-09 09:41:17'),
(4, 'Dampak Ekonomi Judi Online pada Mahasiswa', 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?w=600&h=400&fit=crop', '<h2>Kerugian Finansial yang Mengancam</h2><p>Judi online dapat menyebabkan kerugian finansial yang sangat besar bagi mahasiswa.</p><h3>Statistik Mengejutkan:</h3><ul><li>Rata-rata kerugian mahasiswa penjudi mencapai jutaan rupiah per bulan</li><li>80% penjudi mahasiswa mengalami kesulitan keuangan serius</li><li>Banyak yang terpaksa berhutang atau menjual barang berharga</li></ul><h3>Dampak Jangka Panjang:</h3><ol><li>Terlilit hutang yang sulit dilunasi</li><li>Putus kuliah karena tidak mampu bayar SPP</li><li>Kehilangan kesempatan investasi untuk masa depan</li><li>Reputasi keuangan buruk</li></ol><h3>Solusi Manajemen Keuangan:</h3><p>Buat budget ketat, pisahkan rekening untuk kebutuhan berbeda, dan konsultasi dengan ahli keuangan jika terlanjur terlilit hutang.</p>', 1, '2026-01-09 09:41:17'),
(5, 'Peran Keluarga dalam Mencegah Judi Online', 'https://images.unsplash.com/photo-1511895426328-dc8714191300?w=600&h=400&fit=crop', '<h2>Dukungan Keluarga sebagai Benteng Pencegahan</h2><p>Keluarga memiliki peran vital dalam mencegah dan membantu pemulihan anggota keluarga yang terlibat judi online.</p><h3>Langkah-langkah untuk Keluarga:</h3><ul><li><strong>Komunikasi Terbuka</strong> - Bangun dialog yang jujur tanpa menghakimi</li><li><strong>Monitoring Tanpa Invasi</strong> - Awasi aktivitas online anak dengan bijak</li><li><strong>Edukasi Bersama</strong> - Pelajari tentang bahaya judi online sebagai keluarga</li><li><strong>Support System</strong> - Tunjukkan bahwa keluarga selalu ada untuk mendukung</li><li><strong>Cari Bantuan Profesional</strong> - Jangan ragu konsultasi dengan psikolog</li></ul><h3>Tanda yang Harus Diwaspadai:</h3><p>Perubahan perilaku drastis, sering meminjam uang, mengisolasi diri, dan penurunan performa akademik adalah tanda-tanda yang perlu diperhatikan orang tua.</p>', 1, '2026-01-09 09:41:17'),
(6, 'Teknologi RNG dan Kecurangan dalam Judi Online', 'https://images.unsplash.com/photo-1550751827-4bd374c3f58b?w=600&h=400&fit=crop', '<h2>Memahami Random Number Generator (RNG)</h2><p>RNG adalah teknologi yang digunakan dalam judi online untuk menghasilkan hasil yang \"acak\". Namun, pemain perlu memahami bahwa sistem ini selalu menguntungkan bandar.</p><h3>Fakta tentang RNG:</h3><ul><li>RNG diprogram untuk memberikan keuntungan pada bandar (house edge)</li><li>Tidak ada strategi yang bisa mengalahkan RNG dalam jangka panjang</li><li>Konsep \"pola\" dalam permainan slot adalah mitos</li><li>Setiap putaran adalah independen, tidak terpengaruh hasil sebelumnya</li></ul><h3>Return to Player (RTP):</h3><p>RTP menunjukkan persentase uang yang dikembalikan ke pemain dalam jangka panjang. Jika RTP adalah 95%, berarti bandar mengambil 5% profit. Ini selalu menguntungkan bandar.</p><h3>Kesimpulan:</h3><p>Tidak ada cara untuk \"mengalahkan sistem\" dalam judi online. Matematika selalu menguntungkan bandar.</p>', 1, '2026-01-09 09:41:17'),
(7, 'Hukum dan Konsekuensi Judi Online di Indonesia', 'https://images.unsplash.com/photo-1589829545856-d10d557cf95f?w=600&h=400&fit=crop', '<h2>Aspek Legal Judi Online</h2><p>Judi online adalah aktivitas ilegal di Indonesia dengan konsekuensi hukum yang serius.</p><h3>Dasar Hukum:</h3><ul><li><strong>Pasal 303 KUHP</strong> - Mengatur tentang perjudian dengan hukuman maksimal 10 tahun</li><li><strong>UU ITE Pasal 27</strong> - Mengatur konten ilegal termasuk judi online</li><li><strong>UU No. 19 Tahun 2016</strong> - Perubahan atas UU ITE</li></ul><h3>Konsekuensi Hukum:</h3><ol><li>Pidana penjara hingga 10 tahun</li><li>Denda hingga miliaran rupiah</li><li>Catatan kriminal yang mempengaruhi karir masa depan</li><li>Sanksi akademik bagi mahasiswa</li></ol><h3>Untuk Mahasiswa:</h3><p>Terlibat judi online dapat menyebabkan skorsing atau pemecatan dari kampus, kehilangan beasiswa, dan kesulitan mendapat pekerjaan di masa depan.</p>', 1, '2026-01-09 09:41:17'),
(8, 'Rehabilitasi dan Pemulihan dari Kecanduan Judi', 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=600&h=400&fit=crop', '<h2>Langkah-langkah Pemulihan</h2><p>Pemulihan dari kecanduan judi online adalah proses yang membutuhkan waktu dan komitmen, namun sangat mungkin dilakukan.</p><h3>Tahapan Pemulihan:</h3><ol><li><strong>Mengakui Masalah</strong> - Langkah pertama adalah mengakui adanya masalah</li><li><strong>Mencari Bantuan Profesional</strong> - Konsultasi dengan psikolog atau konselor</li><li><strong>Join Support Group</strong> - Bergabung dengan komunitas pemulihan</li><li><strong>Blokir Akses</strong> - Hapus aplikasi dan blokir situs judi</li><li><strong>Atur Keuangan</strong> - Serahkan kontrol keuangan ke orang terpercaya</li><li><strong>Terapi Reguler</strong> - Ikuti sesi terapi secara konsisten</li></ol><h3>Layanan Bantuan:</h3><ul><li>Hotline konseling kecanduan</li><li>Psikolog kampus</li><li>Komunitas Gamblers Anonymous</li><li>Klinik rehabilitasi kecanduan</li></ul><h3>Relapse Prevention:</h3><p>Identifikasi pemicu, buat rencana coping, dan bangun rutinitas positif untuk mencegah kambuh.</p>', 1, '2026-01-09 09:41:17'),
(9, 'Media Sosial dan Promosi Judi Online', 'https://images.unsplash.com/photo-1611162617474-5b21e879e113?w=600&h=400&fit=crop', '<h2>Strategi Marketing Judi Online di Medsos</h2><p>Platform media sosial sering digunakan untuk mempromosikan judi online secara terselubung, menargetkan mahasiswa dan generasi muda.</p><h3>Taktik Promosi yang Umum:</h3><ul><li>Menggunakan influencer dan selebgram</li><li>Memberikan bonus dan promo menarik</li><li>Menampilkan testimoni palsu kemenangan besar</li><li>Menggunakan kode referral untuk viral marketing</li><li>Membuat grup tertutup di Telegram/WhatsApp</li></ul><h3>Red Flags yang Harus Diwaspadai:</h3><ol><li>Janji keuntungan pasti dan cepat</li><li>Testimoni tanpa bukti yang jelas</li><li>Link mencurigakan dan domain asing</li><li>Pressure untuk segera daftar</li></ol><h3>Cara Melindungi Diri:</h3><p>Berpikir kritis terhadap konten promosi, laporkan akun yang mempromosikan judi, dan edukasi teman-teman tentang bahaya judi online.</p>', 1, '2026-01-09 09:41:17'),
(10, 'Membangun Ketahanan Mental Menghadapi Godaan Judi', 'https://images.unsplash.com/photo-1499750310107-5fef28a66643?w=600&h=400&fit=crop', '<h2>Strategi Psikologis untuk Mahasiswa</h2><p>Membangun ketahanan mental adalah kunci untuk terhindar dari jebakan judi online.</p><h3>Teknik Penguatan Mental:</h3><ul><li><strong>Mindfulness dan Meditasi</strong> - Latih kesadaran penuh dan kontrol diri</li><li><strong>Goal Setting</strong> - Tetapkan tujuan akademik dan karir yang jelas</li><li><strong>Stress Management</strong> - Kelola stress dengan cara sehat</li><li><strong>Self-Reward System</strong> - Beri reward positif untuk pencapaian</li><li><strong>Critical Thinking</strong> - Kembangkan kemampuan berpikir kritis</li></ul><h3>Membangun Kebiasaan Positif:</h3><ol><li>Olahraga teratur untuk kesehatan fisik dan mental</li><li>Ikut organisasi dan kegiatan kampus</li><li>Kembangkan hobi dan skill baru</li><li>Jaga hubungan sosial yang sehat</li><li>Kelola waktu dengan efektif</li></ol><h3>Support System:</h3><p>Bangun jaringan dukungan yang kuat dengan keluarga, teman, dan mentor yang dapat memberikan motivasi dan bantuan saat menghadapi tekanan.</p>', 1, '2026-01-09 09:41:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `question` text NOT NULL,
  `weight` decimal(5,2) DEFAULT 1.00,
  `group_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `questions`
--

INSERT INTO `questions` (`id`, `question`, `weight`, `group_id`, `created_at`) VALUES
(1, 'Seberapa sering Anda mengakses situs atau aplikasi judi online?', 10.00, 1, '2026-01-09 09:41:17'),
(2, 'Seberapa sering Anda memikirkan tentang judi online dalam aktivitas sehari-hari?', 10.00, 1, '2026-01-09 09:41:17'),
(3, 'Seberapa sering Anda merasa kesulitan untuk berhenti atau mengurangi aktivitas judi online?', 10.00, 1, '2026-01-09 09:41:17'),
(4, 'Seberapa sering Anda menggunakan uang untuk keperluan kuliah (SPP, buku, dll) untuk berjudi online?', 10.00, 1, '2026-01-09 09:41:17'),
(5, 'Seberapa sering Anda melewatkan kelas atau kegiatan kampus karena sibuk berjudi online?', 10.00, 1, '2026-01-09 09:41:17'),
(6, 'Seberapa sering Anda berbohong kepada keluarga atau teman tentang aktivitas judi online Anda?', 10.00, 1, '2026-01-09 09:41:17'),
(7, 'Seberapa sering Anda meminjam uang untuk berjudi online?', 10.00, 1, '2026-01-09 09:41:17'),
(8, 'Seberapa sering Anda menggunakan judi online sebagai pelarian dari stress atau masalah?', 10.00, 1, '2026-01-09 09:41:17'),
(9, 'Seberapa sering Anda berjudi online hingga kehabisan uang?', 10.00, 1, '2026-01-09 09:41:17'),
(10, 'Seberapa sering prestasi akademik Anda terganggu karena aktivitas judi online?', 10.00, 1, '2026-01-09 09:41:17'),
(11, 'Seberapa sering Anda mengakses platform judi online?', 10.00, 2, '2026-01-09 09:41:17'),
(12, 'Seberapa sering Anda mencoba mencari informasi tentang \"trik\" atau \"pola\" dalam judi online?', 10.00, 2, '2026-01-09 09:41:17'),
(13, 'Seberapa sering Anda mengabaikan tugas programming atau project kuliah karena judi online?', 10.00, 2, '2026-01-09 09:41:17'),
(14, 'Seberapa sering Anda merasa yakin bisa mengalahkan sistem judi online dengan strategi tertentu?', 10.00, 2, '2026-01-09 09:41:17'),
(15, 'Seberapa sering Anda menggunakan cryptocurrency atau e-wallet untuk transaksi judi online?', 10.00, 2, '2026-01-09 09:41:17'),
(16, 'Seberapa sering Anda mencoba mengakses situs judi yang diblokir menggunakan VPN?', 10.00, 2, '2026-01-09 09:41:17'),
(17, 'Seberapa sering Anda menghabiskan waktu bermain judi online hingga larut malam?', 10.00, 2, '2026-01-09 09:41:17'),
(18, 'Seberapa sering Anda merasa gelisah atau cemas ketika tidak bisa mengakses situs judi online?', 10.00, 2, '2026-01-09 09:41:17'),
(19, 'Seberapa sering Anda berbagi informasi tentang situs judi online kepada teman-teman?', 10.00, 2, '2026-01-09 09:41:17'),
(20, 'Seberapa sering Anda mengabaikan keamanan data pribadi demi kemudahan akses judi online?', 10.00, 2, '2026-01-09 09:41:17'),
(21, 'Seberapa sering Anda melihat iklan atau promosi judi online di media sosial Anda?', 10.00, 3, '2026-01-09 09:41:17'),
(22, 'Seberapa sering Anda tertarik dengan tampilan visual platform judi online?', 10.00, 3, '2026-01-09 09:41:17'),
(23, 'Seberapa sering Anda mengklik atau membuka konten promosi judi online yang muncul di feed Anda?', 10.00, 3, '2026-01-09 09:41:17'),
(24, 'Seberapa sering Anda tergoda mencoba judi online karena desain yang menarik dan user-friendly?', 10.00, 3, '2026-01-09 09:41:17'),
(25, 'Seberapa sering Anda melihat influencer atau content creator mempromosikan judi online?', 10.00, 3, '2026-01-09 09:41:17'),
(26, 'Seberapa sering Anda mengikuti akun media sosial yang berkaitan dengan judi online?', 10.00, 3, '2026-01-09 09:41:17'),
(27, 'Seberapa sering Anda merasa ingin mencoba judi online setelah melihat testimoni kemenangan orang lain?', 10.00, 3, '2026-01-09 09:41:17'),
(28, 'Seberapa sering project desain atau tugas kuliah Anda terganggu karena judi online?', 10.00, 3, '2026-01-09 09:41:17'),
(29, 'Seberapa sering Anda mempertimbangkan untuk membuat konten atau desain terkait judi online demi uang?', 10.00, 3, '2026-01-09 09:41:17'),
(30, 'Seberapa sering Anda menghabiskan uang hasil freelance desain untuk berjudi online?', 10.00, 3, '2026-01-09 09:41:17'),
(31, 'Seberapa sering Anda menganggap judi online sebagai cara untuk mendapatkan uang tambahan?', 10.00, 4, '2026-01-09 09:41:17'),
(32, 'Seberapa sering Anda mengalami kesulitan keuangan akibat judi online?', 10.00, 4, '2026-01-09 09:41:17'),
(33, 'Seberapa sering Anda menggunakan uang belanja atau uang makan untuk berjudi online?', 10.00, 4, '2026-01-09 09:41:17'),
(34, 'Seberapa sering Anda menyembunyikan transaksi judi online dari keluarga?', 10.00, 4, '2026-01-09 09:41:17'),
(35, 'Seberapa sering Anda berhutang atau meminjam uang untuk modal judi online?', 10.00, 4, '2026-01-09 09:41:17'),
(36, 'Seberapa sering Anda mengabaikan kebutuhan penting demi berjudi online?', 10.00, 4, '2026-01-09 09:41:17'),
(37, 'Seberapa sering Anda merasa menyesal setelah menghabiskan uang untuk judi online?', 10.00, 4, '2026-01-09 09:41:17'),
(38, 'Seberapa sering Anda mencoba \"mengejar kerugian\" dengan terus berjudi?', 10.00, 4, '2026-01-09 09:41:17'),
(39, 'Seberapa sering Anda membandingkan judi online dengan investasi atau bisnis?', 10.00, 4, '2026-01-09 09:41:17'),
(40, 'Seberapa sering tugas atau project kuliah Anda terganggu karena memikirkan judi online?', 10.00, 4, '2026-01-09 09:41:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rng_games`
--

CREATE TABLE `rng_games` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `game_type` varchar(50) NOT NULL COMMENT 'Slot, Dice, Card, Roulette, Crash, Wheel, Other',
  `symbols` varchar(255) NOT NULL COMMENT 'Emoji atau karakter simbol dipisahkan koma',
  `rtp` decimal(5,2) NOT NULL COMMENT 'Return to Player dalam persen (0-100)',
  `bet_cost` int(11) NOT NULL COMMENT 'Biaya taruhan per putaran',
  `max_payout` int(11) NOT NULL COMMENT 'Maksimal kemenangan yang bisa didapat',
  `is_active` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 = Aktif, 0 = Nonaktif',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `rng_games`
--

INSERT INTO `rng_games` (`id`, `name`, `description`, `game_type`, `symbols`, `rtp`, `bet_cost`, `max_payout`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Gates of Olympus', 'Game slot viral dengan tema dewa Zeus. Menampilkan fitur tumbling reels dan multiplier hingga 500x. Sangat populer di kalangan penjudi online Indonesia dengan janji keuntungan besar.', 'slot', '[\"⚡\", \"👑\", \"💎\", \"🏛️\", \"⭐\", \"💰\", \"🎲\"]', 96.50, 1000, 50000000, 1, '2026-01-09 09:41:17', '2026-01-09 09:41:17'),
(2, 'Starlight Princess', 'Slot dengan tema princess yang sangat viral. Menggunakan mekanik pay anywhere dan memiliki multiplier progresif. Banyak digunakan untuk judi dengan taruhan mulai dari ribuan hingga jutaan rupiah.', 'slot', '[\"👸\", \"⭐\", \"💫\", \"🌙\", \"💎\", \"🦄\", \"✨\"]', 96.50, 500, 100000000, 1, '2026-01-09 09:41:17', '2026-01-09 09:41:17'),
(3, 'Sweet Bonanza', 'Game slot bertema permen dan buah-buahan. Menggunakan cluster pays dan free spins dengan multiplier. Sangat adiktif karena visual yang menarik dan suara kemenangan yang dirancang untuk memicu dopamine.', 'slot', '[\"🍭\", \"🍇\", \"🍌\", \"🍎\", \"🍉\", \"💣\", \"🍬\"]', 96.50, 1000, 75000000, 1, '2026-01-09 09:41:17', '2026-01-09 09:41:17'),
(4, 'Spaceman', 'Game crash populer di mana pemain bertaruh pada multiplier yang terus naik. Pemain harus cash out sebelum spaceman crash. Game ini sangat adiktif karena ilusi kontrol dan near-miss effect.', 'crash', '[\"🚀\", \"👨‍🚀\", \"💥\", \"📈\", \"🌟\"]', 97.00, 1000, 10000000, 1, '2026-01-09 09:41:17', '2026-01-09 09:41:17'),
(5, 'Aviator', 'Mirip dengan Spaceman, game crash yang sangat viral. Grafis sederhana tapi sangat adiktif. Banyak yang kehilangan uang karena terus mengejar multiplier tinggi.', 'crash', '[\"✈️\", \"📊\", \"💰\", \"⬆️\", \"💥\"]', 97.00, 500, 15000000, 1, '2026-01-09 09:41:17', '2026-01-09 09:41:17'),
(6, 'Crazy Time', 'Game show live dengan wheel of fortune. Menampilkan bonus games seperti Cash Hunt, Pachinko, dan Coin Flip. Format interaktif membuatnya sangat adiktif.', 'live', '[\"🎡\", \"💰\", \"🎯\", \"🎪\", \"⭐\", \"🎁\"]', 96.10, 2000, 500000000, 1, '2026-01-09 09:41:17', '2026-01-09 09:41:17'),
(7, 'Mega Wheel', 'Game roda keberuntungan dengan multiplier besar. Simple tapi sangat adiktif karena kesempatan menang terlihat mudah padahal probabilitas sangat kecil.', 'wheel', '[\"🎡\", \"1️⃣\", \"2️⃣\", \"5️⃣\", \"🔟\", \"🎯\"]', 96.50, 1000, 40000000, 1, '2026-01-09 09:41:17', '2026-01-09 09:41:17'),
(8, 'Mahjong Ways', 'Slot dengan tema mahjong yang populer. Menggunakan mekanik ways to win dengan thousands of ways. Populer karena frekuensi kemenangan kecil yang membuat pemain terus bermain.', 'slot', '[\"🀄\", \"🎋\", \"🏮\", \"🐉\", \"🌸\", \"⛩️\"]', 96.90, 800, 60000000, 1, '2026-01-09 09:41:17', '2026-01-09 09:41:17'),
(9, 'Fruit Party', 'Slot cluster pays dengan tema buah-buahan. Multiplier yang terus naik dalam free spins membuat game ini sangat adiktif. Banyak pemain terjebak mencoba mendapatkan free spins.', 'slot', '[\"🍓\", \"🍇\", \"🍊\", \"🍎\", \"🫐\", \"🥝\", \"⭐\"]', 96.50, 1000, 50000000, 1, '2026-01-09 09:41:17', '2026-01-09 09:41:17'),
(10, 'Mines', 'Game original crypto casino yang populer. Pemain memilih tiles dan menghindari mines. Setiap tile yang aman meningkatkan multiplier. Sangat adiktif karena ilusi kontrol.', 'original', '[\"💎\", \"💣\", \"⭐\", \"✅\", \"❌\"]', 97.00, 500, 10000000, 1, '2026-01-09 09:41:17', '2026-01-09 09:41:17');

-- --------------------------------------------------------

--
-- Struktur dari tabel `simulations`
--

CREATE TABLE `simulations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `game_id` int(11) DEFAULT NULL,
  `total_round` int(11) DEFAULT 0,
  `initial_balance` decimal(15,2) DEFAULT 0.00,
  `final_balance` decimal(15,2) DEFAULT 0.00,
  `net_loss` decimal(15,2) DEFAULT 0.00,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `simulations`
--

INSERT INTO `simulations` (`id`, `user_id`, `game_id`, `total_round`, `initial_balance`, `final_balance`, `net_loss`, `created_at`) VALUES
(1, 13, 8, 17, 1000000.00, 758576.00, 241424.00, '2026-01-09 09:46:08'),
(2, 13, 9, 3, 758576.00, 858576.00, -100000.00, '2026-01-09 10:34:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `balance` int(11) DEFAULT 1000000,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `balance`, `created_at`) VALUES
(1, 'Doni Wahyono', 'doni@sigma.com', '$2y$10$jke78Zjzw1NNFxjrU8Tl3OAgppRQWASzaL.TGdUsa/dsbI70nZXgW', 'admin', 1000000, '2025-12-31 17:39:37'),
(13, 'Akmal Abidin', 'akmal@gmail.com', '$2y$10$TaoBb/bRUSqeZ9ceUu9tnedcsgfeNltnnG6ZUbPKeYXO8/5B/yA1m', 'user', 858576, '2026-01-09 09:44:19');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `assessments`
--
ALTER TABLE `assessments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `group_id` (`group_id`);

--
-- Indeks untuk tabel `assessment_answers`
--
ALTER TABLE `assessment_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assessment_id` (`assessment_id`),
  ADD KEY `question_id` (`question_id`);

--
-- Indeks untuk tabel `assessment_groups`
--
ALTER TABLE `assessment_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `education_content`
--
ALTER TABLE `education_content`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indeks untuk tabel `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_id` (`group_id`);

--
-- Indeks untuk tabel `rng_games`
--
ALTER TABLE `rng_games`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `simulations`
--
ALTER TABLE `simulations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `idx_game_id` (`game_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `assessments`
--
ALTER TABLE `assessments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `assessment_answers`
--
ALTER TABLE `assessment_answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `assessment_groups`
--
ALTER TABLE `assessment_groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `education_content`
--
ALTER TABLE `education_content`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `rng_games`
--
ALTER TABLE `rng_games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `simulations`
--
ALTER TABLE `simulations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `assessments`
--
ALTER TABLE `assessments`
  ADD CONSTRAINT `assessments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `assessments_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `assessment_groups` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `assessment_answers`
--
ALTER TABLE `assessment_answers`
  ADD CONSTRAINT `assessment_answers_ibfk_1` FOREIGN KEY (`assessment_id`) REFERENCES `assessments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `assessment_answers_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`);

--
-- Ketidakleluasaan untuk tabel `education_content`
--
ALTER TABLE `education_content`
  ADD CONSTRAINT `education_content_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `assessment_groups` (`id`) ON DELETE SET NULL;

--
-- Ketidakleluasaan untuk tabel `simulations`
--
ALTER TABLE `simulations`
  ADD CONSTRAINT `simulations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
