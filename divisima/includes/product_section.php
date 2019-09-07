<iframe name="votar" style="display:none;"></iframe>
<?php

if (isset($_GET['product'])) {
	
	$the_product_id = $_GET['product'];

}

selectSingleProduct();

if (isset($_POST['single'])) {

	$user_id = $_SESSION['user_id'];
	
	$query = "SELECT * FROM products WHERE p_id = '{$the_product_id}' ";

	$single_results = mysqli_query($db, $query);

	confirmQuery($single_results);

	while ($row = mysqli_fetch_array($second_results)) {
		
		$p_name = $row['p_name'];
		$p_price = $row['p_price'];
		$p_img1 = $row['p_img1'];
	}

	$query = "INSERT INTO cart(c_name, c_price, c_img, user_id) VALUES('{$p_name}', '{$p_price}', '{$p_img1}', '{$user_id}')";

	$result = mysqli_query($db, $query);

	confirmQuery($result);
}

?>

<section class="product-section">
	<div class="container">
		<div class="row">
			<div class="col-lg-6">
				<div class="product-pic-zoom">
					<img class="product-big-img" src="administration/img/products/<?php echo $p_img1; ?>" alt="">
				</div>
				<div class="product-thumbs" tabindex="1" style="overflow: hidden; outline: none;">
					<div class="product-thumbs-track">
						<div class="pt active" data-imgbigurl="administration/img/Products/<?php echo $p_img1; ?>"><img src="administration/img/products/<?php echo $p_img1; ?>" alt=""></div>
						<div class="pt" data-imgbigurl="administration/img/products/<?php echo $p_img2; ?>"><img src="administration/img/Products/<?php echo $p_img2; ?>" alt=""></div>
						<div class="pt" data-imgbigurl="administration/img/products/<?php echo $p_img3; ?>"><img src="administration/img/Products/<?php echo $p_img3; ?>" alt=""></div>
						<div class="pt" data-imgbigurl="administration/img/products/<?php echo $p_img4; ?>"><img src="administration/img/Products/<?php echo $p_img4; ?>" alt=""></div>
					</div>
				</div>
			</div>
			<div class="col-lg-6 product-details">
				<h2 class="p-title"><?php echo $p_name; ?></h2>
				<h3 class="p-price">$<?php echo $p_price; ?>.00</h3>
				<h4 class="p-stock">Available: <span><?php echo $p_stock; ?></span></h4>
				<div class="p-rating">
					<i class="fa fa-star-o"></i>
					<i class="fa fa-star-o"></i>
					<i class="fa fa-star-o"></i>
					<i class="fa fa-star-o"></i>
					<i class="fa fa-star-o fa-fade"></i>
				</div>
				<div class="fw-size-choose">
					<p>Size</p>
					<div class="sc-item">
						<input type="radio" name="sc" id="xs-size">
						<label for="xs-size">32</label>
					</div>
					<div class="sc-item">
						<input type="radio" name="sc" id="s-size">
						<label for="s-size">34</label>
					</div>
					<div class="sc-item">
						<input type="radio" name="sc" id="m-size" checked="">
						<label for="m-size">36</label>
					</div>
					<div class="sc-item">
						<input type="radio" name="sc" id="l-size">
						<label for="l-size">38</label>
					</div>
					<div class="sc-item disable">
						<input type="radio" name="sc" id="xl-size" disabled>
						<label for="xl-size">40</label>
					</div>
					<div class="sc-item">
						<input type="radio" name="sc" id="xxl-size">
						<label for="xxl-size">42</label>
					</div>
				</div>
				<div class="quantity">
					<p>Quantity</p>
                    <div class="pro-qty"><input type="text" value="1"></div>
                </div>
                <form action="" method="post" target="votar">
				<input class="site-btn" type="submit" name="single" value="SHOP NOW" onclick="latest();">
				</form>
				<div id="accordion" class="accordion-area">
					<div class="panel">
						<div class="panel-header" id="headingOne">
							<button class="panel-link active" data-toggle="collapse" data-target="#collapse1" aria-expanded="true" aria-controls="collapse1">information</button>
						</div>
						<div id="collapse1" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
							<div class="panel-body">
								<p><?php echo $p_info; ?></p>
							</div>
						</div>
					</div>
					<div class="panel">
						<div class="panel-header" id="headingTwo">
							<button class="panel-link" data-toggle="collapse" data-target="#collapse2" aria-expanded="false" aria-controls="collapse2">care details </button>
						</div>
						<div id="collapse2" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
							<div class="panel-body">
								<img src="./img/cards.png" alt="">
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin pharetra tempor so dales. Phasellus sagittis auctor gravida. Integer bibendum sodales arcu id te mpus. Ut consectetur lacus leo, non scelerisque nulla euismod nec.</p>
							</div>
						</div>
					</div>
					<div class="panel">
						<div class="panel-header" id="headingThree">
							<button class="panel-link" data-toggle="collapse" data-target="#collapse3" aria-expanded="false" aria-controls="collapse3">shipping & Returns</button>
						</div>
						<div id="collapse3" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
							<div class="panel-body">
								<h4>7 Days Returns</h4>
								<p>Cash on Delivery Available<br>Home Delivery <span>3 - 4 days</span></p>
								<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin pharetra tempor so dales. Phasellus sagittis auctor gravida. Integer bibendum sodales arcu id te mpus. Ut consectetur lacus leo, non scelerisque nulla euismod nec.</p>
							</div>
						</div>
					</div>
				</div>
				<div class="social-sharing">
					<a href=""><i class="fa fa-google-plus"></i></a>
					<a href=""><i class="fa fa-pinterest"></i></a>
					<a href=""><i class="fa fa-facebook"></i></a>
					<a href=""><i class="fa fa-twitter"></i></a>
					<a href=""><i class="fa fa-youtube"></i></a>
				</div>
			</div>
		</div>
	</div>
</section>