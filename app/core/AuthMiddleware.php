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
        // Cek dulu apakah sudah login
        if (!isset($_SESSION['user_id'])) {
            header("Location: /sigma/login");
            exit;
        }

        // Cek apakah role admin
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            $_SESSION['message'] = 'Akses ditolak! Halaman ini khusus untuk admin.';
            $_SESSION['message_type'] = 'danger';
            header("Location: /sigma/dashboard");
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
