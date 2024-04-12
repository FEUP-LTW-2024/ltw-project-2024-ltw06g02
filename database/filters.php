<?php 
   function getAllFilters($db){
      $stmt = $db->prepare(
         "SELECT * FROM productCategory"
      );
      $stmt->execute();
      $articles = $stmt->fetchAll();
      return $articles;
   }
?>