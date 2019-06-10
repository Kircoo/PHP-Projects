<?php addNewUser(); ?>


<form method="post" enctype="multipart/form-data">
	
	<div class="col-md-6">
		<div class="form-group">
			
			<label>Username</label>
			<input class="form-control" type="text" name="username">

		</div>

		<div class="form-group">
			
			<label>Password</label>
			<input class="form-control" type="password" name="password">

		</div>

		<div class="form-group">
			
			<label>Firstname</label>
			<input class="form-control" type="text" name="firstname">

		</div>

		<div class="form-group">
			
			<label>Lastname</label>
			<input class="form-control" type="text" name="lastname">

		</div>

		<div class="form-group">
			
			<label>Email address</label>
			<input class="form-control" type="email" name="email">

		</div>

		<div class="form-group">
			
			<label>Image</label>
			<input type="file" name="user_image" >

		</div>

		<div class="form-group">
			
			<label>Role</label><br>
			<select name="user_role">
				
				<option value="Subscriber">Select role</option>
				<option value="Admin">Admin</option>
				<option value="Subscriber">Subscriber</option>

			</select>

		</div>

		<div class="form-group">
			
			<input class="btn btn-primary" value="Add user" type="submit" name="create_user">

		</div>

	<?php echo $user_created; ?>

	</div>

</form>