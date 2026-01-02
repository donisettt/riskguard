<?php
class Education
{
    private $conn;
    private $table = "education_content";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAll()
    {
        $query = "SELECT * FROM " . $this->table . " ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($title, $banner, $content, $created_by)
    {
        $query = "INSERT INTO " . $this->table . " (title, banner, content, created_by) VALUES (:title, :banner, :content, :created_by)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":banner", $banner);
        $stmt->bindParam(":content", $content);
        $stmt->bindParam(":created_by", $created_by);

        return $stmt->execute();
    }

    public function update($id, $title, $banner, $content) {
        $query = "UPDATE " . $this->table . " SET title = :title, banner = :banner, content = :content WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":banner", $banner);
        $stmt->bindParam(":content", $content);
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
