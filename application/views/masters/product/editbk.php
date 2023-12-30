<?php foreach ($default as $data) {
    // echo '<pre>';
    // print_r($data);
    // die;
} ?>

<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.css" rel="stylesheet" id="bootstrap-css">

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

<div class="row align-items-center">
    <div class="col-sm-6">
        <div class="page-title-box">
            <h4 class="font-size-18">Products</h4>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>seller/product/product/product/">Manage
                        Products</a></li>
                <li class="breadcrumb-item active">Products</li>
            </ol>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="float-right d-none d-md-block">

            <a class="btn btn-primary waves-effect waves-light" href="<?php echo base_url(); ?>seller/product/product/product/">
                View Products
            </a>
        </div>
    </div>
</div>

<?php
if ($this->session->flashdata('alert_success')) {
?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <strong>Success!</strong> <?php echo $this->session->flashdata('alert_success'); ?>
    </div>
<?php
}

if ($this->session->flashdata('alert_danger')) {
?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <strong>Success!</strong> <?php echo $this->session->flashdata('alert_danger'); ?>
    </div>
<?php
}

if ($this->session->flashdata('alert_warning')) {
?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <strong>Success!</strong> <?php echo $this->session->flashdata('alert_warning'); ?>
    </div>
<?php
}
if (validation_errors()) {
?>
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <?php echo validation_errors(); ?>
    </div>
<?php
}
?>


