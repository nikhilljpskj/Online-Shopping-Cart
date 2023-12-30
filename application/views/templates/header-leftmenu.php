<style>
    @media (max-width: 991px) { 
        .main-menu-content{
            padding-top: 30px;
        }
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<nav class="header-navbar navbar-expand-lg navbar navbar-with-menu navbar-static-top bg-white navbar-brand-center" style="padding-top: 0px !important;padding-bottom: 0px !important;">
    <div class="navbar-wrapper">
        <div class="navbar-container content">
            <div class="navbar-collapse" id="navbar-mobile">
                <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                    
                    <ul class="nav navbar-nav bookmark-icons">

                        <?php
                        $user_id = $this->session->userdata('id');
                        $cart_count = $this->db->where('user_id', $user_id)->count_all_results('cart');
                        ?>

                        <!-- User Dropdown -->
                        <li class="nav-item d-none d-lg-block">
                                <a class="dropdown-toggle nav-link" data-toggle="dropdown" data-placement="top" href="<?php echo base_url(); ?>/dashboard" title="Groups">
        <span><img class="round" src="<?php echo base_url(); ?>assets/app-assets/images/portrait/small/avatar-s-11.jpg" alt="avatar" height="50" width="50"></span><text style="font-size: 15px; letter-spacing: 3px;"><?php echo $this->session->userdata('firstname'); ?></text>
        <div class="user-nav d-lg-flex d-none">
            <span class="user-name"></span>
        </div>
    </a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="<?php echo base_url() ?>/dashboard">
                                    <i class="bx bx-home mr-50"></i> Home
                                </a>
                                <a class="dropdown-item" href="<?php echo base_url() ?>/orders">
                                    <i class="bx bx-box mr-50"></i> Orders
                                </a>
                                <a class="dropdown-item" href="<?php echo base_url() ?>/company">
                                    <i class="bx bx-user mr-50"></i> Profile
                                </a>
                                <a class="dropdown-item" href="<?php echo base_url() ?>login/logout">
                                    <i class="bx bx-power-off mr-50"></i> Logout
                                </a>
                            </div>
                        </li>

                        <li class="nav-item d-none d-lg-block">
    <a class="nav-link text-black" href="<?php echo base_url('masters/file_upload'); ?>" data-toggle="tooltip" data-placement="top" title="File Upload">
        <div class="user-nav d-lg-flex d-none"></div>
        <span><img class="round" src="<?php echo base_url(); ?>Images/configs.png" alt="avatar" height="50" width="50"></span>
        <text style="font-size: 15px; letter-spacing: 3px;">Configurations</text>
    </a>
</li>
<li class="nav-item d-none d-lg-block">
    <a class="nav-link text-black" href="<?php echo base_url('masters/file_upload'); ?>" data-toggle="tooltip" data-placement="top" title="File Upload">
        <div class="user-nav d-lg-flex d-none"></div>
        <span><img class="round" src="<?php echo base_url(); ?>Images/manuals.png" alt="avatar" height="50" width="50"></span>
        <text style="font-size: 15px; letter-spacing: 3px;">Manuals</text>
    </a>
</li>

                        <!-- Basket Button -->
                        <li class="nav-item d-none d-lg-block">
                            <a id="basketButton" class="nav-link text-black" href="<?php echo base_url('checkout'); ?>" data-toggle="tooltip" data-placement="top" title="Orders">
                                <div class="user-nav d-lg-flex d-none"></div>
                                <span><img class="round" src="<?php echo base_url(); ?>Images/carts.jpg" alt="avatar" height="50" width="50"></span><text style="font-size: 15px; letter-spacing: 3px;">Basket</text>
                                <?php if ($cart_count > 0): ?>
                                    <span class="badge badge-pill badge-danger"><?php echo $cart_count; ?></span>
                                <?php endif; ?>
                            </a>
                        </li>

                        <!-- All Orders Button -->
                        





                    </ul>
                </div>
                <ul class="nav navbar-nav float-right d-flex align-items-center">
                    <li class="dropdown dropdown-language nav-item">
                        <a class="dropdown-toggle nav-link" id="dropdown-flag" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="flag-icon flag-icon-us"></i><span class="selected-language d-lg-inline d-none">English</span>
                            <img class="round" src="<?php echo base_url(); ?>assets/app-assets/images/logo/ceae.png" alt="avatar" height="100px" width="250px">
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<script>
    // Attach click event to the basket button
    document.getElementById('basketButton').addEventListener('click', function (event) {
        // Prevent the default behavior (following the link)
        event.preventDefault();

        // Check if the cart is empty
        <?php if ($cart_count == 0): ?>
            // Display SweetAlert message and redirect to dashboard
            Swal.fire({
                title: 'Cart is Empty',
                text: 'Your cart is currently empty.',
                icon: 'info',
                confirmButtonText: 'OK',
                onClose: function () {
                    window.location.href = "<?php echo base_url('dashboard'); ?>";
                }
            });
        <?php else: ?>
            // Otherwise, let the link navigate to the checkout page
            window.location.href = "<?php echo base_url('checkout'); ?>";
        <?php endif; ?>
    });
</script>
