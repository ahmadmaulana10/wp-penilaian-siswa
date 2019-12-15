<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelNilai extends CI_Model
{
    public function getUsers($limit, $start)
    {
        return $this->db->get('siswa', $limit, $start)->result_array();
    }

    public function getSiswaById($nisn)
    {
        return $this->db->get_where('siswa', ['nisn' => $nisn])->row_array();
    }

    public function ubahNilai($nisn)
    {
        $data = [
            'indonesia' => $this->input->post('indonesia', true),
            'matematika' => $this->input->post('matematika', true),
            'ipa' => $this->input->post('ipa', true),
        ];

        $this->db->where('nisn', $this->input->post('nisn'));
        $this->db->update('siswa', $data);
    }
}
