<?php
   function getSingleArticle($productID, $name, $price, $image, $avatar, $likes){
      $images = explode(",", $image);
?>
   
   <article class="article">
      <a href="product.php?id=<?=$productID?>"><img src=<?= $images[0] ?> alt="" class="product-img"></a>
      <div class="article-details">
         <div>
            <h3><?= $name ?></h3>
            <p><?php echo (isset($_SESSION['currency']) && $_SESSION['currency'] == 'dol') ? $price * 1.09 . '$' : $price . '€'; ?></p>
         </div>
         <div style="display: flex; flex-direction: row; align-items: center; column-gap: 0.5em;">
            <div class="like-container">
               <i class="material-icons heart-icon">favorite</i>
               <p class="number" style="color: #c1121f;"><?= $likes ?></p>
            </div>
            <img src=<?= $avatar ?>>
         </div>
      </div>
   </article>

<?php
   }
?>

<?php
   function getSingleCartArticle($productID, $name, $price, $image, $userID){
      $images = explode(",", $image);
?>
   <article class="article">
      <form id="removeFromCartForm" action="../actions/remove_from_cart.php" method="POST">
         <input type="hidden" name="userId" value="<?=$userID?>">
         <input type="hidden" name="articleId" value="<?=$productID?>">
         <button type="submit" id="removeFromCartBtn" class="material-icons">delete</button>
      </form>
      <img src=<?= $images[0] ?> alt="" class="product-img">
      <div class="article-details">
         <div>
            <h3><?= $name ?></h3>
            <p><?php echo (isset($_SESSION['currency']) && $_SESSION['currency'] == 'dol') ? $price * 1.09 . '$' : $price . '€'; ?></p>
         </div>
      </div>
   </article>

<?php
   }
?>

<?php
   function printArticleSection($articles, $title){
?>
   <div class="product-section">
      <h3 class="products-title playfair-display-font" style="font-size: 3em; text-align: center; margin-top: 0; margin-bottom: 0;"><?php echo $title == 'explore. love. buy.' ? 'explore. <span class="playfair-display-font" style="color: #c1121f;">love.</span> buy.' : $title ?></h3>
      <?php if($title != 'following.') { ?> 
         <div class="search-bar-wrapper">
            <i class="material-icons" style="margin-left: 0.5em">search</i>
            <input class="search-bar" id="search-bar" type="text" placeholder="e.g blue hoodie...">
         </div> 
      <?php } ?>
      <section class="article-grid" id="grid">
         <?php 
            if(sizeof($articles) == 0) echo "
            <div class='no-product-section'>
               <img class='no-product-img' style='margin-top: 1em;' src='../assets/no_items.svg'>
               <h3 class='playfair-display-font' style='margin-top: 2em;'>não foram encontrados artigos.</h3>
            </div>
            "
         ?>
         <?php 
            foreach($articles as $article){
               if(!isset($_SESSION['userID']) || (isset($_SESSION['userID']) && ($article['userID'] != $_SESSION['userID']))) {
                  getSingleArticle($article['productID'],$article['name'], $article['price'], $article['images'], $article['avatar'], $article['likes']);
               } 
            }
         ?>
      </section>
   </div>
   <script>

      document.getElementById('search-bar').addEventListener('input', function() {
         searchItems(this.value);
      })
      

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
   function printFavoriteArticleSection($db, $favoriteArticles){
?>

         <div class="product-section">
            <h3 class="products-title">Artigos marcados como favoritos</h3>
            <section class="article-grid">
               <?php if(empty($favoriteArticles)){ ?>

                  <div class="no-favorite-articles">
                     <h2>Não tens artigos favoritos!</h2>
                     <a href="index.php"></hre><button>Começa a procurar!</button></a>
                  </div>
               <?php
                  }
                  foreach($favoriteArticles as $favorite){
                     $article = getArticleById($favorite['productID']);
                     getSingleArticle($article['productID'], $article['name'], $article['price'], $article['images'], $article['avatar'], $article['likes']);
                  }
               ?>
            </section>
         </div>

<?php
   }
   function printArticleById($db, $article, $userID){
      buildEditArticle($article['productID']);

      $images = explode(",", $article['images']);
      $category = getCategoryByID($db, $article['categoryID']);
      $size = getSizeByID($db, $article['sizeID']);
      $condition = getConditionByID($db, $article['conditionID']);
      $username = retrieveUser($article['userID'])['username'];
?>

   <div class="container">
      <img src="<?=$images[0]?>" alt="product">
      <aside class="product-column">
         <h1 class="price"><?php echo (isset($_SESSION['currency']) && $_SESSION['currency'] == 'dol') ? $article['price'] * 1.09 . '$' : $article['price'] . '€'; ?> <span style="font-size: 0.7em; color: #344e41;">by <?= $username ?></span></h1>
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

         <a href=<?= "../actions/add_to_cart.php?userID=" . $userID . "&articleID=" . $article['productID']?>>
            <button id="buyBtn" class="<?php if (!$userID) echo "disabled"?> product-btn">Adicionar ao carrinho</button>
         </a>
         <a href=<?= "../actions/initialize_chat.php?q=" . $article['productID'] ?> ><button type="submit" id="sendBtn" class="<?php if (!$userID) echo "disabled"?> product-btn">Enviar mensagem</button></a>

         <?php
            $favoriteArticles = getFavoriteArticlesByUserId($db, $userID);
            $exists = false;

            foreach($favoriteArticles as $favorite){
               if($favorite['productID'] == $article['productID']){
                  $exists = true;
               }
            }

            if($exists === false){ ?>
                  <a href=<?= "../actions/favorite.php?userID=" . $userID . "&articleID=" . $article['productID']?>>
                     <button id="removeBtn" class="<?php if (!$userID) echo "disabled"?> product-btn fav-btn">Adicionar aos favoritos</button>
                  </a>
               <?php } else { ?>
                  <a href=<?= "../actions/remove_favorite.php?userID=" . $userID . "&articleID=" . $article['productID']?>>
                     <button id="removeBtn" class="<?php if (!$userID) echo "disabled"?> product-btn fav-btn">Remover aos favoritos</button>
                  </a>
               <?php } }?>

         <?php if(isset($userID) && $userID == $article['userID']){ ?>
            <div class="product-btn-row">
               <a ><button class="product-btn" id="edit">Editar artigo</button></a>
               <a href=<?= "../actions/remove_article.php?articleID=" . $article['productID']?>><button class="product-btn rm-btn">Remover artigo</button></a>
            </div>
         <?php } ?>

      </aside>
   </div>
   <script>
      document.querySelectorAll('button.disabled').forEach((button) => 
         button.addEventListener('click', (e) => {
            e.preventDefault()
            loginDialog.showModal();
         }
      ))
   </script>

<?php
   }
