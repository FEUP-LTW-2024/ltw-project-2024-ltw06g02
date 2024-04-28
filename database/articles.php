<?php 
   function getAllArticles($db){
      $stmt = $db->prepare(
         "SELECT product.*, users.avatar FROM product LEFT JOIN users ON product.userID = users.userID"
      );
      $stmt->execute();
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

   function getFavoriteArticlesByUserId($db, $id){
      $stmt = $db->prepare(
         "SELECT * FROM favorites WHERE userID = ?"
      );
      $stmt->execute(array($id));

      $favoriteArticles = $stmt->fetchAll();
      return $favoriteArticles;
   }
?>