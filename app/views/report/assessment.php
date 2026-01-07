<style>
    @media print {
        * {
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        body {
            background: white !important;
            color: #000 !important;
            font-size: 11pt !important;
            margin: 0;
            padding: 15mm !important;
        }

        .container-fluid {
            padding: 0 !important;
            margin: 0 !important;
            max-width: 100% !important;
        }

        .no-print,
        .sidebar,
        .navbar,
        nav,
        header,
        .btn,
        button {
            display: none !important;
        }

        .screen-only {
            display: none !important;
        }

        .print-only {
            display: block !important;
        }

        table {
            width: 100% !important;
            border-collapse: collapse !important;
            page-break-inside: auto !important;
            font-size: 10pt !important;
        }

        tr {
            page-break-inside: avoid !important;
            page-break-after: auto !important;
        }

        thead {
            display: table-header-group !important;
        }

        th,
        td {
            padding: 6px 8px !important;
            border: 1px solid #000 !important;
        }

        .table-bordered {
            border: 1px solid #000 !important;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #000 !important;
        }

        .page-break {
            page-break-before: always !important;
        }
    }

    .print-only {
        display: none;
    }
</style>

<div class="container-fluid py-4">

    <!-- Header & Filter -->
    <div class="row mb-4 no-print">
        <div class="col-md-12">
            <h2 class="fw-bold mb-1">Laporan Assessment Responden</h2>
            <p class="text-muted">Laporan lengkap hasil assessment risiko kecanduan judi</p>
        </div>
    </div>

    <!-- Filter Card -->
    <div class="card shadow-sm mb-4 no-print">
        <div class="card-body">
            <form method="GET" action="index.php" class="row g-3">
                <input type="hidden" name="url" value="report/assessment">
                <div class="col-md-3">
                    <label class="form-label small fw-semibold">Dari Tanggal</label>
                    <input type="date" name="start" class="form-control form-control-sm" value="<?= $data['filter']['start'] ?>">
                </div>
                <div class="col-md-3">
                    <label class="form-label small fw-semibold">Sampai Tanggal</label>
                    <input type="date" name="end" class="form-control form-control-sm" value="<?= $data['filter']['end'] ?>">
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
                        <button type="submit" class="btn btn-primary btn-sm">
                            <i class="fas fa-search"></i> Tampilkan
                        </button>
                        <button type="button" onclick="window.print()" class="btn btn-secondary btn-sm">
                            <i class="fas fa-print"></i> Print PDF
                        </button>
                        <button type="button" onclick="exportToExcel()" class="btn btn-success btn-sm">
                            <i class="fas fa-file-excel"></i> Export Excel
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Summary Cards (Screen Only) -->
    <div class="row mb-4 screen-only">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm" style="border-left: 4px solid #0d6efd !important;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted small mb-1">Total Assessment</p>
                            <h3 class="fw-bold mb-0"><?= $data['summary']['total'] ?></h3>
                        </div>
                        <div class="text-primary">
                            <i class="fas fa-clipboard-check fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm" style="border-left: 4px solid #dc3545 !important;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted small mb-1">Kasus Kritis</p>
                            <h3 class="fw-bold mb-0 text-danger"><?= $data['summary']['critical'] ?></h3>
                        </div>
                        <div class="text-danger">
                            <i class="fas fa-exclamation-triangle fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm" style="border-left: 4px solid #28a745 !important;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <p class="text-muted small mb-1">Rata-rata Skor</p>
                            <h3 class="fw-bold mb-0"><?= $data['summary']['avg_score'] ?></h3>
                        </div>
                        <div class="text-success">
                            <i class="fas fa-chart-line fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Table (Screen Only) -->
    <div class="card shadow-sm screen-only">
        <div class="card-header bg-white border-bottom">
            <h5 class="mb-0 fw-bold">Data Assessment Responden</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="5%">No</th>
                            <th width="15%">Tanggal</th>
                            <th width="20%">Nama</th>
                            <th width="25%">Email</th>
                            <th width="10%" class="text-center">Skor</th>
                            <th width="15%" class="text-center">Kategori Risiko</th>
                            <th width="10%" class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($data['details'])): ?>
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <i class="fas fa-inbox fa-3x text-muted mb-3 d-block"></i>
                                    <p class="text-muted">Belum ada data assessment pada periode ini</p>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php
                            $no = 1;
                            foreach ($data['details'] as $row):
                                $badgeClass = '';
                                $status = '';
                                if ($row['risk_level'] == 'Bahaya') {
                                    $badgeClass = 'bg-danger text-white';
                                    $status = 'Kritis';
                                } elseif ($row['risk_level'] == 'Tinggi') {
                                    $badgeClass = 'bg-warning text-dark';
                                    $status = 'Perlu Perhatian';
                                } elseif ($row['risk_level'] == 'Sedang') {
                                    $badgeClass = 'bg-info text-white';
                                    $status = 'Monitoring';
                                } else {
                                    $badgeClass = 'bg-success text-white';
                                    $status = 'Normal';
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
                                        <small class="text-muted"><?= $status ?></small>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- STRUKTUR LAPORAN PRINT -->
    <div class="print-only">

        <!-- Header Laporan -->
        <div style="text-align: center; margin-bottom: 30px;">
            <h2 style="font-weight: bold; margin-bottom: 10px;">LAPORAN ASSESSMENT RESPONDEN</h2>
            <h5 style="color: #666; margin-bottom: 15px;">Data Hasil Assessment Risiko Kecanduan Judi</h5>
            <p style="margin-bottom: 5px;"><strong>Periode:</strong> <?= date('d M Y', strtotime($data['filter']['start'])) ?> s/d <?= date('d M Y', strtotime($data['filter']['end'])) ?></p>
            <?php if ($data['filter']['risk'] != 'All'): ?>
                <p><strong>Filter:</strong> Kategori Risiko <?= $data['filter']['risk'] ?></p>
            <?php endif; ?>
            <hr style="border-top: 2px solid #000; margin-top: 20px;">
        </div>

        <!-- Ringkasan -->
        <div style="margin-bottom: 30px;">
            <h4 style="font-weight: bold; margin-bottom: 15px; background-color: #f0f0f0; padding: 10px; border-left: 4px solid #000;">RINGKASAN</h4>
            <table class="table table-bordered" style="width: 100%;">
                <tbody>
                    <tr>
                        <td width="50%" style="padding: 8px;"><strong>Total Assessment</strong></td>
                        <td width="50%" style="padding: 8px;"><strong><?= $data['summary']['total'] ?> data</strong></td>
                    </tr>
                    <tr>
                        <td style="padding: 8px;"><strong>Kasus Kritis (Tinggi & Bahaya)</strong></td>
                        <td style="padding: 8px;"><strong style="color: #dc3545;"><?= $data['summary']['critical'] ?> data (<?= $data['summary']['total'] > 0 ? number_format(($data['summary']['critical'] / $data['summary']['total']) * 100, 1) : 0 ?>%)</strong></td>
                    </tr>
                    <tr>
                        <td style="padding: 8px;"><strong>Rata-rata Skor</strong></td>
                        <td style="padding: 8px;"><strong><?= $data['summary']['avg_score'] ?> dari 40 poin</strong></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Tabel Data Assessment -->
        <div style="margin-bottom: 30px;">
            <h4 style="font-weight: bold; margin-bottom: 15px; background-color: #f0f0f0; padding: 10px; border-left: 4px solid #000;">DATA ASSESSMENT</h4>
            <table class="table table-bordered" style="width: 100%; font-size: 9pt;">
                <thead style="background-color: #f8f9fa;">
                    <tr>
                        <th width="5%" style="padding: 6px; text-align: center;">No</th>
                        <th width="12%" style="padding: 6px;">Tanggal</th>
                        <th width="20%" style="padding: 6px;">Nama</th>
                        <th width="25%" style="padding: 6px;">Email</th>
                        <th width="10%" style="padding: 6px; text-align: center;">Skor</th>
                        <th width="13%" style="padding: 6px; text-align: center;">Kategori</th>
                        <th width="15%" style="padding: 6px; text-align: center;">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($data['details'])): ?>
                        <tr>
                            <td colspan="7" style="padding: 20px; text-align: center;">Tidak ada data pada periode ini</td>
                        </tr>
                    <?php else: ?>
                        <?php
                        $no = 1;
                        foreach ($data['details'] as $row):
                            $status = '';
                            if ($row['risk_level'] == 'Bahaya') {
                                $status = 'Kritis - Butuh Konseling';
                            } elseif ($row['risk_level'] == 'Tinggi') {
                                $status = 'Perlu Perhatian';
                            } elseif ($row['risk_level'] == 'Sedang') {
                                $status = 'Monitoring Rutin';
                            } else {
                                $status = 'Normal';
                            }
                        ?>
                            <tr>
                                <td style="padding: 6px; text-align: center;"><?= $no++ ?></td>
                                <td style="padding: 6px;"><?= date('d/m/Y H:i', strtotime($row['created_at'])) ?></td>
                                <td style="padding: 6px;"><?= htmlspecialchars($row['name']) ?></td>
                                <td style="padding: 6px;"><?= htmlspecialchars($row['email']) ?></td>
                                <td style="padding: 6px; text-align: center;"><strong><?= $row['total_score'] ?>/40</strong></td>
                                <td style="padding: 6px; text-align: center;"><strong><?= htmlspecialchars($row['risk_level']) ?></strong></td>
                                <td style="padding: 6px; text-align: center;"><?= $status ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Catatan -->
        <div style="margin-top: 40px; margin-bottom: 40px; padding: 15px; background-color: #f8f9fa; border-left: 4px solid #0d6efd;">
            <h6 style="font-weight: bold; margin-bottom: 10px;">Catatan:</h6>
            <ul style="line-height: 1.8; margin-bottom: 0;">
                <li><strong>Kategori Bahaya:</strong> Skor 31-40 - Memerlukan konseling psikologis segera</li>
                <li><strong>Kategori Tinggi:</strong> Skor 21-30 - Perlu monitoring intensif dan edukasi</li>
                <li><strong>Kategori Sedang:</strong> Skor 11-20 - Monitoring rutin dan edukasi preventif</li>
                <li><strong>Kategori Rendah:</strong> Skor 0-10 - Kondisi normal, tetap lakukan awareness</li>
            </ul>
        </div>

        <!-- Tanda Tangan -->
        <div style="margin-top: 60px; page-break-inside: avoid;">
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

