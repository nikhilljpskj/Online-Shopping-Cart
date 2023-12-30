<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		if (!$this->session->userdata('authenticated')) {
            redirect('login');
            session_destroy();
        }

		date_default_timezone_set("Asia/Kolkata");
		$this->load->helper(array('form', 'url'));
		$this->session->keep_flashdata('message');

		$this->load->model('Login_model');
		$this->load->model('Dashboard_model');
                $prefs = array (
               'start_day'    => 'sunday',
               'month_type'   => 'long',
               'day_type'     => 'short'
             );
        $this->load->library('calendar', $prefs);
	}

	public function index()
	{
		$template['page'] = 'dashboard';
		$template['eventCalendar'] = '';
		$this->load->view('template', $template);
	}

 	public function raw_material_show()
	{
		$template['page'] = '/dashboard';
		$template['data1'] = $this->Dashboard_model->show_table('rawproducts');
		$this->load->view('template', $template);
	}
	
}
