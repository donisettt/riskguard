<div class="assessment-container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <!-- Header -->
            <div class="assessment-header-card mb-4">
                <div class="assessment-icon">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <div class="assessment-header-content">
                    <h3 class="assessment-title">Pilih Grup Assessment</h3>
                    <p class="assessment-subtitle">Pilih kategori assessment yang ingin Anda kerjakan. Setiap grup memiliki fokus dan tujuan yang berbeda.</p>
                </div>
            </div>

            <!-- Group Cards -->
            <div class="row g-4">
                <?php if (!empty($data['groups'])): ?>
                    <?php foreach ($data['groups'] as $index => $group): ?>
                        <div class="col-md-6">
                            <div class="group-card">
                                <div class="group-card-header">
                                    <div class="group-icon">
                                        <i class="fas fa-tasks"></i>
                                    </div>
                                    <h5 class="group-title"><?= htmlspecialchars($group['title']) ?></h5>
                                </div>
                                <div class="group-card-body">
                                    <p class="group-description">
                                        <?= htmlspecialchars($group['description'] ?? 'Assessment untuk mengukur dan menganalisis kondisi Anda.') ?>
                                    </p>
                                    <div class="group-info">
                                        <span class="info-badge">
                                            <i class="fas fa-question-circle"></i>
                                            <?= $group['total_questions'] ?> Pertanyaan
                                        </span>
                                        <span class="info-badge">
                                            <i class="fas fa-clock"></i>
                                            ~<?= ceil($group['total_questions'] * 0.5) ?> menit
                                        </span>
                                    </div>
                                </div>
                                <div class="group-card-footer">
                                    <a href="index.php?url=assessment/form/<?= $group['id'] ?>" class="btn btn-primary w-100">
                                        <i class="fas fa-play-circle me-2"></i> Mulai Assessment
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            <i class="fas fa-info-circle fa-2x mb-3"></i>
                            <h5>Belum Ada Grup Assessment Tersedia</h5>
                            <p class="mb-0">Saat ini belum ada grup assessment yang dapat dikerjakan. Silakan hubungi admin.</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </div>
</div>

<style>
    .group-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .group-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
    }

    .group-card-header {
        padding: 24px 24px 16px;
        border-bottom: 1px solid #f0f0f0;
    }

    .group-icon {
        width: 56px;
        height: 56px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 16px;
    }

    .group-icon i {
        font-size: 24px;
        color: white;
    }

    .group-title {
        font-size: 20px;
        font-weight: 600;
        color: #1a1a1a;
        margin: 0;
    }

    .group-card-body {
        padding: 20px 24px;
        flex: 1;
    }

    .group-description {
        color: #666;
        line-height: 1.6;
        margin-bottom: 16px;
    }

    .group-info {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
    }

    .info-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        background: #f5f5f5;
        border-radius: 8px;
        font-size: 13px;
        color: #666;
    }

    .info-badge i {
        color: #667eea;
        font-size: 14px;
    }

    .group-card-footer {
        padding: 16px 24px 24px;
    }

    .group-card-footer .btn {
        border-radius: 10px;
        padding: 12px;
        font-weight: 600;
        font-size: 15px;
    }
</style>