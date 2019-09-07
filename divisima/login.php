<?php ob_start(); ?>
<?php session_start(); ?>
<?php include "user_includes/user_header.php" ?>

<?php

$log_in = '';


if (isset($_POST['login'])) {
  
  loginUser($_POST['username'], $_POST['password']);
}

?>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h3><a class="btn btn-facebook btn-user btn-block" href="index.php">Home</a></h3>
                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                  </div>
                  <form class="user" action="" method="post">
                    <div class="form-group">
                      <input type="text" name="username" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Username">
                    </div>
                    <div class="form-group">
                      <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                    </div>
                    <input class="btn btn-primary btn-user btn-block" value="Login" name="login" type="submit">
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="forgot-password.html">Forgot Password?</a>
                  </div>
                  <div class="text-center">
                    <a class="small" href="register.php">Create an Account!</a>
                  </div>
                  <?php echo $log_in; ?>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

<?php include "user_includes/user_footer.php" ?>