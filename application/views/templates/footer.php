    <style>


    .footer {
        position: relative;
        display: flex;
        background-color: #228b22;
        padding: 0px;
        text-align: right;
        //margin-top: auto;
        margin-bottom: 0;
        }
    </style>
<footer class="footer exclude-print">
    <div class="container">
        <div class="row">
            <p class="text-left"> Privacy Policy &nbsp; &nbsp; &nbsp; AGB &nbsp; &nbsp; &nbsp; imprints &nbsp; &nbsp; &nbsp; &copy; <?php echo date('Y'); ?> Punarbhava sustainable products. All rights reserved.</p>
        </div>
    </div>
</footer>

<!-- END: Footer-->
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/app-assets/js/core/custom.js"></script>
<!-- BEGIN: Vendor JS-->
<script src="<?php echo base_url();?>assets/app-assets/vendors/js/vendors.min.js"></script>

<script src="<?php echo base_url();?>assets/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.min.js"></script>
<script src="<?php echo base_url();?>assets/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.min.js"></script>
<script src="<?php echo base_url();?>assets/app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js"></script>
<!-- BEGIN Vendor JS-->
<!-- BEGIN: Page Vendor JS-->
<script src="<?php echo base_url();?>assets/app-assets/vendors/js/ui/jquery.sticky.js"></script>
<!-- <script src="<?php echo base_url();?>assets/app-assets/vendors/js/charts/apexcharts.min.js"></script> -->
<script src="<?php echo base_url();?>assets/app-assets/vendors/js/extensions/dragula.min.js"></script>
<!-- END: Page Vendor JS-->
<!-- BEGIN: Theme JS-->
<script src="<?php echo base_url();?>assets/app-assets/js/scripts/configs/horizontal-menu.min.js"></script>
<script src="<?php echo base_url();?>assets/app-assets/js/core/app-menu.min.js"></script>
<script src="<?php echo base_url();?>assets/app-assets/js/core/app.min.js"></script>
<script src="<?php echo base_url();?>assets/app-assets/js/scripts/components.min.js"></script>
<script src="<?php echo base_url();?>assets/app-assets/js/scripts/footer.min.js"></script>
<script src="<?php echo base_url();?>assets/app-assets/js/scripts/customizer.min.js"></script>
<!-- END: Theme JS-->
<!-- BEGIN: Page JS-->
<!-- <script src="<?php echo base_url();?>assets/app-assets/js/scripts/pages/dashboard-analytics.min.js"></script> -->
<!-- END: Page JS -->
<script src="<?php echo base_url();?>assets/app-assets/vendors/js/ui/jquery.sticky.js"></script>
<script src="<?php echo base_url();?>assets/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url();?>assets/app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url();?>assets/app-assets/vendors/js/tables/datatable/buttons.html5.min.js"></script>
<script src="<?php echo base_url();?>assets/app-assets/vendors/js/tables/datatable/buttons.print.min.js"></script>
<script src="<?php echo base_url();?>assets/app-assets/vendors/js/tables/datatable/buttons.bootstrap4.min.js"></script>
<script src="<?php echo base_url();?>assets/app-assets/vendors/js/tables/datatable/pdfmake.min.js"></script>
<script src="<?php echo base_url();?>assets/app-assets/vendors/js/tables/datatable/vfs_fonts.js"></script>
<script src="<?php echo base_url();?>assets/app-assets/js/scripts/datatables/datatable.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.9/js/select2.min.js"></script> 

<script src="<?php echo base_url(); ?>assets/app-assets/js/core/sweetalert.js"></script>

<script>
	  $(document).ready(function() {
        $('select').select2();
    });
