<?php
// include('../config.php');

function getAll($table)
{
    global $conn;
    $query = "SELECT * FROM $table";
    return $query_run = mysqli_query($conn, $query);
}
function getById($table, $id)
{
    global $conn;
    $query = "SELECT * FROM $table WHERE id='$id' ";
    return $query_run = mysqli_query($conn, $query);
}

function getProdImgById($table, $product_id)
{
    global $conn;
    $query = "SELECT * FROM $table WHERE product_id='$product_id' ";
    return $query_run = mysqli_query($conn, $query);
}

function getAllActive($table)
{
    global $conn;
    $query = "SELECT * FROM $table WHERE status='0' ";
    return $query_run = mysqli_query($conn, $query);
}
function redirect($url, $message)
{
    $_SESSION['message'] = $message;
    header('Location: ' . $url);
    exit();
}
?>