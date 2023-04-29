<?php

session_start();
include('../config.php');
require 'userfunctions.php';

if (isset($_SESSION['loggedin'])) {
    if(isset($_POST['placeOrderBtn']))
    {
        // print_r($_POST);
        // die;
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $pincode = mysqli_real_escape_string($conn, $_POST['pincode']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $payment_mode = mysqli_real_escape_string($conn, $_POST['payment_mode']);
        // $payment_id = mysqli_real_escape_string($conn, $_POST['payment_id']);
        $payment_id = null;

        // print_r($payment_id);
        // die;


        if($name == "" || $email == "" || $phone == "" || $pincode == "" || $address == "" )
        {
            $_SESSION['message'] = "All fields are mandatory";
            header('Location: ../checkout.php');
            exit(0);
        }

        // $cartItems = getCartItems();
        $user_id = $_SESSION['id'];
        $query = "SELECT c.id as cid, c.prod_id, c.prod_qty, p.id as pid, p.name, p.image, p.selling_price FROM  carts c, products p WHERE c.prod_id=p.id AND c.user_id = '$user_id' ORDER BY c.id DESC ";
        $query_run = mysqli_query($conn, $query);

        $totalPrice = 0;
        foreach ($query_run as $citem) {
            $totalPrice += $citem['selling_price'] * $citem['prod_qty'];
        }

        // echo $totalPrice;
        $tracking_no = "user" . rand(1111, 9999) . substr($phone, 2);

        // $user_id = $_SESSION['id'];
        
        $insert_query = "INSERT INTO orders (tracking_no, user_id, name, email, phone, address, pincode, total_price, payment_mode, payment_id) VALUES ('$tracking_no', '$user_id', '$name', '$email' ,'$phone', '$address','$totalPrice', '$pincode' ,'$payment_mode', '$payment_id' )";
        $insert_query_run = mysqli_query($conn, $insert_query);
        if($insert_query_run){
            $order_id = mysqli_insert_id($conn);

            foreach ($query_run as $citem) {
                $prod_id = $citem['prod_id'];
                $prod_qty = $citem['prod_qty'];
                $price = $citem['net_price'];
                // price -> net_price

                $insert_items_query = "INSERT INTO order_items (order_id, prod_id, qty, price) VALUES ('$order_id', '$prod_id', '$prod_qty', '$price') ";

                $insert_items_query_run = mysqli_query($conn, $insert_items_query);

                $product_query = "SELECT * FROM products WHERE id='$prod_id' LIMIT 1 ";
                $product_query_run = mysqli_query($conn, $product_query);

                $productData = mysqli_fetch_array($product_query_run);
                $current_qty = $productData['qty'];
                
                $new_qty = $current_qty - $prod_qty;

                $updateQty_query = "UPDATE products SET qty='$new_qty' WHERE id='$prod_id' ";
                $updateQty_query_run = mysqli_query($conn, $updateQty_query);
        }

            $deleteCartQuery = "DELETE FROM carts WHERE user_id='$user_id' ";
            $deleteCartQuery_run = mysqli_query($conn, $deleteCartQuery);

        $_SESSION['message'] = "Order placed successfully";
        header('Location: ../my-orders.php');
        die();
        }
    }
}
else
{
    header('Location: ../index.php');
}
?>