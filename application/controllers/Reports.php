<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Salesorder extends CI_Controller
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


	public function GRN_show()
	{
		$template['page'] = 'reports/GRN_view';

        $template['data'] = $this->db->query("SELECT invoice_order_item_grn.`order_grn_id`,invoice_order.order_receiver_address,invoice_order.orderGRNStatus,invoice_order_item_grn.`order_item_name`,invoice_order_item_grn.`order_item_quantity`,invoice_order_item_grn.`order_item_dc_no`,invoice_order_item_grn.`order_item_dc_date`,invoice_order_item_grn.`order_item_invoice_no`,invoice_order_item_grn.`order_item_invoice_date`,invoice_order_item_grn.`createdDate` FROM `invoice_order_item_grn` INNER JOIN invoice_order ON invoice_order_item_grn.order_id=invoice_order.order_id ")->result();

		$this->load->view('template', $template);
	}


	
}
