<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10pt;
            line-height: 1.4;
            color: #000;
        }

        h1 {
            text-align: center;
            font-size: 16pt;
            margin-bottom: 5px;
        }

        h2 {
            font-size: 12pt;
            background: #f0f0f0;
            padding: 8px;
            border-left: 4px solid #009d63;
            margin-top: 20px;
            margin-bottom: 10px;
        }

        h3 {
            text-align: center;
            font-size: 11pt;
            color: #666;
            margin-top: 0;
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px 8px;
            text-align: left;
        }

        th {
            background: #f0f0f0;
            font-weight: bold;
        }

        .text-center {
            text-align: center;
        }

        .text-danger {
            color: #dc2626;
        }

        .periode {
            text-align: center;
            margin-bottom: 20px;
            font-size: 10pt;
        }

        .rekomendasi {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 10px;
            margin-top: 15px;
            font-size: 9pt;
        }

        .rekomendasi ul,
        .rekomendasi ol {
            margin: 5px 0;
            padding-left: 20px;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>
    <h1>LAPORAN ANALISIS RISIKO PERJUDIAN</h1>
    <h3>Analisis Mendalam Faktor Risiko dan Tren Kecanduan Judi</h3>
    <div class="periode">
        <strong>Periode:</strong> <?= date('d M Y', strtotime($startDate)) ?> s/d <?= date('d M Y', strtotime($endDate)) ?>
        <?php if ($userName): ?>
            <br><strong>Responden:</strong> <?= htmlspecialchars($userName) ?>
        <?php endif; ?>
        <?php if ($riskFilter != 'All'): ?>
            <br><strong>Filter:</strong> Kategori Risiko <?= htmlspecialchars($riskFilter) ?>
        <?php endif; ?>
    </div>

    <h2>I. RINGKASAN EKSEKUTIF</h2>
    <table>
        <tr>
            <td width="50%"><strong>Total Responden</strong></td>
            <td width="50%"><strong><?= $summary['total'] ?> orang</strong></td>
        </tr>
        <tr>
            <td><strong>Kasus Berisiko Tinggi/Bahaya</strong></td>
            <td><strong class="text-danger"><?= $summary['critical'] ?> orang (<?= $summary['total'] > 0 ? number_format(($summary['critical'] / $summary['total']) * 100, 1) : 0 ?>%)</strong></td>
        </tr>
        <tr>
            <td><strong>Rata-rata Skor Risiko</strong></td>
            <td><strong><?= $summary['avg_score'] ?> dari 40 poin</strong></td>
        </tr>
    </table>

    <h2>II. DISTRIBUSI KATEGORI RISIKO</h2>
    <table>
        <thead>
            <tr>
                <th width="40%">Kategori Risiko</th>
                <th width="30%" class="text-center">Jumlah</th>
                <th width="30%" class="text-center">Persentase</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $total_dist = array_sum(array_column($distribution, 'total'));
            foreach ($distribution as $dist):
                $pct = $total_dist > 0 ? ($dist['total'] / $total_dist * 100) : 0;
            ?>
                <tr>
                    <td><?= htmlspecialchars($dist['risk_level']) ?></td>
                    <td class="text-center"><?= $dist['total'] ?> orang</td>
                    <td class="text-center"><?= number_format($pct, 1) ?>%</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php
    // Identifikasi kasus kritis
    $kasusKritis = array_filter($details, function ($row) {
        return $row['risk_level'] == 'Bahaya' || $row['risk_level'] == 'Tinggi';
    });
    ?>

    <?php if (!empty($kasusKritis)): ?>
        <h2>III. KASUS BERISIKO TINGGI & BAHAYA</h2>
        <table>
            <thead>
                <tr>
                    <th width="5%" class="text-center">No</th>
                    <th width="12%">Tanggal</th>
                    <th width="20%">Nama</th>
                    <th width="25%">Email</th>
                    <th width="10%" class="text-center">Skor</th>
                    <th width="13%" class="text-center">Kategori</th>
                    <th width="15%">Tindak Lanjut</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($kasusKritis as $row):
                ?>
                    <tr>
                        <td class="text-center"><?= $no++ ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($row['created_at'])) ?></td>
                        <td><?= htmlspecialchars($row['name']) ?></td>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                        <td class="text-center"><?= $row['total_score'] ?></td>
                        <td class="text-center"><?= htmlspecialchars($row['risk_level']) ?></td>
                        <td>Konseling Segera</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <h2 style="margin-top: 25px;"><?= !empty($kasusKritis) ? 'IV' : 'III' ?>. DATA LENGKAP RESPONDEN</h2>
    <table>
        <thead>
            <tr>
                <th width="4%" class="text-center">No</th>
                <th width="10%">Tanggal</th>
                <th width="18%">Nama</th>
                <th width="22%">Email</th>
                <th width="8%" class="text-center">Skor</th>
                <th width="12%" class="text-center">Kategori</th>
                <th width="13%" class="text-center">Status</th>
                <th width="13%">Tindakan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($details as $row):
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
                    <td class="text-center"><?= $no++ ?></td>
                    <td><?= date('d/m/Y', strtotime($row['created_at'])) ?></td>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td><?= htmlspecialchars($row['email']) ?></td>
                    <td class="text-center"><?= $row['total_score'] ?></td>
                    <td class="text-center"><?= htmlspecialchars($row['risk_level']) ?></td>
                    <td class="text-center"><?= $kategori ?></td>
                    <td><?= $tindakan ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2><?= !empty($kasusKritis) ? 'V' : 'IV' ?>. KESIMPULAN DAN REKOMENDASI</h2>

    <div class="rekomendasi">
        <strong>A. Kesimpulan:</strong>
        <ol>
            <li>Total <strong><?= $summary['total'] ?> responden</strong> telah melakukan assessment risiko kecanduan judi pada periode ini.</li>
            <li>Terdapat <strong class="text-danger"><?= $summary['critical'] ?> responden (<?= $summary['total'] > 0 ? number_format(($summary['critical'] / $summary['total']) * 100, 1) : 0 ?>%)</strong> yang termasuk kategori risiko <strong>Tinggi dan Bahaya</strong> yang memerlukan penanganan segera.</li>
            <li>Rata-rata skor risiko adalah <strong><?= $summary['avg_score'] ?> poin dari skala 40</strong>, menunjukkan tingkat risiko keseluruhan responden.</li>
            <li>Faktor utama yang mempengaruhi tingkat kecanduan adalah frekuensi bermain, kontrol diri, dampak finansial, dan dampak sosial-psikologis.</li>
        </ol>

        <strong>B. Rekomendasi Tindak Lanjut:</strong>
        <ol>
            <li><strong>Kategori Bahaya:</strong> Memerlukan intervensi psikologis dan konseling segera oleh profesional.</li>
            <li><strong>Kategori Tinggi:</strong> Perlu monitoring intensif dan program edukasi tentang bahaya judi.</li>
            <li><strong>Kategori Sedang:</strong> Lakukan pemantauan berkala dan berikan edukasi preventif.</li>
            <li><strong>Kategori Rendah:</strong> Tetap lakukan awareness dan edukasi umum tentang bahaya judi.</li>
            <li><strong>Program Preventif:</strong> Tingkatkan program awareness dan kampanye anti-judi di lingkungan target.</li>
            <li><strong>Evaluasi Berkala:</strong> Lakukan assessment ulang secara periodik untuk memantau perkembangan.</li>
        </ol>
    </div>
</body>

</html>