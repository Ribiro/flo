<?php
include 'db.php';
include 'includes/header.php';
include 'includes/navbar.php';

?>

<!-- Hero section -->
	<section class="hero-section">
		<div class="hero-slider owl-carousel">
			<div class="hs-item set-bg" data-setbg="img/s3.jpg">
				<div class="container">
					<div class="row">
						<div class="col-xl-6 col-lg-7 text-white">
							<h2>Welcome to farmerstore.</h2>
						</div>
					</div>
				</div>
			</div>
			<div class="hs-item set-bg" data-setbg="img/s4.jpg">
				<div class="container">
					<div class="row">
						<div class="col-xl-6 col-lg-7 text-white">
							<h2>The ultimate farmers choice.</h2>
						</div>
					</div>
				</div>
            </div>
		</div>
		<div class="container">
			<div class="slide-num-holder" id="snh-1"></div>
		</div>
	</section>
	<!-- Hero section end -->
    <!-- letest product section end -->
    <!-- Product filter section -->
    <section class="product-filter-section">
        <div class="container">
            <div class="section-title">
                <h2>FEATURED PRODUCTS</h2>
            </div>

            <div class="row">
                <?php
                $query = mysqli_query($con, "SELECT * FROM products LIMIT 8") or die(mysqli_error());
                while($fetch = mysqli_fetch_array($query)){

                    ?>
                <div class="col-lg-3 col-sm-6">
                    <a href="product.php?id=<?php echo $fetch['product_id'] ?>">
                        <div class="product-item">
                            <div class="pi-pic">
                                <img src="images/<?php echo $fetch['photo'] ?>" alt="" style="height: 400px; width: 500px">

                            </div>
                            <div class="pi-text">
                                <h6>Ksh <?php echo $fetch['price'] ?></h6>
                                <p><?php echo $fetch['product_name'] ?></p>
                            </div>
                        </div>
                    </a>
                </div>
                    <?php

                }
                    ?>

            </div>
            <div class="text-center pt-5">
                <a href="products.php">
                    <button class="site-btn sb-line sb-dark">LOAD MORE</button>
                </a>
            </div>
        </div>
    </section>
    <!-- Product filter section end -->




<?php
include 'includes/footer.php';
include 'includes/scripts.php';