<div class="container-fluid py-4">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-md-12">
            <h2 class="fw-bold text-primary">
                <i class="fas fa-history"></i> History Simulasi User
            </h2>
            <p class="text-muted">Analisis lengkap aktivitas dan performa user dalam simulasi RNG</p>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1 small">Total User</p>
                            <h3 class="mb-0 fw-bold text-primary"><?= number_format($data['statistics']['total_users']) ?></h3>
                        </div>
                        <div class="bg-primary bg-opacity-10 p-3 rounded">
                            <i class="fas fa-users fa-2x text-primary"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1 small">Total Sesi</p>
                            <h3 class="mb-0 fw-bold text-info"><?= number_format($data['statistics']['total_sessions']) ?></h3>
                        </div>
                        <div class="bg-info bg-opacity-10 p-3 rounded">
                            <i class="fas fa-gamepad fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1 small">Total Putaran</p>
                            <h3 class="mb-0 fw-bold text-warning"><?= number_format($data['statistics']['total_rounds']) ?></h3>
                        </div>
                        <div class="bg-warning bg-opacity-10 p-3 rounded">
                            <i class="fas fa-sync-alt fa-2x text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted mb-1 small">Total Loss</p>
                            <h3 class="mb-0 fw-bold text-danger">Rp <?= number_format($data['statistics']['total_loss']) ?></h3>
                        </div>
                        <div class="bg-danger bg-opacity-10 p-3 rounded">
                            <i class="fas fa-chart-line fa-2x text-danger"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Win/Loss Ratio -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-chart-pie"></i> Win/Loss Ratio</h5>
                </div>
                <div class="card-body">
                    <?php
                    $total_sessions = $data['statistics']['total_sessions'];
                    $win_pct = $total_sessions > 0 ? ($data['statistics']['win_sessions'] / $total_sessions * 100) : 0;
                    $loss_pct = 100 - $win_pct;
                    ?>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="text-success fw-bold">Win Sessions: <?= $data['statistics']['win_sessions'] ?></span>
                            <span class="text-success fw-bold"><?= number_format($win_pct, 1) ?>%</span>
                        </div>
                        <div class="progress" style="height: 25px;">
                            <div class="progress-bar bg-success" style="width: <?= $win_pct ?>%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="d-flex justify-content-between mb-1">
                            <span class="text-danger fw-bold">Loss Sessions: <?= $data['statistics']['loss_sessions'] ?></span>
                            <span class="text-danger fw-bold"><?= number_format($loss_pct, 1) ?>%</span>
                        </div>
                        <div class="progress" style="height: 25px;">
                            <div class="progress-bar bg-danger" style="width: <?= $loss_pct ?>%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-calculator"></i> Rata-rata per Sesi</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <p class="text-muted mb-1">Avg Loss/Sesi:</p>
                            <h4 class="fw-bold text-danger">Rp <?= number_format($data['statistics']['avg_loss_per_session']) ?></h4>
                        </div>
                        <div class="col-6">
                            <p class="text-muted mb-1">Avg Rounds/Sesi:</p>
                            <h4 class="fw-bold text-info"><?= number_format($data['statistics']['total_rounds'] / max($data['statistics']['total_sessions'], 1), 1) ?></h4>
                        </div>
                    </div>
                    <hr>
                    <div class="alert alert-warning mb-0">
                        <small><i class="fas fa-info-circle"></i> <strong>Insight:</strong>
                            <?php if ($win_pct < 20): ?>
                                Hanya <?= number_format($win_pct, 1) ?>% sesi yang profit - house edge bekerja sangat efektif!
                            <?php else: ?>
                                <?= number_format($loss_pct, 1) ?>% sesi berakhir dengan loss - membuktikan house edge konsisten.
                            <?php endif; ?>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- History Table -->
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-table"></i> Detail History Simulasi</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th>Tanggal</th>
                                    <th>User</th>
                                    <th>Game</th>
                                    <th>Type</th>
                                    <th>RTP</th>
                                    <th class="text-center">Putaran</th>
                                    <th class="text-end">Modal Awal</th>
                                    <th class="text-end">Saldo Akhir</th>
                                    <th class="text-end">Profit/Loss</th>
                                    <th class="text-center">Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($data['history'])): ?>
                                    <tr>
                                        <td colspan="11" class="text-center py-4">
                                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                            <p class="text-muted">Belum ada history simulasi</p>
                                        </td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach ($data['history'] as $row): ?>
                                        <?php
                                        $profit_loss = $row['final_balance'] - $row['initial_balance'];
                                        $is_win = $profit_loss > 0;
                                        $pct_change = ($profit_loss / $row['initial_balance']) * 100;
                                        ?>
                                        <tr>
                                            <td>
                                                <small class="text-muted">
                                                    <?= date('d M Y', strtotime($row['created_at'])) ?><br>
                                                    <?= date('H:i', strtotime($row['created_at'])) ?>
                                                </small>
                                            </td>
                                            <td>
                                                <strong><?= htmlspecialchars($row['name']) ?></strong><br>
                                                <small class="text-muted"><?= htmlspecialchars($row['email']) ?></small>
                                            </td>
                                            <td><?= htmlspecialchars($row['game_name'] ?: '-') ?></td>
                                            <td>
                                                <?php if ($row['game_type']): ?>
                                                    <span class="badge bg-secondary"><?= htmlspecialchars($row['game_type']) ?></span>
                                                <?php else: ?>
                                                    <span class="text-muted">-</span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?= $row['rtp'] ? $row['rtp'] . '%' : '-' ?></td>
                                            <td class="text-center">
                                                <span class="badge bg-info"><?= $row['total_round'] ?>x</span>
                                            </td>
                                            <td class="text-end">Rp <?= number_format($row['initial_balance']) ?></td>
                                            <td class="text-end">
                                                <strong class="<?= $is_win ? 'text-success' : 'text-danger' ?>">
                                                    Rp <?= number_format($row['final_balance']) ?>
                                                </strong>
                                            </td>
                                            <td class="text-end">
                                                <strong class="<?= $is_win ? 'text-success' : 'text-danger' ?>">
                                                    <?= $is_win ? '+' : '' ?>Rp <?= number_format($profit_loss) ?><br>
                                                    <small>(<?= $is_win ? '+' : '' ?><?= number_format($pct_change, 1) ?>%)</small>
                                                </strong>
                                            </td>
                                            <td class="text-center">
                                                <?php if ($is_win): ?>
                                                    <span class="badge bg-success"><i class="fas fa-arrow-up"></i> WIN</span>
                                                <?php else: ?>
                                                    <span class="badge bg-danger"><i class="fas fa-arrow-down"></i> LOSS</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <a href="/sigma/simulator/user-history/<?= $row['user_id'] ?>"
                                                    class="btn btn-sm btn-outline-primary"
                                                    title="Lihat semua history user ini">
                                                    <i class="fas fa-user-chart"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Pagination -->
                <?php if ($data['total_pages'] > 1): ?>
                    <div class="card-footer bg-white">
                        <nav>
                            <ul class="pagination justify-content-center mb-0">
                                <li class="page-item <?= $data['current_page'] <= 1 ? 'disabled' : '' ?>">
                                    <a class="page-link" href="?page=<?= $data['current_page'] - 1 ?>">Previous</a>
                                </li>

                                <?php for ($i = 1; $i <= $data['total_pages']; $i++): ?>
                                    <li class="page-item <?= $i == $data['current_page'] ? 'active' : '' ?>">
                                        <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                                    </li>
                                <?php endfor; ?>

                                <li class="page-item <?= $data['current_page'] >= $data['total_pages'] ? 'disabled' : '' ?>">
                                    <a class="page-link" href="?page=<?= $data['current_page'] + 1 ?>">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>