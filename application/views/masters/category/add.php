<?php 
if(!empty($default)){

	$id = $default['id'];
	$brand_id = $default['brand_id'];
	$category_name = $default['category_name'];
	$status = $default['status'];
   
}else{

	$id = '';
	$brand_id = ($_POST['brand_id']) ? $_POST['brand_id'] :'';
	$category_name = ($_POST['category_name']) ? $_POST['category_name'] :'';
	$status = ($_POST['status']) ? $_POST['status'] :'';
}
?>
<section id="basic-horizontal-layouts">
	<div class="row match-height">
		<div class="col">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title"><?php echo $heading; ?></h4>
					<div class="float-right ">
						<a class="btn btn-primary waves-effect waves-light" href="<?php echo base_url('/category'); ?>"> Back</a>
					</div>
				</div>
				<?php $this->load->view('validation_msg');?>
				<div class="card-body">
					<?php echo form_open_multipart( $form_url, array('id' => 'registerForm', 'class' => 'form form-horizontal')) ?>
					<div class="form-body">
						<div class="row">
							<div class="col-md-4">
								<label style="font-size:15px;color:black;"  class="required">Brand Name</label>
							</div>
							<div class="col-md-8 form-group">
								<select class="form-control" name="brand_id">
									<option value="">Select Brand</option>
									<?php foreach ($brandlists as $list) { ?>
										<option value="<?php echo $list->brand_id; ?>" <?php if ($list->brand_id == $brand_id) { echo 'selected';} ?>><?php echo $list->brand_name; ?></option>
									<?php } ?>
								</select>
							</div>
							<div class="col-md-4">
								<label style="font-size:15px;color:black;"  class="required">Category Name</label>
							</div>
							<div class="col-md-8 form-group">
								<input name="category_name" id="category_name" type="text" class="form-control" placeholder="Enter category name" value="<?php echo (isset($category_name)) ? $category_name : ''; ?>">
							</div>
							<?php if($id){ ?>
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
