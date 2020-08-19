<?php
session_start();
include 'db.php';



//add product
if (isset($_POST['addProduct'])){
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $vendor = $_POST['id'];
    // Get image name
    $image = $_FILES['image']['name'];

    // image file directory
    $target = "../images/".basename($image);

    $sql = "INSERT INTO products (`product_id`, `category_id`,`product_name`,`vendor_id`,`price`,`photo`) VALUES(NULL,'$category','$name','$vendor','$price','$image') ";
    $query = mysqli_query($con,$sql);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $_SESSION['success'] = "Image uploaded successfully";
        header('location:index.php');
    }else {
        $_SESSION['error'] = "Failed to upload image";
        header('location:index.php');
    }
    if ($query){
        $_SESSION['success']='Product added successfully';
        header('location:index.php');
    }
    else{
        $_SESSION['error']='Product not added successfully';
        header('location:index.php');
    }
}

//edit product
if (isset($_POST['editProduct'])){
    $id = $_POST['id'];
    $name = $_POST['name'];
    $category = $_POST['category'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $minsize = $_POST['sizemin'];
    $maxsize = $_POST['sizemax'];
    // Get image name
    $image = $_FILES['image']['name'];

    // image file directory
    $target = "../images/".basename($image);

    $sql = "UPDATE products SET `category_id`= '$category',`product_name` = '$name',`description` = '$description',`price` = '$price',`photo` = '$image',`sizemin` = '$minsize', `sizemax` = '$maxsize' WHERE product_id = '$id' ";
    $query = mysqli_query($con,$sql);

    if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
        $_SESSION['success'] = "Image uploaded successfully";
        header('location:index.php');
    }else {
        $_SESSION['error'] = "Failed to upload image";
        header('location:index.php');
    }
    if ($query){
        $_SESSION['success']='Product updated successfully';
        header('location:index.php');
    }
    else{
        $_SESSION['error']='Product not updated';
        header('location:index.php');
    }
}

//register vendor
if (isset($_POST['registerv'])) {
    $first = $_POST['firstname'];
    $last = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];

    $date = date('Y-m-d');

    if (empty($first) || empty($last) || empty($email) || empty($password) || empty($repassword) || empty($address) || empty($contact)) {
        $_SESSION['error'] = 'Please fill in the form';
        header('location: register.php');

    } else {
        if (strlen($password) < 8) {
            $_SESSION['error'] = 'Password is weak';
            header('location: register.php');
            exit;
        }
        if ($password != $repassword) {
            $_SESSION['error'] = 'Passwords dont match';
            header('location: register.php');
            exit;
        }

        //existing email address in our database
        $sql = "SELECT vendor_id FROM vendor WHERE email = '$email' LIMIT 1";
        $check_query = mysqli_query($con, $sql);
        $count_email = mysqli_num_rows($check_query);
        if ($count_email > 0) {
            $_SESSION['error'] = 'Email already exists, <a href="sign.php">login</a> instead';
            header('location:register.php');

        } else {

            $sql = "INSERT INTO `vendor` 
		(`vendor_id`, `fname`, `lname`, `email`, 
		`password`,`address`,`contact`,`created_on`) 
		VALUES (NULL, '$first', '$last', '$email', 
		'$password','$address','$contact','$date')";
            $run_query = mysqli_query($con, $sql);
            $_SESSION["uid"] = mysqli_insert_id($con);
            $_SESSION["name"] = $first;

            $ip_add = getenv("REMOTE_ADDR");
            if ($run_query) {

                header('location: sign.php');
                exit;
            }
        }
    }
}
//vendor login
if (isset($_POST['signin'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM vendor WHERE email = '$email'AND password = '$password'";
    $run_query = mysqli_query($con,$sql);
    $count = mysqli_num_rows($run_query);
    $row = mysqli_fetch_array($run_query);
    $_SESSION["uid"] = $row["vendor_id"];
    $_SESSION["name"] = $row["fname"];

    if(empty($email) || empty($password)){
        $_SESSION['error'] = 'Fill in the form first';
        header('location:sign.php');
    }
    else{
        if ($count == 1){
            echo 'login_success';
            header('location: index.php');
        }
        else{
            $_SESSION['error'] = 'Incorrect login credentials';
            header('location:sign.php');
        }
    }
}
//logout

if (isset($_POST['logout'])){
    unset($_SESSION['uid']);
    unset($_SESSION['name']);

    header('location:sign.php');
}