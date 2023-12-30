<div class="row align-items-center">
    <div class="col-sm-6">
        <div class="page-title-box">
            <h4 class="font-size-18">Orders</h4>
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="javascript: void(0);">Manage Orders</a></li>
                <li class="breadcrumb-item active">Orders</li>
            </ol>
        </div>
    </div>

    <div class="col-sm-6">
        <div class="float-right d-none d-md-block">
            <input type="button" id="btnExporttoExcel" class="btn btn-primary waves-effect waves-light" value="Export To Excel" />
            <a class="btn btn-primary waves-effect waves-light" href="<?php echo base_url(); ?>seller/orders/manage_orders/add">
                Add Orders
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
unset($_SESSION['alert_success']);
unset($_SESSION['alert_danger']);
unset($_SESSION['alert_warning']);

?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table id="dmstable" class="table table-striped table-bordered dt-responsive nowrap table2excel table2excel_with_colors" data-tableName="Test Table 3" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>S.NO</th>
                            <th>ORDER ID</th>
                            <th>AMOUNT</th>
                            <th>CUSTOMER</th>
                            <th>COMPANY NAME</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($data as $d) {
                        ?>
                            <tr>
                                <td><?php echo $i++; ?> </td>
                                <td><?php echo $d->order_id; ?> </td>
                                <td><?php echo number_format($d->order_amount,  2); ?></td>
                                <td><?php echo $d->name; ?></td>
                                <td><?php echo $d->company_name; ?></td>
                                 <td>
                                    <a class="btn btn-warning btn-sm" href="<?php echo base_url(); ?>seller/orders/manage_orders/view/<?php echo base64_encode($this->encryption->encrypt($d->order_id)); ?>" title="View">
                                        <i class="far fa-eye"></i>
                                    </a> &nbsp;

                                    <!--<a class="btn btn-primary btn-sm" href="<?php echo base_url(); ?>seller/orders/manage_orders/edit/<?php echo base64_encode($this->encryption->encrypt($d->id)); ?>" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a> &nbsp;-->
                                </td> 
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    // datatable_init('<?php echo base_url(); ?>', '<?php echo $datatable; ?>', [{
    //         "data": "ids",
    //     },
    //     {
    //         "data": "name",
    //         "render": function(data) {
    //             if (data === null) {
    //                 return "Admin"
    //             } else {
    //                 return data
    //             }
    //         }
    //     },
    //     {
    //         "data": "total"
    //     },
    //     {
    //         "data": "branch_name"
    //     },

    //     {
    //         "data": "mobile"
    //     },
    //     {
    //         "data": "payment_mode",
    //         "render": function(data) {
    //             if (data === "1") {
    //                 return "Cash"
    //             } else if (data === "2") {
    //                 return "Online"
    //             }


    //         }
    //     },
    //     {
    //         "data": "remarks",
    //         "render": function(data) {
    //             if (data === "App Order" || data === "App") {
    //                 return "App"
    //             } else {
    //                 return "Web"
    //             }


    //         }
    //     },
    //     {
    //         "data": "o_created_date"
    //     },

    //     {
    //         "data": "order_status",
    //         "render": function(data) {
    //             if (data === "1") {
    //                 return "New"
    //             } else if (data === "2") {
    //                 return "Out of delivery"
    //             } else if (data === "3") {
    //                 return "Delivered"
    //             }

    //         }
    //     },

    //     {
    //         "data": "action"
    //     }
    // ]);

    function delete_item(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then(isConfirmed => {
            if (isConfirmed.value) {
                $.ajax({
                    url: "<?php echo base_url(); ?>seller/orders/manage_orders/delete/" + id + "/",
                    success: function(result) {
                        if (result) {
                            window.location('orders/manage_orders/');
                        }
                    }
                });

                if (isConfirmed.value) {
                    Swal.fire(
                        'Deleted!',
                        'Order has been deleted.',
                        'success'
                    );
                    $('#dmstable').DataTable().ajax.reload();
                }
            }
        });
    }
</script>


<script src="<?php echo base_url(); ?>assets/js/table2excel.js" type="text/javascript"></script>
<script type="text/javascript">
    $(function() {
        $('#dmstable').DataTable();
        $("#btnExporttoExcel").click(function() {
            $("#dmstable").table2excel({
                filename: "Orderdetails.xls"
            });
        });
    });
</script>