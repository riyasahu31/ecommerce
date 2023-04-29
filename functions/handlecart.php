<?php

session_start();
include('../config.php');

if (isset($_SESSION['loggedin'])) {

    if (isset($_POST['scope'])) {
        $scope = $_POST['scope'];
        switch ($scope) {

            case "add":
                $prod_id = $_POST['prod_id'];
                $prod_qty = $_POST['prod_qty'];

                $user_id = $_SESSION["id"];

                $chk_existing_cart = "SELECT * FROM carts WHERE prod_id = '$prod_id' AND user_id ='$user_id' ";
                $chk_existing_cart_run = mysqli_query($conn, $chk_existing_cart);

                if (mysqli_num_rows($chk_existing_cart_run) > 0) {
                    echo "existing";
                } else {


                    $insert_query = "INSERT INTO `carts`( `user_id`, `prod_id`, `prod_qty`) VALUES ('$user_id' , '$prod_id', '$prod_qty')";
                    $insert_query_run = mysqli_query($conn, $insert_query);

                    if ($insert_query_run) {
                        echo 201;
                    } else {
                        echo 500;
                    }
                }
                break;
            case "update":
                $prod_id = $_POST['prod_id'];
                // print_r($prod_id);
                // die;
                $prod_qty = $_POST['prod_qty'];
                // $selling_price = $_POST['selling_price'];
                // $net_price = $_POST['net_price'];

                $user_id = $_SESSION["id"];
                $chk_existing_cart = "SELECT * FROM carts WHERE prod_id = '$prod_id' AND user_id ='$user_id' ";
                $chk_existing_cart_run = mysqli_query($conn, $chk_existing_cart);

                if (mysqli_num_rows($chk_existing_cart_run) > 0) {
                    // echo "existing";
                    // die();
                    $update_query = "UPDATE carts SET prod_qty='$prod_qty' WHERE prod_id='$prod_id' AND user_id='$user_id' ";
                    $update_query_run = mysqli_query($conn, $update_query);
                    // update net price
                    // $update_price_query = "UPDATE carts SET net_price='$selling_price*$prod_qty' WHERE prod_id='$prod_id' AND user_id='$user_id' ";
                    // $update_price_query_run = mysqli_query($conn, $update_price_query);

                    if ($update_query_run) {
                        echo 200;
                    } else {
                        echo 500;
                    }

                } else {

                    echo "Something went wrong";
                }

                break;
            case "delete":
                $cart_id = $_POST['cart_id'];

                $user_id = $_SESSION["id"];
                $chk_existing_cart = "SELECT * FROM carts WHERE id = '$cart_id' AND user_id ='$user_id' ";
                $chk_existing_cart_run = mysqli_query($conn, $chk_existing_cart);

                if (mysqli_num_rows($chk_existing_cart_run) > 0) {
                    // echo "existing";
                    $delete_query = "DELETE FROM carts WHERE id='$cart_id' ";
                    $delete_query_run = mysqli_query($conn, $delete_query);

                    if ($delete_query_run) {
                        echo 200;
                    } else {
                        echo "Something went wrong";
                    }

                } else {

                    echo "Something went wrong";
                }

                break;
            default:
                echo 500;

        }
    }
} else {
    echo 401;
}

?>