<?php
   require_once(__DIR__ . '/../database/removeFromCart.php');
   require_once(__DIR__ . '/../models/session.php');

   $session = new Session();

   if(isset($_GET['userID']) && isset($_GET['articleID'])){

      if(empty($_GET['userID']) || empty($_GET['articleID'])){
         $session->addMessage('error', 'Error occurred');
         header('Location: ' . $_SERVER['HTTP_REFERER']);
         exit();
      }

      if(!removeProductFromCart($_GET['userID'], $_GET['articleID'])){
         $session->addMessage('error', 'Error occurred');
         header('Location: ' . $_SERVER['HTTP_REFERER']);
         exit();
      };
      
      $session->addMessage('success', 'Product removed');
      header('Location: ' . $_SERVER['HTTP_REFERER']);
      exit();   
   }
?>