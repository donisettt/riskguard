-- ============================================
-- SIGMA - Database Seed Data
-- Sistem Monitoring Risiko Judi Online
-- ============================================

-- ============================================
-- 1. EDUCATION CONTENT (10 Konten)
-- ============================================

INSERT INTO `education_content` (`title`, `banner`, `content`, `created_by`, `created_at`) VALUES
(
    'Memahami Bahaya Kecanduan Judi Online',
    'https://images.unsplash.com/photo-1511632765486-a01980e01a18?w=600&h=400&fit=crop',
    '<h2>Pengenalan Judi Online</h2><p>Judi online telah menjadi masalah serius di kalangan mahasiswa dan masyarakat umum. Dengan kemudahan akses melalui smartphone, judi online dapat diakses kapan saja dan dimana saja.</p><h3>Dampak Negatif Judi Online:</h3><ul><li>Kerugian finansial yang signifikan</li><li>Gangguan kesehatan mental seperti depresi dan kecemasan</li><li>Menurunnya prestasi akademik</li><li>Kerusakan hubungan sosial dan keluarga</li><li>Risiko terlibat dalam aktivitas ilegal</li></ul><h3>Tanda-tanda Kecanduan:</h3><p>Seseorang yang kecanduan judi online akan menunjukkan tanda-tanda seperti sering bermain dalam waktu lama, sulit berhenti, berbohong tentang aktivitas judi, dan mengabaikan tanggung jawab.</p>',
    1,
    NOW()
),
(
    'Strategi Pencegahan Kecanduan Judi Online',
    'https://images.unsplash.com/photo-1434030216411-0b793f4b4173?w=600&h=400&fit=crop',
    '<h2>Langkah Preventif untuk Mahasiswa</h2><p>Pencegahan adalah kunci utama dalam mengatasi masalah judi online di kampus.</p><h3>Tips Pencegahan:</h3><ol><li><strong>Edukasi Dini</strong> - Pahami risiko dan bahaya judi online sejak awal</li><li><strong>Kelola Keuangan dengan Bijak</strong> - Buat anggaran dan patuhi batas pengeluaran</li><li><strong>Isi Waktu Luang dengan Produktif</strong> - Ikuti organisasi kampus atau hobi positif</li><li><strong>Bangun Lingkungan Positif</strong> - Bergaul dengan teman-teman yang mendukung</li><li><strong>Gunakan Filter Aplikasi</strong> - Pasang aplikasi pemblokir situs judi</li></ol><h3>Peran Kampus:</h3><p>Kampus dapat melakukan sosialisasi rutin, menyediakan konseling, dan membuat kebijakan tegas terkait judi online.</p>',
    1,
    NOW()
),
(
    'Mengenali Pola Pikir Penjudi Online',
    'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=600&h=400&fit=crop',
    '<h2>Psikologi di Balik Judi Online</h2><p>Memahami pola pikir penjudi adalah langkah penting dalam pencegahan dan rehabilitasi.</p><h3>Cognitive Distortions (Distorsi Kognitif):</h3><ul><li><strong>Gamblers Fallacy</strong> - Keyakinan bahwa kekalahan beruntun akan diikuti kemenangan</li><li><strong>Illusion of Control</strong> - Merasa bisa mengontrol hasil permainan yang sebenarnya random</li><li><strong>Near Miss Effect</strong> - Hampir menang membuat terus bermain</li><li><strong>Chasing Losses</strong> - Berusaha mengembalikan uang yang hilang dengan terus berjudi</li></ul><h3>Faktor Pemicu:</h3><p>Stress, tekanan akademik, masalah keuangan, dan lingkungan sosial dapat menjadi pemicu seseorang mulai berjudi online.</p><h3>Cara Mengubah Pola Pikir:</h3><p>Terapi kognitif-behavioral (CBT) dan konseling dapat membantu mengubah pola pikir yang salah tentang judi.</p>',
    1,
    NOW()
),
(
    'Dampak Ekonomi Judi Online pada Mahasiswa',
    'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?w=600&h=400&fit=crop',
    '<h2>Kerugian Finansial yang Mengancam</h2><p>Judi online dapat menyebabkan kerugian finansial yang sangat besar bagi mahasiswa.</p><h3>Statistik Mengejutkan:</h3><ul><li>Rata-rata kerugian mahasiswa penjudi mencapai jutaan rupiah per bulan</li><li>80% penjudi mahasiswa mengalami kesulitan keuangan serius</li><li>Banyak yang terpaksa berhutang atau menjual barang berharga</li></ul><h3>Dampak Jangka Panjang:</h3><ol><li>Terlilit hutang yang sulit dilunasi</li><li>Putus kuliah karena tidak mampu bayar SPP</li><li>Kehilangan kesempatan investasi untuk masa depan</li><li>Reputasi keuangan buruk</li></ol><h3>Solusi Manajemen Keuangan:</h3><p>Buat budget ketat, pisahkan rekening untuk kebutuhan berbeda, dan konsultasi dengan ahli keuangan jika terlanjur terlilit hutang.</p>',
    1,
    NOW()
),
(
    'Peran Keluarga dalam Mencegah Judi Online',
    'https://images.unsplash.com/photo-1511895426328-dc8714191300?w=600&h=400&fit=crop',
    '<h2>Dukungan Keluarga sebagai Benteng Pencegahan</h2><p>Keluarga memiliki peran vital dalam mencegah dan membantu pemulihan anggota keluarga yang terlibat judi online.</p><h3>Langkah-langkah untuk Keluarga:</h3><ul><li><strong>Komunikasi Terbuka</strong> - Bangun dialog yang jujur tanpa menghakimi</li><li><strong>Monitoring Tanpa Invasi</strong> - Awasi aktivitas online anak dengan bijak</li><li><strong>Edukasi Bersama</strong> - Pelajari tentang bahaya judi online sebagai keluarga</li><li><strong>Support System</strong> - Tunjukkan bahwa keluarga selalu ada untuk mendukung</li><li><strong>Cari Bantuan Profesional</strong> - Jangan ragu konsultasi dengan psikolog</li></ul><h3>Tanda yang Harus Diwaspadai:</h3><p>Perubahan perilaku drastis, sering meminjam uang, mengisolasi diri, dan penurunan performa akademik adalah tanda-tanda yang perlu diperhatikan orang tua.</p>',
    1,
    NOW()
),
(
    'Teknologi RNG dan Kecurangan dalam Judi Online',
    'https://images.unsplash.com/photo-1550751827-4bd374c3f58b?w=600&h=400&fit=crop',
    '<h2>Memahami Random Number Generator (RNG)</h2><p>RNG adalah teknologi yang digunakan dalam judi online untuk menghasilkan hasil yang "acak". Namun, pemain perlu memahami bahwa sistem ini selalu menguntungkan bandar.</p><h3>Fakta tentang RNG:</h3><ul><li>RNG diprogram untuk memberikan keuntungan pada bandar (house edge)</li><li>Tidak ada strategi yang bisa mengalahkan RNG dalam jangka panjang</li><li>Konsep "pola" dalam permainan slot adalah mitos</li><li>Setiap putaran adalah independen, tidak terpengaruh hasil sebelumnya</li></ul><h3>Return to Player (RTP):</h3><p>RTP menunjukkan persentase uang yang dikembalikan ke pemain dalam jangka panjang. Jika RTP adalah 95%, berarti bandar mengambil 5% profit. Ini selalu menguntungkan bandar.</p><h3>Kesimpulan:</h3><p>Tidak ada cara untuk "mengalahkan sistem" dalam judi online. Matematika selalu menguntungkan bandar.</p>',
    1,
    NOW()
),
(
    'Hukum dan Konsekuensi Judi Online di Indonesia',
    'https://images.unsplash.com/photo-1589829545856-d10d557cf95f?w=600&h=400&fit=crop',
    '<h2>Aspek Legal Judi Online</h2><p>Judi online adalah aktivitas ilegal di Indonesia dengan konsekuensi hukum yang serius.</p><h3>Dasar Hukum:</h3><ul><li><strong>Pasal 303 KUHP</strong> - Mengatur tentang perjudian dengan hukuman maksimal 10 tahun</li><li><strong>UU ITE Pasal 27</strong> - Mengatur konten ilegal termasuk judi online</li><li><strong>UU No. 19 Tahun 2016</strong> - Perubahan atas UU ITE</li></ul><h3>Konsekuensi Hukum:</h3><ol><li>Pidana penjara hingga 10 tahun</li><li>Denda hingga miliaran rupiah</li><li>Catatan kriminal yang mempengaruhi karir masa depan</li><li>Sanksi akademik bagi mahasiswa</li></ol><h3>Untuk Mahasiswa:</h3><p>Terlibat judi online dapat menyebabkan skorsing atau pemecatan dari kampus, kehilangan beasiswa, dan kesulitan mendapat pekerjaan di masa depan.</p>',
    1,
    NOW()
),
(
    'Rehabilitasi dan Pemulihan dari Kecanduan Judi',
    'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?w=600&h=400&fit=crop',
    '<h2>Langkah-langkah Pemulihan</h2><p>Pemulihan dari kecanduan judi online adalah proses yang membutuhkan waktu dan komitmen, namun sangat mungkin dilakukan.</p><h3>Tahapan Pemulihan:</h3><ol><li><strong>Mengakui Masalah</strong> - Langkah pertama adalah mengakui adanya masalah</li><li><strong>Mencari Bantuan Profesional</strong> - Konsultasi dengan psikolog atau konselor</li><li><strong>Join Support Group</strong> - Bergabung dengan komunitas pemulihan</li><li><strong>Blokir Akses</strong> - Hapus aplikasi dan blokir situs judi</li><li><strong>Atur Keuangan</strong> - Serahkan kontrol keuangan ke orang terpercaya</li><li><strong>Terapi Reguler</strong> - Ikuti sesi terapi secara konsisten</li></ol><h3>Layanan Bantuan:</h3><ul><li>Hotline konseling kecanduan</li><li>Psikolog kampus</li><li>Komunitas Gamblers Anonymous</li><li>Klinik rehabilitasi kecanduan</li></ul><h3>Relapse Prevention:</h3><p>Identifikasi pemicu, buat rencana coping, dan bangun rutinitas positif untuk mencegah kambuh.</p>',
    1,
    NOW()
),
(
    'Media Sosial dan Promosi Judi Online',
    'https://images.unsplash.com/photo-1611162617474-5b21e879e113?w=600&h=400&fit=crop',
    '<h2>Strategi Marketing Judi Online di Medsos</h2><p>Platform media sosial sering digunakan untuk mempromosikan judi online secara terselubung, menargetkan mahasiswa dan generasi muda.</p><h3>Taktik Promosi yang Umum:</h3><ul><li>Menggunakan influencer dan selebgram</li><li>Memberikan bonus dan promo menarik</li><li>Menampilkan testimoni palsu kemenangan besar</li><li>Menggunakan kode referral untuk viral marketing</li><li>Membuat grup tertutup di Telegram/WhatsApp</li></ul><h3>Red Flags yang Harus Diwaspadai:</h3><ol><li>Janji keuntungan pasti dan cepat</li><li>Testimoni tanpa bukti yang jelas</li><li>Link mencurigakan dan domain asing</li><li>Pressure untuk segera daftar</li></ol><h3>Cara Melindungi Diri:</h3><p>Berpikir kritis terhadap konten promosi, laporkan akun yang mempromosikan judi, dan edukasi teman-teman tentang bahaya judi online.</p>',
    1,
    NOW()
),
(
    'Membangun Ketahanan Mental Menghadapi Godaan Judi',
    'https://images.unsplash.com/photo-1499750310107-5fef28a66643?w=600&h=400&fit=crop',
    '<h2>Strategi Psikologis untuk Mahasiswa</h2><p>Membangun ketahanan mental adalah kunci untuk terhindar dari jebakan judi online.</p><h3>Teknik Penguatan Mental:</h3><ul><li><strong>Mindfulness dan Meditasi</strong> - Latih kesadaran penuh dan kontrol diri</li><li><strong>Goal Setting</strong> - Tetapkan tujuan akademik dan karir yang jelas</li><li><strong>Stress Management</strong> - Kelola stress dengan cara sehat</li><li><strong>Self-Reward System</strong> - Beri reward positif untuk pencapaian</li><li><strong>Critical Thinking</strong> - Kembangkan kemampuan berpikir kritis</li></ul><h3>Membangun Kebiasaan Positif:</h3><ol><li>Olahraga teratur untuk kesehatan fisik dan mental</li><li>Ikut organisasi dan kegiatan kampus</li><li>Kembangkan hobi dan skill baru</li><li>Jaga hubungan sosial yang sehat</li><li>Kelola waktu dengan efektif</li></ol><h3>Support System:</h3><p>Bangun jaringan dukungan yang kuat dengan keluarga, teman, dan mentor yang dapat memberikan motivasi dan bantuan saat menghadapi tekanan.</p>',
    1,
    NOW()
);

