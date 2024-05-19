<?php
    require_once(__DIR__ . '/connection.php');
    
    $db = getDatabaseConnection();
    function removeProductFromCart($userId, $articleId) : bool {
        global $db;

        $stmt = $db->prepare("DELETE FROM cart WHERE userID = ? AND productID = ?");
        $stmt->bindParam(1, $userId);
        $stmt->bindParam(2, $articleId);
        
        $stmt->execute();
        
        return true;
    }

    function removeProductFromAllCarts($articleID){
        global $db;

        $stmt = $db->prepare("DELETE FROM cart WHERE productID = ?");
        $stmt->execute(array($articleID));
    }

    function removeProductsFromCartByUserId($id) : bool {
        global $db;
        
        $stmt = $db->prepare(
            "DELETE FROM cart WHERE userID = ?"
        );
        $stmt->bindParam(1, $id);
        
        $stmt->execute();
        
        return true;
    }
?>