<?php
require_once 'app/core/AuthMiddleware.php';
require_once 'config/Database.php';
require_once 'app/models/User.php';

class DashboardController
{
    public function index()
    {
        AuthMiddleware::check();

        $db = (new Database())->getConnection();
        $data = [];

        $data['title'] = 'Dashboard Analisis';
        $data['user']  = $_SESSION['name'];
        $data['role']  = $_SESSION['role'];

        if ($data['role'] === 'admin') {

            // Total user (role user)
            $stmt = $db->prepare("SELECT COUNT(*) FROM users WHERE role = ?");
            $stmt->execute(['user']);
            $data['total_users'] = $stmt->fetchColumn();

            // Statistik risiko
            $stmt = $db->query("
                SELECT risk_level, COUNT(*) AS jml
                FROM assessments
                GROUP BY risk_level
            ");
            $data['risk_stats'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Data responden
            $userModel = new User($db);
            $data['responden'] = $userModel->getAllResponden();
        }

        require_once 'app/views/layouts/header.php';
        require_once 'app/views/layouts/sidebar.php';
        require_once 'app/views/layouts/navbar.php';
        require_once 'app/views/dashboard/index.php';
        require_once 'app/views/layouts/footer.php';
    }
}
