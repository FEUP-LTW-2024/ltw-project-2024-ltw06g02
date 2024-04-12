<?php
   require_once('templates/footer.tl.php');
   require_once('templates/header.tl.php');
   require_once('templates/article.tl.php');
   require_once('database/connection.php');
   require_once('database/articles.php');

   $db = getDatabaseConnection();
   $articles = getAllArticles($db);

   printHeader('Bazinga!');
   printArticleSection($articles);
   printFooter();
?>