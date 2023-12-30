<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Orders extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
		if (!$this->session->userdata('authenticated')) {
			redirect('login');
			session_destroy();
		}
    }

public function index()
{
    $user_id = $this->session->userdata('id');
    $user_level = $this->mcommon->get_user_level($user_id);

    if ($user_level == 1) {

        $view_data['data'] = $this->mcommon->join_records_all(['o.order_id', 'o.order_amount', 'c.firstname AS name', 'c.company_name'], 'orders as o', ['company as c' => 'c.id=o.user_id'], '', '', 'o.order_id DESC');

    } else {

        $view_data['data'] = $this->mcommon->join_records_all(['o.order_id', 'o.order_amount', 'c.firstname AS name', 'c.company_name'], 'orders as o', ['company as c' => 'c.id=o.user_id'], ['o.user_id' => $this->session->userdata('id')], '', 'o.order_id DESC');
    }

    $view_data['page'] = 'orders/show';
    $this->load->view('template', $view_data);
}


    // public function fetchAttributesForProduct($pgroup_sub)
    // {
    //     $attributes = $this->mcommon->records_all('attributes', ['sub_category_id' => $pgroup_sub]);
    //     $attribute_names = array_column($attributes, 'attributes_name');
    //     return $attribute_names;
    // }




public function add()
{
    $product_id = 36;

    $product_attributes = $this->mcommon->getProductAttributes($product_id);

    $combined_attributes_12_18 = [];
    $combined_attributes_14_15 = [];
    $combined_attributes_16_17 = [];
    $other_attributes = [];

    foreach ($product_attributes as $attribute) {
        if ($attribute->attribute_id == 12 || $attribute->attribute_id == 18) {
            $this->combineAttributes($combined_attributes_12_18, $attribute);
        } elseif ($attribute->attribute_id == 14 || $attribute->attribute_id == 15) {
            $this->combineAttributes($combined_attributes_14_15, $attribute);
        } elseif ($attribute->attribute_id == 16 || $attribute->attribute_id == 17) {
            $this->combineAttributes($combined_attributes_16_17, $attribute);
        } else {
            $other_attributes[$attribute->attribute_id] = $attribute->attribute_value;
        }
    }

    // Combine values for each pro_details_id and attribute_id 12 or 18
    $this->combineAttributeGroups($combined_attributes_12_18);
    $this->combineAttributeGroups($combined_attributes_14_15);
    $this->combineAttributeGroups($combined_attributes_16_17);

    $variation_names = $this->mcommon->getProductDetailsList($product_id);

    $view_data['page'] = 'orders/add';
    $view_data['product_attributes_combined_12_18'] = $combined_attributes_12_18;
    $view_data['product_attributes_combined_14_15'] = $combined_attributes_14_15;
    $view_data['product_attributes_combined_16_17'] = $combined_attributes_16_17;
    $view_data['product_attributes_other'] = $other_attributes;
    $view_data['variation_names'] = $variation_names;

    $this->load->view('template', $view_data);
}

private function combineAttributes(&$combined_attributes, $attribute)
{
    $key = $attribute->pro_details_id;
    if (!isset($combined_attributes[$key])) {
        $combined_attributes[$key] = [];
    }
    $combined_attributes[$key][] = $attribute->attribute_value;
}

private function combineAttributeGroups(&$groups)
{
    foreach ($groups as &$group) {
        $group = implode("/", $group);
    }
}


        public function getDetails() {
            $productId = $this->input->post('product_id');
            $details = $this->mcommon->getProductDetails($productId);
            // var_dump($details);
            // die;
            
            

            echo json_encode($details);
        }


      
