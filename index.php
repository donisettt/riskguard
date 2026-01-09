<?php
// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// Load Composer Autoloader
require_once 'vendor/autoload.php';

// Load Config & Core
require_once 'config/Database.php';

// Simple Router Logic
$url = isset($_GET['url']) ? rtrim($_GET['url'], '/') : '';
$url = explode('/', $url);

// Jika tidak ada URL atau URL kosong, tampilkan landing page
if (empty($url[0])) {
    require_once 'app/controllers/LandingController.php';
    $controller = new LandingController();
    $controller->index();
    exit;
}

// Controller Default
$controllerName = 'AuthController';
$methodName = 'index';

// Routing Logika
if (isset($url[0])) {
    // Route untuk landing page
    if ($url[0] == 'landing' || $url[0] == 'home') {
        require_once 'app/controllers/LandingController.php';
        $controller = new LandingController();
        $controller->index();
        exit;
    }

    // Route untuk detail education di landing page (public access)
    if ($url[0] == 'education' && isset($url[1]) && is_numeric($url[1]) && !isset($url[2])) {
        require_once 'app/controllers/LandingController.php';
        $controller = new LandingController();
        $controller->showEducation($url[1]);
        exit;
    }

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

        // API Education
        if (isset($url[1]) && $url[1] == 'education') {
            require_once 'app/api/controllers/EducationController.php';
            $controller = new EducationController();

            // GET /api/education - List all
            if ($_SERVER['REQUEST_METHOD'] === 'GET' && !isset($url[2])) {
                $controller->index();
            }
            // GET /api/education/:id - Get single
            elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($url[2])) {
                $controller->show($url[2]);
            }
            // POST /api/education - Create
            elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($url[2])) {
                $controller->create();
            }
            // POST /api/education/:id - Update
            elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($url[2])) {
                $controller->update($url[2]);
            }
            // DELETE /api/education/:id - Delete
            elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE' && isset($url[2])) {
                $controller->delete($url[2]);
            } else {
                http_response_code(404);
                echo json_encode(['success' => false, 'message' => 'Endpoint not found']);
            }
            exit;
        }

        // API Respondent
        if (isset($url[1]) && $url[1] == 'respondent') {
            require_once 'app/api/controllers/RespondentController.php';
            $controller = new RespondentController();

            // GET /api/respondent - List all
            if ($_SERVER['REQUEST_METHOD'] === 'GET' && !isset($url[2])) {
                $controller->index();
            }
            // GET /api/respondent/:id - Get detail
            elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($url[2])) {
                $controller->show($url[2]);
            } else {
                http_response_code(404);
                echo json_encode(['success' => false, 'message' => 'Endpoint not found']);
            }
            exit;
        }

        // API Assessment Groups
        if (isset($url[1]) && $url[1] == 'assessment-groups') {
            require_once 'app/api/controllers/AssessmentGroupController.php';
            $controller = new AssessmentGroupController();

            // GET /api/assessment-groups - List with pagination
            if ($_SERVER['REQUEST_METHOD'] === 'GET' && !isset($url[2])) {
                $controller->index();
            }
            // GET /api/assessment-groups/:id - Get detail
            elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($url[2])) {
                $controller->show($url[2]);
            }
            // POST /api/assessment-groups - Create
            elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($url[2])) {
                $controller->create();
            }
            // POST /api/assessment-groups/:id - Update
            elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($url[2])) {
                $controller->update($url[2]);
            }
            // DELETE /api/assessment-groups/:id - Delete
            elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE' && isset($url[2])) {
                $controller->delete($url[2]);
            } else {
                http_response_code(404);
                echo json_encode(['success' => false, 'message' => 'Endpoint not found']);
            }
            exit;
        }

        // API Questions
        if (isset($url[1]) && $url[1] == 'questions') {
            require_once 'app/api/controllers/QuestionController.php';
            $controller = new QuestionController();

            // GET /api/questions/groups - Get all groups for dropdown
            if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($url[2]) && $url[2] == 'groups') {
                $controller->groups();
            }
            // GET /api/questions - List with pagination
            elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && !isset($url[2])) {
                $controller->index();
            }
            // GET /api/questions/:id - Get detail
            elseif ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($url[2])) {
                $controller->show($url[2]);
            }
            // POST /api/questions - Create
            elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($url[2])) {
                $controller->create();
            }
            // POST /api/questions/:id - Update
            elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($url[2])) {
                $controller->update($url[2]);
            }
            // DELETE /api/questions/:id - Delete
            elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE' && isset($url[2])) {
                $controller->delete($url[2]);
            } else {
                http_response_code(404);
                echo json_encode(['success' => false, 'message' => 'Endpoint not found']);
            }
            exit;
        }

        // API Profile
        if (isset($url[1]) && $url[1] == 'profile') {
            require_once 'app/api/controllers/ProfileController.php';
            $controller = new ProfileController();

            // GET /api/profile - Get current user profile
            if ($_SERVER['REQUEST_METHOD'] === 'GET' && !isset($url[2])) {
                $controller->index();
            }
            // POST /api/profile/update - Update profile
            elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($url[2]) && $url[2] == 'update') {
                $controller->update();
            }
            // POST /api/profile/change-password - Change password
            elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($url[2]) && $url[2] == 'change-password') {
                $controller->changePassword();
            } else {
                http_response_code(404);
                echo json_encode(['success' => false, 'message' => 'Endpoint not found']);
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

    // Route Auth handleLoginSuccess - untuk set session setelah login via API
    elseif ($url[0] == 'auth' && isset($url[1]) && $url[1] == 'handleLoginSuccess') {
        require_once 'app/controllers/AuthController.php';
        $controller = new AuthController();
        $controller->handleLoginSuccess();
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
        $param = isset($url[2]) ? $url[2] : null;

        if (method_exists($controller, $method)) {
            if ($param) {
                $controller->{$method}($param);
            } else {
                $controller->{$method}();
            }
        } else {
            $controller->index();
        }
        exit;
    }

    // Routing Module RNG Games (Admin Only)
    elseif ($url[0] == 'rng-games') {
        require_once 'app/controllers/RNGGameController.php';
        $controller = new RNGGameController();

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

        $method = isset($url[1]) ? $url[1] : 'index';
        $param = isset($url[2]) ? $url[2] : null;

        if (method_exists($controller, $method)) {
            if ($param) $controller->{$method}($param);
            else $controller->{$method}();
        } else {
            $controller->index();
        }
        exit;
    }

    // Routing Module Profile
    elseif ($url[0] == 'profile') {
        require_once 'app/controllers/ProfileController.php';
        $controller = new ProfileController();

        $method = isset($url[1]) ? $url[1] : 'index';

        if (method_exists($controller, $method)) {
            $controller->{$method}();
        } else {
            $controller->index();
        }
        exit;
    }

    // Routing Module Settings (Admin Only)
    elseif ($url[0] == 'settings') {
        require_once 'app/controllers/SettingsController.php';
        $controller = new SettingsController();

        $method = isset($url[1]) ? $url[1] : 'index';

        // Map method names
        if ($method == 'export') {
            $controller->exportDatabase();
        } elseif ($method == 'delete') {
            $controller->deleteAllData();
        } else {
            $controller->index();
        }
        exit;
    }
}

// Default jika url kosong / home
require_once 'app/controllers/AuthController.php';
$auth = new AuthController();
$auth->login();
