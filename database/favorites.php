<?php
    require_once('connection.php');

    $db = getDatabaseConnection();
    function addFavorite($favorite, $articleId){
        global $db;

        $stmt = $db->prepare("INSERT INTO favorites (userID, productID) VALUES (?, ?)");
        $stmt->bindParam(1, $favorite->userId);
        $stmt->bindParam(2, $favorite->articleId);
        $stmt->execute();

        $stmt = $db->prepare("UPDATE product SET likes = likes + 1 WHERE productID = ?");
        $stmt->bindParam(1, $articleId);
        $stmt->execute();
    }
    
    function removeFavorite($userId, $articleId){
        global $db;
    
        $stmt = $db->prepare("DELETE FROM favorites WHERE userID = ? AND productID = ?");
        $stmt->bindParam(1, $userId);
        $stmt->bindParam(2, $articleId);
        $stmt->execute();

        $stmt = $db->prepare("UPDATE product SET likes = likes - 1 WHERE productID = ?");
        $stmt->bindParam(1, $articleId);
        $stmt->execute();
    }

    function removeFavoriteFromUsers($articleId) : bool{
        global $db;
    
        $stmt = $db->prepare("DELETE FROM favorites WHERE productID = ?");
        $stmt->bindParam(1, $articleId);
        $stmt->execute();

        return true;
    }
?>
