<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Brand extends CI_Controller
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
		
		$view_data['brands_data'] = $this->mcommon->records_all('brand1','','brand_id DESC');

		$view_data['page'] = 'masters/brand/show';
		$this->load->view('template', $view_data);
	}

	public function add()
	{
		if (isset($_POST['submit'])) {
			//Receive Values
			$brand_name = $this->input->post('brand_name');

			$this->form_validation->set_rules('brand_name', 'Brand Name', 'required');

			//check is the validation returns no error
			if ($this->form_validation->run() == TRUE) {

				//prepare insert array
				$insert_array = array(

					'brand_name' => $brand_name,
					'status' => '1',
					'created_by' => $this->session->userdata('id'),
				);
				//insert values in database
				$insert = $this->mcommon->common_insert('brand1', $insert_array);

				if ($insert > 0) {

					$this->session->set_flashdata('alert_success', 'Brand Added Successfully!');
					redirect('brand');
				} else {
					$this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
				}
			}
		}

		$view_data['add'] = true;
		$view_data['form_url'] = 'brand/add';
		$view_data['heading'] = 'Add Brand';
		$view_data['page'] = 'masters/brand/add';
		$this->load->view('template', $view_data);
	}
	public function edit($id)
	{

		if (isset($_POST['submit'])) {
			//Receive Values

			$brand_name = $this->input->post('brand_name');
			$status = $this->input->post('status');

			$this->form_validation->set_rules('brand_name', 'Brand Name', 'required');

			//check is the validation returns no error
			if ($this->form_validation->run() == TRUE) {

				$update_array = array(
					'brand_name' => $brand_name,
					'status' => $status,
					'updated_date' => date('Y-m-d'),
					'updated_by' => $this->session->userdata('id'),
				);

				//Update values in database
				$update = $this->mcommon->common_edit('brand1', $update_array, array('brand_id' => $id));

				if ($update) {
					$this->session->set_flashdata('alert_success', 'Brand Updated Successfully!');
					redirect('brand');
				} else {
					$this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
				}
			}
		}

		$view_data['default'] = $this->mcommon->specific_row('brand1', array('brand_id' => $id));

		$view_data['add'] = false;
		$view_data['form_url'] = 'brand/edit/'.$id;
		$view_data['heading'] = 'Edit Brand';
		$view_data['page'] = 'masters/brand/add';
		$this->load->view('template', $view_data);
	}

	public function delete($id)
	{
		$current_status = $this->mcommon->specific_row_value('brand', array('brand_id' => $id), 'status');
		$change_status = ($current_status == 1) ? 0 : 1;
		$delete = $this->mcommon->common_edit('brand', array('status' => $change_status), array('brand_id' => $id));

		return $delete;
	}
}
