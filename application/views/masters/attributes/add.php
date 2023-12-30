<?php
if (!empty($default)) {

	$id = $default['id'];
	$sub_category_id = $default['sub_category_id'];
	$attributes_name = $default['attributes_name'];
	$status = $default['status'];
} else {

	$id = '';
	$sub_category_id = ($_POST['sub_category_id']) ? $_POST['sub_category_id'] : '';
	$attributes_name = ($_POST['attributes_name']) ? $_POST['attributes_name'] : '';
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
						<a class="btn btn-primary waves-effect waves-light" href="<?php echo base_url('/attributes'); ?>"> Back</a>
					</div>
				</div>
				<?php $this->load->view('validation_msg'); ?>
				<div class="card-body">
					<?php echo form_open_multipart($form_url, array('id' => 'registerForm', 'class' => 'form form-horizontal')) ?>
					<div class="form-body">
						<div class="row">
							<div class="col-md-4">
								<label style="font-size:15px;color:black;" class="required">Select Sub Category</label>
							</div>
							<div class="col-md-8 form-group">
								<select class="form-control" name="sub_category_id">
									<option value="">Select Sub Category</option>
									<?php foreach ($sub_category as $sub) { ?>
										<option value="<?php echo $sub->id; ?>" <?php if ($sub->id == $sub_category_id) {echo 'SELECTED';}; ?>><?php echo $sub->brand_name. ' / '.$sub->category_name. ' / '.$sub->sc_name; ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="col-md-4">
								<label style="font-size:15px;color:black;"  class="required">Attribute Name</label>
							</div>
							<div class="col-md-8 form-group">
								<input name="attributes_name" id="attributes_name" type="text" class="form-control" placeholder="Enter Attribute Name" value="<?php echo $attributes_name; ?>">
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
