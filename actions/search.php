<?php
   session_start();

   require_once("../database/user.php");

   if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $name = $_POST['query'];

      if(empty($name)){
         die(header('Location: ../#'));
      }

      if(!checkNameExists($name)) die(header('Location: ../#'));

      $userID = getUserIdByName($name);
      
      header('Location: ../profile_user.php?id=' . $userID);  
   }
?>