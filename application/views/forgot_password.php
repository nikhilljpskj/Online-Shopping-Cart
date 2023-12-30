<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Forgot Password">
    <meta name="author" content="Ansonika">
    <title>Forgot Password</title>

    <!-- GOOGLE WEB FONT -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="<?php echo base_url(); ?>assets/login/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/login/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/login/css/menu.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/login/css/vendors.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/login/css/icon_fonts/css/all_icons_min.css" rel="stylesheet">

    <!-- YOUR CUSTOM CSS -->
    <link href="<?php echo base_url(); ?>assets/login/css/custom.css" rel="stylesheet">
    <style>
    
    
        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f8f9fa;
        }

        .login-box {
            width: 400px;
        }

        .warning-msg {
            color: red;
            text-transform: capitalize;
        }

        .need_validation_error {
            border: 1px solid red;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

</head>


<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <H3>Forgot Password</H3>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Enter your email</p>

                <form action="<?= base_url('login/forgotPassword') ?>" method="post">
                    <div class="form-group">
                        <input type="email" required name="email" class="form-control need form-control-user" placeholder="Email">
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="icheck-primary">
                                <?php if ($this->session->flashdata('error')) { ?>
                                    <p class="text-danger"><?= $this->session->flashdata('error') ?></p>
                                <?php } ?>
                                <?php if ($this->session->flashdata('success')) { ?>
                                    <p class="text-success"><?= $this->session->flashdata('success') ?></p>
                                <?php } ?>
                                <p class="text-danger"><?php echo validation_errors(); ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-user btn-block">Send Reset Link</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.login-box -->
<script>
$(document).ready(function () {
    $('#submit').click(function (e) {
    e.preventDefault();

    var email = $('#email').val();

    $.ajax({
        type: "POST",
        url: "<?= base_url('login/forgotPassword') ?>",
        data: { email: email },
        dataType: 'json',
        success: function (response) {
                if (response.status === 'success') {
                        Swal.fire({
                            title: 'Mail Sent',
                            text: 'Reset password link successfully sent.',
                            icon: 'success',
                            confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                                window.location.href = "<?= base_url() . 'login' ?>";
                            }
                        });
            } else if (response.status === 'error') {
                        Swal.fire({
                            title: 'Error sending link',
                            text: response.message,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
        },

    });
});
});

</script>


    <!-- jQuery -->
    <script src="<?= base_url('assets/') ?>plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?= base_url('assets/') ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?= base_url('assets/') ?>dist/js/adminlte.min.js"></script>
</body>

</html>
