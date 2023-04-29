<?php
session_start();
include('includes/header.php');
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
                    <h4>Add Category</h4>
                </div>
                <div class="card-body">
                    <form action="code.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="">Name</label>
                                <input type="text" name="name" placeholder="Enter Category Name" class="form-control"
                                    required="required">
                            </div>
                            <div class="col-md-6">
                                <label for="">Slug</label>
                                <input type="text" name="slug" required="required" placeholder="Enter slug"
                                    class="form-control">
                            </div>
                            <div class="col-md-12">
                                <label for="">Description</label>
                                <textarea rows="3" name="description" placeholder="Enter description"
                                    class="form-control" required="required"></textarea>
                            </div>
                            <div class="col-md-12">
                                <div>
                                    <label for="">Upload Image</label>
                                    <input type="file" name="image" required="required" class="form-control">
                                </div>
                                <div>
                                    <label for="">(*Only jpg, png, jpeg files are allowed)</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="">Meta Title</label>
                                <input type="text" name="meta_title" placeholder="Enter meta title" class="form-control"
                                    required="required">
                            </div>
                            <div class="col-md-12">
                                <label for="">Meta Description</label>
                                <textarea rows="3" name="meta_description" placeholder="Enter meta description"
                                    class="form-control " required="required"></textarea>
                            </div>
                            <div class="col-md-12">
                                <label for="">Meta Keywords</label>
                                <textarea rows="3" name="meta_keywords" placeholder="Enter meta keywords"
                                    class="form-control" required="required"></textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="">Status</label>
                                <input class="mt-3" type="checkbox" name="status">
                            </div>
                            <div class="col-md-6">
                                <label for="">Popular</label>
                                <input class="mt-3" type="checkbox" name="popular">
                            </div>
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary" name="add_category_btn">Save</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<?php include('includes/footer.php') ?>