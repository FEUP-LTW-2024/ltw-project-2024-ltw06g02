<?php
    session_start();

    require_once('database/connection.php');
    require_once('database/articles.php');
    require_once('templates/article.tl.php');
    require_once('templates/footer.tl.php');
    require_once('templates/header.tl.php');

    $id = $_GET['id'];

    $db = getDatabaseConnection();
    $article = getArticleById($db, $id);

    printHeader('Bazinga!');
    printArticleById($db, $article, $_SESSION['userID'], $id);
    printFooter();
?>