<?php
    session_start();

    require_once('../database/articles.php');
    require_once('../database/removeFromCart.php');
    require_once('../database/favorites.php');
    require_once('../database/user.php');
    require_once('../database/historic.php');
    require_once('../database/connection.php');

    $db = getDatabaseConnection();

    
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["cartItems"])) {
        $cartItems = $_POST["cartItems"];
        $userId = $_SESSION['userID'];
        
        if(!removeProductsFromCartByUserId($db,$userId)) die(header('Location: ../#'));

        foreach ($cartItems as $productId) {
            $article = getArticleById($db, $productId);
            if(!addPurchase($userId, $article['name'])) die(header('Location: ../#'));
            if(!addSale($article['userID'], $article['name'])) die(header('Location: ../#'));
        }
      
        foreach ($cartItems as $productId) {
            if(!removeFavoriteFromUsers($productId)) die(header('Location: ../#'));
            if(!removeArticle($db, $productId)) die(header('Location: ../#'));
        }

        header('Location: ../shopping_cart.php'); 
    }
?>