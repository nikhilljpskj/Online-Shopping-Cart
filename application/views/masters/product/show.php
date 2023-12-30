<style>
.custrow {
    height: 20px;
}
.custcol {
    width: 10px;
}
</style>

<section id="basic-datatable">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Product</h4>
					<div class="row">
						<div class="col">
							<a class="btn btn-primary" href="<?php echo base_url('product/add') ?>">Add Product</a>
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
									<th class="custcol">SNO</th>
                                    <th>PRODUCT CODE</th>
									<th class="custcol">PHOTO</th>
									<th>PRODUCT NAME</th>
									<th>STOCK</th>
									<th>PRICE</th>
									
									<th>ACTION</th>
								</tr>
							</thead>
							<tbody>
								<?php $i=1; foreach ($results as $row) {?>
									<tr class="custrow">
										<td><?php echo $i++; ?></td>
                                        <td><?php echo $row->product_code; ?></td>
                                        <td>
                                            <?php if (!empty($row->product_image)): ?>
                                                <img src="<?php echo base_url('attachments/productimg/' . $row->product_image); ?>" width="25px" height="25px">
                                            <?php elseif (!empty($row->image)): ?>
                                                <img src="<?php echo base_url('attachments/products/' . $row->image); ?>" width="25px" height="25px">
                                            <?php else: ?>
                                                <img src="<?php echo base_url('assets/images/no-image.png'); ?>" width="25px" height="25px">
                                            <?php endif; ?>
                                        </td>




										<td><?php echo $row->product_name; ?></td>										
										<td><?php echo $row->qty; ?></td>
										<td><?php echo $row->price; ?></td>
										<td>
											<a class="btn btn-info" href="<?php echo base_url() ?>product/edit/<?php echo $row->id ?>">Edit</a>
											<!-- <a class="btn btn-info" href="<?php echo base_url() ?>product/view/<?php echo $row->id ?>">View</a> -->
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
