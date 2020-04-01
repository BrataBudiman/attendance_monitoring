<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

   public function index()
   {
      // $this->db->select('NAME as name');
      
      $this->db->from('Machines');
      $db = $this->db->get()->result();
      
      
      echo "<pre>";
      print_r ($db);
      echo "</pre>";
      die();
   }

   public function cekUser() 
   {
      $this->db->from('USERINFO');
      $db = $this->db->get()->result();
      echo "<pre>";
      print_r ($db);
      echo "</pre>";
      die();
   }

   public function cekTransaction()
   {
      $this->db->from('CHECKINOUT');
      $db = $this->db->get()->result();
      echo "<pre>";
      print_r ($db);
      echo "</pre>";
      die();
   }

}

/* End of file Main.php */
