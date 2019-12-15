<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelKepsek extends CI_Model
{
     public function getTopbarName()
     {
          return $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
     }

     public function getUserByEmail($email)
     {
          return $this->db->get_where('user', ['email' => $email])->row_array();
     }
}
