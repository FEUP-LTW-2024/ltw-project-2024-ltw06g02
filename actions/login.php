<?php
   session_start();

   require_once("../models/user.php");
   require_once("../database/user.php");

   if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $username = $_POST['username'];
      $password = $_POST['password'];

      if(empty($username) || empty($password)){
         die(header('Location: ../login.mock.php'));
      }

      if(!loginUser($username, $password)) die(header('Location: ../login.mock.php'));
      
      $_SESSION['username'] = $username;
      header('Location: ../index.php');
      die(0);
   }
?>