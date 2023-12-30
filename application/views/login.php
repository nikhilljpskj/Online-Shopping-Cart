



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

        /* New style to ensure login above registration */
        #hero_register {
            position: relative;
        }

        #loginForm {
            position: relative;
            top: 0;
            left: 0;
            width: 100%;
        }

        #registerFormContainer {
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            display: none; 
        }

        .centered-text {
            font-family: 'Times New Roman', Times, serif;
            text-align: center;
            margin-botton: 0px;
            margin-left: 550px;
            margin-top: 15px;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
    <section>

   <div class="container-fluid" style="margin-top: 30px !important;">
    <img class="float-right" src="<?php echo base_url(); ?>assets/app-assets/images/logo/ceae.png" alt="avatar" height="100px" width="250px">
</div>
<br><br><br><br><br>
	<center>
		<main>
			<div id="hero_register">
            
				<div class="container-fluid bg-light">
					<div class="row"></div>
					<div class="col-lg-6">
                    
						<div id="login-2">
						
							<div id="invalid" class="d-none">
								<span class="warning-msg">Invaild Username or Password</span>
							</div>
							<div class="user pull-right" id="loginForm">
                            <br>
                            <p class="text-left"><strong style="font-size:17px;color:black;">I'm already a customer</strong></p>
                            <hr>
                            <p class="text-left" style="font-size:14px;color:black;">Login with your email address and password</p>
								<div class="form-group">
									<input type="text" name="email" id="email" class="form-control login_st form-control-user" placeholder="Your Email Address" autocomplete="off" />
								</div>

								<div class="form-group">
									<input type="password" name="password" id="password" class="form-control login_st form-control-user" placeholder="Your Password" autocomplete="off" />
								</div>
                                <p class="text-left" ><a href="<?= base_url() . 'login/forgotPassword' ?>" style="color:#4db026;"><strong>Forgot your Password?</strong></a></p>
                                <div class="form-group">
                                
                                </div>

								<div class="form-group">
									<button name="submit" id="submit" value="Login"  class="btn btn-user" style="float:left;background-color:#4db026;color:white;">Login ></button>
								</div><br>
                                <br><br><br>
                                <div class="form-group">
                                    <a href="#" class="btn btn-success btn-user btn-block" id="showRegisterForm" style="background-color:#4db026;color:white;">I'm a new customer <p style="float:right;">v</p></a>        
                                </div>
                        </div>
						</div>
					</div>
				</div>
			</div>
			</div>
		</main>
	</center>
    </section>
    <footer id="loginFooter" style="position: relative; bottom: 0; width: 100%; background-color: green; padding: 5px; display: none; color: white;">
    <div class="container">
        <div class="row">
            <p class="centered-text"> Privacy Policy &nbsp; &nbsp; &nbsp; AGB &nbsp; &nbsp; &nbsp; imprints &nbsp; &nbsp; &nbsp; &copy; <?php echo date('Y'); ?> Punarbhava sustainable products. All rights reserved.</p>
        </div>
    </div>
</footer>
    

    <div id="registerFormContainer">
 <?php $this->load->view('register');?>
        
    </div>

    <div id="toTop"></div>
    <!-- Back to top button -->

        <footer style="position: relative; bottom: 0; width: 100%; background-color: green; padding: 5px; color: white;">
        <div class="container">
            <div class="row">
                <p class="centered-text"> Privacy Policy &nbsp; &nbsp; &nbsp; AGB &nbsp; &nbsp; &nbsp; imprints &nbsp; &nbsp; &nbsp; &copy; <?php echo date('Y'); ?> Punarbhava sustainable products. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- COMMON SCRIPTS -->
	<script src="<?php echo base_url(); ?>assets/login/js/jquery-2.2.4.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/login/js/common_scripts.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/login/js/functions.js"></script>
	<script type="text/javascript">

        $(document).on('click','#submit',function(e) {
			e.preventDefault()
            
			var flg = '';
			var isValid = true;

			$('.login_st').each(function() {
				if ($.trim($(this).val()) == '') {
					isValid = false;
					$(this).addClass('need_validation_error');
					$(this).parents('.input-group').find('.select2-selection').addClass('need_validation_error');
					$(this).parents('.form-group').addClass('has-error has-danger');
					flg = 1;
				} else {
					$(this).removeClass('need_validation_error');
					$(this).parents('.input-group').find('.select2-selection').removeClass('need_validation_error');
					$(this).parents('.form-group').removeClass('has-error has-danger');
					flg = 0;
				}

			});

			if (isValid == false) {
				e.preventDefault();
			}

			if (flg === 0) {
				$.ajax({
					type: "POST",
					url: "<?= base_url() . 'login/validate' ?>",
					data: {
						email: $('#email').val(),
						password: $('#password').val()
					},
					cache: true,
					async: false,
					success: function(data) {
						if (data !== false) {
							$('#invalid').addClass('d-none')
							$('.need').removeClass('need_validation_error');
							$('.need').parents('.input-group').find('.select2-selection').removeClass('need_validation_error');
							$('.need').parents('.form-group').removeClass('has-error has-danger');
							window.location.href = '<?= base_url() . 'dashboard' ?>'
						} else {
							$('.need').addClass('need_validation_error');
							$('.need').parents('.input-group').find('.select2-selection').addClass('need_validation_error');
							$('.need').parents('.form-group').addClass('has-error has-danger');
							$('#invalid').removeClass('d-none')
						}
					}
				});
			}
		});

    $(document).ready(function () {
        // Function to load and show the register form
        function loadRegisterForm() {
            $.ajax({
                url: "<?= base_url() . 'login/load_reg' ?>", 
                type: "GET",
                success: function(data) {
                    $("#registerFormContainer").html(data);
                    $('#registerFormContainer').show();
                },
                error: function() {
                    console.error("Failed to load register view");
                }
            });
        }

        // Click event handler for the "I am a new customer" button
            $('#showRegisterForm').click(function (e) {
                e.preventDefault();
                //$('#loginForm').toggle();
                $('#registerFormContainer').toggle();
                $('#loginFooter').hide();
                

            });

            // Hide register form initially
            $('#loginForm').show();
            $('#registerFormContainer').hide();
            $('#loginFooter').show();
        });
    </script>

