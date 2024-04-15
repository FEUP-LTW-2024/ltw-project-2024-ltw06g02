<?php
   function printUploadSection(){
?>

   <div class="outer-rectangle">
      <h2>Adiciona fotografias</h2>
      <div class="inner-rectangle">
         <form action="upload.php" method="post" enctype="multipart/form-data">
            <input type="file" multiple>
      </div>
   </div>

<?php
   }

   function printInfoSection($filters){
?>

   <div class="outer-rectangle-info">
      <h2>Descreve o produto</h2>
         <div class="input-grp">
            <label>Title</label>
            <input type="text">
         </div>
         <div class="input-grp">
            <label>Description</label>
            <textarea></textarea>
         </div>
         <div class="input-grp">
            <label>Categories</label>
            <select>
               <?php 
                  foreach($filters as $filter){
                     echo("<option>" . $filter['name']);
                  }
               ?>
            </select>
         </div>
         <div class="input-grp">
            <label>Price</label>
            <input type="number">
         </div>
   </div>

      <button type="submit" class="nav-button sell-button">sell</button>
      </form>

<?php
   }
?>
