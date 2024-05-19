<?php 
   require_once(__DIR__ . '/../database/connection.php');
   require_once(__DIR__ . '/../models/session.php');
   require_once(__DIR__ . '/../database/messages.php');

   $session = new Session();

   if(isset($_GET['q'])){
      if(!createChat($_GET['q'])){
         $session->addMessage('error', 'Chat already exists');
         header('Location: ' . $_SERVER['HTTP_REFERER']);
         exit();
      }
      $session->addMessage('success', 'Chat created');
      header('Location: ../pages/messages.php');
      exit();
   }
   exit();
?>