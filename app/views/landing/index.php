<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGMA - Sistem Monitoring Risiko Judi Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/sigma/public/css/landing.css">
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <div class="brand-icon">
                    <i class="fas fa-brain"></i>
                </div>
                <span class="brand-text">SIGMA</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item">
                        <a class="nav-link active" href="#home">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#features">Fitur</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#education">Edukasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#assessments">Assessment</a>
                    </li>
                    <li class="nav-item ms-lg-3">
                        <a href="auth/register" class="btn btn-cta">Daftar Sekarang</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero-section">
        <div class="hero-background"></div>
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <div class="hero-content">
                        <div class="hero-badge">
                            <i class="fas fa-shield-alt"></i>
                            <span>Sistem Monitoring Risiko Terpercaya</span>
                        </div>
                        <h1 class="hero-title">
                            Analisis Risiko Kecanduan Judi Online dengan
                            <span class="text-primary">SIGMA</span>
                        </h1>
                        <p class="hero-description">
                            Sistem berbasis web untuk menganalisis dan memantau risiko perilaku kecanduan judi online.
                            Lakukan assessment risiko, akses materi edukasi pencegahan, dan dapatkan laporan analisis yang komprehensif.
                        </p>
                        <div class="hero-actions">
                            <a href="auth/register" class="btn btn-primary btn-lg">
                                <i class="fas fa-rocket me-2"></i>
                                Mulai Sekarang
                            </a>
                            <a href="#features" class="btn btn-outline-secondary btn-lg">
                                <i class="fas fa-arrow-down me-2"></i>
                                Pelajari Lebih Lanjut
                            </a>
                        </div>
                        <div class="hero-stats">
                            <div class="stat-item">
                                <div class="stat-number"><?= $totalEducations ?>+</div>
                                <div class="stat-label">Materi Edukasi</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number"><?= $totalAssessments ?>+</div>
                                <div class="stat-label">Assessment</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number">100%</div>
                                <div class="stat-label">Akurat</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-image">
                        <div class="hero-image-wrapper">
                            <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=800&h=600&fit=crop" alt="Learning">
                            <div class="floating-card card-1">
                                <i class="fas fa-check-circle"></i>
                                <span>Assessment Selesai</span>
                            </div>
                            <div class="floating-card card-2">
                                <i class="fas fa-chart-bar"></i>
                                <span>Analisis Lengkap</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="features-section">
        <div class="container">
            <div class="section-header">
                <div class="section-badge">
                    <i class="fas fa-sparkles"></i>
                    <span>Fitur Unggulan</span>
                </div>
                <h2 class="section-title">Mengapa Memilih SIGMA?</h2>
                <p class="section-description">
                    Sistem monitoring dan analisis risiko kecanduan judi online yang komprehensif dan terpercaya
                </p>
            </div>

            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <h3 class="feature-title">Materi Edukasi Pencegahan</h3>
                        <p class="feature-description">
                            Akses berbagai materi edukasi tentang bahaya judi online,
                            pencegahan kecanduan, dan cara mengenali tanda-tanda risiko.
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-clipboard-check"></i>
                        </div>
                        <h3 class="feature-title">Assessment Risiko</h3>
                        <p class="feature-description">
                            Lakukan assessment untuk mengidentifikasi tingkat risiko
                            kecanduan judi online dengan metode tervalidasi.
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h3 class="feature-title">Analisis Data Komprehensif</h3>
                        <p class="feature-description">
                            Dapatkan analisis mendalam tentang tingkat risiko dengan
                            visualisasi data dan rekomendasi tindakan yang jelas.
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-gamepad"></i>
                        </div>
                        <h3 class="feature-title">Simulator Perilaku</h3>
                        <p class="feature-description">
                            Simulator untuk memahami pola perilaku judi dan
                            RNG game edukatif tentang probabilitas.
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h3 class="feature-title">Monitoring Responden</h3>
                        <p class="feature-description">
                            Sistem monitoring untuk psikolog dalam memantau
                            perkembangan dan kondisi responden secara berkala.
                        </p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-file-pdf"></i>
                        </div>
                        <h3 class="feature-title">Laporan Komprehensif</h3>
                        <p class="feature-description">
                            Export laporan hasil assessment dan analisis risiko dalam
                            format PDF untuk dokumentasi dan monitoring.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Education Section -->
    <section id="education" class="education-section">
        <div class="container">
            <div class="section-header">
                <div class="section-badge">
                    <i class="fas fa-book-open"></i>
                    <span>Materi Edukasi</span>
                </div>
                <h2 class="section-title">Materi Edukasi & Pencegahan</h2>
                <p class="section-description">
                    Berbagai materi tentang bahaya judi online, pencegahan kecanduan, dan penanganan
                </p>
            </div>

            <div class="row g-4">
                <?php if (!empty($featuredEducations)): ?>
                    <?php foreach ($featuredEducations as $education): ?>
                        <div class="col-lg-4 col-md-6">
                            <a href="/sigma/index.php?url=education/<?= $education['id'] ?>" class="text-decoration-none">
                                <div class="education-card">
                                    <div class="education-image">
                                        <?php if (!empty($education['banner'])): ?>
                                            <img src="<?= htmlspecialchars($education['banner']) ?>" alt="<?= htmlspecialchars($education['title']) ?>">
                                        <?php else: ?>
                                            <img src="https://images.unsplash.com/photo-1516321318423-f06f85e504b3?w=600&h=400&fit=crop" alt="Education">
                                        <?php endif; ?>
                                        <div class="education-overlay">
                                            <span class="badge bg-primary">
                                                <i class="fas fa-book me-1"></i>
                                                Materi Edukasi
                                            </span>
                                        </div>
                                    </div>
                                    <div class="education-content">
                                        <h3 class="education-title">
                                            <?= htmlspecialchars($education['title']) ?>
                                        </h3>
                                        <p class="education-excerpt">
                                            <?= htmlspecialchars(substr(strip_tags($education['content']), 0, 120)) ?>...
                                        </p>
                                        <div class="education-meta">
                                            <span class="meta-item">
                                                <i class="fas fa-clock"></i>
                                                <?= date('d M Y', strtotime($education['created_at'])) ?>
                                            </span>
                                        </div>
                                        <div class="mt-3">
                                            <span class="text-primary fw-semibold">
                                                Baca Selengkapnya <i class="fas fa-arrow-right ms-1"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12">
                        <div class="empty-state">
                            <i class="fas fa-book-open"></i>
                            <p>Materi edukasi akan segera hadir</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <?php if ($totalEducations > 3): ?>
                <div class="text-center mt-5">
                    <a href="auth/login" class="btn btn-primary btn-lg">
                        Lihat Semua Materi
                        <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Assessment Section -->
    <section id="assessments" class="assessment-section">
        <div class="container">
            <div class="section-header">
                <div class="section-badge">
                    <i class="fas fa-tasks"></i>
                    <span>Assessment</span>
                </div>
                <h2 class="section-title">Assessment Risiko Tersedia</h2>
                <p class="section-description">
                    Berbagai jenis assessment untuk mengidentifikasi tingkat risiko kecanduan judi online
                </p>
            </div>

            <div class="row g-4">
                <?php if (!empty($featuredAssessments)): ?>
                    <?php foreach ($featuredAssessments as $assessment): ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="assessment-card">
                                <div class="assessment-header">
                                    <div class="assessment-icon">
                                        <i class="fas fa-clipboard-list"></i>
                                    </div>
                                    <span class="assessment-badge">
                                        Assessment
                                    </span>
                                </div>
                                <div class="assessment-body">
                                    <h3 class="assessment-title">
                                        <?= htmlspecialchars($assessment['title']) ?>
                                    </h3>
                                    <p class="assessment-description">
                                        <?= htmlspecialchars($assessment['description']) ?>
                                    </p>
                                    <div class="assessment-stats">
                                        <div class="stat">
                                            <i class="fas fa-question-circle"></i>
                                            <span><?= $assessment['total_questions'] ?? 'N/A' ?> Soal</span>
                                        </div>
                                        <div class="stat">
                                            <i class="fas fa-clock"></i>
                                            <span><?= $assessment['duration'] ?? '30' ?> Menit</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="assessment-footer">
                                    <a href="auth/login" class="btn btn-block btn-primary">
                                        Mulai Assessment
                                        <i class="fas fa-arrow-right ms-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12">
                        <div class="empty-state">
                            <i class="fas fa-clipboard-check"></i>
                            <p>Assessment akan segera tersedia</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <?php if ($totalAssessments > 3): ?>
                <div class="text-center mt-5">
                    <a href="auth/login" class="btn btn-primary btn-lg">
                        Lihat Semua Assessment
                        <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-card">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <h2 class="cta-title">Mulai Identifikasi Risiko Sekarang</h2>
                        <p class="cta-description">
                            Daftar sekarang dan lakukan assessment risiko kecanduan judi online dengan sistem terpercaya
                        </p>
                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <a href="auth/register" class="btn btn-light btn-lg">
                            <i class="fas fa-user-plus me-2"></i>
                            Daftar Gratis
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="footer-brand">
                        <i class="fas fa-brain"></i>
                        <span>SIGMA</span>
                    </div>
                    <p class="footer-description">
                        Sistem analisis dan monitoring risiko perilaku kecanduan judi online
                        untuk identifikasi dan pemantauan responden.
                    </p>
                </div>
                <div class="col-lg-2 col-md-6">
                    <h5 class="footer-title">Platform</h5>
                    <ul class="footer-links">
                        <li><a href="#features">Fitur</a></li>
                        <li><a href="#education">Edukasi</a></li>
                        <li><a href="#assessments">Assessment</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6">
                    <h5 class="footer-title">Akun</h5>
                    <ul class="footer-links">
                        <li><a href="auth/login">Masuk</a></li>
                        <li><a href="auth/register">Daftar</a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h5 class="footer-title">Developer</h5>
                    <ul class="footer-links">
                        <li>
                            <i class="fas fa-envelope me-2"></i>
                            donisetiawanwahyono@gmail.com
                        </li>
                        <li>
                            <i class="fab fa-instagram me-2"></i>
                            @dnisetyaw
                        </li>
                        <li>
                            <i class="fab fa-github me-2"></i>
                            @donisettt
                        </li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <p class="copyright">
                            &copy; <?= date('Y') ?> SIGMA. All rights reserved.
                        </p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <div class="social-links">
                            <a target="_blank" href="https://github.com/donisettt"><i class="fab fa-github"></i></a>
                            <a target="_blank" href="https://instagram.com/dnisetyaw"><i class="fab fa-instagram"></i></a>
                            <a target="_blank" href="https://linkedin.com/in/doni-setiawan-wahyono"><i class="fab fa-linkedin"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <button id="backToTop" class="back-to-top" aria-label="Kembali ke atas">
        <i class="fas fa-arrow-up"></i>
    </button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    // Close mobile menu if open
                    const navbarCollapse = document.querySelector('.navbar-collapse');
                    if (navbarCollapse.classList.contains('show')) {
                        const bsCollapse = new bootstrap.Collapse(navbarCollapse, {
                            toggle: false
                        });
                        bsCollapse.hide();
                    }

                    // Smooth scroll to target
                    const navbarHeight = document.querySelector('.navbar').offsetHeight;
                    const targetPosition = target.offsetTop - navbarHeight;
                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Navbar background on scroll
        let lastScrollTop = 0;
        const navbar = document.querySelector('.navbar');

        window.addEventListener('scroll', function() {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

            if (scrollTop > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }

            lastScrollTop = scrollTop;
        });

        // Active nav link on scroll
        const sections = document.querySelectorAll('section[id]');

        window.addEventListener('scroll', () => {
            const scrollY = window.pageYOffset;

            sections.forEach(section => {
                const sectionHeight = section.offsetHeight;
                const sectionTop = section.offsetTop - 100;
                const sectionId = section.getAttribute('id');

                if (scrollY > sectionTop && scrollY <= sectionTop + sectionHeight) {
                    document.querySelectorAll('.navbar-nav .nav-link').forEach(link => {
                        link.classList.remove('active');
                        if (link.getAttribute('href') === `#${sectionId}`) {
                            link.classList.add('active');
                        }
                    });
                }
            });
        });

        // Back to Top Button
        const backToTopButton = document.getElementById('backToTop');

        window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                backToTopButton.classList.add('show');
            } else {
                backToTopButton.classList.remove('show');
            }
        });

        backToTopButton.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
    </script>
</body>

</html>