<?php
class Question
{
    private $conn;
    private $table = "questions";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table . " ORDER BY created_at ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPaginated($limit, $offset)
    {
        $stmt = $this->conn->prepare(
            "SELECT * FROM questions ORDER BY id ASC LIMIT :limit OFFSET :offset"
        );

        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countAll()
    {
        return $this->conn->query("SELECT COUNT(*) FROM questions")->fetchColumn();
    }


    public function getById($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($question, $weight)
    {
        $query = "INSERT INTO " . $this->table . " (question, weight) VALUES (:question, :weight)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":question", $question);
        $stmt->bindParam(":weight", $weight);
        return $stmt->execute();
    }

    public function update($id, $question, $weight)
    {
        $query = "UPDATE " . $this->table . " SET question = :question, weight = :weight WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":question", $question);
        $stmt->bindParam(":weight", $weight);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }

    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}
