<?php
    require_once(__DIR__ . '/connection.php');

    $db = getDatabaseConnection();
    function addProductToCart($cart) : bool{
        global $db;

        $stmt_check = $db->prepare("SELECT COUNT(*) as count FROM cart WHERE userID = ? AND productID = ?");
        $stmt_check->bindParam(1, $cart->userId);
        $stmt_check->bindParam(2, $cart->articleId);
        $stmt_check->execute();
        $result = $stmt_check->fetch();

        if ($result['count'] > 0) {
            return false;
        }

        $stmt = $db->prepare("INSERT INTO cart (userID, productID) VALUES (?, ?)");
        $stmt->bindParam(1, $cart->userId);
        $stmt->bindParam(2, $cart->articleId);
        $stmt->execute();

        return true;
    }
?>