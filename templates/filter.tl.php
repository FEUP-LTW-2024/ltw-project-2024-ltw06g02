<?php
   function printFilterButton($filter){
?>

   <button class="filter-btn"><?= $filter['name'] ?></button>

<?php
   }
?>

<?php
   function printFiltersSection($filters){
?>

   <div class="product-section">
      <h3 class="products-title">Procura por filtros</h3>
      <section>
         <?php
            foreach($filters as $filter){
               printFilterButton($filter);
            }
         ?>
      </section>
   </div>

<?php
   }
?>