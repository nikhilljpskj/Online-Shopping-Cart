<div class="row align-items-center">
    <div class="col-sm-6">
        <div class="page-title-box">
            <h4 class="font-size-18">Orders</h4>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>seller/orders/manage_orders/">Manage
                        Orders</a></li>
                <li class="breadcrumb-item active">Orders</li>
            </ol>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="float-right d-none d-md-block">

            <a class="btn btn-primary waves-effect waves-light"
                href="<?php echo base_url(); ?>seller/orders/manage_orders/">
                View Orders
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
<!-- <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <?php echo validation_errors(); ?>
    </div> -->
<?php
}
?>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Order</h4>
                <form
                    action="<?php echo base_url(); ?>seller/orders/manage_orders/edit/<?php echo base64_encode($this->encryption->encrypt($order_delivery['o_id'])); ?>"
                    method="post" enctype="multipart/form-data">
                  
                    <div class="form-group">
                        <label>Order Status</label><span class="mandatory">*</span>
                        <select name="order_status" id="order_status" class="form-control" required>
                            <!--  <option value="1" <?php if ($order_delivery['order_status'] == '1') {echo 'selected';}?>>New
                            </option>  -->
                            <option value="2" <?php if ($order_delivery['order_status'] == '2') {echo 'selected';}?>>Out
                                of Delivery</option>
                            <option value="3" <?php if ($order_delivery['order_status'] == '3') {echo 'selected';}?>>
                                Delivered</option>

                        </select>
                        <?php if (form_error('order_status')) {?>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <?php echo form_error('order_status'); ?>
                        </div>
                        <?php }?>
                    </div>
                    <div class="form-group mb-0">
                        <div>
                            <button name="submit" type="submit" class="btn btn-primary waves-effect waves-light mr-1">
                                Submit
                            </button>
                            <button type="reset" class="btn btn-secondary waves-effect" onclick="window.history.back()">
                                Cancel
                            </button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
