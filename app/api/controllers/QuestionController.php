<?php
require_once 'app/models/Question.php';
require_once 'app/models/AssessmentGroup.php';

class QuestionController
{
    private $questionModel;
    private $groupModel;
    private $db;

    public function __construct()
    {
        // Set header untuk API
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Authorization');

        // Handle preflight request
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            http_response_code(200);
            exit;
        }

        $database = new Database();
        $this->db = $database->getConnection();
        $this->questionModel = new Question($this->db);
        $this->groupModel = new AssessmentGroup($this->db);
    }

    /**
     * GET /api/questions - Get all questions with pagination
     */
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            $this->sendResponse(405, false, 'Method not allowed');
            return;
        }

        // Check admin permission
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            $this->sendResponse(403, false, 'Unauthorized. Admin access required');
            return;
        }

        try {

            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
            $page = $page < 1 ? 1 : $page;
            $offset = ($page - 1) * $limit;

            $questions = $this->questionModel->getPaginated($limit, $offset);
            $totalData = $this->questionModel->countAll();
            $totalPages = ceil($totalData / $limit);

            $response = [
                'questions' => $questions,
                'pagination' => [
                    'current_page' => $page,
                    'total_pages' => $totalPages,
                    'total_data' => $totalData,
                    'limit' => $limit
                ]
            ];

            $this->sendResponse(200, true, 'Data berhasil diambil', $response);
        } catch (Exception $e) {
            $this->sendResponse(500, false, 'Error: ' . $e->getMessage());
        }
    }

    /**
     * GET /api/questions/:id - Get single question
     */
    public function show($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            $this->sendResponse(405, false, 'Method not allowed');
            return;
        }

        // Check admin permission
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            $this->sendResponse(403, false, 'Unauthorized. Admin access required');
            return;
        }

        try {
            $question = $this->questionModel->getById($id);

            if (!$question) {
                $this->sendResponse(404, false, 'Soal tidak ditemukan');
                return;
            }

            $this->sendResponse(200, true, 'Data berhasil diambil', $question);
        } catch (Exception $e) {
            $this->sendResponse(500, false, 'Error: ' . $e->getMessage());
        }
    }

    /**
     * GET /api/questions/groups - Get all groups for dropdown
     */
    public function groups()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            $this->sendResponse(405, false, 'Method not allowed');
            return;
        }

        // Check admin permission
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            $this->sendResponse(403, false, 'Unauthorized. Admin access required');
            return;
        }

        try {

            $groups = $this->groupModel->getAll();
            $this->sendResponse(200, true, 'Data grup berhasil diambil', $groups);
        } catch (Exception $e) {
            $this->sendResponse(500, false, 'Error: ' . $e->getMessage());
        }
    }

    /**
     * POST /api/questions - Create new question
     */
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->sendResponse(405, false, 'Method not allowed');
            return;
        }

        // Check admin permission
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            $this->sendResponse(403, false, 'Unauthorized. Admin access required');
            return;
        }

        try {

            // Validate required fields
            if (empty($_POST['question'])) {
                $this->sendResponse(400, false, 'Teks pertanyaan wajib diisi');
                return;
            }

            if (!isset($_POST['weight']) || $_POST['weight'] === '') {
                $this->sendResponse(400, false, 'Bobot risiko wajib diisi');
                return;
            }

            $question = trim($_POST['question']);
            $weight = floatval($_POST['weight']);
            $group_id = !empty($_POST['group_id']) ? intval($_POST['group_id']) : null;

            // Validate weight
            if ($weight < 0) {
                $this->sendResponse(400, false, 'Bobot risiko harus lebih besar dari 0');
                return;
            }

            $result = $this->questionModel->create($question, $weight, $group_id);

            if ($result) {
                $this->sendResponse(200, true, 'Soal berhasil ditambahkan');
            } else {
                $this->sendResponse(500, false, 'Gagal menambahkan soal');
            }
        } catch (Exception $e) {
            $this->sendResponse(500, false, 'Error: ' . $e->getMessage());
        }
    }

    /**
     * POST /api/questions/:id - Update question
     */
    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->sendResponse(405, false, 'Method not allowed');
            return;
        }

        // Check admin permission
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            $this->sendResponse(403, false, 'Unauthorized. Admin access required');
            return;
        }

        try {

            // Check if question exists
            $existing = $this->questionModel->getById($id);
            if (!$existing) {
                $this->sendResponse(404, false, 'Soal tidak ditemukan');
                return;
            }

            // Validate required fields
            if (empty($_POST['question'])) {
                $this->sendResponse(400, false, 'Teks pertanyaan wajib diisi');
                return;
            }

            if (!isset($_POST['weight']) || $_POST['weight'] === '') {
                $this->sendResponse(400, false, 'Bobot risiko wajib diisi');
                return;
            }

            $question = trim($_POST['question']);
            $weight = floatval($_POST['weight']);
            $group_id = !empty($_POST['group_id']) ? intval($_POST['group_id']) : null;

            // Validate weight
            if ($weight < 0) {
                $this->sendResponse(400, false, 'Bobot risiko harus lebih besar dari 0');
                return;
            }

            $result = $this->questionModel->update($id, $question, $weight, $group_id);

            if ($result) {
                $this->sendResponse(200, true, 'Soal berhasil diupdate');
            } else {
                $this->sendResponse(500, false, 'Gagal mengupdate soal');
            }
        } catch (Exception $e) {
            $this->sendResponse(500, false, 'Error: ' . $e->getMessage());
        }
    }

    /**
     * DELETE /api/questions/:id - Delete question
     */
    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
            $this->sendResponse(405, false, 'Method not allowed');
            return;
        }

        // Check admin permission
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            $this->sendResponse(403, false, 'Unauthorized. Admin access required');
            return;
        }

        try {
            // Check if question exists
            $existing = $this->questionModel->getById($id);
            if (!$existing) {
                $this->sendResponse(404, false, 'Soal tidak ditemukan');
                return;
            }

            $result = $this->questionModel->delete($id);

            if ($result) {
                $this->sendResponse(200, true, 'Soal berhasil dihapus');
            } else {
                $this->sendResponse(500, false, 'Gagal menghapus soal');
            }
        } catch (Exception $e) {
            $this->sendResponse(500, false, 'Error: ' . $e->getMessage());
        }
    }

    /**
     * Send JSON response
     */
    private function sendResponse($statusCode, $success, $message, $data = null)
    {
        http_response_code($statusCode);
        $response = [
            'success' => $success,
            'message' => $message
        ];

        if ($data !== null) {
            $response['data'] = $data;
        }

        echo json_encode($response);
    }
}
