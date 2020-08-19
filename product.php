<?php
include 'db.php';
include 'includes/header.php';
include 'includes/navbar.php';
?>
<?php
$proid = $_GET['id'];
$query = mysqli_query($con, "SELECT * FROM products WHERE product_id = $proid") or die(mysqli_error());
$fetch = mysqli_fetch_array($query);
$proname = $fetch['product_name'];
$catid = $fetch['category_id'];
$price = $fetch['price'];
$photo = $fetch['photo'];
?>
    <!-- Page info -->
    <div class="page-top-info">
        <div class="container">
            <div class="site-pagination">
                <?php
                $sql = mysqli_query($con,"SELECT * FROM category WHERE id = $catid") or die(mysqli_error());
                $row = mysqli_fetch_array($sql);
                $catname = $row['name'];
                echo"
                    <a href=\"index.php\">Home</a> /
                    <a href=\"category.php?id=$catid\">$catname</a> /  $proname 
                "
                ?>

            </div>
        </div>
    </div>
    <!-- Page info end -->

    <!-- product section -->
    <section class="product-section">
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
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="product-pic-zoom">
                        <img class="product-big-img" src="images/<?php echo $photo ?>" alt="">
                    </div>

                </div>
                <div class="col-lg-6 product-details">
                    <h2 class="p-title"><?php echo $proname ?></h2>
                    <h3 class="p-price">Ksh <?php echo $price ?></h3>
                    <h4 class="p-stock">Available: <span>In Stock</span></h4>
                    <div class="p-rating">
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o"></i>
                        <i class="fa fa-star-o fa-fade"></i>
                    </div>
                    <div class="p-review">
                        <a href="">3 reviews</a>|<a href="">Add your review</a>
                    </div>
                    <form action="action.php" method="post">
                        <div class="quantity">
                            <p>Quantity(kgs)</p>
                            <div class="pro-qty">
                                <input type="hidden" name="id" value="<?php echo $proid ?>">
                                <input type="text" name="quantity" value="1">
                            </div>
                        </div>
                        <button type="submit" name="addtocart" class="site-btn">ADD TO CART</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- product section end -->

<?php
include 'includes/footer.php';
include 'includes/scripts.php';
