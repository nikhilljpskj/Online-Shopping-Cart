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
                            <div class="row" style="background-color:White;">
                            <div class="col-md-6">
                            <label style="font-size:15px;color:black; font-family: Helvetica;" for="product_id">Product Name</label>   
                                            <select id="workLoad_product_id" class="form-control productName_select" required="required" name="products[product_id][]" onchange="changeWorkCustomer(this.value)">
                                                <option value="">Select Product </option>
                                                <?php foreach ($data2 as $row) { ?>
                                                    <option data-back_product="<?php echo$row->back_product_id ?>" data-back_productname="<?php echo$row->back_product_name ?>" data-front_product="<?php echo$row->front_product_id ?>" data-front_productname="<?php echo$row->front_product_name ?>" data-buyer="<?php echo$row->buyer ?>" value="<?php echo$row->id ?>"><?php echo $row->name ?></option>
                                                <?php } ?>
                                            </select>
                                            </div>
                            <div class="col-md-6">
                                    <label style="font-size:15px;color:black;"for="produ">Customer Name</label>
                                    <input id="workLoad_customer_id" type="hidden" required="required" name='work_order[customer_id]' placeholder='Customer Name' class="form-control" readonly/>              
                                    <input type="text" required="required" name='work_order[customer]' id="work_order_customer_name"  placeholder='Customer Name' class="form-control" readonly/>                                    
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
                            <th></th>                          
                        </tr>
                    </thead>
                    <tbody id="workLoadData">
                    </tbody>
                </table>
                                </div>
                                </div>
			
			
	<!--<div class="col-md-6">
					<label style="font-size:15px;color:black;"for="">Status</label>
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
              <label style="font-size:15px;color:black;"for="" class="control-label">Start Date</label>
              <input id="start_date" type="date" required="required" name='start_date'  placeholder='Enter Start Date' class="form-control"/> 
            </div>
          </div>
        
		</div>-->
        <br>
        <div class="row" style="background-color:White;">
        	        <div class="col-md-3">
                        <div class="form-group">
                        <label style="font-size:15px;color:black;"for="" class="control-label">Merchandiser</label>
                        <input id="manager_id" type="text" required="required" name='manager_id'  placeholder='Enter Merchandiser Name' class="form-control"/>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                        <label style="font-size:15px;color:black;"for="" class="control-label">Promising Date</label>
                        <input id="end_date" type="date" required="required" name='end_date'  placeholder='Enter Date' class="form-control"/>
                        </div>
                    </div>
                    <div class="col-md-2">
		  <div class="form-group">
					<label style="font-size:15px;color:black;"for="" class="control-label">Production_Qty</label>
					<input type="text" class="form-control" id="prd_qty" name="prd_qty" value="" >
				</div>
		  </div>
		  <div class="col-md-2">
		  <div class="form-group">
					<label style="font-size:15px;color:black;"for="" class="control-label">Extra Quantity</label>
					<input type="number" class="form-control" name="extra_qty" id="extra_qty"  value="">
				</div>
		  </div>
		  <div class="col-md-2">
		  		  <div class="form-group">
					<label style="font-size:15px;color:black;"for="" class="control-label">Total Quantity</label>
					<input type="text" class="form-control" name="tot_qty" id="tot_qty" value="" readonly>
				</div>
		  </div>
		  
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label style="font-size:15px;color:black;"for="" class="control-label">No of Plates</label>
                                            <input type="number" class="form-control" name="no_plates" id="no_plates" value="" >
                                        </div>
                                    </div>
                            
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label style="font-size:15px;color:black;"for="" class="control-label">No of screen</label>
                                            <input type="number" class="form-control" name="no_screen" id="no_screen" value="" >
                                        </div>
                                    </div>
          </div>
          <div class="row">
          <div class="col-md-2">
                 <div class="form-group">
                        <label style="font-size:15px;color:black;"for="" class="control-label">Select Pasting Boards</label>
                </div>        
            </div>
            <div class="col-md-2">
                 <div class="form-group">
                        <label style="font-size:15px;color:black;"for="" class="control-label">Front</label>
                        <input type="checkbox"  style="width: 20px; height: 20px;" required="required" name='print_type_front'  class="form-control" checked/>
                </div>        
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label style="font-size:15px;color:black;"for="" class="control-label">PB-1</label>
                    <input type="checkbox" style="width: 20px; height: 20px;" name='print_side_back' onclick="onChangeBackSideWorkOrder(this)" class="form-control"/>
                                 </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label style="font-size:15px;color:black;"for="" class="control-label">PB-2</label>
                                    <input type="checkbox" style="width: 20px; height: 20px;" name='print_side_back' onclick="onChangeBackSideWorkOrder(this)"   class="form-control"/>
                                 </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label style="font-size:15px;color:black;"for="" class="control-label">PB-3</label>
                                    <input type="checkbox" style="width: 20px; height: 20px;" name='print_side_back' onclick="onChangeBackSideWorkOrder(this)"  class="form-control"/>
                                 </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label style="font-size:15px;color:black;"for="" class="control-label">PB-4</label>
                                    <input type="checkbox" style="width: 20px; height: 20px;" name='print_side_back' onclick="onChangeBackSideWorkOrder(this)"  class="form-control"/>
                                 </div>
                            </div>
                            </div>
          <div class="row" style="background-color:WhiteSmoke;">
                                <div class="col-md-4">
                                <label style="font-size:15px;color:black;"for="wo_no">Cutsize</label> 
                                <div class="row">
                                <div class="col-md-4">
                                <input type="text" class="form-control" name="cutSize_in" id="cutSize_in"  value="1" readonly>
                                </div>/
                                <div class="col-md-4">
                                <input type="text" class="form-control" name="cutSize_out" id="cutSize_out"  value=" " >
                                </div>
                                </div>
                                </div>
                                <div class="col-md-2">
                                <label style="font-size:15px;color:black;"for="pono">UPS_Running</label> 
                                <input type="number" class="form-control" name="ups_rnng_board" id="ups_rnng_board"  value="">
                                </div>
                                <div class="col-md-2">
                                <label style="font-size:15px;color:black;"for="" class="control-label">UPS_Full</label>
                               <input type="number" class="form-control" name="ups_full_board" id="ups_full_board"  value="" readonly>
                                </div>
                            
                                <div class="col-md-2">
                                <div class="form-group">
					            <label style="font-size:15px;color:black;"for="" class="control-label">Boards Required</label>
					            <input type="number" class="form-control" name="tot_brd_req" id="tot_brd_req"  value="" readonly>
				                </div>
                            </div>
                              <div class="col-md-2">
                                <label style="font-size:15px;color:black;"for="" class="control-label">Extra Board</label>
                               <input type="number" class="form-control" name="ext_brd_req" id="ext_brd_req"  value="">
                                </div>
                                </div>

                                <div class="row" style="background-color:WhiteSmoke;">
                                    <div class="col-md-4">
                                        <label style="font-size:15px;color:black;"for="wo_no">Front Board</label>
                                        <input type="hidden" class="form-control" name="front_product_id" name="front_product_id"  value="" readonly> 
                                        <input type="text" class="form-control" name="front_product_name" id="front_product_name"  value="" readonly>
                                    </div>
                                    <div class="col-md-4">
                                    <div class="form-group">
                                        <label style="font-size:15px;color:black;"for="" class="control-label">Front Board Quantity</label>
                                        <input type="number" class="form-control" name="front_board_qty" id="front_board_qty"  value="" readonly>
                                    </div>
                                    </div>
                                </div>
                                <div class="col-md-3" id="back_material_div" style="display:none">
                                    <label style="font-size:15px;color:black;"for="wo_no">Back Rawmaterial</label> 
                                    <input type="hidden" class="form-control" name="back_product_id" name="back_product_id"  value="" readonly> 
                                    <input type="text" class="form-control" name="back_product_name" id="back_product_name"  value="" readonly>
                                </div>
                                
                                <div class="col-md-3" id="back_board_div" style="display:none">
                                    <div class="form-group">
					                    <label style="font-size:15px;color:black;"for="" class="control-label">Board Qty</label>
					                    <input type="number" class="form-control" name="back_board_qty" id="back_board_qty"  value="" readonly>
				                    </div>
                                </div>
                            </div>

         <!-- <div class="row" style="background-color:WhiteSmoke;">
                <div class="col-md-4">
            <div class="form-group">
              <label style="font-size:15px;color:black;"for="" class="control-label">Front Process_Flow</label>
              <select class="form-control select2" name="front_process[]">
              	<option></option>
              	              </select>
            </div>
          </div>
		  <div class="col-md-4">
            <div class="form-group">
              <label style="font-size:15px;color:black;"for="" class="control-label">Back Process_Flow</label>
              <select class="form-control select2" name="back_process[]">
              	<option></option>
              	              </select>
            </div>
          </div>-->
       
		 <!-- <div class="col-md-4">
            <div class="form-group">
              <label style="font-size:15px;color:black;"for="" class="control-label">Side Process_Flow</label>
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
                            <input name="btnSubmit" class="btn btn-primary submit" id="work_order_submit" type='submit' value="Submit">
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
                <script>
                $(document).ready(function(){
                    $("#prd_qty").on('keypress change blur',function(){
                        var tot_qty = $(this).val();
                        if($('#extra_qty').val() == '' || $('#extra_qty').val() == 0){
                            var totalPending = parseFloat(tot_qty);                           
                            $('#tot_qty').val(totalPending);
                             if($('#ups_full_board').val() == '' || $('#ups_full_board').val() == 0){
                                if($('#ext_brd_req').val() == '' || $('#ext_brd_req').val() == 0){
                                    var totalboard = parseFloat(totalPending);
                                    $('#tot_brd_req').val(totalboard);
                                    $('#back_board_qty,#front_board_qty').val(Math.ceil(totalboard));
                                }else{
                                    var sideboard = parseFloat($('#tot_brd_req').val())+parseFloat($('#ext_brd_req').val());
                                    $('#back_board_qty,#front_board_qty').val(Math.ceil(sideboard));
                                }
                                
                            }else{
                                var totalboard = parseFloat(totalPending)/parseFloat($('#ups_full_board').val());
                                $('#tot_brd_req').val(totalboard);
                                if($('#ext_brd_req').val() == '' || $('#ext_brd_req').val() == 0){
                                    var totalboard = parseFloat(totalPending);
                                    $('#tot_brd_req').val(totalboard);
                                    $('#back_board_qty,#front_board_qty').val(Math.ceil(totalboard));
                                }else{
                                    var sideboard = parseFloat($('#tot_brd_req').val())+parseFloat($('#ext_brd_req').val());
                                    $('#back_board_qty,#front_board_qty').val(Math.ceil(sideboard));
                                }
                                 
                            }
                        }else{
                            var totalPending = parseFloat($('#extra_qty').val())+parseFloat(tot_qty);
                            $('#tot_qty').val(totalPending);
                            if($('#ups_full_board').val() == '' || $('#ups_full_board').val() == 0){
                                var totalboard = parseFloat(totalPending);
                                $('#tot_brd_req').val(totalboard);
                                if($('#ext_brd_req').val() == '' || $('#ext_brd_req').val() == 0){
                                    var totalboard = parseFloat(totalPending);
                                    $('#tot_brd_req').val(totalboard);
                                    $('#back_board_qty,#front_board_qty').val(Math.ceil(totalboard));
                                }else{
                                    var sideboard = parseFloat($('#tot_brd_req').val())+parseFloat($('#ext_brd_req').val());
                                    $('#back_board_qty,#front_board_qty').val(Math.ceil(sideboard));
                                }                                
                            }else{
                                var totalboard = parseFloat(totalPending)/parseFloat($('#ups_full_board').val());
                                $('#tot_brd_req').val(totalboard);
                                if($('#ext_brd_req').val() == '' || $('#ext_brd_req').val() == 0){
                                    var totalboard = parseFloat(totalPending);
                                    $('#tot_brd_req').val(totalboard);
                                    $('#back_board_qty,#front_board_qty').val(Math.ceil(totalboard));
                                }else{
                                    var sideboard = parseFloat($('#tot_brd_req').val())+parseFloat($('#ext_brd_req').val());
                                    $('#back_board_qty,#front_board_qty').val(Math.ceil(sideboard));
                                }
                            }
                        }

                        
                    });
                    $("#cutSize_out").on('keypress change blur',function(){
                        var tot_qty = $(this).val();
                        
                        if($('#ups_rnng_board').val() == '' || $('#ups_rnng_board').val() == 0){
                            if($('#tot_qty').val() == '' || $('#tot_qty').val() == 0){
                                    var totalPending = parseFloat(tot_qty);
                                    $('#ups_full_board').val(totalPending);
                                }else{
                                    console.log(tot_qty)
                                    var totalPending = parseFloat($('#ups_rnng_board').val())*parseFloat(tot_qty);
                                    $('#ups_full_board').val(totalPending);
                                    var sideboard = parseFloat($('#tot_qty').val())/parseFloat(totalPending);
                                    $('#tot_brd_req,#back_board_qty,#front_board_qty').val(Math.ceil(sideboard));
                                }
                            
                        }else{
                            if($('#tot_qty').val() == '' || $('#tot_qty').val() == 0){
                                    var totalPending = parseFloat($('#ups_rnng_board').val())*parseFloat(tot_qty);
                                    $('#ups_full_board').val(totalPending);
                                }else{
                                    var totalPending = parseFloat($('#ups_rnng_board').val())*parseFloat(tot_qty);
                                    $('#ups_full_board').val(totalPending);
                                    var sideboard = parseFloat($('#tot_qty').val())/parseFloat(totalPending);
                                    $('#tot_brd_req,#back_board_qty,#front_board_qty').val(Math.ceil(sideboard));
                                }
                            
                        }
                        
                    })
                    $("#ext_brd_req").on('keypress change blur',function(){
                        var tot_qty = $(this).val();
                        console.log(tot_qty)
                        if($('#tot_brd_req').val() == '' || $('#tot_brd_req').val() == 0){
                            var totalPending = parseFloat(tot_qty);
                            $('#back_board_qty,#front_board_qty').val(Math.ceil(totalPending));
                        }else{
                            var totalPending = parseFloat($('#tot_brd_req').val())+parseFloat(tot_qty);
                            $('#back_board_qty,#front_board_qty').val(Math.ceil(totalPending));
                        }
                        
                    })
                    $("#ups_rnng_board").on('keypress change blur',function(){
                        var tot_qty = $(this).val();
                        if($('#tot_qty').val() == '' || $('#tot_qty').val() == 0){
                            var totalPending = parseFloat(tot_qty);
                            $('#tot_brd_req').val(totalPending);
                            if($('#ext_brd_req').val() == '' || $('#ext_brd_req').val() == 0){
                                var sideboard = parseFloat($('#tot_brd_req').val());
                                $('#back_board_qty,#front_board_qty').val(Math.ceil(sideboard));
                            }else{
                                var sideboard = parseFloat($('#tot_brd_req').val())+parseFloat($('#ext_brd_req').val());
                                $('#back_board_qty,#front_board_qty').val(Math.ceil(sideboard));
                            }
                            if($('#cutSize_out').val() == '' || $('#cutSize_out').val() == 0){
                                var totalfull = parseFloat(tot_qty);
                                $('#ups_full_board').val(totalfull);
                            }else{
                                var totalfull = parseFloat($('#cutSize_out').val())*parseFloat(tot_qty);
                                $('#ups_full_board').val(totalfull);
                            }
                        }else{                            
                            if($('#ext_brd_req').val() == '' || $('#ext_brd_req').val() == 0){
                                var sideboard = parseFloat($('#tot_brd_req').val());
                                $('#back_board_qty,#front_board_qty').val(Math.ceil(sideboard));
                            }else{
                                var sideboard = parseFloat($('#tot_brd_req').val())+parseFloat($('#ext_brd_req').val());
                                $('#back_board_qty,#front_board_qty').val(Math.ceil(sideboard));
                            }
                            if($('#cutSize_out').val() == '' || $('#cutSize_out').val() == 0){
                                var totalfull = parseFloat(tot_qty);
                                $('#ups_full_board').val(totalfull);
                            }else{
                                var totalfull = parseFloat($('#cutSize_out').val())*parseFloat(tot_qty);
                                $('#ups_full_board').val(totalfull);
                            }
                            var totalPending = parseFloat($('#tot_qty').val())/parseFloat($('#ups_full_board').val());
                            $('#tot_brd_req').val(totalPending);
                        }
                        
                    })
                    

                })
                </script>