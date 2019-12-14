<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelSiswa extends CI_Model
{

    public function getSiswaById($nisn)
    {
        return $this->db->get_where('siswa', ['nisn' => $nisn])->row_array();
    }

    public function totalRows()
    {
        return $this->db->get('siswa')->num_rows();
    }

    public function getUsers($limit, $start)
    {
        return $this->db->get('siswa', $limit, $start)->result_array();
    }

    public function simpanData($data = null)
    {
        $this->db->insert('siswa', $data);
    }

    public function hapusSiswa($nisn)
    {
        $this->db->where('nisn', $nisn);
        $this->db->delete('siswa');
    }
}
