<div class="container-fluid px-4 py-4">

    <?php if ($data['role'] === 'admin'): ?>

        <h3 class="mb-4">Halo, <?= htmlspecialchars($data['user']); ?> 👋</h3>

        <!-- CANVAS -->
        <div class="row g-4">
            <div class="col-lg-6">
                <canvas id="riskChart"></canvas>
            </div>
            <div class="col-lg-6">
                <canvas id="barChart"></canvas>
            </div>
        </div>

        <!-- DATA UNTUK JS -->
        <script>
            window.DASHBOARD_DATA = {
                riskStats: <?= json_encode($data['risk_stats'], JSON_HEX_TAG); ?>
            };
        </script>

    <?php else: ?>

        <!-- USER DASHBOARD -->
        <h3 class="mb-3">Halo, <?= htmlspecialchars($data['user']); ?> 👋</h3>

        <div class="row g-4">
            <div class="col-md-4">
                <a href="/sigma/assessment" class="btn btn-primary w-100">
                    Mulai Assessment
                </a>
            </div>
            <div class="col-md-4">
                <a href="/sigma/simulator" class="btn btn-success w-100">
                    Simulator
                </a>
            </div>
            <div class="col-md-4">
                <a href="/sigma/education" class="btn btn-info w-100">
                    Materi Edukasi
                </a>
            </div>
        </div>

    <?php endif; ?>

</div>

<?php if ($data['role'] === 'admin'): ?>
    <script src="/assets/js/dashboard.js"></script>
<?php endif; ?>