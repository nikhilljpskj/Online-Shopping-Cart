<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inventory extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		if (!$this->session->userdata('authenticated')) {
			redirect('login');
			session_destroy();
		}

		date_default_timezone_set("Asia/Kolkata");
		$this->load->helper(array('form', 'url'));
		$this->session->keep_flashdata('message');

		$this->load->model('Login_model');
		$this->load->model('Dashboard_model');
	}

	public function pending_deliveries()
	{
		$template['page'] = 'inventory/pending_deliveries';
		$delivery_assign_data = $this->db->query("SELECT * FROM delivery_assign")->result();
		$table_data = [];

		foreach ($delivery_assign_data as $key => $item) {
			$sales_order_items_data = $this->db->query("SELECT so.po_no, so.po_delivery_date, soi.id AS soi_id, soi.so_id, soi.product_id, soi.product_name, soi.po_qty, soi.accepting_date, soi.rate, soi.pending_qty, soi.front_image, soi.back_image, soi.other_image, soi.status FROM sales_order_items AS soi JOIN sales_order AS so ON soi.so_id = so.id WHERE soi.product_id = '$item->product_id' AND soi.so_id = '$item->so_id'")->result();

			$box_shedule_data = $this->db->query("SELECT SUM(box_qty) AS packing_allocated_qty FROM box_shedule WHERE product_id = '$item->product_id' AND so_id = '$item->so_id' AND delivery_id = '$item->delivery_id' GROUP BY product_id, so_id, delivery_id")->result();

			$data_group1 = array_merge((array) $item, count($sales_order_items_data) ? (array) $sales_order_items_data[0] : []);
			$data_group2 = array_merge(count($box_shedule_data) ? (array) $box_shedule_data[0] : [], count($box_shedule_data) ? (array) $box_shedule_data[0] : []);
			$table_data[$key] = array_merge($data_group1, $data_group2);
		}
		$template["table_data"] = $table_data;
		
		$this->load->view('template', $template);
	}


	public function packing_deliveries()
	{
		$template['page'] = 'inventory/packing_deliveries';
		$template['data'] = $this->db->query("SELECT sales_order.id, sales_order.po_no, sales_order_items.product_name, sales_order_items.product_id, sales_order_items.accepting_date, sales_order_items.po_qty, Sum( delivery_assign.assigned_quantity ) as assigned_quantity, box_shedule.id as box_id, box_shedule.box_number, box_shedule.box_size, box_shedule.box_weight, box_shedule.box_qty FROM delivery_assign LEFT JOIN sales_order_items ON sales_order_items.so_id = delivery_assign.so_id AND sales_order_items.product_id = delivery_assign.product_id LEFT JOIN sales_order ON sales_order.id = delivery_assign.so_id LEFT JOIN box_shedule ON box_shedule.so_id = delivery_assign.so_id AND box_shedule.product_id = delivery_assign.product_id WHERE sales_order_items.status > 1 AND box_shedule.dc_id = 0 GROUP BY delivery_assign.product_id, delivery_assign.so_id, box_shedule.id")->result();

		$this->load->view('template', $template);
	}

	public function delivery_challan_deliveries()
	{
		$template['page'] = 'inventory/delivery_challan_deliveries';
		$template['data'] = $this->db->query("SELECT * FROM delivery_challan_items LEFT JOIN delivery_challan ON delivery_challan.dc_no = delivery_challan_items.dc_no GROUP BY delivery_challan.dc_no")->result();

		$this->load->view('template', $template);
	}

	public function loading_deliveries()
	{
		$template['page'] = 'inventory/loading_deliveries';
		$template['data'] = $this->db->query("SELECT box_shedule.box_size, box_shedule.box_number, box_shedule.box_qty, box_shedule.so_id, box_shedule.po_no, box_shedule.dc_id, box_shedule.product_id, box_shedule.box_weight, sales_order_items.accepting_date, sales_order_items.product_name, sales_order_items.po_qty, SUM( delivery_assign.assigned_quantity ) as delivery_allocated_qty FROM box_shedule LEFT JOIN sales_order_items ON sales_order_items.so_id = box_shedule.so_id AND sales_order_items.product_id = box_shedule.product_id LEFT JOIN delivery_assign ON delivery_assign.so_id = box_shedule.so_id AND delivery_assign.product_id = box_shedule.product_id LEFT JOIN ( SELECT so_id, isLoaded, product_id FROM delivery_challan_items GROUP BY delivery_challan_items.so_id, delivery_challan_items.product_id ) as box ON box.so_id = box_shedule.so_id AND box.product_id = box_shedule.product_id LEFT JOIN loading_deliveries ON loading_deliveries.dc_no = box_shedule.dc_id WHERE sales_order_items.status > 3 AND box_shedule.dc_id > 0 AND box.isLoaded = 1 AND loading_deliveries.id IS NULL GROUP BY box_shedule.id")->result();

		$template['delivery_challans'] = $this->db->query("SELECT * FROM delivery_challan_items LEFT JOIN sales_order_items ON sales_order_items.so_id = delivery_challan_items.so_id AND sales_order_items.product_id = delivery_challan_items.product_id  WHERE delivery_challan_items.isLoaded = 1 AND sales_order_items.status < 5  GROUP BY delivery_challan_items.dc_no")->result();
		
		$this->load->view('template', $template);
	}

	public function dispatch()
	{
		$template['page'] = 'inventory/dispatch';
		$template['data'] = $this->db->query("SELECT loading.box_size, SUM(loading.number_of_boxes) as number_of_boxes, SUM(loading.box_qty) as box_qty, loading.so_id, loading.po_no, loading.po_date, loading.po_delivery_date, loading.dc_id, loading.product_id, SUM(loading.box_weight) as box_weight, loading.accepting_date, loading.product_name, SUM(loading.po_qty) as po_qty, SUM(loading.assigned_quantity) as assigned_quantity, loading_deliveries.vehicle_no, loading_deliveries.driver_name, loading_deliveries.driver_no FROM ( SELECT box_shedule.box_size, box_shedule.box_number, COUNT(box_shedule.id) as number_of_boxes, SUM(box_shedule.box_qty) as box_qty, box_shedule.so_id, box_shedule.po_no, sales_order.po_date, sales_order.po_delivery_date, box_shedule.dc_id, box_shedule.product_id, SUM(box_shedule.box_weight) as box_weight, sales_order_items.accepting_date, sales_order_items.product_name, sales_order_items.po_qty, delivery_assign.assigned_quantity FROM box_shedule LEFT JOIN sales_order_items ON sales_order_items.so_id = box_shedule.so_id AND sales_order_items.product_id = box_shedule.product_id LEFT JOIN sales_order ON sales_order.id = sales_order_items.so_id LEFT JOIN delivery_assign ON delivery_assign.so_id = box_shedule.so_id AND delivery_assign.product_id = box_shedule.product_id LEFT JOIN ( SELECT so_id, isLoaded, product_id FROM delivery_challan_items GROUP BY delivery_challan_items.so_id, delivery_challan_items.product_id ) as box ON box.so_id = box_shedule.so_id AND box.product_id = box_shedule.product_id LEFT JOIN loading_deliveries ON loading_deliveries.dc_no = box_shedule.dc_id LEFT JOIN dispatch ON dispatch.dc_no = box_shedule.dc_id WHERE sales_order_items.status > 4 AND box_shedule.dc_id > 0 AND box.isLoaded = 1 AND dispatch.id IS NULL GROUP BY box_shedule.so_id, box_shedule.product_id ) as loading LEFT JOIN loading_deliveries ON loading_deliveries.dc_no = loading.dc_id GROUP BY loading.dc_id")->result();
		
		$this->load->view('template', $template);
	}

