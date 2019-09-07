<div class="row">
  
  <div class="col-md-12">
  	
  	    <div class="card shadow mb-4">

            <div class="card-header py-3">

              <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6><br>

              <a href="product.php?source=add_product" class="btn btn-sm btn-success btn-icon-split">

                    <span class="icon text-white-50">

                      <i class="fas fa-check"></i>

                    </span>

                    <span class="text">Add product</span>
              </a>

            </div>

            <div class="card-body">

              <div class="table-responsive">

                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                  <thead>

                    <tr>

                      <th>Id</th>

                      <th>Sub-category</th>

                      <th>Name</th>

                      <th>Price</th>

                      <th>Stock</th>

                      <th>Info</th>

                      <th>Image 1</th>

                      <th>Image 2</th>

                      <th>Image 3</th>

                      <th>Image 4</th>

                      <th>Edit</th>

                      <th>Delete</th>

                    </tr>

                  </thead>

                  <tbody>

                    <?php

                    selectProducts();

                    $i = 1;

                    while ($row = mysqli_fetch_array($result)) {
                          
                          $p_id = $row['p_id'];
                          $p_sub_id  = $row['p_sub_id'];
                          $p_name = $row['p_name'];
                          $p_price = $row['p_price'];
                          $p_stock = $row['p_stock'];
                          $p_info = substr($row['p_info'],0,40);
                          $p_img1 = $row['p_img1'];
                          $p_img2 = $row['p_img2'];
                          $p_img3 = $row['p_img3'];
                          $p_img4 = $row['p_img4'];
                          $sub_id = $row['sub_id'];
                          $sub_name = $row['sub_name'];
                    ?>
                       

                    <tr>

                      <td><?php echo $i++; ?></td>

                      <td><?php echo $sub_name ?></td>

                      <td><?php echo $p_name; ?></td>

                      <td><?php echo $p_price; ?></td>

                      <td><?php echo $p_stock; ?></td>

                      <td><?php echo $p_info; ?> ...</td>

                      <td><img height="50px" width="100px" src="./img/products/<?php echo $p_img1 ?>"></td>

                      <td><img height="50px" width="100px" src="./img/products/<?php echo $p_img2 ?>"></td>

                      <td><img height="50px" width="100px" src="./img/products/<?php echo $p_img3 ?>"></td>

                      <td><img height="50px" width="100px" src="./img/products/<?php echo $p_img4 ?>"></td>

                      <td><a href="product.php?source=edit_product&p_id=<?php echo $p_id; ?>" class="btn btn-sm btn-primary btn-icon-split">
                            <span class="icon text-white-50">
                              <i class="fas fa-flag"></i>
                            </span>
                            <span class="text">Edit</span>
                          </a>
                      </td>

                      <td><a href="product.php?delete=<?php echo $p_id; ?>" class="btn btn-danger btn-sm btn-icon-split">
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

          <?php

          deleteProduct();

          ?>

  </div>

</div>