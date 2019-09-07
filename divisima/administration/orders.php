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
          <h1 class="h3 mb-4 text-gray-800">Orders</h1>

          <div class="row">

            <?php 

            selectRows('user', 'user_id');

            while ($row = mysqli_fetch_array($result)) {
              
              $user_id = $row['user_id'];
              $username = $row['username'];
              $user_firstname = $row['user_firstname'];
              $user_lastname = $row['user_lastname'];
              $user_email = $row['user_email'];

              ?>
            
            <div class="col-md-12">
              
              <table class="table table-bordered">
                
                <thead>
                  
                  <tr>
                    
                    <th>Id</th>

                    <th>Username</th>

                    <th>Firstname</th>

                    <th>Lastname</th>

                    <th>Email</th>

                    <th>Adress</th>

                    <th>Country</th>

                    <th>City</th>

                    <th>Zipcode</th>

                    <th>Phone</th>

                    <th>Date</th>

                    <th>Ordered</th>

                    <th>Orders name</th>

                    <th>Total</th>

                  </tr>

                </thead>

                <tbody>
                  
                  <tr>
                    
                    <td><?php echo $user_id ?></td>

                    <td><?php echo $username; ?></td>

                    <td><?php echo $user_firstname; ?></td>

                    <td><?php echo $user_lastname; ?></td>

                    <td><?php echo $user_email; ?></td>

                    <?php

                    $query = "SELECT * FROM orders WHERE o_user_id = $user_id";

                    $order_user_id_query = mysqli_query($db, $query);

                    while ($rows = mysqli_fetch_array($order_user_id_query)) {
                      
                      $o_adress = $rows['o_adress'];
                      $o_city = $rows['o_city'];
                      $o_country = $rows['o_country'];
                      $o_zip = $rows['o_zip'];
                      $o_phone = $rows['o_phone'];
                      $o_date = $rows['o_date'];
                      $ordered = $rows['ordered']

                      ?>

                    <td><?php echo $o_adress; ?></td>

                    <td><?php echo $o_city; ?></td>

                    <td><?php echo $o_country; ?></td>

                    <td><?php echo $o_zip; ?></td>

                    <td><?php echo $o_phone; ?></td>

                    <td>22-02-2019</td>

                    <td>
                      
                      <?php

                      if ($ordered != 'Yes') {

                        echo 'No';

                      } else {

                        echo $ordered;
                      }

                      ?>

                    </td>

                    <?php } ?>

                    <td>

                    <?php

                    $total = 0;

                    $query = "SELECT * FROM cart WHERE user_id = $user_id";

                    $cart_user_query = mysqli_query($db, $query);

                    while ($rowIner = mysqli_fetch_array($cart_user_query)) {
                      
                      $c_name = $rowIner['c_name'];
                      $c_price = $rowIner['c_price'];

                      echo $c_name . '<br>';

                      $total += $c_price;

                    }

                      ?>

                    </td>

                    <td><?php echo $total . ' $'; ?></td>

                  </tr>

                </tbody>

              </table>

            </div>

            <?php } ?>

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
