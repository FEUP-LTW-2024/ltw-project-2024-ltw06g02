<?php
   require_once('connection.php');

   function addCategory($category) : bool {
      $db = getDatabaseConnection();

      if(!checkIfCategoryExists($category)){
         $sql = "INSERT INTO productCategory(name) VALUES (?)";
         $stmt = $db->prepare($sql);
         $stmt->bindParam(1, $category);
         $stmt->execute();

         return true;
      }
      return false;
   }

   function checkIfCategoryExists($category) : bool{
      $db = getDatabaseConnection();

      $stmt = $db->prepare(
         "SELECT name FROM productCategory"
      );
      $stmt->execute();
      $categories = $stmt->fetchAll();

      foreach($categories as $cat){
         if(strtolower($cat['name']) == strtolower($category)) return true;
      }

      return false;
   }
?> 