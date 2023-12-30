<?php

class Response
{

	private $message = '';
	private $error = false;
	private $state = 200;
	private $data = [];

	public function __construct()
	{
	}

	public function setMessage($value)
	{
		$this->message = $value;
	}

	public function setError($value)
	{
		$this->error = $value;
	}

	public function setState($value)
	{
		$this->state = $value;
	}

	public function setData($value)
	{
		$this->data = $value;
	}

	public function results()
	{
		return json_encode(
			[
				"state" => $this->state,
				"error" => $this->error,
				"data" => $this->data,
				"msg" => $this->message
			]
		);
	}
}

class Ajax extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->library('calendar');
		$this->load->model('Dashboard_model');
		$this->load->database();
		$this->load->library('form_validation');
       }

	public function add_delivery_assign()
	{

		if ($data = $this->input->post()) {
            // echo '<pre>'; print_r($data);exit;
			$product_id = $data["product_id"] ? $data["product_id"] : 0;
			$sid = $data["so_id"] ? $data["so_id"] : 0;
			$this->form_validation->set_rules("so_id", "Sales Order ID", "trim|required");
			$this->form_validation->set_rules("product_id", "Product ID", "trim|required");
			$this->form_validation->set_rules("assigned_date", "Assigned Date", "trim|required");
			$this->form_validation->set_rules("assigned_quantity", "Assigned Quantity", "trim|required|callback_compare_stock_pending[$product_id,$sid]");

			if ($this->form_validation->run() == FALSE) {
				$response = new Response();
				$response->setError(true);
				$response->setState(400);
				$response->setData($this->form_validation->error_array());
				$response->setMessage("Add delivery assign failed!");
				
				echo $response->results();
			} else {
				$this->Dashboard_model->assign_process($data);
				$so_id = $data["so_id"];
				$qty = $this->db->get_where('products_details', ['pro_details_id' => $product_id])->row('qty');
				$ass_qty = $this->db->get_where('products_details', ['pro_details_id' => $product_id])->row('allocated');
				$cstock = ($qty -  $data['assigned_quantity']);
				$ass_qty = ($ass_qty) ? $ass_qty : 0;
				$assigned_qty = $data['assigned_quantity'] + $ass_qty;
				
				$this->db->query("update products_details set qty = " . $cstock . ", allocated = ". $assigned_qty ." where pro_details_id='" . $product_id . "'");
				$this->db->query("update sales_order_items set status='1', pending_qty = pending_qty -'" . $data['assigned_quantity'] . "' where product_id='" . $product_id . "' AND id='" . $so_id . "'");
				$response = new Response();
				$response->setMessage("Successfully add!");
				echo $response->results();
			}
		}
	}

	public function compare_stock_pending($qty, $param)
	{
        
		$param = preg_split('/,/', $param);
		$pid = $param[0] ? $param[0] : 0;
		$sid = $param[1] ? $param[1] : 0;

		$stock_data = $this->db->query("SELECT * FROM  products_details WHERE pro_details_id=$pid")->result_array();
		//$sales_data = $this->db->query("SELECT * FROM sales_order_items AS s JOIN sales_order_items AS so ON(so.so_id = s.id) WHERE s.product_id = '$pid' AND so.so_id='$sid'")->result();
        $sales_data = $this->db->query("SELECT * FROM sales_order_items WHERE product_id = '$pid' AND so_id='$sid'")->result();
		if (!isset($stock_data[0]) || $stock_data[0]['qty'] < $qty) {
			$this->form_validation->set_message("compare_stock_pending", "%s not added(stock not available)!");
			return false;
		} elseif (count($sales_data) == 0 || $sales_data[0]->pending_qty < $qty) {
			$pqty = $sales_data[0]->pending_qty ? $sales_data[0]->pending_qty : 0;
			$this->form_validation->set_message("compare_stock_pending", "%s not added(available pending quantity is $pqty)!");
			return false;
		} else {
			return true;
		}
	}

	public function add_box_shedule()
	{

		if ($data = $this->input->post()) {

            $product_id = $data["product_id"] ? $data["product_id"] : 0;
			$sid = $data["so_id"] ? $data["so_id"] : 0;
			$po_no = $data["po_no"] ? $data["po_no"] : 0;
			$delivery_id = $data["delivery_id"] ? $data["delivery_id"] : 0;

			$this->form_validation->set_rules("so_id", "Sales Order ID", "trim|required");
			$this->form_validation->set_rules("po_no", "PO No", "trim|required");
			$this->form_validation->set_rules("product_id", "Product ID", "trim|required");
			$this->form_validation->set_rules("delivery_id", "Delivery ID", "trim|required");
			// $this->form_validation->set_rules("box_size", "Box Size", "trim|required");
			// $this->form_validation->set_rules("box_number", "Box Number", "trim|required");
			// $this->form_validation->set_rules("box_qty", "Box Qty", "trim|required|callback_compare_allocate_qty[$delivery_id]");

			if ($this->form_validation->run() == FALSE) {
				$response = new Response();
				$response->setError(true);
				$response->setState(400);
				$response->setData($this->form_validation->error_array());
				$response->setMessage("Add box shedule failed!");
				echo $response->results();
			} else {
                for($i=0; $i<count($data["box_size"]); $i++){
                    $fields = array();
                    $fields['product_id'] = $product_id;
                    $fields['so_id'] = $sid;
                    $fields['po_no'] = $po_no;
                    $fields['delivery_id'] = $delivery_id;
                    $fields['box_number'] = $data['box_number'][$i];
                    $fields['box_size'] = $data['box_size'][$i];
                    $fields['box_qty'] = $data['box_qty'][$i]; 
                    $this->Dashboard_model->packing_process($fields);
                    $response = new Response();
                    $response->setMessage("Successfully add!");
                }				
				echo $response->results();
			}
		}
	}

	public function compare_allocate_qty($qty, $delivery_id)
	{
		$schedule_data = $this->db->query("SELECT * FROM box_shedule WHERE delivery_id = $delivery_id")->result();
		$assigned_data = $this->db->query("SELECT * FROM delivery_assign WHERE delivery_id = $delivery_id")->result();

		$schedule_qty = 0;
		foreach ($schedule_data as $item) {
			$schedule_qty += $item->box_qty;
		}

		if (!isset($assigned_data) || count($assigned_data) == 0 || $assigned_data[0]->assigned_quantity < ((int) $qty + (int) $schedule_qty)) {
			$this->form_validation->set_message("compare_allocate_qty", "%s not added(pending quantity not available)!");
			return false;
		} else {
			return true;
		}
	}

	public function update_box_weight()
	{
		$id = $this->input->post("id");
		$weight = $this->input->post("box_weight");

		$this->Dashboard_model->packing_weight_update_process($id, $weight);
		$response = new Response();
		$response->setMessage("Successfully added!");
		echo $response->results();
	}

	public function add_production_assign()
	{
		$data = $this->input->post();
		$this->Dashboard_model->production_assign_process($data);

		$response = new Response();
		$response->setMessage("Successfully added!");
		echo $response->results();
	}

	public function add_delivery_challan()
	{
		$this->Dashboard_model->delivery_challan_process();

		$response = new Response();
		$response->setMessage("Successfully added!");
		echo $response->results();
	}

	public function update_delivery_challan()
	{
		$data = $this->input->post();
		$this->Dashboard_model->add_loading_deliveries_process($data);

		$response = new Response();
		$response->setMessage("Successfully Updated!");
		echo $response->results();
	}

	// public function add_loading_deliveries() {
	// 	$data = $this->input->post();
	// 	$this->Dashboard_model->add_loading_deliveries_process($data);

	// 	$response = new Response();
	// 	$response->setMessage("Successfully added!");
	// 	echo $response->results();
	// }

	public function add_loading_challan()
	{
		$data = $this->input->post();
		$this->Dashboard_model->add_loading_challan_process($data);

		$response = new Response();
		$response->setMessage("Successfully added!");
		echo $response->results();
	}

	public function add_dispatch()
	{
		$data = $this->input->post();
		$this->Dashboard_model->add_dispatch_process($data);

		$response = new Response();
		$response->setMessage("Successfully added!");
		echo $response->results();
	}

	public function update_loading_deliveries()
	{
		$data = $this->input->post();
		$loading_id = $data["loading_id"];
		unset($data["loading_id"]);
		$this->Dashboard_model->update_loading_deliveries_process($loading_id, $data);

		$response = new Response();
		$response->setMessage("Successfully updated!");
		echo $response->results();
	}

	public function getCustomerDetails()
	{
      	$data = $this->input->post();
		$id = $data["id"];
		
		//$details = $this->Dashboard_model->getCustomerDetails($id);
		$details = $this->mcommon->records_all('company_address',['company_id' => $id]);
		//echo '<pre>';print_r($details);die();
		if ($details) {
			$response = new Response();
			$response->setdata($details);
			$response->setMessage("Successfully!");
			echo $response->results();
		}
		else {
			echo null;
		}
	}
    public function getWorkLoadDetails()
	{
      		$data = $this->input->post();
		$id = $data["id"];
		$details = $this->db->query("SELECT sales_order.id, sales_order.po_no, sales_order.customer,customer.customer_name,sales_order.po_date, sales_order.po_delivery_date, sales_order_items.pending_qty, sales_order.file, sales_order.billing, sales_order.shipping, sales_order_items.product_id, sales_order_items.product_name, sales_order_items.po_qty, (SELECT quantity FROM `Finished_product_stock` WHERE `product_id` = sales_order_items.product_id) as stock_qty, sales_order_items.accepting_date, sales_order_items.rate, sales_order_items.status, (SELECT SUM(delivery_assign.assigned_quantity) FROM `delivery_assign` WHERE delivery_assign.product_id = sales_order.id GROUP BY delivery_assign.product_id) as assigned_quantity, (SELECT SUM(production_assign.production_qty) FROM `production_assign` WHERE production_assign.product_id = sales_order.id GROUP BY production_assign.product_id) as production_qty FROM `sales_order` LEFT JOIN sales_order_items ON sales_order_items.so_id = sales_order.id LEFT JOIN customer ON customer.id = sales_order.customer where sales_order_items.product_id ='" . $id."' and sales_order_items.pending_qty > 0")->result();
		// $details = $this->Dashboard_model->getWorkLoadDetails($id);
        if(!empty($details)){
			$response = new Response();
			$response->setdata($details);
			// $response->setMessage("Successfully!");            
			echo json_encode($details);
		}
		else {
			echo 0;
		}
	}    
}
