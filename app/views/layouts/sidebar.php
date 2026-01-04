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

            <!-- Data Management -->
            <a href="#dataMenu" class="list-group-item list-group-item-action collapsed" data-bs-toggle="collapse">
                <i class="fas fa-database"></i> Data Management
                <i class="fas fa-chevron-down float-end"></i>
            </a>
            <div class="collapse" id="dataMenu">
                <a href="/sigma/respondent" class="list-group-item list-group-item-action ps-4">
                    <i class="fas fa-users"></i> Data Responden
                </a>
            </div>

            <!-- Content Management -->
            <a href="#contentMenu" class="list-group-item list-group-item-action collapsed" data-bs-toggle="collapse">
                <i class="fas fa-folder-open"></i> Content Management
                <i class="fas fa-chevron-down float-end"></i>
            </a>
            <div class="collapse" id="contentMenu">
                <a href="/sigma/education/manage" class="list-group-item list-group-item-action ps-4">
                    <i class="fas fa-book-open"></i> Kelola Edukasi
                </a>
                <a href="/sigma/rng-games" class="list-group-item list-group-item-action ps-4">
                    <i class="fas fa-dice"></i> Kelola Game RNG
                </a>
            </div>

            <!-- Assessment Management -->
            <a href="#assessmentMenu" class="list-group-item list-group-item-action collapsed" data-bs-toggle="collapse">
                <i class="fas fa-clipboard-check"></i> Assessment
                <i class="fas fa-chevron-down float-end"></i>
            </a>
            <div class="collapse" id="assessmentMenu">
                <a href="/sigma/assessment-groups" class="list-group-item list-group-item-action ps-4">
                    <i class="fas fa-layer-group"></i> Grup Assessment
                </a>
                <a href="/sigma/questions" class="list-group-item list-group-item-action ps-4">
                    <i class="fas fa-clipboard-list"></i> Bank Soal
                </a>
            </div>

            <!-- Analytics & Reports -->
            <a href="#analyticsMenu" class="list-group-item list-group-item-action collapsed" data-bs-toggle="collapse">
                <i class="fas fa-chart-bar"></i> Analytics & Reports
                <i class="fas fa-chevron-down float-end"></i>
            </a>
            <div class="collapse" id="analyticsMenu">
                <a href="/sigma/simulator/history" class="list-group-item list-group-item-action ps-4">
                    <i class="fas fa-history"></i> History Simulasi
                </a>
                <a href="/sigma/report" class="list-group-item list-group-item-action ps-4">
                    <i class="fas fa-chart-line"></i> Laporan Analisis
                </a>
            </div>

            <!-- Settings -->
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