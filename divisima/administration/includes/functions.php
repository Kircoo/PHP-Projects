<?php

//HANDY FUNCTIONS

//ESCAPE STRING
function escape($variable) {

	global $db;

	return mysqli_real_escape_string($db, $variable);
}

//REDIRECT
function redirect($location) {

	global $db;

	header('location:' . $location);

}


//CHECK SEND QUERY
function confirmQuery($result) {

	global $db;

	if (!$result) {
		die('QUERY FAILED' . mysqli_error($db));
	}
}

//COUNT ROWS
function countRows($table, $row, $variable) {

	global $db;
	global $count;

	$query = "SELECT * FROM $table WHERE $row = '$variable'";

	$result = mysqli_query($db, $query);

	confirmQuery($result);

	$count = mysqli_num_rows($result);
}

//IF SOMETHING EXISTS
function exist($row, $table, $variable) {

	global $db;

	$query = "SELECT $row FROM $table WHERE $row = '$variable'";

	  $result = mysqli_query($db, $query);

	  confirmQuery($result);

	  if(mysqli_num_rows($result) > 0) {

	  return true;

	  } else {

	  return false;

	  }
}

//SHOW TABLE ROWS
function selectRows($table, $id) {

	global $db;

	global $result;

	$query = "SELECT * FROM $table ORDER BY $id";

	$result = mysqli_query($db, $query);

	confirmQuery($result);

}

//SHOW TABLE ROWS WITH LIMIT
function selectRowsLimit($table, $id) {

	global $db;

	global $result;

	$query = "SELECT * FROM $table ORDER BY $id LIMIT 8";

	$result = mysqli_query($db, $query);

	confirmQuery($result);

}

//SHOW TABLE ROWS WHERE
function selectRowsWhere($table, $row, $variable) {

	global $db;

	global $result;

	$query = "SELECT * FROM $table WHERE $row = '$variable'";

	$result = mysqli_query($db, $query);

	confirmQuery($result);

}

//SHOW TABLE ROWS WHERE LIMIT
function selectRowsWhereLimit($table, $row, $variable) {

	global $db;

	global $result;

	$query = "SELECT * FROM $table WHERE $row = '$variable' LIMIT 8";

	$result = mysqli_query($db, $query);

	confirmQuery($result);

}

//DELETE
function delete($table, $row, $variable, $location) {

	global $db;

	$query = "DELETE FROM $table WHERE $row = $variable";

	$result = mysqli_query($db, $query);

	confirmQuery($result);

	redirect($location);
}

// **INDEX PAGE **//


//SHOW SUB CATEGORY MENU
function showSubcategory() {

	global $db;

	global $cat_id;

	global $select_sub_query;

	$query = "SELECT * FROM sub_category WHERE cat_name_id = $cat_id";

	$select_sub_query = mysqli_query($db, $query);

	confirmQuery($select_sub_query);


}

function showSubcategoryMenu() {

	global $select_sub_query;

	showSubcategory();

	while ($rows = mysqli_fetch_array($select_sub_query)) {
										
		$sub_id = $rows['sub_id'];

		$sub_name = $rows['sub_name'];

		$cat_name_id = $rows['cat_name_id'];

		echo "<li><a href='category.php?subcategory=$sub_id'>$sub_name</a>";

	}


}

//** CATEGORY **//

//select category
function selectCategory() {

	global $result;

	global $the_category_id;

	global $cat_name;

	global $cat_id;

	selectRowsWhere('category', 'cat_id', $the_category_id);

	while ($row = mysqli_fetch_array($result)) {
	
	$cat_id = $row['cat_id'];

	$cat_name = $row['cat_name'];
}

}

//add category
function addCategory() {

	global $db;

	$category = escape($_POST['category']);

	$query = "INSERT INTO category(cat_name) VALUES('{$category}')";

	$result = mysqli_query($db, $query);

	confirmQuery($result);

	redirect('category.php');


}