-- ============================================
-- 2. RNG GAMES (10 Game Populer)
-- ============================================

INSERT INTO `rng_games` (`name`, `description`, `game_type`, `symbols`, `rtp`, `bet_cost`, `max_payout`, `is_active`, `created_at`) VALUES
(
    'Gates of Olympus',
    'Game slot viral dengan tema dewa Zeus. Menampilkan fitur tumbling reels dan multiplier hingga 500x. Sangat populer di kalangan penjudi online Indonesia dengan janji keuntungan besar.',
    'slot',
    '["⚡", "👑", "💎", "🏛️", "⭐", "💰", "🎲"]',
    96.5,
    1000,
    50000000,
    1,
    NOW()
),
(
    'Starlight Princess',
    'Slot dengan tema princess yang sangat viral. Menggunakan mekanik pay anywhere dan memiliki multiplier progresif. Banyak digunakan untuk judi dengan taruhan mulai dari ribuan hingga jutaan rupiah.',
    'slot',
    '["👸", "⭐", "💫", "🌙", "💎", "🦄", "✨"]',
    96.5,
    500,
    100000000,
    1,
    NOW()
),
(
    'Sweet Bonanza',
    'Game slot bertema permen dan buah-buahan. Menggunakan cluster pays dan free spins dengan multiplier. Sangat adiktif karena visual yang menarik dan suara kemenangan yang dirancang untuk memicu dopamine.',
    'slot',
    '["🍭", "🍇", "🍌", "🍎", "🍉", "💣", "🍬"]',
    96.5,
    1000,
    75000000,
    1,
    NOW()
),
(
    'Spaceman',
    'Game crash populer di mana pemain bertaruh pada multiplier yang terus naik. Pemain harus cash out sebelum spaceman crash. Game ini sangat adiktif karena ilusi kontrol dan near-miss effect.',
    'crash',
    '["🚀", "👨‍🚀", "💥", "📈", "🌟"]',
    97.0,
    1000,
    10000000,
    1,
    NOW()
),
(
    'Aviator',
    'Mirip dengan Spaceman, game crash yang sangat viral. Grafis sederhana tapi sangat adiktif. Banyak yang kehilangan uang karena terus mengejar multiplier tinggi.',
    'crash',
    '["✈️", "📊", "💰", "⬆️", "💥"]',
    97.0,
    500,
    15000000,
    1,
    NOW()
),
(
    'Crazy Time',
    'Game show live dengan wheel of fortune. Menampilkan bonus games seperti Cash Hunt, Pachinko, dan Coin Flip. Format interaktif membuatnya sangat adiktif.',
    'live',
    '["🎡", "💰", "🎯", "🎪", "⭐", "🎁"]',
    96.1,
    2000,
    500000000,
    1,
    NOW()
),
(
    'Mega Wheel',
    'Game roda keberuntungan dengan multiplier besar. Simple tapi sangat adiktif karena kesempatan menang terlihat mudah padahal probabilitas sangat kecil.',
    'wheel',
    '["🎡", "1️⃣", "2️⃣", "5️⃣", "🔟", "🎯"]',
    96.5,
    1000,
    40000000,
    1,
    NOW()
),
(
    'Mahjong Ways',
    'Slot dengan tema mahjong yang populer. Menggunakan mekanik ways to win dengan thousands of ways. Populer karena frekuensi kemenangan kecil yang membuat pemain terus bermain.',
    'slot',
    '["🀄", "🎋", "🏮", "🐉", "🌸", "⛩️"]',
    96.9,
    800,
    60000000,
    1,
    NOW()
),
(
    'Fruit Party',
    'Slot cluster pays dengan tema buah-buahan. Multiplier yang terus naik dalam free spins membuat game ini sangat adiktif. Banyak pemain terjebak mencoba mendapatkan free spins.',
    'slot',
    '["🍓", "🍇", "🍊", "🍎", "🫐", "🥝", "⭐"]',
    96.5,
    1000,
    50000000,
    1,
    NOW()
),
(
    'Mines',
    'Game original crypto casino yang populer. Pemain memilih tiles dan menghindari mines. Setiap tile yang aman meningkatkan multiplier. Sangat adiktif karena ilusi kontrol.',
    'original',
    '["💎", "💣", "⭐", "✅", "❌"]',
    97.0,
    500,
    10000000,
    1,
    NOW()
);

