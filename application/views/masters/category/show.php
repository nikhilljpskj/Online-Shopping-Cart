<section id="basic-datatable">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Category</h4>
					<div class="row">
						<div class="col">
							<a class="btn btn-primary" href="<?php echo base_url('category/add') ?>">Add Category</a>
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
									<th>Category Name</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $i=1; foreach ($category_datas as $row) {?>
									<tr>
										<td><?php echo $i++; ?></td>
										<td nowrap class="text-bold-500"><?php echo $row->brand_name ?></td>
										<td><?php echo $row->category_name ?></td>
										<td><?php if($row->status == 1 ){echo 'ACTIVE';}else{ echo 'DEACTIVE';} ?></td>
										<td>
											<a class="btn btn-info" href="<?php echo base_url() ?>category/edit/<?php echo $row->id ?>">Edit</a>
                                            <!-- <a class="btn btn-danger" href="<?php echo base_url() ?>category/delete/<?php echo $row->id ?>">Delete</a> -->
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
