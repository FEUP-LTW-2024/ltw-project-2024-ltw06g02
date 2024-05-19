<?php
    require_once(__DIR__ . '/../database/articles.php');
    require_once(__DIR__ . '/../database/filters.php');
    require_once(__DIR__ . '/../templates/article.tl.php');
    require_once(__DIR__ . '/../templates/footer.tl.php');
    require_once(__DIR__ . '/../templates/header.tl.php');
    require_once(__DIR__ . '/../models/session.php');

    $session = new Session();

    $id = $_GET['id'];

    $article = getArticleById($id);

    printHeader('Bazinga!', $session);
    printArticleById($article, isset($_SESSION['userID']) ? $_SESSION['userID'] : '');
    printFooter();
?>