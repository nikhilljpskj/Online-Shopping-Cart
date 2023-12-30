<section id="main-content">
    <section class="wrapper">
        <link href="/libs/bootstrap/css/bootstrap1.min.css" rel="stylesheet" id="bootstrap-css">
        <?php 
         $date = date('d-m-Y'); ?>
        <div class="card">
            <div class="card-body">
                <form action="<?php echo base_url('workorder/work_order_material_issue_create'); ?>" id="registerForm" class="form" enctype="multipart/form-data" method="post">
                    <div class="form-body">
                        <div class="container">
                            <div class="col">
                                <?php echo "Date: " . $date; ?>
                                
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-3">
                                <label for="wo_no">Product Name</label> 
                                <input type="hidden" class="form-control" name="wo_no" id="wo_no"  value="<?php echo $data[0]->id; ?>" readonly>
                                <input type="text" class="form-control" name="wo_name" id="wo_name"  value="<?php echo $data[0]->name; ?>" readonly>
                                </div>
                                <!--<div class="col-md-3">
                                <label for="pono">Po no</label> 
                                <input type="text" class="form-control" name="po_no" id="po_no"  value="">
                                </div>-->
                                <div class="col-md-3">
                                <label for="" class="control-label">Promised Date</label>
                                <input id="end_date" type="date" required="required" name='promised_date'  placeholder='Enter Date' class="form-control" value="<?php echo $data[0]->end_date; ?>" readonly/>
                                </div>
                                <div class="col-md-3">
                                <div class="form-group">
					            <label for="" class="control-label">Production Quantity</label>
					            <input type="number" class="form-control" name="prd_qty"   value="<?php echo $data[0]->total_qty ?>" readonly>
				                </div>
                            </div>   
                             
                            <div class="col-md-1">
                            <label for="" class="control-label">Front</label>
                            <input type="checkbox" required="required" name='print_type_front'  placeholder='Enter Print type' class="form-control" checked/>
                            </div>
                            <div class="col-md-1">
                            <label for="" class="control-label">Back</label>
                            <input type="checkbox" name='print_side_back'  placeholder='Enter Print type' class="form-control"  onclick="onChangeBackSideWorkOrderIssue(this)"/>
                            </div>
                            </div>

                              <div class="row">
                                <div class="col-md-4">
                                <label for="wo_no">Front Rawmaterial</label> 
                                <input type="hidden" class="form-control" name="front_product_id" name="front_product_id"  value="<?php echo $data[0]->wo_front_product_id; ?>" readonly> 
                                <input type="text" class="form-control" name="front_product_name" id="front_product_name"  value="<?php echo $data[0]->wo_front_product_name; ?>" readonly>                                 
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="" class="control-label">Board Quantity</label>
                                        <input type="number" class="form-control" name="front_board_qty" value="<?php echo $data[0]->wo_front_boardqty ; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                <div class="form-group">
                                <label for="" class="control-label">LotNo</label>
                                <input type="number" required="required" name='front_lot_no'  placeholder='Enter LotNo' class="form-control"/>
                                </div>
                                </div>   
                                <div class="col-md-3">
                                <div class="form-group">
                                <label for="" class="control-label">Print Type</label>
                                 <select name="front_print_type" class="form-control" required="required">
                                        <option value="offset">OFFSET</option>
                                        <option value="digital">DIGITAL</option>
                                        <option value="diecutting">DIECUTTING</option>
                                        <option value="pasting">PASTING</option>
                                </select>
                                </div>
                                </div>
                                </div>
                                <div class="row" id="back_issue_material" style="display:none">
                                <div class="col-md-4">
                                <label for="wo_no">Back Rawmaterial</label> 
                                <input type="hidden" class="form-control" name="back_product_id" name="back_product_id"  value="<?php echo $data[0]->wo_back_product_id; ?>" readonly> 
                                <input type="text" class="form-control" name="back_product_name" id="back_product_name"  value="<?php echo $data[0]->wo_back_product_name; ?>" readonly>                                 
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="" class="control-label">Board Quantity</label>
                                        <input type="number" class="form-control" name="back_board_qty" value="<?php echo $data[0]->wo_back_boardqty ; ?>" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                <div class="form-group">
                                <label for="" class="control-label">LotNo</label>
                                <input type="number" required="required" name='back_lot_no'  placeholder='Enter LotNo' class="form-control"/>
                                </div>
                                </div>   
                                <div class="col-md-3">
                                <div class="form-group">
                                <label for="" class="control-label">Print Type</label>
                                 <select name="back_print_type" class="form-control" required="required">
                                        <option value="offset">OFFSET</option>
                                        <option value="digital">DIGITAL</option>
                                        <option value="diecutting">DIECUTTING</option>
                                        <option value="pasting">PASTING</option>
                                </select>
                                </div>
                                </div>
                                </div>
                                                    

          <div class="row">
                        </br>
                        <div div class="col-md-4">
                            <div class="form-group">
                            <input name="btnSubmit" class="btn btn-primary submit" type='submit' value="Submit">
                            </div>
                        </div>
                        </div>
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
                $(document).ready(function () {
           $("#workLoad_product_id").on("change", function(e){$("#product_name").val($(this).find(':selected').data('product_name'));
    })
     });
     function onChangeBackSideWorkOrderIssue(element) {
    if (element.checked) $('#back_issue_material').show()
    else $('#back_issue_material').hide()
}
                </script>