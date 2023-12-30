//const base_url = "http://abarna.epizy.com/abarna-v1";
const base_url = "http://erpprojects.great-site.net/erp_new/";

let customer_data = [];

$('#name_exist').hide();

function onCheckRawMaterialName(value) {
    $.post(`/abarnacolors/ajax/check_raw_material_name?name=${value}`, (data) => {
        data = JSON.parse(data);
        if (data.result) {
            $('#name_exist').show();
            $('#name_exist_input').addClass('invalid');
        } else {
            $('#name_exist').hide();
            $('#name_exist_input').removeClass('invalid');
        }
    })
}

function lengthI2M(value) {
    $("#lmm").val((value * 25.4).toFixed(2));
}

function breadthI2M(value) {
    $("#bmm").val((value * 25.4).toFixed(2));
}

function onChangeFrontSide(element) {
    if (element.checked) $('#front_side').show()
    else $('#front_side').hide()
}

function onChangeBackSide(element) {
    if (element.checked) $('#back_side,#back_side_stage').show()
    else $('#back_side,#back_side_stage').hide()
}
function onChangeBackSideWorkOrder(element) {
    if (element.checked) $('#back_material_div,#back_board_div').show()
    else $('#back_material_div,#back_board_div').hide()
}


$(document).ready(function(){

    if($("#is_front").attr("checked")) $('#front_side').show();
    if($("#is_back").attr("checked")) $('#back_side').show();

    for(let select of document.querySelectorAll('select')){
        for(let option of select.querySelectorAll('option')){
            if(select.getAttribute('value') == option.getAttribute('value')) option.selected = true;
        }         
    }

    // $("#photo").on("change", function(e){
    //     console.log(e.target.value);
    //     $("#preview").attr("src", e.target.value);
    // })

    $(document).on('show.bs.modal', function (e) {
        let form = $(e.target).find("form");    
        $(e.relatedTarget).each(function() {
            $.each(this.attributes, function() {
                if(this.name.match(/data-hidden-*/g)){
                    const column = this.name.replace(/data-hidden-*/g, '') || '';
                    const value = this.value || '';                        

                    console.log(column, value);

                    // if(!$(form).children('[name="'+column+'"]').length){
                        $(form).children('[name="'+column+'"]').remove();
                        $(form).append('<input type="hidden" name="'+column+'" value="'+value+'"/>');
                    // }
                }
            });
        });
        let table_refresh = $(e.relatedTarget).data('table-refresh') || false;                
        $(form).attr("table_refresh", table_refresh);
     });

    let loader = $(".loader") || false;
    if(loader) loader.hide();    
    for(let form of $(".ajax-form")){
        $(form).submit(function(e){
            e.preventDefault();
            let modal = $(form).parents('[role="dialog"]');
            let url = e.target.getAttribute('ajax-url') || '';
            if(loader) loader.show();            
            $(modal).find(".errors").hide();
            $.ajax({
                url: base_url+url,
                type: "POST",
                data: $(e.target).serialize(),
                success: function (response) {
                    const {state, error, data, msg} = JSON.parse(response);                    
                    if(error == false){
                        if($(modal)){
                            $(modal).removeClass("show");
                            $('.modal-backdrop').removeClass("show");
                            if(loader) loader.hide();
                            $(modal).find(".errors").show();
                            if($(form).attr("table_refresh")) window.location.reload();
                        }
                    }else{
                        if($(modal)){
                            let error_string = "";
                            for(key in data){
                                error_string += data[key] + "<br>"
                            }
                            if(loader) loader.hide();
                            $(modal).find(".errors").show();
                            $(modal).find(".errors").html(error_string);                            
                        }
                    }
                },
                error: function (error) {
                    $(modal).find(".errors").text(error.message);
                    $(modal).find(".errors").show();
                    if(loader) loader.hide();
                }
            })
        })
    }

    $(document).on('click', 'input[name="loading[]"]', function(e) {
        let open = true;
        for(e of $('input[name="loading[]"]:visible')){
            if(e.checked == false){
                open = false;
            }
        }
        if(open){
            $("#update-btn").show();
        }else{
            $("#update-btn").hide();
        }

    })

    // DataTable
    var table = $('#loading-table').DataTable({
        "oLanguage": {
            "sSearch": "Search DC NO: "
        }
    });

    $('input[type="search"]').on( 'keyup', function () {
        console.log("working");
        table
            .columns(1)
            .search( this.value )
            .draw();
    } );
    $("#extra_qty").on('keypress change blur',function(){
        var tot_qty = $(this).val();
        if($('#prd_qty').val() == '' || $('#prd_qty').val() == 0){
                            var totalPending = parseFloat(tot_qty);
                            $('#tot_qty').val(totalPending);
                             if($('#ups_rnng_board').val() == '' || $('#ups_rnng_board').val() == 0){
                                var totalboard = parseFloat(totalPending);
                                $('#tot_brd_req').val(totalboard);
                                 $('#back_board_qty,#front_board_qty').val(Math.ceil(totalboard));
                            }else{
                                var totalboard = parseFloat(totalPending)/parseFloat($('#ups_rnng_board').val());
                                $('#tot_brd_req').val(totalboard);
                                 $('#back_board_qty,#front_board_qty').val(Math.ceil(totalboard));
                            }
                        }else{
        var totalPending = parseFloat($('#prd_qty').val())+parseFloat(tot_qty);
            $('#tot_qty').val(totalPending);
             if($('#ups_rnng_board').val() == '' || $('#ups_rnng_board').val() == 0){
                                var totalboard = parseFloat(totalPending);
                                $('#tot_brd_req').val(totalboard);
                                 $('#back_board_qty,#front_board_qty').val(Math.ceil(totalboard));
                            }else{
                                console.log('test');
                                console.log(totalPending);
                                console.log($('#ups_rnng_board').val());
                                var totalboard = parseFloat(totalPending)/parseFloat($('#ups_rnng_board').val());
                                $('#tot_brd_req').val(totalboard);
                                 $('#back_board_qty,#front_board_qty').val(Math.ceil(totalboard));
                            }
                        }
    })

})

