$(document).ready(function () {
  $(".increment-btn").click(function (e) {
    e.preventDefault();
    var incre_value = $(this).parents(".quantity").find(".qty-input").val();
    var value = parseInt(incre_value, 10);
    value = isNaN(value) ? 0 : value;
    if (value < 10) {
      value++;
      $(this).parents(".quantity").find(".qty-input").val(value);
    }
  });

  $(".decrement-btn").click(function (e) {
    e.preventDefault();
    var decre_value = $(this).parents(".quantity").find(".qty-input").val();
    var value = parseInt(decre_value, 10);
    value = isNaN(value) ? 0 : value;
    if (value > 1) {
      value--;
      $(this).parents(".quantity").find(".qty-input").val(value);
    }
  });

  // $(".addToCartBtn").click(function (e) {
  $(document).on("click", ".addToCartBtn", function (e) {
    e.preventDefault();

    var qty = $(this).closest(".product_data").find(".qty-input").val();
    var prod_id = $(this).val();
    // alert(prod_id);

    $.ajax({
      method: "POST",
      url: "functions/handlecart.php",
      data: {
        prod_id: prod_id,
        prod_qty: qty,
        scope: "add",
      },
      success: function (response) {
        if (response == 201) {
          // alert("Login to continue");

          alertify.success("Product added to cart");
        } else if (response == 401) {
          alertify.success("Login to continue");
        } else if (response == "existing") {
          alertify.success("Product already in cart");
        } else if (response == 500) {
          alertify.success("Something went wrong");
        }
      },
    });
  });

  $(document).on("click", ".updateQty", function () {
    // var qty = $(this).closest(".product_data").find(".qty-input").val();
    var qty = $(this).parents(".quantity").find(".qty-input").val();
    // var selling_price = $(this).parents(".price").find(".selling_price").val();
    // var net_price = $(this).parents(".updatePrice").find(".net_price").val();

    // alert($qty);
    // die;
    var prod_id = $(this)
      .parents(".cart-product-quantity")
      .find(".prodId")
      .val();
    // var prod_id = $(this).val();
    // alert(prod_id);
    // var up_prod = 1;
    $.ajax({
      method: "POST",
      url: "functions/handlecart.php",
      data: {
        prod_id: prod_id,
        prod_qty: qty,
        // net_price: selling_price,

        scope: "update",
      },
      success: function (response) {
        location.reload(true);

        // if (response == 200) {
        //   location.reload(true);
        //   // $("#mycart").reload("#mycart");
        //   alertify.success("Quantity updated");
        //   // alertify.success("Item Deleted Successfully");
        // }
      },
    });
  });

  $(document).on("click", ".deleteItem", function () {
    // var cart_id = $(this).val();
    var cart_id = $(this).parents(".delete").find(".deleteItem").val();
    // alert(cart_id);
    $.ajax({
      method: "POST",
      url: "functions/handlecart.php",
      data: {
        cart_id: cart_id,
        scope: "delete",
      },
      success: function (response) {
        // alert(response);
        if (response == 200) {
          location.reload(true);
          // $("#mycart").reload("#mycart");

          alert("Item Deleted Successfully");
          // alertify.success("Item Deleted Successfully");
        } else {
          alertify.success(response);
        }
      },
    });
  });
});
