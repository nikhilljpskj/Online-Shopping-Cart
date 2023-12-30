<section id="main-content">
    <section class="wrapper">
        <link href="/libs/bootstrap/css/bootstrap1.min.css" rel="stylesheet" id="bootstrap-css">
        <?php $date = date('d-m-Y'); ?>
        <div class="card">
            <div class="card-body">
                <form action="<?php echo base_url('workorder/work_order_material_issue'); ?>" id="registerForm" class="form" enctype="multipart/form-data" method="post">
                    <div class="form-body">
                        <div class="container">
                            <div class="col">
                                <?php echo "Date: " . $date; ?>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-6">
                                <label for="wo_no">WorkOrder No</label> 
                                <input type="text" class="form-control" name="wo_no" id="wo_no"  value="">
                                </div>
                                <!--<div class="col-md-6">
                                <label for="pono">Po no</label> 
                                <input type="text" class="form-control" name="po_no" id="po_no"  value="">
                                </div>-->
                                </div>
                            </div>
                            <div class="row">
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
		</div>

        <div class="row">

              <div class="col-md-6">
            <div class="form-group">
              <label for="" class="control-label">Promised Date</label>
              <input id="end_date" type="date" required="required" name='end_date'  placeholder='Enter Date' class="form-control"/>
            </div>
          </div>
          
		  </div>
		  <div class="row">
		  <div class="col-md-4">
		  <div class="form-group">
					<label for="" class="control-label">Po Quantity</label>
					<input type="text" class="form-control" name="po_qty" value="" >
				</div>
		  </div>
		  <div class="col-md-4">
		  <div class="form-group">
					<label for="" class="control-label">Production Quantity</label>
					<input type="number" class="form-control" name="prd_qty"   value="">
				</div>
		  </div>
		  <div class="col-md-4">
		  		  <div class="form-group">
					<label for="" class="control-label">Board Quantity</label>
					<input type="text" class="form-control" name="board_qty" value="">
				</div>
		  </div>
        <div class="row">

              <div class="col-md-6">
            <div class="form-group">
              <label for="" class="control-label">LotNo</label>
              <input type="text" required="required" name='lot_no'  placeholder='Enter LotNo' class="form-control"/>
            </div>
          </div>
                   <div class="col-md-6">
            <div class="form-group">
              <label for="" class="control-label">Print Type</label>
              <input type="text" required="required" name='print_type'  placeholder='Enter Print type' class="form-control"/>
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