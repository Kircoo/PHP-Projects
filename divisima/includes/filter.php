<iframe name="votar" style="display:none;"></iframe>
<section class="product-filter-section">
		<div class="container">
			<div class="section-title">
				<h2>BROWSE TOP SELLING PRODUCTS</h2>
			</div>
			<div class="row">

			<?php

			if (isset($_SESSION['user_id'])) {
				
				$user_id = $_SESSION['user_id'];
			}

			if (isset($_POST['product_filter'])) {

				if (isset($_SESSION['user_role'])) {

				if (isset($_POST['cart'])) {
				
					foreach ($_POST['product_filter'] as $productValues) {

					$query = "SELECT * FROM products WHERE p_id = '{$productValues}' ";

					$second_results = mysqli_query($db, $query);

					confirmQuery($second_results);

					while ($row = mysqli_fetch_array($second_results)) {
						
						$p_name = $row['p_name'];
						$p_price = $row['p_price'];
						$p_img1 = $row['p_img1'];
					}

					$query = "INSERT INTO cart(c_name, c_price, c_img, user_id) VALUES('{$p_name}', '{$p_price}', '{$p_img1}', '{$user_id}')";

					$result = mysqli_query($db, $query);

					confirmQuery($result);

							}

					} else {

						foreach ($_POST['product_filter'] as $productValues) {

						$query = "SELECT * FROM products WHERE p_id = '{$productValues}' ";

						$second_results_wish = mysqli_query($db, $query);

						confirmQuery($second_results_wish);

						while ($row = mysqli_fetch_array($second_results_wish)) {
							
							$p_name = $row['p_name'];
							$p_price = $row['p_price'];
							$p_img1 = $row['p_img1'];
						}

						$query = "INSERT INTO wishlist(w_name, w_price, w_img, user_id) VALUES('{$p_name}', '{$p_price}', '{$p_img1}', '{$user_id}')";

						$result = mysqli_query($db, $query);

						confirmQuery($result);

						}
					}

				}
				
			}

			selectRowsLimit('products', 'p_id');

			while ($row = mysqli_fetch_array($result)) {
				
				$p_id = $row['p_id'];
				$p_name = $row['p_name'];
				$p_price = $row['p_price'];
				$p_img1 = $row['p_img1'];

			?>

			<div class="col-lg-3 col-sm-6">

			<form action="" method="post" target="votar">
			<div class="product-item">
				<div class="pi-pic">
					<a href="product.php?product=<?php echo $p_id; ?>"><img src="administration/img/products/<?php echo $p_img1; ?>" alt=""></a>
					<div class="pi-links">
<!-- 						<a href="#" class="add-card"><i class="flaticon-bag"></i><span>ADD TO CART</span></a> -->
				
							
							<input style="background-color: #F51167; color: white;" onclick="filter();" class="add-card btn float-left ml-2" type="submit" name="cart" value="Add to cart">
							<input checked hidden="" type="checkbox" name="product_filter[]" value="<?php echo $p_id; ?>">
							<input style="background-color: #F51167; color: white;" onclick="latest2();" class="add-card btn float-left ml-2 mt-2" type="submit" name="wishlist" value="Add to wishlist">
							
					</div>
				</div>
				<div class="pi-text">
					<h6>$<?php echo $p_price; ?>,00</h6>
					<a href="product.php?product=<?php echo $p_id; ?>"><p><?php echo $p_name; ?> </p></a>
				</div>
			</div>
			</form>

			</div>

			<?php }	?>
				
			</div>
		</div>
	</section>