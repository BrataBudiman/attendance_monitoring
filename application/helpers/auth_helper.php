<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Payroll application
 * 
 * 
 * @package Auth Helper
 * @since 2017
 * @version 1.0.0
 * @copyright 2019 KanKetik
 * @author Adi adistwn09@gmail.com
 * @author Brata
 */

if ( ! function_exists('is_level') )
{
    function is_level($level, $redirect = true)
    {
        $CI =& get_instance();
        $session_level = $CI->session->userdata('level');
        
        if ( ! in_array($session_level, $level) )
        {
            if ($redirect === true)
            {
                redirect('home');
            }
            else
            {
                $res['message'] = 'Forbidden Access!';
                $res['error']   = true;
                echo json_encode($res); exit;
            }
        }
    }
}

if ( ! function_exists('is_login') )
{
    function is_login()
    {
        $CI =& get_instance();
        $id_account = $CI->session->userdata('id_account');

        if ( ! $id_account )
        {
            redirect('login');
        }
    }
}