public function createCart() {
    $proDetailsId = $this->input->post('pro_details_id');
    
    $qty = $this->input->post('qty');
    $userId = $this->input->post('user_id');
    $productName = $this->input->post('product_name');
    

    // Insert data into the cart table
    $this->mcommon->addToCart($proDetailsId, $qty, $userId, $productName);

    // You can return a response if needed
    echo json_encode(['success' => true]);
}



        









    public function getShippingAddresses() {

    $company_id = $this->session->userdata('company_id');
    $shipping_addresses = $this->mcommon->getShippingAddresses($company_id);

    echo json_encode($shipping_addresses);
    }



    // public function get_sizes_by_pro_details_id() {
    // $proDetailsId = $this->input->post('pro_details_id');
    // $sizes = $this->mcommon->get_sizes_by_pro_details_id($proDetailsId);

    // $htmlOptions = '<option value="">Select size</option>';
    // foreach ($sizes as $size) {
    //     $htmlOptions .= '<option value="' . $size['attribute_value'] . '">' . $size['attribute_value'] . '</option>';
    // }

    // echo $htmlOptions;
    // }


    public function get_attributes()
    {

        $sub_category_id = $this->input->post("sub_category_id");
        $results = $this->mcommon->records_all('attributes', array('status' => 1, 'sub_category_id' => $sub_category_id), 'attributes_name ASC');
        echo json_encode($results);
    }

    public function get_product_attributes_value()
    {

        $attribute_id = $this->input->post("attribute_id");
        $results = $this->mcommon->records_all('product_attributes', array('attribute_id' => $attribute_id),'attribute_value ASC');
        echo json_encode($results);
    }


    public function delete($id)
    {
        $delete = $this->mcommon->common_delete('orders', array('order_id' => $id));
        $delete1 = $this->mcommon->common_delete('order_items', array('order_id' => $id));
        return $delete1;
    }
    public function get_category()
    {
        $brand_id = $this->input->post("brand_id");
        $results = $this->mcommon->records_all('category', array('status' => 1, 'brand_id' => $brand_id));
        echo json_encode($results);
    }
    public function get_subcategory()
    {
        $category_id = $this->input->post("category_id");
        $results = $this->mcommon->records_all('sub_category', array('status' => 1, 'category_id' => $category_id));
        echo json_encode($results);
    }

    public function get_products()
    {
        $filter_datas['brand_id'] = $this->input->post("brand_id");
        $filter_datas['category_id'] = $this->input->post("category_id");
        $filter_datas['subcategory_id'] = $this->input->post("subcategory_id");
        $filter_datas['group_product_ids'] = $this->input->post("group_product_ids");
        $filter_datas['attribute'] = $this->input->post("attribute");

        $results = $this->mcommon->get_productslist($filter_datas);
        echo json_encode($results);
    }

    public function addtocart()
    {

        $variation_id = $this->input->post("variation_id");
        
        $existCart = $this->mcommon->specific_row('cart', ['user_id' => $this->session->userdata('id'), 'variation_id' => $variation_id]);
       
        if (!empty($existCart)) {
            $updated_id = $this->mcommon->common_edit('cart', ['qty' => $existCart['qty'] + 1], ['cart_id' => $existCart['cart_id']]);
            $returnid = 0;
            if ($updated_id) {
                $returnid = 1;
            }
            echo json_encode($returnid);
        } else {
            $cart_data = array(
                'user_id' => $this->session->userdata('id'),
                'variation_id' => $variation_id,
                'qty' => 1,
            );
            $insert_id = $this->mcommon->common_insert('cart', $cart_data);
            echo json_encode($insert_id);
        }
    }

    public function get_cartData()
    {
        $cartsData = $this->mcommon->join_records_all(['pd.image, pd.price, pd.slash_price, pd.variation_name', 'pd.pro_details_id AS variation_id, c.cart_id, c.qty'], 'cart AS c', ['products_details AS pd' => 'pd.pro_details_id = c.variation_id'], ['c.user_id' => $this->session->userdata('id')], '', 'pd.variation_name ASC');
        echo json_encode($cartsData);
    }
    public function update_cart()
    {
        $cart_id = $this->input->post("cart_id");
        $qty = $this->input->post("qty");

        $updated_id = $this->mcommon->common_edit('cart', ['qty' => $qty], ['cart_id' => $cart_id]);
        $returnid = 0;
        if ($updated_id) {
            $returnid = 1;
        }
        echo json_encode($returnid);
    }
    public function removeCart()
    {
        $cart_id = $this->input->post("cart_id");
        $delete = $this->mcommon->common_delete('cart', ['cart_id' => $cart_id]);
        if ($delete) {
            echo json_encode(1);
        } else {
            echo json_encode(0);
        }
    }

    
