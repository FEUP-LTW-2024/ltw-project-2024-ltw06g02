<?php
   require_once(__DIR__ . '/../models/session.php');
   require_once(__DIR__ . '/../templates/messages.tl.php');
   require_once(__DIR__ . '/../templates/header.tl.php');
   require_once(__DIR__ . '/../templates/footer.tl.php');
   require_once(__DIR__ . '/../database/messages.php');

   $session = new Session();

   if(!isset($_SESSION['userID'])) header('Location: index.php');

   $chats = getUserChats();

   printHeader('Bazinga!', $session);
   printMessagesBlock($chats);
   printFooter();
?>