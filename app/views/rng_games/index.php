<div class="container-fluid py-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-primary mb-0"><i class="fas fa-dice"></i> Kelola Game RNG</h2>
            <p class="text-muted">Atur game judi online yang tersedia untuk simulasi edukasi</p>
        </div>
        <a href="/sigma/rng-games/create" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Game Baru
        </a>
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

    <!-- Game Cards -->
    <div class="row">
        <?php if (empty($data['games'])): ?>
            <div class="col-12">
                <div class="alert alert-info">
                    <i class="fas fa-info-circle"></i> Belum ada game RNG. Silakan tambahkan game baru.
                </div>
            </div>
        <?php else: ?>
            <?php foreach ($data['games'] as $game): ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card shadow-sm h-100 border-0">
                        <div class="card-header bg-gradient-primary text-white d-flex justify-content-between align-items-center">
                            <h5 class="mb-0"><?= htmlspecialchars($game['name']) ?></h5>
                            <span class="badge <?= $game['is_active'] ? 'bg-success' : 'bg-secondary' ?>">
                                <?= $game['is_active'] ? 'Aktif' : 'Nonaktif' ?>
                            </span>
                        </div>
                        <div class="card-body">
                            <p class="text-muted small mb-3"><?= htmlspecialchars($game['description']) ?></p>

                            <div class="mb-3">
                                <span class="badge bg-info text-dark mb-2">
                                    <i class="fas fa-gamepad"></i> <?= htmlspecialchars($game['game_type']) ?>
                                </span>
                            </div>

                            <div class="small mb-2">
                                <strong>Simbol:</strong> <span class="fs-5"><?= htmlspecialchars($game['symbols']) ?></span>
                            </div>

                            <ul class="list-unstyled small mb-3">
                                <li><strong>RTP:</strong> <?= $game['rtp'] ?>%</li>
                                <li><strong>Biaya Taruhan:</strong> Rp <?= number_format($game['bet_cost'], 0, ',', '.') ?></li>
                                <li><strong>Max Payout:</strong> Rp <?= number_format($game['max_payout'], 0, ',', '.') ?></li>
                            </ul>

                            <div class="text-muted small">
                                <i class="far fa-calendar"></i>
                                <?= date('d M Y', strtotime($game['created_at'])) ?>
                            </div>
                        </div>
                        <div class="card-footer bg-white border-0 d-flex gap-2">
                            <a href="/sigma/rng-games/edit/<?= $game['id'] ?>" class="btn btn-sm btn-warning flex-fill">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="/sigma/rng-games/toggle/<?= $game['id'] ?>"
                                class="btn btn-sm btn-<?= $game['is_active'] ? 'secondary' : 'success' ?> flex-fill"
                                onclick="return confirm('Ubah status game ini?')">
                                <i class="fas fa-power-off"></i> <?= $game['is_active'] ? 'Nonaktifkan' : 'Aktifkan' ?>
                            </a>
                            <a href="/sigma/rng-games/delete/<?= $game['id'] ?>"
                                class="btn btn-sm btn-danger"
                                onclick="return confirm('Yakin ingin menghapus game ini?')">
                                <i class="fas fa-trash"></i>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<style>
    .bg-gradient-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }
</style>