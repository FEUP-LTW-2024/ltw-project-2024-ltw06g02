<?php 
   require_once('connection.php');

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

   function addCategory($category) : bool {
      $db = getDatabaseConnection();

      if(!checkIfCategoryExists($category)){
         $sql = "INSERT INTO productCategory(name) VALUES (?)";
         $stmt = $db->prepare($sql);
         $stmt->bindParam(1, $category);
         $stmt->execute();

         return true;
      }
      else{
         return false;
      }

   }

   function checkIfCategoryExists($category) : bool{
      $db = getDatabaseConnection();

      $stmt = $db->prepare(
         "SELECT name FROM productCategory"
      );
      $stmt->execute();
      $categories = $stmt->fetchAll();

      foreach($categories as $cat){
         if($cat['name'] == $category) return true;
      }

      return false;
   }

   function addCondition($condition) : bool {
      $db = getDatabaseConnection();

      if(!checkIfConditionExists($condition)){
         $sql = "INSERT INTO productCondition(name) VALUES (?)";
         $stmt = $db->prepare($sql);
         $stmt->bindParam(1, $condition);
         $stmt->execute();

         return true;
      }
      else{
         return false;
      }

   }

   function checkIfConditionExists($condition) : bool{
      $db = getDatabaseConnection();

      $stmt = $db->prepare(
         "SELECT name FROM productCondition"
      );
      $stmt->execute();
      $conditions = $stmt->fetchAll();

      foreach($conditions as $c){
         if($c['name'] == $condition) return true;
      }

      return false;
   }

   function addSize($size) : bool {
      $db = getDatabaseConnection();

      if(!checkIfSizeExists($size)){
         $sql = "INSERT INTO productSize(name) VALUES (?)";
         $stmt = $db->prepare($sql);
         $stmt->bindParam(1, $size);
         $stmt->execute();

         return true;
      }
      else{
         return false;
      }

   }

   function checkIfSizeExists($size) : bool{
      $db = getDatabaseConnection();

      $stmt = $db->prepare(
         "SELECT name FROM productSize"
      );
      $stmt->execute();
      $sizes = $stmt->fetchAll();

      foreach($sizes as $s){
         if($s['name'] == $size) return true;
      }

      return false;
   }
?>