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
    
?>
