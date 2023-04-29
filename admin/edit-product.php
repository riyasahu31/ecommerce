<?php
session_start();
include('includes/header.php');
include('../config.php');
include('../functions/myfunctions.php');

// include('../middleware/adminMiddleware.php');
?>

<div class="container">
    <?php
    if (isset($_SESSION['message'])) {
    ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">

        <?= $_SESSION['message']; ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
    </div>
    <?php
        unset($_SESSION['message']);
    }
    ?>
    <div class="row">
        <div class="col-md-12">
            <?php
            if (isset($_GET['id'])) {

                $id = $_GET['id'];
                $product = getById("products", $id);
                if(mysqli_num_rows($product)>0){
                    $data = mysqli_fetch_array($product);
                    
                    ?>
                    <div class="card">
                        <div class="card-header">
                            <h4>Edit Products</h4>
                        </div>
                        <div class="card-body">
                            <form action="code.php" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="mb-0">Select Category</label>
                                        <select name="category_id" class="form-select">
                                            <option>Select Category</option>
                                            <?php
                        $categories = getAll("categories");
                        if (mysqli_num_rows($categories) > 0) {
                            foreach ($categories as $item) {
                                            ?>
                                            <option value="<?= $item['id']; ?>" <?= $data['category_id'] == $item['id']?'selected':'' ?>>
                                                <?= $item['name']; ?>
                                            </option>
        
                                            <?php
                            }
                        } else {
                            echo "No Category Available";
                        }
                                            ?>
                                        </select>
                                    </div>
                                    <input type="hidden" name="product_id" value="<?= $data['id']; ?>">
                                    <div class="col-md-6">
                                    <!-- <input type="hidden" name="product_id" value="<?= $data['id'] ?>"> -->
                                        <label class="mb-0">Name</label>
                                        <input type="text" name="name" value="<?= $data['name']; ?>" placeholder="Enter Product Name"
                                            class="form-control mt-2" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="mb-0">Slug</label>
                                        <input type="text" name="slug" value="<?= $data['slug']; ?>" required placeholder="Enter slug"
                                            class="form-control mt-2">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="mb-0"> Small Description</label>
                                        <textarea rows="3" name="small_description" placeholder="Enter small description"
                                            class="form-control mt-2" required="required"><?= $data['small_description']; ?></textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="mb-0">Description</label>
                                        <textarea rows="3" name="description" placeholder="Enter description"
                                            class="form-control mt-2" required="required"><?= $data['description']; ?></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="mb-0">Original Price</label>
                                        <input type="text" value="<?= $data['original_price']; ?>" name="original_price" required placeholder="Enter original price"
                                            class="form-control mt-2">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="mb-0">Selling Price</label>
                                        <input type="text" name="selling_price" value="<?= $data['selling_price']; ?>" required placeholder="Enter selling price"
                                            class="form-control mt-2">
                                    </div>
                                    
                                        <!-- <div class="row" id="add_image_box_1"> -->
                                        <div class="row">
                                        
                                        <div class="col-md-10">
                                            
                                            <label class="mb-0">Upload Image</label>
                                            <input type="file" name="product_images[]" required class="form-control mt-2" multiple/>
                                            
                                            <!-- <input type="file" name="image" required class="form-control mt-2"> -->
                                            <label class="mb-0">Current Image</label>
                                            <?php
                                                $count = 0;
                                                $query = "SELECT product_images FROM product_images WHERE product_id = ".$data['id'] ;
                                                $fire = mysqli_query($conn, $query);
                                                while ($item = mysqli_fetch_array($fire)){
                                                $count++;
                                                        // print_r($res);
                                                // $res = $item['product_images'];
                                                // $res = explode(" ", $res);
                                            ?>
                                                <input type="hidden" name="old_image[]" value="<?= $item['product_images'];?>" class="form-control mt-2">
                                                <img src="../product_images/<?= $item['product_images'];?>" alt=" " id="<?= $count?>" width="50px" height="50px">
                                                <?php
                                            }
                                        ?>
                                        </div>
                                        <div class="col-md-2 mt-2">
                                            
                                        <!-- <button type="button" class="btn btn-info mt-4" onclick="add_more_images();" >Add Image</button> -->
        
                                        </div>
                                        </div>
                                        
        
                                        <div >
                                            <label class="mb-0">(*Only jpg, png, jpeg files are allowed)</label>
                                        </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="mb-0">Quantity</label>
                                            <input type="number" name="qty" required value="<?= $data['qty']; ?>" placeholder="Enter Quantity"
                                                class="form-control mt-2">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="mb-0 mt-2">Status</label><br>
                                            <input class="mt-3 " type="checkbox" <?= $data['status'] ? 'checked' : '' ?> name="status">
                                        </div>
                                        <div class="col-md-3">
                                            <label class="mb-0 mt-2">Trending</label><br>
                                            <input class="mt-3" type="checkbox" <?= $data['trending'] ? 'checked' : '' ?> name="trending">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="mb-0">Meta Title</label>
                                        <input type="text" name="meta_title" value="<?= $data['meta_title']; ?>" placeholder="Enter meta title"
                                            class="form-control mt-2" required="required">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="mb-0">Meta Description</label>
                                        <textarea rows="3" name="meta_description" placeholder="Enter meta description"
                                            class="form-control mt-2 " required="required"><?= $data['meta_description']; ?></textarea>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="mb-0">Meta Keywords</label>
                                        <textarea rows="3" name="meta_keywords" placeholder="Enter meta keywords"
                                            class="form-control mt-2" required="required"><?= $data['meta_keywords']; ?></textarea>
                                    </div>
        
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary" name="update_product_btn">Update</button>
                                    </div>
                                </div>
        
                            </form>
                        </div>
                    </div>
                </div>
                <?php

                }
                else{
                    echo "Product Not found for given id";
                }
          
            }
            else{
                echo "Id missing from url";
            }
            
            ?>
    </div>

</div>

<?php include('includes/footer.php') ?>