<?php
   require_once(__DIR__ . '/../templates/footer.tl.php');
   require_once(__DIR__ . '/../templates/header.tl.php');
   require_once(__DIR__ . '/../templates/article.tl.php');
   require_once(__DIR__ . '/../templates/filter.tl.php');
   require_once(__DIR__ . '/../database/articles.php');
   require_once(__DIR__ . '/../database/filters.php');
   require_once(__DIR__ . '/../models/session.php');

   $session = new Session();

   if(!isset($_SESSION['userID'])) header('Location: index.php');

   $favoriteArcticles = getFavoriteArticlesByUserId($_SESSION['userID']);

   printHeader('Bazinga!', $session);
   printDifferentArticleSection($favoriteArcticles, 'favorites');
   printFooter();
?>