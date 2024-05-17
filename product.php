<?php
    require_once('database/connection.php');
    require_once('database/articles.php');
    require_once('database/filters.php');
    require_once('templates/article.tl.php');
    require_once('templates/footer.tl.php');
    require_once('templates/header.tl.php');
    require_once('models/session.php');

    $session = new Session();

    $id = $_GET['id'];

    $db = getDatabaseConnection();
    $article = getArticleById($id);

    printHeader('Bazinga!', $session);
    printArticleById($db, $article, isset($_SESSION['userID']) ? $_SESSION['userID'] : '');
    printFooter();
?>