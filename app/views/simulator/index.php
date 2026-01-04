<div class="container-fluid py-3">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="header-box">
                <div class="header-content">
                    <div class="header-icon">
                        <i class="fas fa-gamepad"></i>
                    </div>
                    <div class="header-text">
                        <h1 class="title">Simulator RNG</h1>
                        <p class="subtitle">Pilih game untuk membuktikan bahwa <span class="highlight">Bandar Selalu Menang</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Alert Messages -->
    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-<?= $_SESSION['message_type'] ?> alert-dismissible fade show" role="alert">
            <?= $_SESSION['message'] ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php
        unset($_SESSION['message']);
        unset($_SESSION['message_type']);
        ?>
    <?php endif; ?>

    <!-- Warning Box -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="warning-box">
                <div class="warning-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="warning-content">
                    <h5 class="warning-title">Peringatan Edukasi</h5>
                    <p class="warning-text">
                        Simulator ini dirancang untuk menunjukkan bahwa <strong>semua game judi online menggunakan
                            algoritma RNG (Random Number Generator) yang menguntungkan bandar</strong>, bukan pemain.
                    </p>
                    <ul class="warning-list">
                        <li>RTP (Return to Player) adalah persentase teoretis yang dikembalikan dalam JANGKA PANJANG</li>
                        <li>Kemenangan sesekali adalah "umpan" agar Anda terus bermain</li>
                        <li>Dalam 100 putaran atau lebih, saldo Anda akan terus menurun</li>
                        <li>Testimoni "maxwin" di media sosial seringkali PALSU atau hasil editan</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Game Selection Cards -->
    <?php if (!empty($data['games'])): ?>
        <div class="row g-4 mb-5">
            <?php foreach ($data['games'] as $game): ?>
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="game-card">
                        <div class="game-card-header">
                            <div class="game-icon">
                                <?= explode(',', $game['symbols'])[0] ?>
                            </div>
                            <span class="game-type-badge">
                                <?= htmlspecialchars($game['game_type']) ?>
                            </span>
                        </div>

                        <div class="game-card-body">
                            <h5 class="game-title"><?= htmlspecialchars($game['name']) ?></h5>

                            <p class="game-description">
                                <?= htmlspecialchars(substr($game['description'], 0, 80)) ?>...
                            </p>

                            <div class="game-stats">
                                <div class="stat-item">
                                    <span class="stat-label">RTP</span>
                                    <span class="stat-value rtp"><?= $game['rtp'] ?>%</span>
                                </div>
                                <div class="stat-divider"></div>
                                <div class="stat-item">
                                    <span class="stat-label">Taruhan</span>
                                    <span class="stat-value">Rp <?= number_format($game['bet_cost'], 0, ',', '.') ?></span>
                                </div>
                                <div class="stat-divider"></div>
                                <div class="stat-item">
                                    <span class="stat-label">Max Win</span>
                                    <span class="stat-value win">Rp <?= number_format($game['max_payout'], 0, ',', '.') ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="game-card-footer">
                            <a href="/sigma/simulator/play/<?= $game['id'] ?>" class="play-btn">
                                <i class="fas fa-play"></i>
                                <span>Main Sekarang</span>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    <?php else: ?>
        <!-- Empty State -->
        <div class="row">
            <div class="col-12">
                <div class="empty-state">
                    <i class="fas fa-ghost"></i>
                    <h4>Tidak Ada Game Tersedia</h4>
                    <p>Saat ini belum ada game RNG yang aktif. Silakan hubungi admin untuk informasi lebih lanjut.</p>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<!-- Simulator Page Styles -->
<link rel="stylesheet" href="/sigma/public/css/simulator.css">