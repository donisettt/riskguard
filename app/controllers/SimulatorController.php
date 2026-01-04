<?php
require_once 'app/core/AuthMiddleware.php';
require_once 'app/models/Simulation.php';

class SimulatorController
{
    public function index()
    {
        AuthMiddleware::check();
        $data['title'] = 'Simulator RNG - The Illusion of Control';

        require_once 'app/views/layouts/header.php';
        require_once 'app/views/layouts/sidebar.php';
        require_once 'app/views/layouts/navbar.php';
        require_once 'app/views/simulator/index.php'; // View Game
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
            $db = (new Database())->getConnection();
            $model = new Simulation($db);

            $user_id = $_SESSION['user_id'];
            $rounds = $data['rounds'];
            $initial = $data['initial'];
            $final = $data['final'];

            if ($model->saveResult($user_id, $rounds, $initial, $final)) {
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error']);
            }
        }
    }
}
