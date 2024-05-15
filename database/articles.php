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

   function getFollowedArticles($db) {
      $stmt = $db->prepare(
         "SELECT product.*, users.avatar FROM product LEFT JOIN users ON product.userID = users.userID WHERE EXISTS (SELECT 1 FROM follow WHERE follow.requesterID = ? AND follow.userID = users.userID)"
      );
      $stmt->execute(array($_SESSION['userID']));
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

   function getArticleById($id){
      $db = getDatabaseConnection();
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

   function getArticlesByPrice($db, $price){
      $stmt = $db->prepare(
         "SELECT product.*, users.avatar FROM product LEFT JOIN users ON product.userID = users.userID WHERE product.price <= ?"
      );
      $stmt->execute(array(intval($price)));
      $articles = $stmt->fetchAll();
      return $articles;
   }

   function getArticlesByPriceExcludingUser($db, $price){
      $stmt = $db->prepare(
         "SELECT product.*, users.avatar FROM product LEFT JOIN users ON product.userID = users.userID WHERE product.price <= ? AND users.userID != ?"
      );
      $stmt->execute(array(intval($price), $_SESSION['userID']));
      $articles = $stmt->fetchAll();
      return $articles;
   }

   function getArticlesByConditionExcludingUser($db, $condition){
      $stmt = $db->prepare(
         "SELECT product.*, users.avatar FROM product LEFT JOIN users ON product.userID = users.userID WHERE product.conditionID = ? AND users.userID != ?"
      );
      $stmt->execute(array($condition, $_SESSION['userID']));
      $articles = $stmt->fetchAll();
      return $articles;
   }

   function getArticlesByCondition($db, $condition){
      $stmt = $db->prepare(
         "SELECT product.*, users.avatar FROM product LEFT JOIN users ON product.userID = users.userID WHERE product.conditionID = ?"
      );
      $stmt->execute(array($condition));
      $articles = $stmt->fetchAll();
      return $articles;
   }

   function getArticlesByFilterExcludingUser($db, $filter){
      $stmt = $db->prepare(
         "SELECT product.*, users.avatar FROM product LEFT JOIN users ON product.userID = users.userID WHERE product.categoryID = ? AND users.userID != ?"
      );
      $stmt->execute(array($filter, $_SESSION['userID']));
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

      $stmt = $db->prepare("SELECT sizeID FROM productSize WHERE name=?");
      $stmt->execute(array($article['size']));
      $sizeID = $stmt->fetch();

      $stmt = $db->prepare("SELECT conditionID FROM productCondition WHERE name=?");
      $stmt->execute(array($article['condition']));
      $conditionID = $stmt->fetch();

      $stmt = $db->prepare(
         "INSERT INTO product(name, description, price, categoryID, userID, sizeID, conditionID, brand, model, images, likes) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
     );

      $brand = isset($article['brand']) ? $article['brand'] : null;
      $model = isset($article['model']) ? $article['model'] : null;
      $likes = 0;

      $stmt->execute(array(
         $article['name'],
         $article['description'],
         $article['price'],
         $categoryID['categoryID'],
         $userID['userID'],
         $sizeID['sizeID'],
         $conditionID['conditionID'],
         $brand,
         $model,
         $images,
         $likes
     ));
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

  function getCartArticlesByUserId($db, $id){
      $stmt = $db->prepare(
         "SELECT * FROM cart WHERE userID = ?"
      );
      $stmt->execute(array($id));

      $cartArticles = $stmt->fetchAll();
      return $cartArticles;
   }

   function removeArticle($db, $id) : bool{
      $stmt = $db->prepare(
         "DELETE FROM product WHERE productID = ?"
      );
      $stmt->bindParam(1, $id);

      $stmt->execute();
        
      return true;
   }

   function updateArticle($id, $new_price, $new_name) {
      $db = getDatabaseConnection();
      $stmt = $db->prepare("UPDATE product SET price = ?, name = ? WHERE productID = ?");
      $stmt->execute(array($new_price, $new_name, $id));
   }
?>