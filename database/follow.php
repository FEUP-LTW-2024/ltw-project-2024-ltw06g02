<?php
   require_once('connection.php');

   function addFollow($userId, $requesterId) : bool {
      $db = getDatabaseConnection();

      $sql = "INSERT INTO follow(userID, requesterID) VALUES (?,?)";
      $stmt = $db->prepare($sql);
      $stmt->bindParam(1, $userId);
      $stmt->bindParam(2, $requesterId);
      $stmt->execute();

      $stmt = $db->prepare("UPDATE users SET followers = followers + 1 WHERE userID = ?");
      $stmt->bindParam(1, $userId);
      $stmt->execute();

      return true;
   }

   function removeFollow($userId, $requesterId) : bool {
      $db = getDatabaseConnection();

      $stmt = $db->prepare(
        "DELETE FROM follow WHERE userID = ? AND requesterID=?"
      );
      $stmt->bindParam(1, $userId);
      $stmt->bindParam(2, $requesterId);

      $stmt->execute();

      $stmt = $db->prepare("UPDATE users SET followers = followers - 1 WHERE userID = ?");
      $stmt->bindParam(1, $userId);
      $stmt->execute();

      return true;
   }

   function checkIfFollows($userId, $requesterId) : bool{
      $db = getDatabaseConnection();

      $sql = "SELECT * FROM follow WHERE userID=? AND requesterID=?";
      $stmt = $db->prepare($sql);
      $stmt->bindParam(1, $userId);
      $stmt->bindParam(2, $requesterId);
      $stmt->execute();

      $result = $stmt->fetch();

      return !empty($result);
   }
?> 