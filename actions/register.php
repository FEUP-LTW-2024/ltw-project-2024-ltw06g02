<?php
   require_once("../models/session.php");
   require_once("../models/user.php");
   require_once("../database/user.php");

   $session = new Session();

   if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $fullName = $_POST['fullName'];
      $username = $_POST['username'];
      $email = $_POST['email'];
      $password = $_POST['password'];

      if(empty($username) || empty($email) || empty($password) || empty($fullName)){
         die(header('Location: ../#'));
      }

      $user = new User($fullName, $username, $email, $password, '');
      if(!registerUser($user)) die(header('Location: ../#'));
      
      $session->setUsername($username);
      $session->setUserId();

      header('Location: ../index.php');   
   }
?>