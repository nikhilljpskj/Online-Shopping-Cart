<style>
    #product {
        width: 14rem;
    }

    .product {
        box-shadow: 1px 6px 20px #5c5858;
        padding: 20px;
        border-radius: 15px;

    }
</style>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="float-right">
                    <button type="button" id="buttonmodel" class="btn btn-primary" data-toggle="modal" data-target="#cartModal">
                        View Cart <span id="cart_count"></span>
                    </button>
                </div>
                <h4 class="card-title">Create Order</h4>
                <div class="row">
                    <div class="col-md-3 col-lg-3">
                        <div class="form-group">
                            <label>Group Products</label>
                            <select name="group_product_ids" id="group_product_ids" class="form-control select">
                                <option value="">Select Group Products</option>
                                <?php foreach ($groupProductLists as $gp) { ?>
                                    <option value="<?php echo $gp->id; ?>">
                                        <?php echo $gp->group_name; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 col-lg-3">
                        <div class="form-group">
                            <label>Brand Name</label>
                            <select name="brand_id" id="brand_id" class="form-control select">
                                <option value="">Select Brand</option>
                                <?php foreach ($brandlists as $b) { ?>
                                    <option value="<?php echo $b->brand_id; ?>">
                                        <?php echo $b->brand_name; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 col-lg-3">
                        <div class="form-group">
                            <label>Category</label>
                            <select name="category_id" id="category_id" class="form-control select">
                                <option value="">Select Category</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 col-lg-3">
                        <div class="form-group">
                            <label>Sub Category</label>
                            <select name="subcategory_id" id="subcategory_id" class="form-control select">
                                <option value="">Select Sub Category</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 col-lg-3">
                        <div class="form-group">
                            <label>Attribute Name</label>
                            <select name="attribute_id" id="attribute_id" class="form-control  select">
                                <option value="">Select Attribute Name</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 col-lg-3">
                        <div class="form-group">
                            <label>Attribute</label>
                            <select name="attribute" id="attribute" class="form-control select">
                                <option value="">Select Attribute</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Shopping List -->
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Product List</h4>
                <div class="row card-columns" id="shoplist">

                    <!-- <div class="card text-white bg-secondary mb-3" style="width: 18rem;">
                        <img src="" class="card-img-top" alt="">
                        <div class="card-body">
                            <h5 class="card-title">Card title</h5>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div> -->
                </div>
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center" id="pagin">
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
<!-- Shopping List -->
<!-- Modal -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">View Cart</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="list-group" id="cartItems">
                    <!-- Cart items with images will be dynamically populated here as list items -->
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <a href="<?php echo base_url('checkout'); ?>" class="btn btn-primary">Checkout</a>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<script type="text/javascript">
    function showCartItems() {
        const cartItemsContainer = $('#cartItems');
        cartItemsContainer.empty(); // Clear any existing items
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
                                        <img src="${item.image}" alt="${item.variation_name}" style="width: 50px; height: 50px; margin-right: 10px; float: left;">
                                        <strong>${item.variation_name}</strong><br>
                                        Quantity: ${item.qty}<br>
                                        Price: ${price_data}
                                        <br>
                                        <div class="float-right">
                                            <a onclick="removeCart(${item.cart_id})" class="btn btn-danger"><i class="fas fa-trash"></i></a>
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

    // Call the function when the modal is about to be shown
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

    $('.select').on('change', function(e) {
		alert('test');
        loadProducts();
    });

    function loadProducts() {
        var brand_id = $('#brand_id').val();
        var category_id = $('#category_id').val();
        var subcategory_id = $('#subcategory_id').val();
        var group_product_ids = $('#group_product_ids').val();
        var attribute_id = $('#attribute_id').val();
        var attribute = $('#attribute').val();

        if (brand_id) {
            $.ajax({
                url: "<?php echo site_url() ?>sales/orders/get_category",
                method: "POST",
                type: "ajax",
                data: {
                    brand_id: brand_id
                },
                success: function(result) {
                    let data = JSON.parse(result);

                    let options = "<option value=''>Select Category</option>";

                    $.each(data, function(key, value) {
                        options += '<option value="' + value.id + '">' + value.category_name + '</option>';
                        $('#category_id').empty().append(options);
                    });
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        if (category_id) {
            $.ajax({
                url: "<?php echo site_url() ?>sales/orders/get_subcategory",
                method: "POST",
                type: "ajax",
                data: {
                    category_id: category_id
                },
                success: function(result) {
                    let data = JSON.parse(result);

                    let options = "<option value=''>Select Sub Category</option>";
                    $.each(data, function(key, value) {
                        options += '<option value="' + value.id + '">' + value.sub_category_name + '</option>';
                        $('#subcategory_id').empty().append(options);
                    });
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        if (subcategory_id) {
            $.ajax({
                url: "<?php echo site_url() ?>sales/orders/get_attributes",
                method: "POST",
                type: "ajax",
                data: {
                    subcategory_id: subcategory_id
                },
                success: function(result) {
                    let data = JSON.parse(result);

                    let options = "<option value=''>Select Attribute Name</option>";
                    $.each(data, function(key, value) {
                        options += '<option value="' + value.id + '">' + value.attributes_name + '</option>';
                        $('#attribute_id').empty().append(options);
                    });
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }
        if (attribute_id) {
            $.ajax({
                url: "<?php echo site_url() ?>sales/orders/get_product_attributes_value",
                method: "POST",
                type: "ajax",
                data: {
                    attribute_id: attribute_id
                },
                success: function(result) {
                    let data = JSON.parse(result);

                    let options = "<option value=''>Select Attribute Name</option>";
                    $.each(data, function(key, value) {
                        options += '<option value="' + value.pro_details_id + '">' + value.attribute_value + '</option>';
                        $('#attribute').empty().append(options);
                    });
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }

        //Get Products For Shoping page

        $.ajax({
            url: "<?php echo site_url() ?>sales/orders/get_products",
            method: "POST",
            type: "ajax",
            data: {
                brand_id: brand_id,
                category_id: category_id,
                subcategory_id: subcategory_id,
                group_product_ids: group_product_ids,
                attribute: attribute,
            },
            success: function(result) {
                $("#shoplist").empty();
                let products = JSON.parse(result);
                if (products != '') {
                    $.each(products, function(i, item) {
                        var price_data = attrData = '';
                        if (item.slash_price > 0) {
                            price_data = '<del>' + item.slash_price + '</del> <ins>' + item.price + '</ins>  ';
                        } else {
                            price_data = '<ins>' + item.price + '</ins>';
                        }
                        var attributeNameArray = item.attributes_name.split("|");
                        var attributeValueArray = item.attribute_value.split("|");


                        $.each(attributeNameArray, function(i1, item1) {
                            attrData += '<b>' + item1 + '</b>  ' + attributeValueArray[i1] + '<br>';
                        });
                        //console.log(attrData);
                        let body_content = `<div class="card text-black product" id="product">
                                                <img src="${item.image ? item.image : '<?php echo base_url('assets/images/no-image.png'); ?>'}" class="card-img-top" width="112px;" height="212px;">
                                                <div class="card-body">
                                                    <h5 class="card-title text-center">${item.variation_name}</h5>
                                                    <p class="card-text text-center">${price_data}</p>
                                                    <p class="card-text text-center">${attrData}</p>
                                                    <div class="col text-center">
                                                        <a onclick="addtocart(${item.pro_details_id})" class="btn btn-primary">Add to Cart</a>
                                                    </div>
                                                </div>
                                            </div>`;

                        $("#shoplist").append(body_content);
                    });
                    //pagination concepts
                    var pageSize = 7;
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
                        showPage = function(page) {

                            $(".product").hide();
                            $(".product").each(function(n) {

                                if (n >= pageSize * (page - 1) && n < pageSize * page)
                                    $(this).show();
                            });
                            /*  $("#page_amount").empty();
                             var page_data = $('<p>Showing ' + page + '–' + whole_number + ' of ' + data.length + ' results</p>');
                             page_data.appendTo('#page_amount'); */
                        }

                        showPage(1);

                        $("#pagin li a").click(function() {
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
            error: function(error) {
                console.log(error);
            }
        });
        //Get Products For Shoping page
    }

    function addtocart(variation_id) {

        $.ajax({
            url: "<?php echo site_url() ?>sales/orders/addtocart",
            method: "POST",
            type: "ajax",
            data: {
                //customer_id: customer_id,
                variation_id: variation_id
            },
            success: function(result) {
                if (result > 0) {
                    Swal.fire(
                        '',
                        'Product Added in Cart successfully ',
                        'success'
                    )
                }
            },
            error: function(error) {
                console.log(error);
            }
        });
    }
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
