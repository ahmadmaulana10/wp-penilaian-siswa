<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Nilai extends CI_Controller
{
    public function data_nilai()
    {
        $data['user']  = $this->ModelUser->getTopbarName();
        $data['title'] = "Nilai Siswa";

        $config['base_url'] = base_url() . 'nilai';
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
        $this->load->view('templates/topbar');
        $this->load->view('siswa/v-nilai-siswa', $user);
        $this->load->view('templates/footer');
    }

    public function data_nilaiguru()
    {
        $data['user']  = $this->ModelUser->getTopbarName();
        $data['title'] = "Nilai Siswa";

        $config['base_url'] = base_url() . 'nilai/data_nilaiguru';
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
        $this->load->view('templates/user_sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('siswa/v-nilai-siswa', $user);
        $this->load->view('templates/footer');
    }

    public function detail_nilai($nisn)
    {
        $data['title'] = "Detail Nilai Siswa";
        $data['user']  = $this->ModelUser->getTopbarName();
        $detail['siswa']  = $this->ModelNilai->getSiswaById($nisn);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/admin_sidebar');
        $this->load->view('templates/topbar');
        $this->load->view('siswa/v-detail-nilai', $detail);
        $this->load->view('templates/footer');
    }

    public function ubah_nilai($nisn)
    {
        $data['title'] = "Ubah Siswa";
        $data['user']  = $this->ModelAdmin->getTopbarName();
        $data['siswa'] = $this->ModelNilai->getSiswaById($nisn);

        $this->form_validation->set_rules('indonesia', 'Bahasa Indonesia', 'required|numeric', [
            'required' => 'Nilai harus diisi !',
            'numeric' => 'Harus angka!'
        ]);
        $this->form_validation->set_rules('matematika', 'Matematika', 'required|numeric', [
            'required' => 'Nilai harus diisi !',
            'numeric' => 'Harus angka!'
        ]);
        $this->form_validation->set_rules('ipa', 'IPA', 'required|numeric', [
            'required' => 'Nilai harus diisi !',
            'numeric' => 'Harus angka!'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/admin_sidebar', $data);
            $this->load->view('templates/topbar');
            $this->load->view('siswa/v-ubah-nilai', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'indonesia' => $this->input->post('indonesia', true),
                'matematika' => $this->input->post('matematika', true),
                'ipa' => $this->input->post('ipa', true)
            ];

            $this->ModelNilai->ubahNilai($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Nilai Berhasil diubah!</div>');
            redirect('nilai/data_nilai');
        }
    }
}
