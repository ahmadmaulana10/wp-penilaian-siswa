<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelAdmin extends CI_Model
{
     public function getTopbarName()
     {
          return $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
     }

     public function hapusUser($id)
     {
          $this->db->where('id', $id);
          $this->db->delete('user');
     }

     public function getUserById($id)
     {
          return $this->db->get_where('user', ['id' => $id])->row_array();
     }
}
