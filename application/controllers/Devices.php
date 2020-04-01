<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Project02
 * 
 * 
 * @package Devices Controller
 * @since 2019
 * @version 1.0.0
 * @author Brata
 */

class Devices extends CI_Controller {

   public function __construct()
   {
       parent::__construct();
       is_login();
       $this->id_account = $this->session->userdata('id_account');
       $this->username   = $this->session->userdata('username');
   }

   public function index()
   {
       $this->render->view('master/devices');
   }
    /**
     * Get all devices
     *
     * @return json_encode
     */
   public function getAllDevices()
   {
      if ($this->input->is_ajax_request()) {
         $data = $this->Global->getallGlobal('Machines');
         
         $response['error'] = false;
         $response['data'] = $data;
         echo json_encode($response, JSON_PRETTY_PRINT);
     }
   }


}

/* End of file Devices.php */
