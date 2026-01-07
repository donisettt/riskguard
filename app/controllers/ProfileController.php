<?php
require_once 'app/core/AuthMiddleware.php';
require_once 'app/models/User.php';

class ProfileController
{
    private $userModel;

    public function __construct()
    {
        $db = (new Database())->getConnection();
        $this->userModel = new User($db);
    }

    public function index()
    {
        AuthMiddleware::check();
        $data['title'] = 'Pengaturan Akun';
        $data['user_data'] = $this->userModel->getById($_SESSION['user_id']);

        require_once 'app/views/layouts/header.php';
        require_once 'app/views/layouts/sidebar.php';
        require_once 'app/views/layouts/navbar.php';
        require_once 'app/views/profile/index.php';
        require_once 'app/views/layouts/footer.php';
    }
}
