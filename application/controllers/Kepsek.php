<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kepsek extends CI_Controller
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
               } elseif ($role_id === "2") {
                    redirect('user');
               }
          } else if (!$this->session->userdata('email')) {
               redirect('auth');
          }
     }

     public function index()
     {
          $data['title'] = "Kepala Sekolah";
          $data['user']  = $this->ModelKepsek->getTopbarName();

          $this->load->view('templates/header', $data);
          $this->load->view('templates/kepsek_sidebar');
          $this->load->view('templates/topbar', $data);
          $this->load->view('admin/index', $data);
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
               $this->load->view('templates/kepsek_sidebar', $data);
               $this->load->view('templates/topbar', $data);
               $this->load->view('kepsek/ubah-profil', $data);
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
               redirect('kepsek');
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
               $this->load->view('templates/kepsek_sidebar', $data);
               $this->load->view('templates/topbar', $data);
               $this->load->view('kepsek/ubah-password', $data);
               $this->load->view('templates/footer');
          } else {
               $passlama = $this->input->post('passwordlama');
               $passbaru = $this->input->post('passwordbaru1');

               if (!password_verify($passlama, $data['user']['password'])) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password lama salah!</div>');
                    redirect('kepsek/ubahPassword');
               } else {
                    if ($passlama == $passbaru) {
                         $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password tidak boleh sama!</div>');
                         redirect('kepsek/ubahPassword');
                    } else {
                         // Password ok
                         $passhash = password_hash($passbaru, PASSWORD_DEFAULT);

                         $this->db->set('password', $passhash);
                         $this->db->where('email', $this->session->userdata('email'));
                         $this->db->update('user');

                         $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password berhasil diubah!</div>');
                         redirect('kepsek/ubahPassword');
                    }
               }
          }
     }


     public function data_siswa()
     {
          $data['title'] = "Data Siswa";
          $data['user']  = $this->ModelUser->getTopbarName();


          $config['base_url'] = base_url() . 'kepsek/data_siswa';
          $config['total_rows'] = $this->ModelSiswa->totalRows();
          $config['per_page'] = 10;

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
          $user['siswa']  = $this->ModelSiswa->getUsers($config['per_page'], $data['start']);

          $this->load->view('templates/header', $data);
          $this->load->view('templates/kepsek_sidebar');
          $this->load->view('templates/topbar', $data);
          $this->load->view('kepsek/v-data-siswa', $user);
          $this->load->view('templates/footer');
     }

     public function detail_siswa($nisn)
     {
          $data['title'] = "Detail User";
          $data['user']  = $this->ModelAdmin->getTopbarName();
          $detail['siswa']  = $this->ModelSiswa->getSiswaById($nisn);

          $this->load->view('templates/header', $data);
          $this->load->view('templates/kepsek_sidebar');
          $this->load->view('templates/topbar', $data);
          $this->load->view('kepsek/v-detail-siswa', $detail);
          $this->load->view('templates/footer');
     }

     public function data_guru()
     {
          $data['title'] = "Data Guru";
          $data['user']  = $this->ModelUser->getTopbarName();


          $config['base_url'] = base_url() . 'kepsek/data_guru';
          $config['total_rows'] = $this->ModelGuru->totalRows();
          $config['per_page'] = 10;

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
          $data['guru']  = $this->ModelGuru->getUsers($config['per_page'], $data['start']);

          $this->load->view('templates/header', $data);
          $this->load->view('templates/kepsek_sidebar');
          $this->load->view('templates/topbar', $data);
          $this->load->view('kepsek/v-data-guru', $data);
          $this->load->view('templates/footer');
     }

     public function detail_guru($nip)
     {
          $data['title'] = "Detail Guru";
          $data['user']  = $this->ModelAdmin->getTopbarName();
          $detail['guru']  = $this->ModelGuru->getGuruById($nip);

          $this->load->view('templates/header', $data);
          $this->load->view('templates/admin_sidebar');
          $this->load->view('templates/topbar', $data);
          $this->load->view('guru/v-detail-guru', $detail);
          $this->load->view('templates/footer');
     }

     public function data_nilai()
     {
          $data['user']  = $this->ModelUser->getTopbarName();
          $data['title'] = "Nilai Siswa";

          $config['base_url'] = base_url() . 'kepsek/data_nilai';
          $config['total_rows'] = $this->ModelSiswa->totalRows();
          $config['per_page'] = 10;

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
          $user['siswa']  = $this->ModelSiswa->getUsers($config['per_page'], $data['start']);

          $this->load->view('templates/header', $data);
          $this->load->view('templates/kepsek_sidebar');
          $this->load->view('templates/topbar');
          $this->load->view('kepsek/v-nilai-siswa', $user);
          $this->load->view('templates/footer');
     }

     public function detail_nilai($nisn)
     {
          $data['title'] = "Detail Nilai Siswa";
          $data['user']  = $this->ModelUser->getTopbarName();
          $detail['siswa']  = $this->ModelNilai->getSiswaById($nisn);

          $this->load->view('templates/header', $data);
          $this->load->view('templates/kepsek_sidebar');
          $this->load->view('templates/topbar');
          $this->load->view('kepsek/v-detail-nilai', $detail);
          $this->load->view('templates/footer');
     }
}
