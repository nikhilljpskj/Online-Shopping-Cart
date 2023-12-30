<div class="content-wrapper">
	<nav class="top-toolbar navbar navbar-mobile navbar-tablet">
		<ul class="navbar-nav nav-left">
			<li class="nav-item">
				<a href="javascript:void(0)" data-toggle-state="aside-left-open">
					<i class="icon dripicons-align-left"></i>
				</a>
			</li>
		</ul>

		<ul class="navbar-nav nav-right">
			<li class="nav-item">
				<a href="javascript:void(0)" data-toggle-state="mobile-topbar-toggle">
					<i class="icon dripicons-dots-3 rotate-90"></i>
				</a>
			</li>
		</ul>
	</nav>

	<!-- <nav class="top-toolbar navbar navbar-desktop flex-nowrap">

		<ul class="navbar-nav nav-right">
			<li class="nav-item">
				<a href="javascript:void(0)" class="open-search-button" data-q-action="open-site-search">
					<a href="javascript:void(0)" class="open-search-button" data-q-action="open-site-search">
						<i class="no-display" style="color: white;">
							<h1 style="color: white;"><time>00:00:00</time></h1>
						</i>
					</a>
				</a>
			</li>

			<li class="nav-item dropdown">
				<a class="nav-link nav-pill user-avatar" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"><?php if ($this->session->userdata('Profile') != '') { ?>
						<img src="<?php echo $this->session->userdata('Profile'); ?>" class="w-35 rounded-circle" alt="Albert Einstein"><?php } else { ?>
						<img src="<?php echo base_url(); ?>assets/img/avatars/1.jpg" class="w-35 rounded-circle" alt="Albert Einstein"><?php } ?>
				</a>
				<div class="dropdown-menu dropdown-menu-right dropdown-menu-accout">
					<div class="dropdown-header pb-3">
						<div class="media d-user">
							<?php if ($this->session->userdata('Profile') != '') { ?>
								<img src="<?php echo $this->session->userdata('Profile'); ?>" class="w-35 rounded-circle" alt="Albert Einstein"><?php } else { ?>
								<img src="<?php echo base_url(); ?>assets/img/avatars/1.jpg" class="w-35 rounded-circle" alt="Albert Einstein"><?php } ?>
							<div class="media-body" style="margin-top: 9px; margin-left: 11px;">
								<h5 class="mt-0 mb-0"> <?php echo ucfirst($this->session->userdata('UserTypeName')); ?></h5>
							</div>
						</div>
					</div>
					<a class="dropdown-item" href="pages.profile.html"><i class="icon dripicons-user"></i> Profile</a>
					<a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModal"><i class="icon dripicons-gear"></i> Change Password</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="<?php echo base_url('login/logout') ?>"><i class="icon dripicons-lock-open"></i> Sign Out</a>

				</div>
			</li>
		</ul>
		<form role="search" action="http://www.authenticgoods.co/themes/quantum-pro/demos/demo1/pages.search.html" class="navbar-form">
			<div class="form-group">
				<input type="text" placeholder="Search and press enter..." class="form-control navbar-search" autocomplete="off">
				<i data-q-action="close-site-search" class="icon dripicons-cross close-search"></i>
			</div>
			<button type="submit" class="d-none">Submit</button>
		</form>
	</nav> -->
	
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="ModalTitle1">Change Password</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true" class="zmdi zmdi-close"></span>
					</button>
				</div>
				<div class="modal-body">
					<form data-toggle="validator" role="form" method="POST">
						<div class="form-group" id="oldpasserr">
							<label>Old Password</label>
							<input type="text" class="form-control" name="password" id="password" required>
						</div>
						<span id="form_err" style="color:red;"></span>
						<div class="form-group ">
							<label>New Password</label>
							<input type="password" data-minlength="5" class="form-control" id="inputPassword" placeholder="Password" required>
							<input type="hidden" id="baseurl" name="baseurl" value="<?php echo base_url(); ?>">
							<div class="help-block with-errors"></div>
							<span id="form_err1" style="color:red;"></span>
						</div>
						<div class="form-group ">
							<label>Confirm Password</label>
							<input type="password" class="form-control" name="c_password" id="inputPasswordConfirm" data-match="#inputPassword" data-match-error="Whoops, these don't match" placeholder="Confirm" required>
							<div class="help-block with-errors"></div>
							<span id="form_err2" style="color:red;"></span>
						</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary btn-outline" data-dismiss="modal">Close</button>
					<div>
						<button type="button" class="btn btn primary " id="change_pwd" onclick="change_password()">Submit</button>
					</div>
				</div>
				</form>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		function change_password() {

			var baseurl = $('#baseurl').val();
			var password = $('#password').val();
			var n_password = $('#inputPassword').val();
			var c_password = $('#inputPasswordConfirm').val();

			var array = [];
			var a = 0;
			if (password == '') {
				$('#form_err').addClass('has-error');
				array[a] = 1;
			} else {
				$('#form_err').removeClass('has-error');
				array[a] = 0;
			}
			a++;
			if (n_password == '') {
				$('#form_err1').addClass('has-error');
				array[a] = 1;
			} else {
				$('#form_err1').removeClass('has-error');
				array[a] = 0;
			}
			a++;
			if (c_password == '') {
				$('#form_err2').addClass('has-error');
				array[a] = 1;
			} else if (c_password != n_password) {
				$('#form_err2').addClass('has-error');
				array[a] = 1;
			} else {
				$('#form_err2').removeClass('has-error');
				array[a] = 0;
			}
			a++;
			var check = $.inArray(1, array) < 0;
			if (check == true) {


				var data_string = "password=" + password + "&n_password=" + n_password + "&c_password=" + c_password;
				$.ajax({
					url: baseurl + "Login/change_password",
					async: false,
					type: "POST",
					data: data_string,
					dataType: "json",
					cache: false,

					success: function(data) {

						if (data == 1) {
							$("#oldpasserr").addClass("has-error");
							$("#form_err").empty().prepend("invalid Old Password!");
						} else {
							$("#oldpasserr").removeClass("has-error");
							$("#form_err").empty().prepend("");
							window.location.href = data;
						}
					}
				});
			}
		}
	</script>