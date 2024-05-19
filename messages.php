<?php
   require_once('models/session.php');
   require_once('templates/messages.tl.php');
   require_once('templates/header.tl.php');
   require_once('templates/footer.tl.php');
   require_once('database/messages.php');

   $session = new Session();

   if(!isset($_SESSION['userID'])) header('Location: index.php');

   $chats = getUserChats();

   printHeader('Bazinga!', $session);
   printMessagesBlock($chats);
   printFooter();
?>