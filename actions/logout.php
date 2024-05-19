<?php
   require_once('../models/session.php');

   $session = new Session();

   if($session->isLoggedIn()){
      $session->logout();
      header('Location: ../index.php');
      exit();
   }
?>