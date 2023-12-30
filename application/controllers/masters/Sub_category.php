<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sub_category extends CI_Controller
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

		$view_data['sc_datas'] = $this->mcommon->join_records_all(['s.id As id, s.status, c.category_name, s.sub_category_name'], 'sub_category as s', ['category as c' => 's.category_id=c.id'], '', '', 's.id DESC');
		
		$view_data['page'] = 'masters/sub_category/show';
		$this->load->view('template', $view_data);
	}

	public function add()
	{
		if (isset($_POST['submit'])) {
			//Receive Values

			$category_id = $this->input->post('category_id');
			$sub_category_name = $this->input->post('sub_category_name');

			$this->form_validation->set_rules('category_id', ' Category Name', 'required');
			$this->form_validation->set_rules('sub_category_name', 'Sub Category Name', 'required');
			if ($this->form_validation->run() == TRUE) {

				//prepare insert array
				$insert_array = array(
					'category_id' => $category_id,
					'sub_category_name' => $sub_category_name,
					'status' => '1',
					'created_by' => $this->session->userdata('id'),
					'updated_by' => $this->session->userdata('id'),
				);
				//insert values in database
				$insert = $this->mcommon->common_insert('sub_category', $insert_array);

				if ($insert > 0) {
					$this->session->set_flashdata('alert_success', 'Sub Category added successfully!');
					redirect('sub_category');
				} else {
					$this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
				}
			}
		}
		$view_data['category'] = $this->mcommon->join_records_all(['c.id,c.category_name,b.brand_name'], 'category AS c', ['brand1 as b' => 'b.brand_id=c.brand_id'], array('c.status' => 1), '', 'c.category_name ASC');

		$view_data['add'] = true;
		$view_data['form_url'] = 'sub_category/add';
		$view_data['heading'] = 'Add Sub Category';
		$view_data['page'] = 'masters/sub_category/add';
		$this->load->view('template', $view_data);
	}
	public function edit($id)
	{

		if (isset($_POST['submit'])) {
			//Receive Values
			$category_id = $this->input->post('category_id');
			$sub_category_name = $this->input->post('sub_category_name');
			$status = $this->input->post('status');

			$this->form_validation->set_rules('category_id', ' Category Name', 'required');
			$this->form_validation->set_rules('sub_category_name', 'Sub Category Name', 'required');

			//check is the validation returns no error
			if ($this->form_validation->run() == TRUE) {
				$insert_array = array(
					'category_id' => $category_id,
					'sub_category_name' => $sub_category_name,
					'status' => $status,
					'updated_by' => $this->session->userdata('id'),

				);
				$update = $this->mcommon->common_edit('sub_category', $insert_array, array('id' => $id));

				if ($update) {
					$this->session->set_flashdata('alert_success', 'Sub Category updated successfully!');
					redirect('sub_category');
				} else {
					$this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
				}
			}
		}

		$view_data['default'] = $this->mcommon->specific_row('sub_category', array('id' => $id));
		$view_data['category'] = $this->mcommon->join_records_all(['c.id,c.category_name,b.brand_name'], 'category AS c', ['brand1 as b' => 'b.brand_id=c.brand_id'], array('c.status' => 1), '', 'c.category_name ASC');
		
		$view_data['add'] = false;
		$view_data['form_url'] = 'sub_category/edit/'.$id;
		$view_data['heading'] = 'Edit Sub Category';
		$view_data['page'] = 'masters/sub_category/add';
		$this->load->view('template', $view_data);
	}

	public function delete($id)
	{
		$current_status = $this->mcommon->specific_row_value('sub_category', array('id' => $id), 'status');
		$change_status = ($current_status == 1) ? 0 : 1;
		$delete = $this->mcommon->common_edit('sub_category', array('status' => $change_status), array('id' => $id));

		return $delete;
	}
}
