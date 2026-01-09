<?php
class Database
{
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $db_name = "sigma";
    public $conn;

    public function getConnection()
    {
        // Set timezone to WIB (Western Indonesian Time)
        date_default_timezone_set('Asia/Jakarta');

        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->user, $this->pass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
