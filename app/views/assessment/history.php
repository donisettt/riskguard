<div class="container-fluid px-4 py-4">
    <!-- Header Section -->
    <div class="history-header-card mb-4">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h3 class="history-title mb-2">
                    <i class="fas fa-history me-2"></i>Riwayat Assessment Saya
                </h3>
                <p class="history-subtitle mb-0">Lihat semua hasil assessment yang pernah Anda lakukan</p>
            </div>
            <a href="/sigma/assessment" class="btn btn-history-new">
                <i class="fas fa-plus me-2"></i>Assessment Baru
            </a>
        </div>
    </div>

    <?php if (empty($data['history'])): ?>
        <!-- Empty State -->
        <div class="empty-state-card">
            <div class="empty-icon">
                <i class="fas fa-clipboard-list"></i>
            </div>
            <h4 class="empty-title">Belum Ada Riwayat</h4>
            <p class="empty-text">Anda belum melakukan assessment. Mulai sekarang untuk mengetahui tingkat risiko Anda.</p>
            <a href="/sigma/assessment" class="btn btn-empty-action">
                <i class="fas fa-play me-2"></i>Mulai Assessment
            </a>
        </div>
    <?php else: ?>
        <!-- Statistics Summary -->
        <div class="row g-3 mb-4">
            <?php
            $totalAssessments = count($data['history']);
            $latestRisk = $data['history'][0]['risk_level'];
            $avgScore = array_sum(array_column($data['history'], 'total_score')) / $totalAssessments;

            $riskCounts = array_count_values(array_column($data['history'], 'risk_level'));
            ?>
            <div class="col-md-3 col-sm-6">
                <div class="history-stat-card">
                    <div class="stat-icon bg-primary">
                        <i class="fas fa-clipboard-check"></i>
                    </div>
                    <div class="stat-details">
                        <h6>Total Assessment</h6>
                        <h3><?= $totalAssessments ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="history-stat-card">
                    <div class="stat-icon <?= $latestRisk == 'Rendah' ? 'bg-success' : ($latestRisk == 'Sedang' ? 'bg-warning' : ($latestRisk == 'Tinggi' ? 'bg-orange' : 'bg-danger')) ?>">
                        <i class="fas fa-heartbeat"></i>
                    </div>
                    <div class="stat-details">
                        <h6>Status Terakhir</h6>
                        <h3><?= $latestRisk ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="history-stat-card">
                    <div class="stat-icon bg-info">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <div class="stat-details">
                        <h6>Rata-rata Skor</h6>
                        <h3><?= number_format($avgScore, 1) ?></h3>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="history-stat-card">
                    <div class="stat-icon bg-success">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-details">
                        <h6>Risiko Rendah</h6>
                        <h3><?= $riskCounts['Rendah'] ?? 0 ?>x</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- History Timeline -->
        <div class="history-timeline-card">
            <h5 class="timeline-title mb-4">
                <i class="fas fa-calendar-alt me-2"></i>Timeline Assessment
            </h5>

            <div class="timeline">
                <?php foreach ($data['history'] as $index => $item): ?>
                    <div class="timeline-item">
                        <div class="timeline-marker <?= $item['risk_level'] == 'Rendah' ? 'marker-success' : ($item['risk_level'] == 'Sedang' ? 'marker-warning' : ($item['risk_level'] == 'Tinggi' ? 'marker-orange' : 'marker-danger')) ?>">
                            <i class="fas fa-check"></i>
                        </div>
                        <div class="timeline-content">
                            <div class="timeline-card">
                                <div class="timeline-header">
                                    <div class="timeline-date">
                                        <i class="fas fa-calendar me-2"></i>
                                        <?= date('d M Y, H:i', strtotime($item['created_at'])) ?>
                                    </div>
                                    <span class="timeline-badge <?= $item['risk_level'] == 'Rendah' ? 'badge-success' : ($item['risk_level'] == 'Sedang' ? 'badge-warning' : ($item['risk_level'] == 'Tinggi' ? 'badge-orange' : 'badge-danger')) ?>">
                                        <?= $item['risk_level'] ?>
                                    </span>
                                </div>
                                <div class="timeline-body">
                                    <div class="row align-items-center">
                                        <div class="col-md-8">
                                            <h6 class="timeline-subtitle">Assessment #<?= $totalAssessments - $index ?></h6>
                                            <div class="timeline-score">
                                                <div class="score-label">Total Skor:</div>
                                                <div class="score-value"><?= $item['total_score'] ?></div>
                                            </div>
                                            <div class="timeline-description">
                                                <?php if ($item['risk_level'] == 'Rendah'): ?>
                                                    <i class="fas fa-check-circle text-success me-2"></i>
                                                    Kondisi Anda baik. Pertahankan pola hidup sehat.
                                                <?php elseif ($item['risk_level'] == 'Sedang'): ?>
                                                    <i class="fas fa-exclamation-circle text-warning me-2"></i>
                                                    Perlu perhatian lebih. Konsultasi dengan ahli disarankan.
                                                <?php elseif ($item['risk_level'] == 'Tinggi'): ?>
                                                    <i class="fas fa-exclamation-triangle text-orange me-2"></i>
                                                    Risiko tinggi terdeteksi. Segera konsultasi dengan profesional.
                                                <?php else: ?>
                                                    <i class="fas fa-times-circle text-danger me-2"></i>
                                                    Risiko bahaya! Intervensi segera diperlukan.
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-4 text-end">
                                            <?php if ($index == 0): ?>
                                                <span class="latest-badge">
                                                    <i class="fas fa-star me-1"></i>Terbaru
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Info Card -->
        <div class="info-footer-card mt-4">
            <div class="info-icon">
                <i class="fas fa-info-circle"></i>
            </div>
            <div class="info-content">
                <h6>Tips untuk Hasil yang Akurat</h6>
                <p class="mb-0">Lakukan assessment secara berkala (minimal 1 bulan sekali) untuk memantau perkembangan kondisi Anda. Jawab setiap pertanyaan dengan jujur sesuai kondisi sebenarnya.</p>
            </div>
        </div>
    <?php endif; ?>
