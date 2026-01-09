<div class="container-fluid py-4">

    <!-- Header & Filter -->
    <div class="row mb-4 no-print">
        <div class="col-md-12">
            <div class="d-flex align-items-center mb-3">
                <div class="rounded-3" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center; background-color: #009d63;">
                    <i class="fas fa-chart-line fa-lg text-white"></i>
                </div>
                <div class="ms-3">
                    <h2 class="fw-bold mb-1" style="color: #1e293b;">Laporan Analisis Risiko Perjudian</h2>
                    <p class="text-muted mb-0">Analisis mendalam faktor risiko dan tren kecanduan judi</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter Card -->
    <div class="card shadow-sm mb-4 no-print" style="border-left: 4px solid #009d63;">
        <div class="card-body">
            <h6 class="fw-semibold mb-3" style="color: #009d63;"><i class="fas fa-filter me-2"></i>Filter Analisis</h6>
            <form method="GET" action="index.php" class="row g-3">
                <input type="hidden" name="url" value="report/analysis">
                <div class="col-md-2">
                    <label class="form-label small fw-semibold">Dari Tanggal</label>
                    <input type="date" name="start" class="form-control form-control-sm" value="<?= $data['filter']['start'] ?>">
                </div>
                <div class="col-md-2">
                    <label class="form-label small fw-semibold">Sampai Tanggal</label>
                    <input type="date" name="end" class="form-control form-control-sm" value="<?= $data['filter']['end'] ?>">
                </div>
                <div class="col-md-2">
                    <label class="form-label small fw-semibold">Responden</label>
                    <select name="user_id" class="form-select form-select-sm">
                        <option value="">Semua Responden</option>
                        <?php foreach ($data['users'] as $user): ?>
                            <option value="<?= $user['id'] ?>" <?= isset($data['filter']['user_id']) && $data['filter']['user_id'] == $user['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($user['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label small fw-semibold">Kategori Risiko</label>
                    <select name="risk" class="form-select form-select-sm">
                        <option value="All">Semua</option>
                        <option value="Rendah" <?= $data['filter']['risk'] == 'Rendah' ? 'selected' : '' ?>>Rendah</option>
                        <option value="Sedang" <?= $data['filter']['risk'] == 'Sedang' ? 'selected' : '' ?>>Sedang</option>
                        <option value="Tinggi" <?= $data['filter']['risk'] == 'Tinggi' ? 'selected' : '' ?>>Tinggi</option>
                        <option value="Bahaya" <?= $data['filter']['risk'] == 'Bahaya' ? 'selected' : '' ?>>Bahaya</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label small fw-semibold">&nbsp;</label>
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-sm" style="background-color: #009d63; color: white; border: none;">
                            <i class="fas fa-search"></i> Tampilkan
                        </button>
                        <a href="index.php?url=report/analysisPdf&start=<?= $data['filter']['start'] ?>&end=<?= $data['filter']['end'] ?>&risk=<?= $data['filter']['risk'] ?>&user_id=<?= $data['filter']['user_id'] ?? '' ?>" class="btn btn-outline-danger btn-sm" target="_blank">
                            <i class="fas fa-file-pdf"></i> Download PDF
                        </a>
                        <button type="button" onclick="exportToExcel()" class="btn btn-outline-success btn-sm">
                            <i class="fas fa-file-excel"></i> Excel
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Summary Cards (Screen Only) -->
    <div class="row mb-4 screen-only">
        <div class="col-md-3">
            <div class="card risk-card border-0 shadow-sm" style="border-left: 4px solid #009d63;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted small mb-1">Total Responden</p>
                            <h3 class="fw-bold mb-0"><?= $data['summary']['total'] ?></h3>
                        </div>
                        <div style="background-color: #009d63; width: 48px; height: 48px; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-users text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card risk-card border-0 shadow-sm" style="border-left: 4px solid #dc2626;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted small mb-1">Kasus Bahaya</p>
                            <h3 class="fw-bold mb-0 text-danger"><?= $data['summary']['critical'] ?></h3>
                        </div>
                        <div style="background-color: #dc2626; width: 48px; height: 48px; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-exclamation-triangle text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card risk-card border-0 shadow-sm" style="border-left: 4px solid #16a34a;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted small mb-1">Rata-rata Skor</p>
                            <h3 class="fw-bold mb-0"><?= $data['summary']['avg_score'] ?></h3>
                        </div>
                        <div style="background-color: #16a34a; width: 48px; height: 48px; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-chart-line text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card risk-card border-0 shadow-sm" style="border-left: 4px solid #f59e0b;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted small mb-1">Persentase Kritis</p>
                            <h3 class="fw-bold mb-0 text-warning">
                                <?= $data['summary']['total'] > 0 ? number_format(($data['summary']['critical'] / $data['summary']['total']) * 100, 1) : 0 ?>%
                            </h3>
                        </div>
                        <div style="background-color: #f59e0b; width: 48px; height: 48px; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-percent text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Analisis Faktor Kecanduan (Screen Only) -->
    <div class="row mb-4 screen-only">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header" style="background-color: #009d63; color: white;">
                    <h5 class="mb-0 fw-bold">Analisis Faktor Risiko Kecanduan</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="fw-bold mb-3">Distribusi Kategori Risiko</h6>
                            <table class="table table-sm table-borderless">
                                <?php
                                $total_dist = array_sum(array_column($data['distribution'], 'total'));
                                foreach ($data['distribution'] as $dist):
                                    $pct = $total_dist > 0 ? ($dist['total'] / $total_dist * 100) : 0;
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
                                    <tr>
                                        <td width="30%">
                                            <span class="badge <?= $badgeClass ?>"><?= htmlspecialchars($dist['risk_level']) ?></span>
                                        </td>
                                        <td width="40%">
                                            <div class="progress" style="height: 20px;">
                                                <div class="progress-bar <?= $colorClass ?>" style="width: <?= $pct ?>%">
                                                    <?= number_format($pct, 1) ?>%
                                                </div>
                                            </div>
                                        </td>
                                        <td width="30%" class="text-end"><strong><?= $dist['total'] ?> orang</strong></td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h6 class="fw-bold mb-3">Faktor Utama Kecanduan</h6>
                            <ul class="list-unstyled">
                                <li class="mb-2">
                                    <i class="fas fa-check-circle text-danger me-2"></i>
                                    <strong>Frekuensi Bermain:</strong>
                                    <span class="text-muted">Indikator utama tingkat kecanduan</span>
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check-circle text-danger me-2"></i>
                                    <strong>Kontrol Diri:</strong>
                                    <span class="text-muted">Kemampuan menghentikan aktivitas judi</span>
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check-circle text-danger me-2"></i>
                                    <strong>Dampak Finansial:</strong>
                                    <span class="text-muted">Kerugian ekonomi akibat berjudi</span>
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check-circle text-danger me-2"></i>
                                    <strong>Dampak Sosial:</strong>
                                    <span class="text-muted">Pengaruh terhadap kehidupan sosial</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Table (Screen Only) -->
    <div class="card shadow-sm screen-only">
        <div class="card-header bg-white border-bottom">
            <h5 class="mb-0 fw-bold">Data Responden Detail</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table id="dataTable" class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">No</th>
                            <th width="12%">Tanggal</th>
                            <th width="20%">Nama</th>
                            <th width="23%">Email</th>
                            <th width="10%" class="text-center">Skor</th>
                            <th width="15%" class="text-center">Kategori Risiko</th>
                            <th width="15%" class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($data['details'])): ?>
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <i class="fas fa-inbox fa-3x text-muted mb-3 d-block"></i>
                                    <p class="text-muted">Belum ada data pada periode ini</p>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php
                            $no = 1;
                            foreach ($data['details'] as $row):
                                $badgeClass = '';
                                $kategori = '';
                                if ($row['risk_level'] == 'Bahaya') {
                                    $badgeClass = 'bg-danger text-white';
                                    $kategori = 'Kritis';
                                } elseif ($row['risk_level'] == 'Tinggi') {
                                    $badgeClass = 'bg-warning text-dark';
                                    $kategori = 'Perlu Perhatian';
                                } elseif ($row['risk_level'] == 'Sedang') {
                                    $badgeClass = 'bg-info text-white';
                                    $kategori = 'Monitoring';
                                } else {
                                    $badgeClass = 'bg-success text-white';
                                    $kategori = 'Normal';
                                }
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td>
                                        <div><?= date('d M Y', strtotime($row['created_at'])) ?></div>
                                        <small class="text-muted"><?= date('H:i', strtotime($row['created_at'])) ?> WIB</small>
                                    </td>
                                    <td><strong><?= htmlspecialchars($row['name']) ?></strong></td>
                                    <td><?= htmlspecialchars($row['email']) ?></td>
                                    <td class="text-center">
                                        <span class="badge bg-dark"><?= $row['total_score'] ?>/40</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge <?= $badgeClass ?>">
                                            <?= htmlspecialchars($row['risk_level']) ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <small class="text-muted"><?= $kategori ?></small>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- STRUKTUR LAPORAN PRINT (Hanya muncul saat print) -->
    <div class="print-only">

        <!-- Header Laporan -->
        <div class="text-center mb-4">
            <h2 class="fw-bold mb-2">LAPORAN ANALISIS RISIKO PERJUDIAN</h2>
            <h5 class="text-muted mb-3">Analisis Data Responden dan Faktor Kecanduan Judi</h5>
            <p class="mb-1"><strong>Periode:</strong> <?= date('d M Y', strtotime($data['filter']['start'])) ?> s/d <?= date('d M Y', strtotime($data['filter']['end'])) ?></p>
            <?php if ($data['filter']['risk'] != 'All'): ?>
                <p><strong>Filter:</strong> Kategori Risiko <?= $data['filter']['risk'] ?></p>
            <?php endif; ?>
            <hr style="border-top: 2px solid #000;">
        </div>

        <!-- I. RINGKASAN EKSEKUTIF -->
        <div class="section-title-print">I. RINGKASAN EKSEKUTIF</div>
        <table class="table table-bordered mb-4" style="width: 100%;">
            <tbody>
                <tr>
                    <td width="50%" style="padding: 8px;"><strong>Total Responden</strong></td>
                    <td width="50%" style="padding: 8px;"><strong><?= $data['summary']['total'] ?> orang</strong></td>
                </tr>
                <tr>
                    <td style="padding: 8px;"><strong>Kasus Kritis (Tinggi & Bahaya)</strong></td>
                    <td style="padding: 8px;"><strong style="color: #dc3545;"><?= $data['summary']['critical'] ?> orang (<?= $data['summary']['total'] > 0 ? number_format(($data['summary']['critical'] / $data['summary']['total']) * 100, 1) : 0 ?>%)</strong></td>
                </tr>
                <tr>
                    <td style="padding: 8px;"><strong>Rata-rata Skor Risiko</strong></td>
                    <td style="padding: 8px;"><strong><?= $data['summary']['avg_score'] ?> dari 40 poin</strong></td>
                </tr>
            </tbody>
        </table>

        <!-- II. ANALISIS DISTRIBUSI RISIKO -->
        <div class="section-title-print">II. ANALISIS DISTRIBUSI RISIKO RESPONDEN</div>
        <table class="table table-bordered mb-4" style="width: 100%;">
            <thead style="background-color: #f8f9fa;">
                <tr>
                    <th width="10%" style="padding: 8px; text-align: center;">No</th>
                    <th width="40%" style="padding: 8px;">Kategori Risiko</th>
                    <th width="25%" style="padding: 8px; text-align: center;">Jumlah Responden</th>
                    <th width="25%" style="padding: 8px; text-align: center;">Persentase</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $total_dist = array_sum(array_column($data['distribution'], 'total'));
                foreach ($data['distribution'] as $dist):
                    $pct = $total_dist > 0 ? ($dist['total'] / $total_dist * 100) : 0;
                ?>
                    <tr>
                        <td style="padding: 8px; text-align: center;"><?= $no++ ?></td>
                        <td style="padding: 8px;"><strong><?= htmlspecialchars($dist['risk_level']) ?></strong></td>
                        <td style="padding: 8px; text-align: center;"><?= $dist['total'] ?> orang</td>
                        <td style="padding: 8px; text-align: center;"><?= number_format($pct, 1) ?>%</td>
                    </tr>
                <?php endforeach; ?>
                <tr style="background-color: #f8f9fa;">
                    <td colspan="2" style="padding: 8px;"><strong>TOTAL</strong></td>
                    <td style="padding: 8px; text-align: center;"><strong><?= $total_dist ?> orang</strong></td>
                    <td style="padding: 8px; text-align: center;"><strong>100%</strong></td>
                </tr>
            </tbody>
        </table>

        <!-- III. ANALISIS FAKTOR KECANDUAN -->
        <div class="section-title-print">III. ANALISIS FAKTOR RISIKO KECANDUAN</div>
        <div class="mb-4">
            <p style="margin-bottom: 15px;">Berdasarkan hasil assessment, faktor-faktor utama yang mempengaruhi tingkat risiko kecanduan judi pada responden adalah:</p>

            <table class="table table-bordered" style="width: 100%;">
                <thead style="background-color: #f8f9fa;">
                    <tr>
                        <th width="5%" style="padding: 8px; text-align: center;">No</th>
                        <th width="30%" style="padding: 8px;">Faktor Risiko</th>
                        <th width="65%" style="padding: 8px;">Deskripsi & Dampak</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="padding: 8px; text-align: center;">1</td>
                        <td style="padding: 8px;"><strong>Frekuensi Bermain</strong></td>
                        <td style="padding: 8px;">Tingkat keseringan melakukan aktivitas judi. Semakin tinggi frekuensi, semakin besar risiko kecanduan.</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px; text-align: center;">2</td>
                        <td style="padding: 8px;"><strong>Kontrol Diri</strong></td>
                        <td style="padding: 8px;">Kemampuan responden untuk menghentikan atau membatasi aktivitas judi. Kontrol diri rendah menunjukkan risiko tinggi.</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px; text-align: center;">3</td>
                        <td style="padding: 8px;"><strong>Dampak Finansial</strong></td>
                        <td style="padding: 8px;">Kerugian ekonomi yang dialami akibat aktivitas judi, termasuk hutang dan masalah keuangan.</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px; text-align: center;">4</td>
                        <td style="padding: 8px;"><strong>Dampak Sosial & Psikologis</strong></td>
                        <td style="padding: 8px;">Pengaruh terhadap hubungan sosial, pekerjaan, dan kesehatan mental responden.</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="page-break"></div>

        <!-- IV. KASUS KRITIS -->
        <?php
        $kasusKritis = array_filter($data['details'], function ($item) {
            return $item['risk_level'] == 'Bahaya' || $item['risk_level'] == 'Tinggi';
        });
        ?>
        <?php if (!empty($kasusKritis)): ?>
            <div class="section-title-print" style="color: #dc3545; border-left-color: #dc3545;">IV. DAFTAR KASUS BERISIKO TINGGI & BAHAYA</div>
            <p style="margin-bottom: 15px;"><strong style="color: #dc3545;">PERHATIAN:</strong> <?= count($kasusKritis) ?> responden memerlukan tindak lanjut segera</p>
            <table class="table table-bordered mb-4" style="width: 100%; font-size: 9pt;">
                <thead style="background-color: #f8f9fa;">
                    <tr>
                        <th width="5%" style="padding: 6px; text-align: center;">No</th>
                        <th width="12%" style="padding: 6px;">Tanggal</th>
                        <th width="23%" style="padding: 6px;">Nama</th>
                        <th width="25%" style="padding: 6px;">Email</th>
                        <th width="10%" style="padding: 6px; text-align: center;">Skor</th>
                        <th width="12%" style="padding: 6px; text-align: center;">Kategori</th>
                        <th width="13%" style="padding: 6px;">Tindak Lanjut</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($kasusKritis as $row):
                    ?>
                        <tr>
                            <td style="padding: 6px; text-align: center;"><?= $no++ ?></td>
                            <td style="padding: 6px;"><?= date('d/m/Y', strtotime($row['created_at'])) ?></td>
                            <td style="padding: 6px;"><?= htmlspecialchars($row['name']) ?></td>
                            <td style="padding: 6px;"><?= htmlspecialchars($row['email']) ?></td>
                            <td style="padding: 6px; text-align: center;"><strong><?= $row['total_score'] ?></strong></td>
                            <td style="padding: 6px; text-align: center;"><strong><?= htmlspecialchars($row['risk_level']) ?></strong></td>
                            <td style="padding: 6px;">Konseling Segera</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php
            $dataSection = 'V';
        else:
            $dataSection = 'IV';
        endif;
        ?>

        <div class="page-break"></div>

        <!-- V. DATA LENGKAP -->
        <div class="section-title-print"><?= $dataSection ?>. DATA LENGKAP RESPONDEN</div>
        <table class="table table-bordered mb-4" style="width: 100%; font-size: 9pt;">
            <thead style="background-color: #f8f9fa;">
                <tr>
                    <th width="5%" style="padding: 6px; text-align: center;">No</th>
                    <th width="10%" style="padding: 6px;">Tanggal</th>
                    <th width="20%" style="padding: 6px;">Nama</th>
                    <th width="23%" style="padding: 6px;">Email</th>
                    <th width="8%" style="padding: 6px; text-align: center;">Skor</th>
                    <th width="12%" style="padding: 6px; text-align: center;">Kategori</th>
                    <th width="12%" style="padding: 6px; text-align: center;">Status</th>
                    <th width="10%" style="padding: 6px;">Tindakan</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($data['details'])): ?>
                    <tr>
                        <td colspan="8" style="padding: 20px; text-align: center;">Tidak ada data pada periode ini</td>
                    </tr>
                <?php else: ?>
                    <?php
                    $no = 1;
                    foreach ($data['details'] as $row):
                        $kategori = '';
                        $tindakan = '';
                        if ($row['risk_level'] == 'Bahaya') {
                            $kategori = 'Kritis';
                            $tindakan = 'Konseling';
                        } elseif ($row['risk_level'] == 'Tinggi') {
                            $kategori = 'Perlu Perhatian';
                            $tindakan = 'Edukasi';
                        } elseif ($row['risk_level'] == 'Sedang') {
                            $kategori = 'Monitoring';
                            $tindakan = 'Pemantauan';
                        } else {
                            $kategori = 'Normal';
                            $tindakan = '-';
                        }
                    ?>
                        <tr>
                            <td style="padding: 6px; text-align: center;"><?= $no++ ?></td>
                            <td style="padding: 6px;"><?= date('d/m/Y', strtotime($row['created_at'])) ?></td>
                            <td style="padding: 6px;"><?= htmlspecialchars($row['name']) ?></td>
                            <td style="padding: 6px;"><?= htmlspecialchars($row['email']) ?></td>
                            <td style="padding: 6px; text-align: center;"><?= $row['total_score'] ?></td>
                            <td style="padding: 6px; text-align: center;"><?= htmlspecialchars($row['risk_level']) ?></td>
                            <td style="padding: 6px; text-align: center;"><?= $kategori ?></td>
                            <td style="padding: 6px;"><?= $tindakan ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="page-break"></div>

        <!-- VI. KESIMPULAN -->
        <?php
        $kesimpulanSection = !empty($kasusKritis) ? 'VI' : 'V';
        ?>
        <div class="section-title-print"><?= $kesimpulanSection ?>. KESIMPULAN DAN REKOMENDASI</div>
        <div style="margin-bottom: 30px;">
            <h6 style="font-weight: bold; margin-bottom: 10px;">A. Kesimpulan:</h6>
            <ol style="line-height: 1.8;">
                <li>Total <strong><?= $data['summary']['total'] ?> responden</strong> telah melakukan assessment risiko kecanduan judi pada periode ini.</li>
                <li>Terdapat <strong style="color: #dc3545;"><?= $data['summary']['critical'] ?> responden (<?= $data['summary']['total'] > 0 ? number_format(($data['summary']['critical'] / $data['summary']['total']) * 100, 1) : 0 ?>%)</strong> yang termasuk kategori risiko <strong>Tinggi dan Bahaya</strong> yang memerlukan penanganan segera.</li>
                <li>Rata-rata skor risiko adalah <strong><?= $data['summary']['avg_score'] ?> poin dari skala 40</strong>, menunjukkan tingkat risiko keseluruhan responden.</li>
                <li>Faktor utama yang mempengaruhi tingkat kecanduan adalah frekuensi bermain, kontrol diri, dampak finansial, dan dampak sosial-psikologis.</li>
            </ol>

            <h6 style="font-weight: bold; margin-bottom: 10px; margin-top: 20px;">B. Rekomendasi Tindak Lanjut:</h6>
            <ol style="line-height: 1.8;">
                <li><strong>Kategori Bahaya:</strong> Memerlukan intervensi psikologis dan konseling segera oleh profesional.</li>
                <li><strong>Kategori Tinggi:</strong> Perlu monitoring intensif dan program edukasi tentang bahaya judi.</li>
                <li><strong>Kategori Sedang:</strong> Lakukan pemantauan berkala dan berikan edukasi preventif.</li>
                <li><strong>Kategori Rendah:</strong> Tetap lakukan awareness dan edukasi umum tentang bahaya judi.</li>
                <li><strong>Program Preventif:</strong> Tingkatkan program awareness dan kampanye anti-judi di lingkungan target.</li>
                <li><strong>Evaluasi Berkala:</strong> Lakukan assessment ulang secara periodik untuk memantau perkembangan.</li>
            </ol>
        </div>

        <!-- Tanda Tangan -->
        <div style="margin-top: 50px; page-break-inside: avoid;">
            <table style="width: 100%; border: none !important;">
                <tr>
                    <td width="50%" style="border: none !important; vertical-align: top; padding: 10px;">
                        <p style="margin-bottom: 5px;">Mengetahui,</p>
                        <p style="margin-bottom: 0; margin-top: 70px;">________________________</p>
                        <p style="margin-bottom: 0; margin-top: 5px;"><strong>Kepala Divisi</strong></p>
                    </td>
                    <td width="50%" style="border: none !important; vertical-align: top; text-align: right; padding: 10px;">
                        <p style="margin-bottom: 5px;"><?= date('d F Y') ?></p>
                        <p style="margin-bottom: 0; margin-top: 70px;">________________________</p>
                        <p style="margin-bottom: 0; margin-top: 5px;"><strong>Administrator</strong></p>
                    </td>
                </tr>
            </table>
        </div>
    </div>

