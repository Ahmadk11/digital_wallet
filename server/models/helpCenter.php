<?php
class HelpCenter {
    private $conn;
    private $table = 'help_center';

    public $id;
    public $title;
    public $content;
    public $category;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO $this->table (title, content, category) VALUES (:title, :content, :category)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':content', $this->content);
        $stmt->bindParam(':category', $this->category);

        return $stmt->execute();
    }

    public function getAllArticles() {
        $query = "SELECT * FROM $this->table ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getArticlesByCategory($category) {
        $query = "SELECT * FROM $this->table WHERE category = :category ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':category', $category);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function searchArticles($keyword) {
        $query = "SELECT * FROM $this->table WHERE title LIKE :keyword OR content LIKE :keyword ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $keyword = "%$keyword%";
        $stmt->bindParam(':keyword', $keyword);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>