<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Rawmaterial extends CI_Controller
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
        if($table_name == 'raw_material_store'){
             $data['board'] = $this
            ->input
            ->post('board');
        $data['brand'] = $this
            ->input
            ->post('brand');
        $data['gsm'] = $this
            ->input
            ->post('gsm');
            
        $data['type'] = $this
            ->input
            ->post('type');
        $data['colour'] = $this
            ->input
            ->post('colour');
        // $data['buyer']=$this->input->post('buyer');;
        $data['uom'] = $this
            ->input
            ->post('uom');
        $data['linch'] = $this
            ->input
            ->post('linch');
        $data['binch'] = $this
            ->input
            ->post('binch');
        $data['lmm'] = $this
            ->input
            ->post('lmm');
        $data['bmm'] = $this
            ->input
            ->post('bmm');
        $data['material'] = $data['gsm'] . " GSM " . $data['brand']  . $data['board'] . $data['lmm'] . " mm X " . $data['bmm'] . " mm";

        $this->Dashboard_model->create_raw_material($data);
        redirect(base_url() . "rawmaterial/raw_material_show");
            // redirect('rawmaterial/raw_material_store');
        }
		$template['page'] = 'rawmaterial/table_view';
		$template['data1'] = $this->Dashboard_model->show_table($table_name);
		$template['table_name'] = $table_name;
		$this->load->view('template', $template);
	}
	
	public function add_item($table_name)
    {
        $template['page'] = 'rawmaterial/adding_item_form';
        $template['table_name'] = $table_name;
        $this->load->view('template', $template);
    }

	public function create_raw_material()
	{
		$template['page'] = 'rawmaterial/create_raw_material';
		$template['data1'] = $this->Dashboard_model->show_table('board');
		$template['data2'] = $this->Dashboard_model->show_table('gsm');
		$template['data3'] = $this->Dashboard_model->show_table('colour');
		$template['data4'] = $this->Dashboard_model->show_table('type');
		$template['data5'] = $this->Dashboard_model->show_table('brand');

		$this->load->view('template', $template);
	}
    public function raw_material_store()
    {

        //$data['name'] = $this
           // ->input
            //->post('raw_name');
        $data['board'] = $this
            ->input
            ->post('board');
        $data['brand'] = $this
            ->input
            ->post('brand');
        $data['gsm'] = $this
            ->input
            ->post('gsm');
        $data['type'] = $this
            ->input
            ->post('type');
        $data['colour'] = $this
            ->input
            ->post('colour');
        // $data['buyer']=$this->input->post('buyer');;
        $data['uom'] = $this
            ->input
            ->post('uom');
        $data['linch'] = $this
            ->input
            ->post('linch');
        $data['binch'] = $this
            ->input
            ->post('binch');
        $data['lmm'] = $this
            ->input
            ->post('lmm');
        $data['bmm'] = $this
            ->input
            ->post('bmm');
        $data['material'] = $data['gsm'] . " GSM " . $data['brand']  . $data['lmm'] . " mm X " . $data['bmm'] . " mm";

        $this
            ->admin_model
            ->create_raw_material($data);
        redirect(base_url() . "rawmaterial/raw_material_show");
    }
   
	public function raw_material_show()
	{
		$template['page'] = 'rawmaterial/raw_material_view';
		$template['data1'] = $this->Dashboard_model->show_table('rawproducts');
		$this->load->view('template', $template);
	}

	public function store_item()
    {
        $data['name'] = $this->input->post('name');
        $table_name = $this->input->post('table_name');
        $this->Dashboard_model->store_item($data, $table_name);
        redirect("rawmaterial/" . $table_name);
    }

    public function edit_item($table_name, $id)
    {
        $template['page'] = 'rawmaterial/edit_item';
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
        redirect("rawmaterial/" . $table_name);
    }
    
	public function delete_item($table_name, $id)
    {
        $this->db->where('id', $id);
        $this->db->delete($table_name);
        redirect("rawmaterial/" . $table_name);
    }
}
