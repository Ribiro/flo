<?php
include 'db.php';
include 'includes/header.php';
include 'includes/navbar.php';
?>

<!-- Page info -->
<div class="page-top-info">
    <div class="container">
        <div class="site-pagination">
            <a href="index.php">Home</a> /
            <a href="cart.php">Cart</a> / Checkout
        </div>
    </div>
</div>
<!-- Page info end -->
<!-- checkout section  -->
<section class="checkout-section spad">
    <?php
    $sql = "SELECT * FROM users where user_id = $_SESSION[uid]";
    $query = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($query);

    ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-4 order-1 order-lg-2">
                <div class="checkout-cart">
                    <h3>Your Cart</h3>
                    <ul class="product-list">
                        <?php
                        $sql = "SELECT a.product_id,a.product_name,a.price,a.photo,b.cart_id,b.quantity  FROM products a,cart b WHERE a.product_id=b.product_id AND b.user_id='$_SESSION[uid]'";
                        $query = mysqli_query($con,$sql);
                        $total_price=0;
                        while($fetch = mysqli_fetch_array($query)){
                            $product_price = $fetch['price'];
                            $product=$fetch['product_id'];
                            $quantity = $fetch['quantity'];
                            $subtotal = $product_price * $quantity;
                            $total_price = $total_price+$subtotal;
                            ?>
                            <li>
                                <div class="pl-thumb"><img src="images/<?php echo $fetch['photo']?>" alt=""></div>
                                <h6><?php echo $fetch['product_name']?> (<?php echo $quantity?> kgs)</h6>
                                <p>Ksh <?php echo $fetch['price']?></p>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                    <div class="total-cost">
                        <h6>Total <span>Ksh <?php echo $total_price ?></span></h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 order-2 order-lg-1">

                    <div class="cf-title">Billing Address</div>
                    <div class="row">
                        <div class="col-md-7">
                            <p>*Billing Information</p>
                        </div>
                    </div>
                <form class="checkout-form" action="action.php" method="post">
                    <div class="row address-inputs">
                        <div class="col-md-6">
                            <label>First name</label>
                            <?php
                            $sql = "SELECT a.product_id,a.product_name,a.price,a.photo,b.cart_id,b.quantity  FROM products a,cart b WHERE a.product_id=b.product_id AND b.user_id='$_SESSION[uid]'";
                            $query = mysqli_query($con,$sql);
                            $total_price=0;
                            $fetch = mysqli_fetch_array($query);
                                $product_price = $fetch['price'];
                                $product=$fetch['product_id'];
                                $quantity = $fetch['quantity'];
                                $subtotal = $product_price * $quantity;
                                $total_price = $total_price+$subtotal;
                                ?>
                            <input type="hidden" name="pid" value="<?php echo $product?>">
                            <input type="hidden" name="quantity" value="<?php echo $quantity?>">
                            <input type="hidden" name="amount" value="<?php echo $total_price?>">
                            <input type="hidden" value="<?php echo $row['user_id']?>">
                            <input type="text" placeholder="First name" value="<?php echo $row['fname']?>" >
                        </div>
                        <div class="col-md-6">
                            <label>Last name</label>
                            <input type="text" placeholder="Last name" value="<?php echo $row['lname']?>">
                        </div>
                        <div class="col-md-12">
                            <label>Email</label>
                            <input type="text" placeholder="Email" value="<?php echo $row['email']?>">
                            <label>Shipping address</label>
                            <input type="text" placeholder="Shipping Address" value="<?php echo $row['address']?>">
                            <label>Phone no.</label>
                            <input type="text" placeholder="Phone no." value="<?php echo $row['contact']?>">
                        </div>

                    </div>
                    <div class="cf-title">Payment</div>
                    <div class="row shipping-btns">
                        <div class="col-6">
                            <div class="cf-radio-btns">
                                <div class="cfr-item">
                                    <input type="radio" name="shipping" id="ship-1" value="cod">
                                    <label for="ship-1">Cash on delivery</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="cf-radio-btns">
                                <div class="cfr-item">
                                    <input type="radio" name="shipping" id="ship-2" value="mpesa">
                                    <label for="ship-2">mpesa</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" name="order" class="site-btn submit-order-btn">Place Order</button>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- checkout section end -->
<?php
include 'includes/footer.php';
include 'includes/scripts.php';