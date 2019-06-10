					<?php
					global $update;
					if (isset($_GET['u_id'])) {
						
						$the_user_id = escape($_GET['u_id']);
					

                        $query = "SELECT * FROM users WHERE user_id = $the_user_id ";
                        $select_user_query_by_id = mysqli_query($connection, $query);

                        while ($row = mysqli_fetch_array($select_user_query_by_id)) {
                            
                            $user_id = $row['user_id'];
                            $username = $row['username'];
                            $user_password = $row['user_password'];
                            $user_email = $row['user_email'];
                            $user_firstname = $row['user_firstname'];
                            $user_lastname = $row['user_lastname'];
                            $user_role = $row['user_role'];
                            $user_image = $row['user_image'];


                        }
                            ?>

                        <?php

                        if (isset($_POST['update_user'])) {
                        	
                        		$username = escape($_POST['username']);
								$user_password = escape($_POST['password']);
								$user_firstname = escape($_POST['firstname']);
								$user_lastname = escape($_POST['lastname']);
								$user_email = escape($_POST['email']);


								$user_image = $_FILES['user_image']['name'];
								$user_image_temp = $_FILES['user_image']['tmp_name'];


								$user_role = escape($_POST['user_role']);


								move_uploaded_file($user_image_temp, "../images/$user_image");

							if (empty($user_image)) {
                        	$query = "SELECT * FROM users WHERE user_id = $the_user_id ";
                        	$select_user_image = mysqli_query($connection, $query);

                        	while ($row = mysqli_fetch_array($select_user_image)) {
                        		
                        		$user_image = $row['user_image'];
                        	}
                        }

                        if (!empty($user_password)) {
                        	
                        	$query_password = "SELECT user_password FROM users WHERE user_id = $the_user_id";
                        	$get_user_query = mysqli_query($connection, $query_password);
                        	confirmQuery($get_user_query);

                        	$row = mysqli_fetch_array($get_user_query);

                        	$db_user_password = $row['user_password'];

            	            if ($db_user_password != $user_password) {
                        	
                        	$hashed_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));
                        }

                        $query = "UPDATE users SET ";
                        $query .= "user_password = '{$hashed_password}' ";
                        $query .= "WHERE username = '{$username}'";

                        $update_hash = mysqli_query($connection, $query);

                        confirmQuery($update_hash);
                        	

                        }


                            $query = "UPDATE users SET ";
							$query .= "username = '{$username}', ";
							$query .= "user_email = '{$user_email}', ";
							$query .= "user_firstname = '{$user_firstname}', ";
							$query .= "user_lastname = '{$user_lastname}', ";
							$query .= "user_role = '{$user_role}', ";
							$query .= "user_image = '{$user_image}' ";
							$query .= "WHERE user_id = '{$the_user_id}' ";

							$update_user_query = mysqli_query($connection, $query);

							confirmQuery($update_user_query);

							$update = "<div class='bg-success'><h4>User updated!</h4></div>";
								
                        }

                    } else {

                    	header("location: index.php");
                    } 

					?>

<form method="post" enctype="multipart/form-data">

	<?php echo $update; ?>
	
	<div class="col-md-6">
		<div class="form-group">
			
			<label>Username</label>
			<input class="form-control" type="text" value="<?php echo $username ?>" name="username">

		</div>



		<div class="form-group">
			
			<label>New Password</label>
			<input autocomplete="off" class="form-control" type="password" name="password">

		</div>

		<div class="form-group">
			
			<label>Firstname</label>
			<input class="form-control" type="text" value="<?php echo $user_firstname ?>" name="firstname">

		</div>

		<div class="form-group">
			
			<label>Lastname</label>
			<input class="form-control" type="text" value="<?php echo $user_lastname ?>" name="lastname">

		</div>

		<div class="form-group">
			
			<label>Email address</label>
			<input class="form-control" type="email" value="<?php echo $user_email ?>" name="email">

		</div>

		<div class="form-group">
			
			<img width="100" src="../images/<?php echo $user_image; ?>">
			<input type="file" name="user_image" >

		</div>

		<div class="form-group">
			
			<label>Role</label><br>
			<select name="user_role">
				
			<option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>

			<?php


			if ($user_role == 'Admin') {
				echo "<option value='Subscriber'>Subscriber</option>";
			} else {
				echo "<option value='Admin'>Admin</option>";
			}


			?>
			</select>

		</div>

		<div class="form-group">
			
			<input class="btn btn-primary" value="Update User" type="submit" name="update_user">

		</div>
	</div>


</form>