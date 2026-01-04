<?php
require_once 'app/core/AuthMiddleware.php';
require_once 'app/models/AssessmentGroup.php';

class AssessmentGroupController
{
    private $groupModel;

    public function __construct()
    {
        $db = (new Database())->getConnection();
        $this->groupModel = new AssessmentGroup($db);
    }

    // Halaman list grup assessment (admin)
    public function index()
    {
        AuthMiddleware::isAdmin();

        $limit = 10;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $page = $page < 1 ? 1 : $page;
        $offset = ($page - 1) * $limit;

        $data['title'] = 'Manajemen Grup Assessment';
        $data['groups'] = $this->groupModel->getPaginated($limit, $offset);
        $data['totalData'] = $this->groupModel->countAll();
        $data['totalPages'] = ceil($data['totalData'] / $limit);
        $data['currentPage'] = $page;
        $data['limit'] = $limit;

        require_once 'app/views/layouts/header.php';
        require_once 'app/views/layouts/sidebar.php';
        require_once 'app/views/layouts/navbar.php';
        require_once 'app/views/assessment_groups/index.php';
        require_once 'app/views/layouts/footer.php';
    }

    // Halaman create grup
    public function create()
    {
        AuthMiddleware::isAdmin();
        $data['title'] = 'Tambah Grup Assessment';

        require_once 'app/views/layouts/header.php';
        require_once 'app/views/layouts/sidebar.php';
        require_once 'app/views/layouts/navbar.php';
        require_once 'app/views/assessment_groups/create.php';
        require_once 'app/views/layouts/footer.php';
    }

    // Proses simpan grup baru
    public function store()
    {
        AuthMiddleware::isAdmin();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
            $description = $_POST['description'];

            if ($this->groupModel->create($title, $description)) {
                header("Location: index.php?url=assessment-groups");
            } else {
                echo "Gagal menyimpan data.";
            }
        }
    }

    // Halaman edit grup
    public function edit($id)
    {
        AuthMiddleware::isAdmin();
        $data['title'] = 'Edit Grup Assessment';
        $data['group'] = $this->groupModel->getById($id);

        if (!$data['group']) {
            header("Location: index.php?url=assessment-groups");
            exit;
        }

        require_once 'app/views/layouts/header.php';
        require_once 'app/views/layouts/sidebar.php';
        require_once 'app/views/layouts/navbar.php';
        require_once 'app/views/assessment_groups/edit.php';
        require_once 'app/views/layouts/footer.php';
    }

    // Proses update grup
    public function update($id)
    {
        AuthMiddleware::isAdmin();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $title = $_POST['title'];
            $description = $_POST['description'];

            if ($this->groupModel->update($id, $title, $description)) {
                header("Location: index.php?url=assessment-groups");
            } else {
                echo "Gagal mengupdate data.";
            }
        }
    }

    // Hapus grup
    public function delete($id)
    {
        AuthMiddleware::isAdmin();
        if ($this->groupModel->delete($id)) {
            header("Location: index.php?url=assessment-groups");
        } else {
            echo "Gagal menghapus data.";
        }
    }
}
