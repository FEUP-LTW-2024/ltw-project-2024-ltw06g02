<?php 
   require_once(__DIR__ . '/../database/connection.php');
   require_once(__DIR__ . '/../templates/article.tl.php');
   require_once(__DIR__ . '/../models/session.php');
   require_once(__DIR__ . '/../database/articles.php');

   $session = new Session();

   if($_GET['filter'] == 'category') {
      $articles = getArticlesByFilter($_GET['q']);
   }
   if($_GET['filter'] == 'price'){
      $articles = getArticlesByPrice($_GET['q']);
   }
   if($_GET['filter'] == 'condition'){
      $articles = getArticlesByCondition($_GET['q']);
   }

   $check = 0;

   foreach($articles as $article){
      if(isset($_SESSION['userID']) && $article['userID'] == $_SESSION['userID']) $check += 1;
   }

   if(sizeof($articles) > 0 && $check < sizeof($articles)) {
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
  exit;
?>