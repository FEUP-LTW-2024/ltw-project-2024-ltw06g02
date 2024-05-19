<?php
   require_once(__DIR__ . '/../database/follow.php');
   require_once(__DIR__ . '/../models/session.php');

   $session = new Session();

   if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $userID = $_POST['userId'];
      $requesterId = $_POST['requesterId'];

      if(empty($userID) || empty($requesterId)){
         $session->addMessage('error', 'Error occurred');
         header('Location: ' . $_SERVER['HTTP_REFERER']);
         exit();
      }

      if(!removeFollow($userID, $requesterId)){
         $session->addMessage('error', 'Error occurred');
         header('Location: ' . $_SERVER['HTTP_REFERER']);
         exit();
      }
      
      $session->addMessage('success', 'User unfollowed');
      header('Location: ' . $_SERVER['HTTP_REFERER']);
      exit();
   }
?>