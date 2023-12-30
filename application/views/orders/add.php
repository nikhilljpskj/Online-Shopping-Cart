<style>
    .rowmar{
        margin-left: 10px;
    }

    .mar{
        margin: 20px; 
    }

    .selgap {
    padding: 2px;
    }

    #product {
        width: 14rem;
    }

    .product {
        box-shadow: 1px 6px 10px #5c5858;
        padding: 10px;
        border-radius: 25px;
    }

    .custom-select-width {
        width: 50%;
    }

    #cartTable {
        max-width: 20%; 
        margin: auto; 
        }

#cartTable th,
#cartTable td {
    text-align: center; 
    padding: 8px;
}
</style>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<?php $this->load->view('validation_msg'); ?>

<section id="basic-horizontal-layouts">
    <div class="row rowmar">
        <!-- Left Column -->
        <div class="col-md-6">
            <div class="card">
                <div class="form-group mar selgap">
                    <select name="variation_name" id="variation_name" class="form-control select custom-select-width selgap">
                        <option value="" data-product-id="">Variation Name</option>
                        <?php foreach ($variation_names as $variation): ?>
                            <option value="<?= $variation->pro_details_id ?>" data-product-id="<?= $variation->product_id ?>"><?= $variation->variation_name ?></option>
                        <?php endforeach; ?>
                    </select>
                    <br><br>
                    <!-- Inside the FIT select -->
                    <select name="fit_attribute" id="fit_attribute" class="form-control select custom-select-width selgap">
                        <option value="">Select FIT/FIT Translation</option>
                        <?php foreach ($product_attributes_combined_12_18 as $values): ?>
                            <option value="<?= $values ?>"><?= $values ?></option>
                        <?php endforeach; ?>
                    </select>
                    <br><br>
                    <select name="size_attribute" id="size_attribute" class="form-control select custom-select-width selgap">
                        <option value="">Select size</option>
                        <?php foreach ($product_attributes_other as $attribute): ?>
                            <option value="<?= $attribute ?>"><?= $attribute ?></option>
                        <?php endforeach; ?>
                    </select>
                    <br><br>
                    <select name="length_cm_attribute" id="length_cm_attribute" class="form-control select custom-select-width selgap">
                        <option value="">Select LENGTH/ENTREJAMBE(cms)</option>
                        <?php foreach ($product_attributes_combined_14_15 as $values): ?>
                            <option value="<?= $values ?>"><?= $values ?></option>
                        <?php endforeach; ?>
                    </select>
                    <br><br>
                    <select name="waist_inch_attribute" id="waist_inch_attribute" class="form-control select custom-select-width selgap">
                        <option value="">Select WAIST/TAILLE(inch)</option>
                        <?php foreach ($product_attributes_combined_16_17 as $values): ?>
                            <option value="<?= $values ?>"><?= $values ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="form-group mar selgap">
                    <div class="card-header">
                        <h4 class="card-title">Product List</h4>
                        <div class="float-right">
                            <button type="button" class="btn btn-primary" id="addToCartButton">
                                Add to Cart
                            </button>
                        </div>
                        <div class="float-right">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cartModal">
                                View Cart
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row card-columns" id="productList">
                        </div>
                        <div>
                            <img src="" id="productImage" alt="Product Image" width="300">
                            <div class="image-overlay" id="imageOverlay"></div>
                        </div>
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">View Cart</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="list-group" id="cartItems">
                    <!-- Cart items with images will be dynamically populated here as list items -->
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a href="<?php echo base_url('checkout'); ?>" class="btn btn-primary">Checkout</a>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function () {
    var selectedOptions = {};

    $('#variation_name, #fit_attribute, #size_attribute, #length_cm_attribute, #waist_inch_attribute').change(function () {
        updateRightSideContent();
    });

    function updateRightSideContent() {
        var productId = $('#variation_name').val();
        var fitAttribute = $('#fit_attribute').val();
        var sizeAttribute = $('#size_attribute').val();
        var lengthCmAttribute = $('#length_cm_attribute').val();
        var waistInchAttribute = $('#waist_inch_attribute').val();

        $.ajax({
            type: 'POST',
            url: "<?php echo site_url('sales/orders/getDetails'); ?>",
            data: {
                product_id: productId,
                fit_attribute: fitAttribute,
                size_attribute: sizeAttribute,
                length_cm_attribute: lengthCmAttribute,
                waist_inch_attribute: waistInchAttribute
            },
            dataType: 'json',
            success: function (response) {
                console.log('Response:', response);

                if (response && response.image) {
                    // Construct the full image URL
                    var imageUrl = "<?php echo base_url('attachments/products/'); ?>" + response.image;

                    // Set the image source
                    $('#productImage').attr('src', imageUrl);
                    $('#productImage').css({ 'width': '300px', 'height': '450px' });

                    // Construct the overlay text
                    var overlayText = response.variation_name + '<br>';
                    overlayText += fitAttribute ? fitAttribute + '/' : '';
                    overlayText += sizeAttribute ? sizeAttribute + '/' : '';
                    overlayText += lengthCmAttribute ? lengthCmAttribute + '/' : '';
                    overlayText += waistInchAttribute ? waistInchAttribute + '/' : '';

                    // Remove the trailing '/' character
                    overlayText = overlayText.replace(/\/$/, '');

                    // Append the product name to the overlay text if available
                    overlayText += response.product_name ? response.product_name + '<br>' : '';

                    // Display the overlay text
                    var overlayDiv = $('<div class="overlay-text">').html(overlayText);

                    var productList = $('#productList');
                    productList.empty();
                    productList.append(overlayDiv);
                } else {
                    // Handle the case where no image is received
                    console.log('No image received.');
                }
            },
            error: function (error) {
                console.error('Error:', error);
            }
        });
    }

    $('#addToCartButton').on('click', function () {
        var productId = $('#variation_name').val();
        var qty = 1;  // You can adjust the quantity as needed

        // Combine all selected values using '/'
        var productName = $('#fit_attribute').val() + '/' +
            $('#size_attribute').val() + '/' +
            $('#length_cm_attribute').val() + '/' +
            $('#waist_inch_attribute').val();

        // Get the user_id from the session
        var userId = <?= $this->session->userdata('id') ?>;

        // Send data to the server
        $.ajax({
            type: 'POST',
            url: "<?php echo site_url('sales/orders/createCart'); ?>",
            data: { pro_details_id: productId, qty: qty, user_id: userId, product_name: productName },
            dataType: 'json',
            success: function (response) {
                // Handle the response
                console.log('Response:', response);

                // Show SweetAlert message
                Swal.fire({
                    title: 'Added to Cart',
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then(() => {
                    // Reload the page after the user clicks OK
                    window.location.reload();
                });
            },
            error: function (error) {
                console.error('Error:', error);
            }
        });
    });
});

</script>
