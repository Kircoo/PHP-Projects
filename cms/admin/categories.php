<?php include "includes/admin_header.php" ?>

<?php if(!is_admin()){
        redirect('index.php');
    } 
    ?>


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

                        <div class="col-xs-6">



                            <?php insertCategory(); ?>


                        <form method="post">
                            
                            <div class="form-group">
                                <label for="cat_title">Add Category</label>
                                <input class="form-control" type="text" name="cat_title">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary" type="submit" name="submit" value="Add category">
                            </div>

                        </form>

                        <?php // UPDATE AND INCLUDE CATEGORIES

                        if (isset($_GET['edit'])) {
                            
                            $cat_id = escape($_GET['edit']);

                            include 'includes/update_categories.php';

                        }

                        ?>


                        </div> <!-- Add form category -->

                        <div class="col-xs-6">

                            <table class="table table-bordered">
                                <thead>
                                    <tr style="font-weight: 700">
                                        <td>Id</td>
                                        <td>Category Title</td>
                                    </tr>
                                </thead>
                                <tbody>


                                <?php showAllCategories(); // FIND ALL CATEGORIES ?>

                                <?php deleteCategories(); // DELETE CATEGORIES ?>


                                </tbody>
                            </table>

                        </div>



                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>


        <!-- /#page-wrapper -->


<?php include "includes/admin_footer.php" ?>