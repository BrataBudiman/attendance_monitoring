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

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Attendances extends CI_Controller
{

   public function __construct()
   {
      parent::__construct();
      if (
         !$this->uri->segment(2) == 'cronjob' ||
         !$this->uri->segment(2) == 'getAtt' ||
         !$this->uri->segment(2) == 'export2excel'
      ) {
         is_login();
      }
      $this->id_account = $this->session->userdata('id_account');
      $this->username   = $this->session->userdata('username');
   }

   public function index()
   {
      $this->render->view('attendance/devatt');
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

   // public function truncate()
   // {
   //    $this->db->truncate('CHECKINOUT');

   // }

   public function getDevAtt()
   {
      if ($this->input->is_ajax_request()) {
         $start = $this->input->post('start');
         $end = $this->input->post('end');

         $db = $this->getAtt($start, $end)->result();
         $data = array();
         foreach ($db as $key => $value) {
            # code...
            // $sort_att[$key] = $value[2]->CHECKTIME; 
            $empno = $value->BADGENUMBER;
            $att_time = date('m/d/Y h:i A', strtotime($value->CHECKTIME));
            if ($value->CHECKTYPE == "I") {
               // $status = "1";
               $status = "F1";
            } else if ($value->CHECKTYPE == "O") {
               // $status = "2";
               $status = "F2";
            } else if ($value->CHECKTYPE == "1") {
               // $status = "3";
               $status = "F3";
            } else if ($value->CHECKTYPE == "0") {
               // $status = "4";
               $status = "F4";
            } else if ($value->CHECKTYPE == "i") {
               // $status = "5";
               $status = "F5";
            } else if ($value->CHECKTYPE == "o") {
               // $status = "6";
               $status = "F6";
            }
            $pos = $value->WorkCode;
            $machinecode = $value->MachineAlias;

            if ($att_time != "") {
               $data[] = array(
                  'EmpNo'       => $empno,
                  'Attend_Time' => $att_time,
                  'Status'      => $status,
                  // 'Status'      => $value->CHECKTYPE,
                  'Pos'         => $pos,
                  'MachineCode' => $machinecode
               );
            }
         }
         // array_multisort($data, SORT_DESC, $db);
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
         // echo "<pre>";
         // print_r ($data);
         // echo "</pre>";
         // die();
      }
   }

   public function getSFTP()
   {
      $this->db->where('id', 1);
      $this->db->from('sftp_acc');
      return $this->db->get();

      // $db = $this->Global->getGlobal('sftp_acc','id', 1);
      // echo "<pre>";
      // print_r ($db);
      // echo "</pre>";
      //       die();
   }

   public function sendFTP()
   {
      // error_reporting(0);
      $akun = $this->Global->getGlobal('sftp_acc', 'id', 1);
      // $db = $this->getSFTP();  
      $name        = $this->input->post('name');
      $start       = $this->input->post('start');
      $to          = $this->input->post('end');
      $data_sum    = str_replace(',', '', $this->input->post('data_sum'));
      $db = $this->getAtt($start, $to)->result();
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

      $sftp = new Net_SFTP($akun->hostname);
      if (!$sftp->login($akun->username, $akun->password)) {
         $save = array(
            'name_file' => $name,
            'start_from' => date('d/m/Y h:i A', strtotime($start)),
            'start_to' => date('d/m/Y h:i A', strtotime($to)),
            'data_sum' => (int) $data_sum,
            'status' => 0,
            'timestamps' => date('d/m/Y h:i A'),
            'transfer_by' => $tf_by
         );
         $this->db->insert('user_files_upload', $save);

         foreach ($db as $value) {

            $code = $value->BADGENUMBER . '_' . $value->CHECKTIME . '_' . $value->CHECKTYPE;
            $find = $this->Global->getGlobal('user_data_upload', 'trx_code', $code);

            if (!$find) {
               $data_log = array(
                  'trx_code'    => $code,
                  'EmpNo'       => $value->BADGENUMBER,
                  'Attend_Time' => date('m/d/Y h:i A', strtotime($value->CHECKTIME)),
                  'Status'      => $value->CHECKTYPE,
                  'Pos'         => $value->WorkCode,
                  'MachineCode' => $value->MachineAlias,
                  'transfer_by' => $tf_by,
                  'transfer_at' => date('m/d/Y h:i A'),
                  'file_name'   => $name,
                  'flag'        => 2
               );
               $this->db->insert('user_data_upload', $data_log);
            }
            
         }

         $response['error'] = true;
         $response['message'] = "FTP can not login!";
      } else {
         $data_sum = $this->export2excel($name);

         // $filepath = copy("C:/Users/User/Downloads/" . $name, FCPATH.'uploads/' . $name);
         $open = fopen(FCPATH . 'uploads/' . $name, 'r');

         if (!$sftp->put($name, $open, NET_SFTP_LOCAL_FILE)) {
            $save = array(
               'name_file' => $name,
               'start_from' => date('d/m/Y h:i A', strtotime($start)),
               'start_to' => date('d/m/Y h:i A', strtotime($to)),
               'data_sum' => $data_sum,
               'status' => 1,
               'timestamps' => date('d/m/Y h:i A'),
               'transfer_by' => $tf_by
            );
            $this->db->insert('user_files_upload', $save);

            foreach ($db as $value) {
               
               $code = $value->BADGENUMBER . '_' . $value->CHECKTIME . '_' . $value->CHECKTYPE;
               $find = $this->Global->getGlobal('user_data_upload', 'trx_code', $code);

               if (!$find) {
                  $data_log = array(
                     'trx_code'    => $value->BADGENUMBER . '_' . $value->CHECKTIME . '_' . $value->CHECKTYPE,
                     'EmpNo'       => $value->BADGENUMBER,
                     'Attend_Time' => date('m/d/Y h:i A', strtotime($value->CHECKTIME)),
                     'Status'      => $value->CHECKTYPE,
                     'Pos'         => $value->WorkCode,
                     'MachineCode' => $value->MachineAlias,
                     'transfer_by' => $tf_by,
                     'transfer_at' => date('m/d/Y h:i A'),
                     'file_name'   => $name,
                     'flag'        => 3
                  );
                  $this->db->insert('user_data_upload', $data_log);
               }
            }

            $response['error'] = true;
            $response['message'] = $name . " failed to upload!";

         } else {
            $save = array(
               'name_file' => $name,
               'start_from' => date('d/m/Y h:i A', strtotime($start)),
               'start_to' => date('d/m/Y h:i A', strtotime($to)),
               'data_sum' => $data_sum,
               'status' => 2,
               'timestamps' => date('d/m/Y h:i A'),
               'transfer_by' => $tf_by
            );
            $this->db->insert('user_files_upload', $save);

            foreach ($db as $value) {

               $code = $value->BADGENUMBER . '_' . $value->CHECKTIME . '_' . $value->CHECKTYPE;
               $find = $this->Global->getGlobal('user_data_upload', 'trx_code', $code);

               if (!$find) {
                  
                  $data_log = array(
                     'trx_code'    => $value->BADGENUMBER . '_' . $value->CHECKTIME . '_' . $value->CHECKTYPE,
                     'EmpNo'       => $value->BADGENUMBER,
                     'Attend_Time' => date('m/d/Y h:i A', strtotime($value->CHECKTIME)),
                     'Status'      => $value->CHECKTYPE,
                     'Pos'         => $value->WorkCode,
                     'MachineCode' => $value->MachineAlias,
                     'transfer_by' => $tf_by,
                     'transfer_at' => date('m/d/Y h:i A'),
                     'file_name'   => $name,
                     'flag'        => 1
                  );
   
                  $this->db->insert('user_data_upload', $data_log);
               }
               // $this->moveFile(FCPATH.'uploads/'.$name, FCPATH . 'uploads/manual_scss');
            }


            $response['error'] = false;
            $response['message'] = $name . " uploaded!";
         }
      }

      // $file = file_get_contents($open,true);
      // $file = file_get_contents($filepath, FILE_USE_INCLUDE_PATH);

      // echo $sftp->pwd() . "\r\n";


      echo json_encode($response, JSON_PRETTY_PRINT);
   }


   public function export2excel($name, $start = '', $end = '', $sum = false)
   {
      require 'vendor/autoload.php';
      $start = (!$start) ? $this->input->post('start') : $start;
      $end = (!$end) ? $this->input->post('end') : $end;
      $now = date('m/d/Y H:i:s');


      $db = $this->getAtt($start, $end)->result();
      
      $spreadsheet = new Spreadsheet();
      $sheet = $spreadsheet->getActiveSheet();
      $sheet->mergeCells("A1:E1");
      $sheet->mergeCells("A2:E2");
      $sheet->setCellValue('A1', 'Attendance Log from: ' . $start . ' to: ' . $end);
      $sheet->setCellValue('A2', 'Date log: ' . $now);

      $sheet->setCellValue('A3', 'Employee No');
      $sheet->setCellValue('B3', 'Attendance Time');
      $sheet->setCellValue('C3', 'Status');
      $sheet->setCellValue('D3', 'POS');
      $sheet->setCellValue('E3', 'Machine Code');
      // $sheet->setCellValue('F3', 'Flag');

      $no = 3;
      $count = 0;
      if ($db !== "") {
         $no = $no + 1;
         foreach ($db as $value) {
            $trx = trim($value->BADGENUMBER) . '_' . trim($value->CHECKTIME) . '_' . trim($value->CHECKTYPE);
            $rekon = $this->db->from('user_data_upload')->where('trx_code', $trx)->get();

            $status = "";
            if ($value->CHECKTYPE == "I") {
               // $status = "1";
               $status = "F1";
            } else if ($value->CHECKTYPE == "O") {
               // $status = "2";
               $status = "F2";
            } else if ($value->CHECKTYPE == "1") {
               // $status = "3";
               $status = "F3";
            } else if ($value->CHECKTYPE == "0") {
               // $status = "4";
               $status = "F4";
            } else if ($value->CHECKTYPE == "i") {
               // $status = "5";
               $status = "F5";
            } else if ($value->CHECKTYPE == "o") {
               // $status = "6";
               $status = "F6";
            }

            if ($rekon->num_rows() > 0) {
               $val = $rekon->row();
               if ( strtoupper(trim($val->trx_code)) == strtoupper(trim($trx)) ) {
                  continue;
               }
            } else {
               $sheet->setCellValue('A3', 'Employee No');
               $sheet->setCellValue('A' . $no, $value->BADGENUMBER);
               $sheet->setCellValue('B' . $no, date('m/d/Y h:i A', strtotime($value->CHECKTIME)));
               $sheet->setCellValue('C' . $no, $status);
               $sheet->setCellValue('D' . $no, $value->WorkCode);
               $sheet->setCellValue('E' . $no, $value->MachineAlias);
            }

            

            $no++;
            $count++;
         }
      }

      $writer = new Xlsx($spreadsheet);
      $writer->save(FCPATH . 'uploads/' . $name);

      // if ($sum) {
         return $count;
         // exit;
      // }

      // $update_sum = array(
      //    'data_sum' => $count,
      // );
      // $this->db->where('name_file', trim($name));
      // $this->db->update('user_files_upload', $update_sum);

      // return true;
   }

   public function cronjob()
   {
      $akun = $this->Global->getGlobal('sftp_acc', 'id', 1);

      $name = 'Att_log_' . date('dmYHis') . '.xls';
      $today = date('m/d/Y h:i A');
      $to = date('m/d/Y h:i A');
      $start = date('m/d/Y h:i A', strtotime('-1 day', strtotime($today)));

      $db = $this->getAtt($start, $to)->result();
      // $data_sum    = $this->input->post('data_sum');
      $transfer_by = '';
      if ($transfer_by != "") {
         $tf_by = $transfer_by;
      } else {
         $tf_by = "By System";
      }

      $data_sum = $this->export2excel($name, $start, $to, true);

      set_include_path(APPPATH . 'third_party\phpseclib');
      include_once(APPPATH . 'third_party\phpseclib\Net\SFTP.php');

      $sftp = new Net_SFTP($akun->hostname);
      if (!$sftp->login($akun->username, $akun->password)) {
         $save = array(
            'name_file' => $name,
            'start_from' => date('d/m/Y h:i A', strtotime($start)),
            'start_to' => date('d/m/Y h:i A', strtotime($to)),
            'data_sum' => $data_sum,
            'status' => 0,
            'timestamps' => date('d/m/Y h:i A'),
            'transfer_by' => $tf_by
         );
         $this->db->insert('user_files_upload', $save);

         foreach ($db as $value) {

            $code = $value->BADGENUMBER . '_' . $value->CHECKTIME . '_' . $value->CHECKTYPE;
            $find = $this->Global->getGlobal('user_data_upload', 'trx_code', $code);

            if (!$find) {
               $data_log = array(
                  'trx_code'    => $value->BADGENUMBER . '_' . $value->CHECKTIME . '_' . $value->CHECKTYPE,
                  'EmpNo'       => $value->BADGENUMBER,
                  'Attend_Time' => date('m/d/Y h:i A', strtotime($value->CHECKTIME)),
                  'Status'      => $value->CHECKTYPE,
                  'Pos'         => $value->WorkCode,
                  'MachineCode' => $value->MachineAlias,
                  'transfer_by' => $tf_by,
                  'transfer_at' => date('m/d/Y h:i A'),
                  'file_name'   => $name,
                  'flag'        => 2
               );
               $this->db->insert('user_data_upload', $data_log);
            }
         }

         // $response['error'] = true;
         // $response['message'] = "FTP can not login!";
      } else {

         // $filepath = copy("C:/Users/User/Downloads/" . $name, FCPATH.'uploads/' . $name);
         $open = fopen(FCPATH . 'uploads/' . $name, 'r');

         if (!$sftp->put($name, $open, NET_SFTP_LOCAL_FILE)) {
            $save = array(
               'name_file' => $name,
               'start_from' => date('d/m/Y h:i A', strtotime($start)),
               'start_to' => date('d/m/Y h:i A', strtotime($to)),
               'data_sum' => $data_sum,
               'status' => 1,
               'timestamps' => date('d/m/Y h:i A'),
               'transfer_by' => $tf_by
            );
            $this->db->insert('user_files_upload', $save);

            foreach ($db as $value) {

               $code = $value->BADGENUMBER . '_' . $value->CHECKTIME . '_' . $value->CHECKTYPE;
               $find = $this->Global->getGlobal('user_data_upload', 'trx_code', $code);

               if (!$find) {
                  $data_log = array(
                     'trx_code' => $value->BADGENUMBER . '_' . $value->CHECKTIME . '_' . $value->CHECKTYPE,
                     'EmpNo' => $value->BADGENUMBER,
                     'Attend_Time' => date('m/d/Y h:i A', strtotime($value->CHECKTIME)),
                     'Status' => $value->CHECKTYPE,
                     'Pos' => $value->WorkCode,
                     'MachineCode' => $value->MachineAlias,
                     'transfer_by' => $tf_by,
                     'transfer_at' => date('m/d/Y h:i A'),
                     'file_name' => $name,
                     'flag' => 3
                  );
                  $this->db->insert('user_data_upload', $data_log);
               }

            }

            // $response['error'] = true;
            // $response['message'] = $name . " failed to upload!";
         } else {
            $save = array(
               'name_file' => $name,
               'start_from' => date('d/m/Y h:i A', strtotime($start)),
               'start_to' => date('d/m/Y h:i A', strtotime($to)),
               'data_sum' => $data_sum,
               'status' => 2,
               'timestamps' => date('d/m/Y h:i A'),
               'transfer_by' => $tf_by
            );
            $this->db->insert('user_files_upload', $save);

            foreach ($db as $value) {

               $code = $value->BADGENUMBER . '_' . $value->CHECKTIME . '_' . $value->CHECKTYPE;
               $find = $this->Global->getGlobal('user_data_upload', 'trx_code', $code);

               if (!$find) {
                  $data_log = array(
                     'trx_code' => $value->BADGENUMBER . '_' . $value->CHECKTIME . '_' . $value->CHECKTYPE,
                     'EmpNo' => $value->BADGENUMBER,
                     'Attend_Time' => date('m/d/Y h:i A', strtotime($value->CHECKTIME)),
                     'Status' => $value->CHECKTYPE,
                     'Pos' => $value->WorkCode,
                     'MachineCode' => $value->MachineAlias,
                     'transfer_by' => $tf_by,
                     'transfer_at' => date('m/d/Y h:i A'),
                     'file_name' => $name,
                     'flag' => 1
                  );
                  $this->db->insert('user_data_upload', $data_log);
               }
               
               // move_uploaded_file(FCPATH . 'uploads/' .$name, FCPATH . 'uploads/cron_scss/' . $name);
            }


            // $response['error'] = false;
            // $response['message'] = $name . " uploaded!";
         }
      }

      // $file = file_get_contents($open,true);
      // $file = file_get_contents($filepath, FILE_USE_INCLUDE_PATH);

      // echo $sftp->pwd() . "\r\n";


      // echo json_encode($response, JSON_PRETTY_PRINT);
   }
}

/* End of file Attendances.php */
