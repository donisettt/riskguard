<?php
require_once 'app/core/AuthMiddleware.php';
require_once 'app/models/Question.php';
require_once 'app/models/Assessment.php';

class AssessmentController
{
    private $db;
    private $questionModel;
    private $assessmentModel;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->questionModel = new Question($this->db);
        $this->assessmentModel = new Assessment($this->db);
    }

    // Halaman Form Kuesioner
    public function index()
    {
        AuthMiddleware::check();

        $data['title'] = 'Self Assessment Risiko Judi Online';
        $data['questions'] = $this->questionModel->getAll();

        require_once 'app/views/layouts/header.php';
        require_once 'app/views/layouts/sidebar.php';
        require_once 'app/views/layouts/navbar.php';
        require_once 'app/views/assessment/form.php';
        require_once 'app/views/layouts/footer.php';
    }

    // Proses Submit Jawaban
    public function submit()
    {
        AuthMiddleware::check();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $answers = $_POST['answers']; // Array [question_id => value]
            $user_id = $_SESSION['user_id'];

            $total_score = 0;

            // 1. Hitung Skor
            foreach ($answers as $q_id => $val) {
                // Ambil bobot soal dari DB agar aman
                $q = $this->questionModel->getById($q_id);
                $weight = $q['weight'];

                // Rumus: Nilai Jawaban (0-3) * Bobot Soal
                $score = intval($val) * floatval($weight);
                $total_score += $score;
            }

            // 2. Tentukan Level Risiko (Logika Sederhana)
            $risk_level = 'Rendah';
            if ($total_score > 5 && $total_score <= 15) {
                $risk_level = 'Sedang';
            } elseif ($total_score > 15 && $total_score <= 30) {
                $risk_level = 'Tinggi';
            } elseif ($total_score > 30) {
                $risk_level = 'Bahaya';
            }

            // 3. Simpan Header
            $assessment_id = $this->assessmentModel->create($user_id, $total_score, $risk_level);

            // 4. Simpan Detail Jawaban
            if ($assessment_id) {
                foreach ($answers as $q_id => $val) {
                    $this->assessmentModel->saveAnswer($assessment_id, $q_id, $val);
                }

                // Redirect ke Hasil
                header("Location: index.php?url=assessment/result");
            } else {
                echo "Gagal menyimpan data.";
            }
        }
    }

    // Halaman Hasil
    public function result()
    {
        AuthMiddleware::check();

        $data['title'] = 'Hasil Analisis Risiko';
        $data['result'] = $this->assessmentModel->getLatestResult($_SESSION['user_id']);

        require_once 'app/views/layouts/header.php';
        require_once 'app/views/layouts/sidebar.php';
        require_once 'app/views/layouts/navbar.php';
        require_once 'app/views/assessment/result.php';
        require_once 'app/views/layouts/footer.php';
    }

    // Halaman Riwayat Assessment User
    public function history()
    {
        AuthMiddleware::check();

        $data['title'] = 'Riwayat Assessment Saya';
        $data['history'] = $this->assessmentModel->getHistoryByUser($_SESSION['user_id']);

        require_once 'app/views/layouts/header.php';
        require_once 'app/views/layouts/sidebar.php';
        require_once 'app/views/layouts/navbar.php';
        require_once 'app/views/assessment/history.php';
        require_once 'app/views/layouts/footer.php';
    }
}
