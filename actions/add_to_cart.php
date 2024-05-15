<?php
   session_start();

   require_once("../models/cart.php");
   require_once("../database/addToCart.php");

   if(isset($_GET['userID']) && isset($_GET['articleID'])){
      if(empty($_GET['userID']) || empty($_GET['articleID'])){
         die(header('Location: ../#'));
      }

      $cart = new Cart($_GET['userID'], $_GET['articleID']);

      if(!addProductToCart($cart)) die(header('Location: ../#'));
      
      header('Location: ../shoppingCart.php');  
   }
?>