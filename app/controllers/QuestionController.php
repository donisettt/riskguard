<?php
require_once 'app/core/AuthMiddleware.php';
require_once 'app/models/Question.php';

class QuestionController
{
    private $questionModel;

    public function __construct()
    {
        $db = (new Database())->getConnection();
        $this->questionModel = new Question($db);
    }

    public function index()
    {
        AuthMiddleware::isAdmin();

        $limit = 5;
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $page = $page < 1 ? 1 : $page;
        $offset = ($page - 1) * $limit;

        $data['title'] = 'Manajemen Kuesioner';

        // ambil data dengan pagination
        $data['questions'] = $this->questionModel->getPaginated($limit, $offset);

        // total data & total halaman
        $data['totalData'] = $this->questionModel->countAll();
        $data['totalPages'] = ceil($data['totalData'] / $limit);
        $data['currentPage'] = $page;
        $data['limit'] = $limit;

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

        require_once 'app/views/layouts/header.php';
        require_once 'app/views/layouts/sidebar.php';
        require_once 'app/views/layouts/navbar.php';
        require_once 'app/views/questions/create.php';
        require_once 'app/views/layouts/footer.php';
    }

    public function store()
    {
        AuthMiddleware::isAdmin();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->questionModel->create($_POST['question'], $_POST['weight'])) {
                header("Location: index.php?url=questions");
            }
        }
    }

    public function edit($id)
    {
        AuthMiddleware::isAdmin();
        $data['title'] = 'Edit Pertanyaan';
        $data['q'] = $this->questionModel->getById($id);

        require_once 'app/views/layouts/header.php';
        require_once 'app/views/layouts/sidebar.php';
        require_once 'app/views/layouts/navbar.php';
        require_once 'app/views/questions/edit.php';
        require_once 'app/views/layouts/footer.php';
    }

    public function update($id)
    {
        AuthMiddleware::isAdmin();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->questionModel->update($id, $_POST['question'], $_POST['weight'])) {
                header("Location: index.php?url=questions");
            }
        }
    }

    public function delete($id)
    {
        AuthMiddleware::isAdmin();
        if ($this->questionModel->delete($id)) {
            header("Location: index.php?url=questions");
        }
    }
}
