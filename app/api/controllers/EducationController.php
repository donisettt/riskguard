<?php
require_once 'app/models/Education.php';

class EducationController
{
    private $educationModel;
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
        $this->educationModel = new Education($this->db);
    }

    /**
     * GET - List all education content
     * Method: GET
     * URL: /api/education
     */
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            $this->sendResponse(405, false, 'Method not allowed');
            return;
        }

        try {
            $articles = $this->educationModel->getAll();
            $this->sendResponse(200, true, 'Data retrieved successfully', [
                'articles' => $articles,
                'count' => count($articles)
            ]);
        } catch (Exception $e) {
            $this->sendResponse(500, false, 'Internal server error: ' . $e->getMessage());
        }
    }

    /**
     * GET - Get single education content
     * Method: GET
     * URL: /api/education/:id
     */
    public function show($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            $this->sendResponse(405, false, 'Method not allowed');
            return;
        }

        if (empty($id)) {
            $this->sendResponse(400, false, 'ID is required');
            return;
        }

        try {
            $article = $this->educationModel->getById($id);

            if ($article) {
                $this->sendResponse(200, true, 'Data retrieved successfully', $article);
            } else {
                $this->sendResponse(404, false, 'Article not found');
            }
        } catch (Exception $e) {
            $this->sendResponse(500, false, 'Internal server error: ' . $e->getMessage());
        }
    }

    /**
     * POST - Create new education content
     * Method: POST
     * URL: /api/education
     * Body: multipart/form-data (with file upload)
     */
    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->sendResponse(405, false, 'Method not allowed');
            return;
        }

        // Validation
        if (empty($_POST['title']) || empty($_POST['content'])) {
            $this->sendResponse(400, false, 'Title and content are required');
            return;
        }

        // Check admin permission (dari session atau token)
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            $this->sendResponse(403, false, 'Unauthorized. Admin access required');
            return;
        }

        $title = $_POST['title'];
        $content = $_POST['content'];
        $created_by = $_SESSION['user_id'];

        // Handle file upload
        $banner = 'default.jpg';
        if (isset($_FILES['banner']) && $_FILES['banner']['error'] == 0) {
            $target_dir = "public/uploads/";

            // Create directory if not exists
            if (!file_exists($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            $filename = time() . "_" . basename($_FILES["banner"]["name"]);
            $target_file = $target_dir . $filename;

            // Validate file type
            $allowed_types = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
            $file_type = $_FILES['banner']['type'];

            if (!in_array($file_type, $allowed_types)) {
                $this->sendResponse(400, false, 'Invalid file type. Only JPG, PNG, and GIF are allowed');
                return;
            }

            // Validate file size (max 5MB)
            if ($_FILES['banner']['size'] > 5 * 1024 * 1024) {
                $this->sendResponse(400, false, 'File size too large. Maximum 5MB');
                return;
            }

            if (move_uploaded_file($_FILES["banner"]["tmp_name"], $target_file)) {
                $banner = $filename;
            } else {
                $this->sendResponse(500, false, 'Failed to upload file');
                return;
            }
        }

        try {
            $result = $this->educationModel->create($title, $banner, $content, $created_by);

            if ($result) {
                $this->sendResponse(201, true, 'Article created successfully', [
                    'title' => $title,
                    'banner' => $banner
                ]);
            } else {
                $this->sendResponse(400, false, 'Failed to create article');
            }
        } catch (Exception $e) {
            $this->sendResponse(500, false, 'Internal server error: ' . $e->getMessage());
        }
    }

    /**
     * PUT/POST - Update education content
     * Method: POST (with _method=PUT) or PUT
     * URL: /api/education/:id
     * Body: multipart/form-data
     */
    public function update($id)
    {
        // Accept both PUT and POST
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method !== 'POST' && $method !== 'PUT') {
            $this->sendResponse(405, false, 'Method not allowed');
            return;
        }

        if (empty($id)) {
            $this->sendResponse(400, false, 'ID is required');
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

        // Validation
        if (empty($_POST['title']) || empty($_POST['content'])) {
            $this->sendResponse(400, false, 'Title and content are required');
            return;
        }

        $title = $_POST['title'];
        $content = $_POST['content'];
        $old_banner = $_POST['old_banner'] ?? 'default.jpg';
        $banner = $old_banner;

        // Handle file upload if exists
        if (isset($_FILES['banner']) && $_FILES['banner']['error'] == 0) {
            $target_dir = "public/uploads/";
            $filename = time() . "_" . basename($_FILES["banner"]["name"]);
            $target_file = $target_dir . $filename;

            // Validate file type
            $allowed_types = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif'];
            $file_type = $_FILES['banner']['type'];

            if (!in_array($file_type, $allowed_types)) {
                $this->sendResponse(400, false, 'Invalid file type. Only JPG, PNG, and GIF are allowed');
                return;
            }

            // Validate file size (max 5MB)
            if ($_FILES['banner']['size'] > 5 * 1024 * 1024) {
                $this->sendResponse(400, false, 'File size too large. Maximum 5MB');
                return;
            }

            if (move_uploaded_file($_FILES["banner"]["tmp_name"], $target_file)) {
                $banner = $filename;

                // Delete old file
                if ($old_banner != 'default.jpg' && file_exists($target_dir . $old_banner)) {
                    unlink($target_dir . $old_banner);
                }
            }
        }

        try {
            $result = $this->educationModel->update($id, $title, $banner, $content);

            if ($result) {
                $this->sendResponse(200, true, 'Article updated successfully');
            } else {
                $this->sendResponse(404, false, 'Article not found or no changes made');
            }
        } catch (Exception $e) {
            $this->sendResponse(500, false, 'Internal server error: ' . $e->getMessage());
        }
    }

    /**
     * DELETE - Delete education content
     * Method: DELETE or POST with _method=DELETE
     * URL: /api/education/:id
     */
    public function delete($id)
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method !== 'DELETE' && $method !== 'POST') {
            $this->sendResponse(405, false, 'Method not allowed');
            return;
        }

        if (empty($id)) {
            $this->sendResponse(400, false, 'ID is required');
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
            // Get article data to delete banner file
            $article = $this->educationModel->getById($id);

            if (!$article) {
                $this->sendResponse(404, false, 'Article not found');
                return;
            }

            $result = $this->educationModel->delete($id);

            if ($result) {
                // Delete banner file
                if ($article['banner'] != 'default.jpg') {
                    $file_path = "public/uploads/" . $article['banner'];
                    if (file_exists($file_path)) {
                        unlink($file_path);
                    }
                }

                $this->sendResponse(200, true, 'Article deleted successfully');
            } else {
                $this->sendResponse(400, false, 'Failed to delete article');
            }
        } catch (Exception $e) {
            $this->sendResponse(500, false, 'Internal server error: ' . $e->getMessage());
        }
    }

    /**
     * Helper function untuk mengirim response JSON
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

        echo json_encode($response, JSON_PRETTY_PRINT);
        exit;
    }
}
