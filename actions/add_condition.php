<?php
   require_once("../database/add_condition.php");
   require_once("../models/session.php");

   $session = new Session();

   if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $condition = $_POST['condition'];

      if(!addCondition($condition)) {
         $session->addMessage('error', 'Condition already exists');
         header('Location: ' . $_SERVER['HTTP_REFERER']);
         exit();
      }

      $session->addMessage('success', 'Condition added');
      header('Location: ' . $_SERVER['HTTP_REFERER']);  
      exit(); 
   }
?>