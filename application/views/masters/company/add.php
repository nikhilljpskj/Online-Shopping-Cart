<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<style>
	#button1 {
		background-color: #008CBA;
		border: none;
		color: white;
		padding: 2px 20px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 10px;
		margin: 2px 5px;
		margin: 20px;

	}

	#button2 {
		background-color: #008CBA;
		border: none;
		color: white;
		padding: 1px 20px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-size: 10px;
		margin: 2px 2px;
		margin: 15px;
	}

	.btn-circle {
		width: 10px;
		height: 30px;
		text-align: center;
		padding: 2px 0;
		font-size: 5px;
		line-height: 1.428571429;
		border-radius: 20px;
	}

	.btn-circle.btn-lg {
		width: 50px;
		height: 50px;
		padding: 10px 16px;
		font-size: 18px;
		line-height: 1.33;
		border-radius: 25px;
	}

	.btn-circle.btn-xl {
		width: 70px;
		height: 70px;
		padding: 10px 16px;
		font-size: 24px;
		line-height: 1.33;
		border-radius: 35px;
	}

	i.mdi.mdi-fullscreen {
		float: right;
		margin-left: 960px;
	}
</style>
<?php
if (!empty($default)) {

	$company_name = $default['company_name'];
	$phone = $default['phone'];
	$mobile = $default['mobile'];
	$email = $default['email'];
	$gstno = $default['gstno'];
	$panno = $default['panno'];
	$credit_days = $default['credit_days'];
	$payment_mode = $default['payment_mode'];
	$currency = $default['currency'];
	$status = $default['status'];
} else {

	$company_name = ($_POST['company_name']) ? $_POST['company_name'] : '';
	$phone = ($_POST['phone_number']) ? $_POST['phone_number'] : '';
	$mobile = ($_POST['mobile']) ? $_POST['mobile'] : '';
	$email = ($_POST['email']) ? $_POST['email'] : '';
	$gstno = ($_POST['gstno']) ? $_POST['gstno'] : '';
	$panno = ($_POST['panno']) ? $_POST['panno'] : '';
	$credit_days = ($_POST['credit_days']) ? $_POST['credit_days'] : '';
	$payment_mode = ($_POST['payment_mode']) ? $_POST['payment_mode'] : '';
	$currency = ($_POST['currency']) ? $_POST['currency'] : '';
	$status = ($_POST['status']) ? $_POST['status'] : '';
}
?>
<section id="basic-horizontal-layouts">
	<div class="row match-height">
		<div class="col">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title"><?php echo $heading; ?></h4>
					<div class="float-right ">
						<a class="btn btn-primary waves-effect waves-light" href="<?php echo base_url('/company'); ?>"> Back</a>
					</div>
				</div>
					
				<?php $this->load->view('validation_msg'); ?>
				<div class="card-body">
					<?php echo form_open_multipart($form_url, array('id' => 'registerForm', 'class' => 'form form-horizontal')) ?>
					<div class="form-body">
						<div class="row">
							<div class="col-md-3 col-lg-3">
								<div class="form-group">
									<label class="required">Company Name</label>
									<input name="company_name" id="company_name" type="text" class="form-control" placeholder="Enter Company name" value="<?php echo $company_name; ?>" autofocus>
								</div>
							</div>
							<div class="col-md-3 col-lg-3">
								<div class="form-group">
									<label class="required">Phone Number</label>
									<input name="phone_number" id="phone_number" type="text" class="form-control" placeholder="Enter phone number" value="<?php echo $phone; ?>">
								</div>
							</div>
							<div class="col-md-3 col-lg-3">
								<div class="form-group">
									<label class="">Mobile</label>
									<input name="mobile" id="mobile" type="text" class="form-control" placeholder="Enter Mobile" value="<?php echo $mobile; ?>" autofocus>
								</div>
							</div>

							<div class="col-md-3 col-lg-3">
								<div class="form-group">
									<label class="">Email Address</label>
									<input name="email" id="email" type="email" class="form-control" placeholder="Enter Email Address" value="<?php echo $email; ?>">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-3 col-lg-3">
								<div class="form-group">
									<label class="">GST NO</label>
									<input name="gstno" id="gstno" type="text" class="form-control" placeholder="Enter GST NO" value="<?php echo $gstno; ?>">
								</div>
							</div>
							<div class="col-md-3 col-lg-3">
								<div class="form-group">
									<label class="">PAN CARD</label>
									<input name="panno" id="panno" type="text" class="form-control" placeholder="Enter PAND CARD" value="<?php echo $panno; ?>">
								</div>
							</div>
							<div class="col-md-3 col-lg-3">
								<div class="form-group">
									<label class="">Credit Days</label>
									<input name="credit_days" id="credit_days" type="text" class="form-control" placeholder="Enter Credit Days" value="<?php echo $credit_days; ?>">
								</div>
							</div>
							<div class="col-md-3 col-lg-3">
								<div class="form-group">
									<label class="">Payment Mode</label>
									<input name="payment_mode" id="payment_mode" type="text" class="form-control" placeholder="Enter Payment Mode" value="<?php echo $payment_mode; ?>">
								</div>
							</div>
							<div class="col-md-3 col-lg-3">
								<div class="form-group">
									<label class="">Currency</label>
									<input name="currency" id="currency" type="text" class="form-control" placeholder="Enter Currency" value="<?php echo $currency; ?>">
								</div>
							</div>
						</div>
						<div class="max">
							<div class="fields">
								<?php if(!empty($addresses)){  foreach($addresses as $address){?>
									<div class="field col-md-12">
										<div class="row">
											<div class="col-md-3 col-lg-3">
												<div class="form-group">
													<label class="required">Address Type</label>
													<select name="address_type[]" class="form-control">
														<option value="Billing Address" <?php if($address->address_type == 'Billing Address'){ echo 'SELECTED';} ?>>Billing Address</option>
														<option value="Shipping Address" <?php if($address->address_type == 'Shipping Address'){ echo 'SELECTED';} ?>>Shipping Address</option>
													</select>
												</div>
											</div>
											<div class="col-md-3 col-lg-3">
												<div class="form-group">
													<label class="required">Address 1</label>
													<input name="address1[]" type="text" class="form-control" placeholder="Enter Address Line1" value="<?php echo $address->address1; ?>" required>
												</div>
											</div>
											<div class="col-md-3 col-lg-3">
												<div class="form-group">
													<label class="required">Address 2</label>
													<input name="address2[]" type="text" class="form-control" placeholder="Enter Address Line2" value="<?php echo $address->address2; ?>" required>
												</div>
											</div>
											<div class="col-md-3 col-lg-3">
												<div class="form-group">
													<label class="required">City</label>
													<input name="city[]" id="city" type="text" class="form-control" placeholder="Enter City" value="<?php echo $address->city; ?>" required>
												</div>
											</div>
											<div class="col-md-3 col-lg-3">
												<div class="form-group">
													<label class="required">Pincode</label>
													<input name="pincode[]" id="pincode" type="text" class="form-control" placeholder="Enter Pincode" value="<?php echo $address->pincode; ?>" required>
												</div>
											</div>
											<div class="col-md-3 col-lg-3">
												<div class="form-group">
													<label class="required">District</label>
													<input name="district[]" id="district" type="text" class="form-control" placeholder="Enter District" value="<?php echo $address->district; ?>" required>
												</div>
											</div>
											<div class="col-md-3 col-lg-3">
												<div class="form-group">
													<label class="required">State</label>
													<input name="state[]" id="state" type="text" class="form-control" placeholder="Enter state" value="<?php echo $address->state; ?>" required>
												</div>
											</div>
											<div class="col-md-3 col-lg-3">
												<div class="form-group">
													<label class="required">Country</label>
													<input name="country[]" id="country" type="text" class="form-control" placeholder="Enter country" value="<?php echo $address->country; ?>" required>
												</div>
											</div>
											<input type="hidden" name="address_id[]" value="<?php echo $address->id;?>">
										</div>
									</div>
								<?php } }else{ ?>
									<div class="field col-md-12">
										<div class="row">
											<div class="col-md-3 col-lg-3">
												<div class="form-group">
													<label class="required">Address Type</label>
													<select name="address_type[]" class="form-control">
														<option value="Billing Address">Billing Address</option>
														<option value="Shipping Address">Shipping Address</option>
													</select>
												</div>
											</div>
											<div class="col-md-3 col-lg-3">
												<div class="form-group">
													<label class="required">Address 1</label>
													<input name="address1[]" type="text" class="form-control" placeholder="Enter Address Line1" value="<?php echo (isset($_POST['address1[]'])) ? $_POST['address1[]'] : ''; ?>" required>
												</div>
											</div>
											<div class="col-md-3 col-lg-3">
												<div class="form-group">
													<label class="required">Address 2</label>
													<input name="address2[]" type="text" class="form-control" placeholder="Enter Address Line2" value="<?php echo (isset($_POST['address2[]'])) ? $_POST['address2[]'] : ''; ?>" required>
												</div>
											</div>
											<div class="col-md-3 col-lg-3">
												<div class="form-group">
													<label class="required">City</label>
													<input name="city[]" id="city" type="text" class="form-control" placeholder="Enter City" value="<?php echo (isset($_POST['city[]'])) ? $_POST['city[]'] : ''; ?>" required>
												</div>
											</div>
											<div class="col-md-3 col-lg-3">
												<div class="form-group">
													<label class="required">Pincode</label>
													<input name="pincode[]" id="pincode" type="text" class="form-control" placeholder="Enter Pincode" value="<?php echo (isset($_POST['pincode[]'])) ? $_POST['pincode[]'] : ''; ?>" required>
												</div>
											</div>
											<div class="col-md-3 col-lg-3">
												<div class="form-group">
													<label class="required">District</label>
													<input name="district[]" id="district" type="text" class="form-control" placeholder="Enter District" value="<?php echo (isset($_POST['district[]'])) ? $_POST['district[]'] : ''; ?>" required>
												</div>
											</div>
											<div class="col-md-3 col-lg-3">
												<div class="form-group">
													<label class="required">State</label>
													<input name="state[]" id="state" type="text" class="form-control" placeholder="Enter state" value="<?php echo (isset($_POST['state[]'])) ? $_POST['state[]'] : ''; ?>" required>
												</div>
											</div>
											<div class="col-md-3 col-lg-3">
												<div class="form-group">
													<label class="required">Country</label>
													<input name="country[]" id="country" type="text" class="form-control" placeholder="Enter country" value="<?php echo (isset($_POST['country[]'])) ? $_POST['country[]'] : ''; ?>" required>
												</div>
											</div>
										</div>
									</div>
								<?php } ?>
							</div>
							<div class="row">
								<div class="col-md-2">
									<button type="button" id="button1" class="add-field btn btn-default"><i class="ficon bx bx-plus"></i></button>
									<button type="button" id="button2" class="remove-field btn btn-default"><i class="ficon bx bx-minus"></i></button>
								</div>
							</div>
						</div>
					</div>
					<div class="form-group mb-0">
						<div>
							<button name="submit" type="submit" class="btn btn-primary waves-effect waves-light mr-1">
								Submit
							</button>
						</div>
					</div>
					<?php form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</section>

