<style>
.expand-btn {
    display: inline-block;
    padding: 8px 8px;
    background-color: green;
    color: white;
    text-decoration: none;
    border-radius: 20%;
    transition: background-color 0.3s;
}

.expand-btn:hover {
    background-color: darkgreen;
}

.cust{
    min-height: 60vh;
}
</style>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<section id="basic-datatable">
    <div class="row cust">
        <div class="col-12">
            <div class="card">
           <!-- <div class="row">
						<div class="col">
							<a class="btn btn-primary" href="<?php echo base_url('groupProducts/add') ?>">Add Group Products</a>
                            <div class="col">
							<a class="btn btn-primary" href="<?php echo base_url('product/add') ?>">Add Product</a>
						</div>
						</div>-->
					</div>
                <?php $this->load->view('validation_msg');?>
                <div class="card-body card-dashboard">
                    <p class="card-text"></p>
                                        <div class="row mb-2 justify-content-end">
                                         <div class="col-md-3">
                                         <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cartModal">View Cart</button>
                                         </div>
                        <div class="col-md-3">
                            <!-- Add a search box above the table -->
                            <input type="text" id="searchBox" class="form-control" style="width: 260px;" placeholder="Search by CODE">
                        </div>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table zero-configuration">
                            <thead>
                                <tr>
                                    
                                    <th class="text-center">ID</th>
                                    <th class="text-center">CODE</th>
                                    <th class="text-center">EXPAND</th>
                                    <th class="text-center">ITEMS</th>
                                    <th class="text-center">QUANTITY</th>
                                    <th class="text-center">Order</th>
                                </tr>
                            </thead>
                            <?php $i = 1; foreach ($results as $row) { ?>
                                <tr class="main-row">
                                 
                                    <td class="text-center"><?php echo $i++; ?></td>
                                    <td nowrap class="text-bold-500 text-center"><?php echo $row->group_name ?></td>
                                       <td class="text-center"> <a class="expand-btn" data-group-name="<?php echo $row->group_name ?>" onclick='fetchAndDisplayProducts("<?php echo $row->group_name ?>")'>+</a></td>
                                    <td class="text-justify"><?php echo $row->group_desc ?></td>
                                    <td class="text-center"><input type="number" class="quantity" name="quantity"></td>
                                    <td class="text-center">
                                        <a class="btn btn-success add-to-cart" data-group-name="<?php echo $row->group_name ?>" data-pro-details-ids="<?php echo $row->pro_details_ids ?>" onclick='addtocart(this, "<?php echo $row->pro_details_ids ?>", "<?php echo $row->group_name ?>")'>Add to Cart</a>
                                    </td>
                                </tr>
                                <tr class="sub-row" style="display: none;">
                                    <td colspan="7">
                                        <table class="sub-table bg-white" style="width:100%;">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" style="colour:black; width:10%; height:30px">No</th>
                                                    <th class="text-center" style="width:40%;">Product</th>
                                                    <th class="text-center" style="width:20%;">Price/unit</th>
                                                    <th class="text-center" style="width:30%;">Image</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Content will be dynamically added here using JavaScript -->
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            <?php } ?>
                        </table>
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

function addtocart(button, pro_details_ids, group_name) {
        var quantity = $(button).closest('tr').find('.quantity').val();

        $.ajax({
            url: "<?php echo site_url('masters/Group_products/movetocart'); ?>",
            method: "POST",
            type: "ajax",
            data: {
                groupName: group_name,
                proDetailsIds: pro_details_ids,
                quantity: quantity
            },
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
            error: function(error) {
                console.log(error);
            }
        });
    }





$(document).ready(function() {
    $(".expand-btn").click(function() {
        var $mainRow = $(this).closest("tr.main-row");
        var $subRow = $mainRow.next("tr.sub-row");

        // Check if there's an existing sub-row, remove it, and exit
        if ($subRow.length > 0) {
            $subRow.remove();
            return;
        }

        // Create a new sub-row and append it
        $mainRow.after('<tr class="sub-row" style="display: none;"><td colspan="7"><table class="sub-table bg-white" style="width:100%;"><thead><tr><th class="text-center" style="colour:black; width:10%; height:30px">No</th><th class="text-center" style="width:40%;">Product</th><th class="text-center" style="width:20%;">Price/unit</th><th class="text-center" style="width:30%;">Image</th></tr></thead><tbody></tbody></table></td></tr>');

        $subRow = $mainRow.next("tr.sub-row");

        // Toggle the sub-row for the clicked main-row only
        $subRow.toggle();

        // Check if the sub-row is visible, then fetch and display data
        if ($subRow.is(":visible")) {
            var groupCname = $mainRow.find(".text-bold-500").text();
            var $tbody = $subRow.find(".sub-table tbody");
            fetchAndDisplayProducts(groupCname, $tbody);
        }

        // Update the button text based on sub-row visibility
        var buttonText = $subRow.is(":visible") ? "-" : "+";
        $(this).text(buttonText);
    });

    $("#searchBox").on("input", function() {
        var searchText = $(this).val().toLowerCase();
        $(".main-row").each(function() {
            var codeText = $(this).find(".text-bold-500").text().toLowerCase();
            $(this).toggle(codeText.includes(searchText));
        });
    });
});


function fetchAndDisplayProducts(group_name, $tbody) {
    $.ajax({
        url: "<?php echo site_url('masters/Group_products/fetchProducts'); ?>",
        method: "POST",
        type: "ajax",
        data: { groupCname: group_name.trim() },
        success: function(result) {
            // Parse the result and dynamically add rows to the sub-table
            var products = JSON.parse(result);
            $tbody.empty();

            // Iterate through products and add rows to the sub-table
            for (var i = 0; i < products.length; i++) {
                var product = products[i];
                var newRow = "<tr>" +
                    "<td class='text-center'>" + (i + 1) + "</td>" +
                    "<td class='text-center text-bold-500'>" + product.variation_name + "</td>" +
                    "<td class='text-center text-bold-500'>" + product.final_price + "</td>" +
                    "<td class='text-center'><img src='" + product.image + "' width='50px' height='50px'></td>" +
                    "</tr>";
                $tbody.append(newRow);
            }
        },
        error: function(error) {
            console.log(error);
        }
    });
}



</script>