<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Create Products Group</h4>
                <form action="<?php echo base_url(); ?>seller/product/product/product/edit/<?php echo $data->pro_id ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-3 col-lg-4">
                            <div class="form-group">
                                <label class="required">Brand Name</label>
                                <select name="brand_id" id="brand_id" type="text" class="form-control">
                                    <option value="">Select Brand Name</option>
                                    <?php foreach ($brands as $b) { ?>
                                        <option value="<?php echo $b->brand_id; ?>" <?php if ($b->brand_id == $data->brand_id) {
                                                                                        echo 'selected';
                                                                                    } ?>><?php echo $b->brand_name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-4">
                            <div class="form-group">
                                <label class="required">Products Category</label>
                                <select name="pgroup" id="pgroup" type="text" class="form-control">
                                    <option value="">Select Category</option>
                                    <?php foreach ($category as $pg) { ?>
                                        <option value="<?php echo $pg->id; ?>" <?php if ($pg->id == $data->pgroup) {
                                                                                    echo 'selected';
                                                                                } ?>><?php echo $pg->category_name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-4">
                            <div class="form-group">
                                <label class="">Products Sub Category</label>
                                <select name="pgroup_sub" id="pgroup_sub" type="text" class="form-control">
                                    <option value="">Select Sub Category</option>
                                    <?php foreach ($sub_category as $s) { ?>
                                        <option <?php if ($s->id == $data->pgroup_sub) {
                                                    echo 'selected';
                                                }  ?> value="<?php echo $s->id; ?>"><?php echo $s->sub_category_name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-lg-6">
                            <div class="form-group">
                                <label class="required">Product Code</label>
                                <input name="product_code" id="product_code" type="text" class="form-control" placeholder="Enter Product Code" value="<?php echo (isset($data->product_code)) ? $data->product_code : $_POST['product_code']; ?>">
                            </div>
                        </div>
                        <div class="col-md-3 col-lg-6">
                            <div class="form-group">
                                <label class="required">Product Name</label>
                                <input name="product_name" id="product_name" type="text" class="form-control" placeholder="Enter Product Name" value="<?php echo (isset($data->product_name)) ? $data->product_name : $_POST['product_name']; ?>">
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <label>Product Description</label>
                        <textarea name="product_desc" id="summernote" type="text" class="form-control" placeholder="Enter Product Description" value=""><?php echo (isset($data->product_desc)) ? $data->product_desc : $_POST['product_desc']; ?></textarea>
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
                            <?php foreach ($product_details as $pd) {
                                $attributes_name_array = explode('|', $pd->attributes_name);
                                $attribute_id_array = explode('|', $pd->attribute_id);
                                $attribute_value_array = explode('|', $pd->attribute_value);
                                $attribute_length = count($attributes_name_array);
                            ?>

                                <div class="field col-md-12">
                                    <div class="row">
                                        <div class="col-md-3 col-lg-3">
                                            <label class="required">Variation Name</label>
                                            <input name="variation_name[]" id="variation_name" type="text" class="form-control variation_name" placeholder="Enter Variation Name" value="<?php echo $pd->variation_name; ?>">
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
                                            <input name="product_qty[]" id="product_qty" type="text" class="form-control product_price" placeholder="Enter Stock" value="<?php echo $pd->qty; ?>"> <input type="hidden" name="pro_details_id[]" value="<?php echo $pd->pro_details_id; ?>" />
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
                                            <label class="required">Price</label>
                                            <input name="product_price[]" id="product_price" type="text" class="form-control product_price" placeholder="Enter Price" value="<?php echo $pd->price; ?>">
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
                                            <label class="required">Discount Price</label>
                                            <input name="slash_price[]" id="slash_price" type="text" class="form-control slash_price" placeholder="Discount Price" value="<?php echo $pd->slash_price; ?>">
                                            <?php if (form_error('slash_price')) { ?>
                                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                    <?php echo form_error('slash_price'); ?>
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <?php if (!empty($pd->image)) { ?>
                                            <div class="col-md-3 col-lg-2">
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
                                            <div class="col-md-3 col-lg-1">
                                                <img src="<?php echo $pd->image; ?>" width="50px" height="50px">
                                                <input type="hidden" name="old_img[]" value="<?php echo $pd->image; ?>">
                                            </div>
                                        <?php } else { ?>
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
                                        <?php  } ?>
                                    </div>
                                    <div class="row" id="variation_fields">
                                        <?php for ($at = 0; $at < $attribute_length; $at++) {
                                            echo '<div class="col-md-3 col-lg-3"><label class="required">' . $attributes_name_array[$at] . '</label>
                                                <input name="' . $attribute_id_array[$at] . '[]" id="' . $attribute_id_array[$at] . '" type="text" class="form-control " 
                                                placeholder="Enter ' . $attributes_name_array[$at] . '" value="' . $attribute_value_array[$at] . '">
                                        </div>';
                                        }  ?>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="row">
                            <div class="col-md-2">
                                <button type="button" id="button1" class="add-field btn btn-default btn-circle"><i class="glyphicon glyphicon-plus"></i></button>
                                <button type="button" id="button2" class="remove-field btn btn-default btn-circle"><i class="glyphicon glyphicon-minus"></i></button>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    <div style="display:none;" id="hidden_attributes">
        <?php for ($hat = 0; $hat < $attribute_length; $hat++) {
            echo '<div class="col-md-3 col-lg-3"><label class="required">' . $attributes_name_array[$hat] . '</label><input name="' . $attribute_id_array[$hat] . '[]" id="' . $attribute_id_array[$hat] . '" type="text" class="form-control " placeholder="Enter ' . $attributes_name_array[$hat] . '" ></div>';
        }  ?>
    </div>
</div>
</div>
<hr>
<div class="form-group mb-0">
    <div>
        <button name="submit" type="submit" class="btn btn-primary waves-effect waves-light mr-1">Submit</button>
        <a href="<?php echo base_url(); ?>seller/product/product/product" class="btn btn-secondary waves-effect">Cancel</a>
    </div>
</div>
</form>

</div>
</div>
</div>
</div>
<style type="text/css">
    .required:after {
        content: " *" !important;
        color: red !important;
    }
</style>

<script type="text/javascript">
    $(document).ready(function() {
        $('#brand_id').on('change', function() {

            var brand_id = $(this).val();

            if (brand_id) {
                $.ajax({
                    url: "<?php echo site_url('seller/product/product/product/get_category'); ?>",
                    type: "post",
                    data: {
                        brand_id: brand_id
                    },
                    dataType: "json",
                    success: function(data) {
                        $('select[name="pgroup"]').empty();
                        $("#pgroup").append("<option value=''>--Select--</option>");
                        $.each(data, function(key, value) {
                            $('select[name="pgroup"]').append('<option value="' + value.id + '">' + value.category_name + '</option>');
                        });
                    }
                });
            } else {
                $('select[name="pgroup"]').empty();
            }
        });
        $('#pgroup').on('change', function() {

            var category_id = $(this).val();

            if (category_id) {
                $.ajax({
                    url: "<?php echo site_url('seller/product/product/product/get_subcategory'); ?>",
                    type: "post",
                    data: {
                        category_id: category_id
                    },
                    dataType: "json",
                    success: function(data) {
                        $('select[name="pgroup_sub"]').empty();
                        $("#pgroup_sub").append("<option value=''>--Select--</option>");
                        $.each(data, function(key, value) {
                            $('select[name="pgroup_sub"]').append('<option value="' + value.id + '">' + value.sub_category_name + '</option>');
                        });
                    }
                });
            } else {
                $('select[name="pgroup_sub"]').empty();
            }
        });
        $('select[name="pgroup_sub"]').on('change', function() {
            var sub_category_id = parseInt($(this).val());
            if (sub_category_id) {
                var variation_fields = ``;
                $.ajax({
                    url: "<?php echo site_url('seller/product/product/product/get_attributes'); ?>",
                    type: "post",
                    data: {
                        sub_category_id: sub_category_id
                    },
                    dataType: "json",
                    success: function(data) {
                        $('#variation_fields').empty();
                        $('#hidden_attributes').empty();

                        $.each(data, function(key, value) {
                            variation_fields += `<div class="col-md-3 col-lg-3">
                                    <label class="required">${value.attributes_name}</label>
                                    <input name="${value.id}[]" id="${value.id}" type="text" class="form-control " placeholder="Enter ${value.attributes_name}">
                            </div>`;
                        });
                        $('#variation_fields').append(variation_fields);
                        $('#hidden_attributes').append(variation_fields);
                    },
                    err: function(err) {
                        console.log(err);
                    }
                });
            } else {
                $('#variation_fields').empty();
            }
        });
    });
</script>
<script>
    $('.max').each(function() {
        var $wrapper = $('.fields', this);
        $(".add-field", $(this)).click(function(e, count) {
            var count = $('.field').length;
            var get_hidden_attributes = $('#hidden_attributes').html();
            var append_data = `<div class="field col-md-12">
                                <div class="row">
                                    <div class="col-md-3 col-lg-3">
                                        <label class="required">Variation Name</label>
                                        <input name="variation_name[]" id="variation_name" type="text" class="form-control variation_name" placeholder="Enter Variation Name">
                                    </div>
                                    <div class="col-md-3 col-lg-2">
                                        <label class="required">Stock</label>
                                        <input name="product_qty[]" id="product_qty" type="text" class="form-control product_qty" placeholder="Enter Stock">
                                    </div>
                                    <div class="col-md-3 col-lg-2">
                                        <label class="required">Price</label>
                                        <input name="product_price[]" id="product_price" type="text" class="form-control product_price" placeholder="Enter Price">
                                    </div>
                                    <div class="col-md-3 col-lg-2">
                                        <label class="required">Discount Price</label>
                                        <input name="slash_price[]" id="slash_price" type="text" class="form-control slash_price" placeholder="Discount Price">
                                    </div>
                                    <div class="col-md-3 col-lg-3">
                                        <label>Product Image</label>
                                        <input name="photo[]" id="photo" type="file" class="form-control" placeholder="Image" multiple>
                                    </div>
                                </div>
                                <div class="row" id="variation_fields">
                                    ${get_hidden_attributes}
                                </div>
                            </div>`;
            $wrapper.append(append_data);
        });
        $('.remove-field', $(this)).click(function() {
            if ($('.field').length > 1)
                $('.field').last().remove();
        });
    });
</script>