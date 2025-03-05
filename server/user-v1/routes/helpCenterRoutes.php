<?php
require_once '../controllers/helpCenterController.php';

$helpCenterController = new HelpCenterController();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_GET['action'] == 'create_article') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $category = $_POST['category'];

    if ($helpCenterController->createArticle($title, $content, $category)) {
        echo json_encode(['message' => 'Article created successfully']);
    } else {
        echo json_encode(['message' => 'Failed to create article']);
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['action'] == 'get_all_articles') {
    echo json_encode($helpCenterController->getAllArticles());
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['action'] == 'get_articles_by_category') {
    $category = $_GET['category'];
    echo json_encode($helpCenterController->getArticlesByCategory($category));
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['action'] == 'search_articles') {
    $keyword = $_GET['keyword'];
    echo json_encode($helpCenterController->searchArticles($keyword));
}
?>