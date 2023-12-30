<?php

class CustomerController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Load necessary models and libraries
        $this->load->model('Customer_model'); // Replace 'Customer_model' with your actual model name
        $this->load->library('session');
    }
public function create_customer()
{
    // Load the create_customer view
    $this->load->view('customer/create_customer');
}

public function customer_store()
{
    // Validate form data (you can use CI form validation library)
    $this->form_validation->set_rules('firstname', 'First Name', 'required');
    $this->form_validation->set_rules('lastname', 'Last Name', 'required');
    // Add similar rules for other form fields

    if ($this->form_validation->run() == FALSE) {
        // If validation fails, reload the create_customer view with validation errors
        $this->load->view('customer/create_customer');
    } else {
        // If validation passes, handle form submission and store data in the database
        $data = array(
            'firstname' => $this->input->post('firstname'),
            'lastname' => $this->input->post('lastname'),
            // Add similar lines for other form fields
        );

        // You need to replace 'Your_model' with your actual model name
        $this->Your_model->store_customer_data($data);

        // Redirect to the create_customer page after storing data
        redirect('customer/create_customer');
    }
}


    public function update_profile()
{
    // Get user details based on the logged-in user's company_id
    $company_id = $this->session->userdata('company_id'); // Adjust the session key based on your actual implementation
    $data['user_details'] = $this->Customer_model->get_user_details($company_id);

    // Load the update_profile view with user details
    $this->load->view('customer/update_profile', $data);
}

public function update_profile_store()
{
    // Validate form data (you can use CI form validation library)
    $this->form_validation->set_rules('firstname', 'First Name', 'required');
    $this->form_validation->set_rules('lastname', 'Last Name', 'required');
    // Add similar rules for other form fields

    if ($this->form_validation->run() == FALSE) {
        // If validation fails, reload the update_profile view with validation errors
        $this->load->view('customer/update_profile');
    } else {
        // If validation passes, handle form submission and update user profile data in the database
        $data = array(
            'firstname' => $this->input->post('firstname'),
            'lastname' => $this->input->post('lastname'),
            // Add similar lines for other form fields
        );

        // You need to replace 'Your_model' with your actual model name
        $this->Your_model->update_user_profile($data);

        // Redirect to the update_profile page after updating data
        redirect('customer/update_profile');
    }
}