public function delivery_challan_print($id = NULL) {
    $this->load->library('pdf');

    $data = $this->db->query("SELECT sales_order_items.product_name, delivery_challan_items.id, delivery_challan_items.dc_no, delivery_challan_items.po_no, delivery_challan_items.so_id, delivery_challan_items.box_ids, delivery_challan_items.product_id, SUM(delivery_challan_items.box_qty) AS box_qty, SUM(delivery_challan_items.box_weight) AS box_weight, COUNT(*) AS num_of_boxes, delivery_challan.*, sales_order.customer, sales_order.billing, sales_order.shipping, customer.*, finished_products.name FROM delivery_challan_items LEFT JOIN delivery_challan ON delivery_challan.dc_no = delivery_challan_items.dc_no LEFT JOIN sales_order ON sales_order.id = delivery_challan_items.so_id LEFT JOIN sales_order_items ON sales_order_items.so_id = sales_order.id LEFT JOIN customer ON customer.id = sales_order.customer LEFT JOIN finished_products ON finished_products.id = delivery_challan_items.product_id WHERE delivery_challan.dc_no = $id GROUP BY delivery_challan_items.dc_no, delivery_challan_items.po_no, delivery_challan_items.product_id")->result();

    $new_data = [];
    foreach ($data as $item) {
        $data["billing"] = str_replace("\r\n", "<br>", $item->billing);
        $data["shipping"] = str_replace("\r\n", "<br>", $item->shipping);
        $data["primary"]["name"] = $item->customer_name;
        $data["primary"]["address"] = $item->customer_primaryaddress;
        $data["primary"]["area"] = $item->customer_areaprimary;
        $data["primary"]["district"] = $item->customer_districtprimary;
        $data["primary"]["state"] = $item->customer_stateprimary;
        $data["primary"]["pincode"] = $item->customer_pincodeprimary;
        $data["secondary"]["address"] = $item->customer_secaddress;
        $data["secondary"]["area"] = $item->customer_areasec;
        $data["secondary"]["district"] = $item->customer_districtsec;
        $data["secondary"]["state"] = $item->customer_statesec;
        $data["secondary"]["pincode"] = $item->customer_pincodesec;
        $data["secondary"]["country"] = $item->customer_countrysec;
        $data["gst"] = $item->customer_gst;
        $data["contactno1"] = $item->customer_contactno1;
        $data["contactno2"] = $item->customer_contactno2;
        $data["dc_no"] = $item->dc_no;
        $data["po_no"] = $item->po_no;
        $data["dc_date"] = $item->dc_date;
        if (!isset($new_data[$item->po_no])) $new_data[$item->po_no] = [];
        array_push($new_data[$item->po_no], (Array)$item);
    }

    $data["products"] = $new_data;
    $this->load->view('inventory/challan_print', $data);
}

}
