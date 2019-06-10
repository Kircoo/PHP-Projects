<?php session_start(); ?>
<?php ob_start(); ?>
<?php include 'includes/db.php' ?>
<?php include 'includes/functions.php' ?>
<?php include 'includes/header.php' ?>
<?php

if ($_SESSION['username']) {
	header('location: todolist.php');
}

if (isset($_POST['register'])) {
	
	$username = $_POST['username'];
	$password = $_POST['password'];
	$email	  = $_POST['email'];

	$error = [

	'username' => '',
	'password' => '',
	'email'    => ''

	];

	if (strlen($username) < 4) {
		
		$error['username'] = "<p class='alert-warning'>Username must be longer!";
	}

	if ($username == '') {
		
		$error['username'] = "<p class='alert-warning'>Username cant be empty!";
	}

	if (usernameExist($username)) {
		$error['username'] = "<p class='alert-warning'>Username exists!";
	}

	if (strlen($password) < 6) {
		
		$error['password'] = "<p class='alert-warning'>Password must be longer!";
	}

	if ($password == '') {
		
		$error['password'] = "<p class='alert-warning'>Password cant be empty!";
	}

	if (emailExist($email)) {
		
		$error['email'] = "<p class='alert-warning'>This email is taken!";
	}

	if ($email == '') {
		
		$error['email'] = "<p class='alert-warning'>Email cant be empty!";
	}

	foreach ($error as $key => $value) {
        if(empty($value)) {

            unset($error[$key]);
        }
    } //foreach

    if (empty($error)) {

    		register($username, $password, $email);

    		logIn($_POST['username'], $_POST['password']);
    }



	
}

?>
<div class="container">

	<div class="row">

		<div class="col-md-3"></div>

		<div class="col-md-6">

			<form class="mb-5" action="" method="post">
				
				<h1 class="mt-5 text-center text-uppercase">Register</h1>

				<div class="form-group">
					
					<label>Username</label>

					<input class="form-control" type="text" name="username">

				</div>
				
				<div class="form-group">

				<label>Password</label>

				<input class="form-control" type="password" name="password">

				</div>

				<div class="form-group">

				<label>Email</label>

				<input class="form-control" type="email" name="email">

				</div>

				<input class="btn btn-secondary" type="submit" name="register">

				<a class="float-right btn btn-primary" href="index.php">Log in</a>

			</form>

				<?php echo isset($error['username']) ? $error['username'] : '' ?>

				<?php echo isset($error['password']) ? $error['password'] : '' ?>

				<?php echo isset($error['email']) ? $error['email'] : '' ?>

		</div>

		<div class="col-md-3"></div>

	</div>

</div>

<?php include 'includes/footer.php' ?>