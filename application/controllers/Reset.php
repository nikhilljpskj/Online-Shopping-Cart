<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reset extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }

    public function password()
    {
        if ($this->input->get('hash')) {
            $hash = $this->input->get('hash');
            $this->data['hash'] = $hash;
            $getHashDetails = $this->user_model->getHahsDetails($hash);

            if ($getHashDetails != false) {
                $hash_expiry = $getHashDetails->hash_expiry;
                $currentDate = date('Y-m-d H:i');

                if ($currentDate < $hash_expiry) {
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $this->form_validation->set_rules('password', 'New Password', 'required');
                        $this->form_validation->set_rules('cpassword', 'Confirm New Password', 'required|matches[password]');

                        if ($this->form_validation->run() == TRUE) {
                            $newPassword = $this->input->post('password');
                            $newPassword = hash('sha256', $newPassword);

                            $data = array(
                                'password' => $newPassword,
                                'hash_key' => null,
                                'hash_expiry' => null
                            );

                            $this->user_model->updateNewPassword($data, $hash);
                            $this->session->set_flashdata('success', 'Successfully changed Password');
                            redirect(base_url('login/index'));
                        } else {
                            $this->load->view('reset_password', $this->data);
                        }
                    } else {
                        $this->load->view('reset_password', $this->data);
                    }
                } else {
                    $this->session->set_flashdata('error', 'Link is expired');
                    redirect(base_url('login/forgotPassword'));
                }
            } else {
                echo 'Invalid link';
                exit;
            }
        } else {
            redirect(base_url('login/forgotPassword'));
        }
    }
}
