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

          $this->load->view('templates/header', $data);
          $this->load->view('templates/sidebar');
          $this->load->view('templates/topbar');
          $this->load->view('admin/ubah-profil');
          $this->load->view('templates/footer');
     }

     public function data_user()
     {
          $data['title'] = "Data User";
          $data['user']  = $this->ModelAdmin->getTopbarName();
          $user['user']  = $this->ModelUser->getUser();

          $this->load->view('templates/header', $data);
          $this->load->view('templates/sidebar');
          $this->load->view('templates/topbar');
          $this->load->view('admin/v-data-user', $user);
          $this->load->view('templates/footer');
     }
}
