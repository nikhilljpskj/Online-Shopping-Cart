<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>

<head>
    <?php $this->load->view('templates/header-script'); ?>
    <style type="text/css">
        .user-name {
            color: white;
        }

        .container {
            width: 100%; /* Adjust as needed */
            margin: 0 auto;
        }

        .footer {
            position: absolute;
            background: #444444;
            height: 50px;
            width: 100%;
            font-family: 'Open Sans', sans-serif;
            color: #FFFFFF;
            bottom: 10px;
        }

        /* Add the print styles here */
        @media print {
            .exclude-print {
                display: none;
            }

            img[src]:after {
                content: none !important;
            }

            @page {
                size: 8.5in 5.5in;
                size: portrait;
            }

            .row {
                page-break-inside: avoid;
            }

            .footer {
                display: none; /* Hide the footer in print view */
            }
        }
    </style>
</head>

<body class="horizontal-layout horizontal-menu navbar-static footer-static" data-open="hover" data-menu="horizontal-menu">
    <?php    
        $this->load->view('templates/header-leftmenu');
        $this->load->view('templates/header-menu');
        $this->load->view($page);
        
        if (!isset($exclude_print) || !$exclude_print) {
            $this->load->view('templates/footer', array('exclude_print' => true));
        }
    ?>
</body>

</html>