<script>
    $(document).ready(function () {
        $('.max').each(function () {
            var $wrapper = $('.fields', this);

            // Add new address field
            $(".add-field", $(this)).click(function (e) {
                e.preventDefault();

                var count = $('.field').length;

                var append_data = `<div class="field col-md-12">
                                    <div class="row">
                                        <div class="col-md-3 col-lg-3">
                                            <div class="form-group">
                                                <label class="required">Address Type</label>
                                                <select name="address_type[]" class="form-control" required>
                                                    <option value="Billing Address">Billing Address</option>
                                                    <option value="Shipping Address">Shipping Address</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-lg-3">
                                            <div class="form-group">
                                                <label class="required">Address 1</label>
                                                <input name="address1[]" type="text" class="form-control" placeholder="Enter Address Line1" value="" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-lg-3">
                                            <div class="form-group">
                                                <label class="required">Address 2</label>
                                                <input name="address2[]" type="text" class="form-control" placeholder="Enter Address Line2" value="" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-lg-3">
                                            <div class="form-group">
                                                <label class="required">City</label>
                                                <input name="city[]" id="city" type="text" class="form-control" placeholder="Enter City" value="" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-lg-3">
                                            <div class="form-group">
                                                <label class="required">Pincode</label>
                                                <input name="pincode[]" id="pincode" type="text" class="form-control" placeholder="Enter Pincode" value="" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-lg-3">
                                            <div class="form-group">
                                                <label class="required">District</label>
                                                <input name="district[]" id="district" type="text" class="form-control" placeholder="Enter District" value="" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-lg-3">
                                            <div class="form-group">
                                                <label class="required">State</label>
                                                <input name="state[]" id="state" type="text" class="form-control" placeholder="Enter state" value="" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-lg-3">
                                            <div class="form-group">
                                                <label class="required">Country</label>
                                                <input name="country[]" id="country" type="text" class="form-control" placeholder="Enter Country" value="" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
                $wrapper.append(append_data);
            });

            // Remove last address field
            $('.remove-field', $(this)).click(function () {
                if ($('.field').length > 1)
                    $('.field').last().remove();
            });
        });


    $('#registerForm').submit(function (e) {
        e.preventDefault();

        // Prepare form data
        var formData = $(this).serialize();

        // AJAX request
        $.ajax({
            url: "<?php echo site_url('masters/Company/saveAddress'); ?>",
            type: "POST",
            data: formData,
            success: function (response) {
                var data = JSON.parse(response);
                console.log(data);
            },
            error: function (error) {
                console.error(error);
            }
        });
    });



    });
</script>


<style type="text/css">
	.required:after {
		content: " *" !important;
		color: red !important;
	}
</style>
