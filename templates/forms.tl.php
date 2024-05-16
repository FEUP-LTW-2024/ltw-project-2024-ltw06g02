<?php
   require_once(dirname(__DIR__) . "/database/filters.php");
   require_once(dirname(__DIR__) . "/database/connection.php");
   function buildRegisterForm() {
?>

   <dialog id="registerDialog" class="dialog">
      <button class="close-button" aria-label="Close alert" type="button" data-close>
         <span aria-hidden="true">&times;</span>
      </button>
      <p>sign up.</p>
      <form class="form" action="../actions/register.php" method="POST">
         <input type="text" name="fullName" placeholder="full name" required>
         <input type="text" name="username" placeholder="username" required>
         <input type="email" name="email" placeholder="email" required>
         <input type="password" name="password" placeholder="password" required>
         <button idtype="submit" class="form-button">continuar</button>
      </form>
   </dialog>

<?php 
   }
   function buildLoginForm() {
?>
    <dialog id="loginDialog" class="dialog">
      <button class="close-button" aria-label="Close alert" type="button" data-close>
         <span aria-hidden="true">&times;</span>
      </button>
      <p>login.</p>
      <form class="form" action="../actions/login.php" method="POST">
         <input type="text" name="username" placeholder="username" required>
         <input type="password" name="password" placeholder="password" required>
         <button type="submit" class="form-button">login</button>
      </form>
      <p>not a member? <a href="#" id="registerLink">sign up</a>.</p>
   </dialog>

<?php
   }

   function buildEditProfile() {
?>

<dialog id="editProfileDialog" class="dialog">
   <button class="close-button" aria-label="Close alert" type="button" data-close>
      <span aria-hidden="true">&times;</span>
   </button>
   <p>edit profile.</p>
   <form class="form" action="../actions/edit.php" method="POST">
      <input type="text" name="username" placeholder="new username">
      <input type="password" name="password" placeholder="new password">
      <input type="email" name="email" placeholder="new email">
      <button type="submit" class="form-button">edit</button>
   </form>
</dialog>      

<?php 
   } 

   function buildUploadPhoto() {
?>

<dialog id="uploadPhotoDialog" class="dialog">
   <button class="close-button" aria-label="Close alert" type="button" data-close>
      <span aria-hidden="true">&times;</span>
   </button>
   <p>upload.</p>
   <form action="../actions/upload_avatar.php" method="post" enctype="multipart/form-data">
      <input type="file" name="image" required>
      <button type="submit" class="form-button">upload</button>
   </form>
</dialog>  

<?php
   }

   function buildEditArticle($id) {
?>

<dialog id="editArticleDialog" class="dialog">
   <button class="close-button" aria-label="Close alert" type="button" data-close>
      <span aria-hidden="true">&times;</span>
   </button>
   <p>edit.</p>
   <form class="form" action=<?= "../actions/edit_article.php?q=" . $id ?> method="POST">
      <input type="text" name="price" placeholder="New price">
      <input type="text" name="name" placeholder="New name">
      <button type="submit" class="form-button">edit</button>
   </form>
</dialog> 

<?php 
   } 

   function buildPreferencesDialog($preferences) {
      $db = getDatabaseConnection();
      $categories = getAllCategories($db);
      $sizes = getAllSizes($db);
      $conditions = getAllConditions($db);
?>

<dialog id="editPreferencesDialog" class="dialog">
   <button class="close-button" aria-label="Close alert" type="button" data-close>
      <span aria-hidden="true">&times;</span>
   </button>
   <p>edit preferences.</p>
   <form class="form" action="../actions/save_preferences.php" method="POST">
      <select class="preferences-select" name="category">
         <?php foreach($categories as $category) echo "<option value=" . $category['categoryID'] . (((isset($preferences)) && $preferences['categoryID'] == $category['categoryID']) ? ' selected>' : '>') . $category['name']. "</option>"?>
      </select>
      <select class="preferences-select" name="size">
         <?php foreach($sizes as $size) echo "<option value=" . $size['sizeID'] . (((isset($preferences)) && $preferences['sizeID'] == $size['sizeID']) ? ' selected>' : '>') . $size['name']. "</option>"?>
      </select>
      <select class="preferences-select" name="condition">
         <?php foreach($conditions as $condition) echo "<option value=" . $condition['conditionID'] . (((isset($preferences)) && $preferences['conditionID'] == $condition['conditionID']) ? ' selected>' : '>') . $condition['name']. "</option>"?>
      </select>
      <button type="submit" class="form-button">save</button>
   </form>
</dialog> 

<?php 
   }
?>