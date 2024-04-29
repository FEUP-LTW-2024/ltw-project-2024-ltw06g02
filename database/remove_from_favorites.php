<?php
    require_once('connection.php');
    

    function removeFavorite($userId, $articleId) : bool {
        $db = getDatabaseConnection();
    
        $stmt = $db->prepare("DELETE FROM favorites WHERE userID = ? AND productID = ?");
        $stmt->bindParam(1, $userId);
        $stmt->bindParam(2, $articleId);
        
        $stmt->execute();
        
        return true;
    }
    
    
?>