<?php
   session_start();

   require_once("../database/addFollow.php");

   if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $userId = $_POST['userId'];
      $requesterId = $_POST['requesterId'];

      if(empty($userId) || empty($requesterId)){
         die(header('Location: ../#'));
      }

      if(!addFollow($userId, $requesterId)) die(header('Location: ../#'));
      
      header('Location: ../profile_user.php?id=' . $userId); 
   }
?>