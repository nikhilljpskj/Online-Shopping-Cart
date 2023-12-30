<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

<style>
    #button1 {
        background-color: #008CBA;
        /* Green */
        border: none;
        color: white;
        padding: 2px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 10px;
        margin: 2px 5px;
        margin: 20px;

    }



    #button2 {
        background-color: #008CBA;
        /* Green */
        border: none;
        color: white;
        padding: 1px 20px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 10px;
        margin: 2px 2px;
        margin: 15px;
    }

    .btn-circle {
        width: 10px;
        height: 30px;
        text-align: center;
        padding: 2px 0;
        font-size: 5px;
        line-height: 1.428571429;
        border-radius: 20px;
    }

    .btn-circle.btn-lg {
        width: 50px;
        height: 50px;
        padding: 10px 16px;
        font-size: 18px;
        line-height: 1.33;
        border-radius: 25px;
    }

    .btn-circle.btn-xl {
        width: 70px;
        height: 70px;
        padding: 10px 16px;
        font-size: 24px;
        line-height: 1.33;
        border-radius: 35px;
    }

    i.mdi.mdi-fullscreen {
        float: right;
        margin-left: 960px;
    }
</style>
<section id="basic-horizontal-layouts">
	<div class="row match-height">
		<div class="col">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title"><?php echo $heading; ?></h4>
					<div class="float-right ">
						<a class="btn btn-primary waves-effect waves-light" href="<?php echo base_url('/product'); ?>"> Back</a>
					</div>
				</div>
				<?php $this->load->view('validation_msg'); ?>
				<div class="card-body">
			<?php echo form_open_multipart($form_url, array('id' => 'registerForm', 'class' => 'form form-horizontal', 'enctype' => 'multipart/form-data')) ?>

					<div class="form-body">
					<div class="row">
                        <div class="col-md-3 col-lg-4">
                            <div class="form-group">
                                <label class="required">Brand Name</label>
                                <select name="brand_id" id="brand_id" type="text" class="form-control">
                                    <option value="">Select Brand Name</option>
                                    <?php foreach ($brands as $b) { ?>
                                        <option value="<?php echo $b->brand_id; ?>" <?php if ($b->brand_id == (isset($_POST['brand_id']) ? $_POST['brand_id'] : '')) { echo 'selected'; } ?>><?php echo $b->brand_name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-4">
                            <div class="form-group">
                                <label class="required">Category</label>
                                <select name="pgroup" id="pgroup" type="text" class="form-control">
                                    <option value="">Select Category</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-4">
                            <div class="form-group">
                                <label class="required">Sub Category</label>
                                <select name="pgroup_sub" id="pgroup_sub" type="text" class="form-control">
                                    <option value="">Select Sub Category</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
    <div class="col-md-3 col-lg-4">
        <div class="form-group">
            <label class="required">Product Code</label>
            <input name="product_code" id="product_code" type="text" class="form-control" placeholder="Enter Product Code" value="<?php echo (isset($_POST['product_code'])) ? $_POST['product_code'] : ''; ?>">
        </div>
    </div>
    <div class="col-md-3 col-lg-4">
        <div class="form-group">
            <label class="required">Product Name</label>
            <input name="product_name" id="product_name" type="text" class="form-control" placeholder="Enter Product Name" value="<?php echo (isset($_POST['product_name'])) ? $_POST['product_name'] : ''; ?>">
        </div>
    </div>
    <div class="col-md-3 col-lg-4">
       <div class="form-group">
            <label>Product Image</label>
            <input name="product_image" id="product_image" type="file" class="form-control" placeholder="Image" multiple>
            <?php if (form_error('product_image')) { ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <?php echo form_error('product_image'); ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>


                    <br>
                    <div class="form-group">
                        <label>Product Description</label>
                        <textarea name="product_desc" id="summernote" type="text" class="form-control" placeholder="Enter Product Description" value="<?php echo (isset($_POST['product_desc'])) ? $_POST['product_desc'] : ''; ?>">
                                    </textarea>
                        <?php if (form_error('product_desc')) { ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <?php echo form_error('product_desc'); ?>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="max">
                        <div class="fields">
                            <div class="field col-md-12">
                                <div class="row">
                                    <div class="col-md-3 col-lg-3">
                                        <label class="required">Variation Name</label>
                                        <input name="variation_name[]" id="variation_name" type="text" class="form-control variation_name" placeholder="Enter Variation Name">
                                        <?php if (form_error('variation_name')) { ?>
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                                <?php echo form_error('variation_name'); ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="col-md-3 col-lg-2">
                                        <label class="required">Stock</label>
                                        <input name="product_qty[]" id="product_qty" type="text" class="form-control product_qty" placeholder="Enter Stock">
                                        <?php if (form_error('product_qty')) { ?>
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                                <?php echo form_error('product_qty'); ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="col-md-3 col-lg-2">
                                        <label class="required">Price in USD</label>
                                        <input name="product_price[]" id="product_price" type="text" class="form-control product_price" placeholder="Enter Price">
                                        <?php if (form_error('product_price')) { ?>
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                                <?php echo form_error('product_price'); ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="col-md-3 col-lg-2">
                                        <label class="required">Price in INR</label>
                                        <input name="slash_price[]" id="slash_price" type="text" class="form-control slash_price" placeholder="Discount Price">
                                        <?php if (form_error('slash_price')) { ?>
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                                <?php echo form_error('slash_price'); ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="col-md-3 col-lg-3">
                                        <label>Product Image</label>
                                        <input name="photo[]" id="photo" type="file" class="form-control" placeholder="Image" multiple>
                                        <?php if (form_error('photo')) { ?>
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                                <?php echo form_error('photo'); ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="row" id="variation_fields">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <button type="button" id="button1" class="add-field btn btn-default btn-circle"><i class="ficon bx bx-plus"></i></button>
                                <button type="button" id="button2" class="remove-field btn btn-default btn-circle"><i class="ficon bx bx-minus"></i></button>
                            </div>
                        </div>
                    </div>
                    <div style="display:none;" id="hidden_attributes"></div>
                    <hr>
                    <div class="row">
                        <div class="form-group mb-0">
                            <div>
                                <button name="submit" type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                    Submit
                                </button>
                                <a href="<?php echo base_url(); ?>/product" class="btn btn-secondary waves-effect">Cancel </a>
                            </div>
                        </div>
                    </div>
					</div>
					<?php form_close(); ?>
				</div>
			</div>
		</div>
	</div>
</section>

