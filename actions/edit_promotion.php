<?php 
   require_once(__DIR__ . "/../models/session.php");
   require_once(__DIR__ . "/../database/articles.php");

   $session = new Session();

   if(!isset($_GET['prom'])){
      $session->addMessage('error', 'Error occurred');
      header('Location: ' . $_SERVER['HTTP_REFERER']);
      exit();
   }

   $referer = $_SERVER['HTTP_REFERER'];
   $parts = parse_url($referer);
   parse_str($parts['query'], $query);
   
   if(!editPromotion($_GET['prom'], $query['id'])){
      $session->addMessage('error', 'Error occurred');
      header('Location: ' . $_SERVER['HTTP_REFERER']);
      exit();
   }

   $session->addMessage('success', 'Promotion added');
   header('Location: ' . $_SERVER['HTTP_REFERER']);
   exit();
?>