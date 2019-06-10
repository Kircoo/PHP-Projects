<?php include "includes/admin_header.php" ?>

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">


                    <h3 class="page-header">
                        <small>Role: <?php echo $_SESSION['user_role']; ?></small>
                            Welcome
                            <?php echo strtoupper(getUsername()); ?>
                        </h3>


                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Author</th>
                                    <th>Comment</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>In response to</th>
                                    <th>Date</th>
                                    <th>Approved</th>
                                    <th>Unapproved</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>

                        <?php

                        $query = "SELECT * FROM comments WHERE comment_post_id =" . mysqli_real_escape_string($connection, $_GET['id']) . "" ;
                        $select_comment_query = mysqli_query($connection, $query);



                        while ($row = mysqli_fetch_array($select_comment_query)) {
                            
                            $comment_id = $row['comment_id'];
                            $comment_post_id = $row['comment_post_id'];
                            $comment_author = $row['comment_author'];
                            $comment_date = $row['comment_date'];
                            $comment_content = $row['comment_content'];
                            $comment_email = $row['comment_email'];
                            $comment_status = $row['comment_status'];

                            echo "<tr>";
                            echo "<td>{$comment_id}</td>";
                            echo "<td>{$comment_author}</td>";
                            echo "<td>{$comment_content}</td>";
                            echo "<td>{$comment_email}</td>";
                            echo "<td>{$comment_status}</td>";
                            
                            $query = "SELECT * FROM posts WHERE post_id = $comment_post_id";
                            $select_post_id_query = mysqli_query($connection, $query);
                            while ($row = mysqli_fetch_array($select_post_id_query)) {
                                
                                $post_id = $row['post_id'];
                                $post_title = $row['post_title'];
                            }

                            echo "<td><a href='../post.php?p_id=$post_id'>{$post_title}</a></td>";
                            echo "<td>{$comment_date}</td>";
                            echo "<td><a href='post_comments.php?approved=$comment_id&id=" . escape($_GET['id']) . "'>Approved</a></td>";
                            echo "<td><a href='post_comments.php?unapproved=$comment_id&id=" . escape($_GET['id']) . "'>Unapproved</a></td>";
                            echo "<td><a href='post_comments.php?delete=$comment_id&id=" . escape($_GET['id']) . "'>Delete</a></td>";
                            echo "</tr>";
                        }

                        ?>

                            </tbody>
                        </table>





                        <?php

                        if (isset($_GET['approved'])) {

                                $the_comment_id = escape($_GET['approved']);

                                $query = "UPDATE comments SET comment_status = 'Approved' WHERE comment_id = $the_comment_id ";
                                $approved_comment_query = mysqli_query($connection, $query);
                                header('location: post_comments.php?id=' . escape($_GET['id']) . '');
                                    
                        }

                        if (isset($_GET['unapproved'])) {

                                $the_comment_id = escape($_GET['unapproved']);

                                $query = "UPDATE comments SET comment_status = 'Unapproved' WHERE comment_id = $the_comment_id ";
                                $unapproved_comment_query = mysqli_query($connection, $query);
                                header('location: post_comments.php?id=' . escape($_GET['id']) . '');
                                    
                        }

                        if (isset($_GET['delete'])) {

                                $the_comment_id = escape($_GET['delete']);

                                $query = "DELETE FROM comments WHERE comment_id = {$the_comment_id}";
                                $delete_comment_query = mysqli_query($connection, $query);
                                header('location: post_comments.php?id=' . escape($_GET['id']) . '');
                                    
                        }

                        ?>


                      </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>


        <!-- /#page-wrapper -->


<?php include "includes/admin_footer.php" ?>