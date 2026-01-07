<?php
class Simulation
{
    private $conn;
    private $table = "simulations";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Simpan hasil simulasi saat user klik "Stop & Simpan"
    public function saveResult($user_id, $rounds, $initial, $final, $game_id = null)
    {
        $loss = $initial - $final;

        $query = "INSERT INTO " . $this->table . " 
                  (user_id, game_id, total_round, initial_balance, final_balance, net_loss) 
                  VALUES (:uid, :game_id, :rounds, :init, :final, :loss)";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":uid", $user_id);
        $stmt->bindParam(":game_id", $game_id);
        $stmt->bindParam(":rounds", $rounds);
        $stmt->bindParam(":init", $initial);
        $stmt->bindParam(":final", $final);
        $stmt->bindParam(":loss", $loss);

        return $stmt->execute();
    }

    // Ambil semua history simulasi dengan detail user dan game (untuk admin)
    public function getAllHistory($limit = null, $offset = 0, $filters = [])
    {
        $query = "SELECT s.*, 
                         u.name, u.email,
                         g.name as game_name, g.game_type, g.rtp, g.bet_cost,
                         s.created_at
                  FROM " . $this->table . " s
                  LEFT JOIN users u ON s.user_id = u.id
                  LEFT JOIN rng_games g ON s.game_id = g.id
                  WHERE 1=1";

        // Apply filters
        if (!empty($filters['user_id'])) {
            $query .= " AND s.user_id = :user_id";
        }
        if (!empty($filters['game_type'])) {
            $query .= " AND g.game_type = :game_type";
        }
        if (!empty($filters['date_from'])) {
            $query .= " AND DATE(s.created_at) >= :date_from";
        }
        if (!empty($filters['date_to'])) {
            $query .= " AND DATE(s.created_at) <= :date_to";
        }

        $query .= " ORDER BY s.created_at DESC";

        if ($limit) {
            $query .= " LIMIT :limit OFFSET :offset";
        }

        $stmt = $this->conn->prepare($query);

        // Bind filter parameters
        if (!empty($filters['user_id'])) {
            $stmt->bindParam(":user_id", $filters['user_id'], PDO::PARAM_INT);
        }
        if (!empty($filters['game_type'])) {
            $stmt->bindParam(":game_type", $filters['game_type']);
        }
        if (!empty($filters['date_from'])) {
            $stmt->bindParam(":date_from", $filters['date_from']);
        }
        if (!empty($filters['date_to'])) {
            $stmt->bindParam(":date_to", $filters['date_to']);
        }

        if ($limit) {
            $stmt->bindParam(":limit", $limit, PDO::PARAM_INT);
            $stmt->bindParam(":offset", $offset, PDO::PARAM_INT);
        }

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ambil statistik agregat untuk dashboard admin
    public function getStatistics()
    {
        $query = "SELECT 
                    COUNT(DISTINCT user_id) as total_users,
                    COUNT(*) as total_sessions,
                    SUM(total_round) as total_rounds,
                    SUM(net_loss) as total_loss,
                    AVG(net_loss) as avg_loss_per_session,
                    SUM(CASE WHEN final_balance > initial_balance THEN 1 ELSE 0 END) as win_sessions,
                    SUM(CASE WHEN final_balance <= initial_balance THEN 1 ELSE 0 END) as loss_sessions
                  FROM " . $this->table;

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Ambil history per user dengan agregat
    public function getUserHistory($user_id)
    {
        $query = "SELECT s.*, 
                         g.name as game_name, g.game_type, g.rtp,
                         s.created_at
                  FROM " . $this->table . " s
                  LEFT JOIN rng_games g ON s.game_id = g.id
                  WHERE s.user_id = :user_id
                  ORDER BY s.created_at DESC";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ambil statistik per user
    public function getUserStatistics($user_id)
    {
        $query = "SELECT 
                    COUNT(*) as total_sessions,
                    SUM(total_round) as total_rounds,
                    SUM(net_loss) as total_loss,
                    AVG(net_loss) as avg_loss,
                    MIN(created_at) as first_play,
                    MAX(created_at) as last_play,
                    SUM(CASE WHEN final_balance > initial_balance THEN 1 ELSE 0 END) as win_sessions,
                    SUM(CASE WHEN final_balance <= initial_balance THEN 1 ELSE 0 END) as loss_sessions
                  FROM " . $this->table . "
                  WHERE user_id = :user_id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Ambil total count untuk pagination
    public function getTotalCount($filters = [])
    {
        $query = "SELECT COUNT(*) as total FROM " . $this->table . " s
                  LEFT JOIN rng_games g ON s.game_id = g.id
                  WHERE 1=1";

        // Apply same filters
        if (!empty($filters['user_id'])) {
            $query .= " AND s.user_id = :user_id";
        }
        if (!empty($filters['game_type'])) {
            $query .= " AND g.game_type = :game_type";
        }
        if (!empty($filters['date_from'])) {
            $query .= " AND DATE(s.created_at) >= :date_from";
        }
        if (!empty($filters['date_to'])) {
            $query .= " AND DATE(s.created_at) <= :date_to";
        }

        $stmt = $this->conn->prepare($query);

        // Bind filter parameters
        if (!empty($filters['user_id'])) {
            $stmt->bindParam(":user_id", $filters['user_id'], PDO::PARAM_INT);
        }
        if (!empty($filters['game_type'])) {
            $stmt->bindParam(":game_type", $filters['game_type']);
        }
        if (!empty($filters['date_from'])) {
            $stmt->bindParam(":date_from", $filters['date_from']);
        }
        if (!empty($filters['date_to'])) {
            $stmt->bindParam(":date_to", $filters['date_to']);
        }

        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    // Ambil daftar user yang pernah bermain (untuk filter dropdown)
    public function getAllUsers()
    {
        $query = "SELECT DISTINCT u.id, u.name, u.email 
                  FROM users u
                  INNER JOIN " . $this->table . " s ON u.id = s.user_id
                  ORDER BY u.name ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ambil daftar game type yang ada (untuk filter dropdown)
    public function getAllGameTypes()
    {
        $query = "SELECT DISTINCT g.game_type 
                  FROM rng_games g
                  INNER JOIN " . $this->table . " s ON g.id = s.game_id
                  WHERE g.game_type IS NOT NULL AND g.game_type != ''
                  ORDER BY g.game_type ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
}
