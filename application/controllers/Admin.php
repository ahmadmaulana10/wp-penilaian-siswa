<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
     public function __construct()
     {
          parent::__construct();
          if ($this->session->userdata('email')) {
               $email = $this->session->userdata('email');
               //mengambil role_id
               $role_id = $this->ModelUser->getUserByEmail($email)['role_id'];
               if ($role_id === "2") {
                    redirect('user');
               } elseif ($role_id === "3") {
                    redirect('kepsek');
               }
          } else {
               redirect('auth');
          }
     }

     public function index()
     {
          $data['title'] = "Admin";
          $data['user']  = $this->ModelAdmin->getTopbarName();

          $this->load->view('templates/header', $data);
          $this->load->view('templates/admin_sidebar');
          $this->load->view('templates/topbar');
          $this->load->view('admin/index');
          $this->load->view('templates/footer');
     }

     public function ubah_profil()
     {
          $data['title'] = 'Ubah Profile';
          $data['user']  = $this->ModelAdmin->getTopbarName();

          $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim', [
               'required' => "Nama lengkap harus diisi!"
          ]);

          if ($this->form_validation->run() == false) {
               $this->load->view('templates/header', $data);
               $this->load->view('templates/admin_sidebar');
               $this->load->view('templates/topbar', $data);
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
               $this->load->view('templates/admin_sidebar', $data);
               $this->load->view('templates/topbar', $data);
               $this->load->view('admin/ubah-password-admin', $data);
               $this->load->view('templates/footer');
          } else {
               $passlama = $this->input->post('passwordlama');
               $passbaru = $this->input->post('passwordbaru1');

               if (!password_verify($passlama, $data['user']['password'])) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password lama salah!</div>');
                    redirect('admin/ubahPassword');
               } else {
                    if ($passlama == $passbaru) {
                         $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password tidak boleh sama!</div>');
                         redirect('admin/ubahPassword');
                    } else {
                         // Password ok
                         $passhash = password_hash($passbaru, PASSWORD_DEFAULT);

                         $this->db->set('password', $passhash);
                         $this->db->where('email', $this->session->userdata('email'));
                         $this->db->update('user');

                         $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Password berhasil diubah!</div>');
                         redirect('admin/ubahPassword');
                    }
               }
          }
     }

     public function ubah_user($id)
     {
          $data['title'] = "Ubah User";
          $data['user']  = $this->ModelAdmin->getTopbarName();
          $data['user'] = $this->ModelUser->getUserById($id);

          $this->form_validation->set_rules('nama', 'Nama', 'required|min_length[3]', [
               'required' => 'Nama harus diisi',
               'min_length' => 'Nama terlalu pendek'
          ]);
          $this->form_validation->set_rules('email', 'Email', 'required|trim', [
               'required' => 'Email harus diisi',
          ]);
          $this->form_validation->set_rules('role_id', 'role_id', 'required', [
               'required' => "level harus pilih!",

          ]);
          $this->form_validation->set_rules('is_active', 'is_active', 'required', [
               'required' => "status harus pilih!",

          ]);

          if ($this->form_validation->run() == false) {
               $this->load->view('templates/header', $data);
               $this->load->view('templates/admin_sidebar', $data);
               $this->load->view('templates/topbar');
               $this->load->view('admin/v-ubah-user', $data);
               $this->load->view('templates/footer');
          } else {
               $upload_gambar = $_FILES['gambar']['nama'];
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
               $data = [
                    'nama' => $this->input->post('nama', true),
                    'email' => $this->input->post('email', true),
                    'role_id' => $this->input->post('role_id', true),
                    'is_active' => $this->input->post('is_active', true),
                    'gambar' => $upload_gambar
               ];

               $this->ModelUser->ubahUser($data);
               $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil diubah!</div>');
               redirect('admin/data_user');
          }
     }

     public function data_user()
     {
          $data['title'] = "Data User";
          $data['user']  = $this->ModelAdmin->getTopbarName();


          $config['base_url'] = base_url() . 'admin/data_user';
          $config['total_rows'] = $this->ModelUser->totalRows();
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
          $user['user']  = $this->ModelUser->getUsers($config['per_page'], $data['start']);
          $this->load->view('templates/header', $data);
          $this->load->view('templates/admin_sidebar');
          $this->load->view('templates/topbar');
          $this->load->view('admin/v-data-user', $user);
          $this->load->view('templates/footer');
     }

     public function detail_user($id)
     {
          $data['title'] = "Detail User";
          $data['user']  = $this->ModelAdmin->getTopbarName();
          $detail['user']  = $this->ModelUser->getUserById($id);

          $this->load->view('templates/header', $data);
          $this->load->view('templates/admin_sidebar');
          $this->load->view('templates/topbar');
          $this->load->view('admin/v-detail-user', $detail);
          $this->load->view('templates/footer');
     }

     public function tambah_user()
     {
          $data['title'] = "Tambah User";
          $data['user']  = $this->ModelAdmin->getTopbarName();

          $this->form_validation->set_rules('nama', 'Nama', 'required|min_length[3]', [
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
               'required' => "level harus pilih!",

          ]);
          $this->form_validation->set_rules('is_active', 'is_active', 'required', [
               'required' => "status harus pilih!",

          ]);

          if ($this->form_validation->run() == false) {
               $this->load->view('templates/header', $data);
               $this->load->view('templates/admin_sidebar');
               $this->load->view('templates/topbar');
               $this->load->view('admin/v-tambah-user', $data);
               $this->load->view('templates/footer');
          } else {
               $data = [
                    'nama' => $this->input->post('nama', true),
                    'email' => $this->input->post('email', true),
                    'gambar' => 'default.jpg',
                    'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                    'role_id' => $this->input->post('role_id', true),
                    'is_active' => $this->input->post('is_active', true),
                    'tanggal_buat' => time()
               ];
               $this->ModelUser->simpanData($data);

               $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Telah ditambah!</div>');
               redirect('admin/data_user');
          }
     }

     public function hapus_user($id)
     {
          $this->ModelAdmin->hapusUser($id);
          $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">User berhasil dihapus!</div>');
          redirect('admin/data_user');
     }

     public function tambah_siswa()
     {
          $data['title'] = "Tambah Siswa";
          $data['user']  = $this->ModelAdmin->getTopbarName();

          $this->form_validation->set_rules('nisn', 'NISN', 'required|min_length[8]|numeric', [
               'required' => 'NISN harus diisi !',
               'min_length' => 'NISN terlalu pendek !',
               'numeric' => 'Harus angka !'
          ]);

          $this->form_validation->set_rules('nama_siswa', 'Nama Siswa', 'required|min_length[3]', [
               'required' => 'Nama siswa harus diisi !',
               'min_length' => 'Nama siswa terlalu pendek !'
          ]);

          $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required|min_length[5]', [
               'required' => 'Tempat Lahir harus diisi !',
               'min_length' => 'Tempat Lahir terlalu pendek!'
          ]);

          $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required|trim', [
               'required' => 'Tanggal Lahir harus diisi !'
          ]);

          $this->form_validation->set_rules('agama', 'Tanggal Lahir', 'required|trim', [
               'required' => 'Agama harus dipilih !'
          ]);

          $this->form_validation->set_rules('alamat', 'Alamat', 'required', [
               'required' => 'Alamat harus diisi !',
          ]);

          $this->form_validation->set_rules('kelas', 'Kelas', 'required', [
               'required' => 'Kelas harus dipilih !',
          ]);

          $this->form_validation->set_rules('jk', 'JK', 'required|max_length[1]', [
               'required' => 'Jenis Kelamin harus diisi !',
               'max_length' => 'Hanya L atau P'
          ]);

          if ($this->form_validation->run() == false) {
               $this->load->view('templates/header', $data);
               $this->load->view('templates/admin_sidebar');
               $this->load->view('templates/topbar');
               $this->load->view('siswa/v-tambah-siswa', $data);
               $this->load->view('templates/footer');
          } else {
               $data = [
                    'nisn' => $this->input->post('nisn', true),
                    'nama_siswa' => $this->input->post('nama_siswa', true),
                    'tempat_lahir' => $this->input->post('tempat_lahir', true),
                    'tgl_lahir' => $this->input->post('tgl_lahir', true),
                    'agama' => $this->input->post('agama', true),
                    'alamat' => $this->input->post('alamat', true),
                    'kelas' => $this->input->post('kelas', true),
                    'indonesia' => 0,
                    'matematika' => 0,
                    'ipa' => 0,
                    'jk' => $this->input->post('jk', true),
                    'gambar' => 'default.jpg'
               ];

               $this->ModelSiswa->simpanData($data);
               $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Siswa Telah ditambah!</div>');
               redirect('admin/data_siswa');
          }
     }

     public function ubah_siswa($nisn)
     {
          $data['title'] = "Ubah Siswa";
          $data['user']  = $this->ModelAdmin->getTopbarName();
          $data['siswa'] = $this->ModelSiswa->getSiswaById($nisn);

          $this->form_validation->set_rules('nama_siswa', 'Nama Siswa', 'required|min_length[3]', [
               'required' => 'Nama siswa harus diisi !',
               'min_length' => 'Nama siswa terlalu pendek !'
          ]);

          $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required|min_length[5]', [
               'required' => 'Tempat Lahir harus diisi !',
               'min_length' => 'Tempat Lahir terlalu pendek!'
          ]);

          $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required|trim', [
               'required' => 'Tanggal Lahir harus diisi !'
          ]);

          $this->form_validation->set_rules('agama', 'Agama', 'required|trim', [
               'required' => 'Agama harus diisi !'
          ]);

          $this->form_validation->set_rules('alamat', 'Alamat', 'required', [
               'required' => 'Alamat harus diisi !',
          ]);

          $this->form_validation->set_rules('kelas', 'Kelas', 'required', [
               'required' => 'Kelas harus dipilih !',
          ]);

          $this->form_validation->set_rules('jk', 'JK', 'required|max_length[1]', [
               'required' => 'Jenis Kelamin harus diisi !',
               'max_length' => 'Hanya L atau P'
          ]);
          if ($this->form_validation->run() == false) {
               $this->load->view('templates/header', $data);
               $this->load->view('templates/admin_sidebar', $data);
               $this->load->view('templates/topbar');
               $this->load->view('siswa/v-ubah-siswa', $data);
               $this->load->view('templates/footer');
          } else {
               $data = [
                    // 'nisn' => $this->input->post('nisn', true),
                    'nama_siswa' => $this->input->post('nama_siswa', true),
                    'tempat_lahir' => $this->input->post('tempat_lahir', true),
                    'tgl_lahir' => $this->input->post('tgl_lahir', true),
                    'agama' => $this->input->post('agama', true),
                    'alamat' => $this->input->post('alamat', true),
                    'kelas' => $this->input->post('kelas', true),
                    'jk' => $this->input->post('jk', true),
               ];

               $this->ModelSiswa->ubahSiswa($data);
               $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil diubah!</div>');
               redirect('admin/data_siswa');
          }
     }

     public function siswa($nisn)
     {
          $detail['siswa']  = $this->ModelSiswa->getSiswaById($nisn);
          echo json_encode($detail);
     }

     public function data_siswa()
     {
          $data['title'] = "Data Siswa";
          $data['user']  = $this->ModelUser->getTopbarName();


          $config['base_url'] = base_url() . 'admin/data_siswa';
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
          $this->load->view('templates/admin_sidebar');
          $this->load->view('templates/topbar', $data);
          $this->load->view('siswa/v-data-siswa', $user);
          $this->load->view('templates/footer');
     }

     public function detail_siswa($nisn)
     {
          $data['title'] = "Detail User";
          $data['user']  = $this->ModelAdmin->getTopbarName();
          $detail['siswa']  = $this->ModelSiswa->getSiswaById($nisn);

          $this->load->view('templates/header', $data);
          $this->load->view('templates/admin_sidebar');
          $this->load->view('templates/topbar', $data);
          $this->load->view('siswa/v-detail-siswa', $detail);
          $this->load->view('templates/footer');
     }

     public function hapus_siswa($nisn)
     {
          $this->ModelSiswa->hapusSiswa($nisn);
          $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Siswa berhasil dihapus!</div>');
          redirect('admin/data_siswa');
     }

     public function data_guru()
     {
          $data['title'] = "Data Guru";
          $data['user']  = $this->ModelUser->getTopbarName();


          $config['base_url'] = base_url() . 'admin/data_guru';
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
          $this->load->view('templates/admin_sidebar');
          $this->load->view('templates/topbar', $data);
          $this->load->view('guru/v-data-guru', $data);
          $this->load->view('templates/footer');
     }

     public function tambah_guru()
     {
          $data['title'] = "Tambah Guru";
          $data['user']  = $this->ModelAdmin->getTopbarName();

          $this->form_validation->set_rules('nip', 'NIP', 'required|min_length[8]|numeric', [
               'required' => 'NIP harus diisi !',
               'min_length' => 'NIP terlalu pendek !',
               'numeric' => 'Harus angka !'
          ]);

          $this->form_validation->set_rules('nama_guru', 'Nama Guru', 'required|min_length[3]', [
               'required' => 'Nama Guru harus diisi !',
               'min_length' => 'Nama Guru terlalu pendek !'
          ]);

          $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required|min_length[5]', [
               'required' => 'Tempat Lahir harus diisi !',
               'min_length' => 'Tempat Lahir terlalu pendek!'
          ]);

          $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required|trim', [
               'required' => 'Tanggal Lahir harus diisi !'
          ]);

          $this->form_validation->set_rules('jk', 'JK', 'required|max_length[1]', [
               'required' => 'Jenis Kelamin harus diisi !',
               'max_length' => 'Hanya L atau P'
          ]);

          if ($this->form_validation->run() == false) {
               $this->load->view('templates/header', $data);
               $this->load->view('templates/admin_sidebar');
               $this->load->view('templates/topbar');
               $this->load->view('guru/v-tambah-guru', $data);
               $this->load->view('templates/footer');
          } else {
               $data = [
                    'nip' => $this->input->post('nip', true),
                    'nama_guru' => $this->input->post('nama_guru', true),
                    'tgl_lahir' => $this->input->post('tgl_lahir', true),
                    'tempat_lahir' => $this->input->post('tempat_lahir', true),
                    'jk' => $this->input->post('jk', true),
               ];

               $this->ModelGuru->simpanGuru($data);
               $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Guru Telah ditambah!</div>');
               redirect('admin/data_guru');
          }
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

     public function ubah_guru($nip)
     {
          $data['title'] = "Ubah Siswa";
          $data['user']  = $this->ModelAdmin->getTopbarName();
          $data['guru'] = $this->ModelGuru->getGuruById($nip);

          $this->form_validation->set_rules('nama_guru', 'Nama Guru', 'required|min_length[3]', [
               'required' => 'Nama siswa harus diisi !',
               'min_length' => 'Nama siswa terlalu pendek !'
          ]);

          $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required|min_length[5]', [
               'required' => 'Tempat Lahir harus diisi !',
               'min_length' => 'Tempat Lahir terlalu pendek!'
          ]);

          $this->form_validation->set_rules('tgl_lahir', 'Tanggal Lahir', 'required|trim', [
               'required' => 'Tanggal Lahir harus diisi !'
          ]);

          $this->form_validation->set_rules('jk', 'JK', 'required|max_length[1]', [
               'required' => 'Jenis Kelamin harus diisi !',
               'max_length' => 'Hanya L atau P'
          ]);
          if ($this->form_validation->run() == false) {
               $this->load->view('templates/header', $data);
               $this->load->view('templates/admin_sidebar', $data);
               $this->load->view('templates/topbar');
               $this->load->view('guru/v-ubah-guru', $data);
               $this->load->view('templates/footer');
          } else {
               $data = [
                    'nama_guru' => $this->input->post('nama_guru', true),
                    'tempat_lahir' => $this->input->post('tempat_lahir', true),
                    'tgl_lahir' => $this->input->post('tgl_lahir', true),
                    'jk' => $this->input->post('jk', true),
               ];

               $this->ModelGuru->ubahGuru($data);
               $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data Berhasil diubah!</div>');
               redirect('admin/data_guru');
          }
     }

     public function hapus_Guru($nip)
     {
          $this->ModelGuru->hapusGuru($nip);
          $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Guru berhasil dihapus!</div>');
          redirect('admin/data_guru');
     }
}
