<?php
   session_start();

   require_once("../database/filters.php");

   if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $category = $_POST['category'];

      if(empty($category)){
         die(header('Location: ../#'));
      }

      if(!addCategory($category)) die(header('Location: ../#'));
      
      header('Location: ../admin.php');   
   }
?>