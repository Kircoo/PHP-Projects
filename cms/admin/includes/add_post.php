<?php addNewPost(); ?>

<form method="post" enctype="multipart/form-data">
	
	<div class="col-md-6">
		<div class="form-group">
			
			<label>Post Title</label>
			<input class="form-control" type="text" name="post_title">

		</div>

		<div class="form-group">
			
            <label>Category</label><br>
			<select name="post_category">
                <?php showCategory(); ?>
            </select>
            
		</div>

		<div class="form-group">
			
			<label>Post Status</label><br>
			<select name="post_status">
				<option value="draft">Select Option</option>
				<option value="draft">draft</option>
				<option value="published">published</option>
			</select>

		</div>

		<div class="form-group">
			
			<label>Post image</label>
			<input type="file" name="post_image" >

		</div>

		<div class="form-group">
			
			<label>Post tags</label>
			<input class="form-control" type="" name="post_tags">

		</div>

		<div class="form-group">
			
			<label>Post Content</label>
			<textarea id="body" name="post_content" class="form-control" cols="30" rows="10"></textarea>

		</div>

		<div class="form-group">
			
			<input class="btn btn-primary" value="Publish Post" type="submit" name="create_post">

		</div>
	</div>


</form>