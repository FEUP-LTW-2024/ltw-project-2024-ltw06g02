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
         <?php 
            if(sizeof($articles) == 0) echo "Não tens produtos recomendados! Volta mais tarde"
         ?>
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
                     $article = getArticleById($db, $favorite['productID']);
                     getSingleArticle($article['productID'], $article['name'], $article['price'], $article['images'], $article['avatar'], $article['likes']);
                  }
               ?>
            </section>
         </div>

<?php
   }
   function printArticleById($db, $article, $userId, $id){
      $images = explode(",", $article['images']);
?>

   <div class="container">
      <img src="<?=$images[0]?>" alt="product">
      <aside class="product-column">
         <h1 class="price"><?=$article['price']?> €</h1>
         <hr class="separator">
         <h2 class="name"><?=$article['name']?></h2>
         <h2 class="description">Description: <?=$article['description']?></h2>
         <?php 
         $category = getCategoryByID($db, $article['categoryID']); 
         ?>
         <h2 class="category">Category: <?=$category['name']?></h2> 
         <?php if($article['brand'] != null): ?>
            <h2 class="brand">Brand: <?=$article['brand']?></j2>
         <?php endif; ?>
         <?php if($article['model'] != null): ?>
            <h2 class="model">Model: <?=$article['model']?></h2>
         <?php endif; ?>
         <?php if($article['sizeID'] != null): 
            $size = getSizeByID($db, $article['sizeID']); ?>
            <h2 class="size">Size: <?=$size['name']?></h2>
         <?php endif; ?>
         <?php if($article['conditionID'] != null): 
            $condition = getConditionByID($db, $article['conditionID']); ?>
            <h2 class="condition">Condition: <?=$condition['name']?></h2>
         <?php endif; ?>
         <hr class="separator">

         <form id="addToCartForm" action="../actions/add_to_cart.php" method="POST">
            <input type="hidden" name="userId" value="<?=$userId?>">
            <input type="hidden" name="articleId" value="<?=$id?>">
            <button type="submit" id="buyBtn" class="<?php if (!$userId) echo "disabled"?>">Comprar agora</button>
         </form>
         <button type="submit" id="proposalBtn" class="<?php if (!$userId) echo "disabled"?>">Propor outro preço</button>
         <a href=<?= "../actions/initialize_chat.php?q=" . $id ?> ><button type="submit" id="sendBtn" class="<?php if (!$userId) echo "disabled"?>">Enviar mensagem</button></a>

         <?php
            $favoriteArticles = getFavoriteArticlesByUserId($db, $userId);
            $exists = false;

            foreach($favoriteArticles as $favorite){
               if($favorite['productID'] == $id){
                  $exists = true;
               }
            }

            if($exists === false){
               ?>
               <form id="addToFavoritesForm" action="../actions/favorite.php" method="POST">
                  <input type="hidden" name="userId" value="<?=$userId?>">
                  <input type="hidden" name="articleId" value="<?=$id?>">
                  <button type="submit" id="addBtn" class="<?php if (!$userId) echo "disabled"?>">Adicionar aos favoritos</button>
               </form>
               <?php
            }
            else{
               ?>
               <form id="removeToFavoritesForm" action="../actions/remove_favorite.php" method="POST">
                  <input type="hidden" name="userId" value="<?=$userId?>">
                  <input type="hidden" name="articleId" value="<?=$id?>">
                  <button type="submit" id="removeBtn" class="<?php if (!$userId) echo "disabled"?>">Remover aos favoritos</button>
               </form>
               <?php
            }
         ?>
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
                  $article = getArticleById($db, $cart['productID']);
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
            <input type="hidden" name="userId" value="<?=$userID?>">
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
