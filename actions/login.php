<?php
   require_once("../models/user.php");
   require_once("../database/user.php");
   require_once("../models/session.php");

   $session = new Session();

   if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $username = $_POST['username'];
      $password = $_POST['password'];

      if(empty($username) || empty($password)){
         die(header('Location: ../#'));
      }

      if(!loginUser($username, $password)) die(header('Location: ../#'));
      
      $session->setUsername($username);

      header('Location: ../index.php');
      die(0);
   }
?>