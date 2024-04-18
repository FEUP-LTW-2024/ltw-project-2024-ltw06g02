<?php 
   require_once('../database/connection.php');
   require_once('../templates/article.tl.php');
   $db = getDatabaseConnection();

   $stmt = $db->prepare("SELECT categoryID FROM productCategory WHERE name = ?");
   $stmt->bindParam(1, $_GET['q']);
   $stmt->execute();
   $id = $stmt->fetch();

   $stmt = $db->prepare(
      "SELECT product.*, users.avatar FROM product LEFT JOIN users ON product.userID = users.userID WHERE product.categoryID = ?"
   );
   $stmt->bindParam(1, $id['categoryID']);
   $stmt->execute();
   $articles = $stmt->fetchAll();

   foreach($articles as $article) {
      getSingleArticle($article['name'], $article['price'], $article['images'], $article['avatar']);
  }
  exit
?>