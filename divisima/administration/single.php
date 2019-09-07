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

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Single Page</h1>

          <div class="row">
            
            <div class="col-md-3">
              
              <form action="" method="post">
                
                <div class="form-group">
                  
                  <label>Test</label>

                  <input type="text" name="text" class="form-control">

                </div>

                <div class="form-group">

                  <input class="btn btn-primary btn-sm" type="submit" name="submit" value="Add">

                </div>

              </form>

              <?php

              if (isset($_GET['edit'])) {
                
                include "main/single_edit.php";

              }

              ?>

            </div>

            <div class="col-md-9">
              
              <div class="card shadow mb-4">

                <div class="card-header py-3">

                  <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>

                </div>

                <div class="card-body">

                  <div class="table-responsive">

                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                      <thead>

                        <tr>

                          <th>Name</th>

                          <th>Position</th>

                          <th>Office</th>

                          <th>Age</th>

                          <th>Edit</th>

                          <th>Delete</th>

                        </tr>

                      </thead>

                      <tbody>

                        <tr>

                          <td>Donna Snider</td>

                          <td>Customer Support</td>

                          <td>New York</td>

                          <td>27</td>

                          <td><a href="single.php?edit" class="btn btn-sm btn-primary btn-icon-split">
                                <span class="icon text-white-50">
                                  <i class="fas fa-flag"></i>
                                </span>
                                <span class="text">Edit</span>
                              </a>
                          </td>

                          <td><a href="#" class="btn btn-danger btn-sm btn-icon-split">
                                <span class="icon text-white-50">
                                  <i class="fas fa-trash"></i>
                                </span>
                                <span class="text">Delete</span>
                              </a>
                          </td>

                        </tr>

                      </tbody>

                    </table>

                  </div>

                </div>

              </div>

            </div>

          </div>

        </div>
        <!-- /.container-fluid -->

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
