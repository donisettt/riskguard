<?php
class AuthMiddleware
{
    public static function check()
    {
        // Cek apakah session user_id ada
        if (!isset($_SESSION['user_id'])) {
            header("Location: /uas_risk_project/login");
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
}
