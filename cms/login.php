<?php ob_start(); ?>
<?php session_start(); ?>
<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>

<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>

<?php
$log_in ='';
checkIfUserIsLoggedInAndRedirect('/cms/admin');

if(ifItIsMethod('post')) {

    if (isset($_POST['username']) && isset($_POST['password'])) {
        
        loginUser($_POST['username'], $_POST['password']);

    }
}

?>

<!-- Navigation -->

<?php  include "includes/navigation.php"; ?>

<div id="login"><!-- login -->
<!-- Page Content -->
    <div class="container">

        <div class="form-gap"></div>

        <div class="container">

            <div class="row">

                <div class="col-md-4 col-md-offset-4">

                <div class='window' style="height:100%;">

                    <div class='overlay' style="height:100%;"></div>

                        <div class='content'>
                            
                            <div class='welcome'>Hello There!</div>

                                <div class='subtitle'>We're almost done. Before using our services you need to log in. If you dont have an account create one!</div>

                                    <div class='input-fields'>

                                        <form action="" method="post">

                                            <input name="username" type='text' placeholder='Username' class='input-line full-width'>

                                            <input name="password" type='password' placeholder='Password' class='input-line full-width'>

                                    </div>
                                            <div class='spacing'>Forgot your password? <span class='highlight'><a href="./forgot.php?forgot=<?php echo uniqid(true); ?>">Click HERE</a></span></div>

                                            <div><button name="login" type="submit" class='ghost-round full-width'>Log in</button></div>

                                        </form>

                                        <div><a href="./registration.php"><button class='ghost-round full-width'>Create Account</button></a></div>

                                        <div><?php echo $log_in; ?></div>

                            </div>

                        </div>
                </div>

            </div>

        </div>
        
    </div><!-- /.container -->

</div> <!-- /.login -->

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