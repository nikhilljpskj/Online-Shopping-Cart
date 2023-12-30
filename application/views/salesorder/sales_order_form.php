<section id="main-content">
    <section class="wrapper">
        <link href="/libs/bootstrap/css/bootstrap1.min.css" rel="stylesheet" id="bootstrap-css">
        <?php $date = date('d-m-Y'); ?>
        <div class="card">
            <div class="card-body">
                <form action="<?php echo base_url('salesorder/sales_order_store'); ?>" id="registerForm" class="form" enctype="multipart/form-data" method="post">

                    <div class="form-body">
                        <div class="container">
                            <div class="col">
                                <?php echo "Date: " . $date; ?>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col">
                                    <label style="font-size:15px;color:black;" for="customer">Customer Name</label>
                                    <select id="customer" name="sales_order[customer]" class="form-control" required="required" onchange="changeCustomer(this.value)">
                                        <option value="">--select Customer--</option>
                                        <?php foreach ($data1 as $customer) { ?>
                                            <option value="<?php echo $customer->company_id; ?>"><?php echo $customer->company_name; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col">
                                    <label style="font-size:15px;color:black;" for="po_no">PO Num</label>
                                    <input id="po_no" type="text" name='sales_order[po_no]' required="required" placeholder='Enter PO.NO' class="form-control"/>
                                </div>
                                <div class="col">
                                    <label style="font-size:15px;color:black;" for="po_date">PO Date</label>
                                    <input id="po_date" type="date" required="required" name='sales_order[po_date]'  placeholder='Enter PO Date' class="form-control"/>  
                                </div>
                                <div class="col">
                                    <label style="font-size:15px;color:black;" for="po_delivery_date">Delivery Date</label>
                                    <input id="po_delivery_date" type="date" name='sales_order[po_delivery_date]' required="required" placeholder='Enter PO.NO' class="form-control"/>
                                </div>
                                <div class="col">
                                    <label style="font-size:15px;color:black;" for="file">Upload</label>  
                                    <input class="file" name='sales_order[file]' id="file" multiple="true" type='file'/>
                                    <img src="" height="100" width="100" class="view_img" style="display:none;" /> 
                                </div>               
                            </div>
                            <div id="choose_address" class="row">
                                <div class="col-6">
                                    <div id="address1">
                                        <label style="font-size:15px;color:black;" for="billing_address">Choose Billing Address</label>
                                        <select id="billing_address" class="form-control" required="required" onchange="changeBillingAddress(this.value)">
                                            <option value="">--select Address--</option>
                                            <option value="billing_address">Address-1</option>
                                            <option value="shipping_address">Address-2</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div id="address2">
                                        <label style="font-size:15px;color:black;" for="shipping_address">Choose Shipping Address</label>
                                        <select id="shipping_address" class="form-control" required="required" onchange="changeShippingAddress(this.value)">
                                            <option value="">--select Address--</option>
                                            <option value="billing_address">Address-1</option>
                                            <option value="shipping_address">Address-2</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col">
                                    <label style="font-size:15px;color:black;" for="billing">Billing Address</label>  
                                    <textarea class="w-100" name="sales_order[billing]" id="billing" cols="30" rows="6"></textarea>
                                </div>
                                <div class="col">
                                    <label style="font-size:15px;color:black;" for="shipping">Shipping Address</label>  
                                    <textarea class="w-100" name="sales_order[shipping]" id="shipping" cols="30" rows="6"></textarea>
                                </div>
                            </div>
                            <hr style="width:100%;text-align:left;margin-left:0">
                            <div class="row">
                                <div class="col">
                                    <a class="btn btn-primary pull-right add">Add Row</a>
                                </div>
                                <div class="col"></div>
                            </div>
                            <div class="item-wrap">
                                <div class="item main">
                                    <div class="row mt-2">
                                        <div class="col-md-3">
                                            <label style="font-size:15px;color:black;" for="product_id">Product Name</label>   
                                            <select id="product_id" class="form-control productName_select" required="required" name="products[product_id][]">
                                                <option value="">Select Product </option>
                                                <?php foreach ($data2 as $row) { ?>
                                                    <option value="<?php echo $row->id ?>"><?php echo $row->variation_name.' / '.$row->product_name.' / '.$row->product_code; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label style="font-size:15px;color:black;" for="po_qty">PO Qty</label>
                                            <input id="po_qty" type="text" required="required" name='products[po_qty][]' placeholder='Enter PO.Qty' class="form-control qty" value=""/>
                                        </div>
                                        <div class="col-md-3">
                                            <label style="font-size:15px;color:black;" for="accepting_date">Accepting Date</label>
                                            <input id="accepting_date" type="date" required="required" name='products[accepting_date][]'  placeholder='Enter accepted Date' class="form-control"/>
                                        </div>
                                        <div class="col-md-3">
                                            <label style="font-size:15px;color:black;" for="rate">Rate</label>
                                            <input id="rate" type="text" required="required" name="products[rate][]" value="" placeholder="Enter Rate" class="form-control">
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-3">
                                            <label style="font-size:15px;color:black;" for="front_image">Front Image</label>                              
                                            <input id="front_image" class="file" name='products[front_image][]'  type='file'>
                                        </div>
                                        <div class="col-md-3">
                                            <label style="font-size:15px;color:black;" for="back_image">Back Image</label>
                                            <input id="back_image" class="file" name='products[back_image][]' type='file'>
                                        </div>
                                        <div class="col-md-3">
                                            <label style="font-size:15px;color:black;" for="other_image">other Image</label>
                                            <input id="other_image" class="file" name='products[other_image][]'  type='file'/>
                                        </div>
                                        <!--<div class="col-md-3">
                                            <a class="pull-right btn btn-danger remove">Delete Row</a>
                                        </div>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div>
                            <br>
                            <input name="btnSubmit" class="btn btn-primary submit" type='submit' value="Submit">
                        </div>
                    </div>
                </form>
                </section>
                </section>
                <style>
                    textarea {
                        border: 1px solid #DFE3E7;
                        border-radius: 4px;
                    }
                </style>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>                
               
                <script src="<?php echo base_url(); ?>assets/app-assets/vendors/js/vendors.min.js"></script>
                <script src="<?php echo base_url(); ?>assets/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.min.js"></script>
                <script src="<?php echo base_url(); ?>assets/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.min.js"></script>
                <script src="<?php echo base_url(); ?>assets/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js"></script>
                <!-- BEGIN Vendor JS-->
                <!-- BEGIN: Page Vendor JS-->
                <script src="<?php echo base_url(); ?>assets/app-assets/vendors/js/ui/jquery.sticky.js"></script>
                <script src="<?php echo base_url(); ?>assets/app-assets/vendors/js/pickers/pickadate/picker.js"></script>
                <script src="<?php echo base_url(); ?>assets/app-assets/vendors/js/pickers/pickadate/picker.date.js"></script>
                <script src="<?php echo base_url(); ?>assets/app-assets/vendors/js/forms/repeater/jquery.repeater.min.js"></script>
                <!-- END: Page Vendor JS-->
                <!-- BEGIN: Theme JS-->
                <script src="<?php echo base_url(); ?>assets/app-assets/js/scripts/configs/horizontal-menu.min.js"></script>
                <script src="<?php echo base_url(); ?>assets/app-assets/js/core/app-menu.min.js"></script>
                <script src="<?php echo base_url(); ?>assets/app-assets/js/core/app.min.js"></script>
                <script src="<?php echo base_url(); ?>assets/app-assets/js/scripts/components.min.js"></script>
                <script src="<?php echo base_url(); ?>assets/app-assets/js/scripts/footer.min.js"></script>
                <script src="<?php echo base_url(); ?>assets/app-assets/js/scripts/customizer.min.js"></script>
                <!-- END: Theme JS-->
                <!-- BEGIN: Page JS-->
                <script src="<?php echo base_url(); ?>assets/app-assets/js/scripts/pages/app-invoice.min.js"></script>