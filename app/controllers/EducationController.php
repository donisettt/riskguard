<?php
require_once 'app/core/AuthMiddleware.php';
require_once 'app/models/Education.php';

class EducationController
{
    private $educationModel;

    public function __construct()
    {
        $db = (new Database())->getConnection();
        $this->educationModel = new Education($db);
    }

    // Halaman Utama (Beda Tampilan Admin vs User)
    public function index()
    {
        AuthMiddleware::check();
        $data['title'] = 'Pusat Edukasi';
        $data['articles'] = $this->educationModel->getAll();

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

    // Method Khusus untuk Admin membuka halaman manajemen (opsional, jika ingin url khusus)
    public function manage()
    {
        AuthMiddleware::isAdmin(); // Cek harus admin
        $this->index(); // Gunakan view yang sama dengan logika di atas
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

    // Proses Simpan Data
    public function store()
    {
        AuthMiddleware::isAdmin();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $created_by = $_SESSION['user_id'];

            // Upload Gambar Sederhana
            $banner = 'default.jpg';
            if (isset($_FILES['banner']) && $_FILES['banner']['error'] == 0) {
                $target_dir = "public/uploads/";
                // Pastikan folder ada
                if (!file_exists($target_dir)) {
                    mkdir($target_dir, 0777, true);
                }

                $filename = time() . "_" . basename($_FILES["banner"]["name"]);
                $target_file = $target_dir . $filename;

                if (move_uploaded_file($_FILES["banner"]["tmp_name"], $target_file)) {
                    $banner = $filename;
                }
            }

            if ($this->educationModel->create($title, $banner, $content, $created_by)) {
                header("Location: /sigma/index.php?url=education");
            } else {
                echo "Gagal menyimpan.";
            }
        }
    }

    // Menampilkan Form Edit
    public function edit($id)
    {
        AuthMiddleware::isAdmin();

        $data['title'] = 'Edit Artikel Edukasi';
        $data['article'] = $this->educationModel->getById($id);

        if (!$data['article']) {
            echo "Data tidak ditemukan!";
            exit;
        }

        require_once 'app/views/layouts/header.php';
        require_once 'app/views/layouts/sidebar.php';
        require_once 'app/views/layouts/navbar.php';
        require_once 'app/views/education/edit.php'; // Kita buat view ini nanti
        require_once 'app/views/layouts/footer.php';
    }

    // Proses Update Data
    public function update_data($id)
    {
        AuthMiddleware::isAdmin();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $old_banner = $_POST['old_banner'];

            // Logika Upload Gambar (Jika user upload gambar baru)
            $banner = $old_banner; // Default pakai gambar lama

            if (isset($_FILES['banner']) && $_FILES['banner']['error'] == 0) {
                $target_dir = "public/uploads/";
                $filename = time() . "_" . basename($_FILES["banner"]["name"]);
                $target_file = $target_dir . $filename;

                if (move_uploaded_file($_FILES["banner"]["tmp_name"], $target_file)) {
                    $banner = $filename; // Update nama file jika berhasil upload

                    // Opsional: Hapus gambar lama agar hemat storage
                    if ($old_banner != 'default.jpg' && file_exists($target_dir . $old_banner)) {
                        unlink($target_dir . $old_banner);
                    }
                }
            }

            if ($this->educationModel->update($id, $title, $banner, $content)) {
                header("Location: /sigma/index.php?url=education");
            } else {
                echo "Gagal mengupdate data.";
            }
        }
    }

    // Hapus Data
    public function delete($id)
    {
        AuthMiddleware::isAdmin();
        if ($this->educationModel->delete($id)) {
            header("Location: /sigma/index.php?url=education");
        }
    }
}
