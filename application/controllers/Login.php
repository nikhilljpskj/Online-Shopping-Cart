<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("Asia/Kolkata");
		$this->load->helper(array('form', 'url'));
		$this->session->keep_flashdata('message');

		$this->load->model('Login_model');
	}

	public function index()
	{
        
		$this->load->view('login');
	}


public function validate()
{
    $email = $this->security->xss_clean($this->input->post('email'));
    $password = $this->security->xss_clean($this->input->post('password'));
    
    $user = $this->Login_model->validate($email, $password);

    if ($user) {
        $userdata = array(
            'id' => $user->id,
            'company_id' => $user->company_id,
            'email' => $user->email,
            'firstname' => $user->firstname,
            'authenticated' => TRUE
        );

        $this->session->set_userdata($userdata);

        // Return JSON response
        header('Content-Type: application/json');
        echo json_encode(array('status' => 'success', 'message' => 'Login successful'));
    } else {
        // Return JSON response
        header('Content-Type: application/json');
        echo json_encode(array('status' => 'error', 'message' => 'Invalid email or password'));
    }
}

public function getRegisterView() {
    $registerView = '<p>Hello, this is a test!</p>';
    echo json_encode(array('status' => 'success', 'registerView' => $registerView));
}








	public function logout()
    {
        $this->session->sess_destroy();
        redirect('/');
    }



    public function forgotPassword()
{
    $this->load->model('user_model');

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        
        if ($this->form_validation->run() == TRUE) {
            $email = $this->input->post('email');

            // Check if the email exists in the company table
            $validateEmail = $this->user_model->validateEmail($email);

            if ($validateEmail !== false) {
                // Email exists, generate and send the reset link
                $row = $validateEmail;
                $user_id = $row->id;

                $string = time() . $user_id . $email;
                $hash_string = hash('sha256', $string);
                $currentDate = date('Y-m-d H:i');
                $hash_expiry = date('Y-m-d H:i', strtotime($currentDate . ' + 1 days'));
                $data = array(
                    'hash_key' => $hash_string,
                    'hash_expiry' => $hash_expiry,
                );

                $resetLink = base_url() . 'reset/password?hash=' . $hash_string;
                $message = '<p>Your reset password Link is here:</p>' . $resetLink;
                $subject = "Password Reset link";
                $sentStatus = $this->sendEmail($email, $subject, $message);

                if ($sentStatus == true) {
                    $this->user_model->updatePasswordhash($data, $email);
                    echo json_encode(array('status' => 'success', 'message' => 'Reset password link successfully sent'));
                } else {
                    echo json_encode(array('status' => 'error', 'message' => 'Email sending error'));
                }
            } else {
                // Email does not exist
                echo json_encode(array('status' => 'error', 'message' => 'Email not found in the database'));
            }
        } else {
            echo json_encode(array('status' => 'error', 'message' => validation_errors()));
        }
    } else {
        $this->load->view('forgot_password');
    }
}



	/*user this email sending code */

	public function sendEmail($email,$subject,$message)
    {

    	/* use this on server */

    	/* $config = Array(
		      'mailtype' => 'html',
		      'charset' => 'iso-8859-1',
		      'wordwrap' => TRUE
	    	);
    	 */
        $config = Array(
        'protocol' => 'smtp',
        'smtp_host' => 'ssl://smtp.gmail.com', 
        'smtp_port' => 465, 
        'smtp_user' => 'nikhilkodumon@gmail.com',
        'smtp_pass' => 'khalilgibran', 

        'mailtype' => 'html',
        'charset' => 'iso-8859-1',
        'wordwrap' => TRUE
    );
    	
    	/*This email configuration for sending email by Google Email 
	    $config = Array(
	      'protocol' => 'smtp',
	      'smtp_host' => 'ssl://smtp.googlemail.com',
	     
	      'smtp_port' => 465,
	      'smtp_user' => 'exampleEmail@gmail.com',  //gmail id
	      'smtp_pass' => '@@password',   //gmail password
	      
	      'mailtype' => 'html',
	      'charset' => 'iso-8859-1',
	      'wordwrap' => TRUE
	    	);*/



          $this->load->library('email', $config);
          $this->email->set_newline("\r\n");
          $this->email->from('noreply');
          $this->email->to($email);
          $this->email->subject($subject);
          $this->email->message($message);
          
          if($this->email->send())
         {
           return true;
         }
         else
         {
         	return false;
         }
    }


    private function setResetSuccess()
    {
        echo json_encode(array('status' => 'success', 'message' => 'Reset using link.'));
    }


}
