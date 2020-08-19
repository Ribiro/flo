<?php
include 'db.php';
include 'includes/header.php';
include 'includes/sidebar.php';
include 'includes/navbar.php';
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <div class="container-fluid">
        <h3 class="mt-4 text-gray-600">Featured orders</h3>
    </div>
    <br>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Orders</h6>
            <button class=" float-right" data-toggle="modal" data-target="#addOrder"><i class="fa fa-plus"></i> Add order</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>OrderNumber</th>
                        <th>Customer Name</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Amount</th>
                        <th>Payment</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $sql = mysqli_query($con, "SELECT a.sales_id,a.amount,a.payment,a.quantity,p.product_name,c.email FROM sales a ,products p,users c WHERE  a.product_id =p.product_id AND a.user_id=c.user_id") or die(mysqli_error());
                    while($fetch = mysqli_fetch_array($sql)){
                        ?>
                        <tr>
                            <td><?php echo $fetch['sales_id']?></td>
                            <td><?php echo $fetch['email']; ?></td>
                            <td><?php echo $fetch['product_name']?></td>
                            <td><?php echo $fetch['quantity']?></td>
                            <td><?php echo $fetch['amount']?></td>
                            <td><?php echo $fetch['payment']?></td>

                        </tr>
                        <?php
                    }
                    ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
<?php

include 'includes/scripts.php';
include 'includes/modal.php';