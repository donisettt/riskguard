<?php
require_once 'app/models/User.php';

class ProfileController
{
    private $userModel;
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
        $this->userModel = new User($this->db);
    }

    /**
     * GET /api/profile - Get current user profile
     */
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            $this->sendResponse(405, false, 'Method not allowed');
            return;
        }

        // Check authentication
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) {
            $this->sendResponse(403, false, 'Unauthorized. Please login first');
            return;
        }

        try {
            $userId = $_SESSION['user_id'];
            $userData = $this->userModel->getById($userId);

            if (!$userData) {
                $this->sendResponse(404, false, 'User not found');
                return;
            }

            // Remove sensitive data
            unset($userData['password']);

            $this->sendResponse(200, true, 'Profile data retrieved successfully', $userData);
        } catch (Exception $e) {
            $this->sendResponse(500, false, 'Error: ' . $e->getMessage());
        }
    }

    /**
     * POST /api/profile/update - Update profile (name & email)
     */
    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->sendResponse(405, false, 'Method not allowed');
            return;
        }

        // Check authentication
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) {
            $this->sendResponse(403, false, 'Unauthorized. Please login first');
            return;
        }

        try {
            // Validate required fields
            if (empty($_POST['name'])) {
                $this->sendResponse(400, false, 'Nama wajib diisi');
                return;
            }

            if (empty($_POST['email'])) {
                $this->sendResponse(400, false, 'Email wajib diisi');
                return;
            }

            // Validate email format
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $this->sendResponse(400, false, 'Format email tidak valid');
                return;
            }

            $userId = $_SESSION['user_id'];
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);

            $result = $this->userModel->updateProfile($userId, $name, $email);

            if ($result) {
                // Update session name
                $_SESSION['name'] = $name;
                $this->sendResponse(200, true, 'Profil berhasil diperbarui');
            } else {
                $this->sendResponse(400, false, 'Email sudah digunakan pengguna lain');
            }
        } catch (Exception $e) {
            $this->sendResponse(500, false, 'Error: ' . $e->getMessage());
        }
    }

    /**
     * POST /api/profile/change-password - Change password
     */
    public function changePassword()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->sendResponse(405, false, 'Method not allowed');
            return;
        }

        // Check authentication
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) {
            $this->sendResponse(403, false, 'Unauthorized. Please login first');
            return;
        }

        try {
            // Validate required fields
            if (empty($_POST['old_password'])) {
                $this->sendResponse(400, false, 'Password lama wajib diisi');
                return;
            }

            if (empty($_POST['new_password'])) {
                $this->sendResponse(400, false, 'Password baru wajib diisi');
                return;
            }

            if (empty($_POST['confirm_password'])) {
                $this->sendResponse(400, false, 'Konfirmasi password wajib diisi');
                return;
            }

            $userId = $_SESSION['user_id'];
            $oldPassword = $_POST['old_password'];
            $newPassword = $_POST['new_password'];
            $confirmPassword = $_POST['confirm_password'];

            // Verify old password
            if (!$this->userModel->verifyPassword($userId, $oldPassword)) {
                $this->sendResponse(400, false, 'Password lama salah');
                return;
            }

            // Check new password match
            if ($newPassword !== $confirmPassword) {
                $this->sendResponse(400, false, 'Konfirmasi password baru tidak cocok');
                return;
            }

            // Validate password length
            if (strlen($newPassword) < 6) {
                $this->sendResponse(400, false, 'Password minimal 6 karakter');
                return;
            }

            $result = $this->userModel->updatePassword($userId, $newPassword);

            if ($result) {
                $this->sendResponse(200, true, 'Password berhasil diubah');
            } else {
                $this->sendResponse(500, false, 'Gagal mengubah password');
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
