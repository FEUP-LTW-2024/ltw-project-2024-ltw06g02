<?php 
   require_once('../database/connection.php');
   require_once('../templates/article.tl.php');
   require_once('../models/session.php');
   require_once('../database/articles.php');
   
   $db = getDatabaseConnection();

   $session = new Session();

   if($_GET['filter'] == 'category') {
      $articles = getArticlesByFilter($db, $_GET['q']);
   }
   if($_GET['filter'] == 'price'){
      $articles = getArticlesByPrice($db, $_GET['q']);
   }
   if($_GET['filter'] == 'condition'){
      $articles = getArticlesByCondition($db, $_GET['q']);
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
            <h3 class='playfair-display-font' style='margin-top: 2em;'>nothing here.</h3>
         </div>
      ";
   }
  exit;
?>