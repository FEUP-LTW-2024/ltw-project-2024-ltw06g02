<?php
   require_once('templates/footer.tl.php');
   require_once('templates/header.tl.php');
   require_once('templates/article.tl.php');
   require_once('templates/filter.tl.php');
   require_once('database/connection.php');
   require_once('database/articles.php');
   require_once('database/filters.php');
   require_once('models/session.php');

   $session = new Session();

   $db = getDatabaseConnection();

   if(!isset($_SESSION['userID'])) header('Location: index.php');

   $cartArticles = getCartArticlesByUserId($db, $_SESSION['userID']);

   printHeader('Bazinga!', $session);
   printCartArticleSection($db, $cartArticles, $_SESSION['userID']);
   printFooter();
?>