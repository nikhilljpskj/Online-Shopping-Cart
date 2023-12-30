<?php foreach ($settings as $s) {
}
?>
<style>
    @media print {
        .exclude-print {
            display: none;
        }

        @page {
            size: 8.5in 5.5in;
            size: portrait;
            margin: 25mm 25mm 25mm 25mm;  
        }

        .row {
            page-break-inside: avoid;
        }

        #header,
        #footer {
            display: none;
        }
    }
</style>

<section>
	<div class="row">
		<div class="col">
			<div class="card">
						<div class="row">
                         <div class="col-1"></div>
                            <div class="col-4 text-left">
								<address>
									<h5>PUNARBHAVAA Sustainable Products</h5>
									<p class="">
									SKE Thottam, No 20-B,<br>Sri Palaniandavan nagar, Kaveri Nagar,<br>15 Velampalayam, Tirupur - 641 652 India
									</p>
								</address>
							</div>
                            <div class="col-2"></div>
                            <div class="col-4 text-left">
                            <address >
								<p class=""><strong>Order Number:
										#<?php echo $s->ord_str_num; ?><?php echo $order_data['order_id']; ?></strong><br>
								<strong>Order Date:<?php echo $order_data['o_created_date']; ?></strong><br>
								<?php if (!empty($order_data['delivery_date'])) { ?>
								<strong>Deliver Date:<?php echo $order_data['delivery_date']; ?></strong></p>
								<?php } ?>
							</address>
                            </div>
                            <div class="col-1"></div>
                            </div>
                        
                            <div class="row">
                            <div class="col-1"></div>
                            <div class="col-4 text-left">
                            <address>
								<h5 class=""><strong>Billing Address:</strong><br></h5>
								<p class=""><?php echo $company_data['company_name']; ?></p>
								<p>
  <?php echo $billing_address[0]->address1 . ',' . $billing_address[0]->address2 . ',<br>' . $billing_address[0]->city . ',' . $billing_address[0]->district . ',<br>' . $billing_address[0]->state . ',' . $billing_address[0]->country . ',' . $billing_address[0]->pincode; ?>
</p>

							</address>
                            </div>
                            <div class="col-2"></div>
                            <div class="col-4 text-left">
                            <address>
								<h5 class=""><strong>Shipping Address:</strong><br></h5>
								<p class=""><?php echo $company_data['company_name']; ?></p>
								<p class=""><?php echo $order_data['saddress1'] . ',' . $order_data['saddress2'] . ',<br>' . $order_data['scity'] . ',' . $order_data['sdistrict'] . ',<br>' . $order_data['sstate'] . ',' . $order_data['scountry'] . ',' . $order_data['spincode']; ?></p>
							</address>
                            </div>
                            <div class="col-1"></div>
                            </div>
						</div>
						</div>
					</div>
					
		</div>
	</div>
</section>
<section id="basic-horizontal-layouts">
	<div class="row match-height">
		<div class="col">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title"><?php echo 'Order Details'; ?></h4>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered">
							<thead>
								<tr>
									<td class="text-center"><strong>S.No</strong></td>
                                    <td class="text-center"><strong>Code</strong></td>
									<td class="text-center"><strong>Product</strong></td>
									<td class="text-center"><strong>Quantity</strong></td>
									<td class="text-center"><strong>Unit Price</strong></td>
									<td class="text-center"><strong>Total</strong></td>
								</tr>
							</thead>
							<tbody>
								<?php 
                                usort($get_order_details, function($a, $b) {
                                    return strcmp($a->group_name, $b->group_name);
                                    });
                                    $sub_tot = 0;
                                    foreach ($get_order_details as $key => $value) { ?>
    <tr>
        <td class="text-center"><?php echo $key + 1; ?></td>
        <td class="text-left"><?php echo !empty($value->group_name) ? $value->group_name : $value->variation_name; ?></td>
        <td class="text-left"><?php echo !empty($value->product_name) ? $value->product_name : $value->variation_name; ?></td>

        <td class="text-center"><?php echo $value->order_qty; ?></td>
        <td class="text-center"><?php echo number_format($value->order_price, 3); ?></td>
        <td class="text-right"><?php $t_amount = $value->order_qty * $value->order_price; ?>
            <?php echo number_format($t_amount, 3); ?>
        </td>
    </tr>
<?php $sub_tot += $t_amount;
} ?>

								<tr>
									<td class="thick-line"></td>
									<td class="thick-line"></td>
									<td class="thick-line"></td>
                                    <td class="thick-line"></td>
									<td class="thick-line text-right">SUB Total</td>
									<td class="text-right thick-line"><?php echo number_format($sub_tot, 3); ?>
									</td>
								</tr>

								<tr>
									<td class="thick-line"></td>
									<td class="thick-line"></td>
									<td class="thick-line"></td>
                                    <td class="thick-line"></td>
									<td class="thick-line text-right">Delivery Charges</td>
									<td class="text-right thick-line"><?php echo number_format($order_data['delivery_price'], 2); ?>
									</td>
								</tr>
								<tr>
									<td class="thick-line"></td>
									<td class="thick-line"></td>
									<td class="thick-line"></td>
                                    <td class="thick-line"></td>
									<td class="thick-line text-right">Discount %</td>
									<td class="text-right thick-line">
										<?php echo number_format($order_data['discount_price'], 2); ?>
									</td>
								</tr>
								<tr>
									<td class="thick-line"></td>
									<td class="thick-line"></td>
									<td class="thick-line"></td>
                                    <td class="thick-line"></td>
									<td class="thick-line text-right">Tax %</td>
									<td class="text-right thick-line">
										<?php echo number_format($order_data['tax'], 2); ?>
									</td>
								</tr>

								<tr>
									<td class="thick-line"></td>
									<td class="thick-line"></td>
									<td class="thick-line"></td>
                                    <td class="thick-line"></td>
									<td class="thick-line text-right"><strong>Total</strong></td>
									<td class="text-right thick-line">
										<?php echo number_format($order_data['order_amount'], 2); ?>
									</td>
								</tr>

							</tbody>
						</table>
					</div>
					<div class="d-print-none">
						<div class="float-right">
							<a href="javascript:void();" class="btn btn-success waves-effect waves-light d2print" id="btnPrint"><i class="ficon bx bx-printer"></i></a> 
						<!-- 	<a class="btn btn-success waves-effect waves-light " id="btnPrint"><i class="ficon bx bx-printer"></i></a> -->
							<!-- <a href="#" class="btn btn-primary waves-effect waves-light">Send</a> -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<script>
    document.getElementById('btnPrint').addEventListener('click', function () {
        window.print();
    });
</script>

