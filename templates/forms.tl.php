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

   function buildEditArticle($article) {
?>

<dialog id="editArticleDialog" class="dialog">
   <button class="close-button" aria-label="Close alert" type="button" data-close>
      <span aria-hidden="true">&times;</span>
   </button>
   <p>edit.</p>
   <form class="form" action=<?= "../actions/edit_article.php?q=" . $article['productID']?> method="POST">
      <input type="number" name="price" placeholder="New price">
      <input type="text" name="name" placeholder="New name">
      <?php if(!isset($article['promotion'])) ?> <div class="promotion-icon" id="add-promotion"><i class="material-icons">add</i><?= !isset($article['promotion']) ? 'add promotion' : 'edit promotion' ?></div>
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
         <option value="">None</option>
         <?php foreach($categories as $category) echo "<option value=" . $category['categoryID'] . (((isset($preferences)) && $preferences['categoryID'] == $category['categoryID']) ? ' selected>' : '>') . $category['name']. "</option>"?>
      </select>
      <select class="preferences-select" name="size">
         <option value="">None</option>
         <?php foreach($sizes as $size) echo "<option value=" . $size['sizeID'] . (((isset($preferences)) && $preferences['sizeID'] == $size['sizeID']) ? ' selected>' : '>') . $size['name']. "</option>"?>
      </select>
      <select class="preferences-select" name="condition">
         <option value="">None</option>
         <?php foreach($conditions as $condition) echo "<option value=" . $condition['conditionID'] . (((isset($preferences)) && $preferences['conditionID'] == $condition['conditionID']) ? ' selected>' : '>') . $condition['name']. "</option>"?>
      </select>
      <button type="submit" class="form-button">save</button>
   </form>
</dialog> 

<?php 
   }

   function buildPromotionDialog($article){
?>

<dialog id="editPromotionDialog" class="dialog">
   <button class="close-button" aria-label="Close alert" type="button" data-close>
      <span aria-hidden="true">&times;</span>
   </button>
   <p>edit promotion.</p>
   <div style="display: flex; flex-direction: column; row-gap: 1em;">
      <div class="default-promotions">
         <div class="promotion" value="0.1">10%</div>
         <div class="promotion" value="0.5">50%</div>
         <div class="promotion" value="0.9">90%</div>
      </div>
      <div class="promotion-icon" style="margin-bottom: 0;" id="custom-discount"><i class="material-icons">edit</i>custom discount</div>
      <input class="custom-promotion" style="display: none;" type="number" max="99" min="0" id="custom-discount-input">
      <?php if($article['promotion']) { ?> <div class="promotion-icon" id="remove-promotion"><i class="material-icons">delete</i>delete promotion</div><?php } ?>
   </div>
   <button class="form-button" id="promotionbtn" style="display:flex; margin: 1em auto 0 auto;">edit</button>
</dialog> 

<?php 
   } 

   function buildCheckoutDialog($cartArticles){
?>

   <dialog id="checkoutDialog" class="dialog">
      <button class="close-button" aria-label="Close alert" type="button" data-close>
         <span aria-hidden="true">&times;</span>
      </button>
      <p>checkout.</p>
      <div class="promotion-icon" style="margin-bottom: 0;" id="shipping"><i class="material-icons">add</i>generate shipping costs</div>
      <p id="shipping-cost" style="margin: 0; display: none; justify-content: center;"><?= (isset($_SESSION['currency']) && $_SESSION['currency'] == 'dol' ) ? '$' : '€' ?></p>
      <div class="default-promotions" id="payments" style="display:none; margin-top: 1em;">
         <div class="promotion">credit card</div>
         <div class="promotion">paypal</div>
      </div>
      <form action="../actions/buy.php" method="post">
         <?php foreach ($cartArticles as $cart): ?>
            <input type="hidden" name="cartItems[]" value="<?= $cart['productID'] ?>">
         <?php endforeach; ?>
         <button class="form-button" id="checkout" type="submit" disabled style="display:flex; margin: 1em auto 0 auto;">buy</button>
      </form>
   </dialog> 

   <script>
      const shippingBtn = document.getElementById("shipping");
      const shippingCost = document.getElementById("shipping-cost")
      const payments = document.getElementById("payments")
      const paymentBtn = payments.querySelectorAll(".promotion")
      const buy = document.getElementById("checkout")

      shippingBtn.addEventListener("click", () => {
         if(shippingCost.style.display == "none") {
            shippingCost.innerHTML = Math.round(Math.random() * 300) / 10 + shippingCost.innerHTML;
         }
         shippingCost.style.display = "flex";
         payments.style.display = "flex";
      })

      paymentBtn.forEach((e) => {
         e.addEventListener("click", () => {
            paymentBtn.forEach((b) => {
               b.classList = 'promotion'
            })

            e.classList += ' selected'
            buy.removeAttribute("disabled");
         })
      })
      
   </script>

<?php } ?>