?>

<?php

function printCartArticleSection($db, $cartArticles, $userID){

   if (empty($cartArticles)) {
      ?>
      <div class="product-section-cart">
         <h3 class="products-title">Shopping Cart</h3>
         <section class="article-grid">
            <div class="no-favorite-articles">
               <h2>Não tens artigos no carrinho!</h2>
               <a href="index.php"></hre><button>Adiciona!</button></a>
            </div>
         </section>
      </div>
      <?php
   } else {
      ?>
      <div class="product-section-carousel">
         <h3 class="products-title-carousel">Shopping Cart</h3>
         <div class="carousel-container">
            <?php
               foreach($cartArticles as $cart){
                  $article = getArticleById($cart['productID']);
                  getSingleCartArticle($article['productID'], $article['name'], $article['price'], $article['images'], $userID);
               }
            ?>
         </div>
         <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
         <a class="next" onclick="plusSlides(1)">&#10095;</a>
         <div style="text-align:center">
            <?php for($i = 0; $i < count($cartArticles); $i++): ?>
               <span class="dot" onclick="currentSlide(<?php echo $i + 1; ?>)"></span>
            <?php endfor; ?>
         </div>
         <section class="article-grid-cart">
            <div class="emptyBox">
               <h4 class="emptyParagrah">Add more articles and find them here</h4>
               <a href="../index.php" class="find">Search</a>
            </div>
         </section>
         <form id="removeFromCartForm" action="../actions/buy.php" method="POST">
            <?php foreach ($cartArticles as $cart): ?>
               <input type="hidden" name="cartItems[]" value="<?= $cart['productID'] ?>">
            <?php endforeach; ?>
            <button type="submit" id="buyCartBtn">Finalize purchase</button>
         </form>
      </div>

      <script>
         let slideIndex = 1;
         showSlides(slideIndex);

         function plusSlides(n) {
            showSlides(slideIndex += n);
         }

         function currentSlide(n) {
            showSlides(slideIndex = n);
         }

         function showSlides(n) {
            let i;
            let slides = document.getElementsByClassName("article");
            let dots = document.getElementsByClassName("dot");
            if (n > slides.length) {slideIndex = 1}
            if (n < 1) {slideIndex = slides.length}
            for (i = 0; i < slides.length; i++) {
               slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
               dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex-1].style.display = "block";
            dots[slideIndex-1].className += " active";
         }
      </script>
      <?php
   } 
}
?>

<script>
   document.addEventListener("DOMContentLoaded", function() {
      const editDialog = document.getElementById("editArticleDialog");
      const openEditBtn = document.getElementById("edit");
      const closeEditBtn = editDialog.querySelector(".close-button");

      openEditBtn.addEventListener("click", () => {
         editDialog.showModal();
      });

      closeEditBtn.addEventListener("click", () => {
         editDialog.close();
      });
   });
</script>