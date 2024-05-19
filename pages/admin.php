<?php
    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/user.php');
    require_once(__DIR__ . '/../database/articles.php');
    require_once(__DIR__ . '/../templates/admin.tl.php');
    require_once(__DIR__ . '/../templates/footer.tl.php');
    require_once(__DIR__ . '/../templates/header.tl.php');
    require_once(__DIR__ . '/../models/session.php');

    $session = new Session();

    if(isset($_SESSION['userID'])) $user = retrieveUser($_SESSION['userID']);

    if(!isset($_SESSION['userID']) || $user['admin'] == '') header('Location: index.php');

    printHeader('Bazinga!', $session);
    printAdminSection();
    printFooter();
?>