<?php ob_start(); ?>
<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>

<?php
      use PHPMailer\PHPMailer\PHPMailer;
      use PHPMailer\PHPMailer\Exception;
      require './classes/config.php';
      require 'vendor/autoload.php';

$forgot_email = '';

if(!isset($_GET['forgot'])) {

    redirect('index.php');
}

if(ifItIsMethod('post')) {

    if(isset($_POST['email'])) {

        $email = $_POST['email'];

        $length = 50;

        $token = bin2hex(openssl_random_pseudo_bytes($length));

        if (emailExist($email)) {
         
            if($stmt = mysqli_prepare($connection, "UPDATE users SET token = '{$token}' WHERE user_email = ?")) {

                mysqli_stmt_bind_param($stmt, 's', $email);

                mysqli_stmt_execute($stmt);
    
                mysqli_stmt_close($stmt);

                // Import PHPMailer classes into the global namespace
                // These must be at the top of your script, not inside a function

                // Load Composer's autoloader

                // Instantiation and passing `true` enables exceptions
                $mail = new PHPMailer(true);

                //Server settings
                // Enable verbose debug output
                $mail->isSMTP();                                            // Set mailer to use SMTP
                $mail->Host       = Config::SMTP_HOST;                      // Specify main and backup SMTP servers
                $mail->Port       = Config::SMTP_PORT;                      // TCP port to connect to
                $mail->Username   = Config::SMTP_USER;                      // SMTP username
                $mail->Password   = Config::SMTP_PASSWORD;                  // SMTP password
                $mail->SMTPSecure = 'ssl';                                  // Enable TLS encryption, `ssl` also accepted
                $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
                $mail->isHTML(true);                                        // For HTML
                $mail->CharSet = 'UTF-8';                                   // FOR MULTYLANGUAGE MAILS

                $mail->setFrom('info@tikataka.mk', 'Tikataka');
                $mail->addAddress($email);
                $mail->Subject = 'Do not replay!';
                $mail->Body = '<h3>Please click the link to reset your password!
                
                <a href="http://tikataka.mk/cms/reset.php?email='.$email.'&token='.$token.' ">http://tikataka.mk/cms/reset.php?email='.$email.'&token='.$token.'</a>
                
                </h3>';

                if($mail->send()) {
                    
                    $emailSent = true;
                    
                } else {

                    echo 'MAIL IS NOT SEND!';
                }
        }
    } else {

        $forgot_email = "<p class='alert-info'>This email address does not exist. Try again!</p>";
    }
}

}

?>


<div id="reset">

<!-- Page Content -->

<div class="container">

    <div class="form-gap"></div>

    <div class="container">

        <div class="row">

            <div class="col-md-4 col-md-offset-4">

                <div class="">

                    <div class="panel-body">

                        <div class="text-center">

                            <?php
                            
                            if (!isset($emailSent)):

                            ?>

                                <div class='window' style="height:100%;">

                                    <div class='overlay' style="height:100%;"></div>

                                        <div class='content'>

                                        <h3><i class="fa fa-lock fa-4x"></i></h3>

                                        <h2 class="text-center">Forgot Password?</h2>

                                        <p>You can reset your password here.</p>

                                        <div class="panel-body">

                                                    <div class='input-fields'>

                                                        <form action="" method="post">

                                                            <input name="email" type='email' placeholder='Email Address' class='input-line full-width'>
                                                
                                                    </div>
                                                            <div><button name="recover-submit" type="submit" class='ghost-round full-width'>Reset Password</button></div>

                                                            <div><?php echo $forgot_email; ?></div>

                                                        </form>
                                            </div>

                                        </div>
                                </div>

                            <?php
                                
                            else:
                                
                            ?>

                            <h2>Please check your email!</h2>

                            <?php
                                
                            endif;
                                
                            ?>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div><!-- reset -->

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

