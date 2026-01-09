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
    public function getFilteredData($startDate, $endDate, $riskFilter = 'All', $userId = null)
    {
        $sql = "SELECT u.name, u.email, a.total_score, a.risk_level, a.created_at, ag.title as group_title 
                FROM assessments a 
                JOIN users u ON a.user_id = u.id 
                LEFT JOIN assessment_groups ag ON a.group_id = ag.id 
                WHERE DATE(a.created_at) BETWEEN :start AND :end";

        if ($riskFilter != 'All') {
            $sql .= " AND a.risk_level = :risk";
        }

        if ($userId) {
            $sql .= " AND a.user_id = :user_id";
        }

        $sql .= " ORDER BY a.created_at DESC";

        $stmt = $this->conn->prepare($sql);
        $params = ['start' => $startDate, 'end' => $endDate];

        if ($riskFilter != 'All') {
            $params['risk'] = $riskFilter;
        }

        if ($userId) {
            $params['user_id'] = $userId;
        }

        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 5. Ambil List Semua User/Responden
    public function getAllUsers()
    {
        $query = "SELECT DISTINCT u.id, u.name 
                  FROM users u 
                  INNER JOIN assessments a ON u.id = a.user_id 
                  WHERE u.role = 'user' 
                  ORDER BY u.name ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 6. Ambil data assessment untuk user tertentu (untuk laporan user)
    public function getUserAssessments($userId, $startDate, $endDate, $riskFilter = 'All')
    {
        $sql = "SELECT 
                    a.id,
                    a.total_score, 
                    a.risk_level, 
                    a.created_at, 
                    ag.title as group_title,
                    ag.description as group_description
                FROM assessments a 
                LEFT JOIN assessment_groups ag ON a.group_id = ag.id 
                WHERE a.user_id = :user_id 
                AND DATE(a.created_at) BETWEEN :start AND :end";

        if ($riskFilter != 'All') {
            $sql .= " AND a.risk_level = :risk";
        }

        $sql .= " ORDER BY a.created_at DESC";

        $stmt = $this->conn->prepare($sql);
        $params = [
            'user_id' => $userId,
            'start' => $startDate,
            'end' => $endDate
        ];

        if ($riskFilter != 'All') {
            $params['risk'] = $riskFilter;
        }

        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 7. Ambil ringkasan statistik untuk user
    public function getUserSummary($userId, $startDate, $endDate)
    {
        // Total Assessment
        $q1 = "SELECT COUNT(*) as total 
               FROM assessments 
               WHERE user_id = :user_id 
               AND DATE(created_at) BETWEEN :start AND :end";
        $stmt1 = $this->conn->prepare($q1);
        $stmt1->execute(['user_id' => $userId, 'start' => $startDate, 'end' => $endDate]);
        $total = $stmt1->fetch()['total'];

        // Assessment Berisiko Tinggi/Bahaya
        $q2 = "SELECT COUNT(*) as high_risk 
               FROM assessments 
               WHERE user_id = :user_id 
               AND (risk_level = 'Tinggi' OR risk_level = 'Bahaya') 
               AND DATE(created_at) BETWEEN :start AND :end";
        $stmt2 = $this->conn->prepare($q2);
        $stmt2->execute(['user_id' => $userId, 'start' => $startDate, 'end' => $endDate]);
        $highRisk = $stmt2->fetch()['high_risk'];

        // Rata-rata Skor
        $q3 = "SELECT AVG(total_score) as avg_score, MAX(total_score) as max_score, MIN(total_score) as min_score
               FROM assessments 
               WHERE user_id = :user_id 
               AND DATE(created_at) BETWEEN :start AND :end";
        $stmt3 = $this->conn->prepare($q3);
        $stmt3->execute(['user_id' => $userId, 'start' => $startDate, 'end' => $endDate]);
        $result = $stmt3->fetch();

        // Distribusi Risiko
        $q4 = "SELECT risk_level, COUNT(*) as count
               FROM assessments 
               WHERE user_id = :user_id 
               AND DATE(created_at) BETWEEN :start AND :end
               GROUP BY risk_level";
        $stmt4 = $this->conn->prepare($q4);
        $stmt4->execute(['user_id' => $userId, 'start' => $startDate, 'end' => $endDate]);
        $distribution = $stmt4->fetchAll(PDO::FETCH_ASSOC);

        return [
            'total' => $total,
            'high_risk' => $highRisk,
            'avg_score' => round($result['avg_score'] ?? 0, 2),
            'max_score' => $result['max_score'] ?? 0,
            'min_score' => $result['min_score'] ?? 0,
            'distribution' => $distribution
        ];
    }

    // 8. Ambil progress risiko user dari waktu ke waktu
    public function getUserRiskProgress($userId)
    {
        $query = "SELECT 
                    DATE(created_at) as date,
                    total_score,
                    risk_level
                  FROM assessments 
                  WHERE user_id = :user_id 
                  ORDER BY created_at ASC
                  LIMIT 10";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
