<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login_model extends CI_Model
{

    public function validate($email, $password)
    {
        $this->db->select('*');
        $this->db->from('company');
        $this->db->where('email', $email);
        $this->db->where('password', hash('sha256', $password)); 
        $data = $this->db->get()->result();
        return ($data) ? $data[0] : null;
    }

    public function session($password, $email)
    {

        $this->db->select('*');
        $this->db->from('prop_company');
        $this->db->where('email', $email);
        $this->db->where('password', $password);
        $this->db->where('status', 0);
        $query = $this->db->get();
        return $query->row_array();
    }
}
