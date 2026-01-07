<?php

/**
 * Web Auth Controller (Frontend Controller)
 * Bertanggung jawab untuk rendering view dan session management
 * Semua business logic dan data processing dilakukan oleh API Controller
 */
class AuthController
{
    /**
     * Menampilkan halaman login
     * View akan menggunakan AJAX untuk memanggil API
     * Fallback: juga handle traditional POST jika JavaScript tidak berjalan
     */
    public function login()
    {
        // Jika sudah login, redirect ke dashboard
        if (isset($_SESSION['user_id'])) {
            header("Location: index.php?url=dashboard");
            exit;
        }

        // Handle traditional POST (fallback jika JavaScript tidak berjalan)
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email']) && isset($_POST['password'])) {
            // Call API untuk login
            $apiUrl = 'http://localhost/sigma/index.php?url=api/auth/login';
            $postData = json_encode([
                'email' => $_POST['email'],
                'password' => $_POST['password']
            ]);

            $ch = curl_init($apiUrl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

            $response = curl_exec($ch);
            curl_close($ch);

            $result = json_decode($response, true);

            if ($result && $result['success']) {
                // Set session
                $_SESSION['user_id'] = $result['data']['user']['id'];
                $_SESSION['name'] = $result['data']['user']['name'];
                $_SESSION['role'] = $result['data']['user']['role'];
                $_SESSION['balance'] = $result['data']['user']['balance'] ?? 1000000;
                $_SESSION['token'] = $result['data']['token'];

                header("Location: index.php?url=dashboard");
                exit;
            } else {
                $error = $result['message'] ?? 'Login gagal';
            }
        }

        // Tampilkan halaman login
        require_once 'app/views/auth/login.php';
    }

    /**
     * Menampilkan halaman register
     * View akan menggunakan AJAX untuk memanggil API
     * Fallback: juga handle traditional POST jika JavaScript tidak berjalan
     */
    public function register()
    {
        // Jika sudah login, redirect ke dashboard
        if (isset($_SESSION['user_id'])) {
            header("Location: index.php?url=dashboard");
            exit;
        }

        // Handle traditional POST (fallback jika JavaScript tidak berjalan)
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password'])) {
            // Call API untuk register
            $apiUrl = 'http://localhost/sigma/index.php?url=api/auth/register';
            $postData = json_encode([
                'name' => $_POST['name'],
                'email' => $_POST['email'],
                'password' => $_POST['password']
            ]);

            $ch = curl_init($apiUrl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

            $response = curl_exec($ch);
            curl_close($ch);

            $result = json_decode($response, true);

            if ($result && $result['success']) {
                header("Location: index.php?url=login");
                exit;
            } else {
                $error = $result['message'] ?? 'Registrasi gagal';
            }
        }

        // Tampilkan halaman register
        require_once 'app/views/auth/register.php';
    }

    /**
     * Handle callback setelah login sukses dari API
     * Menerima data user dari API dan set session
     * Method: POST
     * Expected: JSON body dengan data user dan token
     */
    public function handleLoginSuccess()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['success' => false, 'message' => 'Method not allowed']);
            return;
        }

        // Ambil data dari request body
        $data = json_decode(file_get_contents("php://input"), true);

        if (!$data || !isset($data['user']) || !isset($data['token'])) {
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => 'Invalid data']);
            return;
        }

        $user = $data['user'];
        $token = $data['token'];

        // Set Session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['name'] = $user['name'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['balance'] = $user['balance'] ?? 1000000;
        $_SESSION['token'] = $token; // Simpan token untuk request API berikutnya

        echo json_encode([
            'success' => true,
            'message' => 'Session created',
            'redirect' => 'index.php?url=dashboard'
        ]);
    }

    /**
     * Logout - hapus session dan redirect ke login
     */
    public function logout()
    {
        // Opsional: Panggil API logout untuk invalidate token
        // if (isset($_SESSION['token'])) {
        //     // Call API to invalidate token
        // }

        session_unset();
        session_destroy();
        header("Location: index.php?url=login");
        exit;
    }
}
