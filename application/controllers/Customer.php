<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends CI_Controller
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
        if($table_name == 'customer_store'){
             $data['customer_name'] = $this
            ->input
            ->post('customer_name');
        $data['customer_primaryaddress'] = $this
            ->input
            ->post('customer_primaryaddress');
        $data['customer_areaprimary'] = $this
            ->input
            ->post('customer_areaprimary');
            
        $data['customer_districtprimary'] = $this
            ->input
            ->post('customer_districtprimary');
        $data['customer_stateprimary'] = $this
            ->input
            ->post('customer_stateprimary');
        // $data['buyer']=$this->input->post('buyer');;
        $data['customer_pincodeprimary'] = $this
            ->input
            ->post('customer_pincodeprimary');
        $data['customer_gst'] = $this
            ->input
            ->post('customer_gst');
        $data['customer_contactno1'] = $this
            ->input
            ->post('customer_contactno1');
        
        $this->Dashboard_model->create_customer($data);
        redirect(base_url() . "customer/customer_show");
            // redirect('customer/customer_store');
        }
		$template['page'] = 'customer/table_view';
		$template['data1'] = $this->Dashboard_model->show_table1($table_name);
		$template['table_name'] = $table_name;
		$this->load->view('template', $template);
	}
	
	public function add_item($table_name)
    {
        $template['page'] = 'customer/adding_item_form';
        $template['table_name'] = $table_name;
        $this->load->view('template', $template);
    }

	public function create_customer()
	{
		$template['page'] = 'customer/create_customer';

		$this->load->view('template', $template);
	}
    public function customer_store()
    {

        //$data['name'] = $this
           // ->input
            //->post('raw_name');
                  $data['customer_name'] = $this
            ->input
            ->post('customer_name');
        $data['customer_primaryaddress'] = $this
            ->input
            ->post('customer_primaryaddress');
        $data['customer_areaprimary'] = $this
            ->input
            ->post('customer_areaprimary');
            
        $data['customer_districtprimary'] = $this
            ->input
            ->post('customer_districtprimary');
        $data['customer_stateprimary'] = $this
            ->input
            ->post('customer_stateprimary');
        $data['customer_pincodeprimary'] = $this
            ->input
            ->post('customer_pincodeprimary');
        $data['customer_gst'] = $this
            ->input
            ->post('customer_gst');
        $data['customer_contactno1'] = $this
            ->input
            ->post('customer_contactno1');
        $this->Dashboard_model->create_customer($data);
        redirect(base_url() . "customer/customer_show");
    }
   
	public function customer_show()
	{
		$template['page'] = 'customer/customer_view';
		$template['data1'] = $this->Dashboard_model->show_table1('customer');
		$this->load->view('template', $template);
	}

	public function store_item()
    {
        $data['name'] = $this->input->post('name');
        $table_name = $this->input->post('table_name');
        $this->Dashboard_model->store_item($data, $table_name);
        redirect("customer/" . $table_name);
    }

    public function edit_item($table_name, $id)
    {
        $template['page'] = 'customer/edit_item';
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
        redirect("customer/" . $table_name);
    }
    
	public function delete_item($table_name, $id)
    {
        $this->db->where('id', $id);
        $this->db->delete($table_name);
        redirect("customer/" . $table_name);
    }
}