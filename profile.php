<?php
    declare(strict_types=1);

    require_once('database/connection.php');
    require_once('database/articles.php');
    require_once('models/session.php');
    require_once('templates/header.tl.php');
    require_once('templates/footer.tl.php');
    require_once('templates/profile.tl.php');

    $session = new Session();

    $db = getDatabaseConnection();
    $articles = getUserArticles($db, $session->getUserId());

    printHeader('Bazinga!');
    printInfoSection();
    printArticleSection($articles);
    printFooter();
?>