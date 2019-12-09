<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
     public function index()
     {
          $data['title'] = "Login";

          $this->load->view('templates/auth_header', $data);
          $this->load->view('auth/index');
          $this->load->view('templates/auth_footer');
     }

     public function registration()
     {
          $data['title'] = "Registrasi";

          $this->load->view('templates/auth_header', $data);
          $this->load->view('auth/registration');
          $this->load->view('templates/auth_footer');
     }
}