</script>
<?php
    if($this->uri->segment(2) == 'sales_order_create'){ ?>
        <script type="text/javascript">

            // Validation
            $(document).ready(function () {
                $("#product_id").select2();
                let item = $('.item.main') || null; 
            
                $('.submit').click(function (e) {
                    e.preventDefault();
                    $("#registerForm").submit();
                    // console.log($('.file').get(0).files);
                    // console.log($('.file').get(0).files.length);
                    // if( $('.file').val() == ''){
                    //     alert("Please select at least one file.");
                    //     return false;
                    // } else {
                    //   $("#registerForm").submit();
                    // }
                });
            
                // Append new row
                var cnt = 0;
                $(document).on('click', ".add", function (e) {
                    e.preventDefault();
                    cnt++;
                    console.log(cnt); 
                    var items = '<div class="item main"><div class="row mt-2"><div class="col-md-3">                                            <label for="product_id">Product Name</label><select id="product_id_' + cnt + '" class="form-control productName_select" required="required" name="products[product_id][]"><option value="">Select Product </option><?php foreach ($data2 as $row) { ?><option data-id="' + cnt + '" value="<?php echo $row->id; ?>"><?php echo str_replace("'","",$row->name); ?></option><?php } ?></select></div><div class="col-md-3"><label for="po_qty">PO Qty</label><input id="po_qty" type="text" required="required" name="products[po_qty][]" placeholder="Enter PO.Qty" class="form-control qty" value=""></div><div class="col-md-3"><label for="accepting_date">Accepting Date</label><input id="accepting_date" type="date" required="required" name="products[accepting_date][]" placeholder="Enter accepted Date" class="form-control"></div><div class="col-md-3"><label for="rate">Rate</label><input id="rate" type="text" required="required" name="products[rate][]" value="" placeholder="Enter Rate" class="form-control"></div></div><div class="row mt-2"><div class="col-md-3"><label for="front_image">Front Image</label><input id="front_image" class="file" name="products[front_image][]" type="file"></div><div class="col-md-3"><label for="back_image">Back Image</label><input id="back_image" class="file" name="products[back_image][]" type="file"></div><div class="col-md-3"><label for="other_image">other Image</label><input id="other_image" class="file" name="products[other_image][]" type="file"></div><div class="col-md-3"><a class="pull-right btn btn-danger remove">Delete Row</a></div></div></div>';
                    // $('.item-wrap').append('<div class="item main">' + $(item).html() + '<div>');
                    $('.item-wrap').append(items);
                    $("#product_id_" + cnt + "").select2();
                });
            
                // Delete row
                $(document).on('click', ".remove", function (e) {
                    e.preventDefault();
                    if (!confirm("Are you sure you want to delete this file?"))
                        return false;
                    console.log($(e.target).closest('.item'));
                    $(e.target).closest('.item').remove();
                });
            });

            $('#files').change(function (event) {
                var tmppath = URL.createObjectURL(event.target.files[0]);
                //$(".view_img").fadeIn("fast").attr('src',URL.createObjectURL(event.target.files[0]));
            
                $("#disp_tmp_path").html("<a href=" + tmppath + ">view image</a>");
            });
        </script><?php
    }
    
    if($this->uri->segment(2) == 'sales_order_show'){ ?>
        <script type="text/javascript">
            // $(".del_model_btn").on("click", function () {
            //     var prodid = $(this).data('hidden-product_id');
            //     var po_no = $(this).data('po_no');
            //     var order_qty = $(this).data('order_qty');
            //     var pending_qty = $(this).data('pending_qty');
            //     var so_id = $(this).data('so_id');
            //     var tablerefresh = $(this).data('table-refresh');
            //     var product_name = $(this).data('product_name');
            //     console.log("po_no",po_no);
            //     console.log("product_name",product_name);
            //     console.log("order_qty",order_qty);
            //     console.log("pending_qty",pending_qty);
            
            //     $("#po_nos").text(po_no);
            //     $("#product_names").text(product_name);
            //     $("#po_qtys").text(order_qty);
            //     $("#pending_qtys").text(pending_qty);
            // });
        </script><?php
    }
    
    if($this->uri->segment(2) == 'work_order_create'){ ?>
        <script>
            $(document).ready(function () {

            });
        </script><?php
    }
    
    if($this->uri->segment(2) == 'work_order_material_issue'){ ?>
        <script>
            $(document).ready(function () {
                
            });
        </script><?php
    }

	if ($this->uri->segment(1) == 'orders' || $this->uri->segment(1) == 'groupProducts') { ?>
		<script type="text/javascript">
			function showCartItems() {
				const cartItemsContainer = $('#cartItems');
				cartItemsContainer.empty(); 
				$.ajax({
					url: "<?php echo site_url() ?>sales/orders/get_cartData",
					method: "GET",
					type: "ajax",
					success: function(result) {
						let data = JSON.parse(result);
						data.forEach(item => {
							var price_data = '';
							if (item.slash_price) {
								price_data = '<del>' + item.price + '</del>  <ins>' + item.slash_price + '</ins>';
							} else {
								price_data = '<ins>' + item.price + '</ins>';
							}
							const listItem = `
											<li class="list-group-item " >
												<img src="<?php echo base_url('attachments/products/'); ?>${item.image}" alt="${item.variation_name}" style="width: 50px; height: 50px; margin-right: 10px; float: left;">

												<strong>${item.variation_name}</strong><br>
												Quantity: ${item.qty}<br>
												Price: ${price_data}
												<br>
												<div class="float-right">
													<a onclick="removeCart(${item.cart_id})" class="btn btn-danger"><i class="ficon bx bx-trash"></i></a>
												</div>
											</li>
										`;
							cartItemsContainer.append(listItem);
						});
					},
					error: function(error) {
						console.log(error);
					}
				});
			}

			
			$('#cartModal').on('show.bs.modal', showCartItems);

			function removeCart(cart_id) {
				$.ajax({
					url: "<?php echo site_url() ?>sales/orders/removeCart",
					method: "POST",
					type: "ajax",
					data: {
						cart_id: cart_id
					},
					success: function(result) {
						if (result > 0) {
							Swal.fire(
								'',
								'Product Removed in Cart successfully ',
								'success'
							)
						} else {
							Swal.fire({
								icon: 'error',
								title: 'Oops...',
								text: 'Something went wrong!',
							})
						}
						showCartItems();

					},
					error: function(error) {
						console.log(error);
					}
				});
			}
			$(function() {
				loadProducts(); //Default load products without filters
			});
				
			$('#brand_id').on('change', function() {
				var brand_id = $(this).val();
				if (brand_id) {
					$.ajax({
						url: "<?php echo site_url('/sales/orders/get_category'); ?>",
						type: "post",
						dataType: "json",
						data: {
							brand_id: brand_id
						},
						success: function(data) {
							let options = "<option value=''>Select Category</option>";

							$.each(data, function(key, value) {
								options += '<option value="' + value.id + '">' + value.category_name + '</option>';
								$('#category_id').empty().append(options);
							});
						}
					});
				} else {
					$('#category_id').empty();
				}
			});
			$('#category_id').on('change', function() {

				var category_id = $(this).val();
				if (category_id) {
					$.ajax({
						url: "<?php echo site_url('/sales/orders/get_subcategory'); ?>",
						type: "post",
						dataType: "json",
						data: {
							category_id: category_id
						},
						success: function(data) {

							let options = "<option value=''>Select Sub Category</option>";
							$.each(data, function(key, value) {
								options += '<option value="' + value.id + '">' + value.sub_category_name + '</option>';
								$('#subcategory_id').empty().append(options);
							});
						}
					});
				} else {
					$('#subcategory_id').empty();
				}
			});
			$('#subcategory_id').on('change', function() {
				var sub_category_id = $(this).val();
				if (sub_category_id) {
					$.ajax({
						url: "<?php echo site_url('/sales/orders/get_attributes'); ?>",
						type: "post",
						dataType: "json",
						data: {
							sub_category_id: sub_category_id
						},
						success: function(data) {
							let options = "<option value=''>Select Attribute Name</option>";
							$.each(data, function(key, value) {
								options += '<option value="' + value.id + '">' + value.attributes_name + '</option>';
								$('#attribute_id').empty().append(options);
							});
						},
						err: function(err) {
							console.log(err);
						}
					});
				} else {
					$('#attribute_id').empty();
				}
			});
			$('#attribute_id').on('change', function() {
				var attribute_id = parseInt($(this).val());
				if (attribute_id) {
					$.ajax({
						url: "<?php echo site_url('/sales/orders/get_product_attributes_value'); ?>",
						type: "post",
						dataType: "json",
						data: {
							attribute_id: attribute_id
						},
						success: function(data) {
							let options = "<option value=''>Select Attribute Name</option>";
							$.each(data, function(key, value) {
								options += '<option value="' + value.pro_details_id + '">' + value.attribute_value + '</option>';
								$('#attribute').empty().append(options);
							});
						},
						err: function(err) {
							console.log(err);
						}
					});
				} else {
					$('#attribute_id').empty();
				}
			});

			$('.select').on('change', function(e) {
			    loadProducts();
			});








    function loadProducts() {
    var brand_id = $('#brand_id').val();
    var category_id = $('#category_id').val();
    var subcategory_id = $('#subcategory_id').val();
    var group_product_ids = $('#group_product_ids').val();
    var attribute_id = $('#attribute_id').val();
    var attribute = $('#attribute').val();

    // Get the product image overlay element


    // Add an event listener for dropdown changes
   $('#brand_id, #category_id, #subcategory_id, #attribute_id, #attribute').on('change', function () {
        
    });



    // Get Products For Shopping page
    $.ajax({
        url: "<?php echo site_url() ?>sales/Orders/get_products",
        method: "POST",
        type: "ajax",
        data: {
            brand_id: brand_id,
            category_id: category_id,
            subcategory_id: subcategory_id,
            group_product_ids: group_product_ids,
            attribute: attribute,
        },
        success: function (result) {
            $("#shoplist").empty();
            let products = JSON.parse(result);
            if (products != '') {
                $.each(products, function (i, item) {
                    var price_data = attrData = '';
                    if (item.slash_price > 0) {
                        price_data = '' + item.price + '';
                    } else {
                        price_data = '<ins>' + item.price + '</ins>';
                    }

                    var attributeNameArray = item.attributes_name.split("|");
                    var attributeValueArray = item.attribute_value.split("|");

                    $.each(attributeNameArray, function (i1, item1) {
                        attrData += '<b>' + item1 + '</b>  ' + attributeValueArray[i1] + '<br>';
                    });

                    var downloadLink = `<a id="download_button_${i}" class="btn btn-success"  href="#" download="product_image_${i}.png">Download Image</a>`;

                    let body_content = `<div class="card text-black product imgc" id="product">
                         <img src="${item.image ? item.image : '<?php echo base_url('assets/images/no-image.png'); ?>'}" class="card-img" style="width: 200px; height: 200px;">

                        

                        <div class="col text-center">
                        <p class="card-text text-dark text-center" style="font-size: 20px; ">${item.product_name}</p>
                            <p class "card-text text-dark text-center">Price :${price_data}</p>
                            // <a onclick="addtocart(${item.pro_details_id})" class="btn btn-primary" style="width: 150px; height: 30px;">Add to Cart</a>
                            ${downloadLink}
                        </div>
                    </div>`;

                    $("#shoplist").append(body_content);
                    $(`#add_to_cart_button_${item.pro_details_id}`).on('click', function () {
                        
                        });

                    // Add an event listener for the download button
                    $(`#download_button_${i}`).on('click', function () {
                        // Update the overlay text in the downloaded image
                        var selectedValues = {
                            brand: $('#brand_id option:selected').text(),
                            category: $('#category_id option:selected').text(),
                            subcategory: $('#subcategory_id option:selected').text(),
                            attribute: $('#attribute_id option:selected').text() + ' - ' + $('#attribute option:selected').text(),
                        };

                        // Create a temporary canvas to draw the overlay text
                        var canvas = document.createElement('canvas');
                        var context = canvas.getContext('2d');

                        canvas.width = 250; // Set the width of your image
                        canvas.height = 300; // Set the height of your image

                        // Draw the image on the canvas
                        var img = new Image();
                        img.onload = function () {
                            context.drawImage(img, 0, 0, canvas.width, canvas.height);

                            // Draw the overlay text on the canvas
                            context.font = 'bold 14px Arial';
                            context.fillStyle = 'red';
                            var margin = 30;
                            var startX = margin;
                            var startY = margin + 40;

                            context.fillText(`Brand: ${selectedValues.brand}`, startX, startY + 20);
                            context.fillText(`Category: ${selectedValues.category}`, startX, startY + 40);
                            context.fillText(`Subcategory: ${selectedValues.subcategory}`, startX, startY + 60);
                            context.fillText(`Attribute: ${selectedValues.attribute}`, startX, startY + 80);

                            // Trigger the download
                            var link = document.createElement('a');
                            link.href = canvas.toDataURL();
                            link.download = `product_image_${i}.png`;
                            document.body.appendChild(link);
                            link.click();
                            document.body.removeChild(link);
                        };

                        img.src = item.image; // Assuming item.image contains the correct image source
                    });
                });

                //pagination concepts
                var pageSize = 1;
                var count = (products.length) / pageSize;
                n = Math.floor(count);
                var decimal = count - Math.floor(count);
                if (decimal) {
                    var add = '1';
                }
                var whole_number = Number(n) + Number(add);
                if (count > 0) {
                    $("#pagin").empty();

                    for (var i = 0; i < count; i++) {
                        $("#pagin").append('<li class="page-item"><a class="page-link">' + (i + 1) + '</a></li>');
                    }

                    $("#pagin li").first().find("a").addClass("current");
                    showPage = function (page) {
                        $(".product").hide();
                        $(".product").each(function (n) {
                            if (n >= pageSize * (page - 1) && n < pageSize * page)
                                $(this).show();
                        });
                    }

                    showPage(1);

                    $("#pagin li a").click(function () {
                        $("#pagin li a").removeClass("current");
                        $(this).addClass("current");
                        showPage(parseInt($(this).text()))
                    });
                }
                //pagination concepts
            } else {
                var body_content = $('<div class="col-md-12 col-sm-12"><img id="offer_image" class="" src="<?php echo base_url('assets/images/no_item_found.png'); ?>"  alt="img" /></div>');
                $("#shoplist").empty().append(body_content);
            }
        },
        error: function (error) {
            console.log(error);
        }
    });
    //Get Products For Shopping page
}



			




// function addtocart(variation_id) {

//     				$.ajax({
// 					url: "<?php echo site_url() ?>sales/Orders/addtocart",
// 					method: "POST",
// 					type: "ajax",
// 					data: {
// 						//customer_id: customer_id,
// 						variation_id: variation_id
// 					},
// 					success: function(result) {
// 						if (result > 0) {
// 							Swal.fire(
// 								'',
// 								'Product Added in Cart successfully ',
// 								'success'
// 							)
// 						}
// 					},
// 					error: function(error) {
// 						console.log(error);
// 					}
// 				});
//     // Fetch selected values from dropdowns
//     var group_product_name = $('#group_product_ids option:selected').text();
//     var subcategory_id = $('#subcategory_id option:selected').text();
//     var price_data = '';
        

//     // Incremental counter for S.No
//     var rowCount = $('#cartTableBody tr').length + 1;

//     // Create a new table row
//     var newRow = $('<tr>');
//     newRow.append('<td>' + rowCount + '</td>'); 
//     newRow.append('<td>' + group_product_name + '</td>'); 
//     newRow.append('<td>' + subcategory_id + '</td>');
//     newRow.append('<td>1</td>'); 
//     newRow.append('<td>' + price_data + '</td>'); 
//     newRow.append('<td><button class="btn btn-danger btn-sm" onclick="removeRow(this)">Remove</button></td>'); // Action

//     // Append the new row to the table
//     $('#cartTableBody').append(newRow);


// }

// Function to remove a row from the table
function removeRow(button) {
    $(button).closest('tr').remove();
}

			$('#btnPrint').click(function() {
				window.print();
			});
		</script>

		<script type="text/javascript">
			$('#delivery_charge').keyup(function() {
				if (!isNaN(this.value) && this.value.length != 0) {
					$('[name="grand_total"]').val(parseInt($("#total").val()) + (parseInt($("#delivery_charge").val())));
				} else {

					$("#delivery_charge").this.value = '0';
				}
			});
		</script>	
	<?php 
	}
	if($this->uri->segment(1) == 'checkout'){ 
		$CI =& get_instance();
		$sub_tot = $CI->sub_tot;
	?>
	<script type="text/javascript">
        function pay_now() {
            $("#loading").show();

            // Get the selected shipping address from the dropdown
            var selectedShippingAddress = $('#shipping_address').val();

            // Other variables...
            var order_amount = $('#total').val();
            var delivery_date = $('#delivery_date').val();
            var sgst = parseFloat($('#sgst').val()) || 0;
            var igst = parseFloat($('#igst').val()) || 0;
            var cgst = parseFloat($('#cgst').val()) || 0;
            var tax = $('#tax').val();
            var delivery_price = $('#delivery_price').val();
            var discount_price = $('#discount_price').val();
            var sub_total = <?php echo $sub_tot; ?>;
            var group_name = '<?php echo $cartdatas[0]->group_name; ?>';
            var product_name = '<?php echo $cartdatas[0]->product_name; ?>';

            $.ajax({
                url: "<?php echo site_url() ?>sales/orders/create_order",
                method: "POST",
                type: "ajax",
                data: {
                    order_amount: order_amount,
                    delivery_date: delivery_date,
                    sgst: sgst,
                    igst: igst,
                    cgst: cgst,
                    tax: tax,
                    delivery_price: delivery_price,
                    discount_price: discount_price,
                    sub_total: sub_total,
                    group_name: group_name,
                    product_name: product_name,
                    selectedShippingAddress: selectedShippingAddress  // Include the selected shipping address in the data
                },

                success: function(data) {
                    $("#loading").hide();
                    if (data) {
                        Swal.fire(
                            'Success!',
                            'Thank you for placing the Order with us',
                            'success'
                        ).then(function() {
                            window.location.href = '<?php echo base_url('/orders') ?>';
                        });
                    } else {
                        Swal.fire(
                            'Failed!',
                            'Verification Failed.',
                            'error'
                        );
                    }
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }



		$('.addprice').keyup(function() {

			var delivery_price = $('#delivery_price').val();
			var tax = $('#tax').val();
			var discount_price = $('#discount_price').val();


			var sub_tot = '<?php echo $sub_tot; ?>';
			var amount = Number(sub_tot);
			if (delivery_price) {
				amount += Number(delivery_price);
			}
			if (discount_price) {

				var discount_amount = (Number(sub_tot) * Number(discount_price)) / 100;

				amount -= discount_amount;
				$('#discount_price_text').text(discount_amount);
			}

			if (tax) {

				var tax_amount = (Number(sub_tot) * Number(tax)) / 100;

				amount += tax_amount;
				$('#tax_price_text').text(tax_amount);
			}

			$('#total').val(amount);
			$('#total_text').text(amount);

		});
		$(".addprice, .product-qty").keydown(function(e) {
			// Allow: backspace, delete, tab, escape, and enter
			if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
				// Allow: Ctrl+A
				(e.keyCode == 65 && e.ctrlKey === true) ||
				// Allow: Ctrl+C
				(e.keyCode == 67 && e.ctrlKey === true) ||
				// Allow: Ctrl+X
				(e.keyCode == 88 && e.ctrlKey === true) ||
				// Allow: home, end, left, right
				(e.keyCode >= 35 && e.keyCode <= 39)) {
				return;
			}
			
			if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
				e.preventDefault();
			}
		});
		$('.product-qty').keyup(function() {

			var qty = $(this).val();
			var cart_id = $(this).attr('data-cart_id');
			if (qty > 0) {
				$.ajax({
					url: "<?php echo site_url() ?>orders/update_cart",
					method: "POST",
					type: "ajax",
					async: false,
					data: {
						cart_id: cart_id,
						qty: qty,
					},
					success: function(data) {

						if (data) {
							Swal.fire(
								'Success!',
								'Cart Updated',
								'success'
							);
							location.reload();

						} else {
							Swal.fire(
								'Failed!',
								'Please try again later.',
								'error'
							);
						}

					},
					error: function(error) {
						console.log(error);
					}
				});
			}
		});
	</script>
    <?php } if($this->uri->segment(1) == 'product'){?>  
		<script type="text/javascript">
			$('#brand_id').on('change', function() {

				var brand_id = $(this).val();

				if (brand_id) {
					$.ajax({
						url: "<?php echo site_url('/product/get_category'); ?>",
						type: "post",
						data: {
							brand_id: brand_id
						},
						dataType: "json",
						success: function(data) {
							$('select[name="pgroup"]').empty();
							$("#pgroup").append("<option value=''>--Select--</option>");
							$.each(data, function(key, value) {
								$('select[name="pgroup"]').append('<option value="' + value.id + '">' + value.category_name + '</option>');
							});
						}
					});
				} else {
					$('select[name="pgroup"]').empty();
				}
			});
			$('#pgroup').on('change', function() {

				var category_id = $(this).val();

				if (category_id) {
					$.ajax({
						url: "<?php echo site_url('/product/get_subcategory'); ?>",
						type: "post",
						data: {
							category_id: category_id
						},
						dataType: "json",
						success: function(data) {
							$('select[name="pgroup_sub"]').empty();
							$("#pgroup_sub").append("<option value=''>--Select--</option>");
							$.each(data, function(key, value) {
								$('select[name="pgroup_sub"]').append('<option value="' + value.id + '">' + value.sub_category_name + '</option>');
							});
						}
					});
				} else {
					$('select[name="pgroup_sub"]').empty();
				}
			});
			$('select[name="pgroup_sub"]').on('change', function() {
				var sub_category_id = parseInt($(this).val());
				if (sub_category_id) {
					var variation_fields = ``;
					$.ajax({
						url: "<?php echo site_url('/product/get_attributes'); ?>",
						type: "post",
						data: {
							sub_category_id: sub_category_id
						},
						dataType: "json",
						success: function(data) {
							$('#variation_fields').empty();
							$('#hidden_attributes').empty();

							$.each(data, function(key, value) {
								variation_fields += `<div class="col-md-3 col-lg-3">
													<label class="required">${value.attributes_name}</label>
													<input name="${value.id}[]" id="${value.id}" type="text" class="form-control " placeholder="Enter ${value.attributes_name}">
											</div>`;
							});
							$('#variation_fields').append(variation_fields);
							$('#hidden_attributes').append(variation_fields);
						},
						err: function(err) {
							console.log(err);
						}
					});
				} else {
					$('#variation_fields').empty();
				}
			});
		</script>
		<script>
			$('.max').each(function() {
				var $wrapper = $('.fields', this);
				$(".add-field", $(this)).click(function(e) {
					var count = $('.field').length;

					var get_hidden_attributes = $('#hidden_attributes').html();
					var append_data = `<div class="field col-md-12">
										<div class="row">
											<div class="col-md-3 col-lg-3">
												<label class="required">Variation Name</label>
												<input name="variation_name[]" id="variation_name" type="text" class="form-control variation_name" placeholder="Enter Variation Name">
											</div>
											<div class="col-md-3 col-lg-2">
												<label class="required">Stock</label>
												<input name="product_qty[]" id="product_qty" type="text" class="form-control product_qty" placeholder="Enter Stock">
											</div>
											<div class="col-md-3 col-lg-2">
												<label class="required">Price</label>
												<input name="product_price[]" id="product_price" type="text" class="form-control product_price" placeholder="Enter Price">
											</div>
											<div class="col-md-3 col-lg-2">
												<label class="required">Discount Price</label>
												<input name="slash_price[]" id="slash_price" type="text" class="form-control slash_price" placeholder="Discount Price">
											</div>
											<div class="col-md-3 col-lg-3">
												<label>Product Image</label>
												<input name="photo[]" id="photo" type="file" class="form-control" placeholder="Image" multiple>
											</div>
										</div>
										<div class="row" id="variation_fields">
											${get_hidden_attributes}
										</div>
									</div>`;
					$wrapper.append(append_data);
				});
				$('.remove-field', $(this)).click(function() {

					if ($('.field').length > 1)
						$('.field').last().remove();
				});
			});
		</script>
	<?php } ?>    

<style type="text/css">
    .required:after {
        content: " *" !important;
        color: red !important;
    }

      @media (min-width: 768px) {
    .imgc {
      display: flex;
      justify-content: center;
      align-items: center;
      margin: 0 auto;
    }
  }

  @media (max-width: 767px) {
    .imgc {
      text-align: center;
      margin: 0 auto;
    }
  }
</style>
<!-- END: Body-->
