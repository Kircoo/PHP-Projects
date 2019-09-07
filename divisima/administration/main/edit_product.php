<?php

if (isset($_GET['p_id'])) {
  
  $the_product_id = $_GET['p_id'];


}

selectEditProduct();

if (isset($_POST['edit_product'])) {
  
  editProduct();

}

?>

<div class="row">
  
  <div class="col-md-4"></div>

  <div class="col-md-4">

    <h3 class="text-dark">Edit product</h3>
    
    <form action="" method="post" enctype="multipart/form-data">
      
      <div class="form-group">
        
        <label>Product name</label>

        <input class="form-control" type="text" name="edit_name" required="" value="<?php echo $p_name; ?>">

      </div>

      <div class="form-group">
        
        <label>Sub-category</label>

        <select class="form-control" name="edit_sub_category">
          
          <?php existProductOption(); ?>

        </select>

      </div>

      <div class="form-group">
        
        <label>Product price</label>

        <input class="form-control" type="number" name="edit_price" required="" value="<?php echo $p_price; ?>">

      </div>

      <div class="form-group">
        
        <label>Product stock</label>

        <select class="form-control" name="edit_stock">

          <option selected=""><?php echo $p_stock; ?></option>
          
          <?php selectStock(); ?>

        </select>

      </div>

      <div class="form-group">
        
        <label>Product info</label>

        <textarea class="form-control" rows="5" name="edit_info" required=""><?php echo $p_info; ?></textarea>

      </div>

      <div class="form-group">
        
        <h3>Product Images</h3>

        <label>Image 1</label><br>

        <img height="300px" width="300px" src="./img/Products/<?php echo $p_img1 ?>"><br>

        <input type="file" name="edit_img1"><br><br>

        <label>Image 2</label><br>

        <img height="300px" width="300px" src="./img/Products/<?php echo $p_img2 ?>"><br>

        <input type="file" name="edit_img2"><br><br>

        <label>Image 3</label><br>

        <img height="300px" width="300px" src="./img/Products/<?php echo $p_img3 ?>"><br>

        <input type="file" name="edit_img3"><br><br>

        <label>Image 4</label><br>

        <img height="300px" width="300px" src="./img/Products/<?php echo $p_img4 ?>"><br>

        <input type="file" name="edit_img4">

      </div>

      <div class="form-group">

        <input class="btn btn-primary btn-sm" type="submit" name="edit_product" value="Edit">

      </div>

    </form>

  </div>

  <div class="col-md-4"></div>

</div>