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

	public function sales_order_create()
	{
		$template['page'] = 'salesorder/sales_order_form';
		$template['data1'] = $this->Dashboard_model->show_table1('company');
		//$template['data2'] = $this->Dashboard_model->show_table('finished_products');
		$template['data2'] = $this->mcommon->join_records_all(['pd.variation_name,p.product_name,pd.pro_details_id as id, p.product_code'],'products_details as pd',['products as p' => 'p.pro_id=pd.product_id']);

		$this->load->view('template', $template);
	}

	public function sales_order_show()
	{
		$template['page'] = 'salesorder/sales_order_view';
		// $template['data'] = $this->db->query("SELECT sales_order.id, sales_order.po_no, sales_order.customer, sales_order.po_date, sales_order.po_delivery_date, sales_order_items.pending_qty, sales_order.file, sales_order.billing, sales_order.shipping, sales_order_items.product_id, sales_order_items.product_name, sales_order_items.po_qty, (SELECT SUM(quantity) FROM `Finished_product_stock` WHERE `product_id` = sales_order_items.product_id) as stock_qty, sales_order_items.accepting_date, sales_order_items.rate, sales_order_items.status, (SELECT SUM(delivery_assign.assigned_quantity) FROM `delivery_assign` WHERE delivery_assign.product_id = sales_order.id GROUP BY delivery_assign.product_id) as assigned_quantity, (SELECT SUM(production_assign.production_qty) FROM `production_assign` WHERE production_assign.product_id = sales_order.id GROUP BY production_assign.product_id) as production_qty FROM `sales_order` LEFT JOIN sales_order_items ON sales_order_items.so_id = sales_order.id")->result();

		/* $template['data'] = $this->db->query("SELECT tab_2.so_id as sono,tab_1.po_no as pono, tab_3.name, tab_3.description, tab_2.accepting_date, tab_2.po_qty, tab_3.stock, tab_3.allocated, tab_2.pending_qty, tab_2.status,tab_2.product_id, tab_1.id as id  FROM sales_order as tab_1 LEFT JOIN sales_order_items as tab_2 ON (tab_1.id = tab_2.so_id) LEFT JOIN finished_products as tab_3 ON (tab_2.product_id = tab_3.id) WHERE tab_2.pending_qty != 0 ")->result(); */ #previous code

		$template['data'] = $this->mcommon->join_records_all(['s.id as id,s.po_no as pono,pd.variation_name as name,p.product_name,soi.so_id as sono, s.po_delivery_date, soi.po_qty, soi.pending_qty, soi.status,soi.product_id,pd.qty as stock,pd.pro_details_id as product_id'],'sales_order as s',['sales_order_items as soi'=>'s.id=soi.so_id','products_details as pd' => 'soi.product_id=pd.pro_details_id','products as p' => 'p.pro_id=pd.product_id'],'soi.pending_qty != 0 ');
#echo '<pre>';print_r($template);die();
		$this->load->view('template', $template);
	}
	public function sales_order_rate()
	{
		$template['page'] = 'salesorder/sales_order_rate';
		// $template['data'] = $this->db->query("SELECT sales_order.id, sales_order.po_no, sales_order.customer, sales_order.po_date, sales_order.po_delivery_date, sales_order_items.pending_qty, sales_order.file, sales_order.billing, sales_order.shipping, sales_order_items.product_id, sales_order_items.product_name, sales_order_items.po_qty, (SELECT SUM(quantity) FROM `Finished_product_stock` WHERE `product_id` = sales_order_items.product_id) as stock_qty, sales_order_items.accepting_date, sales_order_items.rate, sales_order_items.status, (SELECT SUM(delivery_assign.assigned_quantity) FROM `delivery_assign` WHERE delivery_assign.product_id = sales_order.id GROUP BY delivery_assign.product_id) as assigned_quantity, (SELECT SUM(production_assign.production_qty) FROM `production_assign` WHERE production_assign.product_id = sales_order.id GROUP BY production_assign.product_id) as production_qty FROM `sales_order` LEFT JOIN sales_order_items ON sales_order_items.so_id = sales_order.id")->result();

		//$template['data'] = $this->db->query("SELECT tab_2.so_id as sono,tab_1.po_no as pono, tab_3.name, tab_3.description, tab_2.accepting_date, tab_2.po_qty, tab_3.stock, tab_3.allocated, tab_2.pending_qty, tab_2.status,tab_2.product_id, tab_1.id as id  FROM sales_order as tab_1 LEFT JOIN sales_order_items as tab_2 ON (tab_1.id = tab_2.so_id) LEFT JOIN finished_products as tab_3 ON (tab_2.product_id = tab_3.id) WHERE tab_2.pending_qty != 0 ")->result();#gp
		$template['data'] = $this->mcommon->join_records_all(['s.id as id,s.po_no as pono,pd.variation_name as name,p.product_name,soi.so_id as sono, s.po_delivery_date, soi.po_qty, soi.pending_qty, soi.status,soi.product_id,pd.qty as stock,pd.pro_details_id as product_id,soi.accepting_date'],'sales_order as s',['sales_order_items as soi'=>'s.id=soi.so_id','products_details as pd' => 'soi.product_id=pd.pro_details_id','products as p' => 'p.pro_id=pd.product_id'],'soi.pending_qty != 0 ');

		$this->load->view('template', $template);
	}
	public function products_files_format()
	{
		$products = [];
		foreach ($_FILES['products'] as $key => $value) {
			foreach ($value['front_image'] as $k => $v) {
				$products[$k]['front_image'][$key] = $v;
			}
			foreach ($value['back_image'] as $k => $v) {
				$products[$k]['back_image'][$key] = $v;
			}
			foreach ($value['other_image'] as $k => $v) {
				$products[$k]['other_image'][$key] = $v;
			}
		}
		return $products;
	}


	public function view_po_no($po_no)
	{
		$template['page'] = 'salesorder/po_num_view';
		$template['data'] = $this->Dashboard_model->select_ponum_data($po_no);
		$template['data2'] = $this->Dashboard_model->show_table('finished_products');

		$this->load->view('template', $template);
	}

	public function sales_order_files_format()
	{
		$files = [];
		foreach ($_FILES['sales_order'] as $key => $value) {
			$files[$key] = $value['file'];
		}
		return $files;
	}

	private function set_upload_options()
	{
		//upload an image options
		$config = array();
		$config['upload_path'] = './Images';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|pdf';
		$config['max_size'] = '10000';
		$config['overwrite'] = false;

		return $config;
	}

	public function sales_order_store()
	{
		
		$this->load->library("upload");
		$data = $this->input->post();
		$sales_order = $this->sales_order_files_format();
		$products = $this->products_files_format();
		foreach ($data['products'] as $key => $value) {
			foreach ($value as $k => $v) {
				$products[$k][$key] = $v;
			}
		}
	
		$data['products'] = $products;
		if (isset($sales_order) && !empty($sales_order)) {
			$_FILES['file'] = $sales_order;
			$this->upload->initialize($this->set_upload_options());
			$this->upload->do_upload('file');
			$data['sales_order']['file'] = $this->upload->data()['file_name'];
		}
		if (isset($products) && !empty($products)) {
			foreach ($products as $key => $files) {
				$_FILES = $files;
				if (isset($_FILES['front_image']) && !empty($_FILES['front_image'])) {
					$this->upload->initialize($this->set_upload_options());
					$this->upload->do_upload('front_image');
					$data['products'][$key]['front_image'] = $this->upload->data()['file_name'];
				}
				if (isset($_FILES['back_image']) && !empty($_FILES['back_image'])) {
					$this->upload->initialize($this->set_upload_options());
					$this->upload->do_upload('back_image');
					$data['products'][$key]['back_image'] = $this->upload->data()['file_name'];
				}
				if (isset($_FILES['other_image']) && !empty($_FILES['other_image'])) {
					$this->upload->initialize($this->set_upload_options());
					$this->upload->do_upload('other_image');
					$data['products'][$key]['other_image'] = $this->upload->data()['file_name'];
				}
			}
		}

		$this->Dashboard_model->create_sales_order($data);

		redirect("salesorder/sales_order_show");
	}

	public function sales_order_update()
	{
		$po_no = $this->input->post('pono');
		$data1['pono'] = $this->input->post('pono');
		$customer = $this->input->post('customer');
		$data2_purchase['po_date'] = $this->input->post('podate');
		$data2_purchase['po_delivery_date'] = $this->input->post('po_delivery_date');

		$file1 = $this->input->post($_FILES['temp_file1']['name']);
		$file2 = $this->input->post($_FILES['temp_file2']['name']);

		$this->load->library('upload');
		$data_name = array();

		$dataInfo = array();
		$dataInfo1 = array();
		$dataInfo2 = array();
		$dataInfo3 = array();
		$data2 = array();
		$data3 = array();
		$data4 = array();
		$files = $_FILES;

		$cpt = count($_FILES['files']['name']);
		$f1pt = count($_FILES['temp_file1']['name']);
		$f2pt = count($_FILES['temp_file2']['name']);
		$f3pt = count($_FILES['temp_file3']['name']);

		for ($i = 0; $i < $cpt; $i++) {

			$_FILES['files']['name'] = $files['files']['name'][$i];
			$_FILES['files']['type'] = $files['files']['type'][$i];
			$_FILES['files']['tmp_name'] = $files['files']['tmp_name'][$i];
			$_FILES['files']['error'] = $files['files']['error'][$i];
			$_FILES['files']['size'] = $files['files']['size'][$i];
			$this->upload->initialize($this->set_upload_options());
			$this->upload->do_upload('files');
			$dataInfo[] = $this->upload->data();
			//print_r($dataInfo); exit();
			$data1['image_name'] = $dataInfo[$i]['file_name'];
			//print_r($data); exit();
			$this->Dashboard_model->upload_images($data1);
		}

		//front file
		for ($i = 0; $i < $f1pt; $i++) {
			$_FILES['temp_file1']['name'] = $files['temp_file1']['name'][$i];
			$_FILES['temp_file1']['type'] = $files['temp_file1']['type'][$i];
			$_FILES['temp_file1']['tmp_name'] = $files['temp_file1']['tmp_name'][$i];
			$_FILES['temp_file1']['error'] = $files['temp_file1']['error'][$i];
			$_FILES['temp_file1']['size'] = $files['temp_file1']['size'][$i];
			// $data2['image_name']=$files['temp_file']['name'][$i];
			$this->upload->initialize($this->set_upload_options());
			$this->upload->do_upload('temp_file1');
			$dataInfo1[] = $this->upload->data();

			$data2[] = $dataInfo1[$i]['file_name'];
		}

		//second image
		for ($i = 0; $i < $f2pt; $i++) {
			$_FILES['temp_file2']['name'] = $files['temp_file2']['name'][$i];
			$_FILES['temp_file2']['type'] = $files['temp_file2']['type'][$i];
			$_FILES['temp_file2']['tmp_name'] = $files['temp_file2']['tmp_name'][$i];
			$_FILES['temp_file2']['error'] = $files['temp_file2']['error'][$i];
			$_FILES['temp_file2']['size'] = $files['temp_file2']['size'][$i];
			// $data2['image_name']=$files['temp_file']['name'][$i];
			$this->upload->initialize($this->set_upload_options());
			$this->upload->do_upload('temp_file2');
			$dataInfo2[] = $this->upload->data();
			$data3[] = $dataInfo2[$i]['file_name'];
			// print_r($data1['image_name']);

		}

		//third image
		for ($i = 0; $i < $f3pt; $i++) {
			$_FILES['temp_file3']['name'] = $files['temp_file3']['name'][$i];
			$_FILES['temp_file3']['type'] = $files['temp_file3']['type'][$i];
			$_FILES['temp_file3']['tmp_name'] = $files['temp_file3']['tmp_name'][$i];
			$_FILES['temp_file3']['error'] = $files['temp_file3']['error'][$i];
			$_FILES['temp_file3']['size'] = $files['temp_file3']['size'][$i];
			// $data2['image_name']=$files['temp_file']['name'][$i];
			$this->upload->initialize($this->set_upload_options());
			$this->upload->do_upload('temp_file3');
			$dataInfo3[] = $this->upload->data();
			$data4[] = $dataInfo3[$i]['file_name'];
			// print_r($data1['image_name']);

		}

		$product = $this->input->post('product_one');
		$rate = $this->input->post('rate');
		$id = $this->input->post('id');
		$poaccpdate = $this->input->post('poaccpdate');
		$poqty = $this->input->post('poqty');
		foreach ($poqty as $key => $n) {
			$data2_purchase['po_no'] = $po_no;
			$data2_purchase['product_id'] = $product[$key];
			$query = $this->db->query('select * from finished_products where id =' . $data2_purchase['product_id'])->row();

			$data2_purchase['product_name'] = $query->name;
			$salesorderid = $id[$key];
			$data2_purchase['rate'] = $rate[$key];
			$data2_purchase['accepted_delivery_date'] = $poaccpdate[$key];
			$data2_purchase['product_qty'] = $poqty[$key];
			$data2_purchase['pending_qty'] = $poqty[$key];
			$data2_purchase['front_image'] = $data2[$key];
			$data2_purchase['back_image'] = $data3[$key];
			$data2_purchase['other_image'] = $data4[$key];

			//print_r($data2_purchase['product_name']);
			$this->db->where('po_no', $data2_purchase['po_no']);
			$this->db->where('id', $salesorderid);
			$this->db->update('sales_order', $data2_purchase);
			//$this->Dashboard_model->create_sales_order($data2_purchase);

		}

		redirect("salesorder/sales_order_show");
	}

	public function sales_order_edit()
	{
		$files = $_FILES;
		$this->load->library("upload");
		$id = $this->input->post('id');
		$data['product_name'] = $this->input->post('product_name');
		$data['po_no'] = $this->input->post('po_no');
		$data['product_qty'] = $this->input->post('product_qty');
		$data['po_date'] = $this->input->post('po_date');
		$data['po_delivery_date'] = $this->input->post('po_delivery_date');
		$data['accepted_delivery_date'] = $this->input->post('accepted_delivery_date');

		if ($_FILES['temp_file1'] !== NULL) {

			$this->upload->initialize($this->set_upload_options());

			if (!$this->upload->do_upload('temp_file1')) {
				$error = array(
					'error' => $this->upload->display_errors()
				);
				print_r($error);
			} else {
				$fd = $this->upload->data();
				$i = $fd['file_name'];
				$data['file'] = $fd['file_name'];
			}
		}
		if ($_FILES['temp_file2'] !== NULL) {

			$this->upload->initialize($this->set_upload_options());

			if (!$this->upload->do_upload('temp_file2')) {
				$error = array(
					'error' => $this->upload->display_errors()
				);
				print_r($error);
			} else {
				$fd = $this->upload->data();
				$i = $fd['file_name'];
				$data['front_image'] = $fd['file_name'];
			}
		}

		if ($_FILES['temp_file3'] !== NULL) {
			$this
				->upload
				->initialize($this->set_upload_options());

			if (!$this->upload->do_upload('temp_file3')) {
				$error = array(
					'error' => $this->upload->display_errors()
				);
				print_r($error);
			} else {
				$fd = $this->upload->data();
				$i = $fd['file_name'];
				$data['back_image'] = $fd['file_name'];
			}
		}

		if ($_FILES['temp_file4'] !== NULL) {
			$this->upload->initialize($this->set_upload_options());

			if (!$this->upload->do_upload('temp_file4')) {
				$error = array(
					'error' => $this->upload->display_errors()
				);
				print_r($error);
			} else {
				$fd = $this->upload->data();
				$i = $fd['file_name'];
				$data['other_image'] = $fd['file_name'];
			}
		}

		$this->db->where('id', $id);
		$this->db->update('sales_order', $data);
		redirect("salesorder/sales_order_show");
	}

	public function view_sales_order($id)
	{
		$query['data'] = $this->db->query("select * from sales_order where id=" . $id)->row();
		$this->load->view('admin_header');
		$this->load->view('particular_sales_order', $query);
		$this->load->view('admin_footer');
	}
}
