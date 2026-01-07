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

        // 2. Ambil Data dari Model
        $data['summary'] = $this->reportModel->getSummary($startDate, $endDate);
        $data['distribution'] = $this->reportModel->getRiskDistribution($startDate, $endDate);
        $data['trend'] = $this->reportModel->getDailyTrend($startDate, $endDate);
        $data['details'] = $this->reportModel->getFilteredData($startDate, $endDate, $riskFilter);

        // Kirim parameter filter kembali ke view (agar form tidak reset)
        $data['filter'] = [
            'start' => $startDate,
            'end' => $endDate,
            'risk' => $riskFilter
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

        // Ambil data assessment
        $data['details'] = $this->reportModel->getFilteredData($startDate, $endDate, $riskFilter);
        $data['summary'] = $this->reportModel->getSummary($startDate, $endDate);

        $data['filter'] = [
            'start' => $startDate,
            'end' => $endDate,
            'risk' => $riskFilter
        ];

        require_once 'app/views/layouts/header.php';
        require_once 'app/views/layouts/sidebar.php';
        require_once 'app/views/layouts/navbar.php';
        require_once 'app/views/report/assessment.php';
        require_once 'app/views/layouts/footer.php';
    }
}
