<?php
require_once 'app/core/AuthMiddleware.php';
require_once 'app/models/Question.php';
require_once 'app/models/AssessmentGroup.php';

class QuestionController
{
    private $questionModel;
    private $groupModel;

    public function __construct()
    {
        $db = (new Database())->getConnection();
        $this->questionModel = new Question($db);
        $this->groupModel = new AssessmentGroup($db);
    }

    public function index()
    {
        AuthMiddleware::isAdmin();
        $data['title'] = 'Manajemen Kuesioner';

        require_once 'app/views/layouts/header.php';
        require_once 'app/views/layouts/sidebar.php';
        require_once 'app/views/layouts/navbar.php';
        require_once 'app/views/questions/index.php';
        require_once 'app/views/layouts/footer.php';
    }

    public function create()
    {
        AuthMiddleware::isAdmin();
        $data['title'] = 'Tambah Pertanyaan';
        $data['groups'] = $this->groupModel->getAll();

        require_once 'app/views/layouts/header.php';
        require_once 'app/views/layouts/sidebar.php';
        require_once 'app/views/layouts/navbar.php';
        require_once 'app/views/questions/create.php';
        require_once 'app/views/layouts/footer.php';
    }

    public function edit($id)
    {
        AuthMiddleware::isAdmin();
        $data['title'] = 'Edit Pertanyaan';

        // Direct model access
        $data['q'] = $this->questionModel->getById($id);

        if (!$data['q']) {
            $_SESSION['error'] = 'Soal tidak ditemukan';
            header("Location: index.php?url=questions");
            exit;
        }

        $data['groups'] = $this->groupModel->getAll();

        require_once 'app/views/layouts/header.php';
        require_once 'app/views/layouts/sidebar.php';
        require_once 'app/views/layouts/navbar.php';
        require_once 'app/views/questions/edit.php';
        require_once 'app/views/layouts/footer.php';
    }
}
