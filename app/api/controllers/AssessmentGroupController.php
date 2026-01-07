<?php
require_once 'app/models/AssessmentGroup.php';

class AssessmentGroupController
{
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
        $this->groupModel = new AssessmentGroup($this->db);
    }

    /**
     * GET - List all assessment groups with pagination
     * Method: GET
     * URL: /api/assessment-groups?page=1&limit=10
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
            $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 10;
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $page = $page < 1 ? 1 : $page;
            $offset = ($page - 1) * $limit;

            $groups = $this->groupModel->getPaginated($limit, $offset);
            $totalData = $this->groupModel->countAll();
            $totalPages = ceil($totalData / $limit);

            $this->sendResponse(200, true, 'Data retrieved successfully', [
                'groups' => $groups,
                'pagination' => [
                    'current_page' => $page,
                    'total_pages' => $totalPages,
                    'total_data' => $totalData,
                    'limit' => $limit
                ]
            ]);
        } catch (Exception $e) {
            $this->sendResponse(500, false, 'Internal server error: ' . $e->getMessage());
        }
    }

    /**
     * GET - Get single assessment group
     * Method: GET
     * URL: /api/assessment-groups/:id
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

        // Check admin permission
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            $this->sendResponse(403, false, 'Unauthorized. Admin access required');
            return;
        }

        try {
            $group = $this->groupModel->getById($id);

            if ($group) {
                $this->sendResponse(200, true, 'Data retrieved successfully', $group);
            } else {
                $this->sendResponse(404, false, 'Assessment group not found');
            }
        } catch (Exception $e) {
            $this->sendResponse(500, false, 'Internal server error: ' . $e->getMessage());
        }
    }

    /**
     * POST - Create new assessment group
     * Method: POST
     * URL: /api/assessment-groups
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

        // Validation
        if (empty($_POST['title'])) {
            $this->sendResponse(400, false, 'Title is required');
            return;
        }

        $title = $_POST['title'];
        $description = $_POST['description'] ?? '';

        try {
            $result = $this->groupModel->create($title, $description);

            if ($result) {
                $this->sendResponse(201, true, 'Assessment group created successfully', [
                    'title' => $title
                ]);
            } else {
                $this->sendResponse(400, false, 'Failed to create assessment group');
            }
        } catch (Exception $e) {
            $this->sendResponse(500, false, 'Internal server error: ' . $e->getMessage());
        }
    }

    /**
     * POST - Update assessment group
     * Method: POST
     * URL: /api/assessment-groups/:id
     */
    public function update($id)
    {
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
        if (empty($_POST['title'])) {
            $this->sendResponse(400, false, 'Title is required');
            return;
        }

        $title = $_POST['title'];
        $description = $_POST['description'] ?? '';

        try {
            $result = $this->groupModel->update($id, $title, $description);

            if ($result) {
                $this->sendResponse(200, true, 'Assessment group updated successfully');
            } else {
                $this->sendResponse(404, false, 'Assessment group not found or no changes made');
            }
        } catch (Exception $e) {
            $this->sendResponse(500, false, 'Internal server error: ' . $e->getMessage());
        }
    }

    /**
     * DELETE - Delete assessment group
     * Method: DELETE
     * URL: /api/assessment-groups/:id
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
            $result = $this->groupModel->delete($id);

            if ($result) {
                $this->sendResponse(200, true, 'Assessment group deleted successfully');
            } else {
                $this->sendResponse(400, false, 'Failed to delete assessment group');
            }
        } catch (Exception $e) {
            $this->sendResponse(500, false, 'Internal server error: ' . $e->getMessage());
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
        exit;
    }
}
