<?php
require_once 'app/core/AuthMiddleware.php';
require_once 'app/models/Simulation.php';
require_once 'app/models/RNGGame.php';
require_once 'app/models/User.php';
require_once 'config/Database.php';

class SimulatorController
{
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
    }

    public function index()
    {
        AuthMiddleware::check();

        // Ambil game yang aktif
        $gameModel = new RNGGame($this->db);
        $data['title'] = 'Simulator RNG - Pilih Game';
        $data['games'] = $gameModel->getActiveGames();

        require_once 'app/views/layouts/header.php';
        require_once 'app/views/layouts/sidebar.php';
        require_once 'app/views/layouts/navbar.php';
        require_once 'app/views/simulator/index.php';
        require_once 'app/views/layouts/footer.php';
    }

    public function play($gameId)
    {
        AuthMiddleware::check();

        // Ambil detail game
        $gameModel = new RNGGame($this->db);
        $data['game'] = $gameModel->getById($gameId);

        if (!$data['game']) {
            $_SESSION['message'] = 'Game tidak ditemukan!';
            $_SESSION['message_type'] = 'danger';
            header('Location: /sigma/simulator');
            exit();
        }

        if ($data['game']['is_active'] != 1) {
            $_SESSION['message'] = 'Game ini sedang tidak aktif!';
            $_SESSION['message_type'] = 'warning';
            header('Location: /sigma/simulator');
            exit();
        }

        // Ambil balance user dari database
        $userModel = new User($this->db);
        $data['user_balance'] = $userModel->getBalance($_SESSION['user_id']);

        $data['title'] = 'Main ' . $data['game']['name'];

        require_once 'app/views/layouts/header.php';
        require_once 'app/views/layouts/sidebar.php';
        require_once 'app/views/layouts/navbar.php';
        require_once 'app/views/simulator/play.php';
        require_once 'app/views/layouts/footer.php';
    }

    // API Endpoint untuk menyimpan hasil via AJAX
    public function save()
    {
        AuthMiddleware::check();

        // Baca input JSON dari Javascript
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        if ($data) {
            $model = new Simulation($this->db);
            $userModel = new User($this->db);

            $user_id = $_SESSION['user_id'];
            $rounds = $data['rounds'];
            $initial = $data['initial'];
            $final = $data['final'];
            $game_id = isset($data['game_id']) ? $data['game_id'] : null;

            // Update balance user
            $userModel->updateBalance($user_id, $final);

            if ($model->saveResult($user_id, $rounds, $initial, $final, $game_id)) {
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error']);
            }
        }
    }

    // API Endpoint untuk update balance secara berkala
    public function updateBalance()
    {
        AuthMiddleware::check();

        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        if ($data && isset($data['balance'])) {
            $userModel = new User($this->db);
            $user_id = $_SESSION['user_id'];

            if ($userModel->updateBalance($user_id, $data['balance'])) {
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid data']);
        }
    }

    // History untuk admin - melihat semua simulasi user
    public function history()
    {
        AuthMiddleware::check();
        AuthMiddleware::requireAdmin();

        $model = new Simulation($this->db);

        // Pagination
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 10; // Changed to 10 per page
        $offset = ($page - 1) * $limit;

        // Get filters from query parameters
        $filters = [];
        if (!empty($_GET['user_id'])) {
            $filters['user_id'] = $_GET['user_id'];
        }
        if (!empty($_GET['game_type'])) {
            $filters['game_type'] = $_GET['game_type'];
        }
        if (!empty($_GET['date_from'])) {
            $filters['date_from'] = $_GET['date_from'];
        }
        if (!empty($_GET['date_to'])) {
            $filters['date_to'] = $_GET['date_to'];
        }

        // Ambil data
        $data['title'] = 'History Simulasi User';
        $data['history'] = $model->getAllHistory($limit, $offset, $filters);
        $data['statistics'] = $model->getStatistics();
        $data['total_records'] = $model->getTotalCount($filters);
        $data['current_page'] = $page;
        $data['total_pages'] = ceil($data['total_records'] / $limit);

        // Data for filter dropdowns
        $data['users'] = $model->getAllUsers();
        $data['game_types'] = $model->getAllGameTypes();
        $data['filters'] = $filters;

        require_once 'app/views/layouts/header.php';
        require_once 'app/views/layouts/sidebar.php';
        require_once 'app/views/layouts/navbar.php';
        require_once 'app/views/simulator/history.php';
        require_once 'app/views/layouts/footer.php';
    }

    // Detail history per user
    public function userHistory($userId)
    {
        AuthMiddleware::check();
        AuthMiddleware::requireAdmin();

        $model = new Simulation($this->db);

        $data['title'] = 'History User';
        $data['history'] = $model->getUserHistory($userId);
        $data['statistics'] = $model->getUserStatistics($userId);

        // Ambil info user
        $userModel = new User($this->db);
        $data['user'] = $userModel->getById($userId);

        require_once 'app/views/layouts/header.php';
        require_once 'app/views/layouts/sidebar.php';
        require_once 'app/views/layouts/navbar.php';
        require_once 'app/views/simulator/user_history.php';
        require_once 'app/views/layouts/footer.php';
    }
}
