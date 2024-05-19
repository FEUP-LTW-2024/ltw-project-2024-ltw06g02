<?php
    require_once('database/articles.php');
    require_once('database/filters.php');
    require_once('templates/article.tl.php');
    require_once('templates/footer.tl.php');
    require_once('templates/header.tl.php');
    require_once('models/session.php');

    $session = new Session();

    $id = $_GET['id'];

    $article = getArticleById($id);

    printHeader('Bazinga!', $session);
    printArticleById($article, isset($_SESSION['userID']) ? $_SESSION['userID'] : '');
    printFooter();
?>