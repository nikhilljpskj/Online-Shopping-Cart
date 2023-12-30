<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Today_orders extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->is_logged_in();
        $this->load->library('form_validation');
        $this->load->library('encryption');
        $this->load->model("Reports_model", "rm");
        ($this->verify_min_level(1)) ? '' : redirect('login');
    }

    public function index()
    {
        $view_data['data'] = $this->data_table();
        $data = array(
            'title' => 'Orders',
            'content' => $this->load->view('seller/orders/todayorder', $view_data, true),
        );
        $this->load->view('seller/base/main_template', $data);
    }

    public function data_table()
    {
         $this->db->select('*,CONCAT((o_id)) AS ids,o.o_id as id,CONCAT((o.order_amount + o.delivery_amount)) AS total,o.o_id as id,CONCAT((first_name),(" "),(last_name)) AS name,u.mobile,p.payment_mode,o.remarks, o.o_created_date');
        $this->db->from('orders as o');
        $this->db->join('users as u', 'u.user_id=o.customer', 'left');
        
        $this->db->join('payment_details as p', 'p.order_id=o.o_id', 'left');

          $this->db->where("o.o_created_date", date('d-m-Y'));
        $this->db->order_by('o.o_created_date', 'DESC');
        $query = $this->db->get();
       
       
       // $query = $this->db->get();
        return $query->result();
        // $this->db->group_by('o.company_id');

        // $this->datatables->add_column('action',
        //     '<a
        //         class="btn btn-warning btn-sm"
        //         href="' . base_url() . 'seller/orders/manage_orders/view/$1"
        //         title="View">
        //         <i class="far fa-eye"></i>
        //     </a> &nbsp;

        //     <a
        //         class="btn btn-primary btn-sm"
        //         href="' . base_url() . 'seller/orders/manage_orders/edit/$1"
        //         title="Edit">
        //         <i class="fas fa-edit"></i>
        //     </a> &nbsp; ', 'id');

        // echo $this->datatables->generate();
    }

    public function add()
    {
        $amount = 0;
        if (isset($_POST['submit'])) {
            //Receive Values
            $pgroup = $this->input->post('pgroup');
            $product_name = $this->input->post('product_name');
            $uom = $this->input->post('uom');
            $customer = $this->input->post('customer');
            $quantity = $this->input->post('quantity');
            $address = $this->input->post('address');
            $delivery_charge = $this->input->post('delivery_charge');
            $branch = $this->input->post('branch');
            //Set validation Rules
            $this->form_validation->set_rules('pgroup[]', 'PRODUCT GROUP', 'required');
            $this->form_validation->set_rules('product_name[]', 'PRODUCT NAME', 'required');
            $this->form_validation->set_rules('uom[]', 'UOM', 'required');
            $this->form_validation->set_rules('customer', 'CUSTOMER', 'required');
            $this->form_validation->set_rules('address', 'ADDRESS', 'required');
            $this->form_validation->set_rules('quantity[]', 'QUANTITY', 'required');
            $this->form_validation->set_rules('delivery_charge', 'delivery_charge', 'required');
            //check is the validation returns no error
            if ($this->form_validation->run() == true) {
                $length = count($product_name);
                $final_amount = 0;
                $final_cgst = 0;
                $final_sgst = 0;
                $final_igst = 0;
                //$admin = $this->mcommon->specific_row('users', array('auth_level' => $this->auth_level, "username" => 'admin'));
                $insert_array = array(
                    'customer' => $customer,
                    'company_id' => $this->auth_company_id,
                    'address' => $address,
                    'delivery_amount' => $delivery_charge,
                    'order_status' => 1,
                    'remarks' => "Web Order",
                    'branch_id' => $branch,
                    'o_created_time' => date("g:i A"),
                    'o_created_date' => date('d-m-Y'),
                );

                //insert values in database
                $or_id = $this->mcommon->common_insert('orders', $insert_array);
                // echo $this->db->last_query(); die();
                $payment_array = array(
                    'user_id' => $customer,
                    'order_id' => $or_id,
                    'payment_mode' => '1',
                    'status' => 'success',
                    'created_date' => date('d-m-Y'),

                );
                $p_id = $this->mcommon->common_insert('payment_details', $payment_array);
                //echo $this->db->last_query();die;
                //print_r($or_id);exit();
                // $or_id1=$this->db->error();

                for ($i = 0; $i < $length; $i++) {
                    //prepare insert array
                    $product = $this->mcommon->specific_row('products', array('product_id' => $product_name[$i]));
                    $product1 = $this->mcommon->specific_row('products_sku', array('product_id' => $product_name[$i], 'unit' => $uom[$i]));

                    // $check_branch_stock = $this->mcommon->specific_row_value('branch_stocks', array('pro_sku' => $product1['id']), "stocks");

                    // if ($check_branch_stock >= $quantity[$i]) {

                    $product_group = $this->mcommon->specific_row('category', array('id' => $pgroup[$i]));
                    $unit = $this->mcommon->specific_row('set_uom', array('u_id' => $uom[$i]));
                    $amount = $product1['selling_price'] * $quantity[$i];
                    $final_amount += $amount;
                    $cgst = $product_group['cgst'];
                    $sgst = $product_group['sgst'];
                    //$igst = $product_group['igst'];
                    //Convert our percentage value into a decimal.
                    $cgstDecimal = $cgst / 100;
                    $sgstDecimal = $sgst / 100;
                    //$igstDecimal = $igst / 100;
                    //Get the result.
                    $cgst_amount = $cgstDecimal * $amount;
                    $sgst_amount = $sgstDecimal * $amount;
                    // $igst_amount = $igstDecimal * $amount;
                    $final_cgst += $cgst_amount;
                    $final_sgst += $sgst_amount;
                    //$final_igst += $igst_amount;
                    $order_item = array(
                        'ori_order_id' => $or_id,
                        'ori_uom' => $uom[$i],
                        'ori_quantity' => $quantity[$i],
                        'ori_category' => $pgroup[$i],
                        'ori_product' => $product_name[$i],
                        'ori_amount' => $amount,
                        'ori_cgst' => $cgst_amount,
                        'ori_sgst' => $sgst_amount,
                        //'ori_igst' => $igst_amount,
                        'ori_created_date' => date('d-m-Y'),
                    );
                    //print_r($order_item);exit();
                    //insert values in database
                    $insert = $this->mcommon->common_insert('order_items', $order_item);

                    //echo $this->db->last_query();die;
                    $order_update = array(
                        'order_amount' => $final_amount,
                        'order_cgst' => $final_cgst,
                        'order_sgst' => $final_sgst,
                        //'order_igst' => $final_igst,
                    );
                    $update = $this->mcommon->common_edit('orders', $order_update, array('o_id' => $or_id));
                    $customer_details = $this->mcommon->get_user($customer, $or_id);
                    $customer_details1["user_data"] = $this->mcommon->get_user($customer, $or_id);
                    foreach ($customer_details as $row) {
                        $to_email = $row->email;
                        $first_name = $row->first_name;
                        $last_name = $row->last_name;
                    }

                    $body_message = "Dear $first_name,Your Order Confirmation";
                    $msg = $this->load->view('seller/orders/email_new_order', $customer_details1, true);
                    $this->load->library('email');

                    $config['protocol'] = 'smtp';
                    $config['smtp_host'] = 'smtp-relay.sendinblue.com';
                    $config['smtp_port'] = '587';
                    $config['smtp_timeout'] = '7';
                    $config['smtp_user'] = 'down2earthche@gmail.com';
                    $config['smtp_pass'] = '9XtRgJG05AYwHqDP';
                    $config['charset'] = 'utf-8';
                    $config['newline'] = "\r\n";
                    $config['mailtype'] = 'html'; // or html
                    $config['validation'] = true; // bool whether to validate email or not
                    $this->email->initialize($config);
                    $this->email->from('info@down2earthorganics.com', 'Down2Earth');
                    $this->email->to($to_email);
                    $this->email->subject('Order Conformation');
                    $this->email->message($msg);
                    $mail_status = $this->email->send();

                    $s = "Order Confirmation";

                    $push = array(
                        'id' => $customer,
                        'body' => $body_message,
                        'title' => "Your Order Confirmation",
                    );

                    $push_result = $this->send_push($push, $customer, $or_id);
                    // print_r($push_result);exit();
                    $notification = array(
                        'auth_level' => '1',
                        'user_id' => $customer,
                        'title' => "Order Confirmation",
                        'notification' => $body_message,
                        'response' => $push_result,

                    );
                    $this->db->insert("web_push_notification", $notification);

                    //ENABLE THIS WHEN SMS GATEWAY IS READY
                    $url = base_url() . 'v1/sms/sendOtp_order?order_id=' . $or_id . '&company_id=' . $this->auth_company_id;
                    $ch = curl_init($url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $curl_scraped_page = curl_exec($ch);
                    if (curl_errno($ch)) {
                        $error_msg = curl_error($ch);
                    }
                    if (isset($error_msg)) {
                        print_r($error_msg);
                        die();
                    }
                    curl_close($ch);
                    if ($insert > '0') {

                        // $branch_stock = array(
                        //     'stocks' => $check_branch_stock - $quantity[$i],
                        // );
                        // $stock_update = $this->mcommon->common_edit('branch_stocks', $branch_stock, array('pro_sku' => $product1['id']));
                        $this->session->set_flashdata('alert_success', 'Order added successfully!');
                    } else {
                        $this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
                    }

                    // } else {
                    //     $this->session->set_flashdata('alert_danger', $product['product_name'] . ' ' . 'stock is low');

                    // }

                }

            }
        }
        $view_data['users'] = $this->users();
        $view_data['uom'] = $this->uom();
        $view_data['branch'] = $this->mcommon->records_all('em_branches', array('company_id' => $this->auth_company_id));
        $data = array(
            'title' => 'Add New Order',
            'content' => $this->load->view('seller/orders/add', $view_data, true),
        );
        $this->load->view('seller/base/main_template', $data);

    }

    public function edit($enc_id)
    {
        $id = $this->encryption->decrypt(base64_decode($enc_id));

        if (isset($_POST['submit'])) {
            //Receive Values
            $order_status = $this->input->post('order_status');
            $delivery_boy = $this->input->post('delivery_boy');
            $customer = $this->input->post('customer');

            //Set validation Rules
            $this->form_validation->set_rules('order_status', 'Order Status', 'required');
            $this->form_validation->set_rules('delivery_boy', 'Delivery Boy', 'required');

            //check is the validation returns no error
            if ($this->form_validation->run() == true) {
                //prepare update array

                $order_array = array(
                    'delivery_boy' => $delivery_boy,
                    'order_status' => $order_status,
                );

                $update1 = $this->mcommon->common_edit('orders', $order_array, array('o_id' => $id));
                // print_r($update1);
                // die();
                if ($update1) {
                    $customer_details = $this->mcommon->get_user($customer, $id);
                    $customer_details1["user_data"] = $this->mcommon->get_user($customer, $id);

                    foreach ($customer_details as $row) {
                        $to_email = $row->email;
                        $first_name = $row->first_name;
                        $last_name = $row->last_name;
                        $company_email = $row->company_email;
                        $company_name = $row->company_name;
                    }

                    if ($order_status == '2') {
                        $order_amount = $this->mcommon->specific_row_value('orders', array('o_id' => $id), 'order_amount');
                        $body_message = "Dear $first_name, your order #$id for Rs.$order_amount has been dispatched,will be delivered in 3-4 days. Please check your email for further details";
                        $order_array1 = array(
                            'out_of_delivery_date' => date('Y-m-d h:i:sa'),
                        );
                        $update = $this->mcommon->common_edit('orders', $order_array1, array('o_id' => $id));
                        $msg = $this->load->view('seller/orders/email_pre_order_out', $customer_details1, true);
                        $this->load->library('email');

                        $config['protocol'] = 'smtp';
                        $config['smtp_host'] = 'smtp-relay.sendinblue.com';
                        $config['smtp_port'] = '587';
                        $config['smtp_timeout'] = '7';
                        $config['smtp_user'] = 'majesticprojects20@gmail.com';
                        $config['smtp_pass'] = 'pyCwGWT7V4kfJDBa';
                        $config['charset'] = 'utf-8';
                        $config['newline'] = "\r\n";
                        $config['mailtype'] = 'html'; // or html
                        $config['validation'] = true; // bool whether to validate email or not
                        $this->email->initialize($config);

                        $this->email->from($company_email, $company_name);
                        $this->email->to($to_email);
                        $this->email->subject('Order Out for Delivery');
                        $this->email->message($msg);
                        $mail_status = $this->email->send();

                        $s = "Out for Delivery";

                        $push = array(
                            'id' => $customer,
                            'body' => $body_message,
                            'title' => "Order out for delivery",
                        );

                        $push_result = $this->send_push($push, $customer, $id);
                        // print_r($push_result);exit();

                        $notification = array(
                            'auth_level' => '1',
                            'user_id' => $customer,
                            'title' => "Order out of Delivery",
                            'notification' => $body_message,
                            'response' => $push_result,

                        );

                        $get_company_id = $this->mcommon->specific_row_value('users', array('user_id' => $this->auth_user_id), 'company_id');

                        $sms_user = $this->mcommon->specific_row_value('em_companies', array('id' => $get_company_id), 'sms_user');
                        $apikey = $this->mcommon->specific_row_value('em_companies', array('id' => $get_company_id), 'api_key');
                        $sender_id = $this->mcommon->specific_row_value('em_companies', array('id' => $get_company_id), 'sender_id');

                        $mobile = json_encode($customer_details1["user_data"][0]->mobile);
                        $username = json_encode($customer_details1["user_data"][0]->first_name);
                        $body_message = "Dear $username, Your order is $s. If you are not received the products do mail us at $company_email";
                        $sms_content = urlencode($body_message);
                        $url = "http://reseller.alphasoftz.info/api/sendsms.php?user=$sms_user&apikey=$apikey&mobile=$mobile&message=$sms_content&senderid=$sender_id&type=txt";
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, $url);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        $output = curl_exec($ch);
                        curl_close($ch);
                        $this->db->insert("web_push_notification", $notification);

                        $this->session->set_flashdata('alert_success', 'Order updated successfully!');
                        redirect('seller/orders/manage_orders');

                    }

                    if ($order_status == '3') {
                        $order_array1 = array(
                            'delivered_date' => date('Y-m-d h:i:sa'),
                        );
                        $update = $this->mcommon->common_edit('orders', $order_array1, array('o_id' => $id));

                        $msg = $this->load->view('seller/orders/email_pre_order_delivered', $customer_details1, true);
                        $this->load->library('email');

                        $config['protocol'] = 'smtp';
                        $config['smtp_host'] = 'smtp-relay.sendinblue.com';
                        $config['smtp_port'] = '587';
                        $config['smtp_timeout'] = '7';
                        $config['smtp_user'] = 'majesticprojects20@gmail.com';
                        $config['smtp_pass'] = 'pyCwGWT7V4kfJDBa';
                        $config['charset'] = 'utf-8';
                        $config['newline'] = "\r\n";
                        $config['mailtype'] = 'html'; // or html
                        $config['validation'] = true; // bool whether to validate email or not
                        $this->email->initialize($config);
                        $this->email->from($company_email, $company_name);
                        $this->email->to($to_email);
                        $this->email->subject('Delivered');
                        $this->email->message($msg);
                        $mail_status = $this->email->send();
                        $s = "Delivered";

                        $order_amount = $this->mcommon->specific_row_value('orders', array('o_id' => $id), 'order_amount');
                        $delivery_date = $this->mcommon->specific_row_value('orders', array('o_id' => $id), 'delivered_date');
                        $body_message = "Dear $first_name, your order #$id for Rs.$order_amount has been delivered on $delivery_date. Please check your email for further details";
                        $push = array(
                            'id' => $customer,
                            'body' => $body_message,
                            'title' => "Order delivered",
                        );

                        $push_result = $this->send_push($push, $customer, $id);
                        // print_r($push_result);exit();
                        $notification = array(
                            'auth_level' => '1',
                            'user_id' => $customer,
                            'title' => "Order Delivered",
                            'notification' => $body_message,
                            'response' => $push_result,

                        );

                        $get_company_id = $this->mcommon->specific_row_value('users', array('user_id' => $this->auth_user_id), 'company_id');

                        $sms_user = $this->mcommon->specific_row_value('em_companies', array('id' => $get_company_id), 'sms_user');
                        $apikey = $this->mcommon->specific_row_value('em_companies', array('id' => $get_company_id), 'api_key');
                        $sender_id = $this->mcommon->specific_row_value('em_companies', array('id' => $get_company_id), 'sender_id');

                        $mobile = json_encode($customer_details1["user_data"][0]->mobile);
                        $username = json_encode($customer_details1["user_data"][0]->first_name);
                        $body_message = "Dear $username, Your order is $s. If you are not received the products do mail us at $company_email";
                        $sms_content = urlencode($body_message);
                        $url = "http://reseller.alphasoftz.info/api/sendsms.php?user=$sms_user&apikey=$apikey&mobile=$mobile&message=$sms_content&senderid=$sender_id&type=txt";
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, $url);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                        $output = curl_exec($ch);
                        curl_close($ch);

                        $this->db->insert("web_push_notification", $notification);

                        $this->session->set_flashdata('alert_success', 'Order updated successfully!');
                        redirect('seller/orders/manage_orders');

                    }

                } else {
                    $this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
                }
            }
        }
        $get_company_id = $this->mcommon->specific_row_value('users', array('user_id' => $this->auth_user_id), 'company_id');

        $branch_id = $this->mcommon->specific_row_value('em_branches', array('company_id' => $get_company_id), 'id');

        $view_data['delivery_boy'] = $this->mcommon->get_orders_delivery_boy($branch_id, $get_company_id);
        $view_data['dealers'] = $this->get_companines();
        $view_data['product_group'] = $this->product_group();
        $view_data['products'] = $this->products();
        $view_data['uom'] = $this->uom();
        $view_data['order_item'] = $this->mcommon->specific_row('order_items', array('ori_order_id' => $id));
        $view_data['order_delivery'] = $this->mcommon->specific_row('orders', array('o_id' => $id));
        $view_data['orders'] = $this->mcommon->specific_row('orders', array('o_id' => $view_data['order_item']['ori_order_id']));
        $data = array(
            'title' => 'Edit Orders',
            'content' => $this->load->view('seller/orders/edit', $view_data, true),
        );
        $this->load->view('seller/base/main_template', $data);

    }

    public function delete($id)
    {
        $delete = $this->mcommon->common_delete('orders', array('o_id' => $id));
        $delete1 = $this->mcommon->common_delete('order_items', array('ori_id' => $id));
        return $delete1;

    }

    public function product_group()
    {
        $results = $this->mcommon->records_all('category', array('company_id' => $this->auth_company_id));
        return $results;
    }
    public function category_group()
    {
        $results["category_group"] = $this->mcommon->records_all('category', array('company_id' => $this->auth_company_id));
        return $results;
    }
    public function products()
    {
        $results = $this->mcommon->records_all('products');
        return $results;
    }

    public function get_products()
    {
        $product_id = $this->input->post("product_id");

        $this->db->select("*");
        $this->db->from("products as p");
        $this->db->join("products_sku as ps", "ps.product_id=p.product_id");
        $this->db->join("set_uom su", "su.u_id=ps.unit");
        $this->db->where("ps.product_id", $product_id);
        //$this->db->where("ps.is_default",'0');
        $this->db->where("ps.is_active", '1');

        $results = $this->db->get()->result();
        echo json_encode($results);
    }
    public function get_products1()
    {
        $group_id = $this->input->post("group_id");

        $this->db->select("*");
        $this->db->from("products as p");
        $this->db->join("products_sku as ps", "ps.product_id=p.product_id");
        $this->db->where("ps.is_default", '0');
        $this->db->where("p.company_id", $this->auth_company_id);

        $this->db->where("ps.product_id", $group_id);
        $results = $this->db->get()->result();
        echo json_encode($results);
    }
    public function get_price()
    {
        $group_id = $this->input->post("product_id");

        $this->db->select("*");
        $this->db->from("products_sku");

        $this->db->where("id", $group_id);
        $results = $this->db->get()->result();
        echo json_encode($results);
    }
    public function get_price1()
    {
        $group_id = $this->input->post("product_id");

        $this->db->select("*");
        $this->db->from("products_sku");

        $this->db->where("id", $group_id);
        $results = $this->db->get()->result();
        echo json_encode($results);
    }
    public function product_group1()
    {
        $results = $this->mcommon->records_all('category', array('company_id' => $this->auth_company_id, 'status' => '1'));
        echo json_encode($results);
    }
    public function get_products2()
    {
        $group_id = $this->input->post("group_id");
        $results = $this->mcommon->get_products1($group_id);
        echo json_encode($results);
    }
    public function get_product_uom()
    {
        $product_id = $this->input->post("product_id");
        $constraint_array = array(
            'product_id' => $product_id,
        );

        $product = $this->mcommon->specific_row('products', $constraint_array);
        $name = array(
            'product_name' => $product['product_name'],
        );
        $products = $this->mcommon->records_all('products', $name);
        $units = array();
        for ($i = 0; $i < count($products); $i++) {
            $unit = array(
                'u_id' => $products[$i]->unit,
            );
            $units[] = $this->mcommon->specific_row('set_uom', $unit);
        }

        echo json_encode($units);
    }

    public function get_customers()
    {
        $this->db->select("*,ci.city as city,s.name as state,p.pincode as pincode,c.id as id");
        $this->db->from("customer_address as c");
        $this->db->join("country as co", "co.id=c.country");
        $this->db->join("states as s", "s.id=c.state");
        $this->db->join("city as ci", "ci.id=c.city");
        $this->db->join("pincode as p", "p.id=c.pincode");

        $this->db->where("c.customer_id", $this->input->post("group_id"));
        $results = $this->db->get()->result();

        echo json_encode($results);
    }

    public function get_companines()
    {
        $results = $this->mcommon->records_all('em_companies');
        return $results;
    }
    public function get_states()
    {
        $results = $this->mcommon->records_all('states');
        return $results;
    }
    public function get_users()
    {
        $results = $this->mcommon->records_all('users');
        return $results;
    }
    public function uom()
    {
        $results = $this->mcommon->records_all('set_uom');
        return $results;
    }

    public function users()
    {
        $results = $this->mcommon->get_all_users1();
        return $results;
    }

    public function view($enc_id)
    {

        $id = $this->encryption->decrypt(base64_decode($enc_id));
        // print_r($id);
        // die();
        $view_data['get_dealer_details'] = $this->rm->get_dealer_details($id);
        // print_r($view_data);
        // die();
        $view_data['get_product_details'] = $this->rm->get_order_products($id);
        $view_data['get_product_details1'] = $this->rm->get_order_products1($id);
        // print_r($view_data['get_dealer_details']);
        // die();
        $data = array(
            'title' => 'Invoice',
            'content' => $this->load->view('seller/pages/view', $view_data, true),
        );
        $this->load->view('seller/base/main_template', $data);
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
    public function get_address()
    {
        $user_id = $this->input->post("user_id");
        $results = $this->mcommon->get_user_addresss($user_id);
        echo json_encode($results);
    }
    public function get_product_price()
    {
        $product_id = $this->input->post("product_id");
        $uom = $this->input->post("uom");
        $quantity = $this->input->post("quantity");
        $sub_cat_id = $this->input->post("sub_cat_id");
        $pgroup = $this->mcommon->specific_row_value('category', array('id' => $sub_cat_id), 'id');
        $results = $this->mcommon->get_product_price($product_id, $uom, $quantity, $pgroup);

        echo json_encode($results);
    }
    public function get_product_price1()
    {
        $product_id = $this->input->post("product_id");
        $uom = $this->input->post("uom");
        $quantity = $this->input->post("quantity");
        $sub_cat_id = $this->input->post("sub_cat_id");
        $pgroup = $this->mcommon->specific_row_value('category', array('id' => $sub_cat_id), 'id');
        $results = $this->mcommon->get_product_price($product_id, $uom, $quantity, $pgroup);

        echo json_encode($results);
    }
    public function get_grandtotal()
    {
        $total = $this->input->post("total");
        // $results += $price;
        $results = $this->mcommon->get_grandtotal($total);
        echo json_encode($results);
    }
    public function get_deliverycharge()
    {
        $total = $this->input->post("total");
        // $results += $price;
        $results = $this->mcommon->get_delivery_charge($total);
        echo json_encode($results);
    }
    public function get_subcat()
    {
        $group_id = $this->input->post("group_id");
        $results = $this->mcommon->records_all('category', array('id' => $group_id, 'status' => '1'));
        echo json_encode($results);

    }
    public function send_push($message_array, $user_id, $id)
    {
        $user = $this->mcommon->get_user($user_id, $id);
        //print_r($user);exit();

        $device_id = array();
        $device_id[] = $user[0]->firebase_instance_id;
        if ($this->auth_company_id == '1016') { // print_r($device_id);exit();
            define('API_ACCESS_KEY', 'AAAAy32c14I:APA91bET6shuyI4K3sXBoJ72PXpGfHCnB-5GXFnmMIPNGLOmTdi2619e-xd754PKusdQYUaJrAF0XCPLHwUmnM15yCX9FE7KcYtZjjUzwW2rJpeoeXo7_C69xzl-Y2GsxC2KIDoqOPTZ');
        } elseif ($this->auth_company_id == '1017') {
            define('API_ACCESS_KEY', 'AAAAfsycGtw:APA91bFD5qqnE519kJVxk9UyTZekMfEQleUFSkwZKn41rDLhhxXslrbCzmpGYD84emd4LOFzoXWGKtog_I8a5JkluNveXhyoclgeI3T0QtcXSjjKHACQJbbL1f2gPYc46wLal8jeMejY');
        }
        if (!empty($message_array)) {
            $registrationIds = $device_id;
            $body = $message_array['body'];
            $title = $message_array['title'];

            // prep the bundle
            $msg = array
                (
                'body' => $body,
                'title' => $title,
                'vibrate' => 1,
                'sound' => 1,
            );
            $fields = array
                (
                'registration_ids' => $registrationIds,
                'notification' => $msg,
            );

            $headers = array
                (
                'Authorization: key=' . API_ACCESS_KEY,
                'Content-Type: application/json',
            );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
            $result = curl_exec($ch);
            curl_close($ch);
            return $result;
        }

    }

}