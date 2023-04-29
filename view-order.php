<?php

session_start();

include('functions/userfunctions.php');
include('config.php');

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
}
if (isset($_GET['t'])) {
    $tracking_no = $_GET['t'];

    $orderData = checkTrackingNoValid($tracking_no);
    if(mysqli_num_rows($orderData)<0){
        ?>
        <h4>
            Something went wrong
        </h4>
            <?php
        die();
    }
}
else{
    ?>
<h4>
    Something went wrong
</h4>
    <?php
        die();
}

$data = mysqli_fetch_array($orderData);
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css" 
        integrity="sha384-QYIZto+st3yW+o8+5OHfT6S482Zsvz2WfOzpFSXMF9zqeLcFV0/wlZpMtyFcZALm" crossorigin="anonymous">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- alertify js -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <!-- bootstrap theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css" />
    <title>PHP Ecommerce</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">PHP Ecom</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="welcome.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="categories.php">Collections</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cart.php">Cart</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="register.php">Register</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="login.php">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>



            </ul>

            <div class="navbar-collapse collapse">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#"> <img src="https://img.icons8.com/metro/26/000000/guest-male.png">
                            <?php echo "Welcome " . $_SESSION['username'] ?>
                        </a>
                    </li>
                </ul>
            </div>


        </div>
    </nav>

    <div class="py-3 bg-primary">
        <div class="container">
            <h6 class="text-white">
                <a href="categories.php" class="text-white">Home / </a>
                <a href="checkout.php" class="text-white">My Orders / </a>
                <a href="#" class="text-white">View Order</a>

            </h6>
        </div>
    </div>
    <div class="py-5">
        <div class="container">
            <div class="">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-secondary">
                                <span class="text-white">
                                View Order

                                </span>
                
                                    <a href="my-orders.php" class="btn btn-warning float-right">
                                        <i class="fa fa-reply"></i> Back</a> 
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h4>Delivery Details</h4>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-12 mb-2">
                                                    <label class="font-weight-bold">Name</label>
                                                    <div class="border p-1">
                                                    <?= $data['name'] ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-2">
                                                    <label class="font-weight-bold">Email</label>
                                                    <div class="border p-1">
                                                    <?= $data['email'] ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-2">
                                                    <label class="font-weight-bold">Phone</label>
                                                    <div class="border p-1">
                                                    <?= $data['phone'] ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-2">
                                                    <label class="font-weight-bold">Tracking No</label>
                                                    <div class="border p-1">
                                                    <?= $data['tracking_no'] ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-2">
                                                    <label class="font-weight-bold">Address</label>
                                                    <div class="border p-1">
                                                    <?= $data['address'] ?>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-2">
                                                    <label class="font-weight-bold">Pin Code</label>
                                                    <div class="border p-1">
                                                    <?= $data['pincode'] ?>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                           
                                        </div>
                                        <div class="col-md-6">
                                                <h4>Order Details</h4>
                                                <hr>
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                        <th>Product</th>
                                                        <th>Price</th>
                                                        <th>Quantity</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    
                                                <?php
                                                $user_id = $_SESSION['id'];
                                                $order_query = "SELECT o.id as oid, o.tracking_no, o.user_id, oi.*, oi.qty as order_qty , p.* 
                                                                FROM orders o, order_items oi, products p 
                                                                WHERE o.user_id='$user_id' AND oi.order_id = o.id AND p.id= oi.prod_id
                                                                AND o.tracking_no = '$tracking_no'
                                                                ";

                                                $order_query_run = mysqli_query($conn, $order_query);
                                                
                                                if(mysqli_num_rows($order_query_run)>0){
                                                    foreach ($order_query_run as $item) {
                                                        
                                                        ?>
                                                        <tr>
                                                            <td class="align-middle">
                                                                <img src="uploads/<?= $item['image']; ?> " alt="<?= $item['name']; ?>" width="50px" height="50px">
                                                                <?= $item['name']; ?>
                                                            </td>
                                                            <td class="align-middle"><?= $item['selling_price']; ?></td>
                                                            <td class="align-middle">x <?= $item['order_qty']; ?></td>
                                                            
                                                        </tr>
                                                        <?php
                                                    }
                                                }

                                                ?>
                                                </tbody>
                                                </table>
                                                <hr>
                                                <h5>Total Price : <span class="float-right">Rs. <?= $data['total_price']?></span></h5>
                                            <hr>
                                            <label class="font-weight-bold">Payment Mode</label>

                                            <div class="border p-1 mb-3">
                                                <?= $data['payment_mode'] ?>
                                            </div>
                                            <label class="font-weight-bold">Status</label>

                                            <div class="border p-1 mb-3">
                                                <?php
                                                if ($data['status']==0) {
                                                    echo "Under Process";
                                                }
                                                else if ($data['status']==1) {
                                                    echo "Completed";
                                                }
                                                else if ($data['status']==2) {
                                                    echo "Canceled";
                                                }
                                                
                                                ?>
                                            </div>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
    <script src="custom.js"></script>
    <!-- alertify js -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>


    <!--  working  -->
    <script>
        alertify.set('notifier', 'position', 'top-right');
     <?php if (isset($_SESSION[' message '])) { ?>

            alertify.success('<?= $_SESSION[' message ']; ?>');
     <?php
         unset($_SESSION[' message ']);
            } ?>
    </script>

            </body>

            </html>