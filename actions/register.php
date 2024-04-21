<?php
   require_once("../models/session.php");
   require_once("../models/user.php");
   require_once("../database/user.php");

   $session = new Session();

   if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $username = $_POST['username'];
      $email = $_POST['email'];
      $password = $_POST['password'];

      if(empty($username) || empty($email) || empty($password)){
         die(header('Location: ../#'));
      }

      $user = new User($username, $email, $password);
      if(!registerUser($user)) die(header('Location: ../#'));
      
      $session->setUsername($username);

      header('Location: ../index.php');   
   }
?>