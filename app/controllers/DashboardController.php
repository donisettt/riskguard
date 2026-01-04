<?php
require_once 'app/core/AuthMiddleware.php';

class DashboardController
{
    public function index()
    {
        AuthMiddleware::check();
        $db = (new Database())->getConnection();

        // Ambil statistik sederhana untuk Admin
        if ($_SESSION['role'] == 'admin') {
            // Hitung total user
            $stmt = $db->query("SELECT COUNT(*) as total FROM users WHERE role = 'user'");
            $data['total_users'] = $stmt->fetch()['total'];

            // Hitung kategori risiko
            $stmt = $db->query("SELECT risk_level, COUNT(*) as jml FROM assessments GROUP BY risk_level");
            $data['risk_stats'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Ambil daftar responden
            require_once 'app/models/User.php';
            $userModel = new User($db);
            $data['responden'] = $userModel->getAllResponden();
        }

        $data['title'] = 'Dashboard Analisis';
        $data['user'] = $_SESSION['name'];
        $data['role'] = $_SESSION['role'];

        require_once 'app/views/layouts/header.php';
        require_once 'app/views/layouts/sidebar.php';
        require_once 'app/views/layouts/navbar.php';
        require_once 'app/views/dashboard/index.php';
        require_once 'app/views/layouts/footer.php';
    }
}
