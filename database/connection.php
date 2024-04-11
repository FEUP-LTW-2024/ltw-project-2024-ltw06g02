<?php
   function getDatabaseConnection(){
      $db = new PDO('sqlite:database/website.db');
      return $db;
   }
?>