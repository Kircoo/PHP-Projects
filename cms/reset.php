<?php ob_start(); ?>
<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>

<?php

if (!isset($_GET['email']) && !isset($_GET['token'])) {
    
    redirect('index.php');
}


if ($stmt = mysqli_prepare($connection, 'SELECT username, user_email, token FROM users WHERE token=?')) {
    
    mysqli_stmt_bind_param($stmt, "s", $_GET['token']);

    mysqli_stmt_execute($stmt);

    mysqli_stmt_bind_result($stmt, $username, $user_email, $token);

    mysqli_stmt_fetch($stmt);

    mysqli_stmt_close($stmt);
    

    if (isset($_POST['password']) && isset($_POST['confirmPassword'])) {
        
        if($_POST['password'] === $_POST['confirmPassword']) {

            $password = $_POST['password'];

            $hashPassword = password_hash($password, PASSWORD_BCRYPT, array('cost'=>12));

            if($stmt = mysqli_prepare($connection, "UPDATE users SET token = '', user_password = '{$hashPassword}' WHERE user_email = ? ")) {

                mysqli_stmt_bind_param($stmt, "s", $_GET['email']);

                mysqli_stmt_execute($stmt);

                $fecths = mysqli_stmt_affected_rows($stmt);

                mysqli_stmt_close($stmt);

            }
        } else {

            $error = [

                'password' => ''
            ];

            if(strlen($hashPassword) < 5){

                $error['password'] = '<p class="alert-danger">Password is to short!</p>';
            }

            if($hashPassword == '') {

                $error['password'] = '<p class="alert-danger">Fileds cant be empty!</p>';
            }

            // if($_POST['password'] != $_POST['confirmPassword']) {

            //     $error['password'] = '<p class="alert-danger">Your passwords does not match!</p>';
            // }

            foreach ($error as $key => $value) {
                if(empty($value)) {
        
                    unset($error[$key]);
                }
            } //foreach
        }
    }

}

?>

<div id="reset">

<div class="container">

    <div class="container">

        <div class="row">

            <div class="col-md-4 col-md-offset-4">

                <div class="">

                    <div class="panel-body">

                        <div class="text-center">

                        <?php if(!isset($fecths) >= 1): ?>

                            <div class='window' style="height: 100%;">

                                <div class='overlay' style="height: 100%;"></div>

                                    <div class='content'>

                                    <h3><i class="fa fa-lock fa-4x"></i></h3>

                                    <h2 class="text-center">Reset Password</h2>

                                    <p>You can reset your password here.</p>

                                    <div class="panel-body">

                                                <div class='input-fields'>

                                                    <form action="" method="post">

                                                        <input name="password" type='password' placeholder='Password' class='input-line full-width'>

                                                        <input name="confirmPassword" type='password' placeholder='confirmPassword' class='input-line full-width'>

                                                </div>
                                                        <div><button name="recover-submit" type="submit" class='ghost-round full-width'>Reset Password</button></div>

                                                    </form>

                                                    <div><?php echo isset($error['password']) ? $error['password'] : '' ?></div>
                                        </div>

                                    </div>
                                    
                                </div>

                                <?php else: ?>

                                <h2>Your password is reseted, you can <a href="./login.php">Log in</a> with your new password!</h2>

                                <?php endif; ?>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div> <!-- RESET -->

</div> <!-- /.container -->

<div class="container">

    <div class="row text-center">

        <div class="col-md-12">

<div class="box">

    <div class="container">
        
     	<div class="row">
			 
			    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
               
					<div class="box-part text-center">
                        
                        <i class="fa fa-behance fa-3x" aria-hidden="true"></i>
                        
						<div class="title">

                            <h3>Behance</h3>
                            
						</div>
                        
						<div class="text">

                            <span>Lorem ipsum dolor sit amet, id quo eruditi eloquentiam. Assum decore te sed. Elitr scripta ocurreret qui ad.</span>
                            
						</div>
                        
						<a href="#">Learn More</a>
                        
					 </div>
				</div>	 
				
				 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
               
					<div class="box-part text-center">
					    
					    <i class="fa fa-twitter fa-3x" aria-hidden="true"></i>
                    
						<div class="title">

                            <h3>Twitter</h3>
                            
						</div>
                        
						<div class="text">

                            <span>Lorem ipsum dolor sit amet, id quo eruditi eloquentiam. Assum decore te sed. Elitr scripta ocurreret qui ad.</span>
                            
						</div>
                        
						<a href="#">Learn More</a>
                        
					 </div>
				</div>	 
				
				 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
               
					<div class="box-part text-center">
                        
                        <i class="fa fa-facebook fa-3x" aria-hidden="true"></i>
                        
						<div class="title">

                            <h3>Facebook</h3>
                            
						</div>
                        
						<div class="text">

                            <span>Lorem ipsum dolor sit amet, id quo eruditi eloquentiam. Assum decore te sed. Elitr scripta ocurreret qui ad.</span>
                            
						</div>
                        
						<a href="#">Learn More</a>
                        
					 </div>
				</div>	 
				
				<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
               
					<div class="box-part text-center">
                        
                        <i class="fa fa-linkedin fa-3x" aria-hidden="true"></i>
                        
						<div class="title">

                            <h3>Pinterest</h3>
                            
						</div>
                        
						<div class="text">

                            <span>Lorem ipsum dolor sit amet, id quo eruditi eloquentiam. Assum decore te sed. Elitr scripta ocurreret qui ad.</span>
                            
						</div>
                        
						<a href="#">Learn More</a>
                        
					 </div>
				</div>	 
				
				 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
               
					<div class="box-part text-center">
					    
					    <i class="fa fa-google-plus fa-3x" aria-hidden="true"></i>
                    
						<div class="title">

                            <h3>Google</h3>
                            
						</div>
                        
						<div class="text">

                            <span>Lorem ipsum dolor sit amet, id quo eruditi eloquentiam. Assum decore te sed. Elitr scripta ocurreret qui ad.</span>
                            
						</div>
                        
						<a href="#">Learn More</a>
                        
					 </div>
				</div>	 
				
				 <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
               
					<div class="box-part text-center">
                        
                        <i class="fa fa-github fa-3x" aria-hidden="true"></i>
                        
						<div class="title">

                            <h3>Github</h3>
                            
						</div>
                        
						<div class="text">

                            <span>Lorem ipsum dolor sit amet, id quo eruditi eloquentiam. Assum decore te sed. Elitr scripta ocurreret qui ad.</span>
                            
						</div>
                        
						<a href="#">Learn More</a>
                        
                     </div>
                     
				</div>
		
        </div>	
        	
    </div>

</div>

        </div>

    </div>

</div>

<?php include "includes/footer.php";?>

