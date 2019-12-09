<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller 
{
     public function index()
     {
          $data['title'] = "Halaman Login";

          $this->load->view('templates/auth_header', $data);
          $this->load->view('auth/index', $data);
          $this->load->view('templates/auth_footer', $data);
     }

     public function registration()
     {
          $data['title'] = "Halaman Registrasi";
          
          $this->load->view('templates/auth_header', $data);
          $this->load->view('auth/registration', $data);
          $this->load->view('templates/auth_footer', $data);
     }
}