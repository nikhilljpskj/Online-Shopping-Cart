<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('plan_model', 'plan');
        // $this->load->model('register_model', 'register');
        if ($this->session->userdata('id') == "") {
            redirect('login');
        }
    }

    public function index() {
        $this->load->view('common/header');
        $this->load->view('employerview', get_defined_vars());
        $this->load->view('common/footer');
    }

    public function newplan() {
        $this->load->view('common/header');
        $this->load->view('newplan');
        $this->load->view('common/footer');
    }

    public function addplan() {
        $postdata = $this->input->post();
        $out = $this->plan->addplan($postdata);
        if ($out == 1) {
            redirect('plan/plandetails');
        }
    }

    public function addquata() {
        $postdata = $this->input->post();
        $out = $this->plan->addquata($postdata);
        if ($out == 1) {
            redirect('groups/lot_entry');
        }
    }

    public function purchase_list() {
        $postData = $this->input->post();

        // Get data
        $data = $this->db->from('invoice_order')->join("supplier","supplier.id=invoice_order.order_receiver_name")->join("invoice_order_item","invoice_order_item.order_id=invoice_order.order_id")->get()->result_array();
      //  $data = $this->plan->get_datas("", array(), "invoice_order");
        //$data1 = $this->plan->get_datas("", array("order_id"=>$data[0]['order_id']), "invoice_order_item");
       // echo "<pre>";
    // print_r(get_defined_vars());
      //  exit;
        $this->load->view('common/header', get_defined_vars());
        $this->load->view('plandetails', get_defined_vars());
        $this->load->view('common/footer', get_defined_vars());
    }

    public function create_purchase() {
        $postData = $this->input->post();
        $productdetails = $this->plan->get_datas_other("", array(), "rawproducts");
        $gst_details = $this->plan->get_datas_other("", array(), "gst_details");
        $supplier = $this->plan->get_datas("", array(), "supplier");
        // Get data
        $data = $this->plan->get_datas("", array(), "invoice_order");
        $this->load->view('common/header', get_defined_vars());
        $this->load->view('create_purchase', get_defined_vars());
        $this->load->view('common/footer', get_defined_vars());
    }
    
    public function update_stock() {
        $productdetails = $this->plan->get_datas_other("", array(), "rawproducts");
        $data = $this->plan->get_datas("", array(), "invoice_order");
        $this->load->view('common/header', get_defined_vars());
        $this->load->view('update_stock', get_defined_vars());
        $this->load->view('common/footer', get_defined_vars());
    }
    
    public function stock_update(){
         $postData = $this->input->post();
        $productdetails = $this->plan->get_datas_other("", array("id"=>$postData['productName']), "rawproducts");
        $lateststock = $productdetails[0]['stock']+$postData['stock'];
        $data=array("stock"=>$lateststock);
         $this->db->where('id', $postData["productName"]);
        $this->db->update('rawproducts', $data);
       redirect('dashboard/purchase_list');
    }
    public function edit_purchases() {
        $postData = $this->input->get('id');
        $productdetails = $this->plan->get_datas_other("", array(), "rawproducts");
        $gst_details = $this->plan->get_datas_other("", array(), "gst_details");
        $supplier = $this->plan->get_datas("", array(), "supplier");
        // Get data
         $invoicedata = $this->plan->get_datas("", array("order_id"=>$postData), "invoice_order");
         $invoicedatadetails = $this->plan->get_datas("", array("order_id"=>$postData), "invoice_order_item");
        $data = $this->plan->get_datas("", array(), "invoice_order");

        $this->load->view('common/header', get_defined_vars());
        $this->load->view('edit_invoice_purchase', get_defined_vars());
        $this->load->view('common/footer', get_defined_vars());
    }

    public function addpurchase() {
        $postData = $this->input->post();

        if (isset($postData['taxRate'])) {
            $gst_details = $this->plan->get_datas_other("", array("id" => $postData['taxRate']), "gst_details");
        }
        $data = array("order_receiver_name" => $postData['companyName'], "order_receiver_address" => $postData['address'], "order_total_before_tax" => $postData['subTotal'], "order_total_tax" => $postData['taxAmount'], "order_tax_per" => $gst_details[0]['cgst'], "order_total_after_tax" => $postData['totalAftertax'], "order_amount_paid" => $postData['totalAftertax'], "order_total_amount_due" => $postData['totalAftertax']);
        $this->db->insert("invoice_order", $data);
        $insert_id = $this->db->insert_id();
        if (isset($postData['productName']) && !empty($postData['productName'])) {
            foreach ($postData['productName'] as $keys => $vals) {
                $productdetails = $this->plan->get_datas_other("", array("id" => $vals), "rawproducts");
                $datas = array("order_id" => $insert_id, "item_code" => $vals, "item_name" => $productdetails[0]['material'], "item_category" => $postData['category'][$keys], "order_item_quantity" => $postData['quantity'][$keys], "order_item_price" => $postData['price'][$keys], "order_item_final_amount" => $postData['total'][$keys]);
                $this->db->insert("invoice_order_item", $datas);
            }
        }
        redirect('dashboard/purchase_list');
    }

    public function update_purchase() {
        $postData = $this->input->post();

        if (isset($postData['taxRate'])) {
            $gst_details = $this->plan->get_datas_other("", array("id" => $postData['taxRate']), "gst_details");
        }
        $data = array("order_receiver_name" => $postData['companyName'], "order_receiver_address" => $postData['address'], "order_total_before_tax" => $postData['subTotal'], "order_total_tax" => $postData['taxAmount'], "order_tax_per" => $gst_details[0]['cgst'], "order_total_after_tax" => $postData['totalAftertax'], "order_amount_paid" => $postData['totalAftertax'], "order_total_amount_due" => $postData['totalAftertax']);
        $this->db->where('order_id', $postData["update_id"]);
        $this->db->update('invoice_order', $data);
       // $this->db->insert("invoice_order", $data);
        $insert_id = $postData["update_id"];
        if (isset($postData['productName']) && !empty($postData['productName'])) {
            foreach ($postData['productName'] as $keys => $vals) {
                $productdetails = $this->plan->get_datas_other("", array("id" => $vals), "rawproducts");
                $datas = array("order_id" => $insert_id, "item_code" => $vals, "item_name" => $productdetails[0]['material'], "item_category" => $postData['category'][$keys], "order_item_quantity" => $postData['quantity'][$keys], "order_item_price" => $postData['price'][$keys], "order_item_final_amount" => $postData['total'][$keys]);
                 $this->db->where('order_id', $postData["update_id"]);
        $this->db->update('invoice_order_item', $datas);
               // $this->db->insert("invoice_order_item", $datas);
            }
        }
        redirect('dashboard/purchase_list');
    }

    public function invoice() {
        if (($this->uri->segment(3) != null) && $this->uri->segment(3) != "") {
            $data = $this->plan->get_datas("", array("order_id" => $this->uri->segment(3)), "invoice_order");
            $invoice_order_item = $this->plan->get_datas("", array("order_id" => $this->uri->segment(3)), "invoice_order_item");
//            echo "<pre>";
//            print_r(get_defined_vars());
//            exit;
            $this->load->view('invoice', get_defined_vars());
           // $this->load->view('common/footer', get_defined_vars());
        }
    }
    public function edit_purchase() {
        if (($this->uri->segment(3) == null) && $this->uri->segment(3) == "") {
            redirect('dashboard/purchase_list');
        }
        $data = $this->plan->get_datas("", array("order_id" => $this->uri->segment(3)), "invoice_order");
        $invoice_order_item = $this->plan->get_datas("", array("order_id" => $this->uri->segment(3)), "invoice_order_item");
        $invoice_order_item_grn = $this->plan->get_datas("", array("order_id" => $this->uri->segment(3)), "invoice_order_item_grn");
        $this->load->view('common/header', get_defined_vars());
        $this->load->view('edit_purchase', get_defined_vars());
        $this->load->view('common/footer', get_defined_vars());
    }

    public function orderItemGRN_ctrl(){
        
        $orderId = $_POST['orderId'];
        $receivedQty = $_POST['received'];
        $orderItemId = $_POST['orderItemId'];
        $productName = $_POST['productName'];
        $quantity = $_POST['quantity'];
        $productQuantity = $_POST['productQuantity'];        
        $productPrice = $_POST['productPrice'];
        $itemCode = $_POST['itemCode'];
        $received = $_POST['received'];
        $rejected = $_POST['rejected'];
        $accepted = $_POST['accepted'];
        $dcNo = $_POST['dcNo'];
        $dcDate = $_POST['dcDate'];
        $invoiceNo = $_POST['invoiceNo'];
        $invoiceDate = $_POST['invoiceDate'];
        if(!empty($orderId)){
            foreach($orderId as $key=>$value){
                if($receivedQty[$key] >0 && !empty($receivedQty[$key])){
                    $order_Id = $value;
                    $order_ItemId = $orderItemId[$key];
                    $product_Name = $productName[$key];
                    $quantity_no = $quantity[$key];
                    $product_Quantity = $productQuantity[$key];                    
                    $product_Price = $productPrice[$key];
                    $item_Code = $itemCode[$key];
                    $received_qty = $received[$key];
                    $rejected_qty = $rejected[$key];
                    $accepted_qty = $accepted[$key];
                    $dc_No = $dcNo[$key];
                    $dc_Date = $dcDate[$key];
                    $invoice_No = $invoiceNo[$key];
                    $invoice_Date = $invoiceDate[$key];
                    $createdDate = date("Y-m-d H:i:s");
                    $data = array("order_id" => $order_Id, "order_item_id" => $order_ItemId, "order_item_name" => $product_Name, "order_item_code" => $item_Code, "order_item_quantity" => $quantity_no,"order_item_total_quantity" => $product_Quantity, "order_item_price" => $product_Price, "order_item_received" => $received_qty, "order_item_rejected" => $rejected_qty, "order_item_accepted" => $accepted_qty, "order_item_dc_no" => $dc_No, "order_item_dc_date" => $dc_Date, "order_item_invoice_no" => $invoice_No, "order_item_invoice_date" => $invoice_Date, "createdDate" => $createdDate);                         $this->db->insert("invoice_order_item_grn", $data);
                $invoice_order_item = $this->plan->get_datas("", array("order_id" => $order_Id,"order_item_id" => $order_ItemId,), "invoice_order_item");
                $totalreceived = $invoice_order_item[0]['order_item_received']+$received_qty;
                if($totalreceived == $invoice_order_item[0]['order_item_quantity']){
                    $orderItemarr = array('order_item_status'=>'Completed','order_item_received'=>$totalreceived);
                }else{
                    $orderItemarr = array('order_item_received'=>$totalreceived);
                }
                $where = array("order_id" => $order_Id,"order_item_id" => $order_ItemId,);                
                $this->db->where($where)->update("invoice_order_item", $orderItemarr);                
                $invoice_order = $this->plan->get_datas("", array("order_id" => $order_Id,"order_item_status" => 'Pending',), "invoice_order_item");
                if(count($invoice_order) == 0){
                    $orderwhere = array("order_id" => $order_Id,);
                    $orderarr = array("orderGRNStatus" => 'Completed',);
                    $this->db->where($orderwhere)->update("invoice_order", $orderarr);
                }
                }
            }

        }
        echo 1;
        //redirect('dashboard/purchase_list');
    }

}
