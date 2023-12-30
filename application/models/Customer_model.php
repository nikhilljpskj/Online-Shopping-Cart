<?php

class Customer_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

public function get_user_details($company_id)
{
    // Assuming you have a 'company' table in your database
    $this->db->select('company_id, company_name, firstname, lastname, billing_address, shipping_address, phone, mobile, email, gstno, panno');
    $this->db->from('company');
    $this->db->where('company_id', $company_id);
    
    // Execute the query
    $query = $this->db->get();
    echo $this->db->last_query();

    // Check if the query was successful
    if ($query->num_rows() > 0) {
        // Get the user details
        $user_details = $query->row();

        // Print the SQL query for debugging
        echo $this->db->last_query();

        // Return the user details
        return $user_details;
    } else {
        // If no records found, return false or handle accordingly
        return false;
    }
}


    // Add a method to update user profile data in the database if needed
}
