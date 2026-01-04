<div id="sidebar-wrapper">
    <div class="sidebar-heading">
        <i class="fas fa-shield-halved"></i>
        SIGMA
    </div>

    <div class="list-group list-group-flush">

        <a href="/sigma/dashboard"
            class="list-group-item list-group-item-action fw-bold active">
            <i class="fas fa-tachometer-alt"></i>
            Dashboard
        </a>

        <?php if ($_SESSION['role'] === 'admin'): ?>
            <div class="sidebar-label">ADMINISTRATION</div>

            <a href="/sigma/respondent" class="list-group-item list-group-item-action">
                <i class="fas fa-users"></i> Data Responden
            </a>

            <a href="/sigma/education/manage" class="list-group-item list-group-item-action">
                <i class="fas fa-book-open"></i> Kelola Edukasi
            </a>

            <a href="/sigma/questions" class="list-group-item list-group-item-action">
                <i class="fas fa-clipboard-list"></i> Manajemen Kuesioner
            </a>

            <a href="/sigma/report" class="list-group-item list-group-item-action">
                <i class="fas fa-chart-line"></i> Laporan Analisis
            </a>

            <a href="/sigma/settings" class="list-group-item list-group-item-action">
                <i class="fas fa-cogs"></i> Pengaturan
            </a>
        <?php endif; ?>

        <?php if ($_SESSION['role'] === 'user'): ?>
            <div class="sidebar-label">SELF CARE</div>

            <a href="/sigma/assessment" class="list-group-item list-group-item-action">
                <i class="fas fa-heart-pulse"></i> Cek Risiko
            </a>

            <a href="/sigma/simulator" class="list-group-item list-group-item-action">
                <i class="fas fa-gamepad"></i> Simulator RNG
            </a>

            <a href="/sigma/education" class="list-group-item list-group-item-action">
                <i class="fas fa-graduation-cap"></i> Edukasi
            </a>

            <a href="/sigma/history" class="list-group-item list-group-item-action">
                <i class="fas fa-history"></i> Riwayat Saya
            </a>
        <?php endif; ?>
    </div>
</div>