<?php
   require_once('templates/footer.tl.php');
   require_once('templates/header.tl.php');
   require_once('templates/article.tl.php');
   require_once('templates/filter.tl.php');
   require_once('database/articles.php');
   require_once('database/filters.php');
   require_once('models/session.php');

   $session = new Session();

   if(!isset($_SESSION['userID'])) header('Location: index.php');

   $favoriteArcticles = getFavoriteArticlesByUserId($_SESSION['userID']);

   printHeader('Bazinga!', $session);
   printDifferentArticleSection($favoriteArcticles, 'favorites');
   printFooter();
?>