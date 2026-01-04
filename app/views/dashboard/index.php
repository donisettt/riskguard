<div class="container-fluid px-4 py-4">

    <!-- Welcome Banner with Modern Design -->
    <div class="welcome-banner glass-effect mb-5">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h2 class="welcome-title mb-2">Selamat Datang, <span class="gradient-text"><?= $data['user']; ?></span>!</h2>
                <p class="welcome-subtitle mb-0">
                    Anda login sebagai <strong><?= ucfirst($data['role']); ?></strong>
                </p>
                <p class="text-muted mb-0 mt-1"><small>Sistem Analisis Risiko Perilaku Judi Online</small></p>
            </div>
            <div class="welcome-icon">
                <i class="fas fa-chart-line"></i>
            </div>
        </div>
    </div>

    <!-- Premium Stats Cards -->
    <div class="row g-4 mb-5">
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="stats-card gradient-blue">
                <div class="stats-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stats-content">
                    <h3 class="stats-number"><?= $data['total_users'] ?></h3>
                    <p class="stats-label">Total Responden</p>
                    <div class="stats-badge">
                        <i class="fas fa-arrow-up"></i> Aktif
                    </div>
                </div>
            </div>
        </div>

        <?php
        $highRiskCount = 0;
        foreach ($data['risk_stats'] as $rs) {
            if ($rs['risk_level'] == 'Bahaya' || $rs['risk_level'] == 'Tinggi') $highRiskCount += $rs['jml'];
        }
        ?>
        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="stats-card gradient-danger">
                <div class="stats-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <div class="stats-content">
                    <h3 class="stats-number"><?= $highRiskCount ?></h3>
                    <p class="stats-label">Perlu Intervensi</p>
                    <div class="stats-badge danger">
                        <i class="fas fa-shield-alt"></i> Prioritas
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="stats-card gradient-success">
                <div class="stats-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stats-content">
                    <h3 class="stats-number"><?= $data['total_users'] - $highRiskCount ?></h3>
                    <p class="stats-label">Risiko Rendah</p>
                    <div class="stats-badge success">
                        <i class="fas fa-heart"></i> Aman
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-6">
            <div class="stats-card gradient-warning">
                <div class="stats-icon">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <div class="stats-content">
                    <h3 class="stats-number"><?= count($data['responden']) ?></h3>
                    <p class="stats-label">Total Assessment</p>
                    <div class="stats-badge warning">
                        <i class="fas fa-chart-bar"></i> Data
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Table with Modern Design -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="premium-card">
                <div class="card-header-premium">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <h5 class="card-title-premium mb-1">
                                <i class="fas fa-database me-2"></i>Data Hasil Assessment Responden
                            </h5>
                            <p class="card-subtitle-premium">Monitoring dan analisis risiko perilaku</p>
                        </div>
                        <div class="search-box">
                            <i class="fas fa-search"></i>
                            <input type="text" placeholder="Cari responden..." id="searchInput">
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table modern-table mb-0">
                            <thead>
                                <tr>
                                    <th><i class="fas fa-user me-2"></i>Nama Responden</th>
                                    <th><i class="fas fa-envelope me-2"></i>Email</th>
                                    <th><i class="fas fa-star me-2"></i>Skor Terakhir</th>
                                    <th><i class="fas fa-heartbeat me-2"></i>Status Risiko</th>
                                    <th class="text-center"><i class="fas fa-cog me-2"></i>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data['responden'] as $res): ?>
                                    <tr class="table-row-hover">
                                        <td>
                                            <div class="user-info">
                                                <div class="avatar-circle">
                                                    <?= strtoupper(substr($res['name'], 0, 1)) ?>
                                                </div>
                                                <strong><?= $res['name'] ?></strong>
                                            </div>
                                        </td>
                                        <td class="text-muted"><?= $res['email'] ?></td>
                                        <td>
                                            <span class="score-badge"><?= $res['last_score'] ?? '-' ?></span>
                                        </td>
                                        <td>
                                            <?php if (!$res['last_risk']): ?>
                                                <span class="risk-badge risk-none">
                                                    <i class="fas fa-clock"></i> Belum Test
                                                </span>
                                            <?php else: ?>
                                                <?php
                                                $riskClass = 'risk-low';
                                                $icon = 'check-circle';
                                                if ($res['last_risk'] == 'Sedang') {
                                                    $riskClass = 'risk-medium';
                                                    $icon = 'exclamation-circle';
                                                }
                                                if ($res['last_risk'] == 'Tinggi') {
                                                    $riskClass = 'risk-high';
                                                    $icon = 'exclamation-triangle';
                                                }
                                                if ($res['last_risk'] == 'Bahaya') {
                                                    $riskClass = 'risk-critical';
                                                    $icon = 'times-circle';
                                                }
                                                ?>
                                                <span class="risk-badge <?= $riskClass ?>">
                                                    <i class="fas fa-<?= $icon ?>"></i> <?= $res['last_risk'] ?>
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn-modern btn-primary-modern">
                                                <i class="fas fa-eye"></i> Detail
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Analytics Charts Section -->
    <div class="row g-4">
        <div class="col-lg-6">
            <div class="premium-card chart-card">
                <div class="card-header-premium">
                    <h5 class="card-title-premium mb-1">
                        <i class="fas fa-chart-pie me-2"></i>Distribusi Tingkat Risiko
                    </h5>
                    <p class="card-subtitle-premium">Visualisasi persentase risiko keseluruhan</p>
                </div>
                <div class="card-body">
                    <canvas id="riskChart" height="300"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="premium-card chart-card">
                <div class="card-header-premium">
                    <h5 class="card-title-premium mb-1">
                        <i class="fas fa-chart-bar me-2"></i>Analisis Komparatif
                    </h5>
                    <p class="card-subtitle-premium">Perbandingan jumlah responden per kategori</p>
                </div>
                <div class="card-body">
                    <canvas id="barChart" height="300"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Premium Chart Configuration
        Chart.defaults.font.family = "'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif";
        Chart.defaults.color = '#6b7280';

        // Pie Chart
        const ctxPie = document.getElementById('riskChart');
        new Chart(ctxPie, {
            type: 'doughnut',
            data: {
                labels: [<?php foreach ($data['risk_stats'] as $rs) echo "'" . $rs['risk_level'] . "',"; ?>],
                datasets: [{
                    data: [<?php foreach ($data['risk_stats'] as $rs) echo $rs['jml'] . ","; ?>],
                    backgroundColor: [
                        'rgba(16, 185, 129, 0.8)',
                        'rgba(251, 191, 36, 0.8)',
                        'rgba(249, 115, 22, 0.8)',
                        'rgba(239, 68, 68, 0.8)'
                    ],
                    borderColor: '#fff',
                    borderWidth: 3,
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            font: {
                                size: 12,
                                weight: '500'
                            },
                            usePointStyle: true,
                            pointStyle: 'circle'
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(17, 24, 39, 0.95)',
                        padding: 12,
                        titleFont: {
                            size: 14,
                            weight: '600'
                        },
                        bodyFont: {
                            size: 13
                        },
                        cornerRadius: 8,
                        displayColors: true,
                        boxPadding: 6
                    }
                },
                cutout: '65%'
            }
        });

        // Bar Chart
        const ctxBar = document.getElementById('barChart');
        new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: [<?php foreach ($data['risk_stats'] as $rs) echo "'" . $rs['risk_level'] . "',"; ?>],
                datasets: [{
                    label: 'Jumlah Responden',
                    data: [<?php foreach ($data['risk_stats'] as $rs) echo $rs['jml'] . ","; ?>],
                    backgroundColor: [
                        'rgba(16, 185, 129, 0.8)',
                        'rgba(251, 191, 36, 0.8)',
                        'rgba(249, 115, 22, 0.8)',
                        'rgba(239, 68, 68, 0.8)'
                    ],
                    borderColor: [
                        'rgb(16, 185, 129)',
                        'rgb(251, 191, 36)',
                        'rgb(249, 115, 22)',
                        'rgb(239, 68, 68)'
                    ],
                    borderWidth: 2,
                    borderRadius: 8,
                    borderSkipped: false
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
                        backgroundColor: 'rgba(17, 24, 39, 0.95)',
                        padding: 12,
                        titleFont: {
                            size: 14,
                            weight: '600'
                        },
                        bodyFont: {
                            size: 13
                        },
                        cornerRadius: 8
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(107, 114, 128, 0.1)',
                            drawBorder: false
                        },
                        ticks: {
                            padding: 10,
                            font: {
                                size: 11
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            padding: 10,
                            font: {
                                size: 11,
                                weight: '500'
                            }
                        }
                    }
                }
            }
        });

        // Search functionality
        document.getElementById('searchInput')?.addEventListener('input', function(e) {
            const searchTerm = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('.modern-table tbody tr');

            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchTerm) ? '' : 'none';
            });
        });
    </script>

</div>