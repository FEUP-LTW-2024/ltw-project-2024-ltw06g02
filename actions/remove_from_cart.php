<?php
   require_once("../database/removeFromCart.php");
   require_once('../database/connection.php');
   require_once("../models/session.php");

   $session = new Session();

   $db = getDatabaseConnection();

   if(isset($_GET['userID']) && isset($_GET['articleID'])){

      if(empty($_GET['userID']) || empty($_GET['articleID'])){
         $session->addMessage('error', 'Error occurred');
         header('Location: ' . $_SERVER['HTTP_REFERER']);
         exit();
      }

      if(!removeProductFromCart($db, $_GET['userID'], $_GET['articleID'])){
         $session->addMessage('error', 'Error occurred');
         header('Location: ' . $_SERVER['HTTP_REFERER']);
         exit();
      };
      
      $session->addMessage('success', 'Product removed');
      header('Location: ' . $_SERVER['HTTP_REFERER']);
      exit();   
   }
?>