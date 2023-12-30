<?php foreach($data as $row)
{
  $po_no=$row->po_no;
  $po_date=$row->po_date;
  $po_delivery_date=$row->po_delivery_date;
  $file=$row->file;
  $customer_name=$row->customer_name;
  $customer_id=$row->id;

}
?>

 <?php echo form_open_multipart('dashboard/sales_order_update', array('id' => 'registerForm','class'=>'form')) ?>
<table class="table table-bordered table-hover" id="tab_logic">
        <thead>
      
          <tr>
          
          </tr>
        </thead>
        <tbody>
          <tr id='addr0'>
        <td hidden>1</td>
          <td>               
          <section id="multiple-column-form">  
            <div class="row match-height">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title"></h4>
                  </div>
                  <div class="card-body">
                    <form class="form">
                      	<div class="form-body">
	                        <div class="row">
	                          	<div class="col-sm-6">
                                    <div class="form-group">
                                      <div class="controls">
                                        <label for="first-name-vertical">Po No</label>
                                        <input type="text" id="po_no" name="pono" class="form-control" value="<?php echo $po_no; ?>" placeholder="Po No" required
                                        data-validation-required-message="This Po No is required" >
                                      </div>
                                    </div>
                                 </div>
                                 <div class="col-sm-6">
                                    <div class="form-group">
                                      <div class="controls">
                                        <label for="first-name-vertical">Customer Name</label>
                                        <input type="text" id="customer_name" name="customer_name" value="<?php echo $customer_name; ?>" class="form-control" placeholder="Customer Name" required
                                        data-validation-required-message="This Customer Name field is required" value="">
                                      </div>
                                    </div>
                                 </div>

                                 <div class="col-sm-6">
                                    <div class="form-group">
                                      <div class="controls">
                                        <label for="first-name-vertical">Po Date</label>
                                        <input type="date" id="podate" name="podate" class="form-control" placeholder="PO DATE" required
                                        data-validation-required-message="This PO DATE field is required" value="<?php echo $po_date; ?>">
                                      </div>
                                    </div>
                                 </div>

                                 <div class="col-sm-6">
                                    <div class="form-group">
                                      <div class="controls">
                                        <label for="first-name-vertical">Po Delivery Date</label>
                                        <input type="date" id="po_delivery_date" name="po_delivery_date" class="form-control" placeholder="Po Delivery Date" required
                                        data-validation-required-message="This Po Delivery Date field is required" value="<?php echo $po_delivery_date; ?>">
                                      </div>
                                    </div>
                                 </div>

                                 <div class="col-sm-6">
                                    <div class="form-group">
                                      <div class="controls">
                                        <label for="first-name-vertical">Download Po</label>
                                        <a href="<?php echo base_url()?>Images/<?php echo $file;?>" ><?php echo $po_no; ?></a>
                                      </div>
                                    </div>
                                 </div>

<?php foreach($data as $row)
{
  //print_r($data);
?>

      <!-- <table class="table table-bordered table-hover" id="tab_logic">
        <thead>
      
          <tr>
          <th class="text-center" hidden>#</th>
            <th class="text-center">Product</th>
            <th class="text-center">PO DATE</th>
            <th class="text-center">Delivery DATE</th>
            <th class="text-center">Accepted Delivery DATE</th>     
            <th class="text-center">PO.QTY</th>
            <th class="text-center">Upload Front Image</th>
            <th class="text-center">Upload Back Image</th>
            <th class="text-center">Upload Other Image</th> 
          </tr>
        </thead>
       <div class="row clearfix">
          <div class="col-md-12">
            <button id="add_row" class="btn btn-primary pull-left">Add Row</button>
            <button id='delete_row' class="pull-right btn btn-danger">Delete Row</button>
          </div>
        </div> 
        <tbody>
          <tr id='addr0'>
        <td hidden>1</td>
          <td>               
          <section id="multiple-column-form">  
            <div class="row match-height">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title"></h4>
                  </div>
                  <div class="card-body">
                    <form class="form">
                      <div class="form-body">
                        <div class="row">
                          <div class="col-md-6 col-12">
                            <div class="form-label-group">
                              <div class="row">
                              <div class="col">Product</div> 

                              <input type="hidden" required="required" name='id[]' value="<?php echo $row->id;?>" />

                              <div class="col">
                                <input type="text" name="product_name" value="<?php echo $row->product_name;?>" placeholder="Product Name" class="form-control qty" required>
                                    <select id="product_link" class="form-control" required="required" name="product_one[]">
                                    <option value="<?php echo $row->product_name;?>"><?php echo $row->product_name;?> </option>
                                          <?php foreach($data2 as $datarow) {?>
                                        <option value="<?php echo$datarow->id?>"><?php echo $datarow->name?></option>
                                     <?php }?>
                                  </select>
                            </div>
                            <div id="product_image"></div>
                              </div>
                              <br>
                              <div class="row">
                                    <div class="col">Product Quantity</div>
                                    <div class="col"><input type="text" required="required" name='poqty[]' value="<?php echo $row->product_qty;?>" placeholder='Enter PO.Qty' class="form-control qty" /></div>
                              </div>      
                            
                          </div>
                          </div>
                          <div class="col-md-6 col-12">
                            <div class="form-label-group">  
                              <div class="row">  
                                  <div class="col">Accepting  Date</div>
                                  <div class="col"><input type="date" required="required" name='poaccpdate[]' value="<?php echo $row->accepted_delivery_date;?>"  placeholder='Enter accepted Date' class="form-control"/><br>
                                  </div>
                              </div> 
                              <div class="row">
                                    <div class="col">Rate</div>
                                    <div class="col">
                                      <input type="text" required="required" name="rate[]" value="<?php echo $row->rate; ?>" placeholder="Enter Rate" class="form-control">
                                    </div>
                              </div> 
                          </div>
                          </div>
                        
                        </div>
                      </div>
                      <div class="row">
                                <div class="col-md-4">
                                  <label>Front Image</label>                              
                                  <input class="file" name='temp_file1[]'  type='file'>
                                  <img src="<?php echo base_url()?>Images/<?php echo $row->front_image;?>" class="users-avatar-shadow " height="50" width="50">
                                </div>
                                <div class="col-md-4">
                                    <label>Back Image</label>
                                    <input class="file" name='temp_file2[]' type='file'>
                                    <img src="<?php echo base_url()?>Images/<?php echo $row->back_image;?>" class="users-avatar-shadow " height="50" width="50">
                                </div>
                                <div class="col-md-4">
                                    <label>other Image</label>
                                    <input class="file" name='temp_file3[]'  type='file'/>
                                    <img src="<?php echo base_url()?>Images/<?php echo $row->other_image;?>" class="users-avatar-shadow " height="50" width="50">
                                </div>              
                              </div>
                            </div>
                  </div>
                </div>
              </div>
            </div>        
        </section>
        </td>
        </tr>
          <tr id='addr1'></tr>
        </tbody>

      </table>
    <?php } ?>


	                        </div>
                        </div>
                      </div>
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>        
        </section>
        </td>
        </tr>
          <tr id='addr1'></tr>
        </tbody>

      </table>
      <button name="btnSubmit" class="btn btn-primary" type='submit'>Submit</button> -->
        <?php form_close()?>