-- ============================================
-- 3. ASSESSMENT GROUPS (Berdasarkan Angkatan & Jurusan)
-- ============================================

INSERT INTO `assessment_groups` (`title`, `description`, `created_at`) VALUES
-- Angkatan 2022
(
    'Assessment Risiko Judi Online - Teknik Industri 2022',
    'Assessment khusus untuk mahasiswa Teknik Industri angkatan 2022. Mengukur tingkat risiko kecanduan judi online dengan fokus pada aspek manajemen keuangan dan pengambilan keputusan. Target: Mahasiswa Teknik Industri Angkatan 2022',
    NOW()
),
(
    'Assessment Risiko Judi Online - Teknik Informatika 2022',
    'Assessment untuk mahasiswa Teknik Informatika angkatan 2022 dengan fokus khusus pada pemahaman teknologi RNG dan keamanan digital dalam konteks judi online. Target: Mahasiswa Teknik Informatika Angkatan 2022',
    NOW()
),
(
    'Assessment Risiko Judi Online - DKV 2022',
    'Assessment untuk mahasiswa Desain Komunikasi Visual angkatan 2022 dengan fokus pada dampak visual marketing dan media sosial dalam promosi judi online. Target: Mahasiswa Desain Komunikasi Visual Angkatan 2022',
    NOW()
),
(
    'Assessment Risiko Judi Online - Manajemen Ritel 2022',
    'Assessment untuk mahasiswa Manajemen Ritel angkatan 2022 dengan penekanan pada literasi keuangan dan manajemen risiko investasi vs judi. Target: Mahasiswa Manajemen Ritel Angkatan 2022',
    NOW()
),

