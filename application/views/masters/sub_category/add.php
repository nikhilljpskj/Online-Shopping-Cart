<?php
if (!empty($default)) {

	$id = $default['id'];
	$category_id = $default['category_id'];
	$sub_category_name = $default['sub_category_name'];
	$status = $default['status'];
} else {

	$id = '';
	$category_id = ($_POST['category_id']) ? $_POST['category_id'] : '';
	$sub_category_name = ($_POST['sub_category_name']) ? $_POST['sub_category_name'] : '';
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
						<a class="btn btn-primary waves-effect waves-light" href="<?php echo base_url('/sub_category'); ?>"> Back</a>
					</div>
				</div>
				<?php $this->load->view('validation_msg'); ?>
				<div class="card-body">
					<?php echo form_open_multipart($form_url, array('id' => 'registerForm', 'class' => 'form form-horizontal')) ?>
					<div class="form-body">
						<div class="row">
							<div class="col-md-4">
								<label style="font-size:15px;color:black;"  class="required">Select Category</label>
							</div>
							<div class="col-md-8 form-group">
								<select name="category_id" class="form-control" required>
									<option value=""> -- Select Category --</option>
									<?php foreach ($category as  $value) { ?>
										<option value="<?php echo $value->id; ?>"  <?php if ($value->id == $category_id) { ?> selected='selected' <?php }  ?>><?php echo $value->brand_name . ' / '.$value->category_name; ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="col-md-4">
								<label style="font-size:15px;color:black;"  class="required">Sub Category Name</label>
							</div>
							<div class="col-md-8 form-group">
								<input name="sub_category_name" id="sub_category_name" type="text" class="form-control"  placeholder="Enter Sub Category name"  value="<?php echo $sub_category_name; ?>">							
							</div>
							<?php if ($id) { ?>
								<div class="col-md-4">
									<label style="font-size:15px;color:black;">Status</label>
								</div>
								<div class="col-md-8 form-group">
									<select class="form-control" name="status">
										<option value="1" <?php if (1 == $status) {
																echo 'selected';
															} ?>>ACTIVE</option>
										<option value="0" <?php if (0 == $status) {
																echo 'selected';
															} ?>>DEACTIVE</option>
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
