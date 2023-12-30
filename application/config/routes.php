<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'login';
$route['rawmaterial/raw_material_show'] = 'rawmaterial/raw_material_show';
$route['rawmaterial/create_raw_material'] = 'rawmaterial/create_raw_material';
$route['rawmaterial/store_item'] = 'rawmaterial/store_item';
$route['rawmaterial/update_item'] = 'rawmaterial/update_item';

$route['forgot_password'] = 'forgot_password';
$route['forgot_password/send_reset_link'] = 'forgot_password/send_reset_link';
$route['forgot_password/reset_password'] = 'forgot_password/reset_password';


$route['finished/create_finished_product'] = 'finished/create_finished_product';
$route['finished/finished_product_show'] = 'finished/finished_product_show';
$route['finished/store_item'] = 'finished/store_item';
$route['finished/update_item'] = 'finished/update_item';

$route['rawmaterial/(:any)'] = 'rawmaterial/index/$1';
$route['finished/(:any)'] = 'finished/index/$1';


//Attributes Routes
$route['attributes'] = 'masters/attributes/index';
$route['attributes/add'] = 'masters/attributes/add';
$route['attributes/edit/(:any)'] = 'masters/attributes/edit/$1';
$route['attributes/delete/(:any)'] = 'masters/attributes/delete/$1';

//Brand Routes
$route['brand'] = 'masters/brand/index';
$route['brand/add'] = 'masters/brand/add';
$route['brand/edit/(:any)'] = 'masters/brand/edit/$1';
$route['brand/delete/(:any)'] = 'masters/brand/delete/$1';

//company Routes
$route['company'] = 'masters/company/index';
$route['company/add'] = 'masters/company/add';
$route['company/edit/(:any)'] = 'masters/company/edit/$1';
$route['company/view/(:any)'] = 'masters/company/view/$1';

//Category Routes
$route['category'] = 'masters/category/index';
$route['category/add'] = 'masters/category/add';
$route['category/edit/(:any)'] = 'masters/category/edit/$1';
$route['category/delete/(:any)'] = 'masters/category/delete/$1';

//Group Products Routes
$route['groupProducts'] = 'masters/group_products/index';
$route['groupProducts/add'] = 'masters/group_products/add';
$route['groupProducts/edit/(:any)'] = 'masters/group_products/edit/$1';
$route['groupProducts/delete/(:any)'] = 'masters/groupProducts/delete/$1';
//$route['groupProducts/addToCart/(:any)'] = 'masters/group_products/movetocart/$1';


//Products Routes
$route['product'] = 'masters/product/index';
$route['product/add'] = 'masters/product/add';
$route['product/edit/(:any)'] = 'masters/product/edit/$1';
$route['product/delete/(:any)'] = 'masters/product/delete/$1';
$route['product/get_category'] = 'masters/product/get_category';
$route['product/get_subcategory'] = 'masters/product/get_subcategory';
$route['product/get_attributes'] = 'masters/product/get_attributes';


//Sub Category Routes
$route['sub_category'] = 'masters/sub_category/index';
$route['sub_category/add'] = 'masters/sub_category/add';
$route['sub_category/edit/(:any)'] = 'masters/sub_category/edit/$1';
$route['sub_category/delete/(:any)'] = 'masters/sub_category/delete/$1';

//file Upload
$route['masters/file_upload'] = 'masters/File_upload/index';
$route['masters/file_upload/upload'] = 'masters/File_upload/upload';



//Orders Routes

$route['orders'] = 'sales/orders/index';
$route['orders/add'] = 'sales/orders/add';
$route['orders/view/(:any)'] = 'sales/orders/view/$1';
$route['orders/update_cart'] = 'sales/orders/update_cart';
$route['checkout'] = 'sales/orders/checkout';
$route['create_order'] = 'sales/orders/create_order';

//Customer Routes
$route['customer/customer_profile'] = 'customer/customer_profile';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['my-calendar'] = "CaledarController";