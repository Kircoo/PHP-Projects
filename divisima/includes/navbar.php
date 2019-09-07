	<header class="header-section sticky-top bg-white">
		<div class="header-top">
			<div class="container">
				<div class="row">
					<div class="col-lg-2 text-center text-lg-left">
						<!-- logo -->
						<a href="./index.php" class="site-logo">
							<img src="img/logo.png" alt="">
						</a>
					</div>
					<div class="col-xl-6 col-lg-5">
						<form class="header-search-form">
							<input type="text" placeholder="Search on divisima ....">
							<button><i class="flaticon-search"></i></button>
						</form>
					</div>
					<div class="col-xl-4 col-lg-5">
						<div class="user-panel">
							<div class="up-item">
								<i class="flaticon-profile"></i>
								<?php if (isset($_SESSION['user_role'])): ?>

								<a href="logout.php">Logout</a>

								<p>Welcome <?php echo $_SESSION['username']; ?></p>

								<?php else: ?>

								<a href="login.php">Sign</a> In or <a href="register.php">Create Account</a>

								<?php endif; ?>

							</div>
							<div class="up-item">
								<div class="shopping-card">
									<i class="flaticon-bag"></i>
									<?php

									if (isset($_SESSION['user_id'])) {

										countRows('cart', 'user_id', $_SESSION['user_id']);
									}

									?>
									
									<span>

									<?php if (isset($_SESSION['user_role'])) {
										echo $count;
									} else {

										echo 0;

									} ?>
										
									</span>
								</div>
								<a href="cart.php">Shopping Cart</a>
							</div>
							<div class="up-item">
								<div class="shopping-card">
									<i class="flaticon-heart"></i>
									<?php 

									if (isset($_SESSION['user_id'])) {
										countRows('wishlist', 'user_id', $_SESSION['user_id']);
									}

									?>
									<span>
										
									<?php if (isset($_SESSION['user_role'])) {
										echo $count;
									} else {

										echo 0;

									} ?>

									</span>
								</div>
								<a href="wishlist.php">Wishlist</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<nav class="main-navbar">
			<div class="container">
				<!-- menu -->
				<ul class="main-menu">
					<li><a href="index.php">Home</a></li>

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

					<!-- <li><a href="#">Jewelry
						<span class="new">New</span>
					</a></li> -->
					<li><a href="contact.php">Contact</a></li>

					<?php if(isset($_SESSION['user_role']) == 'Admin'): ?>

					<li><a href="administration">Administration</a></li>

					<?php endif; ?>

				</ul>
			</div>
		</nav>
	</header>