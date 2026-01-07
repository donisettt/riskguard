<?php
require_once 'app/core/AuthMiddleware.php';

/**
 * Web Respondent Controller (Frontend Controller)
 * Hanya handle view rendering
 * Business logic ada di API Controller
 */
class RespondentController
{
    // Halaman List Semua Responden
    public function index()
    {
        AuthMiddleware::isAdmin();
        $data['title'] = 'Data Responden';

        require_once 'app/views/layouts/header.php';
        require_once 'app/views/layouts/sidebar.php';
        require_once 'app/views/layouts/navbar.php';
        require_once 'app/views/respondent/index.php';
        require_once 'app/views/layouts/footer.php';
    }

    // Halaman Detail Jawaban User Tertentu
    public function detail($user_id)
    {
        AuthMiddleware::isAdmin();
        $data['title'] = 'Detail Hasil Assessment';
        $data['user_id'] = $user_id;

        require_once 'app/views/layouts/header.php';
        require_once 'app/views/layouts/sidebar.php';
        require_once 'app/views/layouts/navbar.php';
        require_once 'app/views/respondent/detail.php';
        require_once 'app/views/layouts/footer.php';
    }
}
