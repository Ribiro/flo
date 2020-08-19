<?php
include 'db.php';
include 'includes/header.php';
include 'includes/navbar.php';

?>
<!-- Page info -->
<div class="page-top-info">
    <div class="container">
        <div class="site-pagination">
            <a href="index.php">Home</a> / Products
        </div>
    </div>
</div>
<!-- Page info end -->
<!-- Products section -->
<section class="category-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 order-2 order-lg-1">
                <div class="filter-widget">
                    <h2 class="fw-title">Categories</h2>
                    <?php
                    $query = mysqli_query($con, "SELECT * FROM category") or die(mysqli_error());
                    while($fetch = mysqli_fetch_array($query)){
                        $id = $fetch['id'];
                        $name = $fetch['name'];

                        echo" 
                            <ul class=\"category-menu\">
                                <li><a href=\"category.php?id=$id\">$name</a></li>
                            </ul>

                            ";
                        ?>

                        <?php
                    }
                    ?>
                </div>
            </div>


                    <?php
                    if (isset($_GET['page_no']) && $_GET['page_no']!=""){
                        $page_no = $_GET['page_no'];
                        } else {
                            $page_no = 1;
                            }
                    $total_records_per_page = 6;
                    $offset = ($page_no-1) * $total_records_per_page;
                    $previous_page = $page_no - 1;
                    $next_page = $page_no + 1;
                    $adjacents = "2";

                    $result_count = mysqli_query($con,"SELECT COUNT(*) As total_records FROM `products`");
                    $total_records = mysqli_fetch_array($result_count);
                    $total_records = $total_records['total_records'];
                    $total_no_of_pages = ceil($total_records / $total_records_per_page);
                    $second_last = $total_no_of_pages - 1; // total page minus 1
                    ?>
            <div class="col-lg-9  order-1 order-lg-2 mb-5 mb-lg-0">
                <div style='padding: 10px 20px 0px; '>
                    <strong>Page <?php echo $page_no." of ".$total_no_of_pages; ?></strong>
                    <br><br>
                </div>
                <div class="row">

                    <?php


                    $sql = mysqli_query($con, "SELECT * FROM products  LIMIT $offset, $total_records_per_page");
                    while($row = mysqli_fetch_array($sql)){
                        $proid = $row['product_id'];
                        $proname = $row['product_name'];
                        $photo = $row['photo'];
                        $price = $row['price'];

                        echo "
                            <div class=\"col-lg-4 col-sm-6\">
                                <a href=\"product.php?id=$proid\">
                                    <div class=\"product-item\">
                                        <div class=\"pi-pic\">
                                            <img src=\"images/$photo\" alt=\"\" style='height: 400px; width: 500px;' '>
                                            
                                        </div>
                                        <div class=\"pi-text\">
                                            <h6>Ksh $price</h6>
                                            <p>$proname</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            ";
                    }
                    ?>

                </div>
                <div style='padding: 10px 20px 0px; '>
                    <strong>Page <?php echo $page_no." of ".$total_no_of_pages; ?></strong>
                    <br><br>
                    <ul class="pagination">
                        <?php // if($page_no > 1){ echo "<li><a href='?page_no=1'>First Page</a></li>"; } ?>


                            <a <?php if($page_no > 1){ echo "href='?page_no=$previous_page'"; } ?>>
                                <li <?php if($page_no <= 1){ echo "class='disabled'"; } ?>>&lsaquo;&lsaquo; </li>
                            </a>


                        <?php
                        if ($total_no_of_pages <= 10){
                            for ($counter = 1; $counter <= $total_no_of_pages; $counter++){
                                if ($counter == $page_no) {
                                    echo "<li class='active'><a>$counter</a></li>";
                                }else{
                                    echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                                }
                            }
                        }
                        elseif($total_no_of_pages > 10){

                            if($page_no <= 4) {
                                for ($counter = 1; $counter < 8; $counter++){
                                    if ($counter == $page_no) {
                                        echo "<li class='active'><a>$counter</a></li>";
                                    }else{
                                        echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                                    }
                                }
                                echo "<li><a>...</a></li>";
                                echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
                                echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
                            }

                            elseif($page_no > 4 && $page_no < $total_no_of_pages - 4) {
                                echo "<li><a href='?page_no=1'>1</a></li>";
                                echo "<li><a href='?page_no=2'>2</a></li>";
                                echo "<li><a>...</a></li>";
                                for ($counter = $page_no - $adjacents; $counter <= $page_no + $adjacents; $counter++) {
                                    if ($counter == $page_no) {
                                        echo "<li class='active'><a>$counter</a></li>";
                                    }else{
                                        echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                                    }
                                }
                                echo "<li><a>...</a></li>";
                                echo "<li><a href='?page_no=$second_last'>$second_last</a></li>";
                                echo "<li><a href='?page_no=$total_no_of_pages'>$total_no_of_pages</a></li>";
                            }

                            else {
                                echo "<li><a href='?page_no=1'>1</a></li>";
                                echo "<li><a href='?page_no=2'>2</a></li>";
                                echo "<li><a>...</a></li>";

                                for ($counter = $total_no_of_pages - 6; $counter <= $total_no_of_pages; $counter++) {
                                    if ($counter == $page_no) {
                                        echo "<li class='active'><a>$counter</a></li>";
                                    }else{
                                        echo "<li><a href='?page_no=$counter'>$counter</a></li>";
                                    }
                                }
                            }
                        }
                        ?>

                        <li <?php if($page_no >= $total_no_of_pages){ echo "class='disabled'"; } ?>>
                            <a <?php if($page_no < $total_no_of_pages) { echo "href='?page_no=$next_page'"; } ?>> &rsaquo;&rsaquo;</a>
                        </li>
                        <?php if($page_no < $total_no_of_pages){
                            echo "<li><a href='?page_no=$total_no_of_pages'>Last </a></li>";
                        } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Products section end -->
<?php
include 'includes/footer.php';
include 'includes/scripts.php';