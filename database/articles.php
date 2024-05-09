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

   function getArticlesExcludingUser($db) {
      $stmt = $db->prepare(
         "SELECT product.*, users.avatar FROM product LEFT JOIN users ON product.userID = users.userID WHERE users.userID != ?"
      );
      $stmt->execute(array($_SESSION['userID']));
      $articles = $stmt->fetchAll();
      return $articles;
   }

   function getArticleById($db, $id){
      $stmt = $db->prepare(
         "SELECT product.*, users.avatar FROM product LEFT JOIN users ON product.userID = users.userID WHERE productID = ?"
      );
      $stmt->execute(array($id));
      $article = $stmt->fetch();
      return $article;
   }

   function getArticlesByFilter($db, $filter){
      $stmt = $db->prepare(
         "SELECT product.*, users.avatar FROM product LEFT JOIN users ON product.userID = users.userID WHERE product.categoryID = ?"
      );
      $stmt->bindParam(1, $filter);
      $stmt->execute();
      $articles = $stmt->fetchAll();
      return $articles;
   }

   function getFavoriteArticlesByUserId($db, $id){
      $stmt = $db->prepare(
         "SELECT * FROM favorites WHERE userID = ?"
      );
      $stmt->execute(array($id));

      $favoriteArticles = $stmt->fetchAll();
      return $favoriteArticles;
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

  function getUserArticles($db, $userID){
     $stmt = $db->prepare(
        "SELECT product.*, users.avatar FROM product LEFT JOIN users ON product.userID = users.userID WHERE product.userID = ?"
     );
     $stmt->bindParam(1, $userID);
     $stmt->execute();
     $userArticles = $stmt->fetchAll();
     return $userArticles;
  }
?>