<?php
   session_start();

   require_once('templates/footer.tl.php');
   require_once('templates/header.tl.php');
   require_once('templates/article.tl.php');
   require_once('templates/filter.tl.php');
   require_once('database/connection.php');
   require_once('database/articles.php');
   require_once('database/filters.php');

   $db = getDatabaseConnection();

   if(!isset($_SESSION['userID'])) header('Location: index.php');

   $favoriteArcticles = getFavoriteArticlesByUserId($db, $_SESSION['userID']);

   printHeader('Bazinga!');
   printFavoriteArticleSection($db ,$favoriteArcticles);
   printFooter();
?>