public function checkout()
{
    $company_id = $this->mcommon->specific_row_value('company', ['company_id' => $this->session->userdata('company_id')], 'company_id');
    
    $view_data['company_data'] = $this->mcommon->records_all('company', ['company_id' => $company_id]);
    //$view_data['shipping_address'] = $this->mcommon->records_all('company_address', ['company_id' => $company_id, 'address_type' => 'Billing Address']);
    $view_data['billing_address'] = $this->mcommon->records_all('company_address', ['company_id' => $company_id, 'address_type' => 'Billing Address']);

    $view_data['cartdatas'] = $this->mcommon->join_records_all(['pd.image, pd.price, pd.slash_price, pd.variation_name', 'pd.pro_details_id AS variation_id, c.cart_id, c.group_name, c.qty, c.product_name'], 'cart AS c', ['products_details AS pd' => 'pd.pro_details_id = c.variation_id'], ['user_id' => $this->session->userdata('id')], '', 'pd.variation_name ASC');

    if (empty($view_data['cartdatas'])) {
        redirect('dashboard');
    }
    
    $view_data['user_level'] = $this->mcommon->specific_row_value('users', ['id' => $this->session->userdata('id')], 'user_level');

    $view_data['page'] = 'orders/checkout';
    $this->load->view('template', $view_data);
}



    // Add this method to your controller
