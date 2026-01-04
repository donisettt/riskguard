<?php
class RNGGame
{
    private $conn;
    private $table = "rng_games";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Ambil semua game (untuk admin)
    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table . " ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ambil hanya game aktif (untuk user)
    public function getActiveGames()
    {
        $query = "SELECT * FROM " . $this->table . " WHERE is_active = 1 ORDER BY name ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ambil satu game by ID
    public function getById($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Tambah game baru
    public function create($data)
    {
        $query = "INSERT INTO " . $this->table . " 
                  (name, description, game_type, symbols, rtp, bet_cost, max_payout, is_active) 
                  VALUES (:name, :description, :game_type, :symbols, :rtp, :bet_cost, :max_payout, :is_active)";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':game_type', $data['game_type']);
        $stmt->bindParam(':symbols', $data['symbols']);
        $stmt->bindParam(':rtp', $data['rtp']);
        $stmt->bindParam(':bet_cost', $data['bet_cost']);
        $stmt->bindParam(':max_payout', $data['max_payout']);
        $stmt->bindParam(':is_active', $data['is_active']);

        return $stmt->execute();
    }

    // Update game
    public function update($id, $data)
    {
        $query = "UPDATE " . $this->table . " 
                  SET name = :name, 
                      description = :description, 
                      game_type = :game_type, 
                      symbols = :symbols, 
                      rtp = :rtp, 
                      bet_cost = :bet_cost, 
                      max_payout = :max_payout, 
                      is_active = :is_active 
                  WHERE id = :id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':description', $data['description']);
        $stmt->bindParam(':game_type', $data['game_type']);
        $stmt->bindParam(':symbols', $data['symbols']);
        $stmt->bindParam(':rtp', $data['rtp']);
        $stmt->bindParam(':bet_cost', $data['bet_cost']);
        $stmt->bindParam(':max_payout', $data['max_payout']);
        $stmt->bindParam(':is_active', $data['is_active']);

        return $stmt->execute();
    }

    // Hapus game
    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Toggle status aktif
    public function toggleActive($id)
    {
        $query = "UPDATE " . $this->table . " 
                  SET is_active = IF(is_active = 1, 0, 1) 
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