//edit category
function editCategory() {

	global $db;

	global $the_category_id;

	global $edit;

	$edit_category = escape($_POST['edit_category']);

	$query = "UPDATE category SET cat_name = '{$edit_category}' WHERE cat_id = '{$the_category_id}'";

	$result = mysqli_query($db, $query);

	confirmQuery($result);

	redirect("category.php");


}

//delete category
function deleteCategory() {

	global $db;

    if (isset($_GET['delete'])) {
  
    $the_delete_category_id = $_GET['delete'];

    delete('category', 'cat_id', $the_delete_category_id, 'category.php');

	}


}


//** SUB-CATEGORY **//

//select sub-category
function selectSubcategoryEdit() {

	global $result;

	global $the_sub_category_id;

	global $sub_name;

	global $sub_id;

	global $cat_name_id;

	selectRowsWhere('sub_category', 'sub_id', $the_sub_category_id);

	while ($row = mysqli_fetch_array($result)) {
	
	$sub_id = $row['sub_id'];

	$sub_name = $row['sub_name'];

	$cat_name_id = $row['cat_name_id'];
}

}


//select category option
function selectCategorySub() {

	global $result;

	global $the_category_id;

	global $cat_name;

	global $cat_id;

	selectRows('category', 'cat_id');

	while ($row = mysqli_fetch_array($result)) {
	
	$cat_id = $row['cat_id'];

	$cat_name = $row['cat_name'];

	echo "<option value='$cat_id'>$cat_name</option>";
}

}

//select category exist option
function existCategoryOption() {

	global $result;

	global $cat_name_id;

	selectRows('category', 'cat_id');

    while ($row = mysqli_fetch_array($result)) {
    	
		$cat_id = $row['cat_id'];

		$cat_name = $row['cat_name'];

		if ($cat_id == $cat_name_id) {
			
			echo "<option selected value='{$cat_id}'>{$cat_name}</option>";

		} else {

			echo "<option value='{$cat_id}'>{$cat_name}</option>";

		}
    }

}


//select sub-category = category
function selectSubcategory() {

	global $db;

	global $result;

	$query = "SELECT * FROM sub_category ";
	$query .= "LEFT JOIN category ON sub_category.cat_name_id = category.cat_id";

	$result = mysqli_query($db, $query);

	confirmQuery($result);



}

//add sub-category
function addSubCategory() {

	global $db;

	$subcategory = escape($_POST['subcategory']);

	$category = escape($_POST['category']);

	$query = "INSERT INTO sub_category(sub_name, cat_name_id) VALUES('{$subcategory}', '{$category}')";

	$result = mysqli_query($db, $query);

	confirmQuery($result);

	redirect('subcategory.php');


}

//edit sub-category
function editSubcategory() {

	global $db;

	global $the_sub_category_id;

	global $edit;

	$edit_sub_name = escape($_POST['edit_sub_name']);

	$edit_category = escape($_POST['edit_category']);

	$query = "UPDATE sub_category SET sub_name = '{$edit_sub_name}', cat_name_id = '{$edit_category}' WHERE sub_id = '{$the_sub_category_id}'";

	$result = mysqli_query($db, $query);

	confirmQuery($result);

	redirect("subcategory.php");


}

//delete sub-category
function deleteSubcategory() {

	global $db;

    if (isset($_GET['delete'])) {
  
    $the_delete_sub_category_id = $_GET['delete'];

    delete('sub_category', 'sub_id', $the_delete_sub_category_id, 'subcategory.php');

	}


}

//** PRODUCTS **//

//select products
function selectProducts() {

	global $db;

	global $result;

	$query = "SELECT * FROM products ";
	$query .= "LEFT JOIN sub_category ON products.p_sub_id = sub_category.sub_id";

	$result = mysqli_query($db, $query);

	confirmQuery($result);
}

//select product sub-category
function selectProductSub() {

	global $result;

	global $sub_name;

	global $sub_id;

	selectRows('sub_category', 'sub_id');

	while ($row = mysqli_fetch_array($result)) {
	
	$sub_id = $row['sub_id'];

	$sub_name = $row['sub_name'];

	echo "<option value='$sub_id'>$sub_name</option>";
}

}

