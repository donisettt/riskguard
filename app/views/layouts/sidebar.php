<?php
// Get current URL untuk active state
$current_url = isset($_GET['url']) ? explode('/', $_GET['url'])[0] : 'dashboard';
?>

<div id="sidebar-wrapper">
    <div class="sidebar-heading">
        <i class="fas fa-brain"></i>
        SIGMA
    </div>

    <div class="list-group list-group-flush">

        <a href="index.php?url=dashboard"
            class="list-group-item list-group-item-action fw-bold <?= $current_url == 'dashboard' ? 'active' : '' ?>">
            <i class="fas fa-tachometer-alt"></i>
            Dashboard
        </a>

        <?php if ($_SESSION['role'] === 'admin'): ?>
            <div class="sidebar-label">ADMINISTRATION</div>

            <!-- Data Management -->
            <div class="sidebar-section">
                <a href="#dataMenu"
                    class="list-group-item list-group-item-action <?= in_array($current_url, ['respondent']) ? '' : 'collapsed' ?>"
                    data-bs-toggle="collapse">
                    <i class="fas fa-database"></i> Data Management
                    <i class="fas fa-chevron-down float-end"></i>
                </a>
                <div class="collapse <?= in_array($current_url, ['respondent']) ? 'show' : '' ?>" id="dataMenu">
                    <a href="index.php?url=respondent"
                        class="list-group-item list-group-item-action ps-4 <?= $current_url == 'respondent' ? 'active' : '' ?>">
                        <i class="fas fa-users"></i> Data Responden
                    </a>
                </div>
            </div>

            <!-- Content Management -->
            <div class="sidebar-section">
                <a href="#contentMenu"
                    class="list-group-item list-group-item-action <?= in_array($current_url, ['education', 'rng-games']) ? '' : 'collapsed' ?>"
                    data-bs-toggle="collapse">
                    <i class="fas fa-folder-open"></i> Content Management
                    <i class="fas fa-chevron-down float-end"></i>
                </a>
                <div class="collapse <?= in_array($current_url, ['education', 'rng-games']) ? 'show' : '' ?>" id="contentMenu">
                    <a href="index.php?url=education/manage"
                        class="list-group-item list-group-item-action ps-4 <?= $current_url == 'education' ? 'active' : '' ?>">
                        <i class="fas fa-book-open"></i> Kelola Edukasi
                    </a>
                    <a href="index.php?url=rng-games"
                        class="list-group-item list-group-item-action ps-4 <?= $current_url == 'rng-games' ? 'active' : '' ?>">
                        <i class="fas fa-dice"></i> Kelola Game RNG
                    </a>
                </div>
            </div>

            <!-- Assessment Management -->
            <div class="sidebar-section">
                <a href="#assessmentMenu"
                    class="list-group-item list-group-item-action <?= in_array($current_url, ['assessment-groups', 'questions']) ? '' : 'collapsed' ?>"
                    data-bs-toggle="collapse">
                    <i class="fas fa-clipboard-check"></i> Assessment
                    <i class="fas fa-chevron-down float-end"></i>
                </a>
                <div class="collapse <?= in_array($current_url, ['assessment-groups', 'questions']) ? 'show' : '' ?>" id="assessmentMenu">
                    <a href="index.php?url=assessment-groups"
                        class="list-group-item list-group-item-action ps-4 <?= $current_url == 'assessment-groups' ? 'active' : '' ?>">
                        <i class="fas fa-layer-group"></i> Grup Assessment
                    </a>
                    <a href="index.php?url=questions"
                        class="list-group-item list-group-item-action ps-4 <?= $current_url == 'questions' ? 'active' : '' ?>">
                        <i class="fas fa-clipboard-list"></i> Bank Soal
                    </a>
                </div>
            </div>

            <!-- Analytics & Reports -->
            <div class="sidebar-section">
                <a href="#analyticsMenu"
                    class="list-group-item list-group-item-action <?= in_array($current_url, ['simulator', 'report']) ? '' : 'collapsed' ?>"
                    data-bs-toggle="collapse">
                    <i class="fas fa-chart-bar"></i> Analytics & Reports
                    <i class="fas fa-chevron-down float-end"></i>
                </a>
                <div class="collapse <?= in_array($current_url, ['simulator', 'report']) ? 'show' : '' ?>" id="analyticsMenu">
                    <a href="index.php?url=simulator/history"
                        class="list-group-item list-group-item-action ps-4 <?= $current_url == 'simulator' ? 'active' : '' ?>">
                        <i class="fas fa-history"></i> History Simulasi
                    </a>
                    <a href="index.php?url=report/analysis"
                        class="list-group-item list-group-item-action ps-4 <?= ($_GET['url'] ?? '') == 'report/analysis' ? 'active' : '' ?>">
                        <i class="fas fa-chart-line"></i> Laporan Analisis
                    </a>
                    <a href="index.php?url=report/assessment"
                        class="list-group-item list-group-item-action ps-4 <?= ($_GET['url'] ?? '') == 'report/assessment' ? 'active' : '' ?>">
                        <i class="fas fa-file-alt"></i> Laporan Assessment
                    </a>
                </div>
            </div>

            <!-- Settings -->
            <div class="sidebar-section">
                <a href="index.php?url=settings"
                    class="list-group-item list-group-item-action <?= $current_url == 'settings' ? 'active' : '' ?>">
                    <i class="fas fa-cog"></i> Pengaturan
                </a>
            </div>
        <?php endif; ?>

        <?php if ($_SESSION['role'] === 'user'): ?>
            <div class="sidebar-label">SELF CARE</div>

            <a href="index.php?url=assessment"
                class="list-group-item list-group-item-action <?= $current_url == 'assessment' ? 'active' : '' ?>">
                <i class="fas fa-heart-pulse"></i> Cek Risiko
            </a>

            <a href="index.php?url=simulator"
                class="list-group-item list-group-item-action <?= $current_url == 'simulator' ? 'active' : '' ?>">
                <i class="fas fa-gamepad"></i> Simulator RNG
            </a>

            <a href="index.php?url=education"
                class="list-group-item list-group-item-action <?= $current_url == 'education' ? 'active' : '' ?>">
                <i class="fas fa-graduation-cap"></i> Edukasi
            </a>

            <a href="index.php?url=report/userReport"
                class="list-group-item list-group-item-action <?= ($_GET['url'] ?? '') == 'report/userReport' ? 'active' : '' ?>">
                <i class="fas fa-chart-pie"></i> Laporan Saya
            </a>
        <?php endif; ?>
    </div>
</div>