<div class="container-fluid py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-md-12 text-center">
            <h2 class="fw-bold text-primary">
                <i class="fas fa-gamepad"></i> Simulator RNG (Random Number Generator)
            </h2>
            <p class="text-muted mb-0">
                Pilih game judi online untuk membuktikan bahwa dalam jangka panjang,
                <strong>Bandar Selalu Menang</strong>.
            </p>
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

    <!-- Game Selection Cards -->
    <?php if (!empty($data['games'])): ?>
        <div class="row g-4">
            <?php foreach ($data['games'] as $game): ?>
                <div class="col-md-4 col-lg-3">
                    <div class="card game-card h-100 border-0 shadow-sm">
                        <div class="card-body text-center p-4">
                            <!-- Game Icon/Symbol -->
                            <div class="game-icon mb-3">
                                <span style="font-size: 4rem;">
                                    <?= explode(',', $game['symbols'])[0] ?>
                                </span>
                            </div>

                            <!-- Game Title -->
                            <h5 class="fw-bold mb-2"><?= htmlspecialchars($game['name']) ?></h5>

                            <!-- Game Type Badge -->
                            <span class="badge bg-info text-dark mb-3">
                                <?= htmlspecialchars($game['game_type']) ?>
                            </span>

                            <!-- Game Stats -->
                            <div class="game-stats mb-3">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <small class="text-muted">RTP:</small>
                                    <span class="badge bg-warning text-dark"><?= $game['rtp'] ?>%</span>
                                </div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <small class="text-muted">Taruhan:</small>
                                    <strong class="text-primary">Rp <?= number_format($game['bet_cost'], 0, ',', '.') ?></strong>
                                </div>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">Max Win:</small>
                                    <strong class="text-success">Rp <?= number_format($game['max_payout'], 0, ',', '.') ?></strong>
                                </div>
                            </div>

                            <!-- Description Preview -->
                            <p class="text-muted small mb-3" style="height: 60px; overflow: hidden;">
                                <?= htmlspecialchars(substr($game['description'], 0, 100)) ?>...
                            </p>

                            <!-- Play Button -->
                            <a href="/sigma/simulator/play/<?= $game['id'] ?>"
                                class="btn btn-primary btn-lg w-100">
                                <i class="fas fa-play"></i> Main Sekarang
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Info Box -->
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="alert alert-warning border-0 shadow-sm">
                    <div class="d-flex align-items-start">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-triangle fa-2x text-warning"></i>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h5 class="fw-bold mb-2">⚠️ Peringatan Edukasi</h5>
                            <p class="mb-2">
                                Simulator ini dirancang untuk menunjukkan bahwa <strong>semua game judi online menggunakan
                                    algoritma RNG (Random Number Generator) yang menguntungkan bandar</strong>, bukan pemain.
                            </p>
                            <ul class="mb-0">
                                <li>RTP (Return to Player) adalah persentase teoretis yang dikembalikan dalam JANGKA PANJANG</li>
                                <li>Kemenangan sesekali adalah "umpan" agar Anda terus bermain</li>
                                <li>Dalam 100 putaran atau lebih, saldo Anda akan terus menurun</li>
                                <li>Testimoni "maxwin" di media sosial seringkali PALSU atau hasil editan</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php else: ?>
        <!-- Empty State -->
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body text-center py-5">
                        <i class="fas fa-ghost fa-5x text-muted mb-4"></i>
                        <h4 class="fw-bold mb-3">Tidak Ada Game Tersedia</h4>
                        <p class="text-muted">
                            Saat ini belum ada game RNG yang aktif. Silakan hubungi admin untuk informasi lebih lanjut.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>

<style>
    .game-card {
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .game-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2) !important;
    }

    .game-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .game-card:hover::before {
        left: 100%;
    }

    .game-icon {
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-10px);
        }
    }

    .game-stats {
        background: #f8f9fa;
        padding: 15px;
        border-radius: 10px;
    }
</style>