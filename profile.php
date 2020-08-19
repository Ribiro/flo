<?php
include 'db.php';
include 'includes/header.php';
include 'includes/navbar.php';
?>

<!-- Page info -->
<div class="page-top-info">
    <div class="container">
        <div class="site-pagination">
            <a href="index.php">Home</a> / Profile
        </div>
    </div>
</div>
<!-- Page info end -->
<?php

if(isset($_SESSION['error'])){
    echo "
                                              <div class='alert alert-danger text-center'>
                                              <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                                <p>".$_SESSION['error']."</p> 
                                              </div>
                                            ";
    unset($_SESSION['error']);
}

if(isset($_SESSION['success'])){
    echo "
                                              <div class='alert alert-success text-center'>
                                              <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
                                                <p>".$_SESSION['success']."</p> 
                                              </div>
                                            ";
    unset($_SESSION['success']);
}
?>
<?php
 $sql = "SELECT * FROM users where user_id = $_SESSION[uid]";
 $query = mysqli_query($con, $sql);
 $row = mysqli_fetch_array($query);

?>
<div class="container spad">
    <div class="row">
        <!-- Profile info -->
        <div class="col-lg-6">
            <div class="card shadow mb-4  prof">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Profile info</h6>
                    <button class=" pof float-right"  data-toggle="modal" data-target="#profile"><i class="fa fa-edit"></i> Edit profile</button>
                </div>
                <div class="card-body">
                    <h4 class="small font-weight-bold">Name: </h4>
                    <p><?php echo $row['fname'],' ',$row['lname']?></p>
                    <h4 class="small font-weight-bold">Email: </h4>
                    <p><?php echo $row['email']?></p>
                    <h4 class="small font-weight-bold">Contact: </h4>
                    <p><?php echo $row['contact']?></p>
                    <h4 class="small font-weight-bold">Address: </h4>
                    <p><?php echo $row['address']?></p>

                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3 prof">
                    <h6 class="m-0 font-weight-bold text-primary">Your orders</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>OrderNumber</th>
                                <th>ProductName</th>
                                <th>Quantity(kgs)</th>
                                <th>Amount</th>
                                <th>payment</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $n=0;
                            $n++;
                            $query = mysqli_query($con, "SELECT a.sales_id,a.amount,a.payment,a.quantity,p.product_name FROM sales a ,products p WHERE  a.product_id =p.product_id ") or die(mysqli_error());
                            while($fetch = mysqli_fetch_array($query)){

                                ?>
                                <tr>
                                    <td><?php echo $n++ ?></td>
                                    <td><?php echo $fetch['product_name']?></td>
                                    <td><?php echo $fetch['quantity']?></td>
                                    <td><?php echo $fetch['amount'] ?></td>
                                    <td><?php echo $fetch['payment'] ?></td>

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
    </div>
</div>

    <!-- Edit profile -->
    <div class="modal fade" id="profile">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit profile</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="POST" action="action.php">
                        <div class="form-group">
                            <label for="email" class="col-sm-3 control-label">Email</label>

                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="firstname" class="col-sm-3 control-label">Firstname</label>

                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="firstname" name="fname" value="<?php echo $row['fname']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lastname" class="col-sm-3 control-label">Lastname</label>

                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="lastname" name="lname" value="<?php echo $row['lname']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lastname" class="col-sm-3 control-label">Contact</label>

                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="contact" name="contact" value="<?php echo $row['contact']; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="lastname" class="col-sm-3 control-label">Address</label>

                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="address" name="address" value="<?php echo $row['address']; ?>">
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                    <button type="submit" class="btn btn-success btn-flat" name="editprof"><i class="fa fa-check-square-o"></i> Save</button>
                    </form>

                </div>

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Change password</h5>
                </div>
                <br>
                <form action="action.php" method="post">
                    <div class="form-group">
                        <label for="password" class="col-sm-3 control-label">Current Password</label>

                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-sm-3 control-label">New Password</label>

                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="password" name="newpassword">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="col-sm-3 control-label">Confirm New Password</label>

                        <div class="col-sm-9">
                            <input type="password" class="form-control" id="password" name="renewpassword">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                        <button type="submit" class="btn btn-success btn-flat" name="changepass"><i class="fa fa-check-square-o"></i> Save</button>
                </form>
            </div>
        </div>
    </div>
    </div>

<?php
include 'includes/footer.php';
include 'includes/scripts.php';