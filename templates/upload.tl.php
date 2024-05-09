<?php
   function printUploadSection(){
?>

   <div class="outer-rectangle">
      <h2>Adiciona fotografias</h2>
      <div class="inner-rectangle">
         <form action="actions/upload.php" method="post" enctype="multipart/form-data">
            <input type="file" name="files[]" required multiple>
      </div>
   </div>

<?php
   }

   function printInfoSection($categories, $sizes, $conditions){
?>

   <div class="outer-rectangle-info">
      <h2>Descreve o produto</h2>
         <div class="input-grp">
            <label>Title</label>
            <input type="text" name="name" required>
         </div>
         <div class="input-grp">
            <label>Description</label>
            <textarea name="description"></textarea>
         </div>
         <div class="input-grp">
            <label>Categories</label>
            <select required name="category">
               <?php 
                  foreach($categories as $c){
                     echo("<option>" . $c['name']);
                  }
               ?>
            </select>
         </div>
         <div class="input-grp">
            <label>Size</label>
            <select name="size">
               <option value="">None</option>
               <?php 
                  foreach($sizes as $s){
                     echo("<option>" . $s['name']);
                  }
               ?>
            </select>
         </div>
         <div class="input-grp">
            <label>Condition</label>
            <select name="condition">
               <option value="">None</option>
               <?php 
                  foreach($conditions as $condition){
                     echo("<option>" . $condition['name']);
                  }
               ?>
            </select>
         </div>
         <div class="input-grp">
            <label>Brand</label>
            <input type="text" name="brand">
         </div>
         <div class="input-grp">
            <label>Model</label>
            <input type="text" name="model">
         </div>
         <div class="input-grp">
            <label>Price</label>
            <input type="number" name="price" required>
         </div>
   </div>

      <button type="submit" class="nav-button sell-button">sell</button>
      </form>

<?php
   }
?>
