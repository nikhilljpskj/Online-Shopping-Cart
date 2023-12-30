<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Finished extends CI_Controller
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
		$template['page'] = 'finished/table_view';
        $template['data1'] = $this->Dashboard_model->show_table($table_name);
        $template['table_name'] = $table_name;
        $this->load->view('template', $template);
	}

	public function finished_product_show()
    {
        $template['page'] = 'finished/finished_product_view';
		$template['data1'] = $this->Dashboard_model->show_table('finished_products');
        
        $this->load->view('template', $template);
    }
    public function create_finished_product()
    {
		$template['page'] = 'finished/create_finished_product';
        $template['board'] = $this->Dashboard_model->show_table1('board');
        $template['brand'] = $this->Dashboard_model->show_table1('brand');
        $template['gsm'] = $this->Dashboard_model->show_table('gsm');
       $template['process_stages'] = $this->Dashboard_model->show_table1('process_stages');
        $template['type'] = $this->Dashboard_model->show_table1('type');
        $template['buyer'] = $this->Dashboard_model->show_table1('buyer');
        $template['categories'] = $this->Dashboard_model->show_table('categories');
       $template['media'] = $this->Dashboard_model->show_table1('media');
        $template['machines'] = $this->Dashboard_model->show_table1('machines');
        $template['process_desc'] = $this->Dashboard_model->show_table1('process_desc');
        $template['rawproducts'] = $this->Dashboard_model->show_table1('rawproducts');
        
        $this->load->view('template', $template);
    }

public function finished_product_store()
	{
		$data['name']=$this->input->post('f_name');
		$data['description']=$this->input->post('desc');
		$data['frontgsm']=$this->input->post('f_gsm');
		$data['backgsm']=$this->input->post('b_gsm');
		$data['board']=$this->input->post('board');
		$data['buyer']=$this->input->post('buyer');
		$data['type']=$this->input->post('type');
		$data['category']=$this->input->post('category');
		$data['media_id']=$this->input->post('photo');
		$data['stage1']=$this->input->post('stage1').",".$this->input->post('process_stages1').",".$this->input->post('desc_1');
		// implode(",", $this->input->post('oids'));
		$data['stage2']=$this->input->post('stage2').",".$this->input->post('process_stages2').",".$this->input->post('desc_2');
		$data['stage3']=$this->input->post('stage3').",".$this->input->post('process_stages3').",".$this->input->post('desc_3');
		$data['stage4']=$this->input->post('stage4').",".$this->input->post('process_stages4').",".$this->input->post('desc_4');
		$data['stage5']=$this->input->post('stage5').",".$this->input->post('process_stages5').",".$this->input->post('desc_5');
		$data['stage6']=$this->input->post('stage6').",".$this->input->post('process_stages6').",".$this->input->post('desc_6');
		$data['stage7']=$this->input->post('stage7').",".$this->input->post('process_stages7').",".$this->input->post('desc_7');
		$data['stage8']=$this->input->post('stage8').",".$this->input->post('process_stages8').",".$this->input->post('desc_8');
		$data['stage9']=$this->input->post('stage9').",".$this->input->post('process_stages9').",".$this->input->post('desc_9');
		$data['stage10']=$this->input->post('stage10').",".$this->input->post('process_stages10').",".$this->input->post('desc_10');

		$this->admin_model->create_finished_product($data);
		redirect(base_url()."finished/finished_product_show");
	}

	public function store_item()
    {
        $data['name'] = $this->input->post('name');        
        $table_name = $this->input->post('table_name');
        if($table_name == 'machines'){
            $data['category'] = $this->input->post('category');
        }
        if($table_name == 'consumables'){
            $data['category'] = $this->input->post('category');
        }
        if($table_name == 'accessories'){
            $data['category'] = $this->input->post('category');
        }
        $this->Dashboard_model->store_item($data, $table_name);
        redirect("finished/" . $table_name);
    }

	public function add_item($table_name)
    {
        $template['page'] = 'finished/adding_item_form';
        $template['table_name'] = $table_name;
        $this->load->view('template', $template);
    }


    public function edit_item($table_name, $id)
    {
        $template['page'] = 'finished/edit_item';
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
        redirect("finished/" . $table_name);
    }
    
	public function delete_item($table_name, $id)
    {
        $this->db->where('id', $id);
        $this->db->delete($table_name);
        redirect("finished/" . $table_name);
    }
}