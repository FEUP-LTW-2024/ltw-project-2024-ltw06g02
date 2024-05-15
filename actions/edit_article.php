<?php 
   require_once("../models/session.php");
   require_once("../database/articles.php");

   $session = new Session();

   $id = $_GET['q'];

   $article = getArticleById($id);

   $new_price = empty($_POST['price']) ?  $article['price'] : $_POST['price'];
   $new_name = empty($_POST['name']) ? $article['name'] : $_POST['name'];;

   if(empty($new_price) && empty($new_name)){
      die(header('Location: ../product.php?id=' . $id));
   }

   updateArticle($id, $new_price, $new_name);

   die(header('Location: ../product.php?id=' . $id));
   
?>