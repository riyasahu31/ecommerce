var total_image = 1;
function add_more_images() {
  total_image++;
  var html =
    `<div class="col-md-6" id="add_image_box_` +
    total_image +
    `">
    <input type="file" name="product_images[]" class="form-control mt-2 required">
    <button type="button" class="btn btn-danger" onclick=remove_image("` +
    total_image +
    `") >remove</button></div>`;
  $("#add_image_box_1").after(html);
}
function remove_image(id) {
  $("#add_image_box_" + id).remove();
}