</div>

<link rel="stylesheet" href="/sigma/public/css/analysis.css">

<!-- SheetJS for Excel Export -->
<script src="https://cdn.sheetjs.com/xlsx-0.20.1/package/dist/xlsx.full.min.js"></script>
<script>
    function printReport() {
        // Ambil konten print-only
        const printContent = document.querySelector('.print-only').innerHTML;

        // Buka window baru
        const printWindow = window.open('', '_blank', 'width=900,height=650');

        // Tulis konten ke window baru
        printWindow.document.write(`
            <!DOCTYPE html>
            <html>
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title></title>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
                <style>
                    * {
                        -webkit-print-color-adjust: exact !important;
                        print-color-adjust: exact !important;
                    }
                    body {
                        padding: 20px;
                        font-family: Arial, sans-serif;
                        font-size: 11pt;
                    }
                    table {
                        width: 100%;
                        border-collapse: collapse;
                        margin-bottom: 20px;
                    }
                    th, td {
                        border: 1px solid #000;
                        padding: 8px;
                    }
                    .table-bordered th,
                    .table-bordered td {
                        border: 1px solid #000;
                    }
                    .section-title-print {
                        background: #f0f0f0;
                        border-left: 4px solid #000;
                        padding: 10px;
                        margin: 20px 0 10px 0;
                        font-weight: bold;
                        font-size: 12pt;
                    }
                    .page-break {
                        page-break-before: always;
                    }
                    @page {
                        margin: 20mm;
                        size: A4;
                    }
                    @media print {
                        html, body {
                            height: 100%;
                            margin: 0 !important;
                            padding: 0 !important;
                        }
                        @page {
                            margin: 20mm;
                        }
                        .page-break {
                            page-break-before: always;
                        }
                    }
                </style>
            </head>
            <body>
                ${printContent}
                <script>
                    // Kosongkan title sebelum print
                    document.title = '';
                    
                    window.onload = function() {
                        // Tunggu sebentar agar render selesai
                        setTimeout(function() {
                            window.print();
                        }, 500);
                    };
                <\/script>
            </body>
            </html>
        `);

        printWindow.document.close();
    }

    function exportToExcel() {
        const wb = XLSX.utils.book_new();

        // Sheet 1: Ringkasan
        const summaryData = [
            ['LAPORAN ANALISIS RISIKO PERJUDIAN'],
            ['Periode', '<?= date('d M Y', strtotime($data['filter']['start'])) ?> s/d <?= date('d M Y', strtotime($data['filter']['end'])) ?>'],
            <?php if ($data['filter']['risk'] != 'All'): ?>['Filter', 'Kategori Risiko: <?= $data['filter']['risk'] ?>'], <?php endif; ?>[''],
            ['RINGKASAN EKSEKUTIF'],
            ['Total Responden', <?= $data['summary']['total'] ?>],
            ['Kasus Kritis', <?= $data['summary']['critical'] ?>],
            ['Persentase Kritis', '<?= $data['summary']['total'] > 0 ? number_format(($data['summary']['critical'] / $data['summary']['total']) * 100, 1) : 0 ?>%'],
            ['Rata-rata Skor', <?= $data['summary']['avg_score'] ?>],
            [''],
            ['DISTRIBUSI RISIKO'],
            ['Kategori', 'Jumlah', 'Persentase'],
            <?php
            $total_dist = array_sum(array_column($data['distribution'], 'total'));
            foreach ($data['distribution'] as $dist):
                $pct = $total_dist > 0 ? ($dist['total'] / $total_dist * 100) : 0;
            ?>['<?= $dist['risk_level'] ?>', <?= $dist['total'] ?>, '<?= number_format($pct, 1) ?>%'],
            <?php endforeach; ?>
        ];
        const ws1 = XLSX.utils.aoa_to_sheet(summaryData);
        XLSX.utils.book_append_sheet(wb, ws1, 'Ringkasan');

        <?php if (!empty($kasusKritis)): ?>
            // Sheet 2: Kasus Kritis
            const kritisData = [
                ['DAFTAR KASUS BERISIKO TINGGI & BAHAYA'],
                ['Total Kasus: <?= count($kasusKritis) ?>'],
                [''],
                ['No', 'Tanggal', 'Nama', 'Email', 'Skor', 'Kategori', 'Tindak Lanjut'],
                <?php
                $no = 1;
                foreach ($kasusKritis as $row):
                ?>[<?= $no++ ?>, '<?= date('d/m/Y H:i', strtotime($row['created_at'])) ?>', '<?= addslashes(htmlspecialchars($row['name'])) ?>', '<?= htmlspecialchars($row['email']) ?>', <?= $row['total_score'] ?>, '<?= $row['risk_level'] ?>', 'Konseling Segera'],
                <?php endforeach; ?>
            ];
            const ws2 = XLSX.utils.aoa_to_sheet(kritisData);
            XLSX.utils.book_append_sheet(wb, ws2, 'Kasus Kritis');
        <?php endif; ?>

        // Sheet 3: Data Lengkap
        const fullData = [
            ['DATA LENGKAP RESPONDEN'],
            ['Total: <?= count($data['details']) ?> Responden'],
            [''],
            ['No', 'Tanggal', 'Nama', 'Email', 'Skor', 'Kategori', 'Status', 'Tindakan'],
            <?php
            $no = 1;
            foreach ($data['details'] as $row):
                $kategori = '';
                $tindakan = '';
                if ($row['risk_level'] == 'Bahaya') {
                    $kategori = 'Kritis';
                    $tindakan = 'Konseling';
                } elseif ($row['risk_level'] == 'Tinggi') {
                    $kategori = 'Perlu Perhatian';
                    $tindakan = 'Edukasi';
                } elseif ($row['risk_level'] == 'Sedang') {
                    $kategori = 'Monitoring';
                    $tindakan = 'Pemantauan';
                } else {
                    $kategori = 'Normal';
                    $tindakan = '-';
                }
            ?>[<?= $no++ ?>, '<?= date('d/m/Y H:i', strtotime($row['created_at'])) ?>', '<?= addslashes(htmlspecialchars($row['name'])) ?>', '<?= htmlspecialchars($row['email']) ?>', <?= $row['total_score'] ?>, '<?= $row['risk_level'] ?>', '<?= $kategori ?>', '<?= $tindakan ?>'],
            <?php endforeach; ?>
        ];
        const ws3 = XLSX.utils.aoa_to_sheet(fullData);
        XLSX.utils.book_append_sheet(wb, ws3, 'Data Lengkap');

        // Download
        const filename = 'Laporan_Analisis_Risiko_<?= date('Ymd', strtotime($data['filter']['start'])) ?>_<?= date('Ymd', strtotime($data['filter']['end'])) ?>.xlsx';
        XLSX.writeFile(wb, filename);
    }
</script>