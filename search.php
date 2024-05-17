<?php
   require_once('templates/footer.tl.php');
   require_once('templates/header.tl.php');
   require_once('models/session.php');
   require_once('templates/article.tl.php');

   $session = new Session();
   $db = getDatabaseConnection();

   printHeader('Bazinga!');
   printArticleSection($searchedArticles, 'based on your search.');
   printFooter();

?>