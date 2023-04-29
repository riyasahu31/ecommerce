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
            <div class="card">
                <div class="card-header">
                    <h4>Add Products</h4>
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
                                    <option value="<?= $item['id']; ?>">
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
                            
                            <div class="col-md-6">
                            <!-- <input type="hidden" name="product_id" value="<?= $data['id'] ?>"> -->
                                <label class="mb-0">Name</label>
                                <input type="text" name="name" placeholder="Enter Product Name"
                                    class="form-control mt-2" required>
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0">Slug</label>
                                <input type="text" name="slug" required placeholder="Enter slug"
                                    class="form-control mt-2">
                            </div>
                            <div class="col-md-12">
                                <label class="mb-0"> Small Description</label>
                                <textarea rows="3" name="small_description" placeholder="Enter small description"
                                    class="form-control mt-2" required="required"></textarea>
                            </div>
                            <div class="col-md-12">
                                <label class="mb-0">Description</label>
                                <textarea rows="3" name="description" placeholder="Enter description"
                                    class="form-control mt-2" required="required"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0">Original Price</label>
                                <input type="text" name="original_price" required placeholder="Enter original price"
                                    class="form-control mt-2">
                            </div>
                            <div class="col-md-6">
                                <label class="mb-0">Selling Price</label>
                                <input type="text" name="selling_price" required placeholder="Enter selling price"
                                    class="form-control mt-2">
                            </div>
                            
                                <!-- <div class="row" id="add_image_box_1"> -->
                                <div class="row">

                                <div class="col-md-10">
                                    <label class="mb-0">Upload Image</label>
                                    <input type="file" name="product_images[]" required class="form-control mt-2" multiple/>
                                    <!-- <input type="file" name="image" required class="form-control mt-2"> -->

                                    
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
                                    <input type="number" name="qty" required placeholder="Enter Quantity"
                                        class="form-control mt-2">
                                </div>
                                <div class="col-md-3">
                                    <label class="mb-0 mt-2">Status</label><br>
                                    <input class="mt-3 " type="checkbox" name="status">
                                </div>
                                <div class="col-md-3">
                                    <label class="mb-0 mt-2">Trending</label><br>
                                    <input class="mt-3" type="checkbox" name="trending">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label class="mb-0">Meta Title</label>
                                <input type="text" name="meta_title" placeholder="Enter meta title"
                                    class="form-control mt-2" required="required">
                            </div>
                            <div class="col-md-12">
                                <label class="mb-0">Meta Description</label>
                                <textarea rows="3" name="meta_description" placeholder="Enter meta description"
                                    class="form-control mt-2 " required="required"></textarea>
                            </div>
                            <div class="col-md-12">
                                <label class="mb-0">Meta Keywords</label>
                                <textarea rows="3" name="meta_keywords" placeholder="Enter meta keywords"
                                    class="form-control mt-2" required="required"></textarea>
                            </div>

                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary" name="add_product_btn">Save</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<?php include('includes/footer.php') ?>