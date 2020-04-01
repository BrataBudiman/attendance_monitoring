<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Payroll application (demo only)
 * 
 * 
 * @package Home Controller
 * @since 2017
 * @version 1.0.0
 * @author Brata (mrbratabudiman@gmail.com)
 */

class Home extends CI_Controller
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
        $this->render->view('layouts/default');
    }

    public function countAdmin()
    {
        $data = $this->Global->getallGlobal('users');

        $response['error'] = false;
        $response['data'] = $data;
        echo json_encode($response, JSON_PRETTY_PRINT);
    }

    public function countEmployee()
    {
        $data = $this->Global->getallGlobal('USERINFO');

        $response['error'] = false;
        $response['data'] = $data;
        echo json_encode($response, JSON_PRETTY_PRINT);
    }

    public function countMachines()
    {
        $data = $this->Global->getallGlobal('Machines');

        $response['error'] = false;
        $response['data'] = $data;
        echo json_encode($response, JSON_PRETTY_PRINT);
    }

    public function countFiles()
    {
        $data = $this->Global->getallGlobal('user_files_upload');

        $response['error'] = false;
        $response['data'] = $data;
        echo json_encode($response, JSON_PRETTY_PRINT);
    }

    public function countDatas()
    {
        $data = $this->Global->getallGlobal('user_data_upload');

        $response['error'] = false;
        $response['data'] = $data;
        echo json_encode($response, JSON_PRETTY_PRINT);
    }

    public function countDailyAtt()
    {
        // $data = $this->Global->getallGlobal('CHECKINOUT');
        $begin = date('m/d/Y') . ' 12:00 AM';
        $to = date('m/d/Y') . ' 11:59 PM';

        $this->db->from('CHECKINOUT');
        // $this->db->where('CHECKTIME BEETWEEN "' .date('m/d/Y h:i A', strtotime($start)). '" and "'.date('m/d/Y h:i A', strtotime($end)). '"');
        $this->db->where('CHECKTIME >=', $begin);
        $this->db->where('CHECKTIME <=', $to);
        $data = $this->db->get()->result();

        $response['error'] = false;
        $response['data'] = $data;
        echo json_encode($response, JSON_PRETTY_PRINT);
    }
}

/* End of file Home.php */
