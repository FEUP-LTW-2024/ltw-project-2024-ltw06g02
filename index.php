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
   $articles = isset($_SESSION['userID']) ? getArticlesExcludingUser($db) : getAllArticles($db);
   $filters = getAllCategories($db);

   printHeader('Bazinga!');
   printArticleSection($articles);
   printFiltersSection($filters);
   printFooter();
?>