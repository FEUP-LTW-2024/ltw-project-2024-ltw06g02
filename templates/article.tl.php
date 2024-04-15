<?php
   function getSingleArticle($name, $price, $image, $avatar){
      $images = explode(",", $image);
?>

   <article class="article">
      <a href="#"><img src=<?= $images[0] ?> alt="" class="product-img"></a>
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
      <section class="article-grid">
         <?php foreach($articles as $article){
            getSingleArticle($article['name'], $article['price'], $article['images'], $article['avatar']);
         } 
         ?>
      </section>
   </div>
<?php
   }
?>

