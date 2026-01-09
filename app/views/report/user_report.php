<div class="container-fluid py-4 report-page">

    <!-- Header -->
    <div class="row mb-4">
        <div class="col-md-12">
            <div class="d-flex align-items-center mb-3">
                <div class="rounded-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; background-color: #009d63;">
                    <i class="fas fa-chart-pie fa-lg text-white"></i>
                </div>
                <div class="ms-3">
                    <h2 class="fw-bold mb-1" style="color: #1e293b;">Laporan Assessment Saya</h2>
                    <p class="text-muted mb-0">Analisis personal perkembangan risiko perjudian Anda</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Card -->
    <div class="card shadow-sm mb-4" style="border-left: 4px solid #009d63;">
        <div class="card-body">
            <h6 class="fw-semibold mb-3 text-success">
                <i class="fas fa-filter me-2"></i>Filter Periode
            </h6>

            <form method="GET" action="index.php" class="row g-3 align-items-end">
                <input type="hidden" name="url" value="report/userReport">

                <div class="col-md-3">
                    <label class="form-label small fw-semibold">Dari Tanggal</label>
                    <input type="date" name="start" class="form-control"
                        value="<?= $data['filter']['start'] ?>">
                </div>

                <div class="col-md-3">
                    <label class="form-label small fw-semibold">Sampai Tanggal</label>
                    <input type="date" name="end" class="form-control"
                        value="<?= $data['filter']['end'] ?>">
                </div>

                <div class="col-md-3">
                    <label class="form-label small fw-semibold">Kategori Risiko</label>
                    <select name="risk" class="form-select">
                        <option value="All">Semua</option>
                        <option value="Rendah" <?= $data['filter']['risk'] == 'Rendah' ? 'selected' : '' ?>>Rendah</option>
                        <option value="Sedang" <?= $data['filter']['risk'] == 'Sedang' ? 'selected' : '' ?>>Sedang</option>
                        <option value="Tinggi" <?= $data['filter']['risk'] == 'Tinggi' ? 'selected' : '' ?>>Tinggi</option>
                        <option value="Bahaya" <?= $data['filter']['risk'] == 'Bahaya' ? 'selected' : '' ?>>Bahaya</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label small fw-semibold">&nbsp;</label>
                    <div class="filter-action-wrapper">
                        <button type="submit"
                            class="btn filter-action-btn text-white"
                            style="background-color:#009d63;">
                            <i class="fas fa-search"></i> Tampilkan
                        </button>

                        <a href="index.php?url=report/userReportPdf&start=<?= $data['filter']['start'] ?>&end=<?= $data['filter']['end'] ?>&risk=<?= $data['filter']['risk'] ?>"
                            class="btn btn-outline-danger filter-action-btn"
                            target="_blank">
                            <i class="fas fa-file-pdf"></i> PDF
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="row mb-4">

        <!-- Total -->
        <div class="col-md-3 d-flex mt-2">
            <div class="card risk-card shadow-sm w-100" style="border-left-color:#009d63;">
                <div class="card-body summary-card-body">
                    <div class="d-flex justify-content-between w-100">
                        <div>
                            <p class="text-muted small mb-1">Total Assessment</p>
                            <h3 class="fw-bold mb-0"><?= $data['summary']['total'] ?></h3>
                        </div>
                        <div class="bg-success text-white d-flex align-items-center justify-content-center rounded"
                            style="width:48px;height:48px;">
                            <i class="fas fa-clipboard-check"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Rata-rata -->
        <div class="col-md-3 d-flex mt-2">
            <div class="card risk-card shadow-sm w-100" style="border-left-color:#f59e0b;">
                <div class="card-body summary-card-body">
                    <div class="d-flex justify-content-between w-100">
                        <div>
                            <p class="text-muted small mb-1">Rata-rata Skor</p>
                            <h3 class="fw-bold mb-0"><?= $data['summary']['avg_score'] ?></h3>
                            <small class="text-muted d-block" style="line-height:1.2;">dari 40 poin</small>
                        </div>
                        <div class="bg-warning text-white d-flex align-items-center justify-content-center rounded"
                            style="width:48px;height:48px;">
                            <i class="fas fa-calculator"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Terendah -->
        <div class="col-md-3 d-flex mt-2">
            <div class="card risk-card shadow-sm w-100" style="border-left-color:#16a34a;">
                <div class="card-body summary-card-body">
                    <div class="d-flex justify-content-between w-100">
                        <div>
                            <p class="text-muted small mb-1">Skor Terendah</p>
                            <h3 class="fw-bold text-success mb-0"><?= $data['summary']['min_score'] ?></h3>
                        </div>
                        <div class="bg-success text-white d-flex align-items-center justify-content-center rounded"
                            style="width:48px;height:48px;">
                            <i class="fas fa-arrow-down"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tertinggi -->
        <div class="col-md-3 d-flex mt-2">
            <div class="card risk-card shadow-sm w-100" style="border-left-color:#dc2626;">
                <div class="card-body summary-card-body">
                    <div class="d-flex justify-content-between w-100">
                        <div>
                            <p class="text-muted small mb-1">Skor Tertinggi</p>
                            <h3 class="fw-bold text-danger mb-0"><?= $data['summary']['max_score'] ?></h3>
                        </div>
                        <div class="bg-danger text-white d-flex align-items-center justify-content-center rounded"
                            style="width:48px;height:48px;">
                            <i class="fas fa-arrow-up"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Distribusi Risiko & Grafik Progress -->
    <div class="row mb-4">
        <!-- Distribusi Risiko -->
        <div class="col-md-6 mt-2">
            <div class="card shadow-sm h-100">
                <div class="card-header" style="background-color: #009d63; color: white;">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-pie-chart me-2"></i>Distribusi Kategori Risiko</h5>
                </div>
                <div class="card-body">
                    <?php if (!empty($data['summary']['distribution'])): ?>
                        <?php
                        $total_dist = array_sum(array_column($data['summary']['distribution'], 'count'));
                        foreach ($data['summary']['distribution'] as $dist):
                            $pct = $total_dist > 0 ? ($dist['count'] / $total_dist * 100) : 0;
                            $colorClass = '';
                            $badgeClass = '';
                            if ($dist['risk_level'] == 'Bahaya') {
                                $colorClass = 'bg-danger';
                                $badgeClass = 'bg-danger';
                            } elseif ($dist['risk_level'] == 'Tinggi') {
                                $colorClass = 'bg-warning';
                                $badgeClass = 'bg-warning text-dark';
                            } elseif ($dist['risk_level'] == 'Sedang') {
                                $colorClass = 'bg-info';
                                $badgeClass = 'bg-info';
                            } else {
                                $colorClass = 'bg-success';
                                $badgeClass = 'bg-success';
                            }
                        ?>
                            <div class="mb-3">
                                <div class="d-flex justify-content-between mb-1">
                                    <span class="badge <?= $badgeClass ?>"><?= htmlspecialchars($dist['risk_level']) ?></span>
                                    <span class="fw-semibold"><?= $dist['count'] ?> kali (<?= number_format($pct, 1) ?>%)</span>
                                </div>
                                <div class="progress" style="height: 25px;">
                                    <div class="progress-bar <?= $colorClass ?>" style="width: <?= $pct ?>%">
                                        <?= number_format($pct, 1) ?>%
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-center text-muted py-4">Belum ada data untuk ditampilkan</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Progress Chart -->
        <div class="col-md-6 mt-2">
            <div class="card shadow-sm h-100">
                <div class="card-header" style="background-color: #009d63; color: white;">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-chart-line me-2"></i>Grafik Perkembangan Skor</h5>
                </div>
                <div class="card-body">
                    <?php if (!empty($data['riskProgress'])): ?>
                        <canvas id="progressChart" class="progress-chart"></canvas>
                    <?php else: ?>
                        <div class="text-center text-muted py-5">
                            <i class="fas fa-chart-line fa-3x mb-3"></i>
                            <p>Belum ada data progress</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Rekomendasi & Tips -->
    <?php if ($data['summary']['high_risk'] > 0): ?>
        <div class="alert alert-warning shadow-sm mb-4" role="alert">
            <div class="d-flex align-items-start">
                <i class="fas fa-exclamation-triangle fa-2x me-3"></i>
                <div>
                    <h5 class="alert-heading fw-bold">Perhatian!</h5>
                    <p class="mb-2">Anda memiliki <strong><?= $data['summary']['high_risk'] ?> assessment</strong> dengan kategori risiko <strong>Tinggi/Bahaya</strong> dalam periode ini.</p>
                    <hr>
                    <p class="mb-0 small">
                        <strong>Rekomendasi:</strong> Kami sangat menyarankan Anda untuk berkonsultasi dengan profesional kesehatan mental atau menghubungi layanan konseling kecanduan judi. Jangan ragu untuk mencari bantuan!
                    </p>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <!-- Riwayat Assessment Timeline -->
    <div class="card shadow-sm">
        <div class="card-header bg-white border-bottom">
            <h5 class="mb-0 fw-bold"><i class="fas fa-history me-2"></i>Riwayat Assessment Detail</h5>
        </div>
        <div class="card-body">
            <?php if (empty($data['assessments'])): ?>
                <div class="text-center py-5">
                    <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                    <p class="text-muted">Belum ada assessment pada periode ini</p>
                    <a href="index.php?url=assessment" class="btn btn-sm" style="background-color: #009d63; color: white;">
                        <i class="fas fa-plus"></i> Mulai Assessment
                    </a>
                </div>
            <?php else: ?>
                <div class="assessment-timeline">
                    <?php foreach ($data['assessments'] as $assessment):
                        $dotColor = '';
                        $badgeClass = '';
                        $cardBorder = '';
                        if ($assessment['risk_level'] == 'Bahaya') {
                            $dotColor = '#dc2626';
                            $badgeClass = 'bg-danger';
                            $cardBorder = 'border-danger';
                        } elseif ($assessment['risk_level'] == 'Tinggi') {
                            $dotColor = '#f59e0b';
                            $badgeClass = 'bg-warning text-dark';
                            $cardBorder = 'border-warning';
                        } elseif ($assessment['risk_level'] == 'Sedang') {
                            $dotColor = '#3b82f6';
                            $badgeClass = 'bg-info';
                            $cardBorder = 'border-info';
                        } else {
                            $dotColor = '#16a34a';
                            $badgeClass = 'bg-success';
                            $cardBorder = 'border-success';
                        }
                    ?>
                        <div class="timeline-item">
                            <div class="timeline-dot" style="box-shadow: 0 0 0 2px <?= $dotColor ?>; background-color: <?= $dotColor ?>;"></div>
                            <div class="card mb-3 <?= $cardBorder ?>" style="border-left-width: 3px;">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-md-8">
                                            <h6 class="fw-bold mb-1"><?= htmlspecialchars($assessment['group_title']) ?></h6>
                                            <p class="text-muted small mb-2"><?= htmlspecialchars($assessment['group_description'] ?? 'Tidak ada deskripsi') ?></p>
                                            <small class="text-muted">
                                                <i class="far fa-calendar me-1"></i>
                                                <?= date('d M Y, H:i', strtotime($assessment['created_at'])) ?> WIB
                                            </small>
                                        </div>
                                        <div class="col-md-4 text-end">
                                            <span class="badge <?= $badgeClass ?> mb-2 fs-6"><?= htmlspecialchars($assessment['risk_level']) ?></span>
                                            <h4 class="fw-bold mb-0">
                                                Skor: <?= $assessment['total_score'] ?><small class="text-muted fs-6">/40</small>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Info & Tips -->
    <div class="card shadow-sm mt-4" style="border-left: 4px solid #3b82f6;">
        <div class="card-body">
            <h6 class="fw-bold mb-3"><i class="fas fa-lightbulb text-warning me-2"></i>Tips Mengelola Risiko Kecanduan Judi</h6>
            <div class="row">
                <div class="col-md-6">
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i><strong>Batasi Waktu:</strong> Tetapkan waktu bermain yang ketat</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i><strong>Tentukan Budget:</strong> Jangan pernah melebihi anggaran yang ditetapkan</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i><strong>Cari Alternatif:</strong> Temukan hobi atau aktivitas pengganti yang positif</li>
                    </ul>
                </div>
                <div class="col-md-6">
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i><strong>Hindari Utang:</strong> Jangan pernah berjudi dengan uang pinjaman</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i><strong>Bicara dengan Orang Lain:</strong> Bagikan masalah Anda kepada orang terdekat</li>
                        <li class="mb-2"><i class="fas fa-check-circle text-success me-2"></i><strong>Cari Bantuan Profesional:</strong> Jangan ragu untuk konsultasi dengan ahli</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

</div>

<link rel="stylesheet" href="/sigma/public/css/user-report.css">

<?php if (!empty($data['riskProgress'])): ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Data untuk chart
        const progressData = <?= json_encode($data['riskProgress']) ?>;
        const labels = progressData.map(item => {
            const date = new Date(item.date);
            return date.toLocaleDateString('id-ID', {
                day: 'numeric',
                month: 'short'
            });
        });
        const scores = progressData.map(item => item.total_score);

        // Buat chart
        const ctx = document.getElementById('progressChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Skor Risiko',
                    data: scores,
                    borderColor: '#009d63',
                    backgroundColor: 'rgba(0, 157, 99, 0.1)',
                    borderWidth: 3,
                    tension: 0.4,
                    fill: true,
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    pointBackgroundColor: '#009d63',
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.8)',
                        padding: 12,
                        titleFont: {
                            size: 14,
                            weight: 'bold'
                        },
                        bodyFont: {
                            size: 13
                        },
                        callbacks: {
                            label: function(context) {
                                return 'Skor: ' + context.parsed.y + ' / 40';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 40,
                        ticks: {
                            stepSize: 5
                        },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    </script>
<?php endif; ?>