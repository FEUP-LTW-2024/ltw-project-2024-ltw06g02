<?php
   require_once(__DIR__ . "/../models/session.php");
   require_once(__DIR__ . "/../models/user.php");
   require_once(__DIR__ . "/../database/user.php");

   $session = new Session();

   if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $fullName = $_POST['fullName'];
      $username = $_POST['username'];
      $email = $_POST['email'];
      $password = $_POST['password'];

      $user = new User($fullName, $username, $email, $password, '../assets/users/user.jpg');
      if(!registerUser($user)){
         $session->addMessage('error', 'Already existent information');
         header('Location: ../#');
         exit();
      }
      
      $session->setUsername($username);
      $session->setUserId();

      header('Location: ../index.php'); 
      exit();  
   }
?>