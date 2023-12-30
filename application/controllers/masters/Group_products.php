<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Group_products extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Common_model');
        if (!$this->session->userdata('authenticated')) {
			redirect('login');
			session_destroy();
		}
    }

    public function index()
    {


		$view_data['results'] = $this->mcommon->records_all('group_products','','id DESC');
        $view_data['product'] = $this->mcommon->records_all('products_details');
		
		$view_data['page'] = 'masters/group_products/show';
		$this->load->view('template', $view_data);
    }



    public function add()
    {
        if (isset($_POST['submit'])) {
            //Receive Values
            $group_name = $this->input->post('group_name');
            $group_desc = $this->input->post('group_desc');
            $pro_details_ids = $this->input->post('pro_details_ids');

            $this->form_validation->set_rules('group_name', 'Group Name', 'required');
            $this->form_validation->set_rules('pro_details_ids[]', 'Products', 'required');
            //check is the validation returns no error
            if ($this->form_validation->run() == TRUE) {

                //prepare insert array
                $insert_array = array(

                    'group_name' => $group_name,
                    'group_desc' => $group_desc,
                    'pro_details_ids' => implode(',', $pro_details_ids),
                    'status' => '1',
                    'created_by' => $this->session->userdata('id'),
                    'created_date' => date('Y-m-d H:i:s'),
                );

                //insert values in database
                $insert = $this->mcommon->common_insert('group_products', $insert_array);

                if ($insert > 0) {
                    $this->session->set_flashdata('alert_success', 'Group products added successfully!');
                    redirect('groupProducts');
                } else {
                    $this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
                }
            }
        }
        $view_data['products'] = $this->mcommon->join_records_all(['pd.variation_name', 'p.product_name', 'pd.pro_details_id AS variation_id'], 'products_details AS pd', ['products AS p' => 'p.pro_id = pd.product_id'], ['is_active' => '1'], '', 'pd.variation_name ASC');

		$view_data['add'] = true;
		$view_data['form_url'] = 'groupProducts/add';
		$view_data['heading'] = 'Add Group products';
		$view_data['page'] = 'masters/group_products/add';
		$this->load->view('template', $view_data);
    }
    public function edit($id)
    {

        if (isset($_POST['submit'])) {
            //Receive Values

            $group_name = $this->input->post('group_name');
            $pro_details_ids = $this->input->post('pro_details_ids');
            $status = $this->input->post('status');

            $this->form_validation->set_rules('group_name', 'Group Name', 'required');
            $this->form_validation->set_rules('pro_details_ids[]', 'Product Variation', 'required');

            //check is the validation returns no error
            if ($this->form_validation->run() == TRUE) {

                $update_array = array(

                    'group_name' => $group_name,
                    'group_desc' => $group_desc,
                    'pro_details_ids' => implode(',', $pro_details_ids),
                    'status' => $status,
                    'updated_by' => $this->session->userdata('id'),
                    'updated_date' => date('Y-m-d'),
                );

                //insert values in database
                $update = $this->mcommon->common_edit('group_products', $update_array, array('id' => $id));

                if ($update) {
                    $this->session->set_flashdata('alert_success', 'Group products updated successfully!');
                    redirect('groupProducts');
                } else {
                    $this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
                }
            }
        }

        $view_data['default'] = $this->mcommon->specific_row('group_products', array('id' => $id));
        $view_data['products'] = $this->mcommon->join_records_all(['pd.variation_name', 'p.product_name', 'pd.pro_details_id AS variation_id'], 'products_details AS pd', ['products AS p' => 'p.pro_id = pd.product_id'], ['is_active' => '1'], '', 'pd.variation_name ASC');

		$view_data['add'] = false;
		$view_data['form_url'] = 'groupProducts/edit/'.$id;
		$view_data['heading'] = 'Edit Group Products';
		$view_data['page'] = 'masters/group_products/add';
		$this->load->view('template', $view_data);
    }

    public function delete($id)
    {
        $current_status = $this->mcommon->specific_row_value('group_products', array('id' => $id), 'status');
        $change_status = ($current_status == 1) ? 0 : 1;
        $delete = $this->mcommon->common_edit('group_products', array('status' => $change_status), array('id' => $id));

        return $delete;
    }


public function movetocart()
{
    $group_data = $this->Common_model->specific_row('group_products', array('group_name' => $_POST['groupName']));
    $pro_details_ids = explode(',', $group_data['pro_details_ids']);

    // Fetch product details based on pro_details_ids
    $products_details = $this->Common_model->get_records('products_details', $pro_details_ids);

    // Prepare data for the cart
    $cart_data = array();
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;
    

    foreach ($products_details as $product) {
        $cart_data = array(
            'user_id' => $this->session->userdata('id'),
            'variation_id' => $product['pro_details_id'],
            'qty' => $quantity,
            'group_name' => $_POST['groupName'],
        );
        //var_dump($cart_data);
        $insert_id = $this->mcommon->common_insert('cart', $cart_data);
    }


    echo json_encode("success");
}


public function fetchProducts()
{
    // Retrieve products based on groupCode (sent via AJAX)
    $groupCname = trim($this->input->post('groupCname'));

    // Get company_id from the session
    $companyId = $this->session->userdata('company_id');

    $products = $this->mcommon->fetchProductsByGroupCode($groupCname, $companyId);

    echo json_encode($products);
}





}
