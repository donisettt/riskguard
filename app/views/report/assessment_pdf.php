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

        .catatan {
            background: #e3f2fd;
            border-left: 4px solid #2196F3;
            padding: 10px;
            margin-top: 15px;
            font-size: 9pt;
        }

        .catatan ul {
            margin: 5px 0;
            padding-left: 20px;
        }
    </style>
</head>

<body>
    <h1>LAPORAN ASSESSMENT RESPONDEN</h1>
    <h3>Data Hasil Assessment Risiko Kecanduan Judi</h3>
    <div class="periode">
        <strong>Periode:</strong> <?= date('d M Y', strtotime($startDate)) ?> s/d <?= date('d M Y', strtotime($endDate)) ?>
        <?php if ($userName): ?>
            <br><strong>Responden:</strong> <?= htmlspecialchars($userName) ?>
        <?php endif; ?>
        <?php if ($riskFilter != 'All'): ?>
            <br><strong>Filter:</strong> Kategori Risiko <?= htmlspecialchars($riskFilter) ?>
        <?php endif; ?>
    </div>

    <h2>RINGKASAN</h2>
    <table>
        <tr>
            <td width="50%"><strong>Total Assessment</strong></td>
            <td width="50%"><strong><?= $summary['total'] ?> data</strong></td>
        </tr>
        <tr>
            <td><strong>Kasus Kritis (Tinggi & Bahaya)</strong></td>
            <td><strong class="text-danger"><?= $summary['critical'] ?> data (<?= $summary['total'] > 0 ? number_format(($summary['critical'] / $summary['total']) * 100, 1) : 0 ?>%)</strong></td>
        </tr>
        <tr>
            <td><strong>Rata-rata Skor</strong></td>
            <td><strong><?= $summary['avg_score'] ?> dari 40 poin</strong></td>
        </tr>
    </table>

    <h2>DATA ASSESSMENT</h2>
    <table>
        <thead>
            <tr>
                <th width="5%" class="text-center">No</th>
                <th width="12%">Tanggal</th>
                <th width="20%">Nama</th>
                <th width="25%">Kategori Assessment</th>
                <th width="10%" class="text-center">Skor</th>
                <th width="13%" class="text-center">Kategori</th>
                <th width="15%" class="text-center">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($details)): ?>
                <tr>
                    <td colspan="7" class="text-center">Tidak ada data pada periode ini</td>
                </tr>
            <?php else: ?>
                <?php
                $no = 1;
                foreach ($details as $row):
                    $status = '';
                    if ($row['risk_level'] == 'Bahaya') {
                        $status = 'Kritis';
                    } elseif ($row['risk_level'] == 'Tinggi') {
                        $status = 'Perlu Perhatian';
                    } elseif ($row['risk_level'] == 'Sedang') {
                        $status = 'Monitoring';
                    } else {
                        $status = 'Normal';
                    }
                ?>
                    <tr>
                        <td class="text-center"><?= $no++ ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($row['created_at'])) ?></td>
                        <td><?= htmlspecialchars($row['name']) ?></td>
                        <td><?= htmlspecialchars($row['group_title'] ?? '-') ?></td>
                        <td class="text-center"><?= $row['total_score'] ?>/40</td>
                        <td class="text-center"><?= htmlspecialchars($row['risk_level']) ?></td>
                        <td class="text-center"><?= $status ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="catatan">
        <strong>Catatan:</strong>
        <ul>
            <li><strong>Kategori Bahaya:</strong> Skor 31-40 - Memerlukan konseling psikologis segera</li>
            <li><strong>Kategori Tinggi:</strong> Skor 21-30 - Perlu monitoring intensif dan edukasi</li>
            <li><strong>Kategori Sedang:</strong> Skor 11-20 - Monitoring rutin dan edukasi preventif</li>
            <li><strong>Kategori Rendah:</strong> Skor 0-10 - Kondisi normal, tetap lakukan awareness</li>
        </ul>
    </div>
</body>

</html>