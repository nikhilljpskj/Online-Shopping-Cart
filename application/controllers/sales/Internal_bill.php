<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Internal_bill extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->is_logged_in();
        $this->load->library('form_validation');
        $this->load->model("Reports_model", "rm");
        ($this->verify_min_level(1)) ? '' : redirect('login');
    }

    public function index()
    {
        $view_data['datatable'] = base_url() . 'seller/orders/internal_bill/datatable/';
        $data = array(
            'title' => 'Internal Orders',
            'content' => $this->load->view('seller/Internalorders/show', $view_data, true),
        );
        $this->load->view('seller/base/main_template', $data);
    }

    public function datatable()
    {
        $this->datatables->select('o.o_id as id,b.branch_name,o.customer,o.order_amount,o.o_created_date')
            ->from('orders as o')
            ->join("em_branches as b", "b.id=o.branch_id", "left")
            ->where("o.internal_bill", "1");
        //->where("o.order_status!=", "4");
        $this->datatables->add_column('action', ' <a class="btn btn-warning btn-sm" target="_blank" href="' . base_url() . 'seller/orders/internal_bill/internal_bill/?order_id=$1"><i class="ti-eye"></i></a> &nbsp;', 'id');

        echo $this->datatables->generate();
    }

    public function add()
    {
        $amount = 0;
        if (isset($_POST['submit'])) {
            //Receive Values
            $pgroup = $this->input->post('pgroup');
            $product_name = $this->input->post('product_name');
            $uom = $this->input->post('uom');
            $branch = $this->input->post('branch');
            $quantity = $this->input->post('quantity');
            $price = $this->input->post('price');

            //Set validation Rules
            $this->form_validation->set_rules('pgroup[]', 'PRODUCT GROUP', 'required');
            $this->form_validation->set_rules('product_name[]', 'PRODUCT NAME', 'required');
            $this->form_validation->set_rules('uom[]', 'UOM', 'required');
            $this->form_validation->set_rules('branch', 'BRANCH', 'required');
            $this->form_validation->set_rules('quantity[]', 'QUANTITY', 'required');
            $this->form_validation->set_rules('price[]', 'QUANTITY', 'required');
            //check is the validation returns no error
            if ($this->form_validation->run() == true) {
                $length = count($product_name);
                $final_cgst = 0;
                $final_sgst = 0;
                $admin = $this->mcommon->specific_row('users', array('auth_level' => $this->auth_level, "username" => 'admin'));
                $insert_array = array(
                    'customer' => $this->auth_user_id,
                    'company_id' => $this->auth_company_id,
                    'branch_id' => $branch,
                    'address' => 0,
                    'order_amount' => 0,
                    'approved_by' => $this->auth_level,
                    'order_status' => 9,
                    'internal_bill' => 1,
                    'o_created_time' => date("g:i A"),
                    'o_created_date' => date('d-m-Y'),
                );
                //insert values in database
                $or_id = $this->mcommon->common_insert('orders', $insert_array);
                $payment_array = array(
                    'order_id' => $or_id,
                    'status' => 1,
                    'payment_mode' => 'ADMIN',
                    'created_date' => date('d-m-Y'),

                );
                $payment_id = $this->mcommon->common_insert('payment_details', $payment_array);
                $final_amount = 0;
                for ($i = 0; $i < $length; $i++) {
                    //prepare insert array
                    $product_sku = $this->mcommon->specific_row('products_sku', array('product_id' => $product_name[$i], 'unit' => $uom[$i]));
                    $product_group = $this->mcommon->specific_row('category', array('id' => $pgroup[$i]));
                    $unit = $this->mcommon->specific_row('set_uom', array('u_id' => $uom[$i]));
                    $amount = $product_sku['selling_price'] * $quantity[$i];
                    $final_amount += $amount;

                    $cgst = $product_group['cgst'];
                    $sgst = $product_group['sgst'];
                    //Convert our percentage value into a decimal.
                    $cgstDecimal = $cgst / 100;
                    $sgstDecimal = $sgst / 100;

                    //Get the result.
                    $cgst_amount = $cgstDecimal * $amount;
                    $sgst_amount = $sgstDecimal * $amount;
                    $final_cgst += $cgst_amount;
                    $final_sgst += $sgst_amount;
                    $order_item = array(
                        'ori_order_id' => $or_id,
                        'ori_uom' => $uom[$i],
                        'ori_quantity' => $quantity[$i],
                        'ori_category' => $pgroup[$i],
                        'ori_product' => $product_name[$i],
                        'ori_amount' => $amount,
                        'ori_cgst' => $cgst_amount,
                        'ori_sgst' => $sgst_amount,
                        'ori_created_date' => date('d-m-Y'),
                    );
                    //insert values in database
                    $insert = $this->mcommon->common_insert('order_items', $order_item);
                    $order_update = array(
                        'order_amount' => $final_amount,
                        'order_cgst' => $final_cgst,
                        'order_sgst' => $final_sgst,
                    );
                    $update = $this->mcommon->common_edit('orders', $order_update, array('o_id' => $or_id));
                    //Stock_removal//
                    // $current_stock = $this->mcommon->specific_row_value('stocks', array('pro_id' => $product_name[$i]), 'stock');
                    // $stock_array = array(
                    //     'stock' => $current_stock - $quantity[$i],
                    // );
                    // $stock_update = $this->mcommon->common_edit('stocks', $stock_array, array('pro_id' => $product_name[$i]));
                    //Stock_removal Ends//
                }
                if ($insert > '0') {

                    $this->session->set_flashdata('alert_success', 'Order added successfully!');
                } else {
                    $this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
                }
            }
        }
        $view_data['users'] = $this->users($this->auth_company_id);
        $view_data['uom'] = $this->uom($this->auth_company_id);
        $view_data['branches'] = $this->branch($this->auth_company_id);
        $data = array(
            'title' => 'Add New Internal Order',
            'content' => $this->load->view('seller/Internalorders/add', $view_data, true),
        );
        $this->load->view('seller/base/main_template', $data);

    }

    public function edit($id)
    {
        if (isset($_POST['submit'])) {
            //Receive Values
            $status = $this->input->post('order_status');
            $this->form_validation->set_rules('order_status', 'STATUS', 'required');
            //check is the validation returns no error
            if ($this->form_validation->run() == true) {
                //prepare update array
                if ($status == 2) {
                    $update_array = array(
                        'order_status' => $status,
                        'out_for_delivery_date' => date('d-m-Y'),
                        'out_for_delivery_time' => date("g:i A"),
                    );
                } else if ($status == 3) {
                    $update_array = array(
                        'order_status' => $status,
                        'delivered_date' => date('d-m-Y'),
                        'delivered_time' => date("g:i A"),
                    );
                } else {
                    $update_array = array(
                        'order_status' => $status,
                    );
                }

                //insert values in database
                $update = $this->mcommon->common_edit('orders', $update_array, array('o_id' => $id));
                if ($update) {
                    $user_data['pre_order'] = $this->rm->get_email_orders($id);
                    $username = $this->rm->get_orders_username($id);
                    $email = $this->rm->get_orders_email($id);
                    $user_data['username'] = "test";
                    $user_data['order_id'] = $id;

                    if ($status == 1) {
                        $msg = $this->load->view('email_pre_order', $user_data, true);
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
                        $this->email->from('ricedall20@gmail.com');
                        $this->email->to($email);
                        $this->email->subject('Order Confirmed');
                        $this->email->message($msg);
                        $mail_status = $this->email->send();
                        $s = "Pending";
                    } else if ($status == 2) {
                        $msg = $this->load->view('email_pre_order_out', $user_data, true);
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
                        $this->email->from('ricedall20@gmail.com');
                        $this->email->to($email);
                        $this->email->subject('Order Out for Delivery');
                        $this->email->message($msg);
                        $mail_status = $this->email->send();

                        $s = "Out for Delivery";
                    } else if ($status == 3) {

                        $msg = $this->load->view('email_pre_order_delivered', $user_data, true);

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
                        $this->email->from('ricedall20@gmail.com');
                        $this->email->to($email);
                        $this->email->subject('Order Delivered');
                        $this->email->message($msg);
                        $mail_status = $this->email->send();

                        $s = "Delivered";
                    }
                    //notification starts//
                    $order = $this->mcommon->specific_row('orders', array('o_id' => $id));
                    $user = $this->mcommon->specific_row('users', array('user_id' => $order['taken_by']));
                    $username = $user['username'];
                    $body_message = "Dear $username, Your order is $s. If you are not received the products do mail us at ricedall20@gmail.com";
                    $sms_content = urlencode($body_message);

                    // $url = "http://reseller.alphasoftz.info/api/sendsms.php?user=farmvalli&apikey=CsRxHQZxwjwWRlbN1ckw&mobile=$mobile&message=$sms_content&senderid=FRMVLI&type=txt";
                    // $ch = curl_init();
                    // curl_setopt($ch, CURLOPT_URL, $url);
                    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    // $output = curl_exec($ch);
                    // curl_close($ch);

                    $push = array(
                        'id' => $order['taken_by'],
                        'body' => $body_message,
                        'title' => "Internal Order Status",
                    );
                    $push_result = $this->push_notification->send_push($push, $order['taken_by']);

                    $notification = array(
                        'user_id' => $order['taken_by'],
                        'title' => 'Internal Order Status',
                        'notification' => $body_message,
                        'response' => $push_result,
                        'created_date' => date('Y-m-d H:i:s'),
                    );
                    $this->push_notification->submit_notification_result($notification);
                    //NOtification ends//

                    $this->session->set_flashdata('alert_success', 'Order updated successfully!');
                    redirect('orders/internal_bill');

                } else {
                    $this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
                }
            }
        }
        $view_data['orders'] = $this->mcommon->specific_row('orders', array('o_id' => $id));
        $data = array(
            'title' => 'Edit Internal Orders',
            'content' => $this->load->view('Internalorders/edit', $view_data, true),
        );
        $this->load->view('base/main_template', $data);

    }

    public function delete($id)
    {
        $delete = $this->mcommon->common_delete('orders', array('o_id' => $id));
        $delete1 = $this->mcommon->common_delete('order_items', array('ori_id' => $id));
        return $delete1;

    }

    public function product_group()
    {
        $results = $this->mcommon->product_group();
        echo json_encode($results);
    }

    public function uom()
    {
        $results = $this->mcommon->records_all('set_uom');
        return $results;
    }

    public function users($company_id)
    {
        $results = $this->mcommon->get_all_users($company_id);
        return $results;
    }

    public function branch($company_id)
    {
        $results = $this->mcommon->get_all_branch($company_id);
        return $results;
    }

    public function get_products()
    {
        $group_id = $this->input->post("group_id");
        $results = $this->mcommon->get_products($group_id);
        echo json_encode($results);
    }

    public function get_address()
    {
        $branch_id = $this->input->post("branch_id");
        $results = $this->mcommon->get_branch_addresss($branch_id);
        echo json_encode($results);
    }

    public function get_product_uom()
    {
        $product_id = $this->input->post("product_id");
        $constraint_array = array(
            'product_id' => $product_id,
        );

        $product = $this->mcommon->records_all('products_sku', $constraint_array);

        $units = array();
        for ($i = 0; $i < count($product); $i++) {
            $unit = array(
                'u_id' => $product[$i]->unit,
            );
            $units[] = $this->mcommon->specific_row('set_uom', $unit);
        }

        echo json_encode($units);
    }

    public function get_dealers()
    {
        $results = $this->mcommon->records_all('set_dealer');
        return $results;
    }

    public function view($id)
    {
        $view_data['get_admin_details'] = $this->rm->get_admin_details($id);
        $view_data['get_product_details'] = $this->rm->get_order_products($id);
        // print_r($view_data['get_dealer_details']);
        // die();
        $data = array(
            'title' => 'Invoice',
            'content' => $this->load->view('Internalorders/view', $view_data, true),
        );
        $this->load->view('base/main_template', $data);
    }

    public function invoice()
    {
        $order_id = $_GET['order_id'];
        $data['custuser'] = $this->rm->get_custuser($order_id);
        $data['get_admin_details'] = $this->rm->get_admin_details($order_id);
        $data['company_settings'] = $this->rm->get_company_settings();
        // print_r($data['get_admin_details']);
        // die();
        $data['order_settings'] = $this->rm->get_order_settings();
        $data['get_product_details'] = $this->rm->get_order_products($order_id);
        $data['payment_details'] = $this->rm->get_payment_details($order_id);
        // print_r($data);
        // die();
        $this->load->view('pages/invoice', $data);
    }

    public function internal_bill()
    {
        $order_id = $_GET['order_id'];
        //$data['custuser'] = $this->rm->get_custuser($order_id);
        $data['get_admin_details'] = $this->rm->get_admin_details($order_id);
        $data['company_settings'] = $this->rm->get_company_settings();
        $data['branch'] = $this->rm->get_branch_details($order_id);
        $data['get_product_details'] = $this->rm->get_order_products($order_id);
        // print_r($data['get_product_details']);
        // die();
        $data['payment_details'] = $this->rm->get_payment_details($order_id);
        // print_r($data);
        // die();
        $this->load->view('pages/internal_bill', $data);
    }

    public function get_product_price()
    {
        $product_id = $this->input->post("product_id");
        $uom = $this->input->post("uom");
        $quantity = $this->input->post("quantity");
        $pgroup = $this->input->post("pgroup");
        $results = $this->mcommon->get_product_price($product_id, $uom, $quantity, $pgroup);
        echo json_encode($results);
    }

}