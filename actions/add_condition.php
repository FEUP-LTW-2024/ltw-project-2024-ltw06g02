<?php
   session_start();

   require_once("../database/add_condition.php");

   if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $condition = $_POST['condition'];

      if(empty($condition)){
         die(header('Location: ../#'));
      }

      if(!addCondition($condition)) die(header('Location: ../#'));
      
      header('Location: ../admin.php');   
   }
?>