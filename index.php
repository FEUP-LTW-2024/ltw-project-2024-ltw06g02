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

   $recommendedArticles = getAllArticles($db);
   if(isset($_SESSION['userID'])) $followedArticles = getFollowedArticles($db);

   $filters = getAllCategories($db);
   $conditions = getAllConditions($db);

   printHeader('Bazinga!');
   printArticleSection($recommendedArticles, 'explore. love. buy.');
   printFiltersSection($filters, $conditions);
   if(isset($_SESSION['userID'])) printArticleSection($followedArticles, 'following.');
   printFooter();
?>