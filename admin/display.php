<?php
include '../config.php';
$query = "SELECT product_images FROM product_images";
$fire = mysqli_query($conn, $query);
$res = mysqli_fetch_array($fire);
print_r($res);
?>