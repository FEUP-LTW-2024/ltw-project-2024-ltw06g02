<?php 
   require_once('../database/connection.php');
   require_once('../templates/article.tl.php');
   require_once('../database/articles.php');
   $db = getDatabaseConnection();

   $articles = getArticlesByFilter($db, $_GET['q']);

   if(sizeof($articles) > 0) {
      foreach($articles as $article) {
         getSingleArticle($article['productID'], $article['name'], $article['price'], $article['images'], $article['avatar']);
      }
   } else {
      echo '<h4 style="font-weight: normal">Não existem produtos para o filtro aplicado</h4>';
   }
  exit;
?>