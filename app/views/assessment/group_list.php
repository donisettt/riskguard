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
                                <a href="index.php?url=assessment/form/<?= $group['id'] ?>"
                                    class="btn btn-start">
                                    Mulai Assessment
                                    <i class="fas fa-arrow-right ms-2"></i>
                                </a>
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

<style>
    :root {
        --green-primary: #16a34a;
        --green-soft: #dcfce7;
        --green-dark: #166534;
        --text-primary: #0f172a;
        --text-secondary: #475569;
        --border-soft: #e5e7eb;
    }

    /* WRAPPER */
    .assessment-wrapper {
        background: #f8fafc;
    }

    /* HEADER */
    .assessment-header {
        display: flex;
        align-items: center;
        gap: 18px;
    }

    .header-icon {
        width: 56px;
        height: 56px;
        background: var(--green-soft);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .header-icon i {
        font-size: 24px;
        color: var(--green-primary);
    }

    .assessment-title {
        margin: 0;
        font-size: 28px;
        font-weight: 700;
        color: var(--text-primary);
    }

    .assessment-subtitle {
        margin-top: 4px;
        font-size: 15px;
        color: var(--text-secondary);
    }

    /* CARD */
    .group-card {
        background: #fff;
        border-radius: 18px;
        border: 1px solid var(--border-soft);
        box-shadow: 0 6px 20px rgba(0, 0, 0, .04);
        display: flex;
        flex-direction: column;
        transition: all .25s ease;
    }

    .group-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 16px 40px rgba(22, 163, 74, .18);
        border-color: var(--green-primary);
    }

    /* CARD HEADER */
    .group-card-header {
        padding: 26px 26px 16px;
    }

    .group-icon {
        width: 54px;
        height: 54px;
        background: var(--green-soft);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 16px;
    }

    .group-icon i {
        font-size: 22px;
        color: var(--green-primary);
    }

    .group-title {
        font-size: 18px;
        font-weight: 600;
        color: var(--text-primary);
        margin: 0;
    }

    /* BODY */
    .group-card-body {
        padding: 0 26px 24px;
        flex: 1;
    }

    .group-description {
        font-size: 14.5px;
        color: var(--text-secondary);
        line-height: 1.7;
        margin-bottom: 20px;
    }

    /* BADGES */
    .group-info {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .info-badge {
        background: #f0fdf4;
        padding: 7px 14px;
        border-radius: 999px;
        font-size: 13px;
        font-weight: 500;
        color: var(--green-dark);
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    /* FOOTER */
    .group-card-footer {
        padding: 0 26px 26px;
    }

    .btn-start {
        width: 100%;
        background: var(--green-primary);
        border: none;
        color: #fff;
        padding: 14px;
        border-radius: 14px;
        font-weight: 600;
        transition: all .2s ease;
    }

    .btn-start:hover {
        background: var(--green-dark);
        transform: translateY(-2px);
    }

    /* EMPTY */
    .empty-state {
        background: #fff;
        border-radius: 20px;
        padding: 60px 20px;
        text-align: center;
        box-shadow: 0 6px 20px rgba(0, 0, 0, .05);
    }

    .empty-state i {
        font-size: 48px;
        color: #94a3b8;
        margin-bottom: 16px;
    }
</style>