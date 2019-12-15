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

    public function ubahNilai()
    {
        $data = [
            'indonesia'     => $this->input->post('indonesia', TRUE),
            'matematika'    => $this->input->post('matematika', TRUE),
            'ipa'           => $this->input->post('ipa', TRUE)
        ];


        $this->db->where('nisn', $this->input->post('nisn'));
        $this->db->update('siswa', $data);
    }

    public function updateNilai($data = 'siswa', $where = null)
    {
        $this->db->update('siswa', $data, $where);
    }
}
