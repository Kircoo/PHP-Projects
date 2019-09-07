<?php

if (isset($_GET['edit'])) {
	
	$the_sub_category_id = $_GET['edit'];

}

selectSubcategoryEdit();

if (isset($_POST['edit'])) {
	
	editSubcategory();

}

?>

<form action="" method="post">

<div class="form-group">
  
  <label>Edit sub-category</label>

  <input type="text" name="edit_sub_name" class="form-control" value="<?php echo $sub_name; ?>" required>

</div>

<div class="form-group">
  
  <label>Category</label>

  <select class="form-control" name="edit_category">
    
    <?php existCategoryOption(); ?>

  </select>

</div>

<div class="form-group">

  <input class="btn btn-primary btn-sm" type="submit" name="edit" value="Edit">

</div>

</form>