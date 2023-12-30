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
					<div class="container mt-5">
						<div class="row">
							
							<div class="col-md-4">
								<h4>Address Details</h4>
								<div class="form-row">
									<label for="firstName">Company Name</label>
									<input type="text" class="form-control" name="company" value="<?php echo $company_data[0]->company_name; ?>" readonly>
								</div>

								<div class="form-row">
									<label for="address">Billing Address</label>
									<textarea class="form-control" rows="4" readonly><?php echo $billing_address[0]->address1 . "," .
																							$billing_address[0]->address2 . ",\n" .
																							$billing_address[0]->city . "," .
																							$billing_address[0]->district . "," .
																							$billing_address[0]->state . "," .
																							$billing_address[0]->country . "," .
																							$billing_address[0]->pincode . ",\n" .
                                                                                            $company_data[0]->mobile . ",\n" .
                                                                                            $company_data[0]->email;
																						?>
                                </textarea>
                                </div>
							<div class="form-row">
									<label for="address">Shipping Address</label>
									<textarea class="form-control" rows="4" readonly><?php echo $billing_address[0]->address1 . "," .
																							$shipping_address[0]->address2 . ",\n" .
																							$shipping_address[0]->city . "," .
																							$shipping_address[0]->district . ",=" .
																							$shipping_address[0]->state . "," .
																							$shipping_address[0]->country . "," .
																							$shipping_address[0]->pincode;
																						?>
                                </textarea>
								</div>
                                
								<div class="form-group">
									<label for="address">Delivery Date</label>
									<input type="date" class="form-control " name="delivery_date" id="delivery_date" />
								</div>
							</div>

							<div class=" col-md-8">
								<div class="ordersummary">
									<h4>Order Summary</h4>
									<table style="border: 1px; width:100%;">
										<tr>
											<th style="width:20%;">Image</th>
											<th style="width:40%;">Product Name</th>
											<th style="width:10%;">Price</th>
											<th style="width:20%;">Qty</th>
											<th style="width:10%;">Total</th>
										</tr>
										<?php
<?php
$CI =& get_instance();
$sub_tot = 0;

foreach ($cartdatas as $row) {
    ?>
    <tr>
        <td>
            <img src="<?php echo ($row->image) ? $row->image : 'path_to_default_image.jpg'; ?>" alt="<?php echo $row->variation_name; ?>" style="width: 50px; height: 50px; margin-right: 10px; float: left;">
        </td>
        <td><?php echo $row->variation_name; ?></td>
        <td><?php echo $row->price; ?></td>
        <td><input type="text" class="product-qty" value="<?php echo $row->qty; ?>" data-cart_id="<?php echo $row->cart_id; ?>"></td>
        <td><?php echo $row->qty * $row->price; ?></td>
    </tr>
    <?php
    $sub_tot += ($row->qty * $row->price);
}
$CI->sub_tot = $sub_tot;
?>

										<tr>
											<td colspan="2" class="text-left"><b style="margin-left: 123px;">Sub Total</b></td>
											<td colspan="5" class="text-center"><b style="margin-left: 123px;"><?php echo $sub_tot . ''; ?></td>
										</tr>
                                        <tr>
											<td colspan="2" class="text-left"><b style="margin-left: 123px;">Delivery Charges</b></td>
											<td colspan="3" class="text-center"><b style="margin-left: 123px;"><input type="text" class=" addprice" name="delivery_price" id="delivery_price" /></td>
											<td id="delivery_price_text"></td>
										</tr>
										<tr>
											<td colspan="2" class="text-left"><b style="margin-left: 123px;">Discount %</b></td>
											<td colspan="3" class="text-center"><b style="margin-left: 123px;"><input type="text" class="addprice" name="discount_price" id="discount_price" /> </td>
											<th id="discount_price_text"></th>
										</tr>
										<tr>
											<td colspan="2" class="text-left"><b style="margin-left: 123px;">Tax  %</b></td>
											<td colspan="3" class="text-center"><b style="margin-left: 123px;"><input type="text" class="addprice" name="tax" id="tax" /></b></td>
											<th id="tax_price_text"></th>
										</tr>

										<tr>
											<td colspan="3" class="text-left"><b style="margin-left: 123px;">Total</td>
											<td colspan="4" class="text-center"><b style="margin-left: 123px;"><input type="hidden" id="total" name="total" value="<?php echo $sub_tot; ?>"></td>
											<th id="total_text"><?php echo $sub_tot . ''; ?></th>
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

