<?php

$user_id = $_SESSION['user_id'];

$user_email = $_SESSION['user_email'];

$total = 0;

selectRowsWhere('cart', 'user_id', $user_id);

while ($row = mysqli_fetch_array($result)) {
	
	$c_id = $row['c_id'];
	$c_name = $row['c_name'];
	$c_price = $row['c_price'];
	$c_img = $row['c_img'];

	$total += $c_price;
	

}

selectRowsWhere('user', 'user_id', $user_id);

while ($row = mysqli_fetch_array($result)) {
	
	$user_id = $row['user_id'];
	$username = $row['username'];
	$user_firstname = $row['user_firstname'];
	$user_lastname = $row['user_lastname'];
	$user_email = $row['user_email'];
}

if (isset($_POST['place'])) {

$to = "kircosarkovskii@gmail.com";
$subject = wordwrap('Order',70);
$body = $c_id . ' ' . $c_name . ' ' . $c_price;
$header = "FROM: " . $user_email;

mail($to, $subject, $body, $header);

$order = '<p class="alert-success">Your order has been sent!</p>';
	
} else {

	$order = '';
}


if (isset($_POST['place'])) {

	$adress = $_POST['adress'];
	$city = $_POST['city'];
	$country = $_POST['country'];
	$zip = $_POST['zip'];
	$phone = $_POST['phone'];
	
	$query = "INSERT INTO orders(o_user_id, o_username,o_firstname, o_lastname, o_email, o_adress, o_city, o_country, o_zip, o_phone, o_date, ordered) ";
	$query .= "VALUES('{$user_id}', '{$username}', '{$user_firstname}', '{$user_lastname}', '{$user_email}', '{$adress}', '{$city}', '{$country}', '{$zip}', '{$phone}', now(), 'Yes')";

	$order_query = mysqli_query($db, $query);

	confirmQuery($order_query);
}



?>

<section class="checkout-section spad">
		<div class="container">
			<div class="row">
				<div class="col-lg-8 order-2 order-lg-1">
					<form class="checkout-form" action="" method="post">
						<div class="cf-title">Billing Address</div>
						<div class="row">
							<div class="col-md-12">
								<p>*Billing Information</p>
								<?php echo $order; ?>
							</div>
						</div>
						<div class="row address-inputs">
							<div class="col-md-12">
								<input type="text" placeholder="Address" name="adress">
								<input type="text" placeholder="City" name="city">
								<input type="text" placeholder="Country" name="country">
							</div>
							<div class="col-md-6">
								<input type="text" placeholder="Zip code" name="zip">
							</div>
							<div class="col-md-6">
								<input type="text" placeholder="Phone no." name="phone">
							</div>
						</div>
						<div class="cf-title">Payment</div>
						<ul class="payment-list">
							<h3>Payment is done on door delivery.</h3>
						</ul>
						<input class="site-btn submit-order-btn" value="Place Order" name="place" type="submit">
					</form>
				</div>
				<div class="col-lg-4 order-1 order-lg-2">
					<div class="checkout-cart">
						<h3>Your Cart</h3>
						<ul class="product-list">

								<?php

								$total = 0;

								$shipping = 50 . '$';

								if($_SESSION['user_role']) {

								selectRowsWhere('cart', 'user_id', $user_id);

								while ($row = mysqli_fetch_array($result)) {
									
									$c_id = $row['c_id'];
									$c_name = $row['c_name'];
									$c_price = $row['c_price'];
									$c_img = $row['c_img'];

									$total += $c_price;


								?>

							<li>
								<div class="pl-thumb"><img width="100px" height="100px" src="administration/img/products/<?php echo $c_img; ?>" alt=""></div>
								<h6><?php echo $c_name; ?></h6>
								<p>$<?php echo $c_price ?>,00</p>
							</li>

						<?php } } ?>

						</ul>
						<ul class="price-list">
							<li>Shipping<span><?php

								if ($total > 1000) {
								
									echo $shipping;

								} else {

									echo 'Free';
								}

							?></span></li>
							<li class="">Total<span>$<?php echo $total; ?></span></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>