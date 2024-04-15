<?php
   session_start();

   require_once("../models/user.php");
   require_once("../database/user.php");

   if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $username = $_POST['username'];
      $email = $_POST['email'];
      $password = $_POST['password'];

      if(empty($username) || empty($email) || empty($password)){
         die(header('Header: ../login.mock.php'));
      }

      $user = new User($username, $email, $password);
      if(!registerUser($user)) die(header('Location: ../login.mock.php'));
      
      $_SESSION['username'] = $username;
      header('Location: ../index.php');   
   }
?>