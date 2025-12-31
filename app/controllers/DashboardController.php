<?php
require_once 'app/core/AuthMiddleware.php';

class DashboardController
{
    public function index()
    {
        // 1. Cek apakah user sudah login
        AuthMiddleware::check();

        // 2. Siapkan data untuk view
        $data = [
            'title' => 'Dashboard Utama',
            'user' => $_SESSION['name'],
            'role' => $_SESSION['role']
        ];

        // 3. Load view dengan layout
        require_once 'app/views/layouts/header.php';
        require_once 'app/views/layouts/sidebar.php';
        require_once 'app/views/layouts/navbar.php';
        require_once 'app/views/dashboard/index.php';
        require_once 'app/views/layouts/footer.php';
    }
}
