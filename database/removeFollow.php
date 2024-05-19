<?php
   require_once(__DIR__ . '/connection.php');

   $db = getDatabaseConnection();

   function removeFollow($userId, $requesterId) : bool {
      global $db;

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
?> 