public function check_cart_status()
{
    $user_id = $this->input->post('user_id');
    $cart_count = $this->db->where('user_id', $user_id)->count_all_results('cart');
    echo $cart_count;
}



    public function create_order()
    {

        #recevied All Post Datas
        $sub_total = $this->input->post('sub_total');
        $delivery_price = $this->input->post('delivery_price');
        //$discount_price = $this->input->post('discount_price');
        $cgst = $this->input->post('cgst');
        $igst = $this->input->post('igst');
        $sgst = $this->input->post('sgst');
        $tax = $this->input->post('tax');
        $order_amount = $this->input->post('order_amount');
        $delivery_date = $this->input->post('delivery_date');
        $group_name = $this->input->post('group_name');
        $product_name = $this->input->post('product_name');
        
  
        

        $company_id = $this->session->userdata('company_id');
        
     


        $selectedShippingAddress = $this->input->post('selectedShippingAddress');

        $shippingAddressParts = explode(", ", $selectedShippingAddress);
        $billing_data = $this->mcommon->records_all('company_address', ['company_id' => $company_id, 'address_type' => 'Billing Address']);
       

        $insert_array = array(
            'user_id' => $this->session->userdata('id'),
            'ip_address' => $this->input->ip_address(),
            'sub_total' => $sub_total,
            'delivery_price' => $delivery_price,
            //'discount_price' => $discount_price,
            'cgst' => $cgst,
            'igst' => $igst,
            'sgst' => $sgst,
            'tax' => $tax,
            //'group_name' => $group_name,
            'order_amount' => $order_amount,
            'company_id' => $company_id,
            'baddress1' => $billing_data[0]->address1,
            'baddress2' => $billing_data[0]->address2,
            'bcity' => $billing_data[0]->city,
            'bdistrict' => $billing_data[0]->district,
            'bstate' => $billing_data[0]->state,
            'bcountry' => $billing_data[0]->country,
            'bpincode' =>  $billing_data[0]->pincode,
            'saddress1' => isset($shippingAddressParts[0]) ? $shippingAddressParts[0] : '',
            'saddress2' => isset($shippingAddressParts[1]) ? $shippingAddressParts[1] : '',
            'scity' => isset($shippingAddressParts[2]) ? $shippingAddressParts[2] : '',
            'sdistrict' => isset($shippingAddressParts[3]) ? $shippingAddressParts[3] : '',
            'sstate' => isset($shippingAddressParts[4]) ? $shippingAddressParts[4] : '',
            'scountry' => isset($shippingAddressParts[5]) ? $shippingAddressParts[5] : '',
            'spincode' => isset($shippingAddressParts[6]) ? $shippingAddressParts[6] : '',
            'status' => '1',
            'delivery_date' => $delivery_date,
            'o_created_time' => date("g:i A"),
            'o_created_date' => date('Y-m-d'),
            
        );
        // var_dump($insert_array);
        // die;


        

        $billing_address = $billing_data[0]->address1 . '<br>' . $billing_data[0]->address2 . '<br>' . $billing_data[0]->city . '<br>' . $billing_data[0]->district . '<br>' . $billing_data[0]->state . '<br>' . $billing_data[0]->country . '<br>' . $billing_data[0]->pincode;
$shipping_address = $shipping_data[0]->address1 . '<br>' . $shipping_data[0]->address2 . '<br>' . $shipping_data[0]->city . '<br>' . $shipping_data[0]->district . '<br>' . $shipping_data[0]->state . '<br>' . $shipping_data[0]->country . '<br>' . $shipping_data[0]->pincode;

        $emailinfo['billing_address'] = $billing_address;
        $emailinfo['shipping_address'] = $shipping_address;
        $sales_data = array(
            'customer' => $this->session->userdata('id'),
            'po_delivery_date' => $delivery_date,
            'sub_total' => $sub_total,
            'delivery_price' => $delivery_price,
            //'discount_price' => $discount_price,
            'cgst' => $cgst,
            'igst' => $igst,
            'sgst' => $sgst,
            'tax' => $tax,
            'order_amount' => $order_amount,
            'company_id' => $company_id,

            'billing' => $billing_address,
            'shipping' => $shipping_address,
            'status' => '1',
            'created_time' => date("g:i A"),
            'created_date' => date('Y-m-d'),
            'order_type' => '1',
        );
        // var_dump($sales_data);
        // die;
        
        
        //insert values in database
        $order_id = $this->mcommon->common_insert('orders', $insert_array);
        
        
        $sales_id = $this->mcommon->common_insert('sales_order', $sales_data);
        // var_dump($sales_id);
        // die;
        
        // echo '<pre> orders data';print_r($insert_array);
        // echo '<pre> sales data';print_r($sales_data);
        // echo '<pre> order id';print_r($order_id);
        // echo '<pre>';print_r($sales_id);die();
        $cart_data =  $this->mcommon->join_records_all(['pd.image, pd.price, pd.slash_price, pd.variation_name', 'pd.pro_details_id AS variation_id, c.cart_id, c.qty,c.group_name, c.product_name'], 'cart AS c', ['products_details AS pd' => 'pd.pro_details_id = c.variation_id'], ['user_id' => $this->session->userdata('id')], '', 'pd.variation_name ASC');

        
        
        


        foreach ($cart_data as $row) {

            $order_item = array(
                'order_id' => $order_id,
                'variation_id' => $row->variation_id,
                'group_name' => $row->group_name,
                'product_name' => $row->product_name,
                'qty' => $row->qty,
                'price' => $row->price,
                'created_date' => date('Y-m-d'),
                'created_time' => date("g:i A"),
            );

            $sales_item = array(
                'so_id' => $sales_id,
                'product_id' => $row->variation_id,
                'product_name' => $row->variation_name,
                'po_qty' => $row->qty,
                'pending_qty' => $row->qty,
                'rate' => $row->price,
            );
            //insert values in database
            $itemsID = $this->mcommon->common_insert('order_items', $order_item);
            $salesItemsID = $this->mcommon->common_insert('sales_order_items', $sales_item);

            /* $variation_data = $this->mcommon->specific_row('products_details', ['pro_details_id' => $row->variation_id]);
            $stock_array = array(
                'qty' => $variation_data['qty'] - $row->qty,
            );
            $stock_update = $this->mcommon->common_edit('products_details', $stock_array, ['pro_details_id' => $row->variation_id]); */
        }

        $setting_data = $this->mcommon->specific_row('em_companies', array('id' => 1017));
        $company_data = $this->mcommon->specific_row('company', ['company_id' => $company_id]);

        $emailinfo['cart_data'] = $cart_data;
        $emailinfo['sub_total'] = $sub_total;
        $emailinfo['delivery_price'] = $delivery_price;
        //$emailinfo['discount_price'] = $discount_price;
        $emailinfo['tax'] = $tax;
        $emailinfo['delivery_date'] = $delivery_date;
        $emailinfo['tot_amount'] = $order_amount;
        $emailinfo['username'] = $company_data['company_name'];
        $emailinfo['order_id'] = $order_id;
        $emailinfo['company_phone_number'] = $setting_data['company_phone_number'];
        $emailinfo['whats_app_number'] = $setting_data['whats_app_number'];
        $emailinfo['company_email'] = $setting_data['company_email'];
        $emailinfo['group_name'] = $order_item['group_name'];
        $emailinfo['product_name'] = $order_item['product_name'];
        $emailinfo['selected_shipping_address'] = [
            'saddress1' => isset($shippingAddressParts[0]) ? $shippingAddressParts[0] : '',
            'saddress2' => isset($shippingAddressParts[1]) ? $shippingAddressParts[1] : '',
            'scity' => isset($shippingAddressParts[2]) ? $shippingAddressParts[2] : '',
            'sdistrict' => isset($shippingAddressParts[3]) ? $shippingAddressParts[3] : '',
            'sstate' => isset($shippingAddressParts[4]) ? $shippingAddressParts[4] : '',
            'scountry' => isset($shippingAddressParts[5]) ? $shippingAddressParts[5] : '',
            'spincode' => isset($shippingAddressParts[6]) ? $shippingAddressParts[6] : '',
        ];
        //var_dump($emailinfo['selected_shipping_address']);


        $mailData['emailcontent'] = 'Order Confirmation';
        $mailData['toEmail'] = $setting_data['company_email'];
        $mailData['subject'] = 'Order Confirmation ';

        $cart_delete = $this->mcommon->common_delete('cart', ['user_id' => $this->session->userdata('id')]);
        if ($cart_delete) {
            $response_array = 1;
        } else {
            $response_array = 0;
        }
        echo json_encode($response_array);

        $user_id = $this->session->userdata('id');
        
        $user_email = $this->mcommon->get_single_value('company', 'email', ['id' => $user_id]);


        $this->send_order_confirmation_email($user_email, $emailinfo);

    }





	public function send_order_confirmation_email($to, $emailinfo)
    {
        //var_dump($emailinfo);

    	/* use this on server */

    	/* $config = Array(
		      'mailtype' => 'html',
		      'charset' => 'iso-8859-1',
		      'wordwrap' => TRUE
	    	);
    	 */
        $config = Array(
        'protocol' => 'smtp',
        'smtp_host' => 'ssl://smtp.gmail.com', 
        'smtp_port' => 465, 
        'smtp_user' => 'nikhilkodumon@gmail.com',
        'smtp_pass' => 'khalilgibran', 

        'mailtype' => 'html',
        'charset' => 'iso-8859-1',
        'wordwrap' => TRUE
    );
    	
    	/*This email configuration for sending email by Google Email 
	    $config = Array(
	      'protocol' => 'smtp',
	      'smtp_host' => 'ssl://smtp.googlemail.com',
	     
	      'smtp_port' => 465,
	      'smtp_user' => 'exampleEmail@gmail.com',  //gmail id
	      'smtp_pass' => '@@password',   //gmail password
	      
	      'mailtype' => 'html',
	      'charset' => 'iso-8859-1',
	      'wordwrap' => TRUE
	    	);*/



          $this->load->library('email', $config);
          $this->email->set_newline("\r\n");
          $this->email->from('noreply');
          $this->email->to($to);
          $cc_email = 'mgr4projects@gmail.com';
          $this->email->cc($cc_email);
          $this->email->subject("Order Confirmation");
          

        $company_id = $this->session->userdata('company_id');

  

        

    $billingAddress = $emailinfo['billing_address'];
    //$shippingAddress = $emailinfo['selected_shipping_address'];
    //var_dump($shippingAddress);

$htmlMessage = "<html><body>";


$htmlMessage .= "<div style='display: flex;'>";
$htmlMessage .= "<div style='width: 100%; text-align: left;'>";
$htmlMessage .= "<h2>PUNARBHAVAA Sustainable Products</h2>";
$htmlMessage .= "<p>SKE Thottam, No 20-B,</p><p> Sri Palaniandavan Nagar, Kaveri Nagar, </p><p>15 Velampalayam, Tirupur - 641 652 India</p>";
$htmlMessage .= "</div>";


$htmlMessage .= "<div style='width: 0%; flex-grow: 1;'></div>"; 
$htmlMessage .= "<div style='width: 20%; text-align: left;'>";
$htmlMessage .= "<p><strong>Order Number:</strong> " . $emailinfo['order_id'] . "</p>";
$htmlMessage .= "<p><strong>Order Date:</strong> " . date('Y-m-d') . "</p>";
$htmlMessage .= "<p><strong>Deliver Date:</strong> " . $emailinfo['delivery_date'] . "</p>";
$htmlMessage .= "</div>";
$htmlMessage .= "</div>";

    $htmlMessage .= "<div style='display: flex;'>";
    $htmlMessage .= "<div style='width: 50%;'>";
    $htmlMessage .= "<p><strong>Shipping Address:</strong><br>";
    $htmlMessage .= isset($emailinfo['selected_shipping_address']['saddress1']) ? $emailinfo['selected_shipping_address']['saddress1'] . '<br>' : '';
    $htmlMessage .= isset($emailinfo['selected_shipping_address']['saddress2']) ? $emailinfo['selected_shipping_address']['saddress2'] . '<br>' : '';
    $htmlMessage .= isset($emailinfo['selected_shipping_address']['scity']) ? $emailinfo['selected_shipping_address']['scity'] . '<br>' : '';
    $htmlMessage .= isset($emailinfo['selected_shipping_address']['sdistrict']) ? $emailinfo['selected_shipping_address']['sdistrict'] . '<br>' : '';
    $htmlMessage .= isset($emailinfo['selected_shipping_address']['sstate']) ? $emailinfo['selected_shipping_address']['sstate'] . '<br>' : '';
    $htmlMessage .= isset($emailinfo['selected_shipping_address']['scountry']) ? $emailinfo['selected_shipping_address']['scountry'] . '<br>' : '';
    $htmlMessage .= isset($emailinfo['selected_shipping_address']['spincode']) ? $emailinfo['selected_shipping_address']['spincode'] : '';
    $htmlMessage .= "</p>";
    $htmlMessage .= "</div>";
    $htmlMessage .= "<div style='width: 50%;'>";
    $htmlMessage .= "<p><strong>Billing Address:</strong><br>" . $billingAddress . "</p>";
    $htmlMessage .= "</div>";
    $htmlMessage .= "</div>";

$htmlMessage .= "</div>";


$htmlMessage .= "<table border='1' cellspacing='0' cellpadding='10' style='width: 100%;'>";
$htmlMessage .= "<tr><th>S.NO</th><th>CODE</th><th>PRODUCT</th><th>QUANTITY</th><th>UNIT PRICE</th><th>IMAGE</th><th>TOTAL</th></tr>";

if (empty($emailinfo['cart_data'])) {
    $htmlMessage .= "<tr><td colspan='7'>No items in the order.</td></tr>";
} else {
    foreach ($emailinfo['cart_data'] as $index => $item) {
        $htmlMessage .= "<tr>";
        $htmlMessage .= "<td>" . ($index + 1) . "</td>";
        $htmlMessage .= "<td>" . (!empty($item->group_name) ? $item->group_name : $item->variation_name) . "</td>";
        $htmlMessage .= "<td>" . (!empty($item->product_name) ? $item->product_name : $item->variation_name) . "</td>";
        $htmlMessage .= "<td>" . $item->qty . "</td>";
        $htmlMessage .= "<td>$" . $item->price . "</td>";
        $htmlMessage .= "<td><img src='" . $item->image . "' alt='" . $item->variation_name . "' width='50'></td>";
        $htmlMessage .= "<td>$" . number_format($item->price * $item->qty, 2) . "</td>";
        $htmlMessage .= "</tr>";
    }
}


$htmlMessage .= "<tr>";
$htmlMessage .= "<td colspan='5'></td>"; 
$htmlMessage .= "<td><strong>Subtotal:</strong></td>";
$htmlMessage .= "<td><strong>$" . $emailinfo['sub_total'] . "</strong></td>";
$htmlMessage .= "</tr>";

$htmlMessage .= "<tr>";
$htmlMessage .= "<td colspan='5'></td>"; 
$htmlMessage .= "<td><strong>Total:</strong></td>";
$htmlMessage .= "<td><strong>$" . number_format((float)$emailinfo['tot_amount'], 3) . "</strong></td>";
$htmlMessage .= "</tr>";

$htmlMessage .= "</table>"; 

$htmlMessage .= "</body></html>";

$this->email->message($htmlMessage);
          
          if($this->email->send())
         {
           return true;
         }
         else
         {
         	return false;
         }
    }




    public function view($order_id)
    {
        $company_id = $this->mcommon->specific_row_value('company', ['company_id' => $this->session->userdata('company_id')], 'company_id');
    
        $view_data['billing_address'] = $this->mcommon->records_all('company_address', ['company_id' => $company_id, 'address_type' => 'Billing Address']);

        $view_data['settings'] = $this->mcommon->records_all('em_companies');
        $view_data['get_order_details'] = $this->mcommon->get_order_details($order_id);
        $view_data['order_data'] = $this->mcommon->specific_row('orders', array('order_id' => $order_id,));
        $view_data['order_item_data'] = $this->mcommon->specific_row('order_items', array('order_id' => $order_id,));
        $view_data['company_data'] = $this->mcommon->specific_row('company', array('company_id' => $view_data['order_data']['company_id'],));
        //$view_data['group_products'] = $this->mcommon->records_all('group_products');
		$view_data['page'] = 'orders/view';
		$view_data['exclude_print'] = true;
        $this->load->view('template', $view_data);
        // var_dump($view_data['billing_address']);
        
      
    }
    public function printview($id)
    {
        $view_data['get_dealer_details'] = $this->rm->get_dealer_details($id);
        $view_data['get_product_details'] = $this->rm->get_order_products($id);
        $view_data['get_product_details1'] = $this->rm->get_order_products1($id);
        // print_r($view_data['get_dealer_details']);
        // die();
        $data = array(
            'title' => 'Invoice',
            'content' => $this->load->view('seller/pages/printview', $view_data, true),
        );
        $this->load->view('seller/base/main_template', $data);
    }

    public function sendsms($phone, $msg, $sms_type)
    {
        $mobile = $phone;
        $message = urlencode($msg);

        if ($sms_type == 5) {
            //momentinotp
            $url = "";
        }

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $curl_scraped_page = curl_exec($ch);
        curl_close($ch);
        $result = explode(' ', $curl_scraped_page);
        return $result;
    }
}
