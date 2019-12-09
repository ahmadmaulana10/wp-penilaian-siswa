<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller 
{
     public function index()
     {
          $data['title'] = "Halaman Admin";

          $this->load->view('templates/header', $data);
          $this->load->view('templates/topbar', $data);
          $this->load->view('templates/sidebar', $data);
          $this->load->view('admin/index', $data);
          $this->load->view('templates/footer', $data);
     }
}