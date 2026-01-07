<?php
require_once 'app/core/AuthMiddleware.php';
require_once 'app/models/Report.php';

class ReportController
{
    private $reportModel;

    public function __construct()
    {
        $db = (new Database())->getConnection();
        $this->reportModel = new Report($db);
    }

    public function index()
    {
        // Redirect ke analysis sebagai default
        header('Location: index.php?url=report/analysis');
        exit;
    }

    public function analysis()
    {
        AuthMiddleware::isAdmin();
        $data['title'] = 'Laporan Analisis Risiko';

        // 1. Tangkap Filter (Default: Bulan Ini)
        $startDate = isset($_GET['start']) ? $_GET['start'] : date('Y-m-01');
        $endDate = isset($_GET['end']) ? $_GET['end'] : date('Y-m-d');
        $riskFilter = isset($_GET['risk']) ? $_GET['risk'] : 'All';
        $userId = isset($_GET['user_id']) ? $_GET['user_id'] : null;

        // 2. Ambil Data dari Model
        $data['summary'] = $this->reportModel->getSummary($startDate, $endDate);
        $data['distribution'] = $this->reportModel->getRiskDistribution($startDate, $endDate);
        $data['trend'] = $this->reportModel->getDailyTrend($startDate, $endDate);
        $data['details'] = $this->reportModel->getFilteredData($startDate, $endDate, $riskFilter, $userId);
        $data['users'] = $this->reportModel->getAllUsers();

        // Kirim parameter filter kembali ke view (agar form tidak reset)
        $data['filter'] = [
            'start' => $startDate,
            'end' => $endDate,
            'risk' => $riskFilter,
            'user_id' => $userId
        ];

        require_once 'app/views/layouts/header.php';
        require_once 'app/views/layouts/sidebar.php';
        require_once 'app/views/layouts/navbar.php';
        require_once 'app/views/report/analysis.php';
        require_once 'app/views/layouts/footer.php';
    }

    public function assessment()
    {
        AuthMiddleware::isAdmin();
        $data['title'] = 'Laporan Assessment';

        // Filter
        $startDate = isset($_GET['start']) ? $_GET['start'] : date('Y-m-01');
        $endDate = isset($_GET['end']) ? $_GET['end'] : date('Y-m-d');
        $riskFilter = isset($_GET['risk']) ? $_GET['risk'] : 'All';
        $userId = isset($_GET['user_id']) ? $_GET['user_id'] : null;

        // Ambil data assessment
        $data['details'] = $this->reportModel->getFilteredData($startDate, $endDate, $riskFilter, $userId);
        $data['summary'] = $this->reportModel->getSummary($startDate, $endDate);
        $data['users'] = $this->reportModel->getAllUsers();

        $data['filter'] = [
            'start' => $startDate,
            'end' => $endDate,
            'risk' => $riskFilter,
            'user_id' => $userId
        ];

        require_once 'app/views/layouts/header.php';
        require_once 'app/views/layouts/sidebar.php';
        require_once 'app/views/layouts/navbar.php';
        require_once 'app/views/report/assessment.php';
        require_once 'app/views/layouts/footer.php';
    }

    public function analysisPdf()
    {
        AuthMiddleware::isAdmin();

        // Filter
        $startDate = isset($_GET['start']) ? $_GET['start'] : date('Y-m-01');
        $endDate = isset($_GET['end']) ? $_GET['end'] : date('Y-m-d');
        $riskFilter = isset($_GET['risk']) ? $_GET['risk'] : 'All';
        $userId = isset($_GET['user_id']) ? $_GET['user_id'] : null;

        // Ambil data
        $summary = $this->reportModel->getSummary($startDate, $endDate);
        $distribution = $this->reportModel->getRiskDistribution($startDate, $endDate);
        $details = $this->reportModel->getFilteredData($startDate, $endDate, $riskFilter, $userId);

        // Get user name if filtered
        $userName = null;
        if ($userId) {
            $users = $this->reportModel->getAllUsers();
            foreach ($users as $user) {
                if ($user['id'] == $userId) {
                    $userName = $user['name'];
                    break;
                }
            }
        }
        $dompdf = new \Dompdf\Dompdf();

        // Generate HTML content
        ob_start();
        include 'app/views/report/analysis_pdf.php';
        $html = ob_get_clean();

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $filename = 'Laporan_Analisis_Risiko_' . date('Ymd', strtotime($startDate)) . '_' . date('Ymd', strtotime($endDate)) . '.pdf';
        $dompdf->stream($filename, array('Attachment' => false));
    }

    public function assessmentPdf()
    {
        AuthMiddleware::isAdmin();

        // Filter
        $startDate = isset($_GET['start']) ? $_GET['start'] : date('Y-m-01');
        $endDate = isset($_GET['end']) ? $_GET['end'] : date('Y-m-d');
        $riskFilter = isset($_GET['risk']) ? $_GET['risk'] : 'All';
        $userId = isset($_GET['user_id']) ? $_GET['user_id'] : null;

        // Ambil data
        $summary = $this->reportModel->getSummary($startDate, $endDate);
        $details = $this->reportModel->getFilteredData($startDate, $endDate, $riskFilter, $userId);

        // Get user name if filtered
        $userName = null;
        if ($userId) {
            $users = $this->reportModel->getAllUsers();
            foreach ($users as $user) {
                if ($user['id'] == $userId) {
                    $userName = $user['name'];
                    break;
                }
            }
        }
        $dompdf = new \Dompdf\Dompdf();

        // Generate HTML content
        ob_start();
        include 'app/views/report/assessment_pdf.php';
        $html = ob_get_clean();

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $filename = 'Laporan_Assessment_Responden_' . date('Ymd', strtotime($startDate)) . '_' . date('Ymd', strtotime($endDate)) . '.pdf';
        $dompdf->stream($filename, array('Attachment' => false));
    }
}