-- Angkatan 2023
(
    'Assessment Risiko Judi Online - Teknik Industri 2023',
    'Assessment untuk mengidentifikasi potensi risiko kecanduan judi online pada mahasiswa Teknik Industri angkatan 2023, mencakup aspek psikologis dan perilaku. Target: Mahasiswa Teknik Industri Angkatan 2023',
    NOW()
),
(
    'Assessment Risiko Judi Online - Teknik Informatika 2023',
    'Evaluasi komprehensif risiko judi online untuk mahasiswa Teknik Informatika angkatan 2023 dengan fokus pada literasi digital dan keamanan online. Target: Mahasiswa Teknik Informatika Angkatan 2023',
    NOW()
),
(
    'Assessment Risiko Judi Online - DKV 2023',
    'Assessment khusus mahasiswa DKV angkatan 2023 untuk memahami pengaruh desain persuasif dan psikologi visual dalam platform judi online. Target: Mahasiswa Desain Komunikasi Visual Angkatan 2023',
    NOW()
),
(
    'Assessment Risiko Judi Online - Manajemen Ritel 2023',
    'Instrumen evaluasi untuk mahasiswa Manajemen Ritel angkatan 2023 dengan fokus pada decision making dan financial literacy. Target: Mahasiswa Manajemen Ritel Angkatan 2023',
    NOW()
),

