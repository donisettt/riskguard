<?php
$color = 'success';
$icon = 'fa-check-circle';
$msg = 'Anda memiliki kendali yang baik.';

$level = $data['result']['risk_level'];
$results = [
    'Rendah' => ['bg' => '#f0fdf4', 'text' => '#166534', 'icon' => 'fa-circle-check', 'msg' => 'Aktivitas Anda terkendali dengan sangat baik.', 'accent' => '#22c55e', 'grad' => 'linear-gradient(135deg, #22c55e 0%, #16a34a 100%)'],
    'Sedang' => ['bg' => '#fffbeb', 'text' => '#92400e', 'icon' => 'fa-triangle-exclamation', 'msg' => 'Waspada risiko awal detected.', 'accent' => '#eab308', 'grad' => 'linear-gradient(135deg, #eab308 0%, #ca8a04 100%)'],
    'Tinggi' => ['bg' => '#fff7ed', 'text' => '#9a3412', 'icon' => 'fa-circle-exclamation', 'msg' => 'Risiko tinggi. Batasi diri segera.', 'accent' => '#f97316', 'grad' => 'linear-gradient(135deg, #f97316 0%, #ea580c 100%)'],
    'Bahaya' => ['bg' => '#fef2f2', 'text' => '#991b1b', 'icon' => 'fa-skull-crossbones', 'msg' => 'Kritis! Butuh bantuan profesional.', 'accent' => '#ef4444', 'grad' => 'linear-gradient(135deg, #ef4444 0%, #dc2626 100%)']
];
$res = $results[$level] ?? $results['Rendah'];
?>

<div class="result-dashboard">
    <div class="container mt-2 mt-lg-4">
        <div class="row justify-content-center">
            <div class="col-xl-10">
                
                <div class="bento-grid">
                    
                    <div class="bento-item main-status" style="background: <?= $res['bg'] ?>; border: 1px solid <?= $res['accent'] ?>40;">
                        <div class="d-flex flex-column h-100 justify-content-between">
                            <div>
                                <span class="badge-status" style="background: <?= $res['accent'] ?>20; color: <?= $res['text'] ?>;">
                                    <i class="fas <?= $res['icon'] ?> me-2"></i>Analisis Selesai
                                </span>
                                <h4 class="mt-3 text-muted small fw-bold text-uppercase">Tingkat Risiko</h4>
                                <h1 class="display-4 fw-900 mb-2" style="color: <?= $res['text'] ?>; letter-spacing: -2px;">
                                    <?= strtoupper($level) ?>
                                </h1>
                                <p class="lead-sm fw-medium" style="color: <?= $res['text'] ?>; opacity: 0.8;">
                                    <?= $res['msg'] ?>
                                </p>
                            </div>
                            <div class="status-illustration">
                                <i class="fas <?= $res['icon'] ?>" style="color: <?= $res['accent'] ?>15;"></i>
                            </div>
                        </div>
                    </div>

                    <div class="bento-item score-card">
                        <h6 class="text-overline mb-4">Skor Akumulasi</h6>
                        <div class="score-display">
                            <svg viewBox="0 0 36 36" class="circular-chart">
                                <path class="circle-bg" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                                <path class="circle" stroke-dasharray="<?= ($data['result']['total_score'] / 30) * 100 ?>, 100" stroke="<?= $res['accent'] ?>" d="M18 2.0845 a 15.9155 15.9155 0 0 1 0 31.831 a 15.9155 15.9155 0 0 1 0 -31.831" />
                                <text x="18" y="20.35" class="percentage fw-800"><?= number_format($data['result']['total_score'], 1) ?></text>
                                <text x="18" y="26" class="unit">Poin</text>
                            </svg>
                        </div>
                    </div>

                    <div class="bento-item privacy-card">
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-shield">
                                <i class="fas fa-shield-check text-success"></i>
                            </div>
                            <h6 class="m-0 fw-bold">Privasi Aman</h6>
                        </div>
                        <p class="small text-muted mb-0">Laporan ini bersifat rahasia dan telah dienkripsi secara aman.</p>
                    </div>

                    <div class="bento-item action-center">
                        <h6 class="text-overline mb-3">Navigasi Selanjutnya</h6>
                        <div class="action-buttons">
                            <a href="index.php?url=simulator" class="btn-premium primary" style="background: <?= $res['grad'] ?>;">
                                <i class="fas fa-gamepad"></i> <span>Simulator</span>
                            </a>
                            <a href="index.php?url=education" class="btn-premium secondary">
                                <i class="fas fa-book-open"></i> <span>Edukasi</span>
                            </a>
                            <a href="index.php?url=assessment" class="btn-premium outline">
                                <i class="fas fa-redo"></i>
                            </a>
                        </div>
                    </div>

                </div> </div>
        </div>
    </div>
</div>

<style>
    .fw-900 { font-weight: 900; }
    .fw-800 { font-weight: 800; }

    .result-dashboard {
        background-color: #f8fafc;
        min-height: 80vh;
        display: flex;
        align-items: center;
    }

    /* Bento Layout System */
    .bento-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        grid-template-rows: repeat(2, auto);
        gap: 20px;
    }

    .bento-item {
        background: white;
        border-radius: 24px;
        padding: 24px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        position: relative;
        overflow: hidden;
    }

    /* Area Span */
    .main-status { grid-column: span 2; grid-row: span 1; }
    .score-card { grid-column: span 1; grid-row: span 1; text-align: center; }
    .privacy-card { grid-column: span 1; grid-row: span 1; background: #f1f5f9; border: none; }
    .action-center { grid-column: span 2; grid-row: span 1; }

    /* Badge & Text */
    .badge-status {
        padding: 6px 14px;
        border-radius: 100px;
        font-size: 12px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
    }

    .text-overline {
        font-size: 11px;
        font-weight: 800;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* Circular Chart */
    .score-display { max-width: 140px; margin: 0 auto; }
    .circular-chart { display: block; margin: 10px auto; max-width: 100%; max-height: 250px; }
    .circle-bg { fill: none; stroke: #f1f5f9; stroke-width: 3.8; }
    .circle { fill: none; stroke-width: 3.8; stroke-linecap: round; transition: stroke-dasharray 1s ease; }
    .percentage { fill: #1e293b; font-size: 9px; text-anchor: middle; }
    .unit { fill: #94a3b8; font-size: 3px; text-anchor: middle; font-weight: 700; text-transform: uppercase; }

    /* Buttons Style */
    .action-buttons { display: flex; gap: 12px; }
    .btn-premium {
        padding: 14px 20px;
        border-radius: 16px;
        border: none;
        font-weight: 700;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        transition: all 0.2s;
        flex: 1;
    }

    .btn-premium.primary { color: white; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); }
    .btn-premium.secondary { background: #1e293b; color: white; }
    .btn-premium.outline { background: white; color: #64748b; border: 1px solid #e2e8f0; flex: 0.3; }
    .btn-premium:hover { transform: translateY(-3px); opacity: 0.9; color: white; }

    /* Illustration on background */
    .status-illustration {
        position: absolute;
        right: -20px;
        bottom: -20px;
        font-size: 120px;
        transform: rotate(-15deg);
        pointer-events: none;
    }

    .icon-shield {
        width: 32px;
        height: 32px;
        background: white;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 12px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.05);
    }

    /* Mobile Responsive */
    @media (max-width: 992px) {
        .bento-grid { grid-template-columns: 1fr; }
        .main-status, .score-card, .privacy-card, .action-center { grid-column: span 1; }
        .result-dashboard { padding: 20px 0; }
    }
</style>