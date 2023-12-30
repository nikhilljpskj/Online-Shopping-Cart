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
    <div class="alert alert-danger alert-dismissible show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <strong>Success!</strong> <?php echo $this->session->flashdata('alert_danger'); ?>
    </div>
<?php
}

if ($this->session->flashdata('alert_warning')) {
?>
    <div class="alert alert-warning alert-dismissible show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <strong>Success!</strong> <?php echo $this->session->flashdata('alert_warning'); ?>
    </div>
<?php
}
if (validation_errors()) {
?>
    <div class="alert alert-danger alert-dismissible show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <?php echo validation_errors(); ?>
    </div>
<?php
}
?>
<?php if ($this->session->flashdata('check_email_alert_danger')) { ?>
    <div class="alert alert-danger alert-dismissible show" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
        <strong>Success!</strong> <?php echo $this->session->flashdata('check_email_alert_danger'); ?>
    </div>
<?php
    $this->session->unset_userdata('alert_danger');
    $this->session->unset_userdata('alert_warning');
    $this->session->unset_userdata('alert_success');
} ?>
