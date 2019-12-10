<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
     public function index()
     {
          $data['title'] = "User";
          $data['user']  = $this->ModelUser->getTopbarName();

          $this->load->view('templates/header', $data);
          $this->load->view('templates/topbar', $data);
          $this->load->view('templates/sidebar');
          $this->load->view('user/index', $data);
          $this->load->view('templates/footer');
     }
}