function changeCustomer(id) {
    $.ajax({
        url: base_url+'/ajax/getCustomerDetails',
        type: "POST",
        data: {id: id},
        success: function (res) {
            res = JSON.parse(res);
            var customer_data1 = res.data;
           
            $.each(customer_data1, function(key, value) { 
                let comapny_address = `${value.address1},\r\n${value.address2},\r\n${value.city},\r\n${value.district},\r\n${value.state},\r\n${value.country},\r\n${value.pincode}`; 
                console.log(comapny_address);
                if(value.address_type == "Billing Address"){
                    $("#billing").val(comapny_address);
                }else if(value.address_type == "Shipping Address"){
                    $("#shipping").val(comapny_address);
                }
            });
            // $("#address1").show();
            // $("#address2").show();
            // $("#choose_address").addClass("mt-3");
        },
        error: function (error) {
            console.log("Ajax Error: ", error.message);
            $("#address1").hide();
            $("#address2").hide();
            $("#choose_address").removeClass("mt-3");
        }
    });
}
function changeBillingAddress(address) {
    if(address == "billing_address") {
        const { customer_primaryaddress, customer_areaprimary, customer_districtprimary, customer_stateprimary, customer_pincodeprimary } = customer_data;
        let value = `${customer_primaryaddress},\r\n${ customer_areaprimary},\r\n${ customer_districtprimary},\r\n${ customer_stateprimary},\r\n${ customer_pincodeprimary}`; 
        $("#billing").val(value);
    }

    if(address == "shipping_address") {
        const { customer_secaddress, customer_areasec, customer_districtsec, customer_countrysec, customer_statesec, customer_pincodesec } = customer_data;
        let value = `${customer_secaddress},\r\n${customer_areasec},\r\n${customer_districtsec},\r\n${customer_countrysec},\r\n${customer_statesec},\r\n${customer_pincodesec}`;
        $("#billing").val(value);
    }
}

function changeShippingAddress(address) {
    if(address == "billing_address") {
        const { customer_primaryaddress, customer_areaprimary, customer_districtprimary, customer_stateprimary, customer_pincodeprimary } = customer_data;
        let value = `${customer_primaryaddress},\r\n${customer_areaprimary},\r\n${customer_districtprimary},\r\n${customer_stateprimary},\r\n${customer_pincodeprimary}`; 
        $("#shipping").val(value);
    }

    if(address == "shipping_address") {
        const { customer_secaddress, customer_areasec, customer_districtsec, customer_countrysec, customer_statesec, customer_pincodesec } = customer_data;
        let value = `${customer_secaddress},\r\n${customer_areasec},\r\n${customer_districtsec},\r\n${customer_countrysec},\r\n${customer_statesec},\r\n${customer_pincodesec}`;
        $("#shipping").val(value); 
    }
}

function changeWorkCustomer(id) {
    // console.log(id)
    $.ajax({
        url: base_url+'/ajax/getWorkLoadDetails',
        type: "POST",
        data: {id: id},
        success: function (res) {
            res = JSON.parse(res);
            $('#workLoadData').html("");
            var tableval = "";
            var totalPending = 0;
            // var po_no = '';
            $.each(res , function(index, value) {
                if (value.accepting_date == '' || value.accepting_date == null) {
                        var accepting_date = "";
                    } else {
                        var accepting_date = value.accepting_date;
                    }
                    if (value.po_qty == '' || value.po_qty == null) {
                        var po_qty = "";
                    } else {
                        var po_qty = value.po_qty;
                    }
                    if (value.stock_qty == '' || value.stock_qty == null) {
                        var stock_qty = "";
                    } else {
                        var stock_qty = value.stock_qty;
                    }
                    if (value.pending_qty == '' || value.pending_qty == null) {
                        var pending_qty = "";
                    } else {
                        var pending_qty = value.pending_qty;
                    }
                    $('#workLoad_customer_id').val(value.customer);
                    $('#work_order_customer_name').val(value.customer_name);
            tableval += "<tr><td>" + value.id + "</td><td>" + value.po_no + "</td><td>" + value.product_name + "</td><td>" + accepting_date + "</td><td>" + po_qty + "</td><td>" + stock_qty + "</td><td>" + pending_qty + "</td><td><input type='checkbox' class='ponodatacheck' name='povalues[]' value=" + value.po_no + "></td></tr>";
            totalPending += parseFloat(po_qty);
            });
            if(totalPending == 0){
                $('#work_order_submit').attr('disabled',true);
            }else{
                $('#work_order_submit').attr('disabled',false);
            }            
            $('#prd_qty,#tot_qty').val(totalPending);
            $('#workLoadData').html(tableval); 
            $('#workLoadData_div').show(1000);           
        },
        error: function (error) {

            console.log("Ajax Error: ", error.message);
            // $("#address1").hide();
            // $("#address2").hide();
            // $("#choose_address").removeClass("mt-3");
        }
    });
    $("#workLoad_customer").val($('#workLoad_product_id').find(':selected').data('buyer'))
    $("#front_product_id").val($('#workLoad_product_id').find(':selected').data('front_product'))
    $("#front_product_name").val($('#workLoad_product_id').find(':selected').data('front_productname'))
    $("#back_product_id").val($('#workLoad_product_id').find(':selected').data('back_product'))
    $("#back_product_name").val($('#workLoad_product_id').find(':selected').data('back_productname'))
}