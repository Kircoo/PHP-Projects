<?php

if (isset($_POST['add_product'])) {
  
  addProduct();
}

?>

<div class="row">
  
  <div class="col-md-4"></div>

  <div class="col-md-4">

    <h3 class="text-dark">Add product</h3>
    
    <form action="" method="post" enctype="multipart/form-data">
      
      <div class="form-group">
        
        <label>Product name</label>

        <input class="form-control" type="text" name="name" required="">

      </div>

      <div class="form-group">
        
        <label>Sub-category</label>

        <select class="form-control" name="sub_category">
          
          <?php selectProductSub(); ?>

        </select>

      </div>

      <div class="form-group">
        
        <label>Product price</label>

        <input class="form-control" type="number" name="price" required="">

      </div>

      <div class="form-group">
        
        <label>Product stock</label>

        <select class="form-control" name="stock">
          
          <option value="In stock">In stock</option>

          <option value="Out of stock">Out of stock</option>

        </select>

      </div>

      <div class="form-group">
        
        <label>Product info</label>

        <textarea class="form-control" rows="5" name="info" required=""></textarea>

      </div>

      <div class="form-group">
        
        <h3>Product Images</h3>

        <label>Image 1</label><br>

        <input type="file" name="img1"><br>

        <label>Image 2</label><br>

        <input type="file" name="img2"><br>

        <label>Image 3</label><br>

        <input type="file" name="img3"><br>

        <label>Image 4</label><br>

        <input type="file" name="img4"><br>

      </div>

      <div class="form-group">

        <input class="btn btn-primary btn-sm" type="submit" name="add_product" value="Add">

      </div>

    </form>

  </div>

  <div class="col-md-4"></div>

</div>