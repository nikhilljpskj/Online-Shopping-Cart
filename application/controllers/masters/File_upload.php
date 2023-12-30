<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class File_upload extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('authenticated')) {
            redirect('login');
            session_destroy();
        }
        
        $this->load->model('file_model');
    }

public function index() {
    $user_id = $this->session->userdata('id');
    $data['files'] = $this->file_model->get_files($user_id);
    $data['page'] = 'file_upload/view';

    //$this->load->view('file_upload', $data);
    //$data['php_version'] = phpversion();
    //$this->load->view('file_upload/view', $data);
    //$view_data['page'] = 'file_upload/view';
	//this->load->view('template', $view_data);
    $this->load->view('template', $data);

}


public function upload() {
    $config['upload_path']   = './attachments/uploads/';
    $config['allowed_types'] = 'pdf|doc|docx|xls|xlsx';
    $config['max_size']      = 10000;

    $this->load->library('upload', $config);

    if (!$this->upload->do_upload('userfile')) {
        $error = array('error' => $this->upload->display_errors());
        print_r($error);
    } else {
        $data = array('upload_data' => $this->upload->data());
        
        $file_name = $this->input->post('file_name');
        $user_id = $this->session->userdata('id');
        $created_date = date('Y-m-d H:i:s');

        $this->file_model->insert_file($user_id, $file_name, $data['upload_data']['file_name'], $created_date);

        $this->session->set_flashdata('upload_success_message', 'File uploaded successfully!');
        $this->session->unset_userdata('delete_success_message'); // Unset delete success message if it exists
        redirect('masters/file_upload');
        $this->load->view('template', $data);



    }

}




    public function download($file_id) {
        $file = $this->file_model->get_file_by_id($file_id);

        if ($file) {
            $file_path = './attachments/uploads/'.$file['file_name'];
            force_download($file_path, NULL);
        } else {
            show_404();
        }
    }

    public function delete($file_id) {
        $file = $this->file_model->get_file_by_id($file_id);

        if ($file) {
            $file_path = './attachments/uploads/'.$file['file_name'];
            unlink($file_path); // Delete the file from the server

            $this->file_model->delete_file($file_id); // Delete the file record from the database
            
            $this->session->set_flashdata('delete_success_message', 'File deleted successfully!');
            $this->session->unset_userdata('upload_success_message'); // Unset upload success message if it exists
            redirect('masters/file_upload');

        } else {
            show_404();
        }
    }
}
?>
