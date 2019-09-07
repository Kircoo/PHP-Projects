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

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Products</h1>

          <?php

          if (isset($_GET['source'])) {
            
            $source = $_GET['source'];

          } else {

            $source = '';
          }


          switch ($source) {
            case 'add_product':
              include "main/add_product.php";
              break;

              case 'edit_product':
              include "main/edit_product.php";
              break;
            
            default:
              include "main/view_all_products.php";
              break;
          }


          ?>

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