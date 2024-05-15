<?php
    require_once('connection.php');
    
    function removeProductFromCart($db, $userId, $articleId) : bool {
        $stmt = $db->prepare("DELETE FROM cart WHERE userID = ? AND productID = ?");
        $stmt->bindParam(1, $userId);
        $stmt->bindParam(2, $articleId);
        
        $stmt->execute();
        
        return true;
    }

    function removeProductFromAllCarts($db, $articleID){
        $stmt = $db->prepare("DELETE FROM cart WHERE productID = ?");
        $stmt->execute(array($articleID));
    }

    function removeProductsFromCartByUserId($db, $id) : bool {
        $stmt = $db->prepare(
            "DELETE FROM cart WHERE userID = ?"
        );
        $stmt->bindParam(1, $id);
        
        $stmt->execute();
        
        return true;
    }
?>