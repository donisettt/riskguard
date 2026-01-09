<div class="assessment-wrapper">
    <div class="container-fluid px-4">

        <!-- HEADER SECTION -->
        <div class="assessment-header mb-3">
            <div class="header-icon">
                <i class="fas fa-clipboard-check"></i>
            </div>
            <div>
                <h2 class="assessment-title">Pilih Grup Assessment</h2>
                <p class="assessment-subtitle">
                    Pilih kategori assessment yang ingin Anda kerjakan sesuai kebutuhan Anda.
                </p>
            </div>
        </div>

        <!-- CONTENT -->
        <div class="row g-4">
            <?php if (!empty($data['groups'])): ?>
                <?php foreach ($data['groups'] as $group): ?>
                    <div class="col-lg-4 col-md-6">
                        <div class="group-card h-100">

                            <div class="group-card-header">
                                <div class="group-icon">
                                    <i class="fas fa-tasks"></i>
                                </div>
                                <h5 class="group-title">
                                    <?= htmlspecialchars($group['title']) ?>
                                </h5>
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
                                <?php if ($group['is_completed']): ?>
                                    <button class="btn btn-disabled" disabled>
                                        <div class="d-flex flex-column align-items-center">
                                            <div>
                                                <i class="fas fa-check-circle me-2"></i>
                                                Sudah Dikerjakan
                                            </div>
                                            <?php if ($group['completed_date']): ?>
                                                <small class="mt-1" style="font-size: 11px; opacity: 0.8;">
                                                    <?= date('d M Y, H:i', strtotime($group['completed_date'])) ?>
                                                </small>
                                            <?php endif; ?>
                                        </div>
                                    </button>
                                <?php else: ?>
                                    <a href="index.php?url=assessment/form/<?= $group['id'] ?>"
                                        class="btn btn-start">
                                        Mulai Assessment
                                        <i class="fas fa-arrow-right ms-2"></i>
                                    </a>
                                <?php endif; ?>
                            </div>

                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="empty-state">
                        <i class="fas fa-folder-open"></i>
                        <h5>Belum Ada Assessment</h5>
                        <p>Saat ini belum ada grup assessment yang tersedia.</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>

    </div>
</div>

<link rel="stylesheet" href="/sigma/public/css/assessment-group-list.css">