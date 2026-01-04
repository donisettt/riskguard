<?php
class Report
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // 1. Ambil Statistik Ringkasan berdasarkan Filter
    public function getSummary($startDate, $endDate)
    {
        // Total Responden
        $q1 = "SELECT COUNT(*) as total FROM assessments WHERE DATE(created_at) BETWEEN :start AND :end";
        $stmt1 = $this->conn->prepare($q1);
        $stmt1->execute(['start' => $startDate, 'end' => $endDate]);
        $total = $stmt1->fetch()['total'];

        // Jumlah Kasus Bahaya/Tinggi
        $q2 = "SELECT COUNT(*) as critical FROM assessments 
               WHERE (risk_level = 'Tinggi' OR risk_level = 'Bahaya') 
               AND DATE(created_at) BETWEEN :start AND :end";
        $stmt2 = $this->conn->prepare($q2);
        $stmt2->execute(['start' => $startDate, 'end' => $endDate]);
        $critical = $stmt2->fetch()['critical'];

        // Rata-rata Skor
        $q3 = "SELECT AVG(total_score) as avg_score FROM assessments WHERE DATE(created_at) BETWEEN :start AND :end";
        $stmt3 = $this->conn->prepare($q3);
        $stmt3->execute(['start' => $startDate, 'end' => $endDate]);
        $avg = $stmt3->fetch()['avg_score'];

        return [
            'total' => $total,
            'critical' => $critical,
            'avg_score' => round($avg ?? 0, 2)
        ];
    }

    // 2. Ambil Distribusi Risiko (Pie Chart) berdasarkan Filter
    public function getRiskDistribution($startDate, $endDate)
    {
        $query = "SELECT risk_level, COUNT(*) as total 
                  FROM assessments 
                  WHERE DATE(created_at) BETWEEN :start AND :end 
                  GROUP BY risk_level";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['start' => $startDate, 'end' => $endDate]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 3. Ambil Tren Harian (Line Chart) untuk melihat lonjakan kasus
    public function getDailyTrend($startDate, $endDate)
    {
        $query = "SELECT DATE(created_at) as date, COUNT(*) as total, AVG(total_score) as avg_score
                  FROM assessments 
                  WHERE DATE(created_at) BETWEEN :start AND :end 
                  GROUP BY DATE(created_at) 
                  ORDER BY date ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['start' => $startDate, 'end' => $endDate]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 4. Ambil Tabel Detail User sesuai Filter
    public function getFilteredData($startDate, $endDate, $riskFilter = 'All')
    {
        $sql = "SELECT u.name, u.email, a.total_score, a.risk_level, a.created_at 
                FROM assessments a 
                JOIN users u ON a.user_id = u.id 
                WHERE DATE(a.created_at) BETWEEN :start AND :end";

        if ($riskFilter != 'All') {
            $sql .= " AND a.risk_level = :risk";
        }

        $sql .= " ORDER BY a.created_at DESC";

        $stmt = $this->conn->prepare($sql);
        $params = ['start' => $startDate, 'end' => $endDate];

        if ($riskFilter != 'All') {
            $params['risk'] = $riskFilter;
        }

        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
