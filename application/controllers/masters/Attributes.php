<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Attributes extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
		if (!$this->session->userdata('authenticated')) {
			redirect('login');
			session_destroy();
		}
    }

    public function index()
    {

		$view_data['attributes_data'] = $this->mcommon->join_records_all(['a.id AS id, a.status, a.attributes_name, sc.sub_category_name'], 'attributes AS a', ['sub_category as sc' => 'sc.id=a.sub_category_id'], '', '', 'a.id DESC');

		$view_data['page'] = 'masters/attributes/show';
		$this->load->view('template', $view_data);
    }

    public function add()
    {
        if (isset($_POST['submit'])) {
            //Receive Values
            $attributes_name = $this->input->post('attributes_name');
            $sub_category_id = $this->input->post('sub_category_id');

            $this->form_validation->set_rules('sub_category_id', 'Sub Category ', 'required');
            $this->form_validation->set_rules('attributes_name', 'Attributes Name', 'required');

            //check is the validation returns no error
            if ($this->form_validation->run() == TRUE) {
                //prepare insert array
                $insert_array = array(
                    'sub_category_id' => $sub_category_id,  
                    'attributes_name' => $attributes_name,
                    'status' => '1',
                    'created_by' => $this->session->userdata('id'),
                    'updated_by' => $this->session->userdata('id'),

                );
                var_dump($insert_array);

                //insert values in database
                $insert = $this->mcommon->common_insert('attributes', $insert_array);

                if ($insert > 0) {
                    $this->session->set_flashdata('alert_success', 'Attribute added successfully!');
                    redirect('attributes');
                } else {
                    $this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
                }
            }
        }
        $view_data['sub_category'] = $this->mcommon->join_records_all(['sc.id AS id, sc.sub_category_name as sc_name, c.category_name,b.brand_name'], 'sub_category AS sc', ['category as c' => 'c.id=sc.category_id','brand1 as b' => 'b.brand_id=c.brand_id'], array('sc.status' => 1), '', 'sc.sub_category_name ASC');

        $view_data['add'] = true;
		$view_data['form_url'] = 'attributes/add';
		$view_data['heading'] = 'Add Sub Category';
		$view_data['page'] = 'masters/attributes/add';
		$this->load->view('template', $view_data);
    }
    public function edit($id)
    {
        if (isset($_POST['submit'])) {
            //Receive Values

            $attributes_name = $this->input->post('attributes_name');
            $sub_category_id = $this->input->post('sub_category_id');
            $status = $this->input->post('status');

            $this->form_validation->set_rules('sub_category_id', 'Sub Category', 'required');
            $this->form_validation->set_rules('attributes_name', 'attribute Name', 'required');

            //check is the validation returns no error
            if ($this->form_validation->run() == TRUE) {
                $update_array = array(

                    'sub_category_id' => $sub_category_id,
                    'attributes_name' => $attributes_name,
                    'status' => $status,
                    'updated_by' => $this->session->userdata('id'),

                );

                //insert values in database
                $update = $this->mcommon->common_edit('attributes', $update_array, array('id' => $id));

                if ($update) {
                    $this->session->set_flashdata('alert_success', 'Attribute updated successfully!');
					redirect('attributes');
                } else {
                    $this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
                }
            }
        }

        $view_data['default'] = $this->mcommon->specific_row('attributes', array('id' => $id));
        $view_data['sub_category'] = $this->mcommon->join_records_all(['sc.id AS id, sc.sub_category_name as sc_name, c.category_name,b.brand_name'], 'sub_category AS sc', ['category as c' => 'c.id=sc.category_id','brand1 as b' => 'b.brand_id=c.brand_id'], array('sc.status' => 1), '', 'sc.sub_category_name ASC');

		$view_data['add'] = false;
		$view_data['form_url'] = 'attributes/edit/'.$id;
		$view_data['heading'] = 'Edit Attributes';
		$view_data['page'] = 'masters/attributes/add';
		$this->load->view('template', $view_data);
    }

    public function delete($id)
    {

        $current_status = $this->mcommon->specific_row_value('attributes', array('id' => $id), 'status');
        $change_status = ($current_status == 1) ? 0 : 1;
        $delete = $this->mcommon->common_edit('attributes', array('status' => $change_status), array('id' => $id));

        return $delete;
    }
}
