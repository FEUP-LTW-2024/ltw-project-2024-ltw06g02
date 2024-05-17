<?php
   require_once("../database/add_size.php");
   require_once("../models/session.php");

   $session = new Session();

   if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $size = $_POST['size'];

      if(!addSize($size)){
         $session->addMessage('error', 'Size already exists');
         header('Location: ' . $_SERVER['HTTP_REFERER']);
         exit();
      }
      
      $session->addMessage('success', 'Size added');
      header('Location: ' . $_SERVER['HTTP_REFERER']);
      exit();  
   }
?>