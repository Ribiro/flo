<?php
session_start();
include 'includes/header.php';

?>
    <div class="container" >
        <div class="row justify-content-center">
            <div class=" col-xl-6">
                <div class="card-hidden border-0 shadow-lg my-5">
                    <div class="card-body  p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4"> Create an Account!</h1>
                                    </div>
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
                                    <form class="user" action="action.php" method="post">
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="text" class="form-control form-control-user" id="FirstName" name="firstname" placeholder="First Name">
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control form-control-user" id="LastName" name="lastname" placeholder="Last Name">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" id="Email" name="email" placeholder="Email Address">
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="password" class="form-control form-control-user" id="Password" name="password" placeholder="Password">
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="password" class="form-control form-control-user" id="RepeatPassword" name="repassword" placeholder="Confirm Password">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="text" class="form-control form-control-user" id="address" name="address" placeholder="Address">
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="number" class="form-control form-control-user" id="contact" name="contact" placeholder="Contact">
                                            </div>
                                        </div>
                                        <input type="submit" value="Register" name="register" class="btn btn-primary btn-user btn-block">


                                    </form>
                                    <hr>

                                    <div class="text-center">
                                        <a class="" href="login.php">Already have an account? Login!</a>
                                    </div>
                                    <hr>
                                    <div class="text-center">
                                        <a class="" href="index.php">Home</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
<?php
include 'includes/scripts.php';
