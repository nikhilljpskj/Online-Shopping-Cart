<div class="container content-invoice">
    <div class="cards">
        <div class="card-bodys">
            <form id="orderGRNForm" method="post" class="invoice-form" role="form" novalidate="">
                <div class="load-animate animated fadeInUp">
                    <input id="currency" type="hidden" value="$">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <table class="table table-condensed table-striped" id="invoiceItem">
                            <tr>
                            <td>Supplier Name</td>
                            <td><?php echo $data[0]['order_receiver_name']; ?></td>
                            </tr>
                                <tr>
                                    <th width="30%">Item Name</th>
                                    <th width="10%">Order Qty</th>
                                    <th width="10%">Received Qty</th>
                                    <th width="10%">Rejected Qty</th>
                                    <th width="10%">Accepted Qty</th>
                                    <th width="15%">DC No</th>
                                    <th width="25%">DC Date</th>
                                    <th width="15%">Invoice No</th>
                                    <th width="25%">Invoice Date</th>                      
                                </tr>
                                <?php foreach ($invoice_order_item as $key=>$value){
                                    if($value['order_item_status'] == 'Pending'){
                                        $quantity = $value['order_item_quantity'] - $value['order_item_received'];
                                     ?>
                                <tr>                                
                                    <td>
                                    <input type="hidden" name="orderId[]" value = "<?php echo $value['order_id']; ?>" class="form-control" autocomplete="off" readonly>
                                    <input type="hidden" name="orderItemId[]" value = "<?php echo $value['order_item_id']; ?>" class="form-control" autocomplete="off" readonly>
                                    <input type="hidden" name="itemCode[]" value = "<?php echo $value['item_code']; ?>" class="form-control" autocomplete="off" readonly>
                                    <input type="hidden" name="productPrice[]" value = "<?php echo $value['order_item_price']; ?>" class="form-control" autocomplete="off" readonly>
                                    <input type="hidden" name="productQuantity[]" value = "<?php echo $value['order_item_quantity']; ?>" class="form-control" autocomplete="off" readonly>
                                    <input type="text" name="productName[]" id="productName_1" value = "<?php echo $value['item_name']; ?>" class="form-control" autocomplete="off" readonly></td>
                                    <td><input type="number" name="quantity[]" id="quantity_<?php echo $key; ?>" data-id="<?php echo $key; ?>" value = "<?php echo $quantity; ?>" class="form-control quantity" autocomplete="off" readonly></td>                                    
                                    <td><input type="number" name="received[]" id="receivedqty_<?php echo $key; ?>" data-id="<?php echo $key; ?>" class="form-control receivedqty" autocomplete="off"></td>
                                    <td><input type="number" name="rejected[]" id="rejectedqty_<?php echo $key; ?>" data-id="<?php echo $key; ?>" class="form-control rejectedqty" autocomplete="off"></td>
                                    <td><input type="number" name="accepted[]" id="acceptedqty_<?php echo $key; ?>" data-id="<?php echo $key; ?>" class="form-control acceptedqty" autocomplete="off"></td>
                                    <td><input type="text" name="dcNo[]" id="dcNo_<?php echo $key; ?>" data-id="0" class="form-control" autocomplete="off" required></td>
                                    <td><input type="text" name="dcDate[]" id="dcDate_<?php echo $key; ?>" data-id="0" class="form-control dcDate" autocomplete="off"></td>
                                    <td><input type="text" name="invoiceNo[]" id="invoiceNo_<?php echo $key; ?>" data-id="0" class="form-control" autocomplete="off"></td>
                                    <td><input type="text" name="invoiceDate[]" id="invoiceDate_<?php echo $key; ?>" data-id="0" class="form-control invoiceDate" autocomplete="off"></td>
                                </tr>
                                <?php }} ?>
                            </table>
                        </div>
                    </div>

                    <br>
                    <div class="form-group">
                                                                        <!--                        <input type="hidden" value="<?php echo $_SESSION['userid']; ?>" class="form-control" name="userId">-->
                        <input data-loading-text="Saving Invoice..." type="button" name="invoice_btn" id="invoiceGRN_btn" value="Save" class="btn btn-success submit_btn invoice-save-btm">           
                    </div>
                </div>
            </form>
            <div class="load-animate animated fadeInUp">
                    <input id="currency" type="hidden" value="$">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <table class="table table-condensed table-striped" id="invoiceItemGRN">                            
                                <tr>
                                    <th>Item Name</th>
                                    <th>Order Qty</th>
                                    <th>Received Qty</th>
                                    <th>Rejected Qty</th>
                                    <th>Accepted Qty</th>
                                    <th>DC No</th>
                                    <th>DC Date</th>
                                    <th>Invoice No</th>
                                    <th>Invoice Date</th> 
                                    <th>Invoice Date</th>
                                    <th>Created Date</th>                      
                                </tr>
                                <?php foreach ($invoice_order_item_grn as $key=>$value){ ?>
                                <tr>                                
                                    <td><?php echo $value['order_item_name'] ?></td>
                                    <td><?php echo $value['order_item_quantity'] ?></td>
                                    <td><?php echo $value['order_item_received'] ?></td>
                                    <td><?php echo $value['order_item_rejected'] ?></td>
                                    <td><?php echo $value['order_item_accepted'] ?></td>
                                    <td><?php echo $value['order_item_dc_no'] ?></td>
                                    <td><?php echo $value['order_item_dc_date'] ?></td>
                                    <td><?php echo $value['order_item_invoice_no'] ?></td>
                                    <td><?php echo $value['order_item_invoice_date'] ?></td>
                                    <td><?php echo $value['createdDate'] ?></td>
                                </tr>
                                <?php } ?>
                            </table>
                        </div>
                    </div>
                </div>
        </div>
        <div class="clearfix"></div>
    </div>

</div> 
