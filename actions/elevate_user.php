<?php
   session_start();

   require_once("../database/user.php");

   if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $username = $_POST['username'];

      if(empty($username)){
         die(header('Location: ../#'));
      }

      if(!elevateUser($username)) die(header('Location: ../#'));
      
      header('Location: ../admin.php');   
   }
?>