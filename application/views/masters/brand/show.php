<section id="basic-datatable">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Brand</h4>
					<div class="row">
						<div class="col">
							<a class="btn btn-primary" href="<?php echo base_url('brand/add') ?>">Add Brand</a>
						</div>
					</div>
				</div>
				<?php $this->load->view('validation_msg');?>
				<div class="card-body card-dashboard">
					<p class="card-text">
					</p>
					<div class="table-responsive">
						<table class="table zero-configuration">
							<thead>
								<tr>
									<th>ID</th>
									<th>Brand Name</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $i=1; foreach ($brands_data as $row) {?>
									<tr>
										<td><?php echo $i++; ?></td>
										<td nowrap class="text-bold-500"><?php echo $row->brand_name ?></td>
										<td><?php if($row->status == 1 ){echo 'ACTIVE';}else{ echo 'DEACTIVE';} ?></td>
										<td>
											<a class="btn btn-info" href="<?php echo base_url() ?>brand/edit/<?php echo $row->brand_id ?>">Edit</a>
                                           <!--  <a class="btn btn-danger" href="<?php echo base_url() ?>brand/delete/<?php echo $row->brand_id ?>">Delete</a> -->
                                        </td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
