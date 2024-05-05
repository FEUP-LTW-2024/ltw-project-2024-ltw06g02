<?php
   require_once('connection.php');

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
?> 