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
            <input type="button" id="btnExporttoExcel" class="btn btn-primary waves-effect waves-light"
                value="Export To Excel" />
            <!-- <a class="btn btn-primary waves-effect waves-light"
                href="<?php echo base_url(); ?>seller/orders/manage_orders/add">
                Add Orders
            </a> -->
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
?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <table id="dmstable"
                    class="table table-striped table-bordered dt-responsive nowrap table2excel table2excel_with_colors"
                    data-tableName="Test Table 3" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>ORD ID</th>
                            <th>CUSTOMER</th>
                            <th>AMOUNT</th>
                            

                            <th>CONTACT</th>
                            <th>MODE</th>
                            <th>ORD BY</th>
                            <th>ORDER DATE</th>
                            <th>STATUS</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
$get_company_id = $this->mcommon->specific_row_value('users', array('user_id' => $this->auth_user_id), 'company_id');
$order_number = $this->mcommon->specific_row_value('em_companies', array('id' => $get_company_id), 'ord_str_num');
$i = 1;foreach ($data as $d) {
    $ord = $order_number . '' . $i;?>
                        <tr>

                            <td><?php echo $ord; ?> </td>
                            <td><?php
if ($d->name === null) {
        echo "Admin";
    } else {
        echo $d->name;
    }?></td>
                            <td><?php echo $d->total; ?></td>
                           

                            <td><?php echo $d->mobile; ?></td>
                            <td><?php
if ($d->payment_mode === "cash") {
        echo "Cash";
    } else if ($d->payment_mode === "online") {
        echo "Online";
    }?></td>
                            <td><?php
if ($d->remarks == "App Order" || $d->remarks == "App") {
        echo "App";
    } else {
        echo "Web";
    }?></td>
                            <td><?php echo $d->o_created_date; ?></td>
                            <td><?php if ($d->order_status == "1") {
        echo "New";
    } else if ($d->order_status == "2") {
        echo "Out of delivery";
    } else if ($d->order_status == "3") {
        echo "Delivered";
    }
    ?></td>
                            <td>
                                <a class="btn btn-warning btn-sm"
                                    href="<?php echo base_url(); ?>seller/orders/manage_orders/view/<?php echo base64_encode($this->encryption->encrypt($d->id)); ?>"
                                    title="View">
                                    <i class="far fa-eye"></i>
                                </a> &nbsp;

                                <a class="btn btn-primary btn-sm"
                                    href="<?php echo base_url(); ?>seller/orders/manage_orders/edit/<?php echo base64_encode($this->encryption->encrypt($d->id)); ?>"
                                    title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a> &nbsp;
                            </td>

                        </tr>
                        <?php $i++;}?>
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