<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Settings extends CI_Controller
{

   public function __construct()
   {
      parent::__construct();
      is_login();
      $this->id_account = $this->session->userdata('id_account');
      $this->username   = $this->session->userdata('username');
   }

   public function index()
   {
      $this->render->view('settings');
   }

   public function connection()
   {
      $this->render->view('settings/connection');
   }

   public function getSftp()
   {

      if ($this->input->is_ajax_request()) {
            $data = $this->Global->getGlobal('sftp_acc','id', 1);
            $response['error'] = false;
            $response['data'] = $data;
            
           echo json_encode($response, JSON_PRETTY_PRINT);
      }
   }

   public function addSftp()
   {
      $conn_name = $this->input->post('conn_name');
      $hostname = $this->input->post('hostname');
      $username = $this->input->post('username');
      $password = $this->input->post('password');
      $port = $this->input->post('port');
      $flag = $this->input->post('status');

      $this->form_validation->set_rules('conn_name', 'Connection Name', 'trim|required|min_length[5]|max_length[20]');
      $this->form_validation->set_rules('hostname', 'Host', 'trim|required|min_length[5]');
      $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]');
      $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]');
      $this->form_validation->set_rules('port', 'Port', 'trim|required');
      $this->form_validation->set_rules('status', 'Status', 'trim|required');


      if ($this->form_validation->run()) {
         if ($flag == "Connected") {
            $s_flag = 1;
         } else {
            $s_flag = 0;
         }
         $save = array(
            'conn_name' => $conn_name,
            'hostname' => $hostname,
            'username' => $username,
            'password' => $password,
            'port' => $port,
            'flag' => $s_flag,
         );
         $this->db->insert('sftp_acc', $save);
         $response['error'] = false;
         $response['message'] = 'Account SFTP has been created';
      } else {
         $response['error'] = true;
         $response['message'] = validation_errors();
      }
      echo json_encode($response, JSON_PRETTY_PRINT);
   }

   public function updateSftp()
   {
      $id = $this->input->post('id');
      $conn_name = $this->input->post('conn_name');
      $hostname = $this->input->post('hostname');
      $username = $this->input->post('username');
      $password = $this->input->post('password');
      $port = $this->input->post('port');
      $flag = $this->input->post('status');

      $this->form_validation->set_rules('conn_name', 'Connection Name', 'trim|required|min_length[5]|max_length[20]');
      $this->form_validation->set_rules('hostname', 'Host', 'trim|required|min_length[5]');
      $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]');
      $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]');
      $this->form_validation->set_rules('port', 'Port', 'trim|required');
      $this->form_validation->set_rules('status', 'Status', 'trim|required');


      if ($this->form_validation->run()) {
         if ($flag == "Connected") {
            $s_flag = 1;
         } else {
            $s_flag = 0;
         }
         $save = array(
            'conn_name' => $conn_name,
            'hostname' => $hostname,
            'username' => $username,
            'password' => $password,
            'port' => $port,
            'flag' => $s_flag,
         );
         $this->db->where('id', $id);
         $this->db->update('sftp_acc', $save);
         $response['error'] = false;
         $response['message'] = 'Account SFTP updated';
      } else {
         $response['error'] = true;
         $response['message'] = validation_errors();
      }
      echo json_encode($response, JSON_PRETTY_PRINT);
   }

   public function testSftp()
   {
      error_reporting(0);
      $host = $this->input->post('host');
      $username = $this->input->post('username');
      $password = $this->input->post('password');

      set_include_path(APPPATH . 'third_party\phpseclib');
      include_once(APPPATH . 'third_party\phpseclib\Net\SFTP.php');

      $sftp = new Net_SFTP($host);
      if (!$sftp->login($username, $password)) {
         $response['error'] = true;
         $response['data'] = '0';
         $response['message'] = "SFTP not connected! Please check your account!";
      } else {
         $response['error'] = false;
         $response['data'] = '1';
         $response['message'] = "SFTP connected!";
      }
      // $sftp->login($username, $password); 
      //    $response['error'] = false;
      //    $response['data'] = '1';
      //    $response['message'] = "SFTP connected!";
      echo json_encode($response, JSON_PRETTY_PRINT);
   }
}

/* End of file Settings.php */
