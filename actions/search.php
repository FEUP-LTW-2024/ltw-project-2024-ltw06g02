<?php
   require_once(__DIR__ . '/../database/user.php');
   require_once(__DIR__ . '/../models/session.php');

   $session = new Session();

   if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $name = $_POST['query'];

      if(empty($name)){
         $session->addMessage('error', 'Provide a username');
         header('Location: ' . $_SERVER['HTTP_REFERER']);
         exit();
      }

      if(!checkNameExists($name)){
         $session->addMessage('error', 'User does not exist');
         header('Location: ' . $_SERVER['HTTP_REFERER']);
         exit();
      };

      $userID = getUserIdByName($name);
      
      header('Location: ../pages/profile_user.php?id=' . $userID);  
   }
?>