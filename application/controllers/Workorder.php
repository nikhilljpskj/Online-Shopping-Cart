<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Workorder extends CI_Controller
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

	public function work_order_show()
	{
		$template['page'] = 'dashboard';
		$template['eventCalendar'] = '';
		$this->load->view('template', $template);
	}
    public function work_order_create()
	{
		$template['page'] = 'workorder/work_order_form';
		$template['data1'] = $this->Dashboard_model->show_table1('customer');
		$template['data2'] = $this->Dashboard_model->show_table('finished_products');
		$this->load->view('template', $template);
	}
    public function work_order_store()
	{
		$data = $this->input->post();
        $fields = array(
            "product_id"=>$data['products']['product_id'][0],
            "buyer_name"=>$data['work_order']['customer_id'],
            "start_date"=>$data['start_date'],
            "end_date"=>$data['end_date'],
            "status"=>$data['status'],
            "manaer_name"=>$data['manager_id'],
            "production_qty"=>$data['prd_qty'],
            "extra_qty"=>$data['extra_qty'],
            "total_qty"=>$data['tot_qty'],
            "cutsize"=>$data['cutSize_out'],
            "ups_running_board"=>$data['ups_rnng_board'],
            "ups_full_board"=>$data['ups_full_board'],
            "total_board"=>$data['tot_brd_req'],
            "extra_board"=>$data['ext_brd_req'],
            "no_plates"=>$data['no_plates'],
            "no_screen"=>$data['no_screen'],
            "wo_is_front"=>$data['print_type_front'],
            "wo_is_back"=>$data['print_side_back'],
            "wo_front_product_id"=>$data['front_product_id'],
            "wo_front_product_name"=>$data['front_product_name'],
            "wo_front_boardqty"=>$data['front_board_qty'],
            "wo_back_product_id"=>$data['back_product_id'],
            "wo_back_product_name"=>$data['back_product_name'],
            "wo_back_boardqty"=>$data['back_board_qty'],
            "front_process_flow"=>$data['front_process'][0],
            "back_process_flow"=>$data['back_process'][0],
            "side_process_flow"=>$data['side_process'][0],
            "updatedDate"=>date('Y-m-d H:i:s'),
            "createdDate"=>date('Y-m-d H:i:s'),
        );
		$this->Dashboard_model->create_work_order_item($fields);

		redirect("workorder/work_orders_show");
	}
    public function work_order_material_issue()
	{
        $data = $this->input->get();
        if(empty($data)){
            redirect("workorder/work_orders_show");
        }
        $id = $data['wo_no'];
        $template['page'] = 'workorder/work_order_material_issue_form';
        $template['data'] = $this->db->query("SELECT work_orders_item.*,finished_products.name FROM `work_orders_item` join finished_products on finished_products.id = work_orders_item.product_id where work_orders_item.id='".$id."'  order by work_orders_item.id desc")->result();
		// $template['data1'] = $this->Dashboard_model->single_record('work_orders_item',$id);
        $template['data2'] = $this->Dashboard_model->show_table('rawproducts');
        // echo "<pre>";
        // print_r($template);
        // exit;
		$this->load->view('template', $template);
        // exit;
		
	}
    public function work_order_material_issue_create()
    {
        $data = $this->input->post();
        echo "<pre>";
        print_r($data);
        exit;
        $fields = array(
            "wo_no"=>$data['wo_no'],
            "po_no"=>$data['po_no'],
            "product_name"=>$data['product_name'],
            "product_id"=>$data['products']['product_id'][0],
            "promised_date"=>$data['promised_date'],
            "po_qty"=>isset($data['po_qty'])?$data['po_qty']:'0',
            "prd_qty"=>$data['prd_qty'],
            "board_qty"=>$data['board_qty'],
            "lot_no"=>$data['lot_no'],
            "print_type"=>$data['print_type'], 
            "print_side"=>'Front Side',
            "created_date"=>date('Y-m-d H:i:s'),
        );
		$this->Dashboard_model->create_work_order_material_issue($fields);
        if(isset($data['print_side_back']) && $data['print_side_back'] == 'on'){
            $fields = array(
            "wo_no"=>$data['wo_no'],
            "po_no"=>$data['po_no'],
            "product_name"=>$data['product_name'],
            "product_id"=>$data['products']['product_id'][0],
            "promised_date"=>$data['promised_date'],
            "po_qty"=>isset($data['po_qty'])?$data['po_qty']:'0',
            "prd_qty"=>$data['prd_qty'],
            "board_qty"=>$data['board_qty'],
            "lot_no"=>$data['lot_no'],
            "print_type"=>$data['print_type'], 
            "print_side"=>'Back Side',           
            "created_date"=>date('Y-m-d H:i:s'),
        );
		$this->Dashboard_model->create_work_order_material_issue($fields);
        }

		redirect("workorder/work_orders_cutting_show");
    }
    public function work_orders_show()
	{
		$template['page'] = 'workorder/work_order_view';
		$template['data'] = $this->db->query("SELECT work_orders_item.*,finished_products.name FROM `work_orders_item` join finished_products on finished_products.id = work_orders_item.product_id  order by work_orders_item.id desc")->result();

		$this->load->view('template', $template);
	}

    public function work_orders_cutting_show()
    {
        $template['page'] = 'workorder/cutting_issue';
		$template['data'] = $this->db->query("SELECT work_order_material_issue.*,work_orders_item.buyer_name FROM `work_order_material_issue` join work_orders_item on work_orders_item.id = work_order_material_issue.wo_no order by work_order_material_issue.id desc")->result();
       
		$this->load->view('template', $template);
    }

    public function work_order_material_issue_completed(){
        $data = $this->input->get();
        if(empty($data)){
            redirect("workorder/work_orders_show");
        }
        $id = $data['wo_no'];
        $template['data'] = $this->db->query("UPDATE work_orders_item SET work_status='Completed' WHERE id='".$id."'");
        redirect("workorder/work_orders_show");
    }
    public function work_order_material_cutting()
	{
        $data = $this->input->get();
        if(empty($data)){
            redirect("workorder/work_orders_show");
        }
        $id = $data['cut_no'];
        $template['page'] = 'workorder/work_order_cutting_form.php';
        $template['data'] = $this->db->query("SELECT work_order_material_issue.*,finished_products.name,work_orders_item.manaer_name FROM `work_order_material_issue` join finished_products on finished_products.id = work_order_material_issue.product_id join work_orders_item on work_orders_item.id = work_order_material_issue.wo_no where work_order_material_issue.id='".$id."'  order by work_order_material_issue.id desc")->result();
        $product_id = isset($template['data'][0]->product_id)?$template['data'][0]->product_id:'';
		$template['data2'] = $this->Dashboard_model->single_record('finished_products',$product_id);
        // $template['data2'] = $this->Dashboard_model->show_table('rawproducts');
        // echo "<pre>";
        // print_r($template);
        // exit;
		$this->load->view('template', $template);
        // exit;
		
	}
    public function work_order_material_cutting_create()
    {
        $data = $this->input->post();
        $fields = array(
            "wo_no"=>$data['wo_no'],
            "po_no"=>$data['po_no'],
            "product_name"=>$data['product_name'],
            "product_id"=>$data['products']['product_id'][0],
            "promised_date"=>$data['promised_date'],
            "po_qty"=>isset($data['po_qty'])?$data['po_qty']:'0',
            "prd_qty"=>$data['prd_qty'],
            "board_qty"=>$data['board_qty'],
            "lot_no"=>$data['lot_no'],
            "print_type"=>$data['print_type'], 
            "print_side"=>'Front Side',
            "created_date"=>date('Y-m-d H:i:s'),
        );
		$this->Dashboard_model->create_work_order_cutting($fields);
        if(isset($data['print_side_back']) && $data['print_side_back'] == 'on'){
            $fields = array(
            "wo_no"=>$data['wo_no'],
            "po_no"=>$data['po_no'],
            "product_name"=>$data['product_name'],
            "product_id"=>$data['products']['product_id'][0],
            "promised_date"=>$data['promised_date'],
            "po_qty"=>isset($data['po_qty'])?$data['po_qty']:'0',
            "prd_qty"=>$data['prd_qty'],
            "board_qty"=>$data['board_qty'],
            "lot_no"=>$data['lot_no'],
            "print_type"=>$data['print_type'], 
            "print_side"=>'Back Side',           
            "created_date"=>date('Y-m-d H:i:s'),
        );
		$this->Dashboard_model->create_work_order_cutting($fields);
        }

		redirect("workorder/work_orders_printing_show");
    }

     public function work_orders_printing_show()
    {
        $template['page'] = 'workorder/printing_issue';
		$template['data'] = $this->db->query("SELECT work_order_material_issue.*,work_orders_item.buyer_name FROM `work_order_material_issue` join work_orders_item on work_orders_item.id = work_order_material_issue.wo_no order by work_order_material_issue.id desc")->result();
       
		$this->load->view('template', $template);
    }
    public function work_order_material_printing()
	{
        $data = $this->input->get();
        if(empty($data)){
            redirect("workorder/work_orders_show");
        }
        $id = $data['wo_no'];
        $template['page'] = 'workorder/work_order_printing_form.php';
        $template['data'] = $this->db->query("SELECT work_orders_item.*,finished_products.name FROM `work_orders_item` join finished_products on finished_products.id = work_orders_item.product_id where work_orders_item.id='".$id."'  order by work_orders_item.id desc")->result();
		// $template['data1'] = $this->Dashboard_model->single_record('work_orders_item',$id);
        $template['data2'] = $this->Dashboard_model->show_table('rawproducts');
        // echo "<pre>";
        // print_r($template);
        // exit;
		$this->load->view('template', $template);
        // exit;
		
	}
    public function work_order_material_printing_create()
    {
        $data = $this->input->post();
        $fields = array(
            "wo_no"=>$data['wo_no'],
            "po_no"=>$data['po_no'],
            "product_name"=>$data['product_name'],
            "product_id"=>$data['products']['product_id'][0],
            "promised_date"=>$data['promised_date'],
            "po_qty"=>isset($data['po_qty'])?$data['po_qty']:'0',
            "prd_qty"=>$data['prd_qty'],
            "board_qty"=>$data['board_qty'],
            "lot_no"=>$data['lot_no'],
            "print_type"=>$data['print_type'], 
            "print_side"=>'Front Side',
            "created_date"=>date('Y-m-d H:i:s'),
        );
		$this->Dashboard_model->create_work_order_printing($fields);
        if(isset($data['print_side_back']) && $data['print_side_back'] == 'on'){
            $fields = array(
            "wo_no"=>$data['wo_no'],
            "po_no"=>$data['po_no'],
            "product_name"=>$data['product_name'],
            "product_id"=>$data['products']['product_id'][0],
            "promised_date"=>$data['promised_date'],
            "po_qty"=>isset($data['po_qty'])?$data['po_qty']:'0',
            "prd_qty"=>$data['prd_qty'],
            "board_qty"=>$data['board_qty'],
            "lot_no"=>$data['lot_no'],
            "print_type"=>$data['print_type'], 
            "print_side"=>'Back Side',           
            "created_date"=>date('Y-m-d H:i:s'),
        );
		$this->Dashboard_model->create_work_order_printing($fields);
        }

		redirect("workorder/work_orders_diecutting_show");
    }
    public function work_orders_diecutting_show()
    {
        $template['page'] = 'workorder/diecutting_issue';
		$template['data'] = $this->db->query("SELECT work_order_material_issue.*,work_orders_item.buyer_name FROM `work_order_material_issue` join work_orders_item on work_orders_item.id = work_order_material_issue.wo_no order by work_order_material_issue.id desc")->result();
       
		$this->load->view('template', $template);
    }
    public function work_order_material_diecutting()
	{
        $data = $this->input->get();
        if(empty($data)){
            redirect("workorder/work_orders_show");
        }
        $id = $data['wo_no'];
        $template['page'] = 'workorder/work_order_diecutting_form.php';
        $template['data'] = $this->db->query("SELECT work_orders_item.*,finished_products.name FROM `work_orders_item` join finished_products on finished_products.id = work_orders_item.product_id where work_orders_item.id='".$id."'  order by work_orders_item.id desc")->result();
		// $template['data1'] = $this->Dashboard_model->single_record('work_orders_item',$id);
        $template['data2'] = $this->Dashboard_model->show_table('rawproducts');
        // echo "<pre>";
        // print_r($template);
        // exit;
		$this->load->view('template', $template);
        // exit;
		
	}
    public function work_order_material_diecutting_create()
    {
        $data = $this->input->post();
        $fields = array(
            "wo_no"=>$data['wo_no'],
            "po_no"=>$data['po_no'],
            "product_name"=>$data['product_name'],
            "product_id"=>$data['products']['product_id'][0],
            "promised_date"=>$data['promised_date'],
            "po_qty"=>isset($data['po_qty'])?$data['po_qty']:'0',
            "prd_qty"=>$data['prd_qty'],
            "board_qty"=>$data['board_qty'],
            "lot_no"=>$data['lot_no'],
            "print_type"=>$data['print_type'], 
            "print_side"=>'Front Side',
            "created_date"=>date('Y-m-d H:i:s'),
        );
		$this->Dashboard_model->create_work_order_diecutting($fields);
        if(isset($data['print_side_back']) && $data['print_side_back'] == 'on'){
            $fields = array(
            "wo_no"=>$data['wo_no'],
            "po_no"=>$data['po_no'],
            "product_name"=>$data['product_name'],
            "product_id"=>$data['products']['product_id'][0],
            "promised_date"=>$data['promised_date'],
            "po_qty"=>isset($data['po_qty'])?$data['po_qty']:'0',
            "prd_qty"=>$data['prd_qty'],
            "board_qty"=>$data['board_qty'],
            "lot_no"=>$data['lot_no'],
            "print_type"=>$data['print_type'], 
            "print_side"=>'Back Side',           
            "created_date"=>date('Y-m-d H:i:s'),
        );
		$this->Dashboard_model->create_work_order_diecutting($fields);
        }

		redirect("workorder/work_orders_printing_show");
    }
}