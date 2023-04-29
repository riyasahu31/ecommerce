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
    if (isset($_GET['category'])) {


        $category_slug = $_GET['category'];
        $category_data = getSlugActive("categories", $category_slug);
        $category = mysqli_fetch_array($category_data);
        if ($category) {


            $cid = $category['id'];

    ?>
    <div class="py-3 bg-primary">
        <div class="container">
            <h6 class="text-white">
                <a href="categories.php" class="text-white">Home / </a>
                <a href="categories.php" class="text-white">Collections / </a>
                <?= $category['name']; ?>
            </h6>
        </div>
    </div>
    <div class="py-3">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>
                        <?= $category['name']; ?>
                    </h1>
                    <hr>
                    <div class="row">
                        <?php
            $products = getProdByCategory($cid);
            if (mysqli_num_rows($products) > 0) {
                foreach ($products as $item) {
                        ?>
                        <div class="col-md-4 mb-2">
                            <a href="product-view.php?product=<?= $item['slug']; ?>">
                                <div class="card shadow">
                                    <div class="card-body text-center">
                                       

                                    <?php
                                    
                                    $query = "SELECT product_images FROM product_images WHERE product_id = ".$item['id'] ;
                                    $fire = mysqli_query($conn, $query);
                                    $data = mysqli_fetch_array($fire);
                                    ?>
                                    <img src="product_images/<?= $data['product_images'];?> " id="main" width="100px" height="100px">
                                
                        <!-- edditing............ -->
                                
                                        <h4 class="text-center">
                                            <?= $item['name']; ?>
                                        </h4>
                                    </div>
                                </div>
                            </a>
                        </div>

                        <?php
                }
            } else {
                echo "No Data Available";
            }
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
        } else {
            echo "Something Went Wrong";
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