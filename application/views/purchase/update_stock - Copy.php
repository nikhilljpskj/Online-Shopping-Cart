<div class="container content-invoice">
    <div class="cards">
        <div class="card-bodys">
            <form action="<?php echo base_url('dashboard/stock_update'); ?>" id="invoice-form" method="post" class="invoice-form" role="form" novalidate="">
                <div class="load-animate animated fadeInUp">
                                     
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group mt-3 mb-3 ">
                            <label>Material: &nbsp;</label>
                            <select class="productsList form-control form-control-lg" name="productName" id="productName_0" required="required">
                                            <option>Select Item</option>
                                            <?php foreach ($productdetails as $key => $vals) { ?>
                                                <option data-id="0" data-category="<?php echo $vals['board']; ?>" value="<?php echo $vals['id']; ?>"><?php echo $vals['material']; ?></option>
                                            <?php } ?>
                                        </select>          
                        </div>
                         </div>
                          <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <div class="form-group mt-3 mb-3 ">
                            <label>Stock: &nbsp;</label>
                            <input value="" type="text" class="form-control" name="stock" id="subTotal" placeholder="Subtotal" required="required">          
                        </div>
                            </div>
                    </div>
                    
                    
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
