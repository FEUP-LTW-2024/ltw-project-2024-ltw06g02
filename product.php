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

    $username = $_SESSION['username'];

    $sql = "SELECT userID FROM users WHERE username = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$username]);
    $userId = $stmt->fetchColumn();

    printHeader('Bazinga!');
    printArticleById($db, $article, $userId, $id);
    printFooter();
?>