<?php
   function getDatabaseConnection(){
      $db = new PDO('sqlite:' . __DIR__ . '/website.db');
      return $db;
   }
?>