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

   function getCategoryByID($db, $id){
      $stmt = $db->prepare(
         "SELECT * FROM productCategory WHERE categoryID=?"
      );
      $stmt->bindParam(1, $id);
      $stmt->execute();
      $category = $stmt->fetch();
      return $category;
   }

   function getSizeByID($db, $id){
      $stmt = $db->prepare(
         "SELECT * FROM productSize WHERE sizeID=?"
      );
      $stmt->bindParam(1, $id);
      $stmt->execute();
      $size = $stmt->fetch();
      return $size;
   }

   function getConditionByID($db, $id){
      $stmt = $db->prepare(
         "SELECT * FROM productCondition WHERE conditionID=?"
      );
      $stmt->bindParam(1, $id);
      $stmt->execute();
      $condition = $stmt->fetch();
      return $condition;
   }
?>