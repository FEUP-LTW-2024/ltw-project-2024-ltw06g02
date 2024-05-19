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

    printHeader('Bazinga!', $session);
    printBioSection($_GET['id']);
    printProfileArticleSection($_GET['id']);
    printFooter();
?>