//select product exist option
function existProductOption() {

	global $result;

	global $p_sub_id;

	selectRows('sub_category', 'sub_id');

    while ($row = mysqli_fetch_array($result)) {
    	
		$sub_id = $row['sub_id'];

		$sub_name = $row['sub_name'];

		if ($sub_id == $p_sub_id) {
			
			echo "<option selected value='{$sub_id}'>{$sub_name}</option>";

		} else {

			echo "<option value='{$sub_id}'>{$sub_name}</option>";

		}
    }

}

//select product stock option
function selectStock() {

	global $db;

	global $p_stock;

	if ($p_stock == 'In stock') {
		
		echo "<option value='Out of stock'>Out of stock</option>";

	} else {

		echo "<option value='In stock'>In stock</option>";

	}
}

//add product
function addProduct() {

	global $db;
	global $img1;
	global $img1_temp;
	global $img2;
	global $img2_temp;
	global $img3;
	global $img3_temp;
	global $img4;
	global $img4_temp;


	$name = $_POST['name'];
	$sub_category = $_POST['sub_category'];
	$price = $_POST['price'];
	$stock = $_POST['stock'];
	$info = escape($_POST['info']);

	$img1 = $_FILES['img1']['name'];
    $img1_image_temp = $_FILES['img1']['tmp_name'];
    move_uploaded_file($img1_image_temp, "./img/Products/$img1");

    $img2 = $_FILES['img2']['name'];
    $img2_image_temp = $_FILES['img2']['tmp_name'];
    move_uploaded_file($img2_image_temp, "./img/Products/$img2");

    $img3 = $_FILES['img3']['name'];
    $img3_image_temp = $_FILES['img3']['tmp_name'];
    move_uploaded_file($img3_image_temp, "./img/Products/$img3");

    $img4 = $_FILES['img4']['name'];
    $img4_image_temp = $_FILES['img4']['tmp_name'];
    move_uploaded_file($img4_image_temp, "./img/Products/$img4");


	$query = "INSERT INTO products(p_name, p_sub_id, p_price, p_stock, p_info, p_img1, p_img2, p_img3, p_img4) ";
	$query .= "VALUES('{$name}', '{$sub_category}', '{$price}', '{$stock}', '{$info}', '{$img1}', '{$img2}', '{$img3}', '{$img4}')";

	$result = mysqli_query($db, $query);

	confirmQuery($result);

	echo '<script>alert("Product added!")</script>';
	echo '<script>windows.location="administration/product.php?source=add_product"</script>';

}

//select edit product
function selectEditProduct() {

	global $db;
	global $the_product_id;
	global $result;
	global $p_name;
	global $p_sub_id;
	global $p_price;
	global $p_stock;
	global $p_info;
	global $p_img1;
	global $p_img2;
	global $p_img3;
	global $p_img4;

	selectRowsWhere('products', 'p_id', $the_product_id);

	while ($row = mysqli_fetch_array($result)) {
		
		$p_id = $row['p_id'];
		$p_name = $row['p_name'];
		$p_sub_id = $row['p_sub_id'];
		$p_price = $row['p_price'];
		$p_stock = $row['p_stock'];
		$p_info = $row['p_info'];
		$p_img1 = $row['p_img1'];
		$p_img2 = $row['p_img2'];
		$p_img3 = $row['p_img3'];
		$p_img4 = $row['p_img4'];
	}

}

