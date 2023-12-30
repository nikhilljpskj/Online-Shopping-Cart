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
// if (!empty($default)) {

// 	$id = $default['id'];
// 	$brand_id = $default['brand_id'];
// 	$category_name = $default['category_name'];
// 	$status = $default['status'];
// } else {

// 	$id = '';
// 	$brand_id = ($_POST['brand_id']) ? $_POST['brand_id'] : '';
// 	$category_name = ($_POST['category_name']) ? $_POST['category_name'] : '';
// 	$status = ($_POST['status']) ? $_POST['status'] : '';
// }
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
					<h4 class="card-title">Basic Details</h4>
					<table class="table table-striped">
						<tbody>
							<tr>
								<th>Company Name</th>
								<td><?php echo $default['company_name']; ?></td>
							</tr>

							<tr>
								<th>Phone</th>
								<td><?php echo $default['phone']; ?></td>
							</tr>
							<tr>
								<th>Mobile</th>
								<td><?php echo $default['mobile']; ?></td>
							</tr>
							<tr>
								<th>Email</th>
								<td><?php echo $default['email']; ?></td>
							</tr>
							<tr>
								<th>Mobile</th>
								<td><?php echo $default['mobile']; ?></td>
							</tr>
							<tr>
								<th>GST NO</th>
								<td><?php echo $default['gstno']; ?></td>
							</tr>
							<tr>
								<th>PAN NO</th>
								<td><?php echo $default['panno']; ?></td>
							</tr>
							<tr>
								<th>Credit Days</th>
								<td><?php echo $default['credit_days']; ?></td>
							</tr>
							<tr>
								<th>Payment Modes</th>
								<td><?php echo $default['payment_mode']; ?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>
<section id="basic-horizontal-layouts">
	<div class="row match-height">
		<div class="col">
			<div class="card">
			<h4 class="card-title">Address Details</h4>
                <table class="table table-striped">
                    <tr>
                        <th>Address Type</th>
                        <th>Address 1</th>
                        <th>Address 2</th>
                        <th>City</th>
                        <th>Pincode</th>
                        <th>District</th>
                        <th>State</th>
                        <th>Country</th>
                    </tr>
                    <?php foreach ($addresses as $key => $value) { ?>
                        <tr>
                            <td><?php if($value->address_type == 'Billing Address'){
                                echo 'Billing Address';
                            } else{
                                echo 'Shipping Address';
                            } ?></td>
                            <td><?php echo $value->address1; ?></td>
                            <td><?php echo $value->address2; ?></td>
                            <td><?php echo $value->city; ?></td>
                            <td><?php echo $value->pincode; ?></td>
                            <td><?php echo $value->district; ?></td>
                            <td><?php echo $value->state; ?></td>
                            <td><?php echo $value->country; ?></td>
                        </tr>
                    <?php } ?>
                </table>
			</div>
		</div>
	</div>
</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
	$('.max').each(function() {
		var $wrapper = $('.fields', this);
		$(".add-field", $(this)).click(function(e) {
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
                                            <input name="address1[]" type="text" class="form-control" placeholder="Enter Address Line1" value="<?php echo (isset($_POST['address1'])) ? $_POST['address1'] : ''; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-lg-3">
                                        <div class="form-group">
                                            <label class="required">Address 2</label>
                                            <input name="address2[]"  type="text" class="form-control" placeholder="Enter Address Line2" value="<?php echo (isset($_POST['address2'])) ? $_POST['address2'] : ''; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-lg-3">
                                        <div class="form-group">
                                            <label class="required">City</label>
                                            <input name="city[]" id="city" type="text" class="form-control" placeholder="Enter City" value="<?php echo (isset($_POST['city'])) ? $_POST['city'] : ''; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-lg-3">
                                        <div class="form-group">
                                            <label class="required">Pincode</label>
                                            <input name="pincode[]" id="pincode" type="text" class="form-control" placeholder="Enter Pincode" value="<?php echo (isset($_POST['pincode'])) ? $_POST['pincode'] : ''; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-lg-3">
                                        <div class="form-group">
                                            <label class="required">District</label>
                                            <input name="district[]" id="district" type="text" class="form-control" placeholder="Enter District" value="<?php echo (isset($_POST['district'])) ? $_POST['district'] : ''; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-lg-3">
                                        <div class="form-group">
                                            <label class="required">State</label>
                                            <input name="state[]" id="state" type="text" class="form-control" placeholder="Enter state" value="<?php echo (isset($_POST['state'])) ? $_POST['state'] : ''; ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-lg-3">
                                        <div class="form-group">
                                            <label class="required">Country</label>
                                            <input name="country[]" id="country" type="text" class="form-control" placeholder="Enter Country" value="<?php echo (isset($_POST['country'])) ? $_POST['country'] : ''; ?>" required>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
			$wrapper.append(append_data);
		});
		$('.remove-field', $(this)).click(function() {

			if ($('.field').length > 1)
				$('.field').last().remove();
		});
	});
</script>
<style type="text/css">
	.required:after {
		content: " *" !important;
		color: red !important;
	}
</style>
