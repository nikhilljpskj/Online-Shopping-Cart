<section id="main-content">
    <section class="wrapper">
        <link href="/libs/bootstrap/css/bootstrap1.min.css" rel="stylesheet" id="bootstrap-css">
        <?php $date = date('d-m-Y'); ?>
        <div class="card">
            <div class="card-body" style="background-color:white;">
                <form action="<?php echo base_url('workorder/work_order_store'); ?>" id="registerForm" class="form" enctype="multipart/form-data" method="post">

                    <div class="form-body" >
                        <div class="container">
                            <div class="col">
                                <?php echo "Date: " . $date; ?>
                            </div>
                            <br>
                            <div class="row" style="background-color:WhiteSmoke;">
                            <div class="col-md-6">
                            <label for="product_id">Product Name</label>   
                                            <select id="workLoad_product_id" class="form-control productName_select" required="required" name="products[product_id][]" onchange="changeWorkCustomer(this.value)">
                                                <option value="">Select Product </option>
                                                <?php foreach ($data2 as $row) { ?>
                                                    <option data-buyer="<?php echo$row->buyer ?>" value="<?php echo$row->id ?>"><?php echo $row->name ?></option>
                                                <?php } ?>
                                            </select>
                                            </div>
                            <div class="col-md-6">
                                    <label for="produ">Customer Name</label>
                                    <input id="workLoad_customer" type="text" required="required" name='work_order[customer]'  placeholder='Customer Name' class="form-control"/>                                    
                                </div>
                                <div class="col-md-12" id="workLoadData_div" style="display:none;">
                                <div class="table-responsive">
                                <table class="table zero-configuration">
                    <thead>
                        <tr>
                            <th>SO NO</th>
                            <th>PO NO</th>
                            <th>Product</th>
                            <th>Accepted Delivery Date</th>
                            <th>Order Qty</th>
                            <th>Available Stock</th>
                            <th>Pending Qty</th>                            
                        </tr>
                    </thead>
                    <tbody id="workLoadData">
                    </tbody>
                </table>
                                </div>
                                </div>
			
			
	<!--<div class="col-md-6">
					<label for="">Status</label>
                     <select id="status" name="status" class="form-control" required="required">
						<option value="0" >new</option>
						<option value="1" >start</option>
						<option value="2" >On-Progress</option>
						<option value="3" >On-Hold</option>
						<option value="5" >Done</option>
					</select>
			</div> -->
		</div>
		<!--<div class="row">
			<div class="col-md-6">
            <div class="form-group">
              <label for="" class="control-label">Start Date</label>
              <input id="start_date" type="date" required="required" name='start_date'  placeholder='Enter Start Date' class="form-control"/> 
            </div>
          </div>
        
		</div>-->
        <div class="row" style="background-color:WhiteSmoke;">
        	           <div class="col-md-6">
            <div class="form-group">
              <label for="" class="control-label">Merchandiser</label>
              <input id="manager_id" type="text" required="required" name='manager_id'  placeholder='Enter Merchandiser Name' class="form-control"/>
            </div>
            </div>
              <div class="col-md-6">
            <div class="form-group">
              <label for="" class="control-label">Promising Date</label>
              <input id="end_date" type="date" required="required" name='end_date'  placeholder='Enter Date' class="form-control"/>
            </div>
          </div>
		  </div>
		  <div class="row" style="background-color:WhiteSmoke;">
		  <div class="col-md-4">
		  <div class="form-group">
					<label for="" class="control-label">Production Quantity</label>
					<input type="text" class="form-control" id="prd_qty" name="prd_qty" value="" >
				</div>
		  </div>
		  <div class="col-md-4">
		  <div class="form-group">
					<label for="" class="control-label">Extra Quantity</label>
					<input type="number" class="form-control" name="extra_qty" id="extra_qty"  value="">
				</div>
		  </div>
		  <div class="col-md-4">
		  		  <div class="form-group">
					<label for="" class="control-label">Total Quantity</label>
					<input type="text" class="form-control" name="tot_qty" id="tot_qty" value="" readonly>
				</div>
		  </div>
          </div>
          <div class="row" style="background-color:WhiteSmoke;">
                                <div class="col-md-2">
                                <label for="wo_no">Cutsize</label> 
                                <div class="row">
                                <div class="col-md-4">
                                <input type="text" class="form-control" name="wo_name" id="wo_name"  value="1" readonly>
                                </div>/
                                <div class="col-md-4">
                                <input type="text" class="form-control" name="wo_name" id="wo_name"  value=" " >
                                </div>
                                </div>
                                </div>
                                <div class="col-md-2">
                                <label for="pono">UPS-Running Board</label> 
                                <input type="text" class="form-control" name="po_no" id="po_no"  value="">
                                </div>
                                <div class="col-md-2">
                                <label for="" class="control-label">UPS-Full Board</label>
                               <input type="text" class="form-control" name="po_no" id="po_no"  value="">
                                </div>
                                <div class="col-md-2">
                                <div class="form-group">
					            <label for="" class="control-label">Total boards Required</label>
					            <input type="number" class="form-control" name="prd_qty"   value="" >
				                </div>
                            </div>
                              <div class="col-md-2">
                                <label for="" class="control-label">Extra Board</label>
                               <input type="text" class="form-control" name="po_no" id="po_no"  value="">
                                </div>
                               <div class="col-md-1">
                                <div class="form-group">
					            <label for="" class="control-label">No of Plates</label>
					            <input type="text" class="form-control" name="prd_qty"   value="" >
				                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
					            <label for="" class="control-label">No of screen</label>
					            <input type="text" class="form-control" name="prd_qty"   value="" >
				                </div>
                                </div></div>
                                </br>
                                 <div class="row" >
                                <div class="col-md-3">
                            <label for="" class="control-label">Front</label>
                            <input type="checkbox" required="required" name='print_type_front'  placeholder='Enter Print type' class="form-control" checked/>
                            </div>
                            <div class="col-md-3">
                            <label for="" class="control-label">Back</label>
                            <input type="checkbox" name='print_side_back'  placeholder='Enter Print type' class="form-control"/>
                            </div>
                            </div>
                            </br>

                              <div class="row"style="background-color:WhiteSmoke;">
                                <div class="col-md-3">
                                <label for="wo_no">Front Rawmaterial</label> 
                                <input type="hidden" class="form-control" name="product_name" id="product_name"  value="">
                                 <select id="workLoad_product_id" class="form-control productName_select" required="required" name="products[product_id][]" onchange="changeWorkProductName(this.value)">
                                     <?php foreach ($data2 as $row) { ?>
                                                    <option data-product_name="<?php echo $row->material ?>"  value="<?php echo $row->id ?>"><?php echo $row->material ?></option>
                                                <?php } ?>
                                            </select>
                                </div>
                                <div class="col-md-3">
                                <div class="form-group">
					            <label for="" class="control-label">Board Qty</label>
					            <input type="number" class="form-control" name="prd_qty"   value="" >
				                </div>
                                </div>

                                <div class="col-md-3">
                                <label for="wo_no">Back Rawmaterial</label> 
                                <input type="hidden" class="form-control" name="product_name" id="product_name"  value="">
                                 <select id="workLoad_product_id" class="form-control productName_select" required="required" name="products[product_id][]" onchange="changeWorkProductName(this.value)">
                                     <?php foreach ($data2 as $row) { ?>
                                                    <option data-product_name="<?php echo $row->material ?>"  value="<?php echo $row->id ?>"><?php echo $row->material ?></option>
                                                <?php } ?>
                                            </select>
                                </div>
                                
                                       <div class="col-md-3">
                                <div class="form-group">
					            <label for="" class="control-label">Board Qty</label>
					            <input type="number" class="form-control" name="prd_qty"   value="" >
				                </div>
                                </div>
                                </div>

          <div class="row" style="background-color:WhiteSmoke;">
                <div class="col-md-4">
            <div class="form-group">
              <label for="" class="control-label">Front Process_Flow</label>
              <select class="form-control select2" name="front_process[]">
              	<option></option>
              	              </select>
            </div>
          </div>
		  <div class="col-md-4">
            <div class="form-group">
              <label for="" class="control-label">Back Process_Flow</label>
              <select class="form-control select2" name="back_process[]">
              	<option></option>
              	              </select>
            </div>
          </div>
       
		 <!-- <div class="col-md-4">
            <div class="form-group">
              <label for="" class="control-label">Side Process_Flow</label>
              <select class="form-control select2" name="side_process[]">
              	<option></option>
              	              </select>
            </div>
          </div>
        </div>
                        </div> -->
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