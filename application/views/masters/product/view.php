<div class="row align-items-center">
    <div class="col-sm-6">
        <div class="page-title-box">
            <h4 class="font-size-18">Products</h4>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>seller/product/product/product/">Products</a></li>
                <li class="breadcrumb-item active">Products</li>
            </ol>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="float-right d-none d-md-block">
           
                <a class="btn btn-primary waves-effect waves-light" href="<?php echo base_url(); ?>seller/product/product/product/">
                    <i class="mdi mdi-plus mr-2"></i> View Products
                </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">View Product</h4>
                <table class="table table-striped">
                    <tbody>
                        <?php foreach($pro_sku as $row) { ?>
                               <?php }?>
                        <tr>
                            <th>Product Name</th>
                            <td><?php echo $row->product_name; ?></td>
                        </tr>
                        
                        <tr>
                         <th>Product Description</th>
                            <td><?php echo $row->product_desc; ?></td>
                        </tr>
                        <tr>
                         <th>Category Name</th>
                            <td><?php echo $row->category_name; ?></td>
                        </tr>
                        <tr>
                         <th>Sub Category Name</th>
                            <td><?php echo $row->sub_category_name; ?></td>
                        </tr>
                 </tbody>
                </table>
                <table class="table table-striped">
                   <thead>
                        <tr>
                          <!--   <th>Product Code</th> -->
                              <th>Size</th>
                             <th>Color</th>
                             <th>Style</th>
                             
                         </tr>
                         </thead>
                          <tbody>
<?php foreach($pro_sku as $row) { ?>
                        <tr>
                            <td><?php echo $row->product_code; ?><?php echo $row->product_id; ?><?php echo $row->psid; ?></td> 
                            <td><?php echo $row->uom; ?></td> 
                            <td><?php echo $row->dealer_price; ?></td>
                            <td><?php echo $row->selling_price; ?></td> 
                            
                        </tr>
                        
                    <?php } ?>
                        <tr>
                            <td colspan="2" class="text-center">

                                <a href="<?php echo base_url(); ?>seller/product/product/product/edit/<?php echo $default['product_id']; ?>" class="btn btn-primary">
                                    Edit Product
                                </a> 

                                &nbsp;<a href="<?php echo base_url(); ?>seller/product/product/product/" class="btn btn-secondary">Back</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