-- Angkatan 2024
(
    'Assessment Risiko Judi Online - Teknik Industri 2024',
    'Assessment preventif untuk mahasiswa baru Teknik Industri angkatan 2024 sebagai edukasi awal tentang bahaya judi online. Target: Mahasiswa Teknik Industri Angkatan 2024',
    NOW()
),
(
    'Assessment Risiko Judi Online - Teknik Informatika 2024',
    'Screening awal risiko kecanduan judi online untuk mahasiswa Teknik Informatika angkatan 2024 dengan fokus cyber security awareness. Target: Mahasiswa Teknik Informatika Angkatan 2024',
    NOW()
),
(
    'Assessment Risiko Judi Online - DKV 2024',
    'Assessment untuk mahasiswa DKV angkatan 2024 tentang etika desain dan tanggung jawab dalam membuat konten visual. Target: Mahasiswa Desain Komunikasi Visual Angkatan 2024',
    NOW()
),
(
    'Assessment Risiko Judi Online - Manajemen Ritel 2024',
    'Evaluasi pemahaman dasar tentang risiko judi online untuk mahasiswa Manajemen Ritel angkatan 2024. Target: Mahasiswa Manajemen Ritel Angkatan 2024',
    NOW()
),

-- Angkatan 2025
(
    'Assessment Risiko Judi Online - Teknik Industri 2025',
    'Assessment orientasi untuk mahasiswa baru Teknik Industri angkatan 2025 sebagai bagian dari program pencegahan kecanduan judi online. Target: Mahasiswa Teknik Industri Angkatan 2025',
    NOW()
),
(
    'Assessment Risiko Judi Online - Teknik Informatika 2025',
    'Screening awal mahasiswa baru Teknik Informatika angkatan 2025 untuk identifikasi dini potensi risiko kecanduan judi online. Target: Mahasiswa Teknik Informatika Angkatan 2025',
    NOW()
),
(
    'Assessment Risiko Judi Online - DKV 2025',
    'Assessment pengenalan untuk mahasiswa DKV angkatan 2025 tentang bahaya judi online dan peran desainer yang bertanggung jawab. Target: Mahasiswa Desain Komunikasi Visual Angkatan 2025',
    NOW()
),
(
    'Assessment Risiko Judi Online - Manajemen Ritel 2025',
    'Instrumen evaluasi untuk mahasiswa baru Manajemen Ritel angkatan 2025 tentang financial wellness dan menghindari judi online. Target: Mahasiswa Manajemen Ritel Angkatan 2025',
    NOW()
),

