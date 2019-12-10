<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
     public function __construct()
     {
          parent::__construct();
          is_login();
     }

     public function index()
     {
          $data['title'] = "User";
          $data['user']  = $this->ModelUser->getTopbarName();

          $this->load->view('templates/header', $data);
          $this->load->view('templates/topbar', $data);
          $this->load->view('templates/sidebar');
          $this->load->view('user/index', $data);
          $this->load->view('templates/footer');
     }

     public function ubahProfile()
     {
          $data['title'] = 'Ubah Profile';
          $data['user']  = $this->ModelUser->getTopbarName();

          $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim', [
               'required' => "Nama lengkap harus diisi!"
          ]);

          if ($this->form_validation->run() == false) {
               $this->load->view('templates/header', $data);
               $this->load->view('templates/sidebar', $data);
               $this->load->view('templates/topbar', $data);
               $this->load->view('user/ubah-profile', $data);
               $this->load->view('templates/footer');
          } else {
               $nama = $this->input->post('nama', true);
               $email = $this->input->post('email', true);

               //jika ada gambar yang akan diupload
               $upload_gambar = $_FILES['gambar']['name'];
               if ($upload_gambar) {
                    $config['upload_path'] = './assets/img/profile/';
                    $config['allowed_types'] = 'gif|jpg|png';
                    $config['max_size'] = '3000';
                    $config['max_width'] = '1024';
                    $config['max_height'] = '1000';
                    $config['file_name'] = 'pro' . time();
                    $this->load->library('upload', $config);
                    if ($this->upload->do_upload('gambar')) {
                         $gambar_lama = $data['user']['gambar'];
                         if ($gambar_lama != 'default.jpg') {
                              unlink(FCPATH . 'assets/img/profile/' . $gambar_lama);
                         }
                         $gambar_baru = $this->upload->data('file_name');
                         $this->db->set('gambar', $gambar_baru);
                    } else {
                         echo $this->upload->display_errors();
                    }
               }

               $this->db->set('nama', $nama);
               $this->db->where('email', $email);
               $this->db->update('user');

               $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Profile berhasil diubah!</div>');
               redirect('user');
          }
     }

     public function ubahPassword()
     {
          $data['title'] = "Ubah Password";
          $data['user']  = $this->ModelUser->getTopbarName();

          $this->load->view('templates/header', $data);
          $this->load->view('templates/sidebar', $data);
          $this->load->view('templates/topbar', $data);
          $this->load->view('user/ubah-password', $data);
          $this->load->view('templates/footer');
     }
}
