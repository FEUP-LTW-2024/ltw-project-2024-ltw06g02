<?php
    require_once('database/connection.php');
    require_once('database/articles.php');
    require_once('database/user.php');
    require_once('models/session.php');
    require_once('templates/header.tl.php');
    require_once('templates/footer.tl.php');
    require_once('templates/profile.tl.php');
    require_once('models/session.php');

    $session = new Session();

    $id = $_GET['id'];

    $db = getDatabaseConnection();
    $articles = getUserArticles($db, $id);
    $user = retrieveUser($id);

    printHeader('Bazinga!', $session);
    printBioSection($user);
    printProfileArticleSection($articles);
    printFooter();
?>