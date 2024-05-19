<?php
    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/articles.php');
    require_once(__DIR__ . '/../database/user.php');
    require_once(__DIR__ . '/../models/session.php');
    require_once(__DIR__ . '/../templates/header.tl.php');
    require_once(__DIR__ . '/../templates/footer.tl.php');
    require_once(__DIR__ . '/../templates/profile.tl.php');
    require_once(__DIR__ . '/../models/session.php');

    $session = new Session();

    printHeader('Bazinga!', $session);
    printBioSection($_GET['id']);
    printProfileArticleSection($_GET['id']);
    printFooter();
?>