<?php
   session_start();

   require_once("../models/favorite.php");
   require_once("../database/favorites.php");

   if(isset($_GET['userID']) && isset($_GET['articleID'])){
      if(empty($_GET['userID']) || empty($_GET['articleID'])){
         die(header('Location: ../#'));
      }

      $favorite = new Favorite($_GET['userID'], $_GET['articleID']);

      if(!addFavorite($favorite, $_GET['articleID'])) die(header('Location: ../#'));
      
      header('Location: ../product.php?id=' . $_GET['articleID']);  
   }
?>