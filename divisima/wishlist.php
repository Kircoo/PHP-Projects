<?php session_start(); ?>
<!-- HEADER -->
<?php include "includes/header.php" ?>
<!-- END HEADER -->

<!-- Navbar section -->
<?php include "includes/navbar.php" ?>
<!-- Navbar section end -->


	<!-- Page info -->
	<?php include "includes/page_info.php" ?>
	<!-- Page info end -->

	<iframe name="votar" style="display:none;"></iframe>

	<?php


	$user_id = $_SESSION['user_id'];

	if (isset($_POST['products'])) {

		if (isset($_SESSION['user_role'])) {

			foreach ($_POST['products'] as $productValues) {

				$query = "SELECT * FROM wishlist WHERE w_id = '{$productValues}' ";

				$first_results_wish = mysqli_query($db, $query);

				confirmQuery($first_results_wish);

				while ($row = mysqli_fetch_array($first_results_wish)) {
					
					$w_name = $row['w_name'];
					$w_price = $row['w_price'];
					$w_img = $row['w_img'];
				}

				$query = "INSERT INTO cart(c_name, c_price, c_img, user_id) VALUES('{$w_name}', '{$w_price}', '{$w_img}', '{$user_id}')";

				$result = mysqli_query($db, $query);

				confirmQuery($result);

			}

		}

	}


	?>


	<!-- cart section end -->
	<section class="cart-section spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
					<div class="cart-table">
						<h3>Your Wishlist</h3>
						<div class="cart-table-warp">
							<table>
							<thead>
								<tr>
									<th class="product-th">Product</th>
									<th class="quy-th">Quantity</th>
									<th class="size-th">SizeSize</th>
									<th class="total-th">Price</th>
									<th></th>
									<th>Delete</th>
								</tr>
							</thead>
							<tbody>

								<?php

								$total = 0;

								if($_SESSION['user_role']) {

								$user_id = $_SESSION['user_id'];

								selectRowsWhere('wishlist', 'user_id', $user_id);

								while ($row = mysqli_fetch_array($result)) {
									
									$w_id = $row['w_id'];
									$w_name = $row['w_name'];
									$w_price = $row['w_price'];
									$w_img = $row['w_img'];

									$total += $w_price;


									?>
							

								<tr>
									<td class="product-col">
										<img src="administration/img/products/<?php echo $w_img; ?>" alt="">
										<div class="pc-title">
											<h4><?php echo $w_name; ?></h4>
											<p>$<?php echo $w_price; ?>,00</p>
										</div>
									</td>
									<td class="quy-col">
										<div class="quantity">
					                        <div class="pro-qty">
												<input type="text" value="1">
											</div>
                    					</div>
									</td>
									<td class="size-col"><h4>Size M</h4></td>
									<td class="total-col"><h4>$<?php echo $w_price; ?>,00</h4></td>

									<td class="total-col">
										
										<form action="" method="post" target="votar">
											
											<input class="add-card btn" onclick="latest();" style="background-color: #F51167; color: white;" type="submit" name="cart" value="Add to cart">
											<input checked hidden="" type="checkbox" name="products[]" value="<?php echo $w_id; ?>">

										</form>

									</td>
									<td><a class="btn btn-danger" href="wishlist.php?delete=<?php echo $w_id; ?>">Delete</a></td>
								</tr>

								<?php } } ?>

							</tbody>
						</table>
						</div>
						<div class="total-cost">
							<h6>Total <span>$<?php echo $total;  ?>,00</span></h6>
						</div>
					</div>
				</div>
				<div class="col-lg-4 card-right">
					<a href="checkout.php" class="site-btn">Proceed to checkout</a>
					<a href="index.php" class="site-btn sb-dark">Continue shopping</a>
				</div>
			</div>
		</div>
	</section>
	<?php

	deleteWish();

	?>
	<!-- cart section end -->

	<!-- Latest product section -->
	<?php include "includes/latest_products.php" ?>
	<!-- Latest product section end -->



<!-- Footer section -->
<?php include "includes/footer.php" ?>
<!-- Footer section end -->