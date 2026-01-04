<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1 text-dark">
                <i class="fas fa-dice text-sigma me-2"></i>Kelola Game RNG
            </h2>
            <p class="text-muted mb-0">Atur parameter algoritma dan probabilitas game edukasi.</p>
        </div>
        <a href="/sigma/rng-games/create" class="btn btn-sigma shadow-sm">
            <i class="fas fa-plus me-1"></i> Tambah Game
        </a>
    </div>

    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-<?= $_SESSION['message_type'] ?> border-0 shadow-sm alert-dismissible fade show mb-4" role="alert">
            <div class="d-flex align-items-center">
                <i class="fas fa-info-circle me-2"></i>
                <div><?= $_SESSION['message'] ?></div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php
        unset($_SESSION['message']);
        unset($_SESSION['message_type']);
        ?>
    <?php endif; ?>

    <div class="row g-4">
        <?php if (empty($data['games'])): ?>
            <div class="col-12">
                <div class="text-center py-5 bg-white rounded shadow-sm border border-light">
                    <img src="https://cdn-icons-png.flaticon.com/512/4076/4076549.png" alt="Empty" style="width: 80px; opacity: 0.5" class="mb-3">
                    <h5 class="text-muted">Belum ada game tersedia</h5>
                    <p class="text-secondary mb-3">Silakan tambahkan game simulasi baru untuk memulai.</p>
                    <a href="/sigma/rng-games/create" class="btn btn-sm btn-outline-sigma">
                        Tambah Game Baru
                    </a>
                </div>
            </div>
        <?php else: ?>
            <?php foreach ($data['games'] as $game): ?>
                <div class="col-md-6 col-xl-4">
                    <div class="card h-100 border-0 shadow-sm card-hover-effect">
                        <div class="card-body p-4 position-relative">
                            <div class="position-absolute top-0 end-0 mt-4 me-4">
                                <?php if ($game['is_active']): ?>
                                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3">
                                        <i class="fas fa-check-circle me-1"></i> Aktif
                                    </span>
                                <?php else: ?>
                                    <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle rounded-pill px-3">
                                        <i class="fas fa-pause-circle me-1"></i> Nonaktif
                                    </span>
                                <?php endif; ?>
                            </div>

                            <div class="mb-3 pe-5">
                                <div class="text-uppercase text-muted fw-bold small mb-1 tracking-wide">
                                    <?= htmlspecialchars($game['game_type']) ?>
                                </div>
                                <h5 class="fw-bold text-dark mb-0 text-truncate" title="<?= htmlspecialchars($game['name']) ?>">
                                    <?= htmlspecialchars($game['name']) ?>
                                </h5>
                            </div>

                            <p class="text-muted small mb-4 line-clamp-2" style="min-height: 40px;">
                                <?= htmlspecialchars($game['description']) ?>
                            </p>

                            <div class="mb-4">
                                <label class="small fw-bold text-secondary d-block mb-1">Simbol Game</label>
                                <div class="bg-light rounded p-2 text-center fs-5 border border-light">
                                    <?= htmlspecialchars($game['symbols']) ?>
                                </div>
                            </div>

                            <div class="row g-2 mb-4">
                                <div class="col-4">
                                    <div class="p-2 border rounded text-center bg-white h-100">
                                        <div class="small text-muted mb-1" style="font-size: 10px;">RTP</div>
                                        <div class="fw-bold text-sigma"><?= $game['rtp'] ?>%</div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="p-2 border rounded text-center bg-white h-100">
                                        <div class="small text-muted mb-1" style="font-size: 10px;">BET</div>
                                        <div class="fw-bold text-dark small">IDR <?= number_format($game['bet_cost'] / 1000, 0) ?>k</div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="p-2 border rounded text-center bg-white h-100">
                                        <div class="small text-muted mb-1" style="font-size: 10px;">MAX WIN</div>
                                        <div class="fw-bold text-dark small">IDR <?= number_format($game['max_payout'] / 1000, 0) ?>k</div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex gap-2 pt-3 border-top">
                                <a href="/sigma/rng-games/edit/<?= $game['id'] ?>" class="btn btn-sm btn-outline-secondary flex-fill">
                                    <i class="fas fa-pencil-alt"></i> Edit
                                </a>
                                <a href="/sigma/rng-games/toggle/<?= $game['id'] ?>"
                                    class="btn btn-sm btn-outline-<?= $game['is_active'] ? 'warning' : 'success' ?> flex-fill"
                                    onclick="return confirm('Ubah status game ini?')">
                                    <i class="fas fa-power-off"></i> <?= $game['is_active'] ? 'Off' : 'On' ?>
                                </a>
                                <a href="/sigma/rng-games/delete/<?= $game['id'] ?>"
                                    class="btn btn-sm btn-outline-danger px-3"
                                    onclick="return confirm('Yakin ingin menghapus game ini?')"
                                    data-bs-toggle="tooltip" title="Hapus Game">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </div>
                        </div>
                        <div class="position-absolute start-0 top-0 bottom-0 bg-sigma rounded-start" style="width: 4px;"></div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<link rel="stylesheet" href="/sigma/public/css/games.css">