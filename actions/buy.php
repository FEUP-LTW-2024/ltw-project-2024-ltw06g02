<?php
    require_once(__DIR__ . '/../database/articles.php');
    require_once(__DIR__ . '/../database/removeFromCart.php');
    require_once(__DIR__ . '/../database/favorites.php');
    require_once(__DIR__ . '/../database/user.php');
    require_once(__DIR__ . '/../database/historic.php');
    require_once(__DIR__ . '/../database/messages.php');
    require_once(__DIR__ . '/../models/session.php');
    require_once(__DIR__ . '/../templates/article.tl.php');
    require_once(__DIR__ . '/../models/session.php');

    $session = new Session();
    
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["cartItems"])) {
        $cartItems = $_POST["cartItems"];
        $userID = $session->getUserId();
        
        if(!removeProductsFromCartByUserID($userID)){
            $session->addMessage('error', 'Error occurred');
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit();
        }

        foreach ($cartItems as $productId) {
            $article = getArticleById($productId);
            if(!addPurchase($userID, $article) || !addSale($article)){
                $session->addMessage('error', 'Error occurred');
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            }
        }
      
        foreach ($cartItems as $productId) {
            if(!removeFavoriteFromUsers($productId) || !removeArticle($productId) || !removeChat($productId)){
                $session->addMessage('error', 'Error occurred');
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit();
            }
        }

        $session->addMessage('success', 'Bought!');
                header('Location: ' . $_SERVER['HTTP_REFERER']);
                exit(); 
    }
?>