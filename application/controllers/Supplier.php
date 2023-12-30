<?php
defined('BASEPATH') or exit('No direct script access allowed');

class supplier extends CI_Controller
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

	public function index($table_name)
	{
        if($table_name == 'supplier_store'){
             $data['supplier_name'] = $this
            ->input
            ->post('supplier_name');
        $data['supplier_primaryaddress'] = $this
            ->input
            ->post('supplier_primaryaddress');
        $data['supplier_areaprimary'] = $this
            ->input
            ->post('supplier_areaprimary');
            
        $data['supplier_districtprimary'] = $this
            ->input
            ->post('supplier_districtprimary');
        $data['supplier_stateprimary'] = $this
            ->input
            ->post('supplier_stateprimary');
        // $data['buyer']=$this->input->post('buyer');;
        $data['supplier_pincodeprimary'] = $this
            ->input
            ->post('supplier_pincodeprimary');
        $data['supplier_gst'] = $this
            ->input
            ->post('supplier_gst');
        $data['supplier_contactno1'] = $this
            ->input
            ->post('supplier_contactno1');
        
        $this->Dashboard_model->create_supplier($data);
        redirect(base_url() . "supplier/supplier_show");
            // redirect('supplier/supplier_store');
        }
		$template['page'] = 'supplier/table_view';
		$template['data1'] = $this->Dashboard_model->show_table1($table_name);
		$template['table_name'] = $table_name;
		$this->load->view('template', $template);
	}
	
	public function add_item($table_name)
    {
        $template['page'] = 'supplier/adding_item_form';
        $template['table_name'] = $table_name;
        $this->load->view('template', $template);
    }

	public function create_supplier()
	{
		$template['page'] = 'supplier/create_supplier';

		$this->load->view('template', $template);
	}
    public function supplier_store()
    {

        //$data['name'] = $this
           // ->input
            //->post('raw_name');
                  $data['supplier_name'] = $this
            ->input
            ->post('supplier_name');
        $data['supplier_primaryaddress'] = $this
            ->input
            ->post('supplier_primaryaddress');
        $data['supplier_areaprimary'] = $this
            ->input
            ->post('supplier_areaprimary');
            
        $data['supplier_districtprimary'] = $this
            ->input
            ->post('supplier_districtprimary');
        $data['supplier_stateprimary'] = $this
            ->input
            ->post('supplier_stateprimary');
        $data['supplier_pincodeprimary'] = $this
            ->input
            ->post('supplier_pincodeprimary');
        $data['supplier_gst'] = $this
            ->input
            ->post('supplier_gst');
        $data['supplier_contactno1'] = $this
            ->input
            ->post('supplier_contactno1');
        $this
            ->admin_model
            ->create_supplier($data);
        redirect(base_url() . "supplier/supplier_show");
    }
   
	public function supplier_show()
	{
		$template['page'] = 'supplier/supplier_view';
		$template['data1'] = $this->Dashboard_model->show_table1('supplier');
		$this->load->view('template', $template);
	}

	public function store_item()
    {
        $data['name'] = $this->input->post('name');
        $table_name = $this->input->post('table_name');
        $this->Dashboard_model->store_item($data, $table_name);
        redirect("supplier/" . $table_name);
    }

    public function edit_item($table_name, $id)
    {
        $template['page'] = 'supplier/edit_item';
		$template['table_name'] = $table_name;
        $template['data'] = $this->Dashboard_model->single_record($table_name, $id);
    
        $this->load->view('template', $template);
    }

    public function update_item()
    {
        $id = $this->input->post('item_id');
        $name = $this->input->post('name');
        $table_name = $this->input->post('table_name');
        $this->Dashboard_model->update_item($name, $table_name, $id);
        redirect("supplier/" . $table_name);
    }
    
	public function delete_item($table_name, $id)
    {
        $this->db->where('id', $id);
        $this->db->delete($table_name);
        redirect("supplier/" . $table_name);
    }
}