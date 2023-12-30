<section id="main-content">
    <section class="wrapper">
        <link href="/libs/bootstrap/css/bootstrap1.min.css" rel="stylesheet" id="bootstrap-css">
        <?php $date = date('d-m-Y'); ?>
        <div class="card">
            <div class="card-body" style="background-color:white;">
                <form action="<?php echo base_url('workorder/work_order_material_cutting_create'); ?>" id="registerForm" class="form" enctype="multipart/form-data" method="post">

                    <div class="form-body" >
                        <div class="container">
                            <div class="col">
                                <?php echo "Date: " . $date; ?>
                            </div>
                            <br>
                            <div class="row" style="background-color:WhiteSmoke;">
                            <div class="col-md-3">
                                <label for="wo_no">Product Name</label> 
                                <input type="hidden" class="form-control" name="issue_no" id="issue_no"  value="<?php echo $data[0]->id; ?>" readonly>
                                <input type="hidden" class="form-control" name="wo_no" id="wo_no"  value="<?php echo $data[0]->wo_no; ?>" readonly>
                                <input type="text" class="form-control" name="product_name" id="product_name"  value="<?php echo $data[0]->product_name; ?>" readonly>
                                <input type="hidden" class="form-control" name="product_id" id="product_id"  value="<?php echo $data[0]->product_id; ?>" readonly>
                                <input type="hidden" class="form-control" name="promised_date" id="promised_date"  >
                                </div>
                                <div class="col-md-3">
            <div class="form-group">
              <label for="" class="control-label">Merchandiser</label>
              <input id="manager_id" type="text" required="required" name='manager_id'  placeholder='Enter Merchandiser Name' class="form-control"  value="<?php echo $data[0]->manaer_name; ?>" readonly/>
            </div>
            </div>
              <div class="col-md-3">
            <div class="form-group">
              <label for="" class="control-label">Promised Date</label>
              <input id="promised_date" type="date" required="required" name='promised_date'  placeholder='Enter Date' class="form-control" value="<?php echo $data[0]->promised_date; ?>" readonly />
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label for="" class="control-label">Total Quantity</label>
              <input type="text" required="required" class="form-control" id="prd_qty" name="prd_qty" value="<?php echo $data[0]->prd_qty; ?>" readonly>
            </div>
          </div>                            
		</div>                                   </br>
                                
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
					            <label for="" class="control-label">Input Qty</label>
					            <input type="number" class="form-control" name="prd_qty"   value="" >
				                </div>
                                <div class="form-group">
					            <label for="" class="control-label">Output Qty</label>
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
					            <label for="" class="control-label">Input Qty</label>
					            <input type="number" class="form-control" name="prd_qty"   value="" >
				                </div>
                                 <div class="form-group">
					            <label for="" class="control-label">Output Qty</label>
					            <input type="number" class="form-control" name="prd_qty"   value="" >
				                </div>
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