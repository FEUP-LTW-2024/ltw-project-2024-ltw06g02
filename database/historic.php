<?php
   require_once('connection.php');

   function addPurchase($userID, $article) : bool {
      $db = getDatabaseConnection();

      $notificationText = "Compra efetuada com sucesso";
      $notificationDate = date('Y-m-d H:i:s');

      $sql = "INSERT INTO purchase (userID, productName, productPrice, notificationText, notificationDate) VALUES (?, ?, ?, ?, ?)";
      $stmt = $db->prepare($sql);
      $stmt->bindParam(1, $userID);
      $stmt->bindParam(2, $article['name']);
      $price = $article['promotion'] ? $article['price'] - $article['price'] * $article['promotion'] : $article['price'];
      $stmt->bindParam(3, $price);
      $stmt->bindParam(4, $notificationText);
      $stmt->bindParam(5, $notificationDate);
      $stmt->execute();

      return true;
   }

   function addSale($article) : bool {
    $db = getDatabaseConnection();

    $notificationText = "Venda efetuada com sucesso";
    $notificationDate = date('Y-m-d H:i:s');

    $sql = "INSERT INTO sale (userID, productName, productPrice, notificationText, notificationDate) VALUES (?, ?, ?, ?, ?)";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(1, $article['userID']);
    $stmt->bindParam(2, $article['name']);
    $price = $article['promotion'] ? $article['price'] - $article['price'] * $article['promotion'] : $article['price'];
    $stmt->bindParam(3, $price);
    $stmt->bindParam(4, $notificationText);
    $stmt->bindParam(5, $notificationDate);
    $stmt->execute();

    return true;
   }

   function getPurchasesByUserId($db, $userID){
      $stmt = $db->prepare(
         "SELECT * FROM purchase WHERE userID = ?"
      );
      $stmt->execute(array($userID));

      $purchases = $stmt->fetchAll();
      return $purchases;
   }

   function getSalesByUserId($db, $userID){
      $stmt = $db->prepare(
         "SELECT * FROM sale WHERE userID = ?"
      );
      $stmt->execute(array($userID));

      $sales = $stmt->fetchAll();
      return $sales;
   }
?> 