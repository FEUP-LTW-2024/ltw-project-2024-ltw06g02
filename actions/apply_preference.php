<?php 
   require_once(__DIR__ . '/../models/session.php');
   require_once(__DIR__ . '/../database/articles.php');
   require_once(__DIR__ . '/../templates/article.tl.php');

   $session = new Session();

   $articles = getArticlesByPreference();

   $check = 0;

   foreach($articles as $article){
      if($article['userID'] == $_SESSION['userID']) $check += 1;
   }

   if(sizeof($articles) > 0 && $check < sizeof($articles)) {
      foreach($articles as $article) {
         if($article['userID'] != $_SESSION['userID']) {
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