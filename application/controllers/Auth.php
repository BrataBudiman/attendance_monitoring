<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Payroll application
 * 
 * 
 * @package Auth Controller
 * @since 2017
 * @version 1.0.0
 * @author Brata (mrbratabudiman@gmail.com)
 */

class Auth extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->id_account = $this->session->userdata('id_account');
        $this->username   = $this->session->userdata('username');
    }

    public function index()
    {
        (empty($this->id_account)) ? $this->load->view('layouts/login') : redirect('home');
    }

    public function login()
    {
        (empty($this->id_account)) ? $this->load->view('layouts/login') : redirect('home');
    }

    public function checking()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $this->form_validation->set_rules('username', 'Username', 'trim|required|strip_tags');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run()) {

            $account = $this->Global->getGlobal('users', 'username', $username);
            
            if ($account) {
                if ($account->status_user !== 1) {
                    $response['error']   = true;
                    $response['message'] = 'this account inactive!';
                    echo json_encode($response);
                    return;
                }

                if (password_verify($password, $account->password)) {

                    $session = array(
                        'id_account' => $account->id,
                        'username'   => $account->username,
                        'level'      => $account->level_user,
                    );
                    $this->session->set_userdata($session);

                    $response['error']   = false;
                    $response['message'] = 'login success!';

                } else {
                    $response['error']   = true;
                    $response['message'] = 'wrong password!';
                
                }

            } else {

                $response['error']   = true;
                $response['message'] = 'user not found!';
            
            }

        } else {

            $response['error']   = true;
            $response['message'] = validation_errors();
        
        }

        echo json_encode($response);
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('');
    }

}

/* End of file Auth.php */
