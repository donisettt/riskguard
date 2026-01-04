<div class="container-fluid py-4">
    <!-- Back Button -->
    <div class="row mb-3">
        <div class="col-md-12">
            <a href="/sigma/simulator/history" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left"></i> Kembali ke History
            </a>
        </div>
    </div>

    <!-- User Info -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3">
                            <i class="fas fa-user fa-3x text-primary"></i>
                        </div>
                        <div>
                            <h3 class="mb-1 fw-bold"><?= htmlspecialchars($data['user']['name']) ?></h3>
                            <p class="text-muted mb-0">
                                <i class="fas fa-envelope"></i> <?= htmlspecialchars($data['user']['email']) ?> |
                                <i class="fas fa-user-tag"></i> <?= $data['user']['role'] == 'admin' ? 'Administrator' : 'User' ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- User Statistics -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-gamepad fa-2x text-primary mb-2"></i>
                    <h4 class="fw-bold mb-0"><?= number_format($data['statistics']['total_sessions']) ?></h4>
                    <small class="text-muted">Total Sesi</small>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-sync-alt fa-2x text-info mb-2"></i>
                    <h4 class="fw-bold mb-0"><?= number_format($data['statistics']['total_rounds']) ?></h4>
                    <small class="text-muted">Total Putaran</small>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-chart-line fa-2x text-danger mb-2"></i>
                    <h4 class="fw-bold mb-0 text-danger">Rp <?= number_format($data['statistics']['total_loss']) ?></h4>
                    <small class="text-muted">Total Loss</small>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-calculator fa-2x text-warning mb-2"></i>
                    <h4 class="fw-bold mb-0">Rp <?= number_format($data['statistics']['avg_loss']) ?></h4>
                    <small class="text-muted">Avg Loss/Sesi</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Win/Loss Analysis -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-chart-pie"></i> Performance</h5>
                </div>
                <div class="card-body">
                    <?php
                    $win_sessions = $data['statistics']['win_sessions'];
                    $loss_sessions = $data['statistics']['loss_sessions'];
                    $total = $win_sessions + $loss_sessions;
                    $win_rate = $total > 0 ? ($win_sessions / $total * 100) : 0;
                    $loss_rate = 100 - $win_rate;
                    ?>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-success"><i class="fas fa-arrow-up"></i> Win Sessions</span>
                            <strong class="text-success"><?= $win_sessions ?> (<?= number_format($win_rate, 1) ?>%)</strong>
                        </div>
                        <div class="progress mb-3" style="height: 20px;">
                            <div class="progress-bar bg-success" style="width: <?= $win_rate ?>%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-danger"><i class="fas fa-arrow-down"></i> Loss Sessions</span>
                            <strong class="text-danger"><?= $loss_sessions ?> (<?= number_format($loss_rate, 1) ?>%)</strong>
                        </div>
                        <div class="progress" style="height: 20px;">
                            <div class="progress-bar bg-danger" style="width: <?= $loss_rate ?>%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-clock"></i> Timeline</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <p class="text-muted mb-1">Pertama Kali Main:</p>
                        <h6 class="fw-bold"><?= date('d F Y, H:i', strtotime($data['statistics']['first_play'])) ?></h6>
                    </div>
                    <div class="mb-3">
                        <p class="text-muted mb-1">Terakhir Main:</p>
                        <h6 class="fw-bold"><?= date('d F Y, H:i', strtotime($data['statistics']['last_play'])) ?></h6>
                    </div>
                    <div class="alert alert-info mb-0">
                        <small><i class="fas fa-lightbulb"></i> User ini telah bermain selama
                            <strong><?= ceil((strtotime($data['statistics']['last_play']) - strtotime($data['statistics']['first_play'])) / 86400) ?> hari</strong>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Detailed History -->
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-list"></i> Riwayat Detail Sesi</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th>#</th>
                                    <th>Tanggal & Waktu</th>
                                    <th>Game</th>
                                    <th>Type</th>
                                    <th>RTP</th>
                                    <th class="text-center">Putaran</th>
                                    <th class="text-end">Modal</th>
                                    <th class="text-end">Saldo Akhir</th>
                                    <th class="text-end">Profit/Loss</th>
                                    <th class="text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($data['history'])): ?>
                                    <tr>
                                        <td colspan="10" class="text-center py-4">
                                            <p class="text-muted">Belum ada history</p>
                                        </td>
                                    </tr>
                                <?php else: ?>
                                    <?php $no = 1;
                                    foreach ($data['history'] as $row): ?>
                                        <?php
                                        $profit_loss = $row['final_balance'] - $row['initial_balance'];
                                        $is_win = $profit_loss > 0;
                                        $pct = ($profit_loss / $row['initial_balance']) * 100;
                                        ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td>
                                                <?= date('d/m/Y', strtotime($row['created_at'])) ?><br>
                                                <small class="text-muted"><?= date('H:i:s', strtotime($row['created_at'])) ?></small>
                                            </td>
                                            <td><?= htmlspecialchars($row['game_name']) ?></td>
                                            <td><span class="badge bg-secondary"><?= $row['game_type'] ?></span></td>
                                            <td><?= $row['rtp'] ?>%</td>
                                            <td class="text-center"><span class="badge bg-info"><?= $row['total_round'] ?></span></td>
                                            <td class="text-end">Rp <?= number_format($row['initial_balance']) ?></td>
                                            <td class="text-end">
                                                <strong class="<?= $is_win ? 'text-success' : 'text-danger' ?>">
                                                    Rp <?= number_format($row['final_balance']) ?>
                                                </strong>
                                            </td>
                                            <td class="text-end">
                                                <strong class="<?= $is_win ? 'text-success' : 'text-danger' ?>">
                                                    <?= $is_win ? '+' : '' ?>Rp <?= number_format($profit_loss) ?><br>
                                                    <small>(<?= number_format($pct, 1) ?>%)</small>
                                                </strong>
                                            </td>
                                            <td class="text-center">
                                                <?php if ($is_win): ?>
                                                    <span class="badge bg-success">WIN</span>
                                                <?php else: ?>
                                                    <span class="badge bg-danger">LOSS</span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>