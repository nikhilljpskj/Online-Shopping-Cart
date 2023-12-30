<section id="basic-datatable">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Attributes</h4>
					<div class="row">
						<div class="col">
							<a class="btn btn-primary" href="<?php echo base_url('attributes/add') ?>">Add Attributes</a>
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
									<th>SUB CATEGORY NAME</th>
									<th>Attributes Name</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $i=1; foreach ($attributes_data as $row) {?>
									<tr>
										<td><?php echo $i++; ?></td>
										<td><?php echo $row->sub_category_name ?></td>
										<td nowrap class="text-bold-500"><?php echo $row->attributes_name ?></td>
										<td><?php if($row->status == 1 ){echo 'ACTIVE';}else{ echo 'DEACTIVE';} ?></td>
										<td>
											<a class="btn btn-info" href="<?php echo base_url() ?>attributes/edit/<?php echo $row->id ?>">Edit</a>
                                           <!--  <a class="btn btn-danger" href="<?php echo base_url() ?>attributes/delete/<?php echo $row->id ?>">Delete</a> -->
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
