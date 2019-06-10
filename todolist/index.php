<?php session_start(); ?>
<?php ob_start(); ?>
<?php include 'includes/db.php' ?>
<?php include 'includes/functions.php' ?>
<?php include 'includes/header.php' ?>


<?php

if ($_SESSION['username']) {
	header('location: todolist.php');
}

$error = '';

if (isset($_POST['login'])) {
	
logIn($_POST['username'], $_POST['password']);

}


?>

<div class="container">

	<div class="row">

		<div class="col-md-3"></div>

		<div class="col-md-6">

			<form class="mb-5" action="" method="post">
				
				<h1 class="mt-5 text-center text-uppercase">Log in</h1>

				<?php echo $error; ?>

				<div class="form-group">
					
					<label>Username</label>

					<input class="form-control" type="text" name="username">

				</div>
				
				<div class="form-group">

				<label>Password</label>

				<input class="form-control" type="password" name="password">

				</div>

				<input class="btn btn-secondary" type="submit" name="login">

				<a class="float-right btn btn-primary" href="register.php">Register</a>

			</form>

		</div>

		<div class="col-md-3"></div>

	</div>

</div>




































<?php include 'includes/footer.php' ?>