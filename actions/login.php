<?php
   require_once("../models/user.php");
   require_once("../database/user.php");
   require_once("../models/session.php");

   $session = new Session();

   if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $username = $_POST['username'];
      $password = $_POST['password'];

      if(!loginUser($username, $password)){
         $session->addMessage('error', 'Try again');
         header('Location: ../#');
         exit();
      }
      
      $session->setUsername($username);
      $session->setUserId();

      header('Location: ../index.php');
      exit();
   }
?>