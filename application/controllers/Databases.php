<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Project02
 * 
 * 
 * @package Databases Controller
 * @since 2019
 * @version 1.0.0
 * @author Brata
 */

 class Databases extends CI_Controller {
   
   public function __construct()
   {
       parent::__construct();
       is_login();
       $this->id_account = $this->session->userdata('id_account');
       $this->username   = $this->session->userdata('username');
   }
   
   public function index()
   {
      $this->render->view('databases/databases_employees');   
   }

   public function getViewAtts()
   {
      $this->render->view('databases/databases_attendances');   
   }
    /**
     * Get all databases
     *
     * @return json_encode
     */
   public function getAllEmployees()
   {
      if ($this->input->is_ajax_request()) {
         $db = $this->Global->getallGlobal('USERINFO');
         
         // echo "<pre>";
         // print_r ($data);
         // echo "</pre>";
         // die();
         foreach ($db as $value) {
            # code...

            if ($value->BIRTHDAY != "") {
               // $explb = explode(' ', $value->BIRTHDAY)
               $birthday = date('d-m-Y', strtotime($value->BIRTHDAY));
            } else {
               $birthday = "";
            }
            if ($value->HIREDDAY != "") {
               $hireday = date('d-m-Y', strtotime($value->HIREDDAY));
            } else {
               $hireday = "";
            }
            $data[] = array(
               'USERID'   => $value->BADGENUMBER,
               'NAME'     => $value->NAME,
               'GENDER'   => $value->GENDER,
               'TITLE'    => $value->TITLE,
               'BIRTHDAY' => $birthday,
               'HIREDDAY' => $hireday,
            );
         }
         
         $response['error'] = false;
         $response['data'] = $data;
         echo json_encode($response, JSON_PRETTY_PRINT);
     }
   }

   public function getAllAttendance() 
   {
      if ($this->input->is_ajax_request()) {
         $db = $this->Global->getAllGlobal('CHECKINOUT');
         foreach ($db as $value) {
            # code...
            if ($value->CHECKTYPE == "I") {
               $cktype = "Check In";
            } else if ($value->CHECKTYPE == "O") {
               $cktype = "Check Out";
            } else {
               $cktype = "Other";
            }
            if ($value->VERIFYCODE == 1) {
               $vcode = "FP";
            } else {
               $vcode = "FACE";
            }
            $data[] = array(
               'USERID' => $value->USERID,
               'CHECKTIME' => $value->CHECKTIME,
               'CHECKTYPE' => $cktype,
               'SENSORID' => $value->SENSORID,
               'WorkCode' => $value->WorkCode,
               'VERIFYCODE' => $vcode,
               'sn' => $value->sn
            );
         }
         $response['error'] = false;
         $response['data'] = $data;
         echo json_encode($response, JSON_PRETTY_PRINT);
      }
      
   }



}

/* End of file Databases.php */