</div>

<style>
    /* History Header */
    .history-header-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 28px 32px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .history-title {
        font-size: 24px;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 0;
    }

    .history-subtitle {
        font-size: 14px;
        color: #6b7280;
    }

    .btn-history-new {
        display: inline-flex;
        align-items: center;
        padding: 12px 24px;
        background: #009d63;
        color: #ffffff;
        border: none;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .btn-history-new:hover {
        background: #047857;
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 157, 99, 0.3);
    }

    /* Empty State */
    .empty-state-card {
        background: #ffffff;
        border-radius: 20px;
        padding: 80px 40px;
        text-align: center;
        box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
    }

    .empty-icon {
        width: 120px;
        height: 120px;
        background: #f0fdf4;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 24px;
    }

    .empty-icon i {
        font-size: 48px;
        color: #009d63;
    }

    .empty-title {
        font-size: 24px;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 12px;
    }

    .empty-text {
        font-size: 15px;
        color: #6b7280;
        margin-bottom: 28px;
        max-width: 500px;
        margin-left: auto;
        margin-right: auto;
    }

    .btn-empty-action {
        display: inline-flex;
        align-items: center;
        padding: 14px 32px;
        background: #009d63;
        color: #ffffff;
        border: none;
        border-radius: 12px;
        font-size: 15px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .btn-empty-action:hover {
        background: #047857;
        color: #ffffff;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 157, 99, 0.3);
    }

    /* Statistics Cards */
    .history-stat-card {
        background: #ffffff;
        border-radius: 12px;
        padding: 20px;
        display: flex;
        align-items: center;
        gap: 16px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        transition: all 0.3s ease;
    }

    .history-stat-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .stat-icon {
        width: 56px;
        height: 56px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .stat-icon.bg-primary {
        background: #eff6ff;
        color: #3b82f6;
    }

    .stat-icon.bg-success {
        background: #ecfdf5;
        color: #10b981;
    }

    .stat-icon.bg-warning {
        background: #fffbeb;
        color: #f59e0b;
    }

    .stat-icon.bg-orange {
        background: #fff7ed;
        color: #f97316;
    }

    .stat-icon.bg-danger {
        background: #fef2f2;
        color: #ef4444;
    }

    .stat-icon.bg-info {
        background: #f0f9ff;
        color: #0ea5e9;
    }

    .stat-icon i {
        font-size: 24px;
    }

    .stat-details h6 {
        font-size: 13px;
        color: #6b7280;
        margin-bottom: 4px;
        font-weight: 500;
    }

    .stat-details h3 {
        font-size: 24px;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 0;
    }

    /* Timeline */
    .history-timeline-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 32px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .timeline-title {
        font-size: 18px;
        font-weight: 600;
        color: #1f2937;
    }

    .timeline {
        position: relative;
        padding-left: 40px;
    }

    .timeline::before {
        content: '';
        position: absolute;
        left: 15px;
        top: 0;
        bottom: 0;
        width: 2px;
        background: #e5e7eb;
    }

    .timeline-item {
        position: relative;
        margin-bottom: 24px;
    }

    .timeline-item:last-child {
        margin-bottom: 0;
    }

    .timeline-marker {
        position: absolute;
        left: -40px;
        top: 8px;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #ffffff;
        border: 3px solid;
        z-index: 2;
    }

    .timeline-marker i {
        font-size: 12px;
        color: #ffffff;
    }

    .marker-success {
        border-color: #10b981;
        background: #10b981;
    }

    .marker-warning {
        border-color: #f59e0b;
        background: #f59e0b;
    }

    .marker-orange {
        border-color: #f97316;
        background: #f97316;
    }

    .marker-danger {
        border-color: #ef4444;
        background: #ef4444;
    }

    .timeline-content {
        margin-left: 8px;
    }

    .timeline-card {
        background: #f9fafb;
        border-radius: 12px;
        padding: 20px;
        border: 2px solid #e5e7eb;
        transition: all 0.3s ease;
    }

    .timeline-card:hover {
        border-color: #009d63;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    }

    .timeline-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
        padding-bottom: 12px;
        border-bottom: 1px solid #e5e7eb;
    }

    .timeline-date {
        font-size: 13px;
        color: #6b7280;
        font-weight: 500;
    }

    .timeline-badge {
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .badge-success {
        background: #ecfdf5;
        color: #10b981;
    }

    .badge-warning {
        background: #fffbeb;
        color: #f59e0b;
    }

    .badge-orange {
        background: #fff7ed;
        color: #f97316;
    }

    .badge-danger {
        background: #fef2f2;
        color: #ef4444;
    }

    .timeline-subtitle {
        font-size: 14px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 12px;
    }

    .timeline-score {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #ffffff;
        padding: 8px 16px;
        border-radius: 8px;
        margin-bottom: 12px;
    }

    .score-label {
        font-size: 13px;
        color: #6b7280;
    }

    .score-value {
        font-size: 18px;
        font-weight: 700;
        color: #009d63;
    }

    .timeline-description {
        font-size: 14px;
        color: #4b5563;
        line-height: 1.5;
    }

    .text-orange {
        color: #f97316;
    }

    .latest-badge {
        display: inline-flex;
        align-items: center;
        padding: 8px 16px;
        background: linear-gradient(135deg, #009d63 0%, #047857 100%);
        color: #ffffff;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
    }

    /* Info Footer */
    .info-footer-card {
        background: #eff6ff;
        border-radius: 12px;
        padding: 20px 24px;
        display: flex;
        align-items: flex-start;
        gap: 16px;
        border-left: 4px solid #3b82f6;
    }

    .info-icon {
        width: 44px;
        height: 44px;
        background: #3b82f6;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .info-icon i {
        font-size: 20px;
        color: #ffffff;
    }

    .info-content h6 {
        font-size: 15px;
        font-weight: 600;
        color: #1e40af;
        margin-bottom: 6px;
    }

    .info-content p {
        font-size: 14px;
        color: #1e3a8a;
        line-height: 1.6;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .history-header-card {
            padding: 20px;
        }

        .history-header-card .d-flex {
            flex-direction: column;
            gap: 16px;
        }

        .btn-history-new {
            width: 100%;
            justify-content: center;
        }

        .empty-state-card {
            padding: 60px 24px;
        }

        .history-stat-card {
            padding: 16px;
        }

        .stat-icon {
            width: 48px;
            height: 48px;
        }

        .stat-icon i {
            font-size: 20px;
        }

        .history-timeline-card {
            padding: 24px 20px;
        }

        .timeline {
            padding-left: 32px;
        }

        .timeline-marker {
            width: 28px;
            height: 28px;
            left: -34px;
        }

        .timeline-card {
            padding: 16px;
        }

        .timeline-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 8px;
        }

        .latest-badge {
            font-size: 12px;
            padding: 6px 12px;
        }

        .info-footer-card {
            padding: 16px 20px;
        }
    }
</style>