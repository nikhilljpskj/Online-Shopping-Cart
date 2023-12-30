<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category extends CI_Controller
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
		$view_data['category_datas'] = $this->mcommon->join_records_all(['c.id As id, c.status, c.category_name, b.brand_name'],'category AS c',['brand1 AS b'=>'b.brand_id=c.brand_id'],'','','c.id DESC');

		$view_data['page'] = 'masters/category/show';
		$this->load->view('template', $view_data);
		
	}

	public function add()
	{
		if (isset($_POST['submit'])) {
			//Receive Values
		
			$category_name = $this->input->post('category_name');
			$brand_id = $this->input->post('brand_id');

			$this->form_validation->set_rules('brand_id', 'Brand Name', 'required');
			$this->form_validation->set_rules('category_name', 'Category Name', 'required');

			//check is the validation returns no error
			if ($this->form_validation->run() == TRUE) {
				
				//prepare insert array
				$insert_array = array(

					'category_name' => $category_name,
					'brand_id' => $brand_id,
					'status' => '1',
					'created_by' => $this->session->userdata('id'),
					'updated_by' => $this->session->userdata('id'),
				);
				
				//insert values in database
				$insert = $this->mcommon->common_insert('category', $insert_array);

				if ($insert > 0) {
					$this->session->set_flashdata('alert_success', 'Category added successfully!');
					redirect('category');
				} else {
					$this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
				}
			}
		}
		$view_data['brandlists'] = $this->mcommon->records_all('brand1', array('status' => '1'), 'brand_name ASC');
		
		$view_data['add'] = true;
		$view_data['form_url'] = 'category/add';
		$view_data['heading'] = 'Add Category';
		$view_data['page'] = 'masters/category/add';
		$this->load->view('template', $view_data);
	}
	public function edit($id)
	{

		if (isset($_POST['submit'])) {
			//Receive Values

			$category_name = $this->input->post('category_name');
			$brand_id = $this->input->post('brand_id');
			$status = $this->input->post('status');

			$this->form_validation->set_rules('category_name', 'category name', 'required');
			$this->form_validation->set_rules('brand_id', 'Brand name', 'required');

			//check is the validation returns no error
			if ($this->form_validation->run() == TRUE) {
				
					$update_array = array(
						'brand_id' => $brand_id,
						'category_name' => $category_name,
						'status' => $status,
						'updated_by' => $this->session->userdata('id'),
					);

					//insert values in database
					$update = $this->mcommon->common_edit('category', $update_array, array('id' => $id));

					if ($update) {
						$this->session->set_flashdata('alert_success', 'Category updated successfully!');
						redirect('category');
					} else {
						$this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
					}
			}
		}

		$view_data['default'] = $this->mcommon->specific_row('category', array('id' => $id));		
		$view_data['brandlists'] = $this->mcommon->records_all('brand1', array('status' => '1'), 'brand_name ASC');
		
		$view_data['add'] = false;
		$view_data['form_url'] = 'category/edit/'.$id;
		$view_data['heading'] = 'Edit Category';
		$view_data['page'] = 'masters/category/add';
		$this->load->view('template', $view_data);
	}
	
	public function delete($id)
	{
		$current_status = $this->mcommon->specific_row_value('category', array('id' => $id), 'status');
		$change_status = ($current_status == 1) ? 0 : 1;
		$delete = $this->mcommon->common_edit('category', array('status' => $change_status), array('id' => $id));

		return $delete;
	}
}
