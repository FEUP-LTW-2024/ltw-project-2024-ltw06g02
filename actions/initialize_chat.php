<?php 
   require_once('../database/connection.php');
   require_once('../models/session.php');
   require_once('../database/messages.php');

   $session = new Session();

   if(isset($_GET['q'])){
      createChat($_GET['q']);
      header('Location: ../messages.php');
   }
   exit;
?>