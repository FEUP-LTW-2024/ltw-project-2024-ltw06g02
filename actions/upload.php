<?php
   require_once("../database/articles.php");
   require_once('../models/session.php');

   $session = new Session();

   if($_SERVER["REQUEST_METHOD"] == "POST"){


      if (isset($_FILES['files'])) {
         $files = $_FILES['files'];
         $file_count = count($files['name']);
         $paths = "";

         if($file_count > 4) {
            $session->addMessage('error', 'Select a maximum of 4 photos');
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
         }

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

         $session->addMessage('success', 'Article added');
         header('Location: ../index.php');
         exit();
      }
   }
?>