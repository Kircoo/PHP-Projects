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

 require __DIR__ . '/vendor/autoload.php';

 $dotenv = Dotenv\Dotenv::create(__DIR__);
 $dotenv->load();

  $options = array(
    'cluster' => 'eu',
    'encrypted' => false
  );
  $pusher = new Pusher\Pusher(getenv('APP_KEY'), getenv('APP_SECRET'),getenv('APP_ID'), $options);


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = escape(trim($_POST['username']));
    $email    = escape(trim($_POST['email']));
    $password = escape(trim($_POST['password']));
    $firstname = escape(trim($_POST['firstname']));
    $lastname = escape(trim($_POST['lastname']));
    $user_image = $_FILES['user_image']['name'];
    $user_image_temp = $_FILES['user_image']['tmp_name'];
    move_uploaded_file($user_image_temp, "./images/$user_image");

    $error = [

        'username' => '',
        'email' => '',
        'password' => '',
        'firstname' => '',
        'lastname' => ''

    ];

    if (strlen($username) < 4) {
        
        $error['username'] = '<p class="alert-danger">Username must containt more letters!</p>';
    }

    if ($username == '') {
        
        $error['username'] = '<p class="alert-danger">Username cannot be empty!</p>';
    }
    
    if (usernameExist($username)) {
        
        $error['username'] = '<p class="alert-danger">This username already exist!</p>';
    }

    if ($email == '') {
        $error['email'] = '<p class="alert-danger">Email cannot be empty!</p>';
    }

    if (emailExist($email)) {
        
        $error['email'] = '<p class="alert-danger">This email already exist!</p>';
    }

    if (strlen($password) < 4) {
        
        $error['password'] = '<p class="alert-danger">password must containt more letters!</p>';
    }

    if ($password == '') {
        $error['password'] = '<p class="alert-danger">Password cannot be empty</p>';
    }

    foreach ($error as $key => $value) {
        if(empty($value)) {

            unset($error[$key]);
        }
    } //foreach

    if (empty($error)) {
        
        registerUser($username, $email, $password, $firstname, $lastname, $user_image);

        $data['message'] = $username;
        $pusher->trigger('notifications', 'new_user', $data);
        
        loginUser($username, $password);
    }


}


?>

<!-- Navigation -->
    
<?php  include "includes/navigation.php"; ?>
    
<div id="register">

    <!-- Page Content -->

    <div class="container">
        
            <div class="col-md-4 col-sm-12"></div>

            <div class="col-md-4 col-sm-12">

                <div class='window' style="width:100%!important; height:100%">

                    <div class='overlay' style="height:100%!important;"></div>

                        <div class='content'>

                            <div class='welcome'>Hello There!</div>

                                <div class='subtitle'>We're almost done. Before using our services you need to create an account.</div>

                                    <div class='input-fields'>

                                            <form action="" method="post" autocomplete="off" enctype="multipart/form-data">

                                                <div class="col-md-6">

                                                    <input name="username" type='text' placeholder='Username' class='input-line full-width' autocomplete="on" value="<?php echo isset($username) ? $username : '' ?>">
                                                    
                                                    <input name="email" type='email' placeholder='Email' class='input-line full-width' autocomplete="on" value="<?php echo isset($email) ? $email : '' ?>">
                                                    
                                                    <input name="password" type='password' placeholder='Password' class='input-line full-width'>
                                                
                                                </div>

                                                <div class="col-md-6">
                                                    
                                                    <input name="firstname" type='text' placeholder='Firstname' class='input-line full-width' autocomplete="on" value="<?php echo isset($firstname) ? $firstname : '' ?>">
                                                    
                                                    <input name="lastname" type='text' placeholder='Lastname' class='input-line full-width' autocomplete="on" value="<?php echo isset($lastname) ? $lastname : '' ?>">
                                                    <label>Insert your profile picture</label>
                                                    <input name="user_image" type='file' class='input-line full-width'>
                                                
                                                </div>
                                                
                                            </div>

                                                <div><button name="submit" type="submit" class='ghost-round full-width'>Register</button></div>

                                            </form>
                                
                                <p><?php echo isset($error['username']) ? $error['username'] : '' ?></p>

                                <p><?php echo isset($error['password']) ? $error['password'] : '' ?></p>

                                <p><?php echo isset($error['email']) ? $error['email'] : '' ?></p>

                        </div>

                    </div>

                </div>

            </div>

            <div class="col-md-4 col-sm-12"></div>

    </div>

</div>

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