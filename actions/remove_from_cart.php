<?php
   session_start();

   require_once("../database/removeFromCart.php");
   require_once('../database/connection.php');

    $db = getDatabaseConnection();

   if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $userId = $_POST['userId'];
      $articleId = $_POST['articleId'];

      if(empty($userId) || empty($articleId)){
         die(header('Location: ../#'));
      }

      if(!removeProductFromCart($db, $userId, $articleId)) die(header('Location: ../#'));
      
      header('Location: ../shoppingCart.php');   
   }
?>