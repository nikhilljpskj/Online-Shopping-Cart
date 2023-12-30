<section id="basic-datatable">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Company</h4>
					<div class="row">
						<div class="col">
							<a class="btn btn-primary" href="<?php echo base_url('company/add') ?>">Add Company</a>
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
									<th>SNO</th>
									<th>COMAPNY NAME</th>
									<th>PHONE</th>
									<th>EMAILs</th>
									<th>CREATED BY</th>
									<th>CREATED DATE</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php $i=1; foreach ($results as $row) {?>
									<tr>
										<td><?php echo $i++; ?></td>
										<td nowrap class="text-bold-500"><?php echo $row->company_name ?></td>
										<td><?php echo $row->phone ?></td>
										<td><?php echo $row->email ?></td>
										<td><?php echo $row->username ?></td>
										<td><?php echo $row->created_date ?></td>
										<td>
											<a class="btn btn-info" href="<?php echo base_url() ?>company/edit/<?php echo $row->id ?>">Edit</a>
											<a class="btn btn-info" href="<?php echo base_url() ?>company/view/<?php echo $row->id ?>">View</a>
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
