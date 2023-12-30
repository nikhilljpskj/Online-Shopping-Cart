<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Login">
	<meta name="author" content="Ansonika">
	<title>Admin Login</title>

	<!-- GOOGLE WEB FONT -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800" rel="stylesheet">

	<!-- BASE CSS -->
	<link href="<?php echo base_url(); ?>assets/login/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/login/css/style.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/login/css/style.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/login/css/menu.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/login/css/vendors.css" rel="stylesheet">
	<link href="<?php echo base_url(); ?>assets/login/css/icon_fonts/css/all_icons_min.css" rel="stylesheet">

	<!-- YOUR CUSTOM CSS -->
	<link href="<?php echo base_url(); ?>assets/login/css/custom.css" rel="stylesheet">
	<style>
		.warning-msg {
			color: red;
			text-transform: capitalize;
		}

		.need_validation_error {
			border: 1px solid red;
		}
	</style>
</head>

<body>

<center>
<div class="container-fluid margin_120_95">
					

					<div class="col-lg-6">

  
    <div id="login-2">
      <h2>Set New Password</h2>

       <form method="post" action="<?=base_url('reset/password?hash='.$hash)?>">
                
                  <div class="form-group">
                   
                    <input type="password" class="form-control need form-control-user" name="password" id="exampleInputPassword1" placeholder="New Password">
                  </div>
                  <div class="form-group">
                    
                    <input type="password" class="form-control need form-control-user" id="exampleInputPassword1" name="cpassword" placeholder="Confirm new Password">
                  </div>
                  
                  <div class="form-check">
                      <?php if($this->session->userdata('error')) { ?>
			              	<p class="text-danger"><?=$this->session->userdata('error')?></p>
			              	<?php } ?>
			              	 <?php if($this->session->userdata('success')) { ?>
			              	<p class="text-success"><?=$this->session->userdata('success')?></p>
			              	<?php } ?>
			              	<p class="text-danger"><?php echo validation_errors(); ?></p>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>

     
      <!-- /.social-auth-links -->

    
    </div>
    </div>
    </div>
    
 
</center>
<!-- jQuery -->
<script src="<?=base_url('assets/')?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?=base_url('assets/')?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url('assets/')?>dist/js/adminlte.min.js"></script>
</body>
</html>
