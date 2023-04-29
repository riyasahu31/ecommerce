<?php
session_start();

include('../config.php');
$category_id = $_GET['id'] ?? "";

// include('../functions/myfunctions.php');

if (isset($_POST['add_category_btn'])) {
    // print_r($_POST);
    // die;

    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $status = isset($_POST['status']) ? '1' : '0';
    $popular = isset($_POST['popular']) ? '1' : '0';
    $image = $_FILES['image']['name'];

    $path = "../uploads";
    $allowed_extension = array('png', 'jpg', 'jpeg');

    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time() . '.' . $image_ext;

    if (in_array($image_ext, $allowed_extension)) {

        move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $filename);

        $cate_query = "INSERT INTO categories(name, slug, description, meta_title, meta_description, meta_keywords, status, popular, image) VALUES ('$name','$slug','$description','$meta_title','$meta_description','$meta_keywords','$status','$popular','$filename')";

        $cate_query_run = mysqli_query($conn, $cate_query);

        if ($cate_query_run) {
            // move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $filename);
            // category added successfully
            $_SESSION['message'] = "Category Added Successfully";
            header("Location:add-category.php");
            exit();
        } else {
            //something went wrong
            $_SESSION['message'] = "something went wrong";
            header("Location:add-category.php");
            exit();
        }
    }

} else if (isset($_POST['update_category_btn'])) {

    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $slug = $_POST['slug'];
    $description = $_POST['description'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $status = isset($_POST['status']) ? '1' : '0';
    $popular = isset($_POST['popular']) ? '1' : '0';


    $new_image = $_FILES['image']['name'];
    $old_image = $_FILES['old_image'];
    //     // print_r($_POST);
//     // die;

    if ($new_image != "") {
        // $update_filename = $new_image;
        $allowed_extension = array('png', 'jpg', 'jpeg');

        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename = time() . '.' . $image_ext;
    } else {
        $update_filename = $old_image;
    }
    $path = "../uploads";

    if (in_array($image_ext, $allowed_extension)) {

        if ($_FILES['image']['name'] != "") {


            move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $update_filename);
            if (file_exists("../uploads/" . $old_image)) {
                unlink("../uploads/" . $old_image);
            }

        }

        $update_query = "UPDATE `categories` SET `name`='$name', `slug`='$slug', `description`='$description', `meta_title`='$meta_title', `meta_description`='$meta_description', `meta_keywords`='$meta_keywords', `status`='$status', `popular`='$popular', `image`='$update_filename' WHERE id=$category_id";

        $update_query_run = mysqli_query($conn, $update_query);

        if ($update_query_run) {
            // if ($_FILES['image']['name'] != "") {


            //     move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $update_filename);
            //     if (file_exists("../uploads/" . $old_image)) {
            //         unlink("../uploads/" . $old_image);
            //     }

            // }
            // category updated successfully
            $_SESSION['message'] = "Category Updated Successfully";
            header("Location:category.php");
            exit(0);
        } else {
            //something went wrong
            $_SESSION['message'] = "something went wrong";
            header("Location:edit-category.php?id=$category_id");
            exit(0);
        }
    }
} else if (isset($_POST['delete_category_id'])) {
    $category_id = mysqli_real_escape_string($conn, $_POST['category_id']);

    $category_query = "SELECT * FROM categories WHERE id='$category_id' ";
    $category_query_run = mysqli_query($conn, $category_query);
    $category_data = mysqli_fetch_array($category_query_run);
    $image = $category_data['image'];

    $delete_query = "DELETE FROM categories WHERE id = '$category_id' ";
    $delete_query_run = mysqli_query($conn, $delete_query);


    if ($delete_query_run) {
        if (file_exists("../uploads/" . $image)) {
            unlink("../uploads/" . $image);
        }
        $_SESSION['message'] = "Category deleted Successfully";
        header("Location:category.php");
        exit();
        // redirect("category.php", "Category deleted successfully");

    } else {
        $_SESSION['message'] = "Something Went Wrong";
        header("Location:category.php");
        exit(0);
        // redirect("category.php", "Something Went Wrong");

    }


} else if (isset($_POST['add_product_btn'])) {
    
    
    $category_id = $_POST['category_id'];

    $name = $_POST['name'];

    $slug = $_POST['slug'];
    $small_description = $_POST['small_description'];
    $description = $_POST['description'];
    $original_price = $_POST['original_price'];
    $selling_price = $_POST['selling_price'];
    $qty = $_POST['qty'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $status = isset($_POST['status']) ? '1' : '0';
    $trending = isset($_POST['trending']) ? '1' : '0';
    // $image = $_FILES['image']['name'];

    // $product_images = $_FILES['product_images']['name'];
    // print_r($_POST);
    // die;

    // $path = "../uploads";

    // $allowed_extension = array('png', 'jpg', 'jpeg');

    // $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    // $filename = time() . '.' . $image_ext;

    // if ($name != "" && $slug != "" && $description != "") {

    // if (in_array($image_ext, $allowed_extension)) {

    //     move_uploaded_file($_FILES['image']['tmp_name'], $path . '/' . $filename);

    //     $product_query = "INSERT INTO `products`(`category_id`, `name`, `slug`, `small_description`, `description`, `original_price`, `selling_price`,  `qty`, `status`, `trending`, `meta_title`, `meta_keywords`, `meta_description`,`image`) VALUES ('$category_id','$name','$slug','$small_description','$description','$original_price','$selling_price','$qty','$status','$trending','$meta_title','$meta_keywords','$meta_description','$filename')";

    //     $product_query_run = mysqli_query($conn, $product_query);

        
    

    //     if ($product_query_run) {
                    
    //                 $_SESSION['message'] = "Product Added Successfully";
    //                 header("Location:add-product.php");
    //                 exit();
    //             }
    //              else {
    //                 //something went wrong
    //                 $_SESSION['message'] = "something went wrong";
    //                 header("Location:add-product.php");
    //                 exit();
    //             }
//     }
// }

    $file = '';
    $file_tmp = '';
    $path = "../product_images";
  
    // echo $data;

    $product_query = "INSERT INTO `products`(`category_id`, `name`, `slug`, `small_description`, `description`, `original_price`, `selling_price`,  `qty`, `status`, `trending`, `meta_title`, `meta_keywords`, `meta_description`) VALUES ('$category_id','$name','$slug','$small_description','$description','$original_price','$selling_price','$qty','$status','$trending','$meta_title','$meta_keywords','$meta_description')";

    $product_query_run = mysqli_query($conn, $product_query);
   

        if ($product_query_run) {
            $product_id = mysqli_insert_id($conn);
            $data = ' ';
            foreach ( $_FILES['product_images']['name'] as $key => $value) {
            // echo $key . "</br>";
                $file = $_FILES['product_images']['name'][$key];
                $file_tmp = $_FILES['product_images']['tmp_name'][$key];
                move_uploaded_file($file_tmp, $path . '/' . $file);
                $data .=$file." ";
                
                
                $product_image_query = "INSERT INTO `product_images`(`product_id`, `product_images`) VALUES ('$product_id', '$data')";
                $fire =  mysqli_query($conn, $product_image_query);
            
                }
                    
                $_SESSION['message'] = "Product Added Successfully";
                header("Location:add-product.php");
                exit();
            }
                else {
                //something went wrong
                $_SESSION['message'] = "something went wrong";
                header("Location:add-product.php");
                exit();
            }



} else if (isset($_POST['delete_product_id'])) {
    $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);

    $product_query = "SELECT * FROM products WHERE id='$product_id' ";
    $product_query_run = mysqli_query($conn, $product_query);
    $product_data = mysqli_fetch_array($product_query_run);
    $image = $product_data['image'];

    $delete_query = "DELETE FROM products WHERE id = '$product_id' ";
    $delete_query_run = mysqli_query($conn, $delete_query);


    if ($delete_query_run) {
        // ***************** show error while deleting last product.**********
        if (file_exists("../uploads/" . $image)) {
            unlink("../uploads/" . $image);
        }

        // header("Location:products.php");
        $_SESSION['message'] = "Product deleted Successfully";
        header("Location:add-product.php");
        exit();
        // redirect("products.php", "product deleted successfully");

    } else {
        // header("Location:products.php");

        $_SESSION['message'] = "Something Went Wrong";
        header("Location:add-product.php");

        exit(0);
        // redirect("products.php", "Something Went Wrong");

    }


}
else if (isset($_POST['update_product_btn'])) {
    $product_id = $_POST['product_id'];
    $category_id = $_POST['category_id'];

    $name = $_POST['name'];

    $slug = $_POST['slug'];
    $small_description = $_POST['small_description'];
    $description = $_POST['description'];
    $original_price = $_POST['original_price'];
    $selling_price = $_POST['selling_price'];
    $qty = $_POST['qty'];
    $meta_title = $_POST['meta_title'];
    $meta_description = $_POST['meta_description'];
    $meta_keywords = $_POST['meta_keywords'];
    $status = isset($_POST['status']) ? '1' : '0';
    $trending = isset($_POST['trending']) ? '1' : '0';

    $update_product_query = "UPDATE products SET category_id ='$category_id', name='$name', slug = '$slug', small_description='$small_description', description = '$description', meta_description = '$meta_description', meta_keywords='$meta_keywords', status='$status', trending='$trending' WHERE id='$product_id' ";

    $update_product_query_run = mysqli_query($conn, $update_product_query);
    
    
    $new_image = $_FILES['product_images']['name'];
    $old_image = $_FILES['old_image'];
        // print_r($_FILES);
        // die;
    
    $path = "../product_images";
    
    if ($update_product_query_run) {
        $product_id = mysqli_insert_id($conn);
        $data = ' ';
        foreach ( $new_image as $key => $value) {
        
        // echo $key . "</br>";
        if ($new_image != "") {
            $allowed_extension = array('png', 'jpg', 'jpeg');
            
            $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
            $update_filename = time() . '.' . $image_ext;
        } else {
            $update_filename = $old_image;
        }
            // $update_filename = $_FILES['product_images']['name'][$key];
            $file_tmp = $_FILES['product_images']['tmp_name'][$key];
            move_uploaded_file($file_tmp, $path . '/' . $update_filename);
            $data .=$update_filename." ";
            // print_r($data);
            // die;
            
            
            $update_product_image_query = "UPDATE `product_images` SET product_images = '$data' WHERE product_id = '$product_id'";

            $fire =  mysqli_query($conn, $update_product_image_query);
            if (file_exists("../product_images/" . $old_image)) {
                unlink("../product_images/" . $old_image);
            }
            
            }
            
            $_SESSION['message'] = "Product updated Successfully";
            header("Location:products.php");
            exit();
        }
}
else {
    header("Location:index.php");
    exit();
}

// }

?>