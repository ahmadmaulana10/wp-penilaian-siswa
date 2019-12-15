<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
     public function __construct()
     {
          parent::__construct();
          if ($this->session->userdata('email')) {
               $email = $this->session->userdata('email');
               //mengambil role_id
               $role_id = $this->ModelUser->getUserByEmail($email)['role_id'];
               if ($role_id === "1") {
                    redirect('admin');
               } elseif ($role_id === "3") {
                    redirect('kepsek');
               }
          } else {
               redirect('auth');
          }
     }

     public function index()
     {
          $data['title'] = "User";
          $data['user']  = $this->ModelUser->getTopbarName();

          $this->load->view('templates/header', $data);
          $this->load->view('templates/user_sidebar');
          $this->load->view('templates/topbar', $data);
          $this->load->view('user/index', $data);
          $this->load->view('templates/footer');
     }

     public function ubah_profil()
     {
          $data['title'] = 'Ubah Profile';
          $data['user']  = $this->ModelUser->getTopbarName();

          $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim', [
               'required' => "Nama lengkap harus diisi!"
          ]);

          if ($this->form_validation->run() == false) {
               $this->load->view('templates/header', $data);
               $this->load->view('templates/user_sidebar', $data);
               $this->load->view('templates/topbar', $data);
               $this->load->view('user/ubah-profil', $data);
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
          $data['title'] = 'Ubah Password';
          $data['user']  = $this->ModelUser->getTopbarName();

          $this->form_validation->set_rules('passwordlama', 'Password Lama', 'required|trim', [
               'required' => "Password harus diisi!"
          ]);

          $this->form_validation->set_rules('passwordbaru1', 'Password Baru', 'required|trim|min_length[6]|matches[passwordbaru2]', [
               'required' => 'Password baru harus diisi!',
               'min_length' => 'Password minimal 6 karakter!',
               'matches' => 'Password tidak sama!'
          ]);

          $this->form_validation->set_rules('passwordbaru2', 'Ulangi password baru', 'required|trim|min_length[6]|matches[passwordbaru1]', [
               'required' => 'Password baru harus diisi!',
               'min_length' => 'Password minimal 6 karakter!',
               'matches' => 'Password tidak sama!'
          ]);

          if ($this->form_validation->run() == false) {
               $this->load->view('templates/header', $data);
               $this->load->view('templates/user_sidebar', $data);
               $this->load->view('templates/topbar', $data);
               $this->load->view('user/ubah-password', $data);
               $this->load->view('templates/footer');
          } else {
               $passlama = $this->input->post('passwordlama');
               $passbaru = $this->input->post('passwordbaru1');

               if (!password_verify($passlama, $data['user']['password'])) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password lama salah!</div>');
                    redirect('user/ubahPassword');
               } else {
                    if ($passlama == $passbaru) {
                         $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password tidak boleh sama!</div>');
                         redirect('user/ubahPassword');
                    } else {
                         // Password ok
                         $passhash = password_hash($passbaru, PASSWORD_DEFAULT);

                         $this->db->set('password', $passhash);
                         $this->db->where('email', $this->session->userdata('email'));
                         $this->db->update('user');

                         $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password berhasil diubah!</div>');
                         redirect('user/ubahPassword');
                    }
               }
          }
     }
}
