<?php 
   require_once('../models/session.php');
   require_once('../database/articles.php');
   require_once('../templates/article.tl.php');

   $db = getDatabaseConnection();

   $session = new Session();

   $articles = getArticlesByName($_GET['q']);

   if(sizeof($articles) > 0) {
      foreach($articles as $article) {
         if($article['userID'] != $_SESSION['userID']) {
            getSingleArticle($article['productID'],$article['name'], $article['price'], $article['images'], $article['avatar'], $article['likes']);
         }
      }
   } else {
      echo "
         <div class='no-product-section'>
            <img class='no-product-img' src='../assets/no_items.svg'>
            <h3 class='playfair-display-font' style='margin-top: 2em;'>não foram encontrados artigos.</h3>
         </div>
      ";
   }
?>