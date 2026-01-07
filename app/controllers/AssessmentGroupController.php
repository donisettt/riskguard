<?php
require_once 'app/core/AuthMiddleware.php';

/**
 * Web Assessment Group Controller (Frontend Controller)
 * Hanya handle view rendering
 * Business logic ada di API Controller
 */
class AssessmentGroupController
{
    // Halaman list grup assessment (admin)
    public function index()
    {
        AuthMiddleware::isAdmin();

        $data['title'] = 'Manajemen Grup Assessment';

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

    // Halaman edit grup
    public function edit($id)
    {
        AuthMiddleware::isAdmin();
        $data['title'] = 'Edit Grup Assessment';
        $data['group_id'] = $id;

        // Fetch group data directly from model
        require_once 'app/models/AssessmentGroup.php';
        $database = new Database();
        $db = $database->getConnection();
        $groupModel = new AssessmentGroup($db);

        $group = $groupModel->getById($id);

        if (!$group) {
            $_SESSION['error'] = 'Grup assessment tidak ditemukan';
            header('Location: /sigma/index.php?url=assessment-groups');
            exit;
        }

        $data['group'] = $group;

        require_once 'app/views/layouts/header.php';
        require_once 'app/views/layouts/sidebar.php';
        require_once 'app/views/layouts/navbar.php';
        require_once 'app/views/assessment_groups/edit.php';
        require_once 'app/views/layouts/footer.php';
    }
}
