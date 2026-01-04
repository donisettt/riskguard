<style>
    @media print {

        .no-print,
        .sidebar,
        .navbar {
            display: none !important;
        }

        .card {
            border: 1px solid #ddd !important;
            box-shadow: none !important;
            break-inside: avoid;
        }

        body {
            background: white;
            -webkit-print-color-adjust: exact;
        }
    }
</style>

<div class="container-fluid p-0">

    <div class="card mb-4 shadow-sm border-0 no-print">
        <div class="card-body">
            <h4 class="mb-3"><i class="fas fa-filter text-primary"></i> Filter Laporan Analisis</h4>
            <form method="GET" action="index.php">
                <input type="hidden" name="url" value="report">
                <div class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label class="form-label">Dari Tanggal</label>
                        <input type="date" name="start" class="form-control" value="<?= $data['filter']['start'] ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Sampai Tanggal</label>
                        <input type="date" name="end" class="form-control" value="<?= $data['filter']['end'] ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Filter Risiko</label>
                        <select name="risk" class="form-select">
                            <option value="All">Semua Kategori</option>
                            <option value="Rendah" <?= $data['filter']['risk'] == 'Rendah' ? 'selected' : '' ?>>Rendah</option>
                            <option value="Sedang" <?= $data['filter']['risk'] == 'Sedang' ? 'selected' : '' ?>>Sedang</option>
                            <option value="Tinggi" <?= $data['filter']['risk'] == 'Tinggi' ? 'selected' : '' ?>>Tinggi</option>
                            <option value="Bahaya" <?= $data['filter']['risk'] == 'Bahaya' ? 'selected' : '' ?>>Bahaya</option>
                        </select>
                    </div>
                    <div class="col-md-3 d-flex gap-2">
                        <button type="submit" class="btn btn-primary w-100"><i class="fas fa-search"></i> Tampilkan</button>
                        <button type="button" onclick="window.print()" class="btn btn-dark"><i class="fas fa-print"></i> Cetak</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div id="print-area">

        <div class="text-center mb-5">
            <h2 class="fw-bold text-uppercase">Laporan Analisis Risiko Perjudian</h2>
            <p class="text-muted">Periode Data: <?= date('d M Y', strtotime($data['filter']['start'])) ?> s/d <?= date('d M Y', strtotime($data['filter']['end'])) ?></p>
            <hr>
        </div>

        <div class="row mb-4 text-center">
            <div class="col-md-4">
                <div class="border rounded p-3 bg-light">
                    <h6 class="text-muted">Total Responden</h6>
                    <h2 class="fw-bold text-primary mb-0"><?= $data['summary']['total'] ?></h2>
                </div>
            </div>
            <div class="col-md-4">
                <div class="border rounded p-3 bg-light">
                    <h6 class="text-muted">Kasus Kritis (Tinggi/Bahaya)</h6>
                    <h2 class="fw-bold text-danger mb-0"><?= $data['summary']['critical'] ?></h2>
                    <small>Butuh penanganan segera</small>
                </div>
            </div>
            <div class="col-md-4">
                <div class="border rounded p-3 bg-light">
                    <h6 class="text-muted">Rata-rata Skor Risiko</h6>
                    <h2 class="fw-bold text-dark mb-0"><?= $data['summary']['avg_score'] ?></h2>
                    <small>Dari skala 0-40</small>
                </div>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-md-8">
                <div class="card border h-100">
                    <div class="card-header bg-white fw-bold">Tren Aktivitas Harian</div>
                    <div class="card-body">
                        <canvas id="trendChart" style="max-height: 300px;"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card border h-100">
                    <div class="card-header bg-white fw-bold">Proporsi Risiko</div>
                    <div class="card-body">
                        <canvas id="pieChart" style="max-height: 300px;"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0">
            <div class="card-header bg-dark text-white py-2">
                <h6 class="m-0"><i class="fas fa-table me-2"></i>Rincian Data Responden</h6>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped table-bordered mb-0" style="font-size: 0.9rem;">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Nama Responden</th>
                            <th>Email</th>
                            <th class="text-center">Skor</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($data['details'])): ?>
                            <tr>
                                <td colspan="6" class="text-center py-3">Tidak ada data pada periode ini.</td>
                            </tr>
                        <?php else: ?>
                            <?php $no = 1;
                            foreach ($data['details'] as $row): ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= date('d/m/Y H:i', strtotime($row['created_at'])) ?></td>
                                    <td><?= $row['name'] ?></td>
                                    <td><?= $row['email'] ?></td>
                                    <td class="text-center fw-bold"><?= $row['total_score'] ?></td>
                                    <td class="text-center">
                                        <span class="badge text-dark border border-dark 
                                        <?= ($row['risk_level'] == 'Bahaya') ? 'bg-danger text-white' : 'bg-light' ?>">
                                            <?= $row['risk_level'] ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row mt-5 d-none d-print-block">
            <div class="col-4 offset-8 text-center">
                <p>Dicetak pada: <?= date('d F Y H:i') ?></p>
                <br><br>
                <p class="fw-bold text-decoration-underline">Administrator</p>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // 1. Data untuk Line Chart (Tren)
    const trendCtx = document.getElementById('trendChart');
    new Chart(trendCtx, {
        type: 'line',
        data: {
            labels: [<?php foreach ($data['trend'] as $t) echo "'" . date('d/m', strtotime($t['date'])) . "',"; ?>],
            datasets: [{
                label: 'Jumlah Assessment',
                data: [<?php foreach ($data['trend'] as $t) echo $t['total'] . ","; ?>],
                borderColor: '#0d6efd',
                backgroundColor: 'rgba(13, 110, 253, 0.1)',
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });

    // 2. Data untuk Pie Chart (Distribusi)
    const pieCtx = document.getElementById('pieChart');
    new Chart(pieCtx, {
        type: 'doughnut',
        data: {
            labels: [<?php foreach ($data['distribution'] as $d) echo "'" . $d['risk_level'] . "',"; ?>],
            datasets: [{
                data: [<?php foreach ($data['distribution'] as $d) echo $d['total'] . ","; ?>],
                backgroundColor: ['#198754', '#ffc107', '#fd7e14', '#dc3545']
            }]
        }
    });
</script>