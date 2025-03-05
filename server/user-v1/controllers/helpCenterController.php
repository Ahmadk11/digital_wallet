<?php
require_once '../../models/helpCenter.php';
require_once '../../connection/db.php';

class HelpCenterController {
    private $helpCenter;

    public function __construct() {
        global $conn;
        $this->helpCenter = new HelpCenter($conn);
    }

    public function createArticle($title, $content, $category) {
        $this->helpCenter->title = $title;
        $this->helpCenter->content = $content;
        $this->helpCenter->category = $category;
        return $this->helpCenter->create();
    }

    public function getAllArticles() {
        return $this->helpCenter->getAllArticles();
    }

    public function getArticlesByCategory($category) {
        return $this->helpCenter->getArticlesByCategory($category);
    }

    public function searchArticles($keyword) {
        return $this->helpCenter->searchArticles($keyword);
    }
}
?>