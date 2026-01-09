<div class="container-fluid py-4">
    <!-- Page Header -->
    <div class="row mb-4">
        <div class="col-md-12">
            <h2 class="page-title mb-1">
                History Simulasi User
            </h2>
            <p class="page-subtitle">
                Analisis performa user berdasarkan data simulasi RNG
            </p>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <?php
        $stats = [
            ['label' => 'Total User', 'value' => number_format($data['statistics']['total_users'] ?? 0), 'icon' => 'fa-users', 'color' => 'primary'],
            ['label' => 'Total Sesi', 'value' => number_format($data['statistics']['total_sessions'] ?? 0), 'icon' => 'fa-gamepad', 'color' => 'info'],
            ['label' => 'Total Putaran', 'value' => number_format($data['statistics']['total_rounds'] ?? 0), 'icon' => 'fa-sync-alt', 'color' => 'warning'],
            ['label' => 'Total Loss', 'value' => 'Rp ' . number_format($data['statistics']['total_loss'] ?? 0), 'icon' => 'fa-chart-line', 'color' => 'danger'],
        ];
        ?>

        <?php foreach ($stats as $stat): ?>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm stat-card">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted small mb-1"><?= $stat['label'] ?></p>
                            <h3 class="fw-bold mb-0 text-<?= $stat['color'] ?>">
                                <?= $stat['value'] ?>
                            </h3>
                        </div>
                        <div class="stat-icon text-<?= $stat['color'] ?>">
                            <i class="fas <?= $stat['icon'] ?> fa-lg"></i>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Win/Loss & Average -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-bottom">
                    <h5 class="fw-bold mb-0">Win / Loss Ratio</h5>
                </div>
                <div class="card-body">
                    <?php
                    $total_sessions = $data['statistics']['total_sessions'] ?? 0;
                    $win_sessions = $data['statistics']['win_sessions'] ?? 0;

                    if ($total_sessions > 0) {
                        $win_pct = ($win_sessions / $total_sessions * 100);
                        $loss_pct = 100 - $win_pct;
                    } else {
                        // Jika tidak ada data, set keduanya 0
                        $win_pct = 0;
                        $loss_pct = 0;
                    }
                    ?>

                    <div class="mb-4">
                        <div class="d-flex justify-content-between small mb-1">
                            <span class="fw-semibold text-success">Win</span>
                            <span><?= number_format($win_pct, 1) ?>%</span>
                        </div>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-success" style="width: <?= $win_pct ?>%"></div>
                        </div>
                    </div>

                    <div>
                        <div class="d-flex justify-content-between small mb-1">
                            <span class="fw-semibold text-danger">Loss</span>
                            <span><?= number_format($loss_pct, 1) ?>%</span>
                        </div>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-danger" style="width: <?= $loss_pct ?>%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-bottom">
                    <h5 class="fw-bold mb-0">Rata-rata per Sesi</h5>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6">
                            <p class="text-muted small mb-1">Avg Loss</p>
                            <h4 class="fw-bold text-danger">
                                Rp <?= number_format($data['statistics']['avg_loss_per_session'] ?? 0) ?>
                            </h4>
                        </div>
                        <div class="col-6">
                            <p class="text-muted small mb-1">Avg Putaran</p>
                            <h4 class="fw-bold text-info">
                                <?= number_format($data['statistics']['total_rounds'] / max($total_sessions, 1), 1) ?>
                            </h4>
                        </div>
                    </div>

                    <div class="alert alert-light border mt-4 mb-0 small">
                        <i class="fas fa-info-circle me-1"></i>
                        <?php if ($total_sessions == 0): ?>
                            Belum ada data simulasi yang tercatat.
                        <?php elseif ($win_pct < 20): ?>
                            Hanya <strong><?= number_format($win_pct, 1) ?>%</strong> sesi profit — sistem sangat konsisten.
                        <?php else: ?>
                            <strong><?= number_format($loss_pct, 1) ?>%</strong> sesi berakhir loss — house edge bekerja stabil.
                        <?php endif; ?>
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

                <!-- Filter Form -->
                <div class="card-body border-bottom bg-light">
                    <form method="GET" action="/sigma/simulator/history" class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label small fw-semibold">User</label>
                            <select name="user_id" class="form-select form-select-sm">
                                <option value="">Semua User</option>
                                <?php foreach ($data['users'] as $user): ?>
                                    <option value="<?= $user['id'] ?>" <?= (isset($data['filters']['user_id']) && $data['filters']['user_id'] == $user['id']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($user['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label small fw-semibold">Type Game</label>
                            <select name="game_type" class="form-select form-select-sm">
                                <option value="">Semua Type</option>
                                <?php foreach ($data['game_types'] as $type): ?>
                                    <option value="<?= htmlspecialchars($type) ?>" <?= (isset($data['filters']['game_type']) && $data['filters']['game_type'] == $type) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($type) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <label class="form-label small fw-semibold">Tanggal Dari</label>
                            <input type="date" name="date_from" class="form-control form-control-sm"
                                value="<?= isset($data['filters']['date_from']) ? htmlspecialchars($data['filters']['date_from']) : '' ?>">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label small fw-semibold">Tanggal Sampai</label>
                            <input type="date" name="date_to" class="form-control form-control-sm"
                                value="<?= isset($data['filters']['date_to']) ? htmlspecialchars($data['filters']['date_to']) : '' ?>">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label small fw-semibold">&nbsp;</label>
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary btn-sm w-50">
                                    <i class="fas fa-filter"></i> Filter
                                </button>
                                <a href="/sigma/simulator/history" class="btn btn-secondary btn-sm w-50">
                                    <i class="fas fa-redo"></i> Reset
                                </a>
                            </div>
                        </div>
                    </form>
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
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($data['history'])): ?>
                                    <tr>
                                        <td colspan="10" class="text-center py-4">
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
                                                <div class="fw-semibold"><?= date('d M Y', strtotime($row['created_at'])) ?></div>
                                                <small class="text-muted"><?= date('H:i', strtotime($row['created_at'])) ?></small>
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
                                            <td class="text-end">Rp <?= number_format($row['initial_balance'] ?? 0) ?></td>
                                            <td class="text-end">
                                                <strong class="<?= $is_win ? 'text-success' : 'text-danger' ?>">
                                                    Rp <?= number_format($row['final_balance'] ?? 0) ?>
                                                </strong>
                                            </td>
                                            <td class="text-end amount">
                                                <strong class="<?= $is_win ? 'text-success' : 'text-danger' ?>">
                                                    <?= $is_win ? '+Rp ' : 'Rp ' ?><?= number_format(abs($profit_loss ?? 0)) ?>
                                                </strong>
                                                <br>
                                                <small class="<?= $is_win ? 'text-success' : 'text-danger' ?>">
                                                    (<?= $is_win ? '+' : '' ?><?= number_format($pct_change, 1) ?>%)
                                                </small>
                                            </td>
                                            <td class="text-center">
                                                <?php if ($is_win): ?>
                                                    <span class="badge bg-success"><i class="fas fa-arrow-up"></i> WIN</span>
                                                <?php else: ?>
                                                    <span class="badge bg-danger"><i class="fas fa-arrow-down"></i> LOSS</span>
                                                <?php endif; ?>
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
                                <?php
                                // Build query string for filters
                                $query_params = [];
                                if (!empty($data['filters']['user_id'])) {
                                    $query_params[] = 'user_id=' . $data['filters']['user_id'];
                                }
                                if (!empty($data['filters']['game_type'])) {
                                    $query_params[] = 'game_type=' . urlencode($data['filters']['game_type']);
                                }
                                if (!empty($data['filters']['date_from'])) {
                                    $query_params[] = 'date_from=' . $data['filters']['date_from'];
                                }
                                if (!empty($data['filters']['date_to'])) {
                                    $query_params[] = 'date_to=' . $data['filters']['date_to'];
                                }
                                $query_string = !empty($query_params) ? '&' . implode('&', $query_params) : '';
                                ?>

                                <li class="page-item <?= $data['current_page'] <= 1 ? 'disabled' : '' ?>">
                                    <a class="page-link" href="/sigma/simulator/history?page=<?= $data['current_page'] - 1 ?><?= $query_string ?>">Previous</a>
                                </li>

                                <?php for ($i = 1; $i <= $data['total_pages']; $i++): ?>
                                    <li class="page-item <?= $i == $data['current_page'] ? 'active' : '' ?>">
                                        <a class="page-link" href="/sigma/simulator/history?page=<?= $i ?><?= $query_string ?>"><?= $i ?></a>
                                    </li>
                                <?php endfor; ?>

                                <li class="page-item <?= $data['current_page'] >= $data['total_pages'] ? 'disabled' : '' ?>">
                                    <a class="page-link" href="/sigma/simulator/history?page=<?= $data['current_page'] + 1 ?><?= $query_string ?>">Next</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="/sigma/public/css/simulator-history.css">