<?php
require_once 'app/core/AuthMiddleware.php';
require_once 'app/models/User.php';
require_once 'app/models/Assessment.php';

class RespondentController
{
    private $userModel;
    private $assessmentModel;

    public function __construct()
    {
        $db = (new Database())->getConnection();
        $this->userModel = new User($db);
        $this->assessmentModel = new Assessment($db);
    }

    // Halaman List Semua Responden
    public function index()
    {
        AuthMiddleware::isAdmin();

        $data['title'] = 'Data Responden';
        // Method getAllResponden sudah kita buat di Modul 6 tadi
        $data['respondents'] = $this->userModel->getAllResponden();

        require_once 'app/views/layouts/header.php';
        require_once 'app/views/layouts/sidebar.php';
        require_once 'app/views/layouts/navbar.php';
        require_once 'app/views/respondent/index.php';
        require_once 'app/views/layouts/footer.php';
    }

    // Halaman Detail Jawaban User Tertentu
    public function detail($user_id)
    {
        AuthMiddleware::isAdmin();

        $data['title'] = 'Detail Hasil Assessment';

        // Ambil data assessment terakhir user ini
        $assessment_id = $this->assessmentModel->getLastAssessmentId($user_id);

        if ($assessment_id) {
            $data['result_header'] = $this->assessmentModel->getLatestResult($user_id);
            $data['answers'] = $this->assessmentModel->getDetailAnswers($assessment_id);
        } else {
            $data['result_header'] = null;
        }

        require_once 'app/views/layouts/header.php';
        require_once 'app/views/layouts/sidebar.php';
        require_once 'app/views/layouts/navbar.php';
        require_once 'app/views/respondent/detail.php';
        require_once 'app/views/layouts/footer.php';
    }
}
