<?php
   function getSingleArticle($productID, $name, $price, $image, $avatar, $likes){
      $images = explode(",", $image);
?>
   <article class="article">
      <a href="product.php?id=<?=$productID?>"><img src=<?= $images[0] ?> alt="" class="product-img"></a>
      <div class="article-details">
         <div>
            <h3><?= $name ?></h3>
            <p><?= $price ?>€</p>
         </div>
         <div class="like-container">
            <i class="material-icons heart-icon">favorite</i>
            <p class="number"><?= $likes ?></p>
         </div>
         <img src=<?= $avatar ?>>
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
            <p><?= $price ?>€</p>
         </div>
      </div>
   </article>

<?php
   }
?>

<?php
   function printArticleSection($articles){
?>
   <div class="product-section">
      <h3 class="products-title">Produtos recomendados</h3>
      <section class="article-grid" id="grid">
         <?php foreach($articles as $article){
            getSingleArticle($article['productID'],$article['name'], $article['price'], $article['images'], $article['avatar'], $article['likes']);
         } 
         ?>
      </section>
   </div>
<?php
   }
?>

<?php
   function printFavoriteArticleSection($db, $favoriteArticles){

      if (empty($favoriteArticles)) {
         ?>
         <div class="product-section-favorite">
            <h3 class="products-title-favorite">Artigos marcados como favoritos</h3>
            <section class="article-grid-favorite">
               <div class="emptyBox">
                  <h3 class="emptyTitle">Guarda os teus favoritos</h3>
                  <h4 class="emptyParagrah">Marca alguns artigos como favoritos e encontra-os aqui</h4>
                  <a href="../index.php" class="find">Procurar</a>
               </div>
            </section>
         </div>
         <?php
      } else {
         ?>
         <div class="product-section">
            <h3 class="products-title">Artigos marcados como favoritos</h3>
            <section class="article-grid">
               <?php
                  foreach($favoriteArticles as $favorite){
                     $article = getArticleById($favorite['productID']);
                     getSingleArticle($article['productID'], $article['name'], $article['price'], $article['images'], $article['avatar'], $article['likes']);
                  }
               ?>
            </section>
         </div>
         <?php
      }
   }
?>

<?php

   function printArticleById($db, $article, $userID){
      buildEditArticle($article['productID']);

      $images = explode(",", $article['images']);
      $category = getCategoryByID($db, $article['categoryID']);
      $size = getSizeByID($db, $article['sizeID']);
      $condition = getConditionByID($db, $article['conditionID']);
?>

   <div class="container">
      <img src="<?=$images[0]?>" alt="product">
      <aside class="product-column">
         <h1 class="price"><?=$article['price']?> €</h1>
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
         <h3 class="products-title-cart">Shopping Cart</h3>
         <section class="article-grid-cart">
            <div class="emptyBox">
               <h3 class="emptyTitle">Add to cart</h3>
               <h4 class="emptyParagrah">Add items you want to buy and find them here</h4>
               <a href="../index.php" class="find">Search</a>
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