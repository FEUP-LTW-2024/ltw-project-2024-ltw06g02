<?php
   function getDatabaseConnection(){
      $db = new PDO('sqlite:' . __DIR__ . '/website.db');
      $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $db;
   }
?>