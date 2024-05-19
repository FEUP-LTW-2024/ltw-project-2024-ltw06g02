<?php
   function getSingleArticle($article){
      $images = explode(",", $article['images']);
?>
   
   <article class="article">
      <a href="../pages/product.php?id=<?=$article['productID']?>"><img src=<?= $images[0] ?> alt="" class="product-img"></a>
      <div class="article-details">
         <div>
            <div style="display: flex; column-gap: 0.5em;">
               <h3><?= $article['name'] ?></h3>
               <?php if($article['promotion']) { ?> <div class="discount-tag"><?= $article['promotion'] * 100 . '%'?> discount</div> <?php } ?>
            </div>
            <div style="display: flex;">
               <p><?php echo (isset($_SESSION['currency']) && $_SESSION['currency'] == 'dol') ? ($article['promotion'] ? '<del>' . round($article['price'] * 1.09, 2) . '<span style="font-size: 0.7em;">$</span></del>' : round($article['price'] * 1.09, 2) . '<span style="font-size: 0.7em;">$</span>') : ($article['promotion'] ? '<del>' . round($article['price'], 2) . '<span style="font-size: 0.7em;">€</span></del>' : round($article['price'], 2) . '<span style="font-size: 0.7em;">€</span>')?></p>
               <?php if($article['promotion']) {?><p style="color: #344e41;"><?= isset($_SESSION['currency']) && $_SESSION['currency'] == 'dol' ? round($article['price'] * 1.09 - $article['price'] * $article['promotion'] * 1.09, 2) . '<span style="font-size: 0.7em;">$</span>' : round($article['price'] - $article['price'] * $article['promotion'], 2) . '<span style="font-size: 0.7em;">€</span>' ?></p><?php } ?>
            </div>        
         </div>
         <div style="display: flex; flex-direction: row; align-items: center; column-gap: 0.5em;">
            <div class="like-container">
               <i class="material-icons heart-icon">favorite</i>
               <p class="number" style="color: #c1121f;"><?= $article['likes'] ?></p>
            </div>
            <img src=<?= $article['avatar'] ?>>
         </div>
      </div>
   </article>

<?php
   }
   function printArticleSection($articles, $title){
?>
   <div class="product-section">
      <h3 class="products-title playfair-display-font" style="font-size: 3em; text-align: center; margin-top: 0; margin-bottom: 0;"><?php echo $title == 'explore. love. buy.' ? 'explore. <span class="playfair-display-font" style="color: #c1121f;">love.</span> buy.' : $title ?></h3>
         <?php if($title != 'following.') { ?> 
            <div class="search-conjunction">
               <div class="search-bar-wrapper">
                  <i class="material-icons" style="margin-left: 0.5em">search</i>
                  <input class="search-bar" id="search-bar" type="text" placeholder="e.g blue hoodie...">
               </div> 
               <?php if(isset($_SESSION['userID']) && isset(retrieveUser($_SESSION['userID'])['preferencesID'])) {?>
                  <div class="preference-icon" id="filter-preference"><i class="material-icons">add</i> apply preferences</div>
               <?php } ?>
            </div>
         <?php } ?>
      
      <section class="article-grid" id="grid">
         <?php 

         $check = 0;

         foreach($articles as $article){
            if(isset($_SESSION['userID']) && $article['userID'] == $_SESSION['userID']) $check += 1;
         }

         if(sizeof($articles) == 0 || $check == sizeof($articles)) echo "
            <div class='no-product-section'>
               <img class='no-product-img' style='margin-top: 1em;' src='../assets/no_items.svg'>
               <h3 style='margin-top: 2em;'>nothing here.</h3>
            </div>
            "
         ?>
         <?php 
            foreach($articles as $article){
               if(!isset($_SESSION['userID']) || (isset($_SESSION['userID']) && ($article['userID'] != $_SESSION['userID']))) {
                  getSingleArticle($article);
               } 
            }
         ?>
      </section>
   </div>
   <script>

      document.getElementById('search-bar').addEventListener('input', function() {
         searchItems(this.value);
      })

      document.getElementById('filter-preference').addEventListener('click', function() {
         applyPreference();
      })
      
      function applyPreference(){
         const xhttp = new XMLHttpRequest();
         xhttp.onload = function() {
            document.getElementById("grid").innerHTML = this.responseText;
         }
         xhttp.open("GET", "../actions/apply_preference.php");
         xhttp.send();
      }

      function searchItems(str) {
         const xhttp = new XMLHttpRequest();
         xhttp.onload = function() {
            document.getElementById("grid").innerHTML = this.responseText;
         }
         xhttp.open("GET", "../actions/search_item.php?q="+ str);
         xhttp.send();
      }
   </script>
<?php
   }
