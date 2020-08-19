<?php
include 'db.php';
include 'includes/header.php';
include 'includes/navbar.php';


?>

<!-- Page info -->
<div class="page-top-info">
    <div class="container">
        <div class="site-pagination">
            <a href="index.php">Home</a> / Cart
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
<!-- cart section end -->
<section class="cart-section spad">

    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="cart-table">
                    <h3>Your Cart</h3>
                    <div class="cart-table-warp">
                        <table>
                            <thead class="t-head">
                            <tr>
                                <th class="product-th">Product</th>
                                <th class="quy-th">Quantity(kgs)</th>
                                <th class="total-th">Price</th>
                                <th class="act-th">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $sql = "SELECT a.product_id,a.product_name,a.price,a.photo,b.user_id,b.cart_id,b.quantity FROM products a,cart b WHERE a.product_id=b.product_id AND b.user_id='$_SESSION[uid]'";
                            $query = mysqli_query($con,$sql);
                            $total_price=0;
                            while($fetch = mysqli_fetch_array($query)){
                                $product_price = $fetch['price'];
                                $quantity = $fetch['quantity'];
                                $subtotal = $product_price * $quantity;
                                $total_price = $total_price+$subtotal;
                                ?>
                            <tr>
                                <td class="product-col">
                                    <img src="images/<?php echo $fetch['photo']?>" alt="">
                                    <div class="pc-title">
                                        <h4><?php echo $fetch['product_name']?></h4>
                                        <p>Ksh <?php echo $fetch['price']?></p>
                                    </div>
                                </td>
                                <form action="action.php" method="post">
                                    <td class="quy-col">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input type="hidden" name="id" value="<?php echo $fetch['product_id'] ?>">
                                                <input type="text" name="quantity" value="<?php echo $fetch['quantity']?>">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="total-col"><h4>Ksh <?php echo $total_price ?> </h4></td>
                                    <td class="action-col">
                                        <button type="submit" name="update" title="refresh" class=" btn bg-primary">
                                            <i class="flaticon-refresh"></i>
                                        </button>
                                        <button type="submit" name="delete" title="delete" class="btn  bg-danger">
                                            <i class="flaticon-cancel-1"></i>
                                        </button>
                                    </td>
                                </form>
                            </tr>
                            <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="total-cost">
                        <h6>Total <span>Ksh <?php echo $total_price ?></span></h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 card-right">
                <form class="promo-code-form">
                    <input type="text" placeholder="Enter promo code">
                    <button>Submit</button>
                </form>
                <a href="checkout.php" class="site-btn">Proceed to checkout</a>
                <a href="products.php" class="site-btn sb-dark">Continue shopping</a>
            </div>
        </div>
    </div>
</section>
<!-- cart section end -->


<?php
include 'includes/footer.php';
include 'includes/scripts.php';
