<style>
	li.borderless {
		border: 0 none;
	}

.col-md-6,
.ordersummary,
.tap {
    box-shadow: 1px 6px 20px #5c5858;
    padding: 20px;
    border-radius: 15px;
}

.ordersummary {
    display: flex;
    justify-content: flex-end;
}


	.addprice,
	.product-qty {
		width: 30%;
		height: calc(1.5em + 0.75rem + 2px);
		font-size: .875rem;
		font-weight: 400;
		line-height: 1.5;
		color: #495057;
		background-color: #fff;
		background-clip: padding-box;
		border: 1px solid #ced4da;
		border-radius: 0.25rem;
	}
</style>
<style>
	#loading {
		width: 100%;
		height: 100%;
		top: 0px;
		left: 0px;
		position: fixed;
		display: block;
		opacity: 0.7;
		background-color: #fff;
		z-index: 99;
		text-align: center;
		background: rgba(255, 255, 255, .8) url('http://i.stack.imgur.com/FhHRx.gif') 50% 50% no-repeat;
	}

	#loading-content {
		position: absolute;
		top: 50%;
		left: 40%;
		text-align: center;
		z-index: 100;
	}

	.hide {
		display: none;
	}
</style>
<section id="basic-horizontal-layouts">
	<div class="row match-height">
		<div class="col">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Checkout</h4>
					<div class="float-right">
						<a class="btn btn-primary" href="<?php echo base_url('/groupProducts'); ?>">Back</a>
					</div>
				</div>
				<div class="card-body">
					<div class="container mt-6">
						<div class="row">
							<!-- Billing & Shipping Information -->
						
							<!--	<div class="form-group">
									<label for="email">Email ID</label>
									<input type="text" class="form-control" name="email" value="<?php echo $company_data[0]->email; ?>" readonly>
								</div>
								<div class="form-group">
									<label for="mobile">Mobile</label>
									<input type="text" class="form-control" name="mobile" value="<?php echo $company_data[0]->mobile; ?>" readonly>
								</div>-->
                        
                                <input type="text" class="form-control" name="company" value="<?php echo $company_data[0]->company_name; ?>" readonly>
									 <label for="address">Billing Address</label>
									<p class="form-control"  readonly><?php echo $billing_address[0]->address1 . "," .
																							$billing_address[0]->address2 . ",\n" .
																							$billing_address[0]->city . "," .
																							$billing_address[0]->district . "," .
																							$billing_address[0]->state . "," .
																							$billing_address[0]->country . "," .
																							$billing_address[0]->pincode . ",\n" .
                                                                                            $company_data[0]->mobile . ",\n" .
                                                                                            $company_data[0]->email;
																						?>
                                </p>
									<label for="address">Shipping Address</label>
                            
                                    <select name="shipping_address" class="form-control" id="shipping_address">
                                    <!-- Options will be dynamically added here -->
                                    </select>

                              
                                  <label for="address">Delivery Date</label>
									<input type="date" class="form-control " name="delivery_date" id="delivery_date" />
								
                                </div>
								</div>
                               
                            </div>
	
                        </div>
                        <div class="row">
							<div class=" col-md-12">
                           
								<div class="ordersummary">
									<h4>Order Summary</h4>
									<table style="border: 1px; width:100%;">
										<tr><th style="width:20%;">Group Name</th>
											<th style="width:20%;">Image</th>
											<th style="width:20%;">Product Name</th>
											<th style="width:10%;">Price</th>
											<th style="width:20%;">Qty</th>
											<th style="width:10%;">Total</th>
                                            <th style="width:10%;">Actions</th>
										</tr>
										<?php
										$CI =& get_instance();
										
										$sub_tot = 0;
										foreach ($cartdatas as $row) { ?>
											<tr>
                                                <td>
                                                    <?php
                                                    if (!empty($row->group_name)) {
                                                        echo $row->group_name;
                                                    } else {
                                                        echo $row->variation_name;
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php if (!empty($row->product_image)): ?>
                                                        <img src="<?php echo base_url('attachments/productimg/' . $row->product_image); ?>" alt="<?php echo $row->variation_name; ?>" width="50px" height="50px">
                                                    <?php else: ?>
                                                        <img src="<?php echo base_url('attachments/products/' . $row->image); ?>" alt="<?php echo $row->variation_name; ?>" width="50px" height="50px">
                                                    <?php endif; ?>
                                                </td>
												<!--<td><img src="<?php echo $row->image; ?>" alt="<?php echo $row->variation_name; ?>" style="width: 50px; height: 50px; margin-right: 10px; float: left;"></td> -->
												<td><?php echo $row->product_name ? $row->product_name : $row->variation_name; ?></td>
												<td><?php echo $row->price; ?></td>
												<td><input type="text" class="product-qty" value="<?php echo $row->qty; ?>" data-cart_id="<?php echo $row->cart_id; ?>"></td>
												<td class="text-left"><?php echo $row->qty * $row->price; ?></td>
                                                <td>
                                                <button onclick="removeCart(<?php echo $row->cart_id; ?>)" class="btn btn-danger"><i class="ficon bx bx-trash"></i></button>
                                                </td>
											</tr>
										<?php $sub_tot += ($row->qty * $row->price);
										} 
										$CI->sub_tot = $sub_tot;
										?>
										<tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
											<td class="text-left"><b>Sub Total</b></td>
											<td class="text-left"><b><?php echo $sub_tot; ?></td>
										</tr>
                                        <tr name="ship_charge">
                                        <td></td>
                                        <td></td>
                                        <td></td>
											<td class="text-left"><b>Shipment Charges</b></td>
											<td class="text-left"><b><input type="text" class=" addprice" name="delivery_price" id="delivery_price" /></td>
											<th id="delivery_price_text"></th>
										</tr>
								
<tr id="tax_row" style="display:none;">
    <td></td>
    <td></td>
    <td></td>
    <td class="text-left"><b>Tax %</b></td>
    <td class="text-left">
        <input type="text" class="addprice" name="tax" id="tax" readonly>
    </td>
    <th id="tax_price_text"></th>
</tr>

<tr id="sgst_row" style="display:none;">
    <td></td>
    <td></td>
    <td></td>
    <td class="text-left"><b>Sgst %</b></td>
    <td class="text-left"><input type="text" class="addprice" name="sgst" id="sgst" value="9"></td>
    <th id="sgst_text"></th>
</tr>
<tr id="igst_row" style="display:none;">
    <td></td>
    <td></td>
    <td></td>
    <td class="text-left"><b>Igst %</b></td>
    <td class="text-left"><input type="text" class="addprice" name="igst" id="igst" value="18"></td>
    <th id="igst_text"></th>
</tr>
<tr id="cgst_row" style="display:none;">
    <td></td>
    <td></td>
    <td></td>
    <td class="text-left"><b>Cgst %</b></td>
    <td class="text-left"><input type="text" class="addprice" name="cgst" id="cgst" value="9"></td>
    <th id="cgst_text"></th>
</tr>

										<tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
											<td class="text-left"><b>Total</td>
											<td class="text-left"><b><input type="hidden" id="total" name="total" value="<?php echo number_format($sub_tot, 3); ?>"></td>
                                            <th id="total_text"><?php echo number_format($sub_tot, 3); ?></th>
										</tr>
									</table>
								</div>
                               <br>
								<div class="ordersummary">
									<!-- <h4>Order Summary</h4> -->
									<br>
									<!-- More form elements as needed -->
									
                                    <button type="submit" class="btn btn-primary" onclick="pay_now();">Place Order</button>
                                    
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<div id="loading" style="display: none;">
	<div id="loading-content">
		<h5>Please wait. Your order is under process</h5>
	</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>

$(document).ready(function () {


            $.ajax({
            url: "<?php echo site_url('sales/orders/getShippingAddresses'); ?>",
            method: "POST",
            type: "ajax",
            success: function (response) {
                var shippingAddresses = JSON.parse(response);

                // Populate dropdown with shipping addresses
                var selectDropdown = $('#shipping_address');
                shippingAddresses.forEach(function (address) {
                    var option = `<option value="${address.address1}, ${address.address2}, ${address.city}, ${address.district}, ${address.state}, ${address.country}, ${address.pincode}">${address.address1}, ${address.address2}, ${address.city}, ${address.district}, ${address.state}, ${address.country}, ${address.pincode}</option>`;
                    selectDropdown.append(option);
                });
            },
            error: function (error) {
                console.error(error);
            }
        });





    var country = $('#country').val().toLowerCase();
    console.log('Country:', country);

    updateTaxRows(country);

    $('#country').on('change', function () {
        var newCountry = $(this).val().toLowerCase();
        console.log('New Country:', newCountry);

        updateTaxRows(newCountry);
    });

    var userLevel = <?php echo json_encode($user_level); ?>;

    if (userLevel == 1) {
        // If the user_level is not equal to 1, hide the shipment charge row
        $('[name="ship_charge"]').closest('tr').hide();
    }
});

function updateTaxRows(country) {
    
    $('#tax_row, #sgst_row, #igst_row, #cgst_row').hide();

    if (country === 'india') {
        
        $('#sgst_row, #igst_row, #cgst_row').show();
        $('#sgst_text').text(''); 
        $('#igst_text').text('');
        $('#cgst_text').text('');

        // Set default values for Sgst, Igst, Cgst
        $('#sgst').val('9');
        $('#igst').val('18');
        $('#cgst').val('9');

        // Calculate and set tax based on Sgst, Igst, Cgst values
        var sgst = parseFloat($('#sgst').val());
        var igst = parseFloat($('#igst').val());
        var cgst = parseFloat($('#cgst').val());
        var totalTax = sgst + igst + cgst;
        console.log(totalTax);
        $('#tax').val(totalTax);

    } else {
        // Show only Tax row for other countries
        $('#tax_row').show();
        $('#tax').val(0);
    }
}




function removeCart(cart_id) {
    $.ajax({
        url: "<?php echo site_url('sales/orders/removeCart'); ?>",
        method: "POST",
        type: "ajax",
        data: {
            cart_id: cart_id
        },
        success: function(result) {
            if (result > 0) {
                Swal.fire(
                    '',
                    'Product Removed',
                    'success'
                ).then(function() {
                    // Reload or refresh the page
                    location.reload();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                });
            }
            // Assuming showCartItems is a function to update the cart display
            showCartItems();
        },
        error: function(error) {
            console.log(error);
        }
    });
}
</script>
