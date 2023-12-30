<?php
if (!empty($default)) {

	$id = $default['id'];
	$group_name = $default['group_name'];
    $group_desc = $default['group_desc'];
	$pro_details_ids = explode(',',$default['pro_details_ids']);
	$status = $default['status'];
} else {

	$id = '';
	$group_name = ($_POST['group_name']) ? $_POST['group_name'] : '';
    $group_name = ($_POST['group_desc']) ? $_POST['group_desc'] : '';
	$pro_details_ids = explode(',',$_POST['pro_details_ids']);
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
						<a class="btn btn-primary waves-effect waves-light" href="<?php echo base_url('/groupProducts'); ?>"> Back</a>
					</div>
				</div>
				<?php $this->load->view('validation_msg'); ?>
				<div class="card-body">
					<?php echo form_open_multipart($form_url, array('id' => 'registerForm', 'class' => 'form form-horizontal')) ?>
					<div class="form-body">
						<div class="row">

							<div class="col-md-4">
								<label style="font-size:15px;color:black;"  class="required">Group Name</label>
							</div>
							<div class="col-md-8 form-group">
								<input name="group_name" id="group_name" type="text" class="form-control" placeholder="Enter Group Name" value="<?php echo ($group_name) ? $group_name : ''; ?>">
							</div>
                            <div class="col-md-4">
								<label style="font-size:15px;color:black;"  class="required">Description</label>
							</div>
							<div class="col-md-8 form-group">
								<input name="group_desc" id="group_desc" type="text" class="form-control" placeholder="Enter description" value="<?php echo ($group_desc) ? $group_desc : ''; ?>">
							</div>
							<div class="col-md-4">
								<label style="font-size:15px;color:black;"  class="required">Products</label>
							</div>
							<div class="col-md-8 form-group">
								<select name="pro_details_ids[]" multiple id="pro_details_ids" type="text" class="form-control prodvalid">
									<?php foreach ($products as $product) { ?>
										<option value="<?php echo $product->variation_id; ?>"  <?php if(!empty($pro_details_ids) &&in_array($product->variation_id, $pro_details_ids)){ echo 'selected'; } ?>><?php echo $product->variation_name . ' / ' . $product->product_name; ?></option>
									<?php } ?>
								</select>
							</div>
							<?php if ($id) { ?>
								<div class="col-md-4">
									<label style="font-size:15px;color:black;">Status</label>
								</div>
								<div class="col-md-8 form-group">
									<select class="form-control" name="status">
										<option value="1" <?php if (1 == $status) { echo 'selected';} ?>>ACTIVE</option>
										<option value="0" <?php if (0 == $status) { echo 'selected';} ?>>DEACTIVE</option>
									</select>
								</div>
							<?php } ?>
							<input type="hidden" name="id" value="<?php echo (isset($id)) ? $id : ''; ?>">
							<div class="col-sm-12 d-flex justify-content-end">
								<button type="submit" name="submit" class="btn btn-primary mr-1">Submit</button>
							</div>
						</div>
					</div>
					<?php form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</section>
