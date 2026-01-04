<?php
class Assessment
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Simpan Header Assessment
    public function create($user_id, $total_score, $risk_level)
    {
        $query = "INSERT INTO assessments (user_id, total_score, risk_level) VALUES (:user_id, :total_score, :risk_level)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->bindParam(":total_score", $total_score);
        $stmt->bindParam(":risk_level", $risk_level);

        if ($stmt->execute()) {
            return $this->conn->lastInsertId(); // Kembalikan ID assessment yang baru dibuat
        }
        return false;
    }

    // Simpan Detail Jawaban Per Soal
    public function saveAnswer($assessment_id, $question_id, $answer_value)
    {
        $query = "INSERT INTO assessment_answers (assessment_id, question_id, answer_value) VALUES (:assessment_id, :question_id, :answer_value)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":assessment_id", $assessment_id);
        $stmt->bindParam(":question_id", $question_id);
        $stmt->bindParam(":answer_value", $answer_value);
        return $stmt->execute();
    }

    // Ambil History Assessment User
    public function getHistoryByUser($user_id)
    {
        $query = "SELECT * FROM assessments WHERE user_id = :user_id ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ambil Detail Hasil Terakhir (Untuk halaman Result)
    public function getLatestResult($user_id)
    {
        $query = "SELECT * FROM assessments WHERE user_id = :user_id ORDER BY created_at DESC LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
