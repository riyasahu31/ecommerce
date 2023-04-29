<?php

session_start();
include('config.php');
include('functions/userfunctions.php');

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

    <?php
    if (isset($_GET['product'])) {
        $product_slug = $_GET['product'];

        $product_data = getSlugActive("products", $product_slug);
        $product = mysqli_fetch_array($product_data);
        if ($product) {
    ?>

<div class="py-3 bg-primary">
        <div class="container">
            <h6 class="text-white">
                <a href="categories.php" class="text-white">Home / </a>
                <a href="categories.php" class="text-white">Collections / </a>
                <?= $product['name']; ?>
            </h6>
        </div>
</div>
    <div class="bg-light py-4">
        <div class="container product_data mt-3">
                    <!-- <div class="shadow">
                        <img src="uploads/" alt="Product Image" class="w-100">
                    </div> -->
                    <!-- editting -->
            <div class="row">
                <div class="col-md-4">
            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
  <?php
                                    $count = 0;
                                        $query = "SELECT product_images FROM product_images WHERE product_id = ".$product['id'] ;
                                        $fire = mysqli_query($conn, $query);
                                        while ($data = mysqli_fetch_array($fire)){
                                        $count++;
                                                // print_r($res);
                                                $res = $data['product_images'];
                                                $res = explode(" ", $res);
                                                // $count = count($res) - 1;
                                                ?>
                                                <div class="carousel-item active">
                                                <img src="product_images/<?= $res[0];?> " id="<?= $count?>" class="d-block w-100">
                                                </div>

                                                <?php
                                            }
                                        ?>
                                        </div>
                            <button class="carousel-control-prev" type="button" data-target="#carouselExampleControls" data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-target="#carouselExampleControls" data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </button>
<!-- </div> -->
            
            </div>

        </div>
                <div class="col-md-8">
                    <h4 class="fw-bold">
                        <?= $product['name']; ?>
                            <span class="float-right text-danger">
                                <?php if ($product['trending']) {
                echo "Trending";
            } ?>
                            </span>
                    </h4>
                    <hr>
                    <p>
                        <?= $product['small_description']; ?>
                    </p>
                    <div class="row">
                        <div class="col-md-6">
                            <div>
                                <h5 class="text-success">Discounted Price</h5>
                            </div>
                            <h4>
                                Rs<span class="text-success fw-bold">
                                    <?= $product['selling_price']; ?>
                                </span>
                            </h4>
                        </div>
                        <div class="col-md-6">
                            <div>
                                <h5 class="text-danger">Original Price</h5>
                            </div>
                            <h5>
                                    <s class="text-danger">
                                    <?= $product['original_price']; ?>
                                    </s>
                            </h5>
                        </div>
                    </div>
                    <div class="row">

                        <!-- <td class="cart-product-quantity" width="130px">
                                <div class="input-group quantity">
                                    <div class="input-group-prepend decrement-btn" style="cursor: pointer">
                                        <span class="input-group-text">-</span>
                                    </div>
                                    <input type="text" class="qty-input form-control" maxlength="2" max="10" value="1">
                                    <div class="input-group-append increment-btn" style="cursor: pointer">
                                        <span class="input-group-text">+</span>
                                    </div>
                                </div>
                            </td> -->

                        <div class="col-md-4 cart-product-quantity">
                            <div class="input-group quantity mb-3" style="width: 130px;">
                                <button class="input-group-text decrement-btn">-</button>
                                <input type="text" value="1" width="150px" maxlength="2" max="10"
                                    class="form-control text-center qty-input bg-white disabled">
                                <button class="input-group-text increment-btn">+</button>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <button class="btn btn-primary px-4 addToCartBtn" value="<?= $product['id']; ?>"> <i
                                    class="fa-solid fa-cart-plus"></i>Add to
                                Cart</button>
                        </div>
                        <div class="col-md-6">
                            <a href="cart.php" class="btn btn-primary px-4">
                                <i class="fa fa-shopping-cart me-2"></i>View Cart
                            </a>
                        </div>
                    </div>
                    <hr>
                    <h6>Product Description:</h6>
                    <p>
                        <?= $product['description']; ?>
                    </p>
                </div>
            </div>                                                
        </div>
    </div>
    <?php

        } else {
            echo "Product not found";
        }

    } else {
        echo "Something Went Wrong";
    }
    ?>
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


    <!-- working -->
    <script>
        alertify.set('notifier', 'position', 'top-right');
    <?php
    if (isset($_SESSION[' message '])) {
    ?>

                alertify.success('<?= $_SESSION[' message ']; ?>');
            <?php
        unset($_SESSION[' message ']);
        }
            ?>
    </script>

</body>

</html>