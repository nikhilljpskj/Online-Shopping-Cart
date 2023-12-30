<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller
{
    public function index()
    {
        $this->load->view('register');
    }

public function save()
{
    $email = $this->input->post('email');
    $existingEmailCount = $this->checkExistingEmail($email);

    if ($existingEmailCount > 0) {
        $this->handleExistingEmailError();
    } else {
         
        $this->proceedWithRegistration();
         
    }
}




private function checkExistingEmail($email)
{
    $this->db->where('email', $email);
    return $this->db->count_all_results('company');
}


    private function handleExistingEmailError()
    {
        echo json_encode(array('status' => 'error', 'message' => 'An account already exists with this email address.'));
    }


    private function getMaxCompanyID()
{
    $this->db->select_max('company_id');
    $result = $this->db->get('company')->row();
    return $result ? $result->company_id : null;
}

private function proceedWithRegistration()
{
    
    $maxCompanyID = $this->getMaxCompanyID();
    $companyID = $maxCompanyID ? $maxCompanyID + 1 : 1;

    
    $companyData = array(
        'company_id' => $companyID,
        'salutation' => $this->input->post('salutation'),
        'firstname' => $this->input->post('firstname'),
        'lastname' => $this->input->post('lastname'),
        'company_name' => $this->input->post('company'),
        'phone' => $this->input->post('phone'),
        'mobile' => $this->input->post('mobile'),
        'email' => $this->input->post('email'),
        'password' => hash('sha256', $this->input->post('password')), // Use SHA-256
        'department' => $this->input->post('department'),
        'vat_id' => $this->input->post('vat_id'),
        'contact_sales' => $this->input->post('contact_sales'),
        'contact_accounting' => $this->input->post('contact_accounting'),
        'email_accounting' => $this->input->post('email_accounting'),
        'fax_no' => $this->input->post('fax_number'),
        'website' => $this->input->post('website'),
        'shipping_method' => $this->input->post('shipping_method'),
        'account_number' => $this->input->post('account_number')
    );
    

    // Billing Address data
    $billingAddressData = array(
        'address_type' => 'Billing Address',
        'address1' => $this->input->post('billing_address')['address1'],
        'address2' => $this->input->post('billing_address')['address2'],
        'city' => $this->input->post('billing_address')['city'],
        'district' => $this->input->post('billing_address')['district'],
        'company_id' => $companyID, // Add company_id to link billing address to the company
        'status' => 1
    );

    // Shipping Address data
    $shippingAddressData = array(
        'address_type' => 'Shipping Address',
        'address1' => $this->input->post('shipping_address')['address1'],
        'address2' => $this->input->post('shipping_address')['address2'],
        'city' => $this->input->post('shipping_address')['city'],
        'district' => $this->input->post('shipping_address')['district'],
        'company_id' => $companyID, // Add company_id to link shipping address to the company
        'status' => 1
    );

    // Save data to database
    $this->saveCompanyAndAddressToDatabase($companyData, $billingAddressData, $shippingAddressData);

    // Set registration success
    $this->setRegistrationSuccess();
}


private function saveCompanyAndAddressToDatabase($companyData, $billingAddressData, $shippingAddressData)
{
    
    $this->db->trans_start(); // Start transaction

    // Insert into company table
    $this->db->insert('company', $companyData);

    // Insert into company_address table for billing address
    $this->db->insert('company_address', $billingAddressData);

    // Insert into company_address table for shipping address
    $this->db->insert('company_address', $shippingAddressData);

    $this->db->trans_complete(); // Complete transaction

    if ($this->db->trans_status() === FALSE) {
        // If transaction failed, handle the error
        $this->handleDatabaseError();
    }
}

private function handleDatabaseError()
{
    echo json_encode(array('status' => 'error', 'message' => 'Registration failed. Please try again.'));
}

    private function setRegistrationSuccess()
    {
        echo json_encode(array('status' => 'success', 'message' => 'Thank you for registering with us.'));
    }
}
