<?php 
   require_once(__DIR__ . '/user.php');
   require_once(__DIR__ . '/connection.php');

   $db = getDatabaseConnection();

   function getAllCategories(){
      global $db;

      $stmt = $db->prepare(
         "SELECT * FROM productCategory"
      );
      $stmt->execute();
      $categories = $stmt->fetchAll();
      return $categories;
   }

   function getAllSizes(){
      global $db;

      $stmt = $db->prepare(
         "SELECT * FROM productSize"
      );
      $stmt->execute();
      $sizes = $stmt->fetchAll();
      return $sizes;
   }

   function getAllConditions(){
      global $db;

      $stmt = $db->prepare(
         "SELECT * FROM productCondition"
      );
      $stmt->execute();
      $conditions = $stmt->fetchAll();
      return $conditions;
   }

   function getCategoryByID($id){
      global $db;
      
      $stmt = $db->prepare(
         "SELECT * FROM productCategory WHERE categoryID=?"
      );
      $stmt->bindParam(1, $id);
      $stmt->execute();
      $category = $stmt->fetch();
      return $category;
   }

   function getSizeByID($id){
      global $db;

      $stmt = $db->prepare(
         "SELECT * FROM productSize WHERE sizeID=?"
      );
      $stmt->bindParam(1, $id);
      $stmt->execute();
      $size = $stmt->fetch();
      return $size;
   }

   function getConditionByID($id){
      global $db;

      $stmt = $db->prepare(
         "SELECT * FROM productCondition WHERE conditionID=?"
      );
      $stmt->bindParam(1, $id);
      $stmt->execute();
      $condition = $stmt->fetch();
      return $condition;
   }

   function retrievePreferences($id){
      global $db;

      $stmt = $db->prepare(
         "SELECT * FROM preferences WHERE preferencesID=?"
      );
      $stmt->execute(array($id));
      $preferences = $stmt->fetch();
      return $preferences;
   }

   function updatePreferences($categoryID, $sizeID, $conditionID) : bool {
      global $db;

      if(!isset(retrieveUser($_SESSION['userID'])['preferencesID'])){
         createPreferences($categoryID, $sizeID, $conditionID);
      }

      $stmt = $db->prepare(
         "UPDATE preferences SET categoryID = ?, sizeID = ?, conditionID = ? WHERE userID = ?"
      );
      $stmt->execute(array($categoryID, $sizeID, $conditionID, $_SESSION['userID']));

      return true;
   }

   function createPreferences($categoryID, $sizeID, $conditionID) : bool {
      global $db;

      $stmt = $db->prepare(
         "INSERT INTO preferences (categoryID, sizeID, conditionID, userID) VALUES(?, ?, ?, ?)"
      );
      $stmt->execute(array($categoryID, $sizeID, $conditionID, $_SESSION['userID']));

      $stmt = $db->prepare(
         "SELECT preferencesID FROM preferences WHERE userID = ?"
      );
      $stmt->execute(array($_SESSION['userID']));
      $id = $stmt->fetch();

      $stmt = $db->prepare(
         "UPDATE users SET preferencesID = ? WHERE userID = ?"
      );

      $stmt->execute(array($id['preferencesID'], $_SESSION['userID']));
      
      return true;
   }

   function addCategory($category) : bool {
      global $db;

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
      global $db;

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
      global $db;

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
      global $db;

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
      global $db;

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
      global $db;

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