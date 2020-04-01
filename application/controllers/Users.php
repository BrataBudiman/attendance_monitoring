<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Project02
 * 
 * 
 * @package Users Controller
 * @since 2019
 * @version 1.0.0
 * @author Brata
 */

class Users extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!$this->uri->segment(2) == 'regis') 
        {
            is_login();
        }
        $this->id_account = $this->session->userdata('id_account');
        $this->username   = $this->session->userdata('username');
    }

    public function index()
    {
        $this->render->view('master/users');
    }

    /**
     * Get all users
     *
     * @return json_encode
     */
    public function getAllUsers()
    {
        if ($this->input->is_ajax_request()) {
            $data = $this->Global->getallGlobal('users');
            $response['error'] = false;
            $response['data'] = $data;
            echo json_encode($response, JSON_PRETTY_PRINT);
        }
    }

    public function getUser()
    {
        $id = $this->input->post('id');
        if ($this->input->is_ajax_request()) {
            $data = $this->Global->getGlobal('users', 'id', $id);
            $response['error'] = false;
            $response['data'] = $data;
            echo json_encode($response, JSON_PRETTY_PRINT);
        }
    }

    public function regis()
    {
        $save = array(
            'username'    => 'admin',
            'password'    => password_hash('admin', PASSWORD_DEFAULT),
            'email'       => 'admin@admin.com',
            'level_user'  => 1,
            'status_user' => 1,
        );
        $this->db->insert('users', $save);
    }

    public function add()
    {
        $username    = $this->input->post('username');
        $password    = $this->input->post('password');
        $email       = $this->input->post('email');
        $level_user  = $this->input->post('level_user');
        $status_user = $this->input->post('status_user');

        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('level_user', 'Level', 'trim|required');
        $this->form_validation->set_rules('status_user', 'Status', 'trim|required');

        if ($this->form_validation->run()) {

            $save = array(
                'username'    => $username,
                'password'    => password_hash($password, PASSWORD_DEFAULT),
                'email'       => $email,
                'level_user'  => $level_user,
                'status_user' => $status_user,
            );
            $this->db->insert('users', $save);

            $response['error'] = false;
            $response['message'] = 'User created.';
        } else {
            $response['error'] = true;
            $response['message'] = validation_errors();
        }

        echo json_encode($response, JSON_PRETTY_PRINT);
    }

    public function edit_profile()
    {
        $this->render->view('master/editprofile');
    }

    public function update_profile()
    {
        $id       = $this->input->post('id');
        $username = $this->input->post('username');
        $email    = $this->input->post('email');
        $password = $this->input->post('password');
        $level    = $this->input->post('level_user');
        $status   = $this->input->post('status_user');

        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('level_user', 'Level', 'trim|required');
        $this->form_validation->set_rules('status_user', 'Status', 'trim|required');


        if ($this->form_validation->run()) {
            if ($password != "") {
                $save = array(
                    'username'    => $username,
                    'email'       => $email,
                    'password'    => password_hash($password, PASSWORD_DEFAULT),
                    'level_user'  => $level,
                    'status_user' => $status,
                );
                $this->db->where('id', $id);
                $this->db->update('users', $save);

                $response['error'] = false;
                $response['message'] = 'User updated.';
            } else {
                $save = array(
                    'username'    => $username,
                    'email'       => $email,
                    'level_user'  => $level,
                    'status_user' => $status,
                );
                $this->db->where('id', $id);
                $this->db->update('users', $save);

                $response['error'] = false;
                $response['message'] = 'User updated.';
            }
        } else {
            $response['error'] = true;
            $response['message'] = validation_errors();
        }


        echo json_encode($response, JSON_PRETTY_PRINT);
    }

    public function update()

    {
        $id       = $this->input->post('id');
        $username = $this->input->post('username');
        $email    = $this->input->post('email');
        $password = $this->input->post('password');
        $level    = $this->input->post('level_user');
        $status   = $this->input->post('status_user');

        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[3]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('level_user', 'Level', 'trim|required');
        $this->form_validation->set_rules('status_user', 'Status', 'trim|required');

        if ($this->form_validation->run()) {

            $save = array(
                'username'    => $username,
                'email'       => $email,
                'password'    => password_hash($password, PASSWORD_DEFAULT),
                'level_user'  => $level,
                'status_user' => $status,
            );
            $this->db->where('id', $id);
            $this->db->update('users', $save);

            $response['error'] = false;
            $response['message'] = 'User updated.';
        } else {
            $response['error'] = true;
            $response['message'] = validation_errors();
        }

        echo json_encode($response, JSON_PRETTY_PRINT);
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $this->db->where('id', $id);
        $this->db->delete('users');

        if ($this->db->affected_rows()) {
            $response['error'] = false;
            $response['message'] = 'User deleted.';
        } else {
            $response['error'] = true;
            $response['message'] = 'Failed to delete';
        }

        echo json_encode($response, JSON_PRETTY_PRINT);
    }
}

/* End of file Users.php */
