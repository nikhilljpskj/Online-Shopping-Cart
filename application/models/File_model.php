<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class File_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

public function get_files($user_id) {
    $this->db->where('user_id', $user_id);
    $query = $this->db->get('files');
    return $query->result_array();
}


    public function insert_file($user_id, $file_name, $original_name, $created_date) {
        $data = array(
            'user_id' => $user_id,
            'file_name' => $file_name,
            'file' => $original_name, // Save the original file name in the 'file' column
            'created_date' => $created_date
        );

        return $this->db->insert('files', $data);
    }

    public function get_file_by_id($file_id) {
        $query = $this->db->get_where('files', array('id' => $file_id));
        return $query->row_array();
    }

    public function delete_file($file_id) {
        $this->db->where('id', $file_id);
        $this->db->delete('files');
    }
}
?>
