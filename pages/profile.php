<?php
    declare(strict_types=1);

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/articles.php');
    require_once(__DIR__ . '/../database/user.php');
    require_once(__DIR__ . '/../models/session.php');
    require_once(__DIR__ . '/../templates/header.tl.php');
    require_once(__DIR__ . '/../templates/footer.tl.php');
    require_once(__DIR__ . '/../templates/profile.tl.php');

    $session = new Session();

    if(!isset($_SESSION['userID'])) header('Location: index.php');

    printHeader('Bazinga!', $session);
    printBioSection($session->getUserId());
    printProfileArticleSection($session->getUserId());
    printFooter();
?>