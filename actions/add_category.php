<?php
   require_once(__DIR__ . "/../database/filters.php");
   require_once(__DIR__ . "/../models/session.php");

   $session = new Session();

   if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $category = $_POST['category'];

      if(!addCategory($category)){
         $session->addMessage('error', 'Category already exists');
         header('Location: ' . $_SERVER['HTTP_REFERER']);
         exit();
      }
      
      $session->addMessage('success', 'Category added');
      header('Location: ' . $_SERVER['HTTP_REFERER']);
      exit();
   }
?>