<?php 
   require_once(__DIR__ . '/../models/session.php');
   require_once(__DIR__ . '/../database/articles.php');
   require_once(__DIR__ . '/../templates/article.tl.php');

   $session = new Session();

   $articles = getArticlesByName($_GET['q']);

   if(sizeof($articles) > 0) {
      foreach($articles as $article) {
         if(!isset($_SESSION['userID']) || (isset($_SESSION['userID']) && ($article['userID'] != $_SESSION['userID']))) {
            getSingleArticle($article);
         }
      }
   } else {
      echo "
         <div class='no-product-section'>
            <img class='no-product-img' style='margin-top: 1em;' src='../assets/no_items.svg'>
            <h3 style='margin-top: 2em;'>nothing here.</h3>
         </div>
      ";
   }
?>