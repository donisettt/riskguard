<?php
class AuthMiddleware
{
    public static function check()
    {
        // Cek apakah session user_id ada
        if (!isset($_SESSION['user_id'])) {
            header("Location: /sigma/login");
            exit;
        }
    }

    public static function isAdmin()
    {
        if ($_SESSION['role'] !== 'admin') {
            echo "Akses Ditolak: Halaman ini khusus Admin.";
            exit;
        }
    }

    public static function requireAdmin()
    {
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            $_SESSION['message'] = 'Akses ditolak! Halaman ini khusus untuk admin.';
            $_SESSION['message_type'] = 'danger';
            header("Location: /sigma/dashboard");
            exit;
        }
    }
}
