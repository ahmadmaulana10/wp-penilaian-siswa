<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kepsek extends CI_Controller
{
     public function __construct()
     {
          parent::__construct();
          is_login();
     }

     public function index()
     {
          $data['title'] = "Kepala Sekolah";
          $data['user']  = $this->ModelKepsek->getTopbarName();

          $this->load->view('templates/header', $data);
          $this->load->view('templates/kepsek_sidebar');
          $this->load->view('templates/topbar');
          $this->load->view('admin/index');
          $this->load->view('templates/footer');
     }
}
