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


	<!-- cart section end -->
	<section class="cart-section spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
					<div class="cart-table">
						<h3>Your Cart</h3>
						<div class="cart-table-warp">
							<table>
							<thead>
								<tr>
									<th class="product-th">Product</th>
									<th class="quy-th">Quantity</th>
									<th class="size-th">SizeSize</th>
									<th class="total-th">Price</th>
									<th>Delete</th>
								</tr>
							</thead>
							<tbody>

								<?php

								$total = 0;

								if($_SESSION['user_role']) {

								$user_id = $_SESSION['user_id'];

								selectRowsWhere('cart', 'user_id', $user_id);

								while ($row = mysqli_fetch_array($result)) {
									
									$c_id = $row['c_id'];
									$c_name = $row['c_name'];
									$c_price = $row['c_price'];
									$c_img = $row['c_img'];

									$total += $c_price;


									?>
							

								<tr>
									<td class="product-col">
										<img src="administration/img/products/<?php echo $c_img; ?>" alt="">
										<div class="pc-title">
											<h4><?php echo $c_name; ?></h4>
											<p>$<?php echo $c_price; ?>,00</p>
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
									<td class="total-col"><h4>$<?php echo $c_price; ?>,00</h4></td>
									<td><a class="btn btn-danger" href="cart.php?delete=<?php echo $c_id; ?>">Delete</a></td>
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

	deleteCart();

	?>
	<!-- cart section end -->

	<!-- Latest product section -->
	<?php include "includes/latest_products.php" ?>
	<!-- Latest product section end -->



<!-- Footer section -->
<?php include "includes/footer.php" ?>
<!-- Footer section end -->