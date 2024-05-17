<?php
    require_once('../database/articles.php');
    require_once('../database/removeFromCart.php');
    require_once('../database/favorites.php');
    require_once('../database/user.php');
    require_once('../database/historic.php');
    require_once('../database/connection.php');
    require_once('../database/messages.php');
    require_once('../models/session.php');
    require_once(dirname(__DIR__) . '/templates/article.tl.php');

    $session = new Session();

    $db = getDatabaseConnection();

    
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["cartItems"])) {
        $cartItems = $_POST["cartItems"];
        $userID = $session->getUserId();
        
        if(!removeProductsFromCartByUserID($db,$userID)){
            $session->addMessage('error', 'Error occurred');
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }

        foreach ($cartItems as $productId) {
            $article = getArticleById($productId);
            if(!addPurchase($userID, $article)) die(header('Location: ../#'));
            if(!addSale($article)) die(header('Location: ../#'));
        }
      
        foreach ($cartItems as $productId) {
            if(!removeFavoriteFromUsers($productId)) die(header('Location: ../#'));
            if(!removeArticle($db, $productId)) die(header('Location: ../#'));
            if(!removeChat($productId)) die(header('Location: ../#'));
        }

        header('Location: ../shopping_cart.php'); 
    }
?>