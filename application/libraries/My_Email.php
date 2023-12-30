<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class My_Email {

    protected $CI;

    public function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->library('email');
        $this->CI->config->load('email', TRUE);
        $this->CI->email->initialize($this->CI->config->item('email'));

        // Log a message indicating that the library has been loaded
        log_message('debug', 'My_Email library loaded successfully');
    }

    public function sendEmail($to, $subject, $message) {
        $this->CI->email->from('nikhilkodumon@gmail.com', 'ERP');
        $this->CI->email->to($to);
        $this->CI->email->subject($subject);
        $this->CI->email->message($message);

        if ($this->CI->email->send()) {
            return true;
        } else {
            log_message('error', 'Email Error: ' . $this->CI->email->print_debugger());
            return false;
        }
    }
}
