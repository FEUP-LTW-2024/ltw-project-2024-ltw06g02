<?php
   require_once("../database/user.php");
   require_once("../models/session.php");

   $session = new Session();

   if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $username = $_POST['username'];

      if(!elevateUser($username)){
         $session->addMessage('error', 'User does not exist');
         header('Location: ' . $_SERVER['HTTP_REFERER']);
         exit();
      }
      
      $session->addMessage('success', 'User elevated to admin');
      header('Location: ' . $_SERVER['HTTP_REFERER']);
      exit();  
   }
?>