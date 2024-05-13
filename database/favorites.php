<?php
    require_once('connection.php');
    function addFavorite($favorite) : bool{
        $db = getDatabaseConnection();

        $stmt = $db->prepare("INSERT INTO favorites (userID, productID) VALUES (?, ?)");
        $stmt->bindParam(1, $favorite->userId);
        $stmt->bindParam(2, $favorite->articleId);
        $stmt->execute();

        return true;
    }
    
    function removeFavorite($userId, $articleId) : bool {
        $db = getDatabaseConnection();
    
        $stmt = $db->prepare("DELETE FROM favorites WHERE userID = ? AND productID = ?");
        $stmt->bindParam(1, $userId);
        $stmt->bindParam(2, $articleId);
        
        $stmt->execute();
        
        return true;
    }

    function removeFavoriteFromUsers($articleId) : bool{
        $db = getDatabaseConnection();
    
        $stmt = $db->prepare("DELETE FROM favorites WHERE productID = ?");
        $stmt->bindParam(1, $articleId);
        
        $stmt->execute();
        
        return true;
    }
?>
