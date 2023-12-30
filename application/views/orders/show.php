<section id="basic-datatable">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Orders</h4>
					<!--<div class="row">
						<div class="col">
							<a class="btn btn-primary" href="<?php echo base_url('orders/add') ?>">Add Orders</a>
						</div>
					</div>-->
				</div>
				<?php $this->load->view('validation_msg');?>
				<div class="card-body card-dashboard">
					<p class="card-text">
					</p>
					<div class="table-responsive">
						<table class="table zero-configuration">
							<thead>
								<tr>
									<th class="text-center">SL.NO</th>
									<th class="text-center">ORDER ID</th>
                                    <th class="text-center">COMPANY NAME</th>
									<th class="text-center">AMOUNT</th>
									<th class="text-center">ACTION</th>
								</tr>
							</thead>
							<tbody>
								<?php $i=1; foreach ($data as $row) {?>
									<tr>
										<td class="text-center"><?php echo $i++; ?></td>
										<td class="text-center"><?php echo $row->order_id; ?></td>
                                        <td class="text-center"><?php echo $row->company_name; ?></td>
										<td class="text-center"><?php echo number_format($row->order_amount,  2); ?></td>
										
										<td class="text-center">
											<a class="btn btn-success" href="<?php echo base_url() ?>orders/view/<?php echo $row->order_id; ?>">View</a>
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