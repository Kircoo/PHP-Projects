<?php session_start(); ?>
<!-- ADMIN HEADER -->
<?php include "includes/admin_header.php" ?>
<!-- END ADMIN HEADER -->

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <?php include "includes/sidebar.php" ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <?php include "includes/navbar.php" ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <?php

          if (isset($_POST['add_sub'])) {

            addSubCategory();

          }

          ?>

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Add Sub-category</h1>

          <div class="row">
            
            <div class="col-md-3">
              
              <form action="" method="post">
                
                <div class="form-group">
                  
                  <label>Name</label>

                  <input type="text" name="subcategory" class="form-control" required="">

                </div>

                <div class="form-group">
                  
                  <label>Category</label>

                  <select class="form-control" name="category">
                    
                    <?php selectCategorySub(); ?>

                  </select>

                </div>

                <div class="form-group">

                  <input class="btn btn-primary btn-sm" type="submit" name="add_sub" value="Add">

                </div>

              </form>

              <?php

              if (isset($_GET['edit'])) {
                
                include "main/edit_subcategory.php";

              }

              ?>

            </div>

            <div class="col-md-9">
              
              <div class="card shadow mb-4">

                <div class="card-header py-3">

                  <h6 class="m-0 font-weight-bold text-primary">Sub-category</h6>

                </div>

                <div class="card-body">

                  <div class="table-responsive">

                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                      <thead>

                        <tr>

                          <th>Id</th>

                          <th>Name</th>

                          <th>Category</th>

                          <th>Edit</th>

                          <th>Delete</th>

                        </tr>

                      </thead>

                      <tbody>

                        <?php

                        selectSubcategory();

                        $i = 1;

                        while ($row = mysqli_fetch_array($result)) {
                          
                          $sub_id = $row['sub_id'];

                          $sub_name = $row['sub_name'];

                          $cat_name = $row['cat_name'];

                          $cat_id = $row['cat_id'];

                        ?>

                        <tr>

                          <td><?php echo $i++; ?></td>

                          <td><?php echo $sub_name ?></td>

                          <td><?php echo $cat_name ?></td>

                          <td><a href="subcategory.php?edit=<?php echo $sub_id; ?>" class="btn btn-sm btn-primary btn-icon-split">
                                <span class="icon text-white-50">
                                  <i class="fas fa-flag"></i>
                                </span>
                                <span class="text">Edit</span>
                              </a>
                          </td>

                          <td><a href="subcategory.php?delete=<?php echo $sub_id; ?>" class="btn btn-danger btn-sm btn-icon-split">
                                <span class="icon text-white-50">
                                  <i class="fas fa-trash"></i>
                                </span>
                                <span class="text">Delete</span>
                              </a>
                          </td>

                        </tr>

                        <?php } ?>

                      </tbody>

                    </table>

                  </div>

                </div>

              </div>

            </div>

          </div>

        </div>
        <!-- /.container-fluid -->

        <?php
        
        deleteSubcategory();

        ?>

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php include "includes/footer.php" ?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

<!-- MAIN FOOTER -->
<?php include "includes/admin_footer.php" ?>
<!-- END MAIN FOOTER -->