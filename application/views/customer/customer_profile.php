<?php
class Customer extends CI_Controller {
    public function customer_profile() {
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h2 class="page-header"><i class="fa fa-user"></i> Profile</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <?php if($successMsg = $this->session->flashdata('success_msg')): ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Success!</strong> <?= $successMsg ?>
                </div>
            <?php endif; ?>
            <?php if($errorMsg = $this->session->flashdata('error_msg')): ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?= $errorMsg ?>
                </div>
            <?php endif; ?>
            <div class="panel panel-green">
                <div class="panel-heading">
                    <i class="fa fa-user"></i> Admin Profile
                </div>
                <div class="panel-body">
                    <?= form_open() ?>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>User Full Name</label>
                                    <input type="text" name="fullname" value="<?= $this->session->userdata('FULL_NAME') ?>" class="form-control">
                                    <?= form_error('fullname') ?>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Mobile</label>
                                    <input type="text" name="mobile" value="<?= $this->session->userdata('MOBILE') ?>" class="form-control">
                                    <?= form_error('mobile') ?>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input type="text" name="address" value="<?= $this->session->userdata('ADDRESS') ?>" class="form-control">
                                    <?= form_error('address') ?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-floppy-o"></i> Update Profile</button>
                            </div>
                        </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    }
}
?>
