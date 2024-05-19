<?php
    require_once('database/connection.php');
    require_once('database/user.php');
    require_once('database/articles.php');
    require_once('templates/admin.tl.php');
    require_once('templates/footer.tl.php');
    require_once('templates/header.tl.php');
    require_once('models/session.php');

    $session = new Session();

    if(isset($_SESSION['userID'])) $user = retrieveUser($_SESSION['userID']);

    if(!isset($_SESSION['userID']) || $user['admin'] == '') header('Location: index.php');

    printHeader('Bazinga!', $session);
    printAdminSection();
    printFooter();
?>