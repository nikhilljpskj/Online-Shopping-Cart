<?php

defined('BASEPATH') OR exit('No direct script access allowed');

   

class CaledarController extends CI_Controller {

   

    /**

     * Get All Data from this method.

     *

     * @return Response

    */

    public function __construct() {

       parent::__construct();

       $this->load->database();

    }

    

    /**

     * Get All Data from this method.

     *

     * @return Response

    */

    public function index()

    {

        $data['result'] = $this->db->get("events")->result();

   

        foreach ($data['result'] as $key => $value) {

            $data['data'][$key]['title'] = $value->title;

            $data['data'][$key]['start'] = $value->start_date;

            $data['data'][$key]['end'] = $value->end_date;

            $data['data'][$key]['backgroundColor'] = "#00a65a";

        }

           

        $this->load->view('my_calendar', $data);

    }

}