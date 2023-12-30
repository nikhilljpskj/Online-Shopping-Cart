<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Company extends CI_Controller
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
    $user_id = $this->session->userdata('id');

    
    $view_data['results'] = $this->mcommon->join_records_all(['c.company_id as id', 'c.company_name', 'c.created_date', 'c.phone', 'c.email', 'c.firstname as username'], 'company as c', '', ['c.id' => $this->session->userdata('id')], '', 'c.company_id DESC');

    
    $view_data['page'] = 'masters/company/show';
    $this->load->view('template', $view_data);
}


    public function add()
    {
        if (isset($_POST['submit'])) {

            //Receive Values
            $company_name = $this->input->post('company_name');
            $phone_number = $this->input->post('phone_number');
            $mobile = $this->input->post('mobile');
            $email = $this->input->post('email');
            $gstno = $this->input->post('gstno');
            $panno = $this->input->post('panno');
            $credit_days = $this->input->post('credit_days');
            $payment_mode = $this->input->post('payment_mode');
            $currency = $this->input->post('currency');

            $address_type = $this->input->post('address_type');
            $address1 = $this->input->post('address1');
            $address2 = $this->input->post('address2');
            $city = $this->input->post('city');
            $pincode = $this->input->post('pincode');
            $district = $this->input->post('district');
            $state = $this->input->post('state');
            $country = $this->input->post('country');


            $this->form_validation->set_rules('company_name', 'Company Name', 'required|is_unique[company.company_name]');
            $this->form_validation->set_rules('phone_number', 'Phone Number', 'required');
            $this->form_validation->set_rules('address_type[]', 'Address Type', 'required');
            $this->form_validation->set_rules('address1[]', 'Address1', 'required');
            $this->form_validation->set_rules('address2[]', 'Address2', 'required');
            $this->form_validation->set_rules('pincode[]', 'Pincode', 'required');
            $this->form_validation->set_rules('city[]', 'City', 'required');
            $this->form_validation->set_rules('district[]', 'District', 'required');
            $this->form_validation->set_rules('state[]', 'state', 'required');
            $this->form_validation->set_rules('country[]', 'country', 'required');
            $this->form_validation->set_message('is_unique', 'The %s is already taken. Please choose another one.');

            //check is the validation returns no error
            if ($this->form_validation->run() == true) {
                //prepare insert array
                $customer_data = array(
                    'company_name' => $company_name,
                    'phone' => $phone_number,
                    'created_by' => $this->session->userdata('id'),
                    'status' => '1',
                    'created_date' => date('Y-m-d H:i:s'),
                );
                if(!empty($mobile)){
                    $customer_data['mobile'] = $mobile;
                }
                if(!empty($email)){
                    $customer_data['email'] = $email;
                }
                if(!empty($gstno)){
                    $customer_data['gstno'] = $gstno;
                }
                if(!empty($panno)){
                    $customer_data['panno'] = $panno;
                }
                if(!empty($credit_days)){
                    $customer_data['credit_days'] = $credit_days;
                }
                if(!empty($payment_mode)){
                    $customer_data['payment_mode'] = $payment_mode;
                }
                if(!empty($currency)){
                    $customer_data['currency'] = $currency;
                }
                //insert values in database
                $insert = $this->mcommon->common_insert('company', $customer_data);

                if ($insert > 0) {

                    $count = count($address_type);
                    for ($i = 0; $i < $count; $i++) {
                        $address_data = array(
                            'company_id' => $insert,
                            'address_type' => $address_type[$i],
                            'address1' => $address1[$i],
                            'address2' => $address2[$i],
                            'city' => $city[$i],
                            'state' => $state[$i],
                            'country' => $country[$i],
                            'pincode' => $pincode[$i],
                            'district' => $district[$i],
                            'status' => 1,
                        );
                        $insert_data = $this->mcommon->common_insert('company_address', $address_data);
                    }
                    if ($insert_data > 0) {
                        $this->session->set_flashdata('alert_success', 'Company added successfully!');
						redirect('company');
                    }
                } else {
                    $this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
                }
            }
        }
		$view_data['add'] = true;
		$view_data['form_url'] = 'company/add';
		$view_data['heading'] = 'Add Company';
		$view_data['page'] = 'masters/company/add';
		$this->load->view('template', $view_data);
    }

    public function view($id)
    {
        $view_data['default'] = $this->mcommon->specific_row('company', array('company_id' => $id));
        $view_data['addresses'] = $this->mcommon->records_all('company_address',['company_id' => $id]);

		$view_data['heading'] = 'View Company';
		$view_data['page'] = 'masters/company/view';
		$this->load->view('template', $view_data);
    }

    public function edit($id)
    {
        if (isset($_POST['submit'])) {
            //Receive Values
            $company_name = $this->input->post('company_name');
            $phone_number = $this->input->post('phone_number');
            $mobile = $this->input->post('mobile');
            $email = $this->input->post('email');
            $gstno = $this->input->post('gstno');
            $panno = $this->input->post('panno');
            $credit_days = $this->input->post('credit_days');
            $payment_mode = $this->input->post('payment_mode');
            $currency = $this->input->post('currency');

            $address_type = $this->input->post('address_type');
            $address1 = $this->input->post('address1');
            $address2 = $this->input->post('address2');
            $city = $this->input->post('city');
            $pincode = $this->input->post('pincode');
            $district = $this->input->post('district');
            $state = $this->input->post('state');
            $country = $this->input->post('country');
            $address_id = $this->input->post('address_id');

            if(!$id){
                $this->form_validation->set_rules('company_name', 'Company Name', 'required|is_unique[company.company_name]');
                $this->form_validation->set_message('is_unique', 'The %s is already taken. Please choose another one.');
            }else{
                $this->form_validation->set_rules('company_name', 'Company Name', 'required');
            }
            $this->form_validation->set_rules('phone_number', 'Phone Number', 'required');
            $this->form_validation->set_rules('address_type[]', 'Address Type', 'required');
            $this->form_validation->set_rules('address1[]', 'Address1', 'required');
            $this->form_validation->set_rules('address2[]', 'Address2', 'required');
            $this->form_validation->set_rules('pincode[]', 'Pincode', 'required');
            $this->form_validation->set_rules('city[]', 'City', 'required');
            $this->form_validation->set_rules('district[]', 'District', 'required');
            $this->form_validation->set_rules('state[]', 'state', 'required');
            $this->form_validation->set_rules('country[]', 'country', 'required');

            //check is the validation returns no error
            if ($this->form_validation->run() == true) {
                //prepare insert array
                $customer_data = array(
                    'company_name' => $company_name,
                    'phone' => $phone_number,
                );
                if(!empty($mobile)){
                    $customer_data['mobile'] = $mobile;
                }
                if(!empty($email)){
                    $customer_data['email'] = $email;
                }
                if(!empty($gstno)){
                    $customer_data['gstno'] = $gstno;
                }
                if(!empty($panno)){
                    $customer_data['panno'] = $panno;
                }
                if(!empty($credit_days)){
                    $customer_data['credit_days'] = $credit_days;
                }
                if(!empty($payment_mode)){
                    $customer_data['payment_mode'] = $payment_mode;
                }
                if(!empty($currency)){
                    $customer_data['currency'] = $currency;
                }
                //insert values in database
                $update = $this->mcommon->common_edit('company', $customer_data,['company_id' => $id]);

                if ($update > 0) {

                    $count = count($address_type);
                    for ($i = 0; $i < $count; $i++) {
                        $address_data = array(
                            'address_type' => $address_type[$i],
                            'address1' => $address1[$i],
                            'address2' => $address2[$i],
                            'city' => $city[$i],
                            'state' => $state[$i],
                            'country' => $country[$i],
                            'pincode' => $pincode[$i],
                            'district' => $district[$i],
                            'status' => 1,
                        );
                        $insert_data = $this->mcommon->common_edit('company_address', $address_data,['id' => $address_id[$i]]);
                    }
                    if ($insert_data) {
                        $this->session->set_flashdata('alert_success', 'Company Updated successfully!');
						redirect('company');
                    }
                } else {
                    $this->session->set_flashdata('alert_danger', 'Something went wrong. Please try again later');
                }
            }
        }
        $view_data['default'] = $this->mcommon->specific_row('company', array('company_id' => $id));
        $view_data['addresses'] = $this->mcommon->records_all('company_address',['company_id' => $id]);

        $view_data['add'] = false;
		$view_data['form_url'] = 'company/edit/'.$id;
		$view_data['heading'] = 'Edit Company';
		$view_data['page'] = 'masters/company/add';
		$this->load->view('template', $view_data);
    }


public function saveAddress() {
    if (!$this->input->is_ajax_request()) {
        show_404(); 
    }

    $user_id = $this->session->userdata('id');
    $company_id = $this->session->userdata('company_id');

    if (!$user_id || !$company_id) {
        echo json_encode(['error' => 'User not authenticated']);
        return;
    }

    $addressData = $this->input->post();

    // Check if the same data already exists
    $existingData = $this->db
        ->where('company_id', $company_id)
        ->get('company_address')
        ->result_array();

    // Delete existing rows with the same company_id
    $this->db->where('company_id', $company_id)->delete('company_address');

    foreach ($addressData['address_type'] as $key => &$type) {
        $newAddress = [
            'company_id' => $company_id,
            'address_type' => $type,
            'address1' => $addressData['address1'][$key],
            'address2' => $addressData['address2'][$key],
            'city' => $addressData['city'][$key],
            'district' => $addressData['district'][$key],
            'state' => $addressData['state'][$key],
            'pincode' => $addressData['pincode'][$key],
            'country' => $addressData['country'][$key],
            'status' => 1,
        ];

        // Insert new data
        $this->db->insert('company_address', $newAddress);
    }

    echo json_encode(['success' => 'Data saved successfully']);
}










}
