<?php
   require_once("../database/removeFromCart.php");
   require_once('../database/connection.php');
   require_once("../models/session.php");

   $session = new Session();

   $db = getDatabaseConnection();

   if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $userId = $_POST['userId'];
      $articleId = $_POST['articleId'];

      if(empty($userId) || empty($articleId)){
         $session->addMessage('error', 'Error occurred');
         header('Location: ' . $_SERVER['HTTP_REFERER']);
         exit();
      }

      removeProductFromCart($db, $userId, $articleId);
      
      $session->addMessage('success', 'Product removed');
      header('Location: ' . $_SERVER['HTTP_REFERER']);
      exit();   
   }
?>