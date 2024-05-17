<?php
   require_once("../models/favorite.php");
   require_once("../database/favorites.php");
   require_once('../models/session.php');

   $session = new Session();

   if(isset($_GET['userID']) && isset($_GET['articleID'])){
      if(empty($_GET['userID']) || empty($_GET['articleID'])){
         $session->addMessage('error', 'Error occurred');
         header('Location: ' . $_SERVER['HTTP_REFERER']);
         exit();
      }

      removeFavorite($_GET['userID'], $_GET['articleID']);
      
      $session->addMessage('success', 'Product removed from favorites');
      header('Location: ' . $_SERVER['HTTP_REFERER']);
      exit();   
   }
?>