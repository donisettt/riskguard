<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($education['title']) ?> - SIGMA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="/sigma/public/css/landing.css">
    <style>
        .education-detail-section {
            padding: 120px 0 60px;
            background-color: #009d63;
            position: relative;
        }

        .education-detail-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.02);
        }

        .education-header {
            color: white;
            position: relative;
            z-index: 1;
        }

        .education-header h1 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 16px;
            line-height: 1.3;
        }

        .education-meta {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 20px;
            font-size: 0.95rem;
            opacity: 0.95;
        }

        .education-meta i {
            margin-right: 6px;
        }

        .education-content-wrapper {
            background: white;
            border-radius: 16px;
            padding: 40px;
            margin-top: -20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            position: relative;
            z-index: 2;
        }

        .education-banner {
            width: 100%;
            height: 350px;
            object-fit: cover;
            border-radius: 12px;
            margin-bottom: 32px;
        }

        .education-content {
            font-size: 1.05rem;
            line-height: 1.75;
            color: #0f172a;
        }

        .education-content h2 {
            font-size: 1.75rem;
            font-weight: 700;
            margin-top: 36px;
            margin-bottom: 16px;
            color: #0f172a;
        }

        .education-content h3 {
            font-size: 1.4rem;
            font-weight: 600;
            margin-top: 28px;
            margin-bottom: 12px;
            color: #475569;
        }

        .education-content p {
            margin-bottom: 16px;
            color: #475569;
        }

        .education-content ul,
        .education-content ol {
            margin-bottom: 20px;
            padding-left: 28px;
        }

        .education-content li {
            margin-bottom: 8px;
            color: #475569;
        }

        .education-content img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            margin: 24px 0;
        }

        .education-content blockquote {
            border-left: 4px solid #009d63;
            background-color: #f8fafc;
            padding: 16px 20px;
            margin: 24px 0;
            font-style: italic;
            color: #475569;
            border-radius: 4px;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 24px;
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s;
            margin-bottom: 24px;
            font-size: 0.95rem;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .back-button:hover {
            background: rgba(255, 255, 255, 0.3);
            color: white;
            transform: translateX(-4px);
        }

        .cta-box {
            background-color: #009d63;
            border-radius: 12px;
            padding: 36px;
            text-align: center;
            color: white;
            margin-top: 48px;
            border: 2px solid #00b574;
        }

        .cta-box h3 {
            font-size: 1.6rem;
            font-weight: 700;
            margin-bottom: 12px;
            color: white;
        }

        .cta-box p {
            font-size: 1.05rem;
            margin-bottom: 24px;
            opacity: 0.95;
            color: white;
        }

        .cta-box .btn {
            padding: 12px 32px;
            font-size: 1rem;
            font-weight: 600;
        }

        .cta-box .btn-light {
            background: white;
            color: #009d63;
            border: none;
        }

        .cta-box .btn-light:hover {
            background: #f8fafc;
            color: #007a4d;
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .education-detail-section {
                padding: 100px 0 40px;
            }

            .education-header h1 {
                font-size: 1.75rem;
            }

            .education-content-wrapper {
                padding: 32px;
            }

            .education-banner {
                height: 280px;
            }
        }

        @media (max-width: 768px) {
            .education-detail-section {
                padding: 90px 0 30px;
            }

            .education-header h1 {
                font-size: 1.5rem;
                margin-bottom: 12px;
            }

            .education-meta {
                gap: 12px;
                font-size: 0.875rem;
            }

            .education-content-wrapper {
                padding: 24px;
                border-radius: 12px;
            }

            .education-banner {
                height: 220px;
                border-radius: 8px;
                margin-bottom: 24px;
            }

            .education-content {
                font-size: 1rem;
            }

            .education-content h2 {
                font-size: 1.5rem;
                margin-top: 28px;
            }

            .education-content h3 {
                font-size: 1.25rem;
                margin-top: 20px;
            }

            .back-button {
                padding: 8px 20px;
                font-size: 0.9rem;
            }

            .cta-box {
                padding: 28px 20px;
                margin-top: 36px;
            }

            .cta-box h3 {
                font-size: 1.35rem;
            }

            .cta-box p {
                font-size: 0.95rem;
            }

            .cta-box .btn {
                padding: 10px 24px;
                font-size: 0.95rem;
                width: 100%;
            }
        }

        @media (max-width: 576px) {
            .education-content-wrapper {
                padding: 20px;
            }

            .education-header h1 {
                font-size: 1.35rem;
            }

            .education-meta {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }
        }
    </style>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg fixed-top scrolled">
        <div class="container">
            <a class="navbar-brand" href="/sigma/">
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
                        <a class="nav-link" href="/sigma/#home">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/sigma/#features">Fitur</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/sigma/#education">Edukasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/sigma/#assessments">Assessment</a>
                    </li>
                    <li class="nav-item ms-lg-3">
                        <a href="/sigma/auth/register" class="btn btn-cta">Daftar Sekarang</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Education Detail Section -->
    <section class="education-detail-section">
        <div class="container">
            <div class="education-header">
                <a href="/sigma/#education" class="back-button">
                    <i class="fas fa-arrow-left"></i>
                    Kembali ke Halaman Utama
                </a>
                <h1><?= htmlspecialchars($education['title']) ?></h1>
                <div class="education-meta">
                    <span>
                        <i class="fas fa-calendar"></i>
                        <?= date('d F Y', strtotime($education['created_at'])) ?>
                    </span>
                    <span>
                        <i class="fas fa-book-open"></i>
                        Materi Edukasi
                    </span>
                </div>
            </div>
        </div>
    </section>

    <!-- Content Section -->
    <section style="padding: 0 0 80px;">
        <div class="container">
            <div class="education-content-wrapper">
                <?php if (!empty($education['banner'])): ?>
                    <img src="<?= htmlspecialchars($education['banner']) ?>" alt="<?= htmlspecialchars($education['title']) ?>" class="education-banner">
                <?php endif; ?>

                <div class="education-content">
                    <?= $education['content'] ?>
                </div>

                <!-- CTA Box -->
                <div class="cta-box">
                    <h3>Ingin Tahu Tingkat Risiko Anda?</h3>
                    <p>Daftar sekarang dan lakukan assessment risiko kecanduan judi online dengan sistem terpercaya</p>
                    <a href="/sigma/auth/register" class="btn btn-light btn-lg">
                        <i class="fas fa-user-plus me-2"></i>
                        Daftar dan Mulai Assessment
                    </a>
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
                        <li><a href="/sigma/#features">Fitur</a></li>
                        <li><a href="/sigma/#education">Edukasi</a></li>
                        <li><a href="/sigma/#assessments">Assessment</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-6">
                    <h5 class="footer-title">Akun</h5>
                    <ul class="footer-links">
                        <li><a href="/sigma/auth/login">Masuk</a></li>
                        <li><a href="/sigma/auth/register">Daftar</a></li>
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