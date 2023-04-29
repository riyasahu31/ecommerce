<?php
include('../functions/myfunctions.php');

if (isset($_SESSION['loggedin'])) {
    if ($_SESSION['role_as'] == 0) {
        $_SESSION['message'] = "You are not authorised to access this page";
        header("location: welcome.php");

    }
} else {
    $_SESSION['message'] = "Login to continue";
    header("location: login.php");

}

?>