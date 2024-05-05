<?php
   require_once('connection.php');

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