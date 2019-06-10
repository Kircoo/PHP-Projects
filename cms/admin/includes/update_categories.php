                        <form method="post">
                            
                            <div class="form-group">
                                <label for="cat_title">Edit Category</label>


                                <?php

                                if (isset($_GET['edit'])) {
                                
                                $cat_id = escape($_GET['edit']);

                                $query = "SELECT * FROM categories WHERE cat_id = {$cat_id} ";
                                $edit_categories = mysqli_query($connection, $query);

                                while ($row = mysqli_fetch_array($edit_categories)) {
                                
                                $cat_id = $row['cat_id'];
                                $cat_title = $row['cat_title'];

                                ?>

                                <input class="form-control" value="<?php if(isset($cat_title)){echo $cat_title;} ?>" type="text" name="cat_title">

                               <?php }} ?>

                               <?php // UPDATE CATEGORY

                                if (isset($_POST['update_category'])) {

                                    $the_cat_title = escape($_POST['cat_title']);

                                    $stmt = mysqli_prepare($connection, "UPDATE categories SET cat_title = ? WHERE cat_id = ? ");
                                    mysqli_stmt_bind_param($stmt, 'si', $the_cat_title, $cat_id);
                                    mysqli_execute($stmt);


                                    if (!$stmt) {
                                        die("Query failed" . mysqli_error($connection));
                                    }

                                    redirect("categories.php");

                                }

                               ?>


                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="update_category" value="Update category">
                            </div>

                        </form>