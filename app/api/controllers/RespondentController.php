<?php
require_once 'app/models/User.php';
require_once 'app/models/Assessment.php';

class RespondentController
{
    private $userModel;
    private $assessmentModel;
    private $db;

    public function __construct()
    {
        // Set header untuk API
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: GET, OPTIONS');
        header('Access-Control-Allow-Headers: Content-Type, Authorization');

        // Handle preflight request
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            http_response_code(200);
            exit;
        }

        $database = new Database();
        $this->db = $database->getConnection();
        $this->userModel = new User($this->db);
        $this->assessmentModel = new Assessment($this->db);
    }

    /**
     * GET - List all respondents
     * Method: GET
     * URL: /api/respondent
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
            $respondents = $this->userModel->getAllResponden();
            $this->sendResponse(200, true, 'Data retrieved successfully', [
                'respondents' => $respondents,
                'count' => count($respondents)
            ]);
        } catch (Exception $e) {
            $this->sendResponse(500, false, 'Internal server error: ' . $e->getMessage());
        }
    }

    /**
     * GET - Get respondent detail with assessment results
     * Method: GET
     * URL: /api/respondent/:user_id
     */
    public function show($user_id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            $this->sendResponse(405, false, 'Method not allowed');
            return;
        }

        if (empty($user_id)) {
            $this->sendResponse(400, false, 'User ID is required');
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
            // Get last assessment ID
            $assessment_id = $this->assessmentModel->getLastAssessmentId($user_id);

            if ($assessment_id) {
                $result_header = $this->assessmentModel->getLatestResult($user_id);
                $answers = $this->assessmentModel->getDetailAnswers($assessment_id);

                $this->sendResponse(200, true, 'Data retrieved successfully', [
                    'result_header' => $result_header,
                    'answers' => $answers
                ]);
            } else {
                $this->sendResponse(404, false, 'No assessment data found for this user');
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
