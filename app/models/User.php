<?php
class User
{
    private $conn;
    private $table_name = "users";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function register($name, $email, $password)
    {
        $query = "INSERT INTO " . $this->table_name . " (name, email, password, role) VALUES (:name, :email, :password, 'user')";
        $stmt = $this->conn->prepare($query);

        // Hash password untuk keamanan
        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":password", $password_hash);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function login($email, $password)
    {
        $query = "SELECT id, name, email, password, role FROM " . $this->table_name . " WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $row['password'])) {
                return $row; // Login Sukses, kembalikan data user
            }
        }
        return false; // Login Gagal
    }

    public function getAllResponden()
    {
        // Query Join untuk mengambil user dan hasil assessment terbarunya
        $query = "SELECT u.id, u.name, u.email, u.role, 
              (SELECT risk_level FROM assessments WHERE user_id = u.id ORDER BY created_at DESC LIMIT 1) as last_risk,
              (SELECT total_score FROM assessments WHERE user_id = u.id ORDER BY created_at DESC LIMIT 1) as last_score
              FROM users u WHERE u.role = 'user'";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
