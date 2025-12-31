<?php
session_start();

// Load Config & Core
require_once 'config/Database.php';

// Simple Router Logic
$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : 'login';
$url = explode('/', $url);

// Controller Default
$controllerName = 'AuthController';
$methodName = 'index'; // Default method (biasanya halaman login)

// Routing Logika
if (isset($url[0])) {
    // Route Auth (Login/Register/Logout)
    if (in_array($url[0], ['login', 'register', 'logout'])) {
        require_once 'app/controllers/AuthController.php';
        $controller = new AuthController();
        if ($url[0] == 'register') {
            $controller->register();
        } elseif ($url[0] == 'logout') {
            $controller->logout();
        } else {
            $controller->login();
        }
        exit;
    }

    // Route Dashboard
    elseif ($url[0] == 'dashboard') {
        require_once 'app/controllers/DashboardController.php';
        $controller = new DashboardController();
        $controller->index();
        exit;
    }

    // Nanti tambahkan route untuk edukasi, assessment, dll disini
}

// Default jika url kosong / home
require_once 'app/controllers/AuthController.php';
$auth = new AuthController();
$auth->login();
