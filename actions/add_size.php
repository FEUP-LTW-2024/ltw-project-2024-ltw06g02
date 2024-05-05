<?php
   session_start();

   require_once("../database/add_size.php");

   if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $size = $_POST['size'];

      if(empty($size)){
         die(header('Location: ../#'));
      }

      if(!addSize($size)) die(header('Location: ../#'));
      
      header('Location: ../admin.php');   
   }
?>