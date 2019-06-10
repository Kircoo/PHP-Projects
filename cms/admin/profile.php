<?php include "includes/admin_header.php" ?>

<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>

<?php

if (isset($_SESSION['username'])) {
   
        $username = escape($_SESSION['username']);

        $query = "SELECT * FROM users WHERE username = '{$username}'";
        $select_session_username = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_array($select_session_username)) {
        
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];

        }

    }

?>

<!-- Navigation -->
<?php include "includes/admin_navigation.php" ?>

<?php

    if (isset($_POST['update_profile'])) {
        
            $user_password = escape($_POST['password']);
            $user_firstname = escape($_POST['firstname']);
            $user_lastname = escape($_POST['lastname']);
            $user_email = escape($_POST['email']);

            $user_image = $_FILES['user_image']['name'];
            $user_image_temp = $_FILES['user_image']['tmp_name'];

            move_uploaded_file($user_image_temp, "../images/$user_image");

            if (!empty($user_password)) {
        
            $query_password = "SELECT user_password FROM users WHERE user_id = $user_id";
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
            $query .= "user_email = '{$user_email}', ";
            $query .= "user_firstname = '{$user_firstname}', ";
            $query .= "user_lastname = '{$user_lastname}', ";
            $query .= "user_image = '{$user_image}' ";
            $query .= "WHERE user_id = '{$user_id}' ";

            $update_user_query = mysqli_query($connection, $query);

            confirmQuery($update_user_query);
    }

    if (empty($user_image)) {
        $query = "SELECT * FROM users WHERE user_id = " . loggedInUserId() . "";
        $select_user_image = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_array($select_user_image)) {
            
            $user_image = $row['user_image'];
        }
    }

    deleteUser();

?>

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

                        <form method="post" enctype="multipart/form-data">
    
                            <div class="col-md-6">
                                <div class="form-group">
                                    
                                    <label>Username</label>
                                    <input class="form-control" type="text" value="<?php echo $username ?>" name="username" disabled>

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
                                    
                                <img width="100" src="../images/<?php echo imagePlaceholderUser($user_image); ?>">
			                    <input type="file" name="user_image" >

                                </div>

                                <div class="form-group">
                                    
                                    <label>Email address</label>
                                    <input class="form-control" type="email" value="<?php echo $user_email ?>" name="email">

                                </div>

                                <div class="form-group">
                                    
                                    <input class="btn btn-primary" value="Update profile" type="submit" name="update_profile">

                                    <input onClick="javascript: return confirm('Are you sure you want to delete your profile?');" class="btn btn-danger" value="Delete profile" type="submit" name="delete_profile">

                                </div>
                            </div>

                        </form>

                    </div>

                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>

        <!-- /#page-wrapper -->

<?php include "includes/admin_footer.php" ?>