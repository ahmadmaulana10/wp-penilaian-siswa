<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

     private function cek_login()
     {
          if ($this->session->userdata('email')) {

               $email = $this->session->userdata('email');

               //mengambil role_id
               $role_id = $this->ModelUser->getUserByEmail($email)['role_id'];
               if ($role_id === "1") {
                    redirect('admin');
               } elseif ($role_id === "2") {
                    redirect('user');
               } elseif ($role_id === "3") {
                    redirect('kepsek');
               }
          }
     }

     public function index()
     {
          $this->cek_login();

          $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
               'required' => 'Email harus diisi!',
               'valid_email' => 'Format email tidak sesuai!'
          ]);

          $this->form_validation->set_rules('password', 'Password', 'required|trim', [
               'required' => 'Password harus diisi!'
          ]);

          if ($this->form_validation->run() == false) {
               $data['title'] = "Login";

               $this->load->view('templates/auth_header', $data);
               $this->load->view('auth/index');
               $this->load->view('templates/auth_footer');
          } else {
               //Jika validasi berhasil
               $this->_login();
          }
     }

     private function _login()
     {
          $email = $this->input->post('email');
          $password = $this->input->post('password');

          $user = $this->db->get_where('user', ['email' => $email])->row_array();

          //Usernya ada
          if ($user) {

               //User aktif
               if ($user['is_active'] == 1) {

                    //Cek Password
                    if (password_verify($password, $user['password'])) {
                         $data = [
                              'email' => $user['email'],
                              'role_id' => $user['role_id'],
                         ];
                         $this->session->set_userdata($data);

                         //Cek jika dia admin atau user
                         if ($user['role_id'] == 1) {
                              redirect('admin');
                         } elseif ($user['role_id'] == 2) {
                              redirect('user');
                         } elseif ($user['role_id'] == 3) {
                              redirect('kepsek');
                         } else {
                              $this->load->view('user/blok');
                         }
                    } else {
                         $this->session->set_flashdata(
                              'message',
                              '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                   </button>Password salah!
                              </div>'
                         );
                         redirect('auth');
                    }
               } else {
                    $this->session->set_flashdata(
                         'message',
                         '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                   <span aria-hidden="true">&times;</span>
                              </button>Email belum aktif!
                         </div>'
                    );
                    redirect('auth');
               }
          } else {
               $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                         </button>Email tidak terdaftar!
                    </div>'
               );
               redirect('auth');
          }
     }

     public function registration()
     {
          if ($this->session->userdata('email')) {
               redirect('user');
          }

          $this->form_validation->set_rules('nama', 'Nama', 'required|trim', [
               'required' => 'Nama harus diisi!'
          ]);

          $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
               'required'  => 'Email harus diisi!',
               'is_unique' => 'Email sudah terdaftar!'
          ]);

          $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]', [
               'matches'    => 'Password tidak sama!',
               'min_length' => 'Password terlalu pendek!',
               'required'   => 'Password harus diisi!'
          ]);
          $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');


          if ($this->form_validation->run() == false) {
               $data['title'] = "Registrasi";

               $this->load->view('templates/auth_header', $data);
               $this->load->view('auth/registration');
               $this->load->view('templates/auth_footer');
          } else {
               $email = $this->input->post('email', true);

               $data = [
                    'nama'         => htmlspecialchars($this->input->post('nama', true)),
                    'email'        => htmlspecialchars($email),
                    'gambar'       => 'default.jpg',
                    'password'     => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                    'role_id'      => 2,
                    'is_active'    => 0,
                    'tanggal_buat' => time()
               ];

               // Siapkan token
               $token = base64_encode(random_bytes(32));
               $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'tanggal_buat' => time()
               ];

               $this->db->insert('user', $data);
               $this->db->insert('user_token', $user_token);

               $this->_sendemail($token, 'verifikasi');

               $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success alert-dismissible fade show" role="alert">
                         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                         </button>Berhasil daftar akun. Silahkan aktivasi akun anda!
                    </div>'
               );
               redirect('auth');
          }
     }

     private function _sendemail($token, $type)
     {
          $config = [
               'protocol'  => 'mail',
               'smtp_host' => 'ssl://smtp.googlemail.com',
               'smtp_user' => 'suryai12180308@bsi.ac.id',
               'smtp_pass' => '1999-05-01',
               'smtp_port' =>  587,
               'mailtype'  => 'html',
               'charset'   => 'utf-8',
               'newline'   => "\r\n"
          ];

          $this->load->library('email', $config);
          $this->email->initialize($config);  //tambahkan baris ini

          $this->email->from('suryai12180308@bsi.ac.id', 'Web Penilaian Siswa');
          $this->email->to($this->input->post('email'));

          if ($type == 'verifikasi') {
               $this->email->subject('Aktivasi Akun');
               $this->email->message('Klik link ini untuk aktivasi akun anda : <a href="'
                    . base_url()
                    . 'auth/verifikasi?email='
                    . $this->input->post('email')
                    . '&token='
                    . urlencode($token)
                    . '">Aktivasi</a>');
          } elseif ($type == 'lupa') {
               $this->email->subject('Reset Password');
               $this->email->message('Klik link ini untuk reset password anda : <a href="'
                    . base_url()
                    . 'auth/reset-password?email='
                    . $this->input->post('email')
                    . '&token='
                    . urlencode($token)
                    . '">Reset Password</a>');
          }

          if ($this->email->send()) {
               return true;
          } else {
               echo $this->email->print_debugger();
               die;
          }
     }

     public function verifikasi()
     {
          $email = $this->input->get('email');
          $token = $this->input->get('token');

          // Cek apakah benar si user menggunakan email
          // agar url tidak bisa dimanipulasi
          $user = $this->db->get_where('user', ['email' => $email])->row_array();

          // Cek kalo ada user
          if ($user) {
               $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

               // Jika ada
               if ($user_token) {

                    // Mengatur valid token
                    // jika lebih dari 1 hari maka token akan hangus
                    if (time() - $user_token['tanggal_buat'] < (60 * 60 * 24)) {
                         $this->db->set('is_active', 1);
                         $this->db->where('email', $email);
                         $this->db->update('user');
                         $this->db->delete('user_token', ['email' => $email]);

                         $this->session->set_flashdata(
                              'message',
                              '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                   </button>' . $email . ' Telah berhasil di aktivasi. Silahkan login!
                              </div>'
                         );
                         redirect('auth');
                    } else {
                         $this->db->delete('user', ['email' => $email]);
                         $this->db->delete('user_token', ['email' => $email]);

                         $this->session->set_flashdata(
                              'message',
                              '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                   <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                   </button>Token tidak berlaku!
                              </div>'
                         );
                         redirect('auth');
                    }
               } else {
                    $this->session->set_flashdata(
                         'message',
                         '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                   <span aria-hidden="true">&times;</span>
                              </button>Token salah!
                         </div>'
                    );
                    redirect('auth');
               }
          } else {
               $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                         </button>Aktifasi akun gagal!
                    </div>'
               );
               redirect('auth');
          }
     }

     public function lupaPassword()
     {
          $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email', [
               'required' => 'Email harus diisi!',
               'valid_email' => 'Format email tidak sesuai!'
          ]);

          if ($this->form_validation->run() == false) {
               $data['title'] = "Lupa Password";
               $this->load->view('templates/auth_header', $data);
               $this->load->view('auth/lupa-password');
               $this->load->view('templates/auth_footer');
          } else {
               $email = $this->input->post('email');
               $user  = $this->db->get_where('user', ['email' => $email, 'is_active' => 1])->row_array();

               // Kalo ada isinya bikin token lagi
               if ($user) {
                    $token = base64_encode(random_bytes(32));
                    $user_token = [
                         'email'         => $email,
                         'token'         => $token,
                         'tanggal_buat'  => time()
                    ];

                    $this->db->insert('user_token', $user_token);
                    $this->_sendemail($token, 'lupa');

                    $this->session->set_flashdata(
                         'message',
                         '<div class="alert alert-success alert-dismissible fade show" role="alert">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                   <span aria-hidden="true">&times;</span>
                              </button>Silahkan cek email anda!
                         </div>'
                    );
                    redirect('auth/lupaPassword');
               } else {
                    $this->session->set_flashdata(
                         'message',
                         '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                   <span aria-hidden="true">&times;</span>
                              </button>Email belum terdaftar atau diaktivasi!
                         </div>'
                    );
                    redirect('auth/lupaPassword');
               }
          }
     }

     public function resetpassword()
     {
          $email = $this->input->get('email');
          $token = $this->input->get('token');

          $user = $this->db->get_where('user', ['email' => $email])->row_array();

          if ($user) {
               $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

               // Validasi jika token dibuat sendiri oleh user
               if ($user_token) {
                    $this->session->set_userdata('reset_email', $email);
                    $this->ubahPassword();
               } else {
                    $this->session->set_flashdata(
                         'message',
                         '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                   <span aria-hidden="true">&times;</span>
                              </button>Token salah!
                         </div>'
                    );
                    redirect('auth');
               }
          } else {
               $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                         </button>Reset password gagal! Email salah!
                    </div>'
               );
               redirect('auth');
          }
     }

     public function ubahPassword()
     {
          if (!$this->session->userdata('reset_email')) {
               redirect('auth');
          }

          $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]', [
               'required' => "Password tidak boleh kosong!",
               'min_length' => "Minimal 6 karakter!",
               'matches' => "Password tidak sama!"
          ]);

          $this->form_validation->set_rules('password2', 'Ulangi Password', 'required|trim|min_length[6]|matches[password1]', [
               'required' => "Password tidak boleh kosong!",
               'min_length' => "Minimal 6 karakter!",
               'matches' => "Password tidak sama!"
          ]);

          if ($this->form_validation->run() == false) {
               $data['title'] = "Ubah Password";
               $this->load->view('templates/auth_header', $data);
               $this->load->view('auth/ubah-password');
               $this->load->view('templates/auth_footer');
          } else {
               $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
               $email = $this->session->userdata('reset_email');

               $this->db->set('password', $password);
               $this->db->where('email', $email);
               $this->db->update('user');

               $this->session->unset_userdata('reset_email');

               $this->session->set_flashdata(
                    'message',
                    '<div class="alert alert-success alert-dismissible fade show" role="alert">
                         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                         </button>Password berhasil diubah! Silahkan login!
                    </div>'
               );
               redirect('auth');
          }
     }

     public function logout()
     {
          // var_dump($this->session->userdata('email'));
          // die();
          $this->session->unset_userdata('email');
          $this->session->unset_userdata('role_id');

          $this->session->set_flashdata(
               'message',
               '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                         <span aria-hidden="true">&times;</span>
                    </button>Berhasil logout!
               </div>'
          );
          redirect('auth');
     }

     public function blok()
     {
          $data['title'] = "Akses ditolak";
          $this->load->view('auth/blok');
     }
}
