<?php
require_once 'app/models/Education.php';
require_once 'app/models/AssessmentGroup.php';

class LandingController
{
    private $educationModel;
    private $assessmentGroupModel;

    public function __construct()
    {
        $database = new Database();
        $db = $database->getConnection();

        $this->educationModel = new Education($db);
        $this->assessmentGroupModel = new AssessmentGroup($db);
    }

    public function index()
    {
        try {
            // Ambil data untuk landing page
            $educations = $this->educationModel->getAll();

            // Ambil assessment dengan jumlah soal menggunakan getPaginated
            $database = new Database();
            $db = $database->getConnection();
            $assessmentGroupModel = new AssessmentGroup($db);
            $assessmentGroups = $assessmentGroupModel->getPaginated(100, 0);

            // Batasi jumlah data yang ditampilkan
            $featuredEducations = array_slice($educations, 0, 3);
            $featuredAssessments = array_slice($assessmentGroups, 0, 3);

            // Hitung statistik
            $totalEducations = count($educations);
            $totalAssessments = $assessmentGroupModel->countAll();
        } catch (Exception $e) {
            // Jika ada error, set default values
            $featuredEducations = [];
            $featuredAssessments = [];
            $totalEducations = 0;
            $totalAssessments = 0;
            error_log("Landing page error: " . $e->getMessage());
        }

        // Load view
        require_once 'app/views/landing/index.php';
    }

    // Method untuk menampilkan detail materi edukasi (public access)
    public function showEducation($id)
    {
        try {
            // Ambil data materi edukasi berdasarkan ID
            $education = $this->educationModel->getById($id);

            if (!$education) {
                // Jika tidak ditemukan, redirect ke landing page
                header('Location: /sigma/');
                exit;
            }

            // Load view detail edukasi
            require_once 'app/views/landing/education_detail.php';
        } catch (Exception $e) {
            error_log("Error showing education: " . $e->getMessage());
            header('Location: /sigma/');
            exit;
        }
    }
}
