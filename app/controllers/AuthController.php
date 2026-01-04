<?php
require_once 'app/models/User.php';

class AuthController
{
    private $userModel;
    private $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->userModel = new User($this->db);
    }

    public function login()
    {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = $this->userModel->login($email, $password);

            if ($user) {
                // Set Session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['balance'] = $user['balance']; // Simpan balance ke session

                // Gunakan redirect yang fleksibel
                header("Location: index.php?url=dashboard");
                exit;
            } else {
                // Ini akan muncul di tampilan login.php jika gagal
                $error = "Email atau Password salah!";
            }
        }
        require_once 'app/views/auth/login.php';
    }

    public function register()
    {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            if ($this->userModel->register($name, $email, $password)) {
                header("Location: index.php?url=login");
                exit;
            } else {
                $error = "Gagal mendaftar. Email mungkin sudah digunakan.";
            }
        }
        require_once 'app/views/auth/register.php';
    }

    public function logout()
    {
        session_start();
        session_unset();
        session_destroy();
        header("Location: index.php?url=login");
        exit;
    }
}
