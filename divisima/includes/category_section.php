<?php

if (isset($_GET['subcategory'])) {
	
	$the_sub_id = $_GET['subcategory'];

}

?>

<iframe name="votar" style="display:none;"></iframe>

<section class="category-section spad">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 order-2 order-lg-1">
				<div class="filter-widget">
					<h2 class="fw-title">Categories</h2>
					<ul class="category-menu">

						<?php

						selectRows('category', 'cat_id');

						while ($row = mysqli_fetch_array($result)) {
						
						$cat_id = $row['cat_id'];

						$cat_name = $row['cat_name'];

						?>

						<li><a href="#"><?php echo $cat_name; ?></a>
							<ul class="sub-menu">
								<?php showSubcategoryMenu(); ?>
							</ul>
						</li>

					<?php } ?>

					</ul>
				</div>
				
			</div>

			<div class="col-lg-9  order-1 order-lg-2 mb-5 mb-lg-0">
				<div class="row">

                    <?php

					$user_id = $_SESSION['user_id'];

					if (isset($_POST['subProduct'])) {

						if (isset($_SESSION['user_role'])) {

							if (isset($_POST['cart'])) {

								foreach ($_POST['subProduct'] as $productValues) {				

								$query = "SELECT * FROM products WHERE p_id = '{$productValues}' ";

								$third_result = mysqli_query($db, $query);

								confirmQuery($third_result);

								while ($row = mysqli_fetch_array($third_result)) {
									
									$p_name = $row['p_name'];
									$p_price = $row['p_price'];
									$p_img1 = $row['p_img1'];
								}

								$query = "INSERT INTO cart(c_name, c_price, c_img, user_id) VALUES('{$p_name}', '{$p_price}', '{$p_img1}', '{$user_id}')";

								$result = mysqli_query($db, $query);

								confirmQuery($result);

								}

						} else {

							foreach ($_POST['subProduct'] as $productValues) {

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

					selectSubProduct();

					?>

				</div>
			</div>
		</div>
	</div>
</section>