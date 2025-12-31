<div class="container-fluid px-4 py-4">

    <div class="alert alert-success shadow-sm">
        <h4>Selamat Datang, <?= $data['user']; ?>!</h4>
        <p>
            Anda login sebagai <strong><?= ucfirst($data['role']); ?></strong>.
            Selamat datang di Sistem Analisis Risiko Perilaku Judi Online.
        </p>
    </div>

    <div class="row g-3 my-2">
        <?php if ($data['role'] === 'admin'): ?>
            <div class="col-md-3">
                <div class="p-3 bg-white shadow-sm rounded d-flex justify-content-between align-items-center">
                    <div>
                        <h3>10</h3>
                        <p class="text-muted mb-0">Total User</p>
                    </div>
                    <i class="fas fa-users fs-1 text-primary"></i>
                </div>
            </div>

            <div class="col-md-3">
                <div class="p-3 bg-white shadow-sm rounded d-flex justify-content-between align-items-center">
                    <div>
                        <h3>5</h3>
                        <p class="text-muted mb-0">Risiko Tinggi</p>
                    </div>
                    <i class="fas fa-exclamation-triangle fs-1 text-danger"></i>
                </div>
            </div>

            <div class="col-md-3">
                <div class="p-3 bg-white shadow-sm rounded d-flex justify-content-between align-items-center">
                    <div>
                        <h3>25</h3>
                        <p class="text-muted mb-0">Assessment</p>
                    </div>
                    <i class="fas fa-clipboard-check fs-1 text-success"></i>
                </div>
            </div>
        <?php endif; ?>
    </div>

</div>