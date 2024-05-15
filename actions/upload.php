<?php
   session_start();

   require_once("../database/articles.php");

   if($_SERVER["REQUEST_METHOD"] == "POST"){
      if (isset($_FILES['files'])) {
         $files = $_FILES['files'];
         $file_count = count($files['name']);
         $paths = "";
         for($i = 0; $i < $file_count; $i++){
            $filename = $files['name'][$i];
            $tmp = $files['tmp_name'][$i];

            $filepath = '../assets/products' . '/' . $filename;
            $paths = $paths . $filepath . ',';

            $success = move_uploaded_file($tmp, $filepath);
            if(!$success) {
               echo("Error");
            }
         }

         addArticle($_POST, $paths);
         die(header("Location: ../index.php"));
      }
   }
?>