<?php
require_once 'app/core/AuthMiddleware.php';
require_once 'app/models/RNGGame.php';
require_once 'config/Database.php';

class RNGGameController
{
    private $db;
    private $model;

    public function __construct()
    {
        $this->db = (new Database())->getConnection();
        $this->model = new RNGGame($this->db);
    }

    // Tampilkan daftar game RNG (Admin only)
    public function index()
    {
        AuthMiddleware::check();
        AuthMiddleware::requireAdmin();

        $data['title'] = 'Kelola Game RNG';
        $data['games'] = $this->model->getAll();

        require_once 'app/views/layouts/header.php';
        require_once 'app/views/layouts/sidebar.php';
        require_once 'app/views/layouts/navbar.php';
        require_once 'app/views/rng_games/index.php';
        require_once 'app/views/layouts/footer.php';
    }

    // Form tambah game baru
    public function create()
    {
        AuthMiddleware::check();
        AuthMiddleware::requireAdmin();

        $data['title'] = 'Tambah Game RNG Baru';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $gameData = [
                'name' => $_POST['name'],
                'description' => $_POST['description'],
                'game_type' => $_POST['game_type'],
                'symbols' => $_POST['symbols'],
                'rtp' => $_POST['rtp'],
                'bet_cost' => $_POST['bet_cost'],
                'max_payout' => $_POST['max_payout'],
                'is_active' => isset($_POST['is_active']) ? 1 : 0
            ];

            if ($this->model->create($gameData)) {
                $_SESSION['message'] = 'Game RNG berhasil ditambahkan!';
                $_SESSION['message_type'] = 'success';
                header('Location: /sigma/rng-games');
                exit();
            } else {
                $_SESSION['message'] = 'Gagal menambahkan game RNG!';
                $_SESSION['message_type'] = 'danger';
            }
        }

        require_once 'app/views/layouts/header.php';
        require_once 'app/views/layouts/sidebar.php';
        require_once 'app/views/layouts/navbar.php';
        require_once 'app/views/rng_games/create.php';
        require_once 'app/views/layouts/footer.php';
    }

    // Form edit game
    public function edit($id)
    {
        AuthMiddleware::check();
        AuthMiddleware::requireAdmin();

        $data['title'] = 'Edit Game RNG';
        $data['game'] = $this->model->getById($id);

        if (!$data['game']) {
            $_SESSION['message'] = 'Game tidak ditemukan!';
            $_SESSION['message_type'] = 'danger';
            header('Location: /sigma/rng-games');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $gameData = [
                'name' => $_POST['name'],
                'description' => $_POST['description'],
                'game_type' => $_POST['game_type'],
                'symbols' => $_POST['symbols'],
                'rtp' => $_POST['rtp'],
                'bet_cost' => $_POST['bet_cost'],
                'max_payout' => $_POST['max_payout'],
                'is_active' => isset($_POST['is_active']) ? 1 : 0
            ];

            if ($this->model->update($id, $gameData)) {
                $_SESSION['message'] = 'Game RNG berhasil diupdate!';
                $_SESSION['message_type'] = 'success';
                header('Location: /sigma/rng-games');
                exit();
            } else {
                $_SESSION['message'] = 'Gagal mengupdate game RNG!';
                $_SESSION['message_type'] = 'danger';
            }
        }

        require_once 'app/views/layouts/header.php';
        require_once 'app/views/layouts/sidebar.php';
        require_once 'app/views/layouts/navbar.php';
        require_once 'app/views/rng_games/edit.php';
        require_once 'app/views/layouts/footer.php';
    }

    // Hapus game
    public function delete($id)
    {
        AuthMiddleware::check();
        AuthMiddleware::requireAdmin();

        if ($this->model->delete($id)) {
            $_SESSION['message'] = 'Game RNG berhasil dihapus!';
            $_SESSION['message_type'] = 'success';
        } else {
            $_SESSION['message'] = 'Gagal menghapus game RNG!';
            $_SESSION['message_type'] = 'danger';
        }

        header('Location: /sigma/rng-games');
        exit();
    }

    // Toggle status aktif/nonaktif
    public function toggleActive($id)
    {
        AuthMiddleware::check();
        AuthMiddleware::requireAdmin();

        if ($this->model->toggleActive($id)) {
            $_SESSION['message'] = 'Status game berhasil diubah!';
            $_SESSION['message_type'] = 'success';
        } else {
            $_SESSION['message'] = 'Gagal mengubah status game!';
            $_SESSION['message_type'] = 'danger';
        }

        header('Location: /sigma/rng-games');
        exit();
    }
}
