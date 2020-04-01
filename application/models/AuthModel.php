<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Payroll application (demo only)
 * 
 * 
 * @package Auth Models
 * @since 2017
 * @version 1.0.0
 * @copyright 2019 KanKetik
 * @author Adi adistwn09@gmail.com
 * @author Brata
 */

class AuthModel extends CI_Model {

    public function __construct()
    {
        parent::__construct();
    }
    
    public function check_login($username)
    {
        $this->db->from('account');
        $this->db->where('username', $username);
        $this->db->limit(1);
        return $this->db->get();
    }

    // public function create_login()
    // {
    //     $this->db->where('id', $this->session->userdata('id_account'));
    //     $this->db->update('users', ['last_login' => date('Y-m-d H:i:s')]);
    //     // $this->log_login();
    // }

    // private function log_login()
    // {
    //     $log = array(
    //         'id_users'   => $this->session->userdata('id_account'),
    //         'date'       => date('Y-m-d H:i:s'),
    //         'ip_address' => $this->input->ip_address(),
    //     );
    //     $this->db->insert('log_login', $log);
    // }

}

/* End of file AuthModel.php */
/* Location: ./application/models/AuthModel.php */