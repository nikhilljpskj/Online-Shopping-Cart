<div class="container content-invoice">
    <div class="cards">
        <div class="card-bodys">
            <form action="<?php echo base_url('dashboard/addpurchase'); ?>" id="invoice-form" method="post" class="invoice-form" role="form" novalidate="">
                <div class="load-animate animated fadeInUp">
                    <input id="currency" type="hidden" value="$">
                    <div class="row">
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                            <h4>From,</h4>
                            <h5>ABARNA COLOURS</h5>
                            <h6>Tirupur</h6><br>  

                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                            <h3>To,</h3>
                            <div class="form-group">
                                <select class="form-control form-control-lg" name="companyName" id="companyName" required="required">
                                            <option>Select Supplier</option>
                                            <?php foreach ($supplier as $key => $vals) { ?>
                                                <option data-supplieraddress="<?php echo $vals['supplier_primaryaddress']; ?>" data-supplier_name="<?php echo $vals['supplier_name']; ?>" data-supplier_areaprimary="<?php echo $vals['supplier_areaprimary']; ?>" data-supplier_districtprimary="<?php echo $vals['supplier_districtprimary']; ?>" data-supplier_stateprimary="<?php echo $vals['supplier_stateprimary']; ?>" data-supplier_pincodeprimary="<?php echo $vals['supplier_pincodeprimary']; ?>" data-supplier_contactno1="<?php echo $vals['supplier_contactno1']; ?>" value="<?php echo $vals['id']; ?>"><?php echo $vals['supplier_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                <!--<input type="text" class="form-control" name="companyName" id="companyName" placeholder="Company Name" autocomplete="off">-->
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" rows="3" name="address" id="address" placeholder="Your Address" readonly></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <table class="table table-condensed table-striped" id="invoiceItem">
                                <tr>
                                    <th width="40%">Item Name</th>
                                    <th width="15%">Category</th>
                                    <th width="15%">Quantity</th>
                                    <th width="15%">Price</th>
                                 <th width="15%">Qty</th> 
                                    <th width="15%">
                                        Action <a href="javascript:void(0);" class="addmore"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                                    </th>                     
                                </tr>
                                <tr>
                                    <td><select class="productsList form-control form-control-lg" name="productName[]" id="productName_0" required="required">
                                            <option>Select Item</option>
                                            <?php foreach ($productdetails as $key => $vals) { ?>
                                                <option data-id="0" data-category="<?php echo $vals['board']; ?>" value="<?php echo $vals['id']; ?>"><?php echo $vals['material']; ?></option>
                                            <?php } ?>
                                        </select>
<!--                                        <input type="text" name="productName[]" id="productName_1" class="form-control" autocomplete="off">-->
                                    </td>
                                    <td><input type="text" name="category[]" id="category_0" data-id="0" class="form-control" autocomplete="off" readonly></td>
                                    <td><input type="number" name="quantity[]" id="quantity_0" data-id="0" class="form-control quantity" autocomplete="off"></td>
                                    <td><input type="text" name="price[]" id="price_0" data-id="0" class="form-control price" autocomplete="off"></td>
                                  <td> <input type="text" name="total[]" id="total_0" data-id="0" class="form-control total" autocomplete="off" readonly></td>
                                    <td><i class="fa fa-trash" aria-hidden="true"></i></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                        <div class="form-group mt-3 mb-3 ">
                            <label>Total Qty: &nbsp;</label>
                            <input value="" type="number" class="form-control" name="subTotal" id="subTotal" placeholder="Subtotal" readonly>          
                        </div>
                        <div class="form-group mt-3 mb-3 ">
                            <label>Tax Rate: &nbsp;</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text currency">%</span>
                                </div>
                                <select class="form-control form-control-lg" name="taxRate" id="taxRate" required="required">
                                    <option>Select Tax</option>
                                    <?php foreach ($gst_details as $key => $vals) { ?>
                                        <option value="<?php echo $vals['id']; ?>"><?php echo $vals['cgst']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                        <div class="form-group mt-3 mb-3 ">
                            <label>Tax Amount: &nbsp;</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text currency">$</span>
                                </div>
                                <input value="" type="number" class="form-control" name="taxAmount" id="taxAmount" placeholder="Tax Amount" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
                        <div class="form-group mt-3 mb-3 ">
                            <label>Total: &nbsp;</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text currency">$</span>
                                </div>
                                <input value="" type="number" class="form-control" name="totalAftertax" id="totalAftertax" placeholder="Total" readonly>
                            </div>
                        </div>
                    </div>

                    <br>
                    <div class="form-group">
                                                                        <!--                        <input type="hidden" value="<?php echo $_SESSION['userid']; ?>" class="form-control" name="userId">-->
                        <input data-loading-text="Saving Invoice..." type="submit" name="invoice_btn" value="Save" class="btn btn-success submit_btn invoice-save-btm">           
                    </div>
                </div>
        </div>
        <div class="clearfix"></div>
    </div>
</form>
</div> 
