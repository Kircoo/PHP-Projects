<?php

if (isset($_GET['edit'])) {
	
	$the_category_id = $_GET['edit'];

}

selectCategory();

if (isset($_POST['edit'])) {
	
	editCategory();

}

?>

<form action="" method="post">

<div class="form-group">
  
  <label>Edit category</label>

  <input type="text" name="edit_category" class="form-control" value="<?php echo $cat_name; ?>" required>

</div>

<div class="form-group">

  <input class="btn btn-primary btn-sm" type="submit" name="edit" value="Edit">

</div>

</form>