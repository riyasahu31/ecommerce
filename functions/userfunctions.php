<?php


// include('../config.php');

// function getAll($table)
// {
//     global $conn;
//     $query = "SELECT * FROM $table";
//     return $query_run = mysqli_query($conn, $query);
// }
function getIdActive($table, $id)
{
    global $conn;
    $query = "SELECT * FROM $table WHERE id='$id' AND status='0' ";
    return $query_run = mysqli_query($conn, $query);
    // return $query_run = mysqli_fetch_assoc(mysqli_query($conn, $query));
}
function getSlugActive($table, $slug)
{
    global $conn;
    $query = "SELECT * FROM $table WHERE slug='$slug' AND status='0' LIMIT 1";
    return $query_run = mysqli_query($conn, $query);

    // return mysqli_fetch_object($query_run);
}



function getProdByCategory($category_id)
{
    global $conn;
    $query = "SELECT * FROM products WHERE category_id='$category_id' AND status='0' 
    -- constraint fk FOREIGN KEY (category_id)
    -- REFERENCES categories (id) 
    ";
    return $query_run = mysqli_query($conn, $query);

    // return $query_run;

    // return $query_run = mysqli_fetch_assoc(mysqli_query($conn, $query));
}

function getAllActive($table)
{
    global $conn;
    $query = "SELECT * FROM $table WHERE status='0' ";
    $query_run = mysqli_query($conn, $query);
    return $query_run;

    // return $query_run = mysqli_fetch_assoc(mysqli_query($conn, $query));
}

function getCartItems()
{
    global $conn;
    $user_id = $_SESSION['id'];
    $query = "SELECT c.id as cid, c.prod_id, c.prod_qty, p.id as pid, p.name, p.image, p.selling_price FROM  carts c, products p WHERE c.prod_id=p.id AND c.user_id = '$user_id' ORDER BY c.id DESC ";
    $query_run = mysqli_query($conn, $query);
    return $query_run;
}

function getOrders()
{
    global $conn;
    $user_id = $_SESSION['id'];
    $query = "SELECT * FROM  orders WHERE user_id = '$user_id' ORDER BY id DESC ";
    $query_run = mysqli_query($conn, $query);
    return $query_run;
}

function checkTrackingNoValid($tracking_no)
{
    global $conn;
    $user_id = $_SESSION['id'];
    $query = "SELECT * FROM  orders WHERE tracking_no = '$tracking_no' AND user_id = '$user_id' ";
    $query_run = mysqli_query($conn, $query);
    return $query_run;
}

function redirect($url, $message)
{
    $_SESSION['message'] = $message;
    header('Location: ' . $url);
    exit();
}
?>