-- Dosen & Staf
(
    'Assessment Risiko Judi Online - Dosen & Tenaga Pendidik',
    'Self-assessment untuk dosen dan tenaga pendidik kampus dalam mengevaluasi risiko pribadi terhadap judi online, kesehatan mental, dan financial wellness. Membantu identifikasi dini potensi masalah dan akses ke program bantuan. Target: Dosen & Tenaga Pendidik Kampus',
    NOW()
),
(
    'Assessment Risiko Judi Online - Staf Administrasi & Kemahasiswaan',
    'Self-assessment khusus untuk staf administrasi dan kemahasiswaan dalam menilai risiko pribadi kecanduan judi online, manajemen keuangan, dan kesejahteraan psikologis. Target: Staf Administrasi & Kemahasiswaan',
    NOW()
);

-- ============================================
-- 4. BANK SOAL (Sample Questions untuk Assessment)
-- ============================================
-- Catatan: Contoh 40 soal untuk berbagai grup assessment.
-- Format: (group_id, question, weight)
-- Kolom yang digunakan: group_id, question, weight

INSERT INTO `questions` (`group_id`, `question`, `weight`) VALUES
-- Grup 1: Teknik Industri 2022
(1, 'Seberapa sering Anda mengakses situs atau aplikasi judi online dalam seminggu terakhir? (a) Tidak pernah (b) 1-2 kali (c) 3-5 kali (d) Lebih dari 5 kali', 10),
(1, 'Berapa rata-rata uang yang Anda keluarkan untuk judi online per minggu? (a) Rp 0 (b) Rp 1-100 ribu (c) Rp 100-500 ribu (d) Lebih dari Rp 500 ribu', 10),
(1, 'Apakah Anda pernah berbohong kepada keluarga atau teman tentang aktivitas judi online Anda? (a) Tidak pernah (b) Jarang (c) Kadang-kadang (d) Sering', 10),
(1, 'Apakah Anda merasa sulit untuk berhenti atau mengurangi aktivitas judi online? (a) Tidak (b) Sedikit sulit (c) Cukup sulit (d) Sangat sulit', 10),
(1, 'Apakah judi online mengganggu prestasi akademik Anda? (a) Tidak sama sekali (b) Sedikit mengganggu (c) Cukup mengganggu (d) Sangat mengganggu', 10),
(1, 'Apakah Anda pernah meminjam uang atau berhutang untuk berjudi online? (a) Tidak pernah (b) Pernah 1-2 kali (c) Pernah 3-5 kali (d) Sering (lebih dari 5 kali)', 10),
(1, 'Seberapa sering Anda memikirkan judi online dalam kehidupan sehari-hari? (a) Tidak pernah (b) Jarang (c) Kadang-kadang (d) Sering/Terus-menerus', 10),
(1, 'Apakah Anda pernah melewatkan kelas atau kegiatan kampus karena judi online? (a) Tidak pernah (b) Pernah 1-2 kali (c) Pernah 3-5 kali (d) Sering', 10),
(1, 'Apakah Anda menggunakan judi online sebagai cara untuk mengatasi stress atau masalah? (a) Tidak pernah (b) Jarang (c) Kadang-kadang (d) Sering', 10),
(1, 'Apa yang Anda pahami tentang konsep "house edge" dalam judi online? (a) Keuntungan selalu ada di pihak bandar (b) Pemain dan bandar punya peluang sama (c) Pemain bisa menang konsisten dengan strategi (d) Tidak tahu', 10),

