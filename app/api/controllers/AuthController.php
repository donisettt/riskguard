<?php
require_once 'app/models/User.php';

class AuthController
{
    private $userModel;
    private $db;

    public function __construct()
    {
        // Set header untuk API
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
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
     * API Login
     * Method: POST
     * Body: { "email": "user@email.com", "password": "password123" }
     */
    public function login()
    {
        // Pastikan method POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->sendResponse(405, false, 'Method not allowed');
            return;
        }

        // Ambil data dari request body (JSON)
        $data = json_decode(file_get_contents("php://input"), true);

        // Validasi input
        if (empty($data['email']) || empty($data['password'])) {
            $this->sendResponse(400, false, 'Email dan password harus diisi', null);
            return;
        }

        $email = $data['email'];
        $password = $data['password'];

        // Proses login
        $user = $this->userModel->login($email, $password);

        if ($user) {
            // Buat token sederhana (untuk production gunakan JWT)
            $token = $this->generateToken($user['id']);

            // Simpan token ke database atau session (opsional)
            // Untuk sekarang kita return saja

            // Hapus password dari response
            unset($user['password']);

            $this->sendResponse(200, true, 'Login berhasil', [
                'user' => $user,
                'token' => $token
            ]);
        } else {
            $this->sendResponse(401, false, 'Email atau password salah');
        }
    }

    /**
     * API Register
     * Method: POST
     * Body: { "name": "User Name", "email": "user@email.com", "password": "password123" }
     */
    public function register()
    {
        // Pastikan method POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->sendResponse(405, false, 'Method not allowed');
            return;
        }

        // Ambil data dari request body (JSON)
        $data = json_decode(file_get_contents("php://input"), true);

        // Validasi input
        if (empty($data['name']) || empty($data['email']) || empty($data['password'])) {
            $this->sendResponse(400, false, 'Semua field harus diisi (name, email, password)');
            return;
        }

        // Validasi format email
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->sendResponse(400, false, 'Format email tidak valid');
            return;
        }

        // Validasi panjang password
        if (strlen($data['password']) < 6) {
            $this->sendResponse(400, false, 'Password minimal 6 karakter');
            return;
        }

        $name = $data['name'];
        $email = $data['email'];
        $password = $data['password'];

        // Proses register
        if ($this->userModel->register($name, $email, $password)) {
            $this->sendResponse(201, true, 'Registrasi berhasil', [
                'name' => $name,
                'email' => $email
            ]);
        } else {
            $this->sendResponse(409, false, 'Registrasi gagal. Email mungkin sudah terdaftar');
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

    /**
     * Generate simple token (untuk production gunakan JWT library)
     */
    private function generateToken($userId)
    {
        return base64_encode($userId . '|' . time() . '|' . bin2hex(random_bytes(16)));
    }

    /**
     * Verify token (contoh sederhana)
     */
    public function verifyToken($token)
    {
        try {
            $decoded = base64_decode($token);
            $parts = explode('|', $decoded);

            if (count($parts) !== 3) {
                return false;
            }

            $userId = $parts[0];
            $timestamp = $parts[1];

            // Token expire setelah 24 jam (86400 detik)
            if (time() - $timestamp > 86400) {
                return false;
            }

            return $userId;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * API Logout
     * Method: POST
     * Header: Authorization: Bearer {token}
     */
    public function logout()
    {
        // Pastikan method POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->sendResponse(405, false, 'Method not allowed');
            return;
        }

        // Dalam implementasi sederhana, logout hanya menginformasikan client untuk hapus token
        // Untuk production: hapus token dari database/redis jika disimpan

        $this->sendResponse(200, true, 'Logout berhasil');
    }

    /**
     * API Verify Token
     * Method: GET
     * Header: Authorization: Bearer {token}
     */
    public function verify()
    {
        // Pastikan method GET
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            $this->sendResponse(405, false, 'Method not allowed');
            return;
        }

        // Ambil token dari header Authorization
        $headers = getallheaders();
        $token = null;

        if (isset($headers['Authorization'])) {
            $authHeader = $headers['Authorization'];
            if (preg_match('/Bearer\s+(.*)$/i', $authHeader, $matches)) {
                $token = $matches[1];
            }
        }

        if (!$token) {
            $this->sendResponse(401, false, 'Token tidak ditemukan');
            return;
        }

        // Verify token
        $userId = $this->verifyToken($token);

        if ($userId) {
            // Ambil data user
            $user = $this->userModel->getById($userId);
            if ($user) {
                unset($user['password']);
                $this->sendResponse(200, true, 'Token valid', ['user' => $user]);
            } else {
                $this->sendResponse(404, false, 'User tidak ditemukan');
            }
        } else {
            $this->sendResponse(401, false, 'Token tidak valid atau expired');
        }
    }
}
