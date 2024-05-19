<?php 
   require_once('../database/connection.php');
   require_once('../models/session.php');
   require_once('../database/messages.php');

   $session = new Session();

   if(isset($_GET['q'])){
      if(!createChat($_GET['q'])){
         $session->addMessage('error', 'Chat already exists');
         header('Location: ' . $_SERVER['HTTP_REFERER']);
         exit();
      }
      $session->addMessage('success', 'Chat created');
      header('Location: ../messages.php');
      exit();
   }
   exit();
?>