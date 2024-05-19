<?php 
   require_once('connection.php');
   
   $db = getDatabaseConnection();
   function getAllArticles(){
      global $db;

      $stmt = $db->prepare(
         "SELECT product.*, users.avatar FROM product LEFT JOIN users ON product.userID = users.userID"
      );
      $stmt->execute();
      $articles = $stmt->fetchAll();
      return $articles;
   }

   function getFollowedArticles() {
      global $db;

      $stmt = $db->prepare(
         "SELECT product.*, users.avatar FROM product LEFT JOIN users ON product.userID = users.userID WHERE EXISTS (SELECT 1 FROM follow WHERE follow.requesterID = ? AND follow.userID = users.userID)"
      );
      $stmt->execute(array($_SESSION['userID']));
      $articles = $stmt->fetchAll();
      return $articles;
   }

   function getArticleById($id){
      global $db;

      $stmt = $db->prepare(
         "SELECT product.*, users.avatar FROM product LEFT JOIN users ON product.userID = users.userID WHERE productID = ?"
      );
      $stmt->execute(array($id));
      $article = $stmt->fetch();
      return $article;
   }

   function getArticlesByFilter($filter){
      global $db;

      $stmt = $db->prepare(
         "SELECT product.*, users.avatar FROM product LEFT JOIN users ON product.userID = users.userID WHERE product.categoryID = ?"
      );
      $stmt->bindParam(1, $filter);
      $stmt->execute();
      $articles = $stmt->fetchAll();
      return $articles;
   }

   function getArticlesByPrice($price){
      global $db;

      if(isset($_SESSION['currency']) && $_SESSION['currency'] == "dol"){
         $stmt = $db->prepare(
            "SELECT product.*, users.avatar FROM product LEFT JOIN users ON product.userID = users.userID WHERE product.price <= ?"
         );
         $stmt->execute(array(intval($price/1.09)));
         $articles = $stmt->fetchAll();
      }
      else{
         $stmt = $db->prepare(
            "SELECT product.*, users.avatar FROM product LEFT JOIN users ON product.userID = users.userID WHERE product.price <= ?"
         );
         $stmt->execute(array(intval($price)));
         $articles = $stmt->fetchAll();
      }
      
      return $articles;
   }

   function getArticlesByCondition($condition){
      global $db;

      $stmt = $db->prepare(
         "SELECT product.*, users.avatar FROM product LEFT JOIN users ON product.userID = users.userID WHERE product.conditionID = ?"
      );
      $stmt->execute(array($condition));
      $articles = $stmt->fetchAll();
      return $articles;
   }

   function getFavoriteArticlesByUserId($id){
      global $db;

      $stmt = $db->prepare(
         "SELECT * FROM favorites WHERE userID = ?"
      );
      $stmt->execute(array($id));

      $favoriteArticles = $stmt->fetchAll();
      return $favoriteArticles;
   }

   function addArticle($article, $images){
      global $db;

      $stmt = $db->prepare("SELECT categoryID FROM productCategory WHERE name=?");
      $stmt->execute(array($article['category']));
      $categoryID = $stmt->fetch();

      $stmt = $db->prepare("SELECT sizeID FROM productSize WHERE name=?");
      $stmt->execute(array($article['size']));
      $sizeID = $stmt->fetch();

      $stmt = $db->prepare("SELECT conditionID FROM productCondition WHERE name=?");
      $stmt->execute(array($article['condition']));
      $conditionID = $stmt->fetch();

      $stmt = $db->prepare(
         "INSERT INTO product(name, description, price, categoryID, userID, sizeID, conditionID, brand, model, images, likes) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
     );

      $likes = 0;

      $stmt->execute(array(
         preg_replace("/[^a-zA-Z0-9\s]/", '', $article['name']),
         preg_replace("/[^a-zA-Z0-9\s]/", '', $article['description']),
         $article['price'],
         $categoryID['categoryID'],
         $_SESSION['userID'],
         $sizeID['sizeID'],
         $conditionID['conditionID'],
         preg_replace("/[^a-zA-Z0-9\s]/", '', $article['brand']),
         preg_replace("/[^a-zA-Z0-9\s]/", '', $article['model']),
         $images,
         $likes
     ));
   }

  function getUserArticles($userID){
      global $db;

     $stmt = $db->prepare(
        "SELECT product.*, users.avatar FROM product LEFT JOIN users ON product.userID = users.userID WHERE product.userID = ?"
     );
     $stmt->bindParam(1, $userID);
     $stmt->execute();
     $userArticles = $stmt->fetchAll();
     return $userArticles;
  }

  function getCartArticlesByUserId($id){
      global $db;

      $stmt = $db->prepare(
         "SELECT * FROM cart WHERE userID = ?"
      );
      $stmt->execute(array($id));

      $cartArticles = $stmt->fetchAll();
      return $cartArticles;
   }

   function checkCartArticle($id, $userID) : bool {
      global $db;

      $stmt = $db->prepare(
         "SELECT * FROM cart WHERE productID = ? AND userID = ?"
      );
      $stmt->execute(array($id, $userID));

      return $stmt->fetch() ? true : false;
   }

   function removeArticle($id) : bool{
      global $db;

      $stmt = $db->prepare(
         "DELETE FROM product WHERE productID = ?"
      );
      $stmt->bindParam(1, $id);

      $stmt->execute();

      return true;
   }

   function updateArticle($id, $new_price, $new_name) {
      global $db;

      $stmt = $db->prepare("UPDATE product SET price = ?, name = ? WHERE productID = ?");
      $stmt->execute(array($new_price, $new_name, $id));
   }

   function getArticlesByName($name){
      global $db;

      $stmt = $db->prepare("SELECT product.*, users.avatar FROM product LEFT JOIN users ON product.userID = users.userID WHERE product.name LIKE ?");
      $stmt->execute(array($name . '%'));
      $articles = $stmt->fetchAll();
      return $articles;
   }

   function getArticlesByPreference(){
      global $db;

      $stmt = $db->prepare("SELECT * FROM preferences WHERE userID = ?");
      $stmt->execute(array($_SESSION['userID']));
      $preference = $stmt->fetch();

      $query = "SELECT product.*, users.avatar FROM product LEFT JOIN users ON product.userID = users.userID WHERE 1 = 1";
      $preferences = [];
      if ($preference['conditionID']) {
         $query .= " AND product.conditionID = ?";
         $preferences[] = $preference['conditionID'];
      }
      if ($preference['sizeID']) {
         $query .= " AND product.sizeID = ?";
         $preferences[] = $preference['sizeID'];
      }
      if ($preference['categoryID']) {
         $query .= " AND product.categoryID = ?";
         $preferences[] = $preference['categoryID'];
      }

      $stmt = $db->prepare($query);
      $stmt->execute($preferences);
      $articles = $stmt->fetchAll();
      return $articles;
   }

   function editPromotion($prom, $id) : bool {
      global $db;

      $stmt = $db->prepare("UPDATE product SET promotion = ? WHERE productID = ?");
      $stmt->execute(array($prom, $id));

      return true;
   }

   function removePromotion($id) : bool {
      global $db;
      
      $stmt = $db->prepare("UPDATE product SET promotion = ? WHERE productID = ?");
      $stmt->execute(array(null, $id));

      return true;
   }
?>