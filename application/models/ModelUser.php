<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelUser extends CI_Model
{
     public function getTopbarName()
     {
          return $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
     }

     public function getUserById($id)
     {
          return $this->db->get_where('user', ['id' => $id])->row_array();
     }

     public function getUserWhere($where = null)
     {
          return $this->db->get_where('user', $where);
     }

     public function ubahUser()
     {
          $data = [
               'nama' => $this->input->post('nama', true),
               'email' => $this->input->post('email', true),
               'role_id' => $this->input->post('role_id', true),
               'is_active' => $this->input->post('is_active', true)
          ];

          $this->db->where('id', $this->input->post('id'));
          $this->db->update('user', $data);
     }

     public function getUser()
     {
          return $this->db->get('user')->result_array();
     }

     public function getUsers($limit, $start)
     {
          return $this->db->get('user', $limit, $start)->result_array();
     }

     public function simpanData($data = null)
     {
          $this->db->insert('user', $data);
     }

     public function updateUser($data = 'user', $where = null)
     {
          $this->db->update('user', $data, $where);
     }

     public function totalRows()
     {
          return $this->db->get('user')->num_rows();
     }

     public function getUserByEmail($email)
     {
          return $this->db->get_where('user', ['email' => $email])->row_array();
     }
}
