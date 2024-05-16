<?php 
   require_once(dirname(__DIR__) . "/database/user.php");
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

   function retrievePreferences($db, $id){
      $stmt = $db->prepare(
         "SELECT * FROM preferences WHERE preferencesID=?"
      );
      $stmt->execute(array($id));
      $preferences = $stmt->fetch();
      return $preferences;
   }

   function updatePreferences($db, $categoryID, $sizeID, $conditionID){

      if(!isset(retrieveUser($_SESSION['userID'])['preferencesID'])){
         createPreferences($db, $categoryID, $sizeID, $conditionID);
      }

      $stmt = $db->prepare(
         "UPDATE preferences SET categoryID = ?, sizeID = ?, conditionID = ? WHERE userID = ?"
      );
      $stmt->execute(array($categoryID, $sizeID, $conditionID, $_SESSION['userID']));
   }

   function createPreferences($db, $categoryID, $sizeID, $conditionID){
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
   }
?>