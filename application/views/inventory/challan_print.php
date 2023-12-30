<html lang="en">
<head>
    <title>Fabcart</title>
    <style>
        body{
            margin: 0;
            padding: 0;
        }
        h1,h2,h3,h4,h5,h6{
            margin: 0;
            padding: 0;
            text-align: center;
        }
        p{
            margin: 0;
            padding: 0;
        }
        .container{
            width: 100%;
            margin-right: auto;
            margin-left: auto;
            font-size: 14px;
        }
        .brand-section{
           padding: 10px 40px;
        }
        .logo{
            width: 50%;
        }

        .row{
            display: flex;
            flex-wrap: wrap;
        }
        .col-6{
            width: 50%;
            flex: 0 0 auto;
        }
        .text-white{
            color: #fff;
        }
        .company-details{
            float: right;
            text-align: right;
        }
        .body-section{
            padding: 16px;
            border: 1px solid gray;
        }
        .heading{
            font-size: 20px;
            margin-bottom: 08px;
        }
        .sub-heading{
            color: #262626;
            margin-bottom: 05px;
        }
        table{
            background-color: #fff;
            width: 100%;
            border-collapse: collapse;
        }
        table thead tr{
            border: 1px solid #111;
            background-color: #f2f2f2;
            text-align: center;
        }
        table td {
            vertical-align: middle !important;
            text-align: center;
        }
        table th, table td {
            padding-top: 08px;
            padding-bottom: 08px;
        }
        .table-bordered{
            box-shadow: 0px 0px 5px 0.5px gray;
        }
        .table-bordered td, .table-bordered th {
            border: 1px solid #dee2e6;
        }
        .text-right{
            text-align: right;
        }
        .w-20{
            width: 20%;
        }
        .float-right{
            float: right;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="brand-section">
        <h3><strong>DELIVERY CHALLAN</strong></h3>
        <br>
            <div class="row">
                <div>
                    <p ><strong>ABARNA COLOURS</strong></p>
                      <p>assdad asd  asda asdad a sd</p>
                        <p>assdad asd asd</p>
                        <p>+91 888555XXXX</p>
                </div>
                <div>
                        <p class="company-details">Invoice No.: CDEL000<?php echo $dc_no ?></p>
                        <br>
                        <p class="company-details">Delivery Date: <?php echo $dc_date ?> </p>
                        <br>
                        <p class="company-details"><?php echo $billing ?></p>
                        <br>
                        <p class="company-details">GST NO: <?php echo $gst ?></p>
                    
                </div>
            </div>
        </div>
<br>
        <div class="body-section">
            <table class="table-bordered">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th class="w-20">Box</th>
                        <th class="w-20">Quantity</th>
                        <th class="w-20">Weight</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php foreach ($products as $po_no => $product) { ?>
                                    PO. NO: ( <?php echo $po_no ?> )
                                    <?php foreach ($product as $item) { ?>
                                        <?php echo $item["product_name"] ?>
                                    <?php } ?>
                                <?php } ?></td>
                        <td><?php
                                $total_boxes = 0;
                                foreach ($products as $po_no => $product) { ?>
                                 
                                    <?php foreach ($product as $item) {
                                        $total_boxes += $item["num_of_boxes"];
                                    ?>
                                        <?php echo $item["num_of_boxes"] ?>
                                <?php
                                    }
                                }
                                ?></td>
                        <td><?php
                                $total_qty = 0;
                                foreach ($products as $po_no => $product) { ?>
                                    
                                    <?php
                                    foreach ($product as $item) {
                                        $total_qty += $item["box_qty"];
                                    ?>
                                        <?php echo $item["box_qty"] ?>
                                <?php
                                    }
                                }
                                ?></td>
                        <td>	 <?php 
                                    $total_weight = 0;
                                    foreach($products as $po_no => $product) { ?>
                                       
                                        <?php                                         
                                        foreach($product as $item) { 
                                            $total_weight += $item["box_weight"];
                                            ?>
                                                <?php echo $item["box_weight"] ?>
                                            <?php 
                                        } 
                                    } 
                                    ?></td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-right" >Total Box</td>
                        <td> <?php echo $total_boxes; ?></td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-right">Total Qty</td>
                        <td> <?php echo $total_qty; ?></td>
                    </tr>
                    <tr>
                        <td colspan="3" class="text-right">Total Weight</td>
                        <td><?php echo $total_weight; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="body-section">
            <p>This is a system Generated DC for Abarna Colours 2022. All rights reserved. 
              
        </div>      
    </div>      

</body>
</html>