<!-- Header section -->
<header class="header-section">
    <div class="header-top">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 text-center text-lg-left">
                    <!-- logo -->
                    <a href="index.php" class="site-logo">
                        <h3><span>Farmers</span>store</h3>
                    </a>
                </div>
                <div class="col-xl-6 col-lg-5">


                </div>
                <div class="col-xl-4 col-lg-5">
                    <div class="user-panel">
                        <?php
                        session_start();
                        if (isset($_SESSION["uid"])){
                            echo '
                             <div class="up-item">
                                <ul class="nav-menu">
                                    <li><a href="#"><i class="flaticon-profile"></i> Hi, '.$_SESSION["name"].'</a>
                                        <ul class="menu-sub">
                                            <li><a href="profile.php">Profile</a></li>
                                            <li><a href="" data-toggle="modal" data-target="#logout">Logout</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                            ';
                        }
                        else{
                            echo'
                            <div class="up-item">
                                <i class="flaticon-profile"></i>
                                <a href="login.php">Sign In</a> or <a href="signup.php">Create Account</a>
                            </div>
                            ';
                        }
                        ?>

                        <?php
                        include 'db.php';
                        if (isset($_SESSION['uid'])){
                            $sql = "SELECT COUNT(*) AS count_item FROM cart WHERE user_id = $_SESSION[uid]";
                            $query = mysqli_query($con,$sql);
                            $row = mysqli_fetch_array($query);
                            $count = $row["count_item"];
                            echo "
                                <div class=\"up-item\">
                                    <div class=\"shopping-card\">
                                        <i class=\"flaticon-bag\"></i>
                                        <span>$count</span>
                                    </div>
                                    <a href=\"cart.php\">Cart</a>
                                </div>
                                    ";
                        }
                        else{
                            echo "
                                 <div class=\"up-item\">
                                    <div class=\"shopping-card\">
                                        <i class=\"flaticon-bag\"></i>
                                        <span>0</span>
                                    </div>
                                    <a href=\"sign.php\">Cart</a>
                                </div>
                                    ";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <nav class="main-navbar">
        <div class="container">
            <!-- menu -->
            <ul class="main-menu">
                <li><a href="index.php">Home</a></li>
                <li><a href="products.php">Products</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="about.php">About</a></li>
                <!--
                <li><a href="#">Trending
                        <span class="new">New</span>
                    </a>
                </li>
                -->
                <li><a href="category.php?id=1">Categories</a>
            </ul>
        </div>
    </nav>
</header>

<!-- Header section end -->

<!-- Logout Modal-->
<div class="modal fade" id="logout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <form action="action.php" method="post">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit" name="logout">Logout</button>
                </form>

            </div>
        </div>
    </div>
</div>