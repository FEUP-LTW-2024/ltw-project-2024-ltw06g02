<?php 
   function getAllCategories($db){
      $stmt = $db->prepare(
         "SELECT * FROM productCategory"
      );
      $stmt->execute();
      $categories = $stmt->fetchAll();
      return $categories;
   }

   function getAllSizes($db){
      $stmt = $db->prepare(
         "SELECT * FROM productSize"
      );
      $stmt->execute();
      $sizes = $stmt->fetchAll();
      return $sizes;
   }

   function getAllConditions($db){
      $stmt = $db->prepare(
         "SELECT * FROM productCondition"
      );
      $stmt->execute();
      $conditions = $stmt->fetchAll();
      return $conditions;
   }
?>