<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 * Project02
 * 
 * 
 * @package Databases Controller
 * @since 2019
 * @version 1.0.0
 * @author Brata
 */

class Transfers extends CI_Controller
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
      $this->render->view('transfer/file_logs');
   }

   public function getFilesTransfer()
   {
      if ($this->input->is_ajax_request()) {
         // $data = $this->Global->getallGlobal('user_files_upload');
         $this->db->from('user_files_upload');
         $this->db->order_by('id_trx', 'desc');
         $data = $this->db->get()->result();



         // asort($data);
         $response['error'] = false;
         $response['data'] = $data;
         echo json_encode($response, JSON_PRETTY_PRINT);
      }
   }

   public function data_logs()
   {
      $this->render->view('transfer/data_logs');
   }

   public function getData($start, $end)
   {
      $start = (!$start) ? $this->input->post('start') : $start;
      $end = (!$end) ? $this->input->post('end') : $end;

      $begin = date('m/d/Y H:i:s', strtotime($start));
      $to = date('m/d/Y H:i:s', strtotime($end));

      $this->db->from('user_data_upload');
      // $this->db->where('CHECKTIME BEETWEEN "' .date('m/d/Y h:i A', strtotime($start)). '" and "'.date('m/d/Y h:i A', strtotime($end)). '"');
      $this->db->where('Attend_Time >=', $begin);
      $this->db->where('Attend_Time <=', $to);
      // $this->db->where('CHECKTIME >= ' .$start);
      // $this->db->where('CHECKTIME <= ' .$end);


      // $this->db->order_by('CHECKTIME', 'ASC');

      // $this->db->limit(10);

      return $this->db->get();
   }

   public  function getAtt($start, $end)
   {
      // $start = (!$start) ? $this->input->post('start') : $start;
      // $end = (!$end) ? $this->input->post('end') : $end;

      $begin = date('m/d/Y h:i A', strtotime($start));
      $to = date('m/d/Y h:i A', strtotime($end));

      $this->db->select('CHECKTIME, CHECKTYPE, WorkCode, USERINFO.BADGENUMBER, Machines.MachineAlias');
      $this->db->from('CHECKINOUT');
      $this->db->join('USERINFO', 'USERINFO.USERID = CHECKINOUT.USERID', 'left');
      $this->db->join('Machines', 'Machines.sn = CHECKINOUT.sn', 'left');
      // $this->db->where('CHECKTIME BEETWEEN "' .date('m/d/Y h:i A', strtotime($start)). '" and "'.date('m/d/Y h:i A', strtotime($end)). '"');
      $this->db->where('CHECKTIME >=', $begin);
      $this->db->where('CHECKTIME <=', $to);
      // $this->db->where('CHECKTIME >= ' .$start);
      // $this->db->where('CHECKTIME <= ' .$end);


      // $this->db->order_by('CHECKTIME', 'ASC');

      // $this->db->limit(10);

      return $this->db->get();
   }


   public function getDataLogs()
   {
      if ($this->input->is_ajax_request()) {
         $start = $this->input->post('start');
         $end = $this->input->post('end');
         // $data = $this->Global->getallGlobal('user_data_upload');
         $data = $this->getData($start, $end)->result();

         // asort($data);
         if ($data != []) {
            $response['error'] = false;
            $response['data'] = $data;
            // $this->sendFTP($data);
         } else {
            // $response['error'] = true;
            $response['data'] = [];
            $response['message'] = 'No data avaiable';
         }
         echo json_encode($response, JSON_PRETTY_PRINT);
      }
   }

   public function getDataLogs2()
   {
      if ($this->input->is_ajax_request()) {
         // $start = '12/3/2019 12:00 AM';
         $start = $this->input->post('start');
         // $end = '12/3/2019 11:59 PM';
         $end = $this->input->post('end');

         // $data = $this->Global->getallGlobal('user_data_upload');
         $data_Att = $this->getData($start, $end)->result();
         $attLog = $this->getAtt($start, $end)->result();
         $data = array();


         // echo "<pre>";
         // print_r ($dataLog->id);
         // echo "</pre>";
         // die();

         foreach ($attLog as $value) {
            # code...
            // $sort_att[$key] = $value[2]->CHECKTIME; 
            $empno = $value->BADGENUMBER;
            $att_time = date('m/d/Y h:i A', strtotime($value->CHECKTIME));
            if ($value->CHECKTYPE == "I") {
               // $status = "1";
               $status = "CheckIn";
            } else if ($value->CHECKTYPE == "O") {
               // $status = "2";
               $status = "CheckOut";
            } else if ($value->CHECKTYPE == "1") {
               // $status = "3";
               $status = "BreakOut";
            } else if ($value->CHECKTYPE == "0") {
               // $status = "4";
               $status = "BreakIn";
            } else if ($value->CHECKTYPE == "i") {
               // $status = "5";
               $status = "OvertimeIn";
            } else if ($value->CHECKTYPE == "o") {
               // $status = "6";
               $status = "OvertimeOut";
            }
            $pos = $value->WorkCode;
            $machinecode = $value->MachineAlias;

            if ($att_time != "") {
               $dataAtt = array(
                  'trx_code' => $value->BADGENUMBER . '_' . $value->CHECKTIME . '_' . $value->CHECKTYPE,
                  'EmpNo'       => $empno,
                  'Attend_Time' => $att_time,
                  'Status'      => $status,
                  // 'Status'      => $value->CHECKTYPE,
                  'Pos'         => $pos,
                  'MachineCode' => $machinecode
               );
            }

            $found_data = false;
            foreach ($data_Att as $key => $val) {
               if ($val->flag == 1) {
                  $flag = 'Sent';
               } else if ($val->flag == 2) {
                  $flag = 'Not Sent';
               } else if ($val->flag == 3) {
                  $flag = 'Not Connected';
               } else if ($val->flag == 0){
                  $flag = '';
               }
               $dataLog = array(
                  'id' => $val->trx_code,
                  'flag' => $val->flag
               );
               if ($dataLog['id'] == $dataAtt['trx_code']) {
                  $show = "Sama";
                  $data[] = array(
                     'trx_code' => $val->trx_code,
                     'EmpNo' => $val->EmpNo,
                     'Attend_Time' => date('m/d/Y h:i A', strtotime($val->Attend_Time)),
                     'Status' => $status,
                     'Pos' => $val->Pos,
                     'MachineCode' => $val->MachineCode,
                     'transfer_by' => $val->transfer_by,
                     'transfer_at' => date('m/d/Y h:i A', strtotime($val->transfer_at)),
                     'file_name' => $val->file_name,
                     'flag' => $flag
                  );
                  $found_data = true;
                  break;
               }
               // if ($dataLog['id'] !== $dataAtt['trx_code']) {
               //    $show = "beda";
               //    $data[] = array(
               //       'trx_code' => $value->BADGENUMBER . '_' . $value->CHECKTIME . '_' . $value->CHECKTYPE,
               //       'EmpNo'       => $empno,
               //       'Attend_Time' => $att_time,
               //       // 'Status'      => $status,
               //       'Status'      => $value->CHECKTYPE,
               //       'Pos'         => $pos,
               //       'MachineCode' => $machinecode,
               //       'transfer_by' => '',
               //       'transfer_at' => '',
               //       'file_name' => '',
               //       'flag' => 0,
               //    );
               // }
            }
            
            if ($found_data === false) {
               $data[] = array(
                  'trx_code' => $value->BADGENUMBER . '_' . $value->CHECKTIME . '_' . $value->CHECKTYPE,
                  'EmpNo'       => $empno,
                  'Attend_Time' => $att_time,
                  'Status'      => $status,
                  'Pos'         => $pos,
                  'MachineCode' => $machinecode,
                  'transfer_by' => '',
                  'transfer_at' => '',
                  'file_name' => '',
                  'flag' => 0,
               );
            }
               $found_data = false;
            // echo "<pre>";
            // print_r($data_show);
            // echo "</pre>";
            // die();
         }

         // if ($dataAtt->trx_code = $dataLog->trx_code) {

         // }

         // asort($data);
         if ($data != []) {
            $response['error'] = false;
            $response['data'] = $data;
         } else {
            // $response['error'] = true;
            $response['data'] = [];
            $response['message'] = 'No data avaiable';
         }
         echo json_encode($response, JSON_PRETTY_PRINT);
         // die();
      }
   }

   public function resendFTP()
   {
      error_reporting(0);
      $id        = $this->input->post('id');
      $db = $this->Global->getGlobal('user_files_upload', 'id_trx', $id);
      $name = $db->name_file;
      $data_sum = $db->data_sum;
      // echo "<pre>";
      // print_r ($db->name_file);
      // echo "</pre>";
      // die();
      $transfer_by = $this->session->userdata('username');
      if ($transfer_by != "") {
         $tf_by = $transfer_by;
      } else {
         $tf_by = "By System";
      }
      $data_log = array();

      // echo "<pre>";
      // print_r ($db);
      // echo "</pre>";
      // die();

      set_include_path(APPPATH . 'third_party\phpseclib');
      include_once(APPPATH . 'third_party\phpseclib\Net\SFTP.php');

      $sftp = new Net_SFTP('sftp.dataon.com');
      if (!$sftp->login('attendance_ssihr', '1^YhYhMF%6PUOAgc')) {
         $update = array(
            'name_file' => $name,
            'data_sum' => $data_sum,
            'status' => 0,
            'timestamps' => date('d/m/Y h:i A'),
            'transfer_by' => $tf_by
         );
         $this->db->where('id_trx', $id);
         $this->db->update('user_files_upload', $update);

         // foreach ($db as $value) {

         //    $data_log = array(
         //       'trx_code' => $value->BADGENUMBER.'_'.$value->CHECKTIME.'_'.$value->CHECKTYPE,
         //       'EmpNo' => $value->BADGENUMBER,
         //       'Attend_Time' => date('m/d/Y h:i A', strtotime($value->CHECKTIME)),
         //       'Status' => $value->CHECKTYPE,
         //       'Pos' => $value->WorkCode,
         //       'MachineCode' => $value->MachineAlias,
         //       'transfer_by' => $tf_by,
         //       'transfer_at' => date('m/d/Y h:i A'),
         //       'file_name' => $name,
         //       'flag' => 2
         //    );


         //    $this->db->insert('user_data_upload', $data_log);
         // }

         $response['error'] = true;
         $response['message'] = "FTP can not login!";
      } else {
         // $this->export2excel($name);

         // $filepath = copy("C:/Users/User/Downloads/" . $name, FCPATH.'uploads/' . $name);
         $open = fopen(FCPATH . 'uploads\\' . $name, 'r');

         if (!$sftp->put($name, $open, NET_SFTP_LOCAL_FILE)) {
            $update = array(
               'name_file' => $name,
               'data_sum' => $data_sum,
               'status' => 1,
               'timestamps' => date('d/m/Y h:i A'),
               'transfer_by' => $tf_by
            );
            $this->db->where('id_trx', $id);
            $this->db->update('user_files_upload', $update);
            // foreach ($db as $value) {

            //    $data_log = array(
            //       'trx_code' => $value->BADGENUMBER.'_'.$value->CHECKTIME.'_'.$value->CHECKTYPE,
            //       'EmpNo' => $value->BADGENUMBER,
            //       'Attend_Time' => date('m/d/Y h:i A', strtotime($value->CHECKTIME)),
            //       'Status' => $value->CHECKTYPE,
            //       'Pos' => $value->WorkCode,
            //       'MachineCode' => $value->MachineAlias,
            //       'transfer_by' => $tf_by,
            //       'transfer_at' => date('m/d/Y h:i A'),
            //       'file_name' => $name,
            //       'flag' => 3
            //    );


            //    $this->db->insert('user_data_upload', $data_log);
            // }


            $response['error'] = true;
            $response['message'] = $name . " failed to upload!";
         } else {
            $update = array(
               'name_file' => $name,
               'data_sum' => $data_sum,
               'status' => 2,
               'timestamps' => date('d/m/Y h:i A'),
               'transfer_by' => $tf_by
            );
            $this->db->where('id_trx', $id);
            $this->db->update('user_files_upload', $update);
            // foreach ($db as $value) {

            //    $data_log = array(
            //       'trx_code' => $value->BADGENUMBER.'_'.$value->CHECKTIME.'_'.$value->CHECKTYPE,
            //       'EmpNo' => $value->BADGENUMBER,
            //       'Attend_Time' => date('m/d/Y h:i A', strtotime($value->CHECKTIME)),
            //       'Status' => $value->CHECKTYPE,
            //       'Pos' => $value->WorkCode,
            //       'MachineCode' => $value->MachineAlias,
            //       'transfer_by' => $tf_by,
            //       'transfer_at' => date('m/d/Y h:i A'),
            //       'file_name' => $name,
            //       'flag' => 1
            //    );


            //    $this->db->insert('user_data_upload', $data_log);
            // }


            $response['error'] = false;
            $response['message'] = $name . " uploaded!";
         }
      }

      // $file = file_get_contents($open,true);
      // $file = file_get_contents($filepath, FILE_USE_INCLUDE_PATH);

      // echo $sftp->pwd() . "\r\n";


      echo json_encode($response, JSON_PRETTY_PRINT);
   }
}

/* End of file Transfers.php */
