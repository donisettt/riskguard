<?php
require_once 'app/core/AuthMiddleware.php';

/**
 * Web Education Controller (Frontend Controller)
 * Hanya handle view rendering dan redirect
 * Business logic ada di API Controller
 */
class EducationController
{
    // Halaman Utama (Beda Tampilan Admin vs User)
    public function index()
    {
        AuthMiddleware::check();
        $data['title'] = 'Pusat Edukasi';

        require_once 'app/views/layouts/header.php';
        require_once 'app/views/layouts/sidebar.php';
        require_once 'app/views/layouts/navbar.php';

        // Jika Admin: Tampilkan Tabel Manajemen
        if ($_SESSION['role'] == 'admin') {
            require_once 'app/views/education/admin_list.php';
        } else {
            // Jika User: Tampilkan Grid Artikel
            require_once 'app/views/education/user_index.php';
        }

        require_once 'app/views/layouts/footer.php';
    }

    // Method Khusus untuk Admin membuka halaman manajemen
    public function manage()
    {
        AuthMiddleware::isAdmin();
        $this->index();
    }

    // Menampilkan Form Tambah
    public function create()
    {
        AuthMiddleware::isAdmin();
        $data['title'] = 'Tambah Artikel Edukasi';

        require_once 'app/views/layouts/header.php';
        require_once 'app/views/layouts/sidebar.php';
        require_once 'app/views/layouts/navbar.php';
        require_once 'app/views/education/create.php';
        require_once 'app/views/layouts/footer.php';
    }

    // Menampilkan Form Edit
    public function edit($id)
    {
        AuthMiddleware::isAdmin();

        $data['title'] = 'Edit Artikel Edukasi';

        // Fetch article data directly from model (no API call needed)
        require_once 'app/models/Education.php';
        $database = new Database();
        $db = $database->getConnection();
        $educationModel = new Education($db);

        $article = $educationModel->getById($id);

        if (!$article) {
            $_SESSION['error'] = 'Artikel tidak ditemukan';
            header('Location: /sigma/index.php?url=education');
            exit;
        }

        $data['article'] = $article;

        require_once 'app/views/layouts/header.php';
        require_once 'app/views/layouts/sidebar.php';
        require_once 'app/views/layouts/navbar.php';
        require_once 'app/views/education/edit.php';
        require_once 'app/views/layouts/footer.php';
    }
}