//edit product
function editProduct() {

	global $db;
	global $the_product_id;

	$edit_name = $_POST['edit_name'];
	$edit_sub_category = $_POST['edit_sub_category'];
	$edit_price = $_POST['edit_price'];
	$edit_stock = $_POST['edit_stock'];
	$edit_info = escape($_POST['edit_info']);

	$edit_img1 = $_FILES['edit_img1']['name'];
    $img1_edit_temp = $_FILES['edit_img1']['tmp_name'];
    move_uploaded_file($img1_edit_temp, "./img/Products/$edit_img1");

    $edit_img2 = $_FILES['edit_img2']['name'];
    $img2_edit_temp = $_FILES['edit_img2']['tmp_name'];
    move_uploaded_file($img2_edit_temp, "./img/Products/$edit_img2");

    $edit_img3 = $_FILES['edit_img3']['name'];
    $img3_edit_temp = $_FILES['edit_img3']['tmp_name'];
    move_uploaded_file($img3_edit_temp, "./img/Products/$edit_img3");

    $edit_img4 = $_FILES['edit_img4']['name'];
    $img4_edit_temp = $_FILES['edit_img4']['tmp_name'];
    move_uploaded_file($img4_edit_temp, "./img/Products/$edit_img4");

    if (empty($edit_img1)) {

	$query = "SELECT * FROM products WHERE p_id = $the_product_id";

	$result = mysqli_query($db, $query);

	while ($row = mysqli_fetch_array($result)) {

	$edit_img1 = $row['p_img1'];

	}

	}

	if (empty($edit_img2)) {

	$query = "SELECT * FROM products WHERE p_id = $the_product_id";

	$result = mysqli_query($db, $query);

	while ($row = mysqli_fetch_array($result)) {

	$edit_img2 = $row['p_img2'];

	}

	}

	if (empty($edit_img3)) {

	$query = "SELECT * FROM products WHERE p_id = $the_product_id";

	$result = mysqli_query($db, $query);

	while ($row = mysqli_fetch_array($result)) {

	$edit_img3 = $row['p_img3'];

	}

	}

	if (empty($edit_img4)) {

	$query = "SELECT * FROM products WHERE p_id = $the_product_id";

	$result = mysqli_query($db, $query);

	while ($row = mysqli_fetch_array($result)) {

	$edit_img4 = $row['p_img4'];

	}

	}

	$query = "UPDATE products SET ";
	$query .= "p_sub_id = '{$edit_sub_category}', ";
	$query .= "p_name = '{$edit_name}', ";
	$query .= "p_price = '{$edit_price}', ";
	$query .= "p_stock = '{$edit_stock}', ";
	$query .= "p_info = '{$edit_info}', ";
	$query .= "p_img1 = '{$edit_img1}', ";
	$query .= "p_img2 = '{$edit_img2}', ";
	$query .= "p_img3 = '{$edit_img3}', ";
	$query .= "p_img4 = '{$edit_img4}' ";
	$query .= "WHERE p_id = '{$the_product_id}'";

	$result = mysqli_query($db, $query);

	confirmQuery($result);

}

//delete product
function deleteProduct() {

	global $db;

    if (isset($_GET['delete'])) {
  
    $the_delete_product_id = $_GET['delete'];

    delete('products', 'p_id', $the_delete_product_id, 'product.php');

	}


}

//select products in subcategory
function selectSubProduct() {

	global $db;
	global $result;
	global $the_sub_id;

	selectRowsWhereLimit('products', 'p_sub_id', $the_sub_id);

	while ($row = mysqli_fetch_array($result)) {
		
		$p_id = $row['p_id'];
		$p_name = $row['p_name'];
		$p_sub_id = $row['p_sub_id'];
		$p_price = $row['p_price'];
		$p_stock = $row['p_stock'];
		$p_info = $row['p_info'];
		$p_img1 = $row['p_img1'];
		$p_img2 = $row['p_img2'];
		$p_img3 = $row['p_img3'];
		$p_img4 = $row['p_img4'];

		echo "<div class='col-lg-4 col-sm-6'>
			  <form action='' method='post' target='votar'>
						<div class='product-item'>
							<div class='pi-pic'>
								<a href='product.php?product=$p_id'><img src='administration/img/products/$p_img1' alt=''></a>
								<div class='pi-links'>
									<input style='background-color: #F51167; color: white;'' onclick='latest();' class='add-card btn float-left ml-2' type='submit' name='cart' value='Add to cart'>
							<input checked hidden='' type='checkbox' name='subProduct[]' value='$p_id;'>
									<input style='background-color: #F51167; color: white;' onclick='latest2();' class='add-card btn float-left ml-2 mt-2' type='submit' name='wishlist' value='Add to wishlist'>
								</div>
							</div>
							<div class='pi-text'>
								<h6>$$p_price.00</h6>
								<a href='product.php?product=$p_id'><p>$p_name</p></a>
							</div>
						</div>
				</form>
				</div>";

	}
}

