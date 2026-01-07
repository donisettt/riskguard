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
        $query = "SELECT id, name, email, password, role, balance FROM " . $this->table_name . " WHERE email = :email";
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

    public function getBalance($user_id)
    {
        $query = "SELECT balance FROM " . $this->table_name . " WHERE id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['balance'] : 1000000;
    }

    public function updateBalance($user_id, $balance)
    {
        $query = "UPDATE " . $this->table_name . " SET balance = :balance WHERE id = :user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":balance", $balance);
        $stmt->bindParam(":user_id", $user_id);
        return $stmt->execute();
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

    // Ambil data user lengkap by ID
    public function getById($id)
    {
        $query = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Update Nama & Email
    public function updateProfile($id, $name, $email)
    {
        // Cek email duplikat (kecuali punya sendiri)
        $check = "SELECT id FROM users WHERE email = :email AND id != :id";
        $stmtCheck = $this->conn->prepare($check);
        $stmtCheck->bindParam(":email", $email);
        $stmtCheck->bindParam(":id", $id);
        $stmtCheck->execute();

        if ($stmtCheck->rowCount() > 0) {
            return false; // Email sudah dipakai orang lain
        }

        $query = "UPDATE users SET name = :name, email = :email WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }

    // Ganti Password
    public function updatePassword($id, $new_password)
    {
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $query = "UPDATE users SET password = :password WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":password", $hashed_password);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }

    // Verifikasi Password Lama
    public function verifyPassword($id, $password)
    {
        $user = $this->getById($id);
        return password_verify($password, $user['password']);
    }
}
