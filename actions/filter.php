<?php 
   require_once('../database/connection.php');
   require_once('../templates/article.tl.php');
   require_once('../models/session.php');
   require_once('../database/articles.php');
   $db = getDatabaseConnection();

   $session = new Session();

   if($_GET['filter'] == 'category') {
      $articles = isset($_SESSION['userID']) ? getArticlesByFilterExcludingUser($db, $_GET['q']) : getArticlesByFilter($db, $_GET['q']);
   }
   if($_GET['filter'] == 'price'){
      $articles = isset($_SESSION['userID']) ? getArticlesByPriceExcludingUser($db, $_GET['q']) : getArticlesByPrice($db, $_GET['q']);
   }
   if($_GET['filter'] == 'condition'){
      $articles = isset($_SESSION['userID']) ? getArticlesByConditionExcludingUser($db, $_GET['q']) : getArticlesByCondition($db, $_GET['q']);
   }

   if(sizeof($articles) > 0) {
      foreach($articles as $article) {
         getSingleArticle($article['productID'], $article['name'], $article['price'], $article['images'], $article['avatar'], $article['likes']);
      }
   } else {
      echo '<h4 style="font-weight: normal; padding: 0; margin: 0;">Não existem produtos para o filtro aplicado</h4>';
   }
  exit;
?>