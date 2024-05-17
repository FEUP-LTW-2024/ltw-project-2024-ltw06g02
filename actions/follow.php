<?php
   require_once("../database/follow.php");
   require_once("../models/session.php");

   $session = new Session();

   if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $userID = $_POST['userId'];
      $requesterID = $_POST['requesterId'];

      if(empty($userID) || empty($requesterID)){
         $session->addMessage('error', 'Error occurred');
         header('Location: ' . $_SERVER['HTTP_REFERER']);
         exit();
      }

      if(!addFollow($userID, $requesterID)){
         $session->addMessage('error', 'Error occurred');
         header('Location: ' . $_SERVER['HTTP_REFERER']);
         exit();
      }
      
      $session->addMessage('success', 'User followed');
      header('Location: ' . $_SERVER['HTTP_REFERER']);
      exit();
   }
?>