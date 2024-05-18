<?php 
   require_once("../models/session.php");
   require_once("../database/articles.php");

   $session = new Session();

   $referer = $_SERVER['HTTP_REFERER'];
   $parts = parse_url($referer);
   parse_str($parts['query'], $query);
   
   if(!removePromotion($query['id'])){
      $session->addMessage('error', 'Error occurred');
      header('Location: ' . $_SERVER['HTTP_REFERER']);
      exit();
   }

   $session->addMessage('success', 'Promotion removed');
   header('Location: ' . $_SERVER['HTTP_REFERER']);
   exit();
?>