					<?php

					$edit_post_notification = '';

					if (isset($_GET['p_id'])) {
						
						$the_post_id = escape($_GET['p_id']);
					}

                        $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
                        $select_post_query_by_id = mysqli_query($connection, $query);

                        while ($row = mysqli_fetch_array($select_post_query_by_id)) {
                            
                            $post_id = $row['post_id'];
                            $post_title = $row['post_title'];
                            $post_category_id = $row['post_category_id'];
                            $post_date = $row['post_date'];
                            $post_image = $row['post_image'];
                            $post_tags = $row['post_tags'];
                            $post_comment_count = $row['post_comment_count'];
                            $post_status = $row['post_status'];
                            $post_content = $row['post_content'];
                            $post_views_counts = $row['post_views_counts'];
                        }

                        if (isset($_POST['edit_post'])) {
                        	
                        		$post_title = escape($_POST['post_title']);
								$post_category_id = escape($_POST['post_category']);
								$post_status = escape($_POST['post_status']);
								$post_image = $_FILES['post_image']['name'];
								$post_image_temp = $_FILES['post_image']['tmp_name'];
								$post_tags = escape($_POST['post_tags']);
								$post_content = escape($_POST['post_content']);

								move_uploaded_file($post_image_temp, "../images/$post_image");

							if (empty($post_image)) {
                        	$query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
                        	$select_image = mysqli_query($connection, $query);

                        	while ($row = mysqli_fetch_array($select_image)) {
                        		
                        		$post_image = $row['post_image'];
                        	}
                        }

								$query = "UPDATE posts SET ";
								$query .= "post_title = '{$post_title}', ";
								$query .= "post_category_id = '{$post_category_id}', ";
								$query .= "post_status = '{$post_status}', ";
								$query .= "post_image = '{$post_image}', ";
								$query .= "post_date = now(), ";
								$query .= "post_tags = '{$post_tags}', ";
								$query .= "post_content = '{$post_content}', ";
								$query .= "post_views_counts = 0 ";
								$query .= "WHERE post_id = '{$the_post_id}' ";

								$update_query = mysqli_query($connection, $query);

								confirmQuery($update_query);

								echo "<p class='bg-success'>Post Updated. <a href='../post.php?p_id={$the_post_id}'> View Post</a> // <a href='./posts.php'> Edit Posts</a></p>";
                        }

					?>

<form method="post" enctype="multipart/form-data">
	
	<div class="col-md-6">
		<div class="form-group">

			
			
			<label>Post Title</label>
			<input class="form-control" type="text" name="post_title" value="<?php echo $post_title; ?>">

		</div>

		<div class="form-group">
			
			<label>Post Category Id</label><br>
			<select name="post_category">
				

				<?php



				$query = "SELECT * FROM categories";
                $select_edit_categories = mysqli_query($connection, $query);

                confirmQuery($select_edit_categories);

                while ($row = mysqli_fetch_array($select_edit_categories)) {
                                
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];

                if ($cat_id == $post_category_id) {
                    
                    echo "<option selected value='{$cat_id}'>{$cat_title}</option>";

                } else {

                    echo "<option value='{$cat_id}'>{$cat_title}</option>";
                }

            }




				?>


			</select>
		</div>



		<div class="form-group">
			
			<label>Post Status</label><br>
			<select name="post_status">
				
			<option><?php echo $post_status; ?></option>

			<?php


			if ($post_status == 'published') {
				echo "<option value='draft'>draft</option>";
			} else {
				echo "<option value='published'>published</option>";
			}


			?>
			</select>

		</div>

		<div class="form-group">
			
			<img width="100" src="../images/<?php echo $post_image; ?>">
			<input type="file" name="post_image" >

		</div>

		<div class="form-group">
			
			<label>Post tags</label>
			<input class="form-control" type="" name="post_tags" value="<?php echo $post_tags; ?>">

		</div>

		<div class="form-group">
			
			<label>Post Content</label>
			<textarea id="body" name="post_content" class="form-control" cols="30" rows="10" ><?php echo str_replace('\r\n', '</br>', $post_content); ?></textarea>

		</div>

		<div class="form-group">
			
			<input class="btn btn-primary" value="Edit Post" type="submit" name="edit_post">

		</div>
	</div>


</form>