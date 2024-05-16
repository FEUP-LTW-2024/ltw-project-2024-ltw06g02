<?php
    session_start();

    require_once('../database/articles.php');
    require_once('../database/removeFromCart.php');
    require_once('../database/favorites.php');
    require_once('../database/user.php');
    require_once('../database/historic.php');
    require_once('../database/connection.php');

    $db = getDatabaseConnection();

    $userId = $_SESSION['userID'];
    $cartItems = getCartArticlesByUserId($db, $userId);
    
    if(!removeProductsFromCartByUserId($db,$userId)) die(header('Location: ../#'));

    foreach ($cartItems as $cart) {
        $article = getArticleById($db, $cart['productID']);
        if(!addPurchase($userId, $article['name'])) die(header('Location: ../#'));
        if(!addSale($article['userID'], $article['name'])) die(header('Location: ../#'));
    }
    
    foreach ($cartItems as $cart) {
        if(!removeFavoriteFromUsers($cart['productID'])) die(header('Location: ../#'));
        if(!removeArticle($db, $cart['productID'])) die(header('Location: ../#'));
    }

    header('Location: ../shoppingCart.php');
?>