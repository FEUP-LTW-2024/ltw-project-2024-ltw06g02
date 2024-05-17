<?php 
   require_once("../models/session.php");
   require_once("../database/articles.php");

   $session = new Session();

   $id = $_GET['q'];

   $article = getArticleById($id);

   if(empty($_POST['price']) && empty($_POST['name'])){
      $session->addMessage('error', 'Fill out at least one camp');
      header('Location: ' . $_SERVER['HTTP_REFERER']);
      exit();
   }

   $new_price = empty($_POST['price']) ? $article['price'] : $_POST['price'];
   $new_name = empty($_POST['name']) ? $article['name'] : $_POST['name'];;

   updateArticle($id, $new_price, $new_name);

   $session->addMessage('success', 'Article edited');
   header('Location: ' . $_SERVER['HTTP_REFERER']);
   exit();
?>