?>

<?php
   function printDifferentArticleSection($articles, $identifier){
?>

         <div class="product-section">
            <h3 class="products-title"><?= $identifier == 'favorites' ? 'favorites.' : 'shopping cart.' ?></h3>
            <section class="article-grid">
               <?php if(empty($articles)){ ?>

                  <div class="no-favorite-articles">
                     <img class='no-product-img' style='margin-top: 1em;' src='../assets/no_items.svg'>
                     <h3 style='margin-top: 2em; text-align: center;'>nothing here.</h3>
                     <a href="index.php"></hre><button>start looking.</button></a>
                  </div>
               <?php
                  }
                  foreach($articles as $article){
                     $article = getArticleById($article['productID']);
                     getSingleArticle($article);
                  }
               ?>
            </section>
         </div>

<?php
   }
   function printArticleById($article, $userID){
      buildEditArticle($article);
      buildPromotionDialog($article);

      $images = explode(",", $article['images']);
      $category = getCategoryByID($article['categoryID']);
      $size = getSizeByID($article['sizeID']);
      $condition = getConditionByID($article['conditionID']);
      $username = retrieveUser($article['userID'])['username'];
      $inCart = checkCartArticle($article['productID'], $userID);
?>

   <div class="container">
      <div style="display: flex; flex-direction: column; row-gap: 1em; max-width: 25em; align-items: center;">
         <img src=<?=$images[0]?> alt="product" class="product-image">
         <div style="display: flex; column-gap: 1em;">
            <?php for($i = 1; $i < sizeof($images) - 1; $i++) { ?>
               <img src=<?=$images[$i]?> class="product-image" style="height: 10em; flex: 1; min-width: 0; max-width: 8em">
            <?php } ?>
         </div>
      </div>
      <aside class="product-column">
         <h1 class="price">
            <?php echo (isset($_SESSION['currency']) && $_SESSION['currency'] == 'dol') ? ($article['promotion'] ? '<del>' . round($article['price'] * 1.09, 2) . '<span style="font-size: 0.7em;">$</span></del>' : round($article['price'] * 1.09, 2) . '<span style="font-size: 0.7em;">$</span>') : ($article['promotion'] ? '<del>' . round($article['price'], 2) . '<span style="font-size: 0.7em;">€</span></del>' : round($article['price'], 2) . '<span style="font-size: 0.7em;">€</span>'); ?>
            <?php if($article['promotion']) {?><span style="color: #344e41;"><?= isset($_SESSION['currency']) && $_SESSION['currency'] == 'dol' ? round($article['price'] * 1.09 - $article['price'] * $article['promotion'] * 1.09, 2) . '<span style="font-size: 0.7em;">$</span>' : round($article['price'] - $article['price'] * $article['promotion'], 2) . '<span style="font-size: 0.7em;">€</span>' ?></span><?php } ?>
            <span style="font-size: 0.7em; color: #344e41;">by <a style="color: #344e41;" href=<?= '../pages/profile_user.php?id=' . $article['userID']?>> <?= $username ?> </a></span>
         </h1>
         <hr class="separator">
         <h2 class="name"><?=$article['name']?></h2>
         <h2 class="description">Description: <?=$article['description']?></h2>
         <h2 class="category">Category: <?=$category['name']?></h2> 
         <h2 class="brand" style="<?php if($article['brand'] == null) echo "display: none;"?>">Brand: <?=$article['brand']?></h2>
         <h2 class="model" style="<?php if($article['model'] == null) echo "display: none;"?>">Model: <?=$article['model']?></h2>
         <h2 class="size" style="<?php if($article['sizeID'] == null) echo "display: none;"?>">Size: <?=$size['name']?></h2>
         <h2 class="condition" style="<?php if($article['conditionID'] == null) echo "display: none;"?>">Condition: <?=$condition['name']?></h2>
   
         <hr class="separator">

         <?php if($userID != $article['userID']) { ?>

            <?php if($inCart) { ?>
               <a href=<?= "../actions/remove_from_cart.php?userID=" . $userID . "&articleID=" . $article['productID']?>>
                  <button id="buyBtn" class="<?php if (!$userID) echo "disabled"?> product-btn">remove from cart</button>
               </a>
            <?php } else { ?>
               <a href=<?= "../actions/add_to_cart.php?userID=" . $userID . "&articleID=" . $article['productID']?>>
                  <button id="buyBtn" class="<?php if (!$userID) echo "disabled"?> product-btn">add to cart</button>
               </a>
            <?php } ?>
            
            <a href=<?= "../actions/initialize_chat.php?q=" . $article['productID'] ?> ><button type="submit" id="sendBtn" class="<?php if (!$userID) echo "disabled"?> product-btn">send message</button></a>

         <?php
            $favoriteArticles = getFavoriteArticlesByUserId($userID);
            $exists = false;

            foreach($favoriteArticles as $favorite){
               if($favorite['productID'] == $article['productID']){
                  $exists = true;
               }
            }

            if($exists === false){ ?>
                  <a href=<?= "../actions/favorite.php?userID=" . $userID . "&articleID=" . $article['productID']?>>
                     <button id="removeBtn" class="<?php if (!$userID) echo "disabled"?> product-btn fav-btn">add to favorites</button>
                  </a>
               <?php } else { ?>
                  <a href=<?= "../actions/remove_favorite.php?userID=" . $userID . "&articleID=" . $article['productID']?>>
                     <button id="removeBtn" class="<?php if (!$userID) echo "disabled"?> product-btn fav-btn">remove from favorites</button>
                  </a>
               <?php } }?>

         <?php if(isset($userID) && $userID == $article['userID']){ ?>
            <div class="product-btn-row">
               <a ><button class="product-btn" id="edit">edit article</button></a>
               <a href=<?= "../actions/remove_article.php?articleID=" . $article['productID']?>><button class="product-btn rm-btn">remove article</button></a>
            </div>
         <?php } ?>

      </aside>
   </div>
   <script>
      const values = document.querySelectorAll(".promotion");
      const addPromotion = document.getElementById('promotionbtn');
      const removePromotion = document.getElementById('remove-promotion');

      const customDiscount = document.getElementById('custom-discount');
      const customDiscountInput = document.getElementById('custom-discount-input');

      customDiscount.addEventListener("click", () => {
         customDiscountInput.style = "display: flex";

         values.forEach((b) => {
            b.classList = 'promotion'
         })
      })

      if(removePromotion){
         removePromotion.addEventListener("click", () => {
            location.replace("../actions/remove_promotion.php");
         })
      }
      
      addPromotion.addEventListener("click", () => {
         let prom;
         try {
            prom = document.querySelector('.promotion.selected').getAttribute('value');
         } catch {
            prom = customDiscountInput.value / 100;
         }
         
         if(prom > 0 && prom < 1) {
            location.replace("../actions/edit_promotion.php?prom=" + prom);
         }
      })

      values.forEach((e) => {
         e.addEventListener("click", () => {

            values.forEach((b) => {
               b.classList = 'promotion'
            })

            e.classList += ' selected'
            customDiscountInput.style = "display: none;";
         })
      })

      document.querySelectorAll('button.disabled').forEach((button) => 
         button.addEventListener('click', (e) => {
            e.preventDefault()
            loginDialog.showModal();
         }
      ))
   </script>

<?php
   }

   function printCheckoutSection($articles) {
      buildCheckoutDialog($articles);
?>

   <section style="display: flex; justify-content: end; margin: 1em 2em;">
      <?php if(sizeof($articles) > 0) { ?> <button class="filter-btn" id="checkoutBtn">procceed to checkout</button> <?php } ?>
   </section>

   <script>
      const checkoutBtn = document.getElementById("checkoutBtn");
      const checkoutDialog = document.getElementById("checkoutDialog")
      const closeCheckoutBtn = checkoutDialog.querySelector(".close-button");

      checkoutBtn.addEventListener("click", () => {
         checkoutDialog.showModal();
      })

      closeCheckoutBtn.addEventListener("click", () => {
         checkoutDialog.close();
      })
   </script>

<?php } ?>

<script>
   document.addEventListener("DOMContentLoaded", function() {
      const editDialog = document.getElementById("editArticleDialog");
      const openEditBtn = document.getElementById("edit");
      const closeEditBtn = editDialog.querySelector(".close-button");

      const promotionDialog = document.getElementById("editPromotionDialog");
      const closePromotionBtn = promotionDialog.querySelector(".close-button");
      const openPromotionBtn = document.getElementById("add-promotion");


      openEditBtn.addEventListener("click", () => {
         editDialog.showModal();
      });

      closeEditBtn.addEventListener("click", () => {
         editDialog.close();
      });

      openPromotionBtn.addEventListener("click", () => {
         editDialog.close();
         promotionDialog.showModal();
      })
      
      closePromotionBtn.addEventListener("click", () => {
         promotionDialog.close();
      })    
   });
</script>