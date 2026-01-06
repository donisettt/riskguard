<?php
require_once 'app/core/AuthMiddleware.php';
require_once 'app/models/Question.php';
require_once 'app/models/Assessment.php';
require_once 'app/models/AssessmentGroup.php';

class AssessmentController
{
    private $db;
    private $questionModel;
    private $assessmentModel;
    private $groupModel;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->questionModel = new Question($this->db);
        $this->assessmentModel = new Assessment($this->db);
        $this->groupModel = new AssessmentGroup($this->db);
    }

    // Halaman List Grup Assessment (User memilih grup)
    public function index()
    {
        AuthMiddleware::check();

        // Prevent caching
        header("Cache-Control: no-cache, no-store, must-revalidate");
        header("Pragma: no-cache");
        header("Expires: 0");

        $data['title'] = 'Pilih Grup Assessment';
        $groups = $this->groupModel->getGroupsWithQuestions();

        // Cek status assessment untuk setiap grup
        $user_id = $_SESSION['user_id'];
        foreach ($groups as &$group) {
            $group['is_completed'] = $this->assessmentModel->hasCompletedGroup($user_id, $group['id']);
            $group['completed_date'] = $this->assessmentModel->getLastCompletedDate($user_id, $group['id']);
        }
        unset($group); // PENTING: hapus reference untuk menghindari bug

        $data['groups'] = $groups;

        require_once 'app/views/layouts/header.php';
        require_once 'app/views/layouts/sidebar.php';
        require_once 'app/views/layouts/navbar.php';
        require_once 'app/views/assessment/group_list.php';
        require_once 'app/views/layouts/footer.php';
    }

    // Halaman Form Kuesioner berdasarkan grup
    public function form($group_id)
    {
        AuthMiddleware::check();

        $group = $this->groupModel->getById($group_id);
        if (!$group) {
            header("Location: index.php?url=assessment");
            exit;
        }

        // Cek apakah user sudah pernah mengikuti assessment ini
        $user_id = $_SESSION['user_id'];
        if ($this->assessmentModel->hasCompletedGroup($user_id, $group_id)) {
            echo "<script>alert('Anda sudah pernah mengikuti assessment ini.'); window.location.href='index.php?url=assessment';</script>";
            exit;
        }

        $data['title'] = 'Assessment: ' . $group['title'];
        $data['group'] = $group;
        $data['questions'] = $this->questionModel->getByGroupId($group_id);

        if (empty($data['questions'])) {
            echo "<script>alert('Grup ini belum memiliki soal.'); window.location.href='index.php?url=assessment';</script>";
            exit;
        }

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
            $group_id = $_POST['group_id'] ?? null;
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
            $assessment_id = $this->assessmentModel->create($user_id, $total_score, $risk_level, $group_id);

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
