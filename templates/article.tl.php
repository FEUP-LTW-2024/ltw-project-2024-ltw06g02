<?php
   function getSingleArticle($productID, $name, $price, $image, $avatar){
?>

   <article class="article">
      <a href="product.php?id=<?=$productID?>"><img src=<?= $image ?> alt="" class="product-img"></a>
      <div class="article-details">
         <div>
            <h3><?= $name ?></h3>
            <p><?= $price ?>€</p>
         </div>
         <img src=<?= $avatar ?>>
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
            getSingleArticle($article['productID'],$article['name'], $article['price'], $article['images'], $article['avatar']);
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
                     $article = getArticleById($db, $favorite['productID']);
                     getSingleArticle($article['productID'], $article['name'], $article['price'], $article['images'], $article['avatar']);
                  }
               ?>
            </section>
         </div>
         <?php
      }
   }
?>

<?php
   function printArticleById($db, $article, $userId, $id){
?>
  
   <div class="container">
      <img src="<?=$article['images']?>" alt="product">
      <aside class="product-column">
         <h1 class="price"><?=$article['price']?> €</h1>
         <hr class="separator">
         <h2 class="name"><?=$article['name']?></h2>
         <h2 class="description"><?=$article['description']?></h2>
         <hr class="separator">

         <button type="submit" id="buyBtn">Comprar agora</button>
         <button type="submit" id="proposalBtn">Propor outro preço</button>
         <button type="submit" id="sendBtn">Enviar mensagem</button>

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
                  <button type="submit" id="addBtn">Adicionar aos favoritos</button>
               </form>
               <?php
            }
            else{
               ?>
               <form id="removeToFavoritesForm" action="../actions/removeFavorite.php" method="POST">
                  <input type="hidden" name="userId" value="<?=$userId?>">
                  <input type="hidden" name="articleId" value="<?=$id?>">
                  <button type="submit" id="removeBtn">Remover aos favoritos</button>
               </form>
               <?php
            }
         ?>
      </aside>
   </div>

<?php
   }
?>

