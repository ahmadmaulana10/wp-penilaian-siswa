<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelUser extends CI_Model
{
     public function getTopbarName()
     {
          return $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
     }

     public function getUser()
     {
          return $this->db->get('user')->result_array();
     }

     public function getUserById($id)
     {
          return $this->db->get_where('user', ['id' => $id])->row_array();
     }

     public function getUserByEmail($email)
     {
          return $this->db->get_where('user', ['email' => $email])->row_array();
     }
}
