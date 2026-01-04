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
}