-- Grup 2: Teknik Informatika 2022
(2, 'Apakah Anda memahami cara kerja Random Number Generator (RNG) dalam judi online? (a) Ya, sangat paham (b) Paham sebagian (c) Kurang paham (d) Tidak paham sama sekali', 10),
(2, 'Seberapa sering Anda mengakses platform judi online dalam sebulan terakhir? (a) Tidak pernah (b) 1-5 kali (c) 6-15 kali (d) Lebih dari 15 kali', 10),
(2, 'Apakah Anda tahu bahwa judi online menggunakan algoritma yang dirancang untuk menguntungkan bandar? (a) Ya, saya tahu (b) Pernah dengar tapi tidak yakin (c) Tidak tahu (d) Tidak peduli', 10),
(2, 'Apakah Anda pernah mencoba mencari "celah" atau "bug" dalam sistem judi online? (a) Tidak pernah (b) Pernah terpikir tapi tidak melakukan (c) Pernah mencoba (d) Sering mencoba', 10),
(2, 'Bagaimana Anda menilai keamanan data pribadi Anda saat menggunakan situs judi online? (a) Aman (b) Cukup aman (c) Tidak aman (d) Saya tidak menggunakan situs judi', 10),
(2, 'Apakah Anda memahami bahwa tidak ada "pola" atau "strategi pasti" dalam permainan judi online berbasis RNG? (a) Ya, saya paham (b) Kurang paham (c) Tidak paham (d) Saya percaya ada pola tertentu', 10),
(2, 'Pernahkah Anda kehilangan uang dalam jumlah besar (lebih dari 1 juta) karena judi online? (a) Tidak pernah (b) Pernah sekali (c) Pernah beberapa kali (d) Sering', 10),
(2, 'Apakah aktivitas judi online mempengaruhi waktu belajar atau mengerjakan tugas kuliah Anda? (a) Tidak sama sekali (b) Sedikit (c) Cukup banyak (d) Sangat banyak', 10),
(2, 'Apakah Anda mengetahui konsekuensi hukum dari terlibat dalam judi online di Indonesia? (a) Ya, sangat paham (b) Paham sebagian (c) Kurang paham (d) Tidak tahu', 10),
(2, 'Seberapa sulit bagi Anda untuk tidak membuka situs/aplikasi judi online dalam satu hari? (a) Sangat mudah, tidak tertarik (b) Cukup mudah (c) Agak sulit (d) Sangat sulit', 10),

