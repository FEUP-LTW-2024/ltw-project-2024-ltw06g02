<?php 
   require_once('connection.php');
   function getAllArticles($db){
      $stmt = $db->prepare(
         "SELECT product.*, users.avatar FROM product LEFT JOIN users ON product.userID = users.userID"
      );
      $stmt->execute();
      $articles = $stmt->fetchAll();
      return $articles;
   }

   function addArticle($article, $images){
      $db = getDatabaseConnection();

      $stmt = $db->prepare("SELECT categoryID FROM productCategory WHERE name=?");
      $stmt->execute(array($article['category']));
      $categoryID = $stmt->fetch();

      $stmt = $db->prepare("SELECT userID FROM users WHERE username=?");
      $stmt->execute(array($_SESSION['username']));
      $userID = $stmt->fetch();

      $stmt = $db->prepare(
         "INSERT INTO product(name, description, price, categoryID, userID, images) VALUES(?, ?, ?, ?, ?, ?)"
      );
      $stmt->execute(array($article['name'], $article['description'], $article['price'], $categoryID['categoryID'], $userID['userID'], $images));
   }
?>