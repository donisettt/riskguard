<?php
class AssessmentGroup
{
    private $conn;
    private $table = "assessment_groups";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Ambil semua grup assessment
    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table . " ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ambil grup dengan pagination
    public function getPaginated($limit, $offset)
    {
        $stmt = $this->conn->prepare(
            "SELECT ag.*, COUNT(q.id) as total_questions 
             FROM assessment_groups ag
             LEFT JOIN questions q ON ag.id = q.group_id
             GROUP BY ag.id
             ORDER BY ag.created_at DESC 
             LIMIT :limit OFFSET :offset"
        );
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Hitung total grup
    public function countAll()
    {
        return $this->conn->query("SELECT COUNT(*) FROM " . $this->table)->fetchColumn();
    }

    // Ambil grup berdasarkan ID
    public function getById($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Ambil grup dengan jumlah pertanyaannya
    public function getWithQuestionCount($id)
    {
        $query = "SELECT ag.*, COUNT(q.id) as total_questions 
                  FROM assessment_groups ag
                  LEFT JOIN questions q ON ag.id = q.group_id
                  WHERE ag.id = :id
                  GROUP BY ag.id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Buat grup baru
    public function create($title, $description)
    {
        $query = "INSERT INTO " . $this->table . " (title, description) VALUES (:title, :description)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":description", $description);
        return $stmt->execute();
    }

    // Update grup
    public function update($id, $title, $description)
    {
        $query = "UPDATE " . $this->table . " SET title = :title, description = :description WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }

    // Hapus grup
    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }

    // Ambil semua grup yang memiliki minimal 1 soal (untuk user)
    public function getGroupsWithQuestions()
    {
        $query = "SELECT ag.*, COUNT(q.id) as total_questions 
                  FROM assessment_groups ag
                  INNER JOIN questions q ON ag.id = q.group_id
                  GROUP BY ag.id
                  HAVING total_questions > 0
                  ORDER BY ag.created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
