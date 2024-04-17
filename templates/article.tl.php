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
   function printArticleById($article){
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
         <button type="submit" id="addBtn">Adicionar aos favoritos</button>
      </aside>
   </div>
   

<?php
   }
?>

