<?php 
   function getAllArticles($db){
      $stmt = $db->prepare(
         "SELECT * FROM product"
      );
      $stmt->execute();
      $articles = $stmt->fetchAll();
      return $articles;
   }
?>