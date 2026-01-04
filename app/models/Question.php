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
        $query = "SELECT q.*, ag.title as group_title FROM " . $this->table . " q 
                  LEFT JOIN assessment_groups ag ON q.group_id = ag.id 
                  ORDER BY q.created_at ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ambil semua pertanyaan berdasarkan grup
    public function getByGroupId($group_id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE group_id = :group_id ORDER BY created_at ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":group_id", $group_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPaginated($limit, $offset)
    {
        $stmt = $this->conn->prepare(
            "SELECT q.*, ag.title as group_title 
             FROM questions q 
             LEFT JOIN assessment_groups ag ON q.group_id = ag.id 
             ORDER BY q.id ASC LIMIT :limit OFFSET :offset"
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

    public function create($question, $weight, $group_id = null)
    {
        $query = "INSERT INTO " . $this->table . " (question, weight, group_id) VALUES (:question, :weight, :group_id)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":question", $question);
        $stmt->bindParam(":weight", $weight);
        $stmt->bindParam(":group_id", $group_id);
        return $stmt->execute();
    }

    public function update($id, $question, $weight, $group_id = null)
    {
        $query = "UPDATE " . $this->table . " SET question = :question, weight = :weight, group_id = :group_id WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":question", $question);
        $stmt->bindParam(":weight", $weight);
        $stmt->bindParam(":group_id", $group_id);
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
