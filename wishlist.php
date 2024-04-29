<?php
   session_start();

   require_once('templates/footer.tl.php');
   require_once('templates/header.tl.php');
   require_once('templates/article.tl.php');
   require_once('templates/filter.tl.php');
   require_once('database/connection.php');
   require_once('database/articles.php');
   require_once('database/filters.php');

   $db = getDatabaseConnection();

   $username = $_SESSION['username'];

   $stmt = $db->prepare(
      "SELECT userID FROM users WHERE username = ?"
   );
   $stmt->execute(array($username));
   $user = $stmt->fetch();

   $favoriteArcticles = getFavoriteArticlesByUserId($db, $user['userID']);

   printHeader('Bazinga!');
   printFavoriteArticleSection($db ,$favoriteArcticles);
   printFooter();
?>