<?php
include 'db.php';
include 'includes/header.php';
include 'includes/sidebar.php';
include 'includes/navbar.php';
include 'includes/scripts.php';

?>
<div class="container-fluid">
    <h3 class="mt-4 text-gray-600">Dashboard</h3>
</div>
<br>

<div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Users</div>
                    <?php
                    $query = "SELECT COUNT(*) AS count_item FROM users";
                    $query_run = mysqli_query($con,$query);
                    $row = mysqli_fetch_array($query_run);
                    $count = $row["count_item"];

                    ?>
                  <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count?></div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-user fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Vendors</div>
                    <?php
                    $query = "SELECT COUNT(*) AS count_item FROM vendor";
                    $query_run = mysqli_query($con,$query);
                    $row = mysqli_fetch_array($query_run);
                    $count = $row["count_item"];

                    ?>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count?></div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-user fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-info text-uppercase mb-1">category</div>
                    <?php
                    $query = "SELECT COUNT(*) AS count_item FROM category";
                    $query_run = mysqli_query($con,$query);
                    $row = mysqli_fetch_array($query_run);
                    $count = $row["count_item"];

                    ?>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count?></div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
          <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Products</div>
                    <?php
                    $query = "SELECT COUNT(*) AS count_item FROM products";
                    $query_run = mysqli_query($con,$query);
                    $row = mysqli_fetch_array($query_run);
                    $count = $row["count_item"];

                    ?>
                    <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count?></div>
                </div>
                <div class="col-auto">
                  <i class="fas fa-comments fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">

        <div class="col-lg-10">
          <!-- Tasks -->
          <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-success">Tasks</h6>
              </div>
              <div class="container-fluid bg-white">
                  <div class="row py-3 mb-4 task-border align-items-center">
                        <div class="col-1">
                            <input type="checkbox">
                        </div>
                        <div class="col-sm-9 col-8">
                            Check products ordered
                        </div>
                        <div class="col-1">
                            <a href="#" data-toggle="tooltip" title="edit" data-html="true" data-placement="top"><i class="fas fa-edit fa-lg text-success mr-2"></i></a>
                        </div>
                        <div class="col-1">
                            <a href="#" data-toggle="tooltip" title="delete" data-html="true" data-placement="top"><i class="fas fa-trash-alt fa-lg text-danger"></i></a>
                        </div>
                  </div>
              </div>

              <div class="container-fluid bg-white">
                <div class="row py-3 mb-4 task-border align-items-center">
                    <div class="col-1">
                        <input type="checkbox">
                    </div>
                    <div class="col-sm-9 col-8">
                        Analyze orders
                    </div>
                    <div class="col-1">
                        <a href="#" data-toggle="tooltip" title="edit" data-html="true" data-placement="top"><i class="fas fa-edit fa-lg text-success mr-2"></i></a>
                    </div>
                    <div class="col-1">
                        <a href="#" data-toggle="tooltip" title="delete" data-html="true" data-placement="top"><i class="fas fa-trash-alt fa-lg text-danger"></i></a>
                    </div>
                </div>
              </div>

          </div>
        </div>

      </div>