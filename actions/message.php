<?php 
   require_once('../database/connection.php');
   require_once('../database/messages.php');
   require_once('../models/session.php');

   $session = new Session();

   if (isset($_POST['messageText']) && isset($_POST['senderID'])) {
      if($_POST['messageText'] != '') insertMessage($_POST['messageText'], $_POST['senderID']);
      exit;
   }
   exit;
?>