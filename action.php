<?php
session_start();
include 'db.php';
//register user
if (isset($_POST['register'])){
    $first=$_POST['firstname'];
    $last=$_POST['lastname'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $repassword=$_POST['repassword'];
    $address=$_POST['address'];
    $contact=$_POST['contact'];

    $date = date('Y-m-d');

    if(empty($first) || empty($last) || empty($email) || empty($password) || empty($repassword) || empty($address) || empty($contact)){
        $_SESSION['error'] = 'Please fill in the form';
        header('location: signup.php');

    }
    else {
        if(strlen($password) < 8 ){
            $_SESSION['error'] = 'Password is weak';
            header('location: signup.php');
            exit;
        }
        if($password != $repassword){
            $_SESSION['error']= 'Passwords dont match';
            header('location: signup.php');
            exit;
        }

        //existing email address in our database
        $sql = "SELECT user_id FROM users WHERE email = '$email' LIMIT 1" ;
        $check_query = mysqli_query($con,$sql);
        $count_email = mysqli_num_rows($check_query);
        if($count_email > 0){
            $_SESSION['error']='Email already exists, <a href="login.php">login</a> instead';
            header('location:signup.php');

        }
        else {

            $sql = "INSERT INTO `users` 
		(`user_id`, `fname`, `lname`, `email`, 
		`password`,`address`,`contact`,`created_on`) 
		VALUES (NULL, '$first', '$last', '$email', 
		'$password','$address','$contact','$date')";
            $run_query = mysqli_query($con,$sql);
            $_SESSION["uid"] = mysqli_insert_id($con);
            $_SESSION["name"] = $first;

            $ip_add = getenv("REMOTE_ADDR");
            if($run_query){
                header('location: login.php');
                exit;
            }
        }
    }

}
//login action

if (isset($_POST['login'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $run_query = mysqli_query($con,$sql);
    $count = mysqli_num_rows($run_query);
    $row = mysqli_fetch_array($run_query);
    $_SESSION["uid"] = $row["user_id"];
    $_SESSION["name"] = $row["fname"];

    if(empty($email) || empty($password)){
        $_SESSION['error'] = 'Fill in the form first';
        header('location:login.php');
    }
    else{
        if ($count == 1){
            echo 'login_success';
            header('location: index.php');
    }
        else{
            $_SESSION['error'] = 'Incorrect login credentials';
            header('location:login.php');
        }
    }

}

//logout

if (isset($_POST['logout'])){
    unset($_SESSION['uid']);
    unset($_SESSION['name']);

    header('location:index.php');
}

//add to cart
if (isset($_POST['addtocart'])){
    $proid = $_POST['id'];
    $quantity = $_POST['quantity'];
    $userid = $_SESSION['uid'];

    if (!isset($_SESSION['uid'])){
        $_SESSION['error'] = 'You need to login first.<a href="sign.php">login</a>';
        header('location:product.php'."?id=$proid");
        exit();
    }
    else{
        //check if item in cart is in our database
        $sql = "SELECT product_id FROM cart WHERE product_id = '$proid' AND user_id = '$_SESSION[uid]' LIMIT 1" ;
        $check_query = mysqli_query($con,$sql);
        $count_email = mysqli_num_rows($check_query);
        if($count_email > 0){
            $_SESSION['error']='Product already in cart';
            header('location:product.php'."?id=$proid");
            exit();
        }

        $sql = "INSERT INTO `cart` 
		(`cart_id`, `user_id`, `product_id`,`quantity`) 
		VALUES (NULL, '$userid', '$proid',$quantity)";

        $run_query = mysqli_query($con,$sql);
        if($run_query){
            $_SESSION['success'] = 'Product added to cart';
            header('location: product.php'."?id=$proid");
            exit;
        }
        else{
            $_SESSION['error']= 'Product not added to cart';
            header('location: product.php'."?id=$proid");
            exit;
        }
    }
}

//update cart

if (isset($_POST['update'])){
    $proid = $_POST['id'];
    $quantity = $_POST['quantity'];

    $sql = "UPDATE cart SET quantity = '$quantity' WHERE product_id = '$proid' AND user_id = '$_SESSION[uid]'" or die(mysqli_error());
    $query = mysqli_query($con, $sql);

    if($query){
        $_SESSION['success'] = 'Cart updated successfully';
        header('location: cart.php');
        exit;
    }
    else{
        $_SESSION['error']= 'Cart not updated.';
        header('location: cart.php');
        exit;
    }
}

//delete item form cart
if (isset($_POST["delete"])) {
    $remove_id = $_POST["id"];

    $sql = "DELETE FROM cart WHERE product_id = '$remove_id' AND user_id = '$_SESSION[uid]'";

    if(mysqli_query($con,$sql)) {
        $_SESSION['success'] = 'Product is removed from cart';
        header('location: cart.php');
        exit;
    }
    else{
        $_SESSION['error']= 'Product is not removed from cart.';
        header('location: cart.php');
        exit;
    }
}

//edit profile

if (isset($_POST['editprof'])){
    $first=$_POST['fname'];
    $last=$_POST['lname'];
    $email=$_POST['email'];
    $address=$_POST['address'];
    $contact=$_POST['contact'];

    $sql = "UPDATE users SET fname = '$first', lname = '$last', email = '$email', address = '$address', contact = '$contact' WHERE  user_id = '$_SESSION[uid]'" or die(mysqli_error());
    $query = mysqli_query($con, $sql);

    if($query){
        $_SESSION['success'] = 'Profile updated successfully';
        header('location: profile.php');
        exit;
    }
    else{
        $_SESSION['error']= 'Profile not updated.';
        header('location: profile.php');
        exit;
    }
}

//change password
if (isset($_POST['changepass'])){
    $password = $_POST['password'];
    $newpass = $_POST['newpassword'];
    $repass = $_POST['renewpassword'];

    if(strlen($newpass) < 8 ){
        $_SESSION['error'] = 'Password is weak';
        header('location: profile.php');
        exit;
    }
    if($newpass != $repass){
        $_SESSION['error']= 'Passwords dont match';
        header('location: profile.php');
        exit;
    }
    //confirm current passwords
    $sql = "SELECT * FROM users WHERE id = '$_SESSION[uid]'" ;
    $check_query = mysqli_query($con,$sql);
    $fetch  = mysqli_fetch_array($check_query);
    $current = $fetch['password'];
    if($current != $password){
        $_SESSION['error']='Invalid current password';
        header('location:profile.php');
        exit();
    }
    else{
        $sql = "UPDATE users SET password = '$newpass' WHERE  id = '$_SESSION[uid]'" or die(mysqli_error());
        $query = mysqli_query($con, $sql);

        if($query){
            $_SESSION['success'] = 'Profile updated successfully';
            header('location: profile.php');
            exit;
        }
        else{
            $_SESSION['error']= 'Profile not updated.';
            header('location: profile.php');
            exit;
        }
    }



}
//order
if (isset($_POST['order'])){
    $id = $_SESSION['uid'];
    $pid=$_POST['pid'];
    $amount = $_POST['amount'];
    $payment = $_POST['shipping'];
    $quantity = $_POST['quantity'];

    $sql = "INSERT INTO `sales` 
		(`sales_id`, `user_id`, `product_id`,`amount`,`payment`,`quantity`) 
		VALUES (NULL, '$id', '$pid','$amount','$payment','$quantity')";
    $query = mysqli_query($con, $sql);
    if($query){
        $run= "DELETE FROM cart WHERE product_id = '$pid' AND user_id = '$_SESSION[uid]'";
        $query_run = mysqli_query($con, $run);
        if ($query){
            $_SESSION['success'] = 'Order placed successfully';
            header('location: profile.php');
            exit;
        }
        }

    else{
        $_SESSION['error']= 'Order not placed.';
        header('location: checkout.php');
        exit;
    }

}