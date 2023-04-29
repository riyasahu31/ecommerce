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
        <style>
            input:disabled{
                       background-color: white;
                       color: black;
                       border: none;
                    }
        </style>
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
                <a href="cart.php" class="text-white">Cart</a>

            </h6>
        </div>
    </div>
    <div class="py-5">
        <div class="container">
            
                <div class="row">
                    <div class="col-md-12">
                    <?php $items = getCartItems();
                    if(mysqli_num_rows($items)>0){
                    ?>

                        <div class="row align-items-center">
                            <div class="col-md-4 text-center">
                                <h6>Product Details</h6>
                            </div>
                            <div class="col-md-2">
                                <h6>Price</h6>
                            </div>

                            <div class="col-md-2">
                                <h6>Quantity</h6>
                            </div>
                            <div class="col-md-2">
                                <h6> Net Price</h6>
                            </div>
                            <div class="col-md-2">
                                <h6>Remove</h6>
                            </div>
                        </div>
                        
                        <!-- <div id="mycart"> -->

                        <?php
                        foreach ($items as $citem) {

                        ?>
                        <div class="card product_data shadow-sm mb-3">
                            <div class="row align-items-center">
                                <div class="col-md-2">
                                    <img src="uploads/<?= $citem['image']; ?> "  alt="Image" width="70px" height="70px">
                                </div>
                                <div class="col-md-2">
                                    <h5>
                                        <?= $citem['name']; ?>
                                    </h5>
                                </div>
                                <div class="col-md-2">
                                    <h5>
                                    <?= $citem['selling_price']; ?>
                                    <input type="hidden" name="selling_price" class="iprice col-md-12"  value="<?= $citem['selling_price']; ?>" disabled>

                                        
                                    </h5>
                                </div>
                                
                                <div class="col-md-2 cart-product-quantity" >
                                    <input type="hidden" name="prod_id" class="prodId" value="<?= $citem['prod_id']; ?>">

                                    <div class="input-group quantity" style="width: 130px;">
                                        <button class="input-group-text decrement-btn updateQty">-</button>
                                        <input type="text" onchange="subTotal();" value="<?= $citem['prod_qty']; ?>" maxlength="2" max="10" width="150px"
                                            class="form-control text-center qty-input iquantity bg-white disabled">
                                        <button class="input-group-text increment-btn updateQty">+</button>
                                    </div>
                                </div>
                                <div class="col-md-2 itotal">
                                    
                                        
                                    <!-- <input type="text" name="net_price" class="net_price col-md-12" value="" disabled> -->

                                        <!-- Rs. $citem['selling_price'] * $citem['prod_qty'];  -->
                                
                                </div>

                                <div class="col-md-2 delete">
                                    <button class="btn btn-danger btn-sm deleteItem" name= "cid" value="<?= $citem['cid']; ?>"><i
                                            class="fa-regular fa-trash-can"></i>
                                        Remove</button>
                                </div>
                            </div>
                        </div>
                        <?php
                            echo $citem['name'];
                        }
                        ?>

                        <!-- </div> -->
                        <div>
                    <div class="float-right">
                        <a href="checkout.php" class="btn btn-outline-primary">Proceed to checkout</a>
                    </div>
                    </div>
                    <?php
                    }
                    else{
                        ?>
                        <div class="card card-body shadow text-center">
                            <h4 class="py-3">Your cart is empty</h4>
                        </div>
                        <?php
                    }
                    ?>
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
<script>

    var iprice = document.getElementsByClassName('iprice');
    var iquantity = document.getElementsByClassName('iquantity');
    var itotal = document.getElementsByClassName('itotal');
    //    location.reload(true);

    function subTotal(){
        for(i=0;i<iprice.length;i++){
itotal[i].innerText=(iprice[i].value)*(iquantity[i].value);
    }
    }
    subTotal();
</script>

    <!-- Not working  -->
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