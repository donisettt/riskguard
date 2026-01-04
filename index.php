<?php
session_start();

// Load Config & Core
require_once 'config/Database.php';

// Simple Router Logic
$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : 'login';
$url = explode('/', $url);

// Controller Default
$controllerName = 'AuthController';
$methodName = 'index';

// Routing Logika
if (isset($url[0])) {
    // Route untuk API (semua endpoint API dimulai dengan /api)
    if ($url[0] == 'api') {
        // API Authentication
        if (isset($url[1]) && $url[1] == 'auth') {
            require_once 'app/api/controllers/AuthController.php';
            $controller = new AuthController();

            if (isset($url[2])) {
                if ($url[2] == 'login') {
                    $controller->login();
                } elseif ($url[2] == 'register') {
                    $controller->register();
                } else {
                    http_response_code(404);
                    echo json_encode(['success' => false, 'message' => 'API endpoint not found']);
                }
            } else {
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => 'Invalid API request']);
            }
            exit;
        }

        // API endpoint tidak ditemukan
        http_response_code(404);
        echo json_encode(['success' => false, 'message' => 'API endpoint not found']);
        exit;
    }

    // ============ WEB ROUTES ============
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

    // Routing Module Edukasi
    if ($url[0] == 'education') {
        require_once 'app/controllers/EducationController.php';
        $controller = new EducationController();

        $method = isset($url[1]) ? $url[1] : 'index';
        $param = isset($url[2]) ? $url[2] : null;

        if (method_exists($controller, $method)) {
            // Panggil method dengan parameter jika ada
            if ($param) {
                $controller->{$method}($param);
            } else {
                $controller->{$method}();
            }
        } else {
            echo "Method not found";
        }
        exit;
    }

    // Routing Module Assessment Groups (Admin)
    elseif ($url[0] == 'assessment-groups') {
        require_once 'app/controllers/AssessmentGroupController.php';
        $controller = new AssessmentGroupController();

        $method = isset($url[1]) ? $url[1] : 'index';
        $param = isset($url[2]) ? $url[2] : null;

        if (method_exists($controller, $method)) {
            if ($param) $controller->{$method}($param);
            else $controller->{$method}();
        } else {
            echo "Method not found";
        }
        exit;
    }

    // Routing Module Questions (Kuesioner)
    elseif ($url[0] == 'questions') {
        require_once 'app/controllers/QuestionController.php';
        $controller = new QuestionController();

        $method = isset($url[1]) ? $url[1] : 'index';
        $param = isset($url[2]) ? $url[2] : null;

        if (method_exists($controller, $method)) {
            if ($param) $controller->{$method}($param);
            else $controller->{$method}();
        } else {
            echo "Method not found";
        }
        exit;
    }

    // Routing Module Assessment (User Side)
    elseif ($url[0] == 'assessment') {
        require_once 'app/controllers/AssessmentController.php';
        $controller = new AssessmentController();

        $method = isset($url[1]) ? $url[1] : 'index';
        $param = isset($url[2]) ? $url[2] : null;

        if (method_exists($controller, $method)) {
            if ($param) $controller->{$method}($param);
            else $controller->{$method}();
        } else {
            echo "Method not found";
        }
        exit;
    }

    // Routing Module Simulator
    elseif ($url[0] == 'simulator') {
        require_once 'app/controllers/SimulatorController.php';
        $controller = new SimulatorController();

        $method = isset($url[1]) ? $url[1] : 'index';

        if (method_exists($controller, $method)) {
            $controller->{$method}();
        } else {
            $controller->index();
        }
        exit;
    }

    // Routing Module History (Assessment History)
    elseif ($url[0] == 'history') {
        require_once 'app/controllers/AssessmentController.php';
        $controller = new AssessmentController();
        $controller->history();
        exit;
    }

    // Routing Module Data Responden (Admin Only)
    elseif ($url[0] == 'respondent') {
        require_once 'app/controllers/RespondentController.php';
        $controller = new RespondentController();

        $method = isset($url[1]) ? $url[1] : 'index';
        $param = isset($url[2]) ? $url[2] : null;

        if (method_exists($controller, $method)) {
            if ($param) $controller->{$method}($param);
            else $controller->{$method}();
        } else {
            echo "Method not found";
        }
        exit;
    }

    // Routing Module Laporan
    elseif ($url[0] == 'report') {
        require_once 'app/controllers/ReportController.php';
        $controller = new ReportController();
        $controller->index(); // Hanya ada satu halaman utama
        exit;
    }
}

// Default jika url kosong / home
require_once 'app/controllers/AuthController.php';
$auth = new AuthController();
$auth->login();