<!-- SheetJS for Excel Export -->
<script src="https://cdn.sheetjs.com/xlsx-0.20.1/package/dist/xlsx.full.min.js"></script>
<script>
    function exportToExcel() {
        const wb = XLSX.utils.book_new();

        // Sheet 1: Data Assessment
        const assessmentData = [
            ['LAPORAN ASSESSMENT RESPONDEN'],
            ['Periode', '<?= date('d M Y', strtotime($data['filter']['start'])) ?> s/d <?= date('d M Y', strtotime($data['filter']['end'])) ?>'],
            <?php if ($data['filter']['risk'] != 'All'): ?>['Filter', 'Kategori: <?= $data['filter']['risk'] ?>'], <?php endif; ?>[''],
            ['RINGKASAN'],
            ['Total Assessment', <?= $data['summary']['total'] ?>],
            ['Kasus Kritis', <?= $data['summary']['critical'] ?>],
            ['Persentase Kritis', '<?= $data['summary']['total'] > 0 ? number_format(($data['summary']['critical'] / $data['summary']['total']) * 100, 1) : 0 ?>%'],
            ['Rata-rata Skor', '<?= $data['summary']['avg_score'] ?>'],
            [''],
            ['DATA ASSESSMENT'],
            ['No', 'Tanggal', 'Nama', 'Email', 'Skor', 'Kategori', 'Status'],
            <?php
            $no = 1;
            foreach ($data['details'] as $row):
                $status = '';
                if ($row['risk_level'] == 'Bahaya') $status = 'Kritis - Butuh Konseling';
                elseif ($row['risk_level'] == 'Tinggi') $status = 'Perlu Perhatian';
                elseif ($row['risk_level'] == 'Sedang') $status = 'Monitoring Rutin';
                else $status = 'Normal';
            ?>[<?= $no++ ?>, '<?= date('d/m/Y H:i', strtotime($row['created_at'])) ?>', '<?= addslashes(htmlspecialchars($row['name'])) ?>', '<?= htmlspecialchars($row['email']) ?>', '<?= $row['total_score'] ?>/40', '<?= $row['risk_level'] ?>', '<?= $status ?>'],
            <?php endforeach; ?>
        ];
        const ws1 = XLSX.utils.aoa_to_sheet(assessmentData);
        XLSX.utils.book_append_sheet(wb, ws1, 'Assessment');

        // Download
        const filename = 'Laporan_Assessment_<?= date('Ymd', strtotime($data['filter']['start'])) ?>_<?= date('Ymd', strtotime($data['filter']['end'])) ?>.xlsx';
        XLSX.writeFile(wb, filename);
    }
</script>