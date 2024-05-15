<?php

   require_once("../database/removeFromCart.php");
   require_once('../database/favorites.php');
   require_once('../database/articles.php');
   require_once('../database/messages.php');

   $db = getDatabaseConnection();

if($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['articleID'])){
   removeProductFromAllCarts($db, $_GET['articleID']);
   removeFavoriteFromUsers($_GET['articleID']);
   removeArticle($db, $_GET['articleID']);
   removeChat($_GET['articleID']);

   header('Location: ../index.php');
}

?>