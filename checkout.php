<?php

session_start();

include('functions/userfunctions.php');
include('config.php');

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
}
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
                <a href="checkout.php" class="text-white">Checkout</a>

            </h6>
        </div>
    </div>
    <div class="py-5">
        <div class="container">
            <div class="card">
                <div class="card-body shadow">
                <form action="functions/placeorder.php" method="POST">

                <div class="row">
                    <div class="col-md-7">
                        <h6>Basic Details</h6>
                        <hr>
  <div class="form-row">
  <div class="form-group col-md-6">
      <label>Name</label>
      <input type="text" name="name" required placeholder="Enter your name" class="form-control">
    </div>
    <div class="form-group col-md-6">
      <label>Email</label>
      <input type="email" name="email" required placeholder="Enter your email" class="form-control">
    </div>
    
  </div>
   
  
  <div class="form-row">
  <div class="form-group col-md-6">
      <label>Phone No.</label>
      <input type="text" name="phone" required placeholder="Phone Number" class="form-control">
    </div>
    
    <div class="form-group col-md-6">
      <label>PinCode</label>
      <input type="text" name="pincode" required class="form-control" placeholder="Enter Pin Code" id="inputZip">
    </div>
  </div>
  <div class="form-row">
  <div class="form-group col-md-12">
    <label>Address</label>
    <textarea rows="5" class="form-control" name="address" required placeholder="Enter your Address"></textarea>
  </div>
  </div>

                    </div>
                    <div class="col-md-5">
                        <!-- <div class="row align-items-center"> -->
                            <!-- <div class="col-md-5 text-center"> -->
                                <h6>Order Details</h6>
                                <hr>
                            <!-- </div> -->
                            <!-- <div class="col-md-3">
                                <h6>Price</h6>
                            </div>

                            <div class="col-md-2">
                                <h6>Quantity</h6>
                            </div> -->
                        
                        <!-- </div> -->
                        
                        <!-- <div id="mycart"> -->
                        <?php $items = getCartItems();
                        $totalPrice = 0;
                        foreach ($items as $citem) {
                        ?>
                        <div class="border mb-1">
                            <div class="row align-items-center">
                                <div class="col-md-2">
                                    <img src="uploads/<?= $citem['image']; ?> " alt="Image" width="70px" height="70px">
                                </div>
                                <div class="col-md-5">
                                    <h5>
                                      <label><?= $citem['name']; ?></label>
                                    </h5>
                                </div>
                                <div class="col-md-3">
                                    <h5>
                                    <label><?= $citem['selling_price']; ?></label>
                                    </h5>
                                </div>
                                <div class="col-md-2">
                                    <h5>
                                   <label>x <?= $citem['prod_qty']; ?></label>
                                    </h5>
                                </div>
                                
                                
                            </div>
                        </div>
                        <?php 
                            
                            $totalPrice += $citem['selling_price'] * $citem['prod_qty'];
                        }
                        ?>
                        <h5>Total Price : <span class="float-right fw-bold">Rs. <?= $totalPrice ?></span> </h5>
                        <!-- </div> -->
                    <div class="">
                        <input type="hidden" name="payment_mode" value="COD">
                        <!-- <input type="hidden" name="payment_id" value="NULL"> -->
                        <button type="submit" name="placeOrderBtn" class="btn btn-primary w-100">Confirm and Place Order | COD</button>
                    </div>
                    </div>
                    
                </div>
                </form>
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


    <!-- working  -->
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