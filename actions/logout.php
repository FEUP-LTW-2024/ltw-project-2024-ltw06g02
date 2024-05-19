<?php
   require_once(__DIR__ . '/../models/session.php');

   $session = new Session();

   if($session->isLoggedIn()){
      $session->logout();
      header('Location: ../index.php');
      exit();
   }
?>