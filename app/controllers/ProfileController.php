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

        // Cek pesan notifikasi dari session (Flash message sederhana)
        $data['success'] = isset($_SESSION['flash_success']) ? $_SESSION['flash_success'] : null;
        $data['error'] = isset($_SESSION['flash_error']) ? $_SESSION['flash_error'] : null;

        // Hapus flash message setelah diambil
        unset($_SESSION['flash_success']);
        unset($_SESSION['flash_error']);

        require_once 'app/views/layouts/header.php';
        require_once 'app/views/layouts/sidebar.php';
        require_once 'app/views/layouts/navbar.php';
        require_once 'app/views/profile/index.php';
        require_once 'app/views/layouts/footer.php';
    }

    public function update()
    {
        AuthMiddleware::check();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $id = $_SESSION['user_id'];

            if ($this->userModel->updateProfile($id, $name, $email)) {
                $_SESSION['name'] = $name; // Update nama di session agar navbar berubah lgsg
                $_SESSION['flash_success'] = "Profil berhasil diperbarui.";
            } else {
                $_SESSION['flash_error'] = "Email sudah digunakan pengguna lain.";
            }
            header("Location: index.php?url=profile");
        }
    }

    public function change_password()
    {
        AuthMiddleware::check();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_SESSION['user_id'];
            $old_pass = $_POST['old_password'];
            $new_pass = $_POST['new_password'];
            $confirm_pass = $_POST['confirm_password'];

            if (!$this->userModel->verifyPassword($id, $old_pass)) {
                $_SESSION['flash_error'] = "Password lama salah.";
            } elseif ($new_pass !== $confirm_pass) {
                $_SESSION['flash_error'] = "Konfirmasi password baru tidak cocok.";
            } elseif (strlen($new_pass) < 6) {
                $_SESSION['flash_error'] = "Password minimal 6 karakter.";
            } else {
                if ($this->userModel->updatePassword($id, $new_pass)) {
                    $_SESSION['flash_success'] = "Password berhasil diubah.";
                } else {
                    $_SESSION['flash_error'] = "Gagal mengubah password.";
                }
            }
            header("Location: index.php?url=profile");
        }
    }
}