-- Grup 3: DKV 2022
(3, 'Pernahkah Anda melihat iklan atau promosi judi online di media sosial? (a) Tidak pernah (b) Jarang (c) Sering (d) Sangat sering', 10),
(3, 'Apakah Anda dapat mengidentifikasi taktik persuasif visual dalam iklan judi online? (a) Ya, sangat bisa (b) Bisa sebagian (c) Kurang bisa (d) Tidak bisa', 10),
(3, 'Seberapa tertarik Anda dengan tampilan visual dan user interface platform judi online? (a) Tidak tertarik sama sekali (b) Sedikit tertarik (c) Cukup tertarik (d) Sangat tertarik', 10),
(3, 'Apakah Anda pernah tergoda mencoba judi online karena desain yang menarik? (a) Tidak pernah (b) Pernah terpikir tapi tidak melakukan (c) Pernah mencoba (d) Sering bermain', 10),
(3, 'Bagaimana pendapat Anda tentang etika desainer yang membuat konten promosi judi online? (a) Tidak etis dan merugikan (b) Netral, hanya pekerjaan (c) Boleh saja jika profesional (d) Tidak ada masalah', 10),
(3, 'Apakah Anda memahami psychological design yang digunakan platform judi untuk membuat pemain adiktif? (a) Ya, sangat paham (b) Paham sebagian (c) Kurang paham (d) Tidak paham', 10),
(3, 'Pernahkah Anda diminta membuat desain terkait promosi judi atau gambling? (a) Tidak pernah (b) Pernah ditawari tapi menolak (c) Pernah membuat (d) Sering membuat', 10),
(3, 'Seberapa sering Anda melihat influencer atau content creator mempromosikan judi online? (a) Tidak pernah (b) Jarang (c) Sering (d) Sangat sering', 10),
(3, 'Apakah Anda pernah terpengaruh untuk mencoba judi online karena konten di media sosial? (a) Tidak pernah (b) Pernah terpikir (c) Pernah mencoba (d) Ya, dan terus bermain', 10),
(3, 'Bagaimana Anda menilai tanggung jawab desainer grafis dalam mencegah promosi judi online? (a) Sangat bertanggung jawab (b) Cukup bertanggung jawab (c) Kurang bertanggung jawab (d) Tidak ada tanggung jawab', 10),

-- Grup 4: Manajemen Ritel 2022
(4, 'Seberapa baik Anda dalam mengelola keuangan pribadi Anda? (a) Sangat baik (b) Cukup baik (c) Kurang baik (d) Buruk', 10),
(4, 'Apakah Anda memiliki anggaran bulanan yang terstruktur? (a) Ya, selalu (b) Kadang-kadang (c) Jarang (d) Tidak pernah', 10),
(4, 'Pernahkah Anda menganggap judi online sebagai cara untuk mendapatkan penghasilan tambahan? (a) Tidak pernah (b) Pernah terpikir (c) Ya, pernah mencoba (d) Ya, sering melakukan', 10),
(4, 'Apakah Anda dapat membedakan antara investasi dan perjudian? (a) Ya, sangat jelas (b) Cukup paham (c) Kurang jelas (d) Tidak bisa membedakan', 10),
(4, 'Seberapa sering Anda mengalami kesulitan keuangan dalam 6 bulan terakhir? (a) Tidak pernah (b) Jarang (c) Kadang-kadang (d) Sering', 10),
(4, 'Apakah Anda pernah menggunakan uang SPP, uang makan, atau uang kebutuhan untuk judi online? (a) Tidak pernah (b) Pernah 1-2 kali (c) Beberapa kali (d) Sering', 10),
(4, 'Bagaimana Anda menilai risiko judi online dibandingkan dengan investasi saham atau crypto? (a) Judi jauh lebih berisiko (b) Sama-sama berisiko (c) Investasi lebih berisiko (d) Tidak tahu', 10),
(4, 'Apakah Anda memahami konsep probabilitas dan expected value dalam konteks judi? (a) Ya, sangat paham (b) Paham sebagian (c) Kurang paham (d) Tidak paham', 10),
(4, 'Seberapa baik literasi keuangan Anda tentang bahaya judi online? (a) Sangat baik (b) Cukup baik (c) Kurang baik (d) Buruk', 10),
(4, 'Apakah Anda pernah mengikuti seminar atau workshop tentang financial literacy? (a) Ya, sering (b) Pernah 1-2 kali (c) Belum pernah tapi tertarik (d) Tidak tertarik', 10);

-- ============================================
-- CATATAN PENTING:
-- ============================================
-- 1. Setelah menjalankan query ini, cek ID yang ter-generate untuk assessment_groups
-- 2. Sesuaikan group_id pada tabel questions dengan ID yang sebenarnya
-- 3. Untuk setiap grup assessment, tambahkan minimal 15-30 soal untuk hasil yang akurat
-- 4. Variasikan tipe soal: knowledge, attitude, behavior, dan situational
-- 5. Sesuaikan bobot point berdasarkan tingkat kesulitan dan urgensi pertanyaan

-- Query untuk melihat hasil:
-- SELECT * FROM education_content;
-- SELECT * FROM rng_games WHERE is_active = 1;
-- SELECT * FROM assessment_groups;
-- SELECT ag.title, COUNT(q.id) as total_soal FROM assessment_groups ag LEFT JOIN questions q ON ag.id = q.group_id GROUP BY ag.id;
