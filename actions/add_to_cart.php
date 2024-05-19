<?php
   require_once(__DIR__ . "/../models/cart.php");
   require_once(__DIR__ . "/../database/addToCart.php");
   require_once(__DIR__ . "/../models/session.php");

   $session = new Session();

   if(isset($_GET['userID']) && isset($_GET['articleID'])){
      if(empty($_GET['userID']) || empty($_GET['articleID'])){
         $session->addMessage('error', 'Error occurred');
         header('Location: ' . $_SERVER['HTTP_REFERER']);
         exit();
      }

      $cart = new Cart($_GET['userID'], $_GET['articleID']);

      if(!addProductToCart($cart)){
         $session->addMessage('error', 'Product already in the cart');
         header('Location: ' . $_SERVER['HTTP_REFERER']);
         exit();
      };
      
      $session->addMessage('success', 'Product added to the cart');
      header('Location: ' . $_SERVER['HTTP_REFERER']);
      exit(); 
   }
?>