<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <?php date_default_timezone_set('Asia/Jakarta'); ?>
    <title>Laporan Hasil Assessment Personal - <?= htmlspecialchars($userName) ?></title>
    <style>
        <?= file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/sigma/public/css/user-report-pdf.css'); ?>
    </style>

</head>

<body>
    <h1>LAPORAN HASIL ASSESSMENT PERSONAL</h1>
    <h3>Analisis Personal Risiko Perjudian</h3>
    <div class="periode">
        <strong>Nama:</strong> <?= htmlspecialchars($userName) ?><br>
        <strong>Periode:</strong> <?= date('d M Y', strtotime($startDate)) ?> s/d <?= date('d M Y', strtotime($endDate)) ?>
        <?php if ($riskFilter != 'All'): ?>
            <br><strong>Filter:</strong> Kategori Risiko <?= htmlspecialchars($riskFilter) ?>
        <?php endif; ?>
    </div>

    <h2>I. RINGKASAN STATISTIK</h2>
    <table>
        <tr>
            <td width="50%"><strong>Total Assessment yang Dilakukan</strong></td>
            <td width="50%"><strong><?= $summary['total'] ?> kali</strong></td>
        </tr>
        <tr>
            <td><strong>Assessment Berisiko Tinggi/Bahaya</strong></td>
            <td><strong class="text-danger"><?= $summary['high_risk'] ?> kali</strong></td>
        </tr>
        <tr>
            <td><strong>Rata-rata Skor Risiko</strong></td>
            <td><strong><?= $summary['avg_score'] ?> dari 40 poin</strong></td>
        </tr>
        <tr>
            <td><strong>Skor Terendah</strong></td>
            <td><strong class="text-success"><?= $summary['min_score'] ?> poin</strong></td>
        </tr>
        <tr>
            <td><strong>Skor Tertinggi</strong></td>
            <td><strong class="text-danger"><?= $summary['max_score'] ?> poin</strong></td>
        </tr>
    </table>

    <h2>II. DISTRIBUSI KATEGORI RISIKO</h2>
    <?php if (!empty($summary['distribution'])): ?>
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
                $total_dist = array_sum(array_column($summary['distribution'], 'count'));
                foreach ($summary['distribution'] as $dist):
                    $pct = $total_dist > 0 ? ($dist['count'] / $total_dist * 100) : 0;
                ?>
                    <tr>
                        <td><?= htmlspecialchars($dist['risk_level']) ?></td>
                        <td class="text-center"><?= $dist['count'] ?> kali</td>
                        <td class="text-center"><?= number_format($pct, 1) ?>%</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p style="text-align: center; color: #666;">Tidak ada data untuk periode ini</p>
    <?php endif; ?>

    <?php if ($summary['high_risk'] > 0): ?>
        <div class="warning-box">
            <strong>PERHATIAN PENTING!</strong>
            <p>Anda memiliki <strong><?= $summary['high_risk'] ?> assessment</strong> dengan kategori risiko <strong>Tinggi atau Bahaya</strong> dalam periode ini.</p>
            <p><strong>Rekomendasi Tindakan:</strong></p>
            <ul>
                <li>Segera berkonsultasi dengan profesional kesehatan mental atau konselor kecanduan</li>
                <li>Hubungi layanan hotline kecanduan judi untuk mendapatkan bantuan segera</li>
                <li>Bicarakan masalah Anda dengan keluarga atau orang terdekat yang dapat dipercaya</li>
                <li>Pertimbangkan untuk mengikuti program rehabilitasi atau support group</li>
            </ul>
        </div>
    <?php endif; ?>

    <h2>III. RIWAYAT ASSESSMENT DETAIL</h2>
    <?php if (!empty($assessments)): ?>
        <table>
            <thead>
                <tr>
                    <th width="5%">No</th>
                    <th width="20%">Tanggal</th>
                    <th width="35%">Jenis Assessment</th>
                    <th width="15%" class="text-center">Skor</th>
                    <th width="25%" class="text-center">Kategori Risiko</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($assessments as $item):
                    $badgeClass = '';
                    if ($item['risk_level'] == 'Bahaya') {
                        $badgeClass = 'badge-danger';
                    } elseif ($item['risk_level'] == 'Tinggi') {
                        $badgeClass = 'badge-warning';
                    } elseif ($item['risk_level'] == 'Sedang') {
                        $badgeClass = 'badge-info';
                    } else {
                        $badgeClass = 'badge-success';
                    }
                ?>
                    <tr>
                        <td class="text-center"><?= $no++ ?></td>
                        <td><?= date('d M Y, H:i', strtotime($item['created_at'])) ?></td>
                        <td><?= htmlspecialchars($item['group_title']) ?></td>
                        <td class="text-center"><strong><?= $item['total_score'] ?> / 40</strong></td>
                        <td class="text-center">
                            <span class="badge <?= $badgeClass ?>"><?= htmlspecialchars($item['risk_level']) ?></span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p style="text-align: center; color: #666;">Tidak ada riwayat assessment pada periode ini</p>
    <?php endif; ?>

    <?php if (!empty($riskProgress)): ?>
        <div class="page-break"></div>

        <h2>IV. ANALISIS PERKEMBANGAN</h2>
        <div class="info-box">
            <p><strong>Tren Skor Risiko (10 Assessment Terakhir):</strong></p>
            <table>
                <thead>
                    <tr>
                        <th width="30%">Tanggal</th>
                        <th width="35%" class="text-center">Skor</th>
                        <th width="35%" class="text-center">Kategori</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($riskProgress as $progress): ?>
                        <tr>
                            <td><?= date('d M Y', strtotime($progress['date'])) ?></td>
                            <td class="text-center"><?= $progress['total_score'] ?> / 40</td>
                            <td class="text-center"><?= htmlspecialchars($progress['risk_level']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <?php
            // Analisis tren
            $scores = array_column($riskProgress, 'total_score');
            if (count($scores) >= 2) {
                $firstScore = $scores[0];
                $lastScore = end($scores);
                $trend = $lastScore - $firstScore;
            ?>
                <p style="margin-top: 10px;">
                    <strong>Interpretasi:</strong>
                    <?php if ($trend > 0): ?>
                        <span class="text-danger">Skor risiko Anda mengalami <strong>peningkatan sebesar <?= abs($trend) ?> poin</strong>. Ini menunjukkan risiko kecanduan yang semakin meningkat. Harap waspada dan pertimbangkan untuk mencari bantuan profesional.</span>
                    <?php elseif ($trend < 0): ?>
                        <span class="text-success">Skor risiko Anda mengalami <strong>penurunan sebesar <?= abs($trend) ?> poin</strong>. Ini adalah tanda positif! Pertahankan kemajuan ini dan terus lakukan upaya pencegahan.</span>
                    <?php else: ?>
                        <span>Skor risiko Anda <strong>relatif stabil</strong>. Tetap monitor kondisi Anda secara berkala.</span>
                    <?php endif; ?>
                </p>
            <?php } ?>
        </div>
    <?php endif; ?>

    <h2>V. TIPS & REKOMENDASI</h2>
    <div class="tips-box">
        <p><strong>Strategi Mengelola Risiko Kecanduan Judi:</strong></p>
        <ol>
            <li><strong>Batasi Waktu Bermain:</strong> Tetapkan waktu maksimal untuk aktivitas judi dan patuhi dengan ketat</li>
            <li><strong>Tentukan Budget Harian/Mingguan:</strong> Jangan pernah melebihi anggaran yang sudah ditetapkan</li>
            <li><strong>Hindari Berjudi Saat Emosi:</strong> Jangan berjudi ketika sedang stres, sedih, atau marah</li>
            <li><strong>Cari Aktivitas Alternatif:</strong> Temukan hobi atau kegiatan positif sebagai pengganti</li>
            <li><strong>Jangan Gunakan Uang Pinjaman:</strong> Jangan pernah berjudi dengan uang yang dipinjam</li>
            <li><strong>Bicara dengan Orang Terdekat:</strong> Bagikan masalah Anda kepada keluarga atau teman</li>
            <li><strong>Gunakan Aplikasi Pemantau:</strong> Manfaatkan aplikasi untuk tracking aktivitas dan pengeluaran</li>
            <li><strong>Hindari Konsumsi Alkohol:</strong> Alkohol dapat mengurangi kontrol diri saat berjudi</li>
        </ol>
    </div>

    <div class="info-box" style="margin-top: 15px;">
        <p><strong>Layanan Bantuan Kecanduan Judi:</strong></p>
        <ul style="list-style: none; padding-left: 0;">
            <li>• <strong>Hotline Kecanduan Judi:</strong> 021-500-454 (24 jam)</li>
            <li>• <strong>Konseling Online:</strong> www.konseling-kecanduan.id</li>
            <li>• <strong>Support Group:</strong> Cari kelompok dukungan terdekat di kota Anda</li>
        </ul>
    </div>

    <div class="info-box" style="margin-top: 15px;">
        <p><strong>Catatan Penting:</strong></p>
        <ul>
            <li>Laporan ini bersifat pribadi dan rahasia</li>
            <li>Hasil assessment bukan diagnosis medis, konsultasikan dengan profesional untuk evaluasi lebih lanjut</li>
            <li>Lakukan assessment secara berkala untuk memantau perkembangan kondisi Anda</li>
            <li>Jangan ragu untuk mencari bantuan profesional jika merasa kesulitan mengendalikan perilaku judi</li>
        </ul>
    </div>

    <div style="margin-top: 30px; text-align: center; font-size: 9pt; color: #666;">
        <p><em>Laporan ini digenerate pada: <?= date('d M Y H:i') ?> WIB</em></p>
        <p><strong>SIGMA - Sistem Informasi & Manajemen Risiko Perilaku Judi Online</strong></p>
    </div>

</body>

</html>