// single product
function selectSingleProduct() {

	global $db;
	global $the_product_id;
	global $result;
	global $p_name;
	global $p_price;
	global $p_stock;
	global $p_info;
	global $p_img1;
	global $p_img2;
	global $p_img3;
	global $p_img4;

	selectRowsWhere('products', 'p_id', $the_product_id);

	$row = mysqli_fetch_array($result);

		$p_id = $row['p_id'];
		$p_name = $row['p_name'];
		$p_sub_id = $row['p_sub_id'];
		$p_price = $row['p_price'];
		$p_stock = $row['p_stock'];
		$p_info = $row['p_info'];
		$p_img1 = $row['p_img1'];
		$p_img2 = $row['p_img2'];
		$p_img3 = $row['p_img3'];
		$p_img4 = $row['p_img4'];
}

//** CART **//

// add to cart
function addCart() {

	global $db;

	global $p_name;
	global $p_price;
	global $p_img1;

	$query = "INSERT INTO cart(c_name, c_price, c_img) VALUES('{$p_name}', '{$p_price}', '{$p_img1}')";

	$result = mysqli_query($db, $query);

	confirmQuery($result);
}

//delete from cart
function deleteCart() {

	global $db;

	if (isset($_GET['delete'])) {
  
    $the_delete_cart_id = $_GET['delete'];

    delete('cart', 'c_id', $the_delete_cart_id, 'cart.php');

	}
}

//delete from wishlist
function deleteWish() {

	global $db;

	if (isset($_GET['delete'])) {
  
    $the_delete_wish_id = $_GET['delete'];

    delete('wishlist', 'w_id', $the_delete_wish_id, 'wishlist.php');

	}
}

//** USERS **//

//register user
function registerUser() {

	global $db;
	global $password;
	global $username;
	global $firstname;
	global $lastname;
	global $email;
	global $register;

	$password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

    $query = "INSERT INTO ";
    $query .= "user(username, user_password, user_email, user_firstname, user_lastname, user_role, date) ";
    $query .= "VALUES('{$username}', '{$password}', '{$email}', '{$firstname}', '{$lastname}', 'Costumer', now())";

    $result = mysqli_query($db, $query);

    confirmQuery($result);

    $register = "<p class='alert-success'>You have been registered</p>";
}

//login user
function loginUser($username, $password) {

	global $db;
	global $result;
	global $log_in;

	$username = escape($username);
	$password = escape($password);

	selectRows('user', 'user_id');

	while ($row = mysqli_fetch_array($result)) {
		
		$db_user_id = $row['user_id'];

		$db_username = $row['username'];

		$db_user_password = $row['user_password'];

		$db_user_firstname = $row['user_firstname'];

		$db_user_lastname = $row['user_lastname'];

		$db_user_email = $row['user_email'];

		$db_user_role = $row['user_role'];

		if (password_verify($password, $db_user_password)) {
			
			$_SESSION['username'] = $db_username;

		    $_SESSION['user_email'] = $db_user_email;

		    $_SESSION['user_role'] = $db_user_role;

		    $_SESSION['user_id'] = $db_user_id;

		    redirect('index.php');

		} else {

			$log_in = "<p class='alert-danger mt-3'>Wrong username or password. Try again</p>";
		}

	}

	$log_in = "<p class='alert-danger mt-3'>Wrong username or password. Try again</p>";
}













?>