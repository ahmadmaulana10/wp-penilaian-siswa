<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
     public function __construct()
     {
          parent::__construct();
          is_login();
     }

     public function index()
     {
          $data['title'] = "Admin";
          $data['user']  = $this->ModelAdmin->getTopbarName();

          $this->load->view('templates/header', $data);
          $this->load->view('templates/sidebar');
          $this->load->view('templates/topbar');
          $this->load->view('admin/index');
          $this->load->view('templates/footer');
     }


     public function ubah_profil()
     {
          $data['title'] = "Ubah Profil";
          $data['user']  = $this->ModelAdmin->getTopbarName();

          $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim', [
               'required' => "Nama lengkap harus diisi!"
          ]);

          if ($this->form_validation->run() == false) {
               $this->load->view('templates/header', $data);
               $this->load->view('templates/sidebar');
               $this->load->view('templates/topbar');
               $this->load->view('admin/ubah-profil', $data);
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
               redirect('admin');
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
               $this->load->view('templates/sidebar', $data);
               $this->load->view('templates/topbar', $data);
               $this->load->view('admin/ubah-password-admin', $data);
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

     public function data_user()
     {
          $data['title'] = "Data User";
          $data['user']  = $this->ModelAdmin->getTopbarName();


          $config['base_url'] = base_url() . 'admin/data_user';
          $config['total_rows'] = $this->ModelUser->totalRows();
          $config['per_page'] = 2;

          //styling pagination dengan bootstrap
          $config['full_tag_open'] = '<nav><ul class="pagination">';
          $config['full_tag_close'] = '</ul></nav>';

          $config['first_link'] = 'First';
          $config['first_tag_open'] = '<li class="page-item">';
          $config['first_tag_close'] = '</li>';

          $config['last_link'] = 'Last';
          $config['last_tag_open'] = '<li class="page-item">';
          $config['last_tag_close'] = '</li>';

          $config['next_link'] = '&raquo';
          $config['next_tag_open'] = '<li class="page-item">';
          $config['next_tag_close'] = '</li>';

          $config['prev_link'] = '&laquo';
          $config['prev_tag_open'] = '<li class="page-item">';
          $config['prev_tag_close'] = '</li>';

          $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
          $config['cur_tag_close'] = '</a></li>';

          $config['num_tag_open'] = '<li class="page-item">';
          $config['num_tag_close'] = '</li>';

          $config['attributes'] = array('class' => 'page-link');

          $this->pagination->initialize($config);

          $data['start'] = $this->uri->segment(3);
          $user['user']  = $this->ModelUser->getUsers($config['per_page'], $data['start']);
          $this->load->view('templates/header', $data);
          $this->load->view('templates/sidebar');
          $this->load->view('templates/topbar');
          $this->load->view('admin/v-data-user', $user);
          $this->load->view('templates/footer');
     }

     public function detail_user($id)
     {
          $data['title'] = "Detail User";
          $data['user']  = $this->ModelAdmin->getTopbarName();
          $data['user']  = $this->ModelUser->getUserById($id);

          $this->load->view('templates/header', $data);
          $this->load->view('templates/sidebar');
          $this->load->view('templates/topbar');
          $this->load->view('admin/v-detail-user', $data);
          $this->load->view('templates/footer');
     }

     public function tambah_user()
     {
          $data['title'] = "Tambah User";
          $data['user']  = $this->ModelAdmin->getTopbarName();

          $this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
               'required' => 'Nama harus diisi',
               'min_length' => 'Nama terlalu pendek'
          ]);
          $this->form_validation->set_rules('email', 'Email', 'required|trim', [
               'required' => 'Email harus diisi',
          ]);
          $this->form_validation->set_rules('password', 'Password', 'required|trim', [
               'required' => "Password harus diisi!"
          ]);
          $this->form_validation->set_rules('role_id', 'role_id', 'required', [
               'required' => "role harus diisi!"
          ]);
          $this->form_validation->set_rules('is_active', 'is_active', 'required', [
               'required' => "role harus diisi!"
          ]);

          //jika ada gambar yang akan diupload
          $config['upload_path'] = './assets/img/profile/';
          $config['allowed_types'] = 'gif|jpg|png';
          $config['max_size'] = '3000';
          $config['max_width'] = '1024';
          $config['max_height'] = '1000';
          $config['file_name'] = 'pro' . time();

          $this->load->library('upload', $config);
          if ($this->form_validation->run() == false) {
               $this->load->view('templates/header', $data);
               $this->load->view('templates/sidebar');
               $this->load->view('templates/topbar');
               $this->load->view('admin/v-tambah-user', $data);
               $this->load->view('templates/footer');
          } else {
               if ($this->upload->do_upload('image')) {
                    $image = $this->upload->data();
                    $gambar = $image['file_name'];
               } else {
                    $gambar = '';
               }
               $data = [
                    'nama' => $this->input->post('nama', true),
                    'email' => $this->input->post('email', true),
                    'gambar' => $gambar,
                    'password' => $this->input->post('password', true),
                    'role_id' => $this->input->post('role_id', true),
                    'is_active' => $this->input->post('is_active', true),
                    'tanggal_buat' => date('Y M d')
               ];
               $this->load->library('upload', $config);
               $this->ModelUser->simpanData($data);


               $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data  Telah ditambah!</div>');
               redirect('admin/data_user');
          }
     }

     public function hapus_user($id)
     {
          $this->ModelAdmin->hapusUser($id);
          $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">User berhasil dihapus!</div>');
          redirect('admin/data_user');
     }
}
