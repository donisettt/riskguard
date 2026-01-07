<div class="container-fluid px-4 py-4">

    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1" style="color: var(--text-dark);">
                <i class="fas fa-cog" style="color: var(--primary-color);"></i>
                Pengaturan Sistem
            </h2>
            <p class="text-muted mb-0">Kelola database dan data sistem</p>
        </div>
    </div>

    <!-- Alert Messages -->
    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            <?= $_SESSION['success'];
            unset($_SESSION['success']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            <?= $_SESSION['error'];
            unset($_SESSION['error']); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Settings Cards -->
    <div class="row g-4">

        <!-- Export Database Card -->
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-start mb-3">
                        <div class="icon-wrapper me-3" style="width: 50px; height: 50px; background: var(--second-bg-color); border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-download fa-lg" style="color: var(--primary-color);"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="card-title mb-1 fw-bold">Export Database</h5>
                            <p class="text-muted small mb-0">Backup seluruh database sistem</p>
                        </div>
                    </div>

                    <div class="mb-4">
                        <p class="text-muted mb-2" style="font-size: 14px;">
                            Fitur ini akan mengekspor seluruh data database menjadi file SQL yang dapat digunakan untuk backup atau restore data di kemudian hari.
                        </p>
                        <ul class="list-unstyled mb-0" style="font-size: 13px;">
                            <li class="mb-2">
                                <i class="fas fa-check text-success me-2"></i>
                                <span class="text-muted">Semua tabel dan data akan ter-backup</span>
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-check text-success me-2"></i>
                                <span class="text-muted">Format file: SQL standard</span>
                            </li>
                            <li>
                                <i class="fas fa-check text-success me-2"></i>
                                <span class="text-muted">Dapat di-restore kapan saja</span>
                            </li>
                        </ul>
                    </div>

                    <a href="index.php?url=settings/export"
                        class="btn btn-primary w-100"
                        style="background: var(--primary-color); border: none; padding: 12px; font-weight: 600;"
                        onclick="return confirm('Apakah Anda yakin ingin mengekspor database?');">
                        <i class="fas fa-download me-2"></i>
                        Export Database
                    </a>
                </div>
            </div>
        </div>

        <!-- Delete All Data Card -->
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-start mb-3">
                        <div class="icon-wrapper me-3" style="width: 50px; height: 50px; background: #fee2e2; border-radius: 12px; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-trash-alt fa-lg" style="color: var(--danger-color);"></i>
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="card-title mb-1 fw-bold">Hapus Semua Data</h5>
                            <p class="text-muted small mb-0">Reset sistem ke kondisi awal</p>
                        </div>
                    </div>

                    <div class="mb-4">
                        <p class="text-muted mb-2" style="font-size: 14px;">
                            <strong class="text-danger">PERINGATAN:</strong> Fitur ini akan menghapus semua data sistem secara permanen. Aksi ini tidak dapat dibatalkan.
                        </p>
                        <ul class="list-unstyled mb-0" style="font-size: 13px;">
                            <li class="mb-2">
                                <i class="fas fa-times text-danger me-2"></i>
                                <span class="text-muted">Semua data responden akan terhapus</span>
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-times text-danger me-2"></i>
                                <span class="text-muted">Riwayat assessment akan hilang</span>
                            </li>
                            <li class="mb-2">
                                <i class="fas fa-check text-success me-2"></i>
                                <span class="text-muted">Akun admin tetap tersimpan</span>
                            </li>
                            <li>
                                <i class="fas fa-info-circle text-info me-2"></i>
                                <span class="text-muted">Backup terlebih dahulu sebelum menghapus</span>
                            </li>
                        </ul>
                    </div>

                    <button type="button"
                        class="btn btn-danger w-100"
                        style="background: var(--danger-color); border: none; padding: 12px; font-weight: 600;"
                        data-bs-toggle="modal"
                        data-bs-target="#deleteConfirmModal">
                        <i class="fas fa-trash-alt me-2"></i>
                        Hapus Semua Data
                    </button>
                </div>
            </div>
        </div>

    </div>

    <!-- Database Info Card -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h5 class="card-title fw-bold mb-3">
                        <i class="fas fa-info-circle me-2" style="color: var(--info-color);"></i>
                        Informasi Database
                    </h5>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="info-item mb-3">
                                <small class="text-muted d-block mb-1">Database Name</small>
                                <strong style="color: var(--text-dark);">sigma</strong>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-item mb-3">
                                <small class="text-muted d-block mb-1">Server</small>
                                <strong style="color: var(--text-dark);">localhost</strong>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="info-item mb-3">
                                <small class="text-muted d-block mb-1">Last Backup</small>
                                <strong style="color: var(--text-dark);"><?= $lastBackup ?? '-' ?></strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold" id="deleteConfirmModalLabel" style="color: var(--danger-color);">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    Konfirmasi Penghapusan Data
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-4 py-4">
                <div class="alert alert-danger mb-3" style="background: #fee2e2; border: none;">
                    <strong>PERINGATAN!</strong><br>
                    Tindakan ini akan menghapus semua data sistem secara permanen dan tidak dapat dibatalkan.
                </div>

                <p class="mb-3" style="color: var(--text-dark);">
                    Untuk melanjutkan, ketik <strong>"HAPUS SEMUA DATA"</strong> pada kolom di bawah:
                </p>

                <form id="deleteDataForm" method="POST" action="index.php?url=settings/delete">
                    <input type="text"
                        class="form-control mb-3"
                        id="confirmText"
                        placeholder="Ketik: HAPUS SEMUA DATA"
                        autocomplete="off"
                        style="padding: 12px; border: 2px solid #e5e7eb;">

                    <div class="d-grid gap-2">
                        <button type="submit"
                            class="btn btn-danger"
                            id="confirmDeleteBtn"
                            disabled
                            style="background: var(--danger-color); border: none; padding: 12px; font-weight: 600;">
                            <i class="fas fa-trash-alt me-2"></i>
                            Ya, Hapus Semua Data
                        </button>
                        <button type="button"
                            class="btn btn-light"
                            data-bs-dismiss="modal"
                            style="padding: 12px; font-weight: 600;">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</div>

<script>
    // Confirmation text validation
    document.getElementById('confirmText').addEventListener('input', function() {
        const confirmBtn = document.getElementById('confirmDeleteBtn');
        if (this.value === 'HAPUS SEMUA DATA') {
            confirmBtn.disabled = false;
        } else {
            confirmBtn.disabled = true;
        }
    });

    // Form submission handling
    document.getElementById('deleteDataForm').addEventListener('submit', function(e) {
        const confirmText = document.getElementById('confirmText').value;
        if (confirmText !== 'HAPUS SEMUA DATA') {
            e.preventDefault();
            alert('Teks konfirmasi tidak sesuai!');
            return false;
        }

        // Final confirmation
        if (!confirm('KONFIRMASI TERAKHIR: Apakah Anda benar-benar yakin ingin menghapus semua data?')) {
            e.preventDefault();
            return false;
        }
    });
</script>

<style>
    .card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1) !important;
    }

    .btn-primary:hover {
        background: var(--primary-dark) !important;
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0, 157, 99, 0.2);
    }

    .btn-danger:hover {
        background: #b91c1c !important;
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(220, 38, 38, 0.2);
    }

    .icon-wrapper {
        transition: transform 0.2s ease;
    }

    .card:hover .icon-wrapper {
        transform: scale(1.05);
    }

    .modal-content {
        border-radius: 12px;
        overflow: hidden;
    }

    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem rgba(0, 157, 99, 0.15);
    }
</style>