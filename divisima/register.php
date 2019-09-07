<?php session_start(); ?>
<?php include "user_includes/user_header.php" ?>

<?php

 $register = '';

if (isset($_POST['register'])) {
  
  if ($_POST['password'] == $_POST['confirmpassword']) {

    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $username = escape($username);
    $password = escape($password);

    $error = [

    'username' => '',
    'password' => '',
    'email' => ''

    ];


    if (strlen($username) < 5) {

      $error['username'] = "<p class='alert-warning'>Username must contain more characters!</p>";
    }

    if (empty($username)) {
      
      $error['username'] = "<p class='alert-warning'>Username cant be empty!</p>";
    }

    if (exist('username', 'user', $username)) {
     
     $error['username'] = "<p class='alert-warning'>Username already exists!</p>";
    }

    if (empty($email)) {

      $error['email'] = "<p class='alert-warning'>Email cant be empty!</p>";
    }

    if (exist('user_email', 'user', $email)) {

      $error['email'] = "<p class='alert-warning'>Email already exists!</p>";
    }

    if (empty($password)) {

      $error['password'] = "<p class='alert-warning'>Password cant be empty!</p>";
    }

    if (strlen($password) < 6) {

      $error['password'] = "<p class='alert-warning'>Password must contain more characters!</p>";
    }

    foreach ($error as $key => $value) {
      
      if (empty($value)) {
        
        unset($error[$key]);

      }

    } //foreach

    if (empty($error)) {
      
      registerUser();

    }

  } else {

   $register = "<p class='alert-warning'>Your password doesnt match!</p>";

  }

}


?>

<body class="bg-gradient-primary">

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h3><a class="btn btn-facebook btn-user btn-block" href="index.php">Home</a></h3>
                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
              </div>
              <form class="user" action="" method="post">
                <div class="form-group">
                  <input type="text" name="username" class="form-control form-control-user" id="exampleInputEmail" placeholder="Username">
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" name="firstname" class="form-control form-control-user" id="exampleFirstName" placeholder="First Name">
                  </div>
                  <div class="col-sm-6">
                    <input type="text" name="lastname" class="form-control form-control-user" id="exampleLastName" placeholder="Last Name">
                  </div>
                </div>
                <div class="form-group">
                  <input type="email" name="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Email Address">
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password">
                  </div>
                  <div class="col-sm-6">
                    <input type="password" name="confirmpassword" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Repeat Password">
                  </div>
                </div>
                <input name="register" type="submit" value="Register Account" class="btn btn-primary btn-user btn-block">
                <hr>
              </form>
              <div>

                <div class="small text-muted"><?php echo isset($error['username']) ? $error['username'] : '' ?></div>

                <div class="small text-muted"><?php echo isset($error['password']) ? $error['password'] : '' ?></div>

                <div class="small text-muted"><?php echo isset($error['email']) ? $error['email'] : '' ?></div>
                
                <?php echo $register; ?>

              </div>
              <div class="text-center">
                <a class="small" href="forgot-password.html">Forgot Password?</a>
              </div>
              <div class="text-center">
                <a class="small" href="login.php">Already have an account? Login!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

<?php include "user_includes/user_footer.php" ?>
