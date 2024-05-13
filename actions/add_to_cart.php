<?php
   session_start();

   require_once("../models/cart.php");
   require_once("../database/addToCart.php");

   if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $userId = $_POST['userId'];
      $articleId = $_POST['articleId'];

      if(empty($userId) || empty($articleId)){
         die(header('Location: ../#'));
      }

      $cart = new Cart($userId, $articleId);

      if(!addProductToCart($cart)) die(header('Location: ../#'));
      
      header('Location: ../shopping_cart.